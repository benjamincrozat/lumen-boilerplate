<?php

use App\User;

class UserControllerTest extends TestCase
{
    /** @test */
    public function user_have_to_be_authenticated()
    {
        $this->json('GET', '/api/v1/user')
            ->seeStatusCode(401);
    }

    /** @test */
    public function user_can_read_his_own_data()
    {
        factory(User::class)->create();

        // In normal conditions, this relationship is loaded (see app/Providers/AuthServiceProvider.php).
        $user = User::with('posts')->first();

        $this->actingAs($user)
            ->json('GET', '/api/v1/user')
            ->seeJsonStructure([
                'data' => ['posts'],
            ])
            ->seeJson([
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ]);
    }
}
