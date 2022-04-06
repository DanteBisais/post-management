<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        // $posts = Post::with('getPostCategory')->get();
        // dd($users);
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required|min:5',
            'body' => 'required'
       ]);
//        $post = Post::create(array_merge($request->only('title', 'description', 'body'),[
//        'user_id' => auth()->id()
//        ]));

        $post = Post::create(array_merge($validatedData, ['user_id' => auth()->id()]));

        //$category_id = Category::find($id);

       //$category_id = $request->input('category');

        $post->categories()->attach($request->input('category'));
        return redirect()->route('posts.index')
            ->withSuccess(__('Post created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::find($id);
        var_dump($post->Categories);
        $categories = Post::find(1)->categories()->orderBy('name')->get();

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Category $category)
    {
        return view('posts.edit', [
            'post' => $post,
            'category' => $category

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $post->update($request->only('title', 'description', 'body'));
//        $category_id = $request->input('category');
//        $post->update($request->except(['_token', 'categories']));
//        $post->categories()->sync([1,2,3]);
        //$post->categories()->syncWithoutDetaching($category_id);

       // $category_id = $request->input('category');
        //$post->categories()->syncWithoutDetaching($category_id);
        $post->categories()->sync($request->category);


        return redirect()->route('posts.index')
            ->withSuccess(__('Post updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->withSuccess(__('Post deleted successfully.'));
    }
}
