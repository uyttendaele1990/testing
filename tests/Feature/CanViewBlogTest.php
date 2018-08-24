<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanViewBlogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @group posts-view
     *
     * @return [description] [title]
     */

    public function testShowPosts() 
    {
            // arrange
        // create 2 posts
        $post1 = Post::create([
            'title' => 'new1 title',
            'body' => 'new1 body'
        ]);

        $post2 = Post::create([
            'title' => 'new2 title',
            'body' => 'new2 body'
        ]);    
            // action
        // get request to url to view posts
        $resp = $this->get('/posts');
            // assert
        // assert you see the data of the 2 posts
        $resp->assertSee($post1->title);
        $resp->assertSee($post2->title);
        $resp->assertSee($post1->body);
        $resp->assertSee($post2->body);
        $resp->assertSee($post1->created_at);
        $resp->assertSee($post2->created_at);
    }

    /**
     * @group store-post
     *
     * @return [description] [title]
     */
    public function testStoreBlogPost()
    {
            // arrange
        // make a blogpost
        $post = Post::create([
            'title' => 'new title',
            'body' => 'new body'
        ]);

            // action
        // post request to link to add data in db
        $resp = $this->post('/store', [
            'title' => 'new title',
            'body' => 'new body'
        ]);
            // assert
        // make sure the data is stored in the db
        $this->assertDatabaseHas('posts', [
            'title' => 'new title',
            'body' => 'new body'
        ]);
        // make sure the data is displayed on the page
        $resp->assertSee($post->title);
        $resp->assertSee($post->body);
        $resp->assertSee($post->created_at);
    }

    /**
     * @group about-view
     *
     * @return [description] [title]
     */
    public function testCanViewAboutPage() {
                //arrange
            // 
                // action
            // get request to link to view page
            $resp = $this->get('/about');
                // assert
            // assert that you can see 'about me'
            $resp->assertSee('About me');
    }

    /**
     * @group show-post
     *
     * @return [description] [title]
     */
    public function testShowPostById() {
            // arrange
        // create a post
        $post = Post::create([
            'title' => 'new title',
            'body' => 'new body'
        ]);
            // action
        // get request to view post page
        // very important to use " instead of ' or you will an error message 
        // (don't ask me how long it took me untill i found out...)
        $resp = $this->get("/post/{$post->id}");
            // assert
        // assert that you can see the post
        $resp->assertSee($post->title);
        $resp->assertSee($post->body);
        $resp->assertSee($post->created_at);
    }

    /**
     * @group edit-post
     *
     * @return [description] [title]
     */
    public function testCanEditPost() {
            // arrange
        // make a post
        $post = Post::create([
            'title' => 'new title',
            'body' => 'new body'
        ]);

        $postedit = ([
            'title' => 'edited title',
            'body' => 'edited body'
        ]);
            // action
        // request to controller to update post
        $resp = $this->put("/post/update/{$post->id}");
            // assert
        // make sure the post has been edited
        $this->assertDatabaseHas('posts', $postedit);
        $this->assertDatabaseMissing('posts', [
            'title' => 'new title',
            'body' => 'new body'
        ]);
    }

    /**
     * @group delete-post
     *
     * @return [description] [title]
     */
    public function testCanDeletePost() {
            // arrange
        // make a post
        $post = Post::create([
            'title' => 'new title',
            'body' => 'new body'
        ]);
            // action
        // delete request to controller
        $resp = $this->delete("/removePost/{$post->id}");
            // assert
        //assert db doesnt have data anymore
        $this->assertDatabaseMissing('posts', [
            'title' => 'new title',
            'body' => 'new body'
        ]);
    }
}
