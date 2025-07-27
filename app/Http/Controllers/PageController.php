<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $questions = Question::with('category', 'user')->latest()->get();
        $blogs = Blog::with('user', 'category')->latest()->get();

        return view("pages.home", [
            'questions' => $questions,
            'blogs' => $blogs,
        ]);
    }
}
