<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
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
}
