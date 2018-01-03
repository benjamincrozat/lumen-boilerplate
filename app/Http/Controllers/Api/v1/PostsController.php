<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Repositories\PostsCacheRepository;

class PostsController extends \App\Http\Controllers\Controller
{
    /**
     * @var PostsCacheRepository
     */
    protected $posts;

    public function __construct(PostsCacheRepository $posts)
    {
        $this->posts = $posts;
    }

    public function index(Request $request)
    {
        return PostResource::collection($this->posts->list($request->all()));
    }

    public function store(Request $request)
    {
        $post = $this->posts->store($request->all());

        $resource = new PostResource($post);

        return $resource->toResponse($request)->setStatusCode(201);
    }

    public function show(int $id)
    {
        return new PostResource($this->posts->get($id));
    }

    public function update(Request $request, int $id)
    {
        return new PostResource($this->posts->update($id, $request->all()));
    }

    public function destroy(int $id)
    {
        $this->posts->delete($id);

        return response()->json('', 204);
    }
}
