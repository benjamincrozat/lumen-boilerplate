<?php

namespace App\Http\Middleware;

use App\Traits\RequestsThrottlingCompatibility;

class ThrottleRequests extends \Illuminate\Routing\Middleware\ThrottleRequests
{
    use RequestsThrottlingCompatibility;
}
