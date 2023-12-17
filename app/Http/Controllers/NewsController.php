<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\News;
use Intervention\Image\Facades\Image;
use Session;
use App\Models\Category;
use App\Models\Comment;


class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function homePage()
    {
        $latestPost = News::with('categories')->latest()->first();
        $news = News::with('categories')->latest()->get();
        return view('news_page.homePage', compact('news', 'latestPost'));
    }
    public function index()
    {
        $news = News::with('categories')->get();
        return view('news_page.index', compact('news'));
    }
    public function dashboard()
    {
        // Load the categories with each news item using eager loading
        $news = News::with('categories')->get();
        $newsCount = News::count();
        $categories = Category::all();
        return view('news_page.dashboard', compact('news', 'newsCount', 'categories'));
    }


    public function show($slug)
    {

        $recentPosts = News::orderBy('created_at', 'desc')->take(10)->get();
        $categories = Category::all();
        // Find the current news post by its slug
        $news = News::with('categories')->where('slug', $slug)->first();
        $comments = Comment::with('user')->where('news_id', $news->id)->latest()->get();
        // Check if the news post exists
        if (!$news) {
            // Handle the case where the news post is not found, for example, redirect to a 404 page
            return abort(404);
        }

        // Get all posts for determining prev and next posts
        $allPosts = News::all();

        // Find the index of the current post
        $currentIndex = $allPosts->search(function ($post) use ($news) {
            return $post->id === $news->id;
        });

        // Determine prev and next posts
        $prevPost = $currentIndex > 0 ? $allPosts[$currentIndex - 1] : null;
        $nextPost = $currentIndex < $allPosts->count() - 1 ? $allPosts[$currentIndex + 1] : null;

        return view('news_page.show', compact('news', 'prevPost', 'nextPost', 'categories', 'recentPosts', 'comments'));
    }



    public function create()
    {
        $categories = Category::all();
        $news = new News();
        return view('news_page.create', compact('categories', 'news'));
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

        $news = News::create($input);
        if ($request->category_id) {
            $news->categories()->sync($request->category_id);
        }


        Session::flash('success', 'Congratulations on creating a great Post!');
        return redirect()->route('news_page.dashboard');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $news = News::findOrFail($id);
        return view('news_page.edit', compact('news', 'categories'));
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

        if ($request->category_id) {
            $news->categories()->sync($request->category_id);
        }


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

        // Detach categories before deleting the news post
        $news->categories()->detach();
        // Delete the news post
        $news->delete();

        return redirect()->route('news_page.dashboard')->with('success', 'News deleted successfully');
    }



    public function showByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $posts = $category->news;

        return view('news_page.posts_by_category', compact('category', 'posts'));
    }

}

