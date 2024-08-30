<?php

namespace Api\V1\Post;

use App\Models\Post;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        //Load data in db
        $posts = Post::factory(5)->create();

        $res = $this->json('get','/api/cygnus/posts');

        $res->assertStatus(200);

        dump($res->json());
    }
    public function test_show()
    {
        $dummy = Post::factory()->create();
        $response = $this->json('get','/api/cygnus/posts/'.$dummy->id);

        $result = $response->assertStatus(200)->json('data');

        $this->assertEquals(data_get($result,'id'),$dummy->id,'Response ID not the same');
    }

    public function test_create(){
        $dummy = Post::factory()->make();
        $response = $this->json('post','/api/cygnus/posts',$dummy->toArray());
        $result = $response->assertStatus(200)->json('data');

        $result = collect($result)->only(array_keys($dummy->getAttributes()));

        $result->each(function($value,$filed) use ($dummy){
            $this->assertSame(data_get($dummy, $filed), $value, 'Fillable is not the same.');
        });
    }
}
