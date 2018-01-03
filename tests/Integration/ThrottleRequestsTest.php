<?php

use Illuminate\Support\Carbon;

/**
 * @group integration
 */
class ThrottleRequestsTest extends TestCase
{
    /** @test */
    public function lock_opens_immediately_after_decay()
    {
        Carbon::setTestNow(null);

        Route::get('/', ['middleware' => 'throttle:2,1']);

        $this->json('GET', '/')
            ->seeHeader('X-RateLimit-Limit', 2)
            ->seeHeader('X-RateLimit-Remaining', 1);

        $this->json('GET', '/')
            ->seeHeader('X-RateLimit-Limit', 2)
            ->seeHeader('X-RateLimit-Remaining', 0);

        Carbon::setTestNow(
            Carbon::now()->addSeconds(58)
        );

        $this->json('GET', '/')
            ->seeStatusCode(429);
    }
}
