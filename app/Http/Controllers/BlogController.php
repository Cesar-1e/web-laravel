<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::with([
            'user',
            'category'
        ])
        ->latest()
        ->paginate(12);

        return view('blogs.index', [
            'blogs' => $blogs,
        ]);
    }

    public function show(Blog $blog){
        $userId = 10;
        $blog->load([
            'user',
            'category',

            'comments' => fn ($query) => $query->with([
                'user',
                'hearts' => fn($query) => $query->where('user_id', $userId),
            ]),
            'hearts' => fn($query) => $query->where('user_id', $userId),
        ]);

        return view('blogs.show', [
            'blog' => $blog,
        ]);
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('blogs.edit', [
            'blog' => $blog,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('blogs.show', $blog);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
