<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news_page.index', compact('news'));
    }

    public function show($id)
    {
        $newsShow = News::all();
        return view('news_page.show', compact('newsShow'));
    }
}
