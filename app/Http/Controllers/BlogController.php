<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show(Blog $blog){
        $blog->load('user', 'category');

        return view('blogs.show', [
            'blog' => $blog,
        ]);
    }
}
