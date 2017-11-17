<?php

use App\User;

class UserControllerTest extends TestCase
{
    /** @test */
    function authenticated_user_can_read_his_own_data()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->json('GET', '/api/v1/user')
            ->seeJson([
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
    }
}