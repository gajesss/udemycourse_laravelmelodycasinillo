<?php

namespace Tests\Feature;
use App\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;


    
    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts');
    }
    public function testSee1BlogPostWhenThereIs1()
    {
        //arrange
        $post = new BlogPost();
        $post->title='New title';
        $post->content='New content';
        $post->save();
        //act
        $response = $this->get('/posts');

        //assert
        $response->assertSeeText('New title');

        $this->assertDatabaseHas('blog_posts',['title'=>'New title']);
    }
}
