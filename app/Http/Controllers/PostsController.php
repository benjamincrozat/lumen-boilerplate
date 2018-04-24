<?php

namespace App\Http\Controllers\Api\v1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostsController extends \App\Http\Controllers\Controller
{
    /**
     * Return a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return PostResource::collection(app('posts')->index($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);

        return (new PostResource(
            app('posts')->store($request->all())
        ))
            ->toResponse($request)
            ->setStatusCode(201);
    }

    /**
     * Return the specified resource.
     *
     * @param string $id
     *
     * @return PostResource
     *
     * @throws \Exception
     */
    public function show($id)
    {
        return new PostResource(app('posts')->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string  $id
     *
     * @return PostResource
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $rules = Post::$rules;
        $rules['title'] .= ',' . $id;

        $this->validate($request, Post::$rules);

        return new PostResource(app('posts')->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        app('posts')->destroy($id);

        return response()->json('', 204);
    }
}
