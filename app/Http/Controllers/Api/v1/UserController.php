<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends \App\Http\Controllers\Controller
{
    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}
