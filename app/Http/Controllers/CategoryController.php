<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required',
        ]);

        $check = Category::create($request->all());
        
        if ($check) {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
        }
        return redirect()->back()->with('fail', 'Category creation failed! Something went wrong, please try again!');
    }

    public function filter(Category $category)
    {
        $courses = $category->courses;
        return view('categories.filter', compact('category', 'courses'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'cat_name' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();

        $check = $category->update($data);

        if ($check) {
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
        }
        return redirect()->back()->with('fail', 'Category update failed! Something went wrong, please try again!');
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
        }
        return redirect()->back()->with('fail', 'Category deletion failed! Something went wrong, please try again!');
    }
}
