<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->where('is_published', true)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
