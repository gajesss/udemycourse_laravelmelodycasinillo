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
        $post = $this->createdDummyBlogPost();
        //act
        $response = $this->get('/posts');

        //assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts',['title'=>'New title']);
    }

    public function testStoreValid()
    {
$params=[
    'title'=>'Valid title',
    'content'=>'Atleast 10 characters'
];

$this-> post('/posts', $params)
->assertStatus(302)
->assertSessionHas('status');

$this->assertEquals(session('status'),'Blog post was created');
    }

    public function testStoreFail()
    {

        $params=[
            'title'=>'x',
            'content'=>'x'
        ];
        $this-> post('/posts', $params)
->assertStatus(302)
->assertSessionHas('errors');

$messages=session('errors')->getMessages();

$this->assertEquals($messages['title'][0],"The title must be at least 5 characters.");
$this->assertEquals($messages['content'][0],"The content must be at least 5 characters.");

    }
    public function testUpdateValid()
    {

  
        $post = $this->createdDummyBlogPost();

            $post->save();
        $params=[
            'title'=>'name changed',
            'content'=>'content changed'
        ];
        $this-> put("/posts/{$post->id}", $params)
->assertStatus(302)
->assertSessionHas('status');
$this->assertEquals(session('status'),'Blog post was updated');

$this->assertDatabaseHas('blog_posts',['title'=>'New title']);

    }
    public function testDelete()
    {
    
        $post = $this->createdDummyBlogPost();
        $this->assertDatabaseHas('blog_posts',['title'=>'New title']);
       
        $this-> delete("/posts/{$post->id}")
        ->assertStatus(302)
        ->assertSessionHas('status');
        $this->assertEquals(session('status'),'Blog post was deleted');
       
      
    }
    private function createdDummyBlogPost():BlogPost
    {
        $post = new BlogPost();
        $post->title='New title';
        $post->content='Content of the blog post';
        $post->save();
        return $post;

    }

    }



    



