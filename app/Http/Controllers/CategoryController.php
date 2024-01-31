<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource
     */
    public function create(): View
    {
        return view('categories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request): RedirectResponse
    {
        $this->validate($request, array(
            'name' => 'required|max:255|unique:categories,name'
        ));

        $category = new Category();
        $category->name = $request->name;

        $category->save();

        $category->posts()->sync($request->posts, false);

        return redirect()->route('categories.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $category = Category::all()->find($id);
        $posts = $category->posts();

        return view('categories.show', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = Category::all()->find($id);
        $allPosts = Post::all();
        $posts = array();
        foreach ($allPosts as $post){
            $posts[$post->id] = $post->title;
        }

        return view('categories.edit', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $name = $request->input('name');

        // Find the requested post and put the requested data to the corresponding column
        $category = Category::all()->find($id);
        $category->name = $name;

        // Save the data
        $category->save();

        if (isset($id)) {
            $category->posts()->sync($request->posts);
        } else {
            $category->posts()->sync(array());
        }
        return redirect()->route('categories.show', ['category' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $category = Category::all()->find($id);

        $category->posts()->detach();

        $category->delete();

        return redirect()->route('categories.index');
    }

}
