<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostsController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        return PostResource::collection(app('posts')->list($request->all()));
    }

    public function store(Request $request)
    {
        $post = app('posts')->store($request->all());

        $resource = new PostResource($post);

        return $resource->toResponse($request)->setStatusCode(201);
    }

    public function show(int $id)
    {
        return new PostResource(app('posts')->get($id));
    }

    public function update(Request $request, int $id)
    {
        return new PostResource(app('posts')->update($id, $request->all()));
    }

    public function destroy(int $id)
    {
        app('posts')->delete($id);

        return response()->json('', 204);
    }
}
