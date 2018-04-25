<?php

namespace App\Http\Middleware;

use App\Traits\RequestsThrottlingCompatibility;

class ThrottleRequestsWithRedis extends \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis
{
    use RequestsThrottlingCompatibility;
}
