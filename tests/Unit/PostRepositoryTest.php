<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\Post;
use App\Repositories\PostRepository;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create()
    {
        //1. Define the goal
        //2. Replicate the env / restriction
        $repository = $this->app->make(PostRepository::class);
        //3. Define the source of truth
        $payload = [
            'title' => 'heyaa',
            'body'=>[]
        ];
        /* 4. compare */
        $result = $repository->create($payload);

        $this->assertSame($payload['title'],$result->title,'Post created does not have the same title.');

    }
    public function test_update()
    {
        //Goal: make sure we can update a post using the update method
        $repository = $this->app->make(PostRepository::class);

        $dummyPost = Post::factory(1)->create()[0];

        $payload = [
            'title'=>'abc123'
        ];
        $updated = $repository->update($dummyPost, $payload);
        $this->assertSame($payload['title'], $updated->title, 'Post updated does not have the same title');
    }
    public function test_delete()
    {
        $repository = $this->app->make(PostRepository::class);
        $dummy = Post::factory(1)->create()->first();

        $deleted = $repository->forceDelete($dummy);

        $found = Post::query()->find($dummy->id);

        $this->assertSame(null,$found,'Post is not deleted');
    }
}
