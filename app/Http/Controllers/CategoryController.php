<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->only('create', 'store', 'edit', 'update', 'destroy');
    }
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.index', compact('categories'));
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
