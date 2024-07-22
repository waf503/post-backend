<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $data = Post::all();
        return PostResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostRepository $repository):JsonResponse
    {
        $created = $repository->create($request->only([
            'title',
            'body',
            'user_ids'
        ]));

        return new JsonResponse($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post):PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(/*UpdatePostRequest $request*/ Request $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids'
        ]));

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $post = $repository->forceDelete($post);
        return new JsonResponse([
           'data' => 'success'
        ]);
    }
}
