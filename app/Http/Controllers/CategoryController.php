<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->only('create', 'store', 'edit', 'update', 'destroy');
    }
    public function index()
    {
        $categories = Category::latest()->get();
        $newsCount = News::count();
        // Paginate the query here
        $allpost = News::with('categories')->latest()->paginate(10);
        $recentCategories = Category::with('news')->get();
        return view('news_category.index', compact('categories', 'newsCount', 'allpost', 'recentCategories'));
    }

    public function create()
    {
        return view('news_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('news_page.dashboard')->with('success', 'Category created successfully');
    }


    public function edit(Category $category)
    {
        return view('news_category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('news_page.dashboard')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {

        $categories = Category::find($id);
        $categories->delete();
        return redirect()->route('news_page.dashboard')->with('success', 'Category deleted successfully');
    }



}
