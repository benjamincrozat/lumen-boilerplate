<?php

namespace App\Http\Controllers\Api\v1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Repositories\PostsCacheRepository;

class PostsController extends \App\Http\Controllers\Controller
{
    /**
     * @var PostsCacheRepository
     */
    protected $posts;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->posts = app('posts');
    }

    /**
     * Return a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PostResource::collection($this->posts->index($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);

        $this->posts->store($request->all());

        return response()->json('', 201);
    }

    /**
     * Return the specified resource.
     *
     * @param string $id
     *
     * @return PostResource
     */
    public function show($id)
    {
        return new PostResource($this->posts->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string  $id
     *
     * @return PostResource
     */
    public function update(Request $request, $id)
    {
        $rules = Post::$rules;
        $rules['title'] .= ',' . $id;

        $this->validate($request, Post::$rules);

        return new PostResource($this->posts->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->posts->destroy($id);

        return response()->json('', 204);
    }
}
