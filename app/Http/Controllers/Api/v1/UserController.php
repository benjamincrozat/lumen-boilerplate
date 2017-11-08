<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

class UserController extends \App\Http\Controllers\Controller
{
    public function __invoke(Request $request)
    {
        return $request->user();
    }
}
