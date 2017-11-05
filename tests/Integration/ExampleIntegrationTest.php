<?php

use App\User;

class ExampleIntegrationTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_read_his_own_data()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->json('GET', '/api/v1/user')
            ->assertResponseOk();
    }
}
