<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
  
    // Constructor
    public function __construct()
    {
        $this->middleware(middleware: 'auth');
    }

    // Getter - Get all post sort by newest first
    public function index(): View
    {
        $posts = Post::with(relations: 'user')->latest()->get();
        return view(view: 'posts.index', data: compact(var_name: 'posts'));
    }

    // Getter - Create post
    public function create(): View
    {
        return view(view: 'posts.create');
    }

    // Setter - Store new post
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(rules: [
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image_path = $request->file(key: 'image')->store(path: 'uploads', options: 'public');

        auth()->user()->posts()->create(attributes: [
            'caption' => $data['caption'],
            'image_path' => $image_path,
        ]);

        return redirect(to: 'profile/' .auth()->user()->id);
    }

    // Getter - Get a post
    public function show(Post $post): View
    {
        return view(view: 'posts.show', data: compact(var_name: 'post'));
    }

    // Getter - Edit post
    public function edit(Post $post)
    {
        // Check if the authentcated user is the same as the post user
        if (auth()->id() !== $post->user_id) {
            abort(code: 403, message: 'Unauthorized action.');
        }
        return view(view: 'posts.edit', data: compact(var_name: 'post'));
    }

    // Getter - Update post
    public function update(Request $request, Post $post): RedirectResponse
    {
        // Check if the authentcated user is the same as the post user
        if (auth()->id() !== $post->user_id) {
            abort(code: 403, message: 'Unauthorized action.');
        }

        $data = $request->validate(rules: [
            'caption' => 'required',
        ]);

        $post->update(attributes: $data);

        return redirect(to: '/posts/' . $post->id);
    }

    // Getter - Delete post
    public function destroy(Post $post): RedirectResponse
    {
         // Check if the authentcated user is the same as the post user
        if (auth()->id() !== $post->user_id) {
            abort(code: 403, message: 'Unauthorized action.');
        }

        // Delete the image file
        Storage::disk(name: 'public')->delete(paths: $post->image_path);

        // Delete the post
        $post->delete();

        return redirect(to: 'profile/' .auth()->user()->id);
    }
}
