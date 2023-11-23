<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\News;
use Intervention\Image\Facades\Image;
use Session;

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
        $newsCount = News::count();
        return view('news_page.dashboard', compact('news', 'newsCount'));
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
        Session::flash('success', 'Congratulations on creating a great Post!');
        return redirect()->route('news_page.dashboard');
    }
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news_page.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            "title" => ["required"],
            "short_content" => ["required"],
            "content" => ["required"],
        ];

        $this->validate($request, $rules);

        $input = $request->all();
        $news = News::findOrFail($id);

        // Check if the title has been changed
        if ($request->title !== $news->title) {
            $slug = Str::slug($request->title);
            $counter = 1;

            while (News::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = Str::slug($request->title) . '_' . $counter;
                $counter++;
            }

            $input['slug'] = $slug;
        }

        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->short_content, 150);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = $news->slug . '.' . $image->getClientOriginalExtension();
            $location = public_path('/Posted_News/News/' . $filename);
            Image::make($image)->resize(750, 375)->save($location);
            $input['photo'] = $filename;
        }

        $news->update($input);

        Session::flash('success_update', 'Successfully Updated!');
        return redirect()->route('news_page.dashboard');
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news_page.dashboard')->with('error', 'News not found');
        }
        // Delete the photo file
        if ($news->photo) {
            $photoPath = public_path('/Posted_News/News/' . $news->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        // Delete the news post
        $news->delete();

        return redirect()->route('news_page.dashboard')->with('success', 'News deleted successfully');
    }




}

