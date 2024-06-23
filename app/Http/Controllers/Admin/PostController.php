<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories', 'images')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->is_published = $request->has('is_published');
        $post->user_id = Auth::id();
        $post->save();

        $post->categories()->sync($request->categories);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->images()->create(['path' => $path]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->is_published = $request->has('is_published');
        $post->save();

        $post->categories()->sync($request->categories);

        if ($request->hasFile('image')) {
            // Remove old image if exists
            if ($post->images()->exists()) {
                Storage::disk('public')->delete($post->images()->first()->path);
                $post->images()->delete();
            }

            $path = $request->file('image')->store('images', 'public');
            $post->images()->create(['path' => $path]);
        }

        return redirect()->route(Auth::user()->roles->pluck('name')->contains('administrator') ? 'admin.posts.index' : 'moderator.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->images()->exists()) {
            Storage::disk('public')->delete($post->images()->first()->path);
            $post->images()->delete();
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
