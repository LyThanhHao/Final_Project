<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        try {
            $request->validate([
                'cat_name' => 'required',
                'cat_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
    
            $data = $request->only('cat_name');
    
            if ($request->hasFile('cat_image')) {
                $img_name = $request->cat_image->hashName();
                $request->cat_image->move(public_path('uploads/category_image'), $img_name);
                $data['cat_image'] = $img_name;
            }
    
            Category::create($data);
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Error: ' . $e->getMessage());
        }
    }
    

    public function filter(Category $category)
    {
        $user = Auth::user();
        $favorites = $user ? Favorite::where('user_id', $user->id)->get() : null;
        $courses = $category->courses;
        return view('categories.filter', compact('category', 'courses', 'favorites'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $request->validate([
                'cat_name' => 'required',
                'status' => 'required',
                'cat_image' => 'nullable|file|mimes:jpg,jpeg,gif,png,webp,svg|max:20480',
            ]);
    
            $data = $request->only('cat_name', 'status');
    
            if ($request->hasFile('cat_image')) {
                $img_name = $request->cat_image->hashName();
                $request->cat_image->move(public_path('uploads/category_image'), $img_name);
                $data['cat_image'] = $img_name;
            }
    
            $category->update($data);
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Error: ' . $e->getMessage());
        }
    }
    
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
        }
        return redirect()->back()->with('fail', 'Category deletion failed! Something went wrong, please try again!');
    }
}
