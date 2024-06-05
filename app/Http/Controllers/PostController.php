<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = Post::all();
        return new JsonResponse($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request):JsonResponse
    {
        $row = Post::query()->create([
           'title'=>$request->input('title'),
           'body'=>$request->input('body')
        ]);

        return new JsonResponse($row);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $updated = $post->update([
           'title' => $request->title ?? $post->title,
           'body' => $request->body ?? $post->body
        ]);
        if(!$updated)
            return new JsonResponse([
               'error' => [
                   'Failed to update model.'
               ]
            ],400);

        return new JsonResponse($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
