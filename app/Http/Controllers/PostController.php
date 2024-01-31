<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    // Show the form for creating a new resource
    public function create(): View
    {
        $categories = Category::all();
        return view('posts.create')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body' => 'required',
        ));

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->body;

        $post->save();

        $post->categories()->sync($request->categories, false);

        return redirect()->route('posts.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::orderBy('id', 'asc')->paginate(5);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = Post::all()->find($id);
        $categories = $post->categories();

        return view('posts.show', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = Post::all()->find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        return view('posts.edit')->with([
            'post' => $post,
            'categories' => $cats
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Get the data from the request
        $title = $request->input('title');
        $content = $request->input('content');

        // Find the requested post and put the requested data to the corresponding column
        $post = Post::all()->find($id);
        $post->title = $title;
        $post->content = $content;

        // Save the data
        $post->save();

        if (isset($request->categories)) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->sync(array());
        }

        return redirect()->route('posts.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Post::all()->find($id);

        $post->categories()->detach();

        $post->delete();

        return redirect()->route('posts.index');
    }

}
