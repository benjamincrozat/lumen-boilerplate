<?php

use App\Post;
use App\User;

class PostsControllerTest extends TestCase
{
    /** @test */
    public function guest_cannot_list_posts()
    {
        $this->json('GET', '/api/v1/posts')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_list_posts()
    {
        $this->actingAs(factory(User::class)->create())
            ->json('GET', '/api/v1/posts')
            ->seeJsonStructure(['data', 'links', 'meta']);
    }

    /** @test */
    public function guest_cannot_store_post()
    {
        $this->json('POST', '/api/v1/posts')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_store_post()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->json('POST', '/api/v1/posts', [
                'title'   => 'Lorem',
                'content' => 'Ipsum',
            ])
            ->seeJsonStructure(['data'])
            ->seeJson([
                'title'      => 'Lorem',
                'content'    => 'Ipsum',
            ])
            ->seeStatusCode(201);
    }

    /** @test */
    public function guest_cannot_read_post()
    {
        $this->json('GET', '/api/v1/posts/1')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_read_post()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->json('GET', '/api/v1/posts/' . $post->id)
            ->seeJsonStructure([
                'data' => [
                    'user',
                ],
            ])
            ->seeJson([
                'id'         => $post->id,
                'created_at' => (string) $post->created_at,
                'updated_at' => (string) $post->updated_at,
                'title'      => $post->title,
                'content'    => $post->content,
            ]);
    }

    /** @test */
    public function guest_cannot_update_post()
    {
        $this->json('PUT', '/api/v1/posts/1')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_update_post()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $new_title   = 'Hello';
        $new_content = 'World';

        $this->actingAs($user)
            ->json('PUT', '/api/v1/posts/' . $post->id, [
                'title'   => $new_title,
                'content' => $new_content,
            ])
            ->seeJsonStructure([
                'data' => [
                    'user',
                ],
            ])
            ->seeJson([
                'id'         => $post->id,
                'created_at' => (string) $post->created_at,
                'updated_at' => (string) $post->updated_at,
                'title'      => $new_title,
                'content'    => $new_content,
            ]);
    }

    /** @test */
    public function guest_cannot_delete_post()
    {
        $this->json('DELETE', '/api/v1/posts/1')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_delete_post()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->json('DELETE', '/api/v1/posts/' . $post->id)
            ->seeStatusCode(204);
    }
}
