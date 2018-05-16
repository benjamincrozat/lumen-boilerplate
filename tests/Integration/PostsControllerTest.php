<?php

use App\Post;
use App\User;
use App\Cache\Events\CacheFlushed;

class PostsControllerTest extends TestCase
{
    /**
     * Flush Redis cache before every test.
     */
    public function setUp()
    {
        parent::setUp();

        Posts::flush();
    }
    
    /** @test */
    public function guest_cannot_list_posts()
    {
        $this->json('GET', '/posts')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_list_posts()
    {
        $this->actingAs(factory(User::class)->create())
            ->json('GET', '/posts')
            // Validate that a paginator is returned.
            ->seeJsonStructure(['data', 'links', 'meta']);

        $this->assertTrue(
            app('posts')->has(
                app('request')->all()
            )
        );
    }

    /** @test */
    public function guest_cannot_store_post()
    {
        $this->json('POST', '/posts')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_store_post()
    {
        $this->expectsEvents([CacheFlushed::class]);

        $this->actingAs(factory(User::class)->create())
            ->json('POST', '/posts', $attributes = [
                'title'   => 'Lorem',
                'content' => 'Ipsum',
            ])
            ->seeStatusCode(201)
            ->seeJsonStructure(['data' => ['id', 'created_at', 'updated_at', 'title', 'content', 'user']])
            ->seeJson($attributes);
    }

    /** @test */
    public function user_cannot_store_post_without_title()
    {
        $this->actingAs(factory(User::class)->create())
            ->json('POST', '/posts', [
                'content' => 'Ipsum',
            ])
            ->seeValidationError('title');
    }

    /** @test */
    public function user_cannot_store_post_with_an_already_used_title()
    {
        $post = factory(Post::class)->create([
            'title'   => 'Lorem',
            'content' => 'Ipsum',
        ]);

        $this->actingAs($post->user)
            ->json('POST', '/posts', [
                'title'   => 'Lorem',
                'content' => 'Ipsum',
            ])
            ->seeValidationError('title');
    }

    /** @test */
    public function user_cannot_store_post_without_content()
    {
        $this->actingAs(factory(User::class)->create())
            ->json('POST', '/posts', [
                'title' => 'Lorem',
            ])
            ->seeValidationError('content');
    }

    /** @test */
    public function guest_cannot_read_post()
    {
        $this->json('GET', '/posts/some-id')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_read_post()
    {
        $post = factory(Post::class)->create();

        $this->actingAs($post->user)
            ->json('GET', "/posts/$post->id")
            ->seeJsonStructure([
                // This relationship should be loaded.
                'data' => ['user'],
            ])
            ->seeJson([
                'id'         => $post->id,
                'created_at' => (string) $post->created_at,
                'updated_at' => (string) $post->updated_at,
                'title'      => $post->title,
                'content'    => $post->content,
            ]);

        $this->assertTrue(
            app('posts')->has($post->id)
        );
    }

    /** @test */
    public function guest_cannot_update_post()
    {
        $this->json('PUT', '/posts/some-id')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_update_post()
    {
        $this->expectsEvents([CacheFlushed::class]);

        $post = factory(Post::class)->create();

        $new_title   = 'Hello';
        $new_content = 'World';

        $this->actingAs($post->user)
            ->json('PUT', "/posts/$post->id", [
                'title'   => $new_title,
                'content' => $new_content,
            ])
            ->seeJsonStructure(['data' => ['user']])
            // Make sure we get fresh data.
            ->seeJson([
                'title'   => $new_title,
                'content' => $new_content,
            ]);
    }

    /** @test */
    public function user_cannot_update_post_without_title()
    {
        $post = factory(Post::class)->create();

        $this->actingAs($post->user)
            ->json('PUT', '/posts/' . $post->id, [
                'content' => 'Foo',
            ])
            ->seeValidationError('title');
    }

    /** @test */
    public function user_cannot_update_post_with_an_already_used_title()
    {
        $first_post  = factory(Post::class)->create();
        $second_post = factory(Post::class)->create(['title' => 'Foo']);

        $this->actingAs($first_post->user)
            ->json('PUT', "/posts/$first_post->id", [
                'title'   => $second_post->title,
                'content' => 'Bar',
            ])
            ->seeValidationError('title');
    }

    /** @test */
    public function user_cannot_update_post_without_content()
    {
        $post = factory(Post::class)->create();

        $this->actingAs($post->user)
            ->json('PUT', "/posts/$post->id", ['title' => 'Foo'])
            ->seeValidationError('content');
    }

    /** @test */
    public function guest_cannot_delete_post()
    {
        $this->json('DELETE', '/posts/some-id')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_delete_post()
    {
        $this->expectsEvents([CacheFlushed::class]);

        $post = factory(Post::class)->create();

        $this->actingAs($post->user)
            ->json('DELETE', "/posts/$post->id")
            ->seeStatusCode(204);
    }
}
