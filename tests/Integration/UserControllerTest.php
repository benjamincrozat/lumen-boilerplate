<?php

use App\User;

class UserControllerTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_read_his_own_data()
    {
        $this->actingAs(factory(User::class)->create())
            ->json('GET', '/api/v1/user')
            ->seeJson([
                'data' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
            ]);
    }
}
