<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends \App\Http\Controllers\Controller
{
    /**
     * Return authenticated user.
     *
     * @param Request $request
     *
     * @return UserResource
     */
    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}
