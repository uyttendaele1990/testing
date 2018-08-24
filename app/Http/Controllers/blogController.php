<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class blogController extends Controller
{

    public function store(Request $request) {
        $r = $request;

        $post = new Post;
        $post->title = $r->title;
        $post->body = $r->body;
        $post->save();

        return view('post')->withPost($post);
    }

    public function about() {
        return view('about');
    }

    public function posts() {
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    public function show($id) {
        $post = Post::findOrFail($id);
        return view('post')->withPost($post);      
    }

    public function update($id) {
        $post = Post::findOrFail($id);
        $post->title = 'edited title';
        $post->body = 'edited body';
        $post->save();
        return view('post', compact('post'));
    }

    public function delete($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return view('welcome');
    }

}