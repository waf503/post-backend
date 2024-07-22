<?php

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    public function create(array $attributes)
    {

        return DB::transaction(function () use ($attributes){
            $row = Post::query()->create([
                'title'=> data_get($attributes,'title','Untitled'),
                'body'=> data_get($attributes,'body')
            ]);

            throw_if(!$row, GeneralJsonException::class, 'Failed to create.',402);

            if($userIds = data_get($attributes,'user_ids')){
                $row->users()->sync($userIds);
            }
            return $row;
        });
    }
    public function update(Post $post, array $attributes)
    {
        return DB::transaction(function () use ($post, $attributes)
        {
            $updated = $post->update([
                'title' => data_get($attributes,'title',$post->title),
                'body' => data_get($attributes,'body',$post->body)
            ]);
//            if(!$updated)
//                throw new \Exception('Failed to update post');
            throw_if(!$updated, GeneralJsonException::class, 'Failed to update post',402);

            if($userIds = data_get($attributes,'user_ids'))
            {
                $post->users()->sync($userIds);
            }

            return $post;
        });
    }
    public function forceDelete(Post $post)
    {
        return DB::transaction(function () use ($post){
           $deleted =  $post->forceDelete();
//           if(!$deleted)
//               throw new \Exception("Cannot delete post.");
            throw_if(!$deleted, GeneralJsonException::class, 'Cannot delete post.',402);
           return $deleted;
        });
    }

}
