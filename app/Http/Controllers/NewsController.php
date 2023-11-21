<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\News;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news_page.index', compact('news'));
    }
    public function dashboard()
    {
        $news = News::all();
        return view('news_page.dashboard', compact('news'));
    }

    public function show($slug)
    {
        // Find the news post by its id
        $news = News::where('slug', $slug)->first();

        // Check if the news post exists
        if (!$news) {
            // Handle the case where the news post is not found, for example, redirect to a 404 page
            return abort(404);
        }

        return view('news_page.show', compact('news'));
    }


    public function create()
    {
        return view('news_page.create');
    }

    public function store(Request $request)
    {
        $rules = [
            "title" => ["required"],
            "short_content" => ["required"],
            "content" => ["required"],
        ];
        $this->validate($request, $rules);
        $input = $request->all();

        $slug = Str::slug($request->title);
        $counter = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '_' . $counter;
            $counter++;
        }


        $input['slug'] = $slug;
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->short_content, 150);


        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = $slug . '.' . $image->getClientOriginalExtension();
            $location = public_path('/Posted_News/News/' . $filename);
            Image::make($image)->resize(750, 375)->save($location);
            $input['photo'] = $filename;
        }
        News::create($input);
        session()->flash("success", "Successfully Added");
        return redirect()->route('news_page.dashboard');
    }
}

