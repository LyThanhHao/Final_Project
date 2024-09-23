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
        $request->validate([
            'cat_name' => 'required',
            'cat_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'cat_name.required' => 'The category name is required.',
            'cat_image.required' => 'The category image is required.',
            'cat_image.image' => 'The category image must be an image.',
            'cat_image.mimes' => 'The category image must be a valid image file.',
            'cat_image.max' => 'The category image must be less than 2MB.',
        ]);

        $data = $request->only('cat_name');

        if ($request->hasFile('cat_image')) {
            $img_name = $request->cat_image->hashName();
            $request->cat_image->move(public_path('uploads/category_image'), $img_name);
            $data['cat_image'] = $img_name;
        }

        $check = Category::create($data);
        
        if ($check) {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
        }
        return redirect()->back()->with('fail', 'Category creation failed! Something went wrong, please try again!');
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
        $request->validate([
            'cat_name' => 'required',
            'status' => 'required',
            'cat_image' => 'nullable|file|mimes:jpg,jpeg,gif,png,webp,svg',
        ],[
            'cat_name.required' => 'The category name is required.',
            'status.required' => 'The status is required.',
            'cat_image.file' => 'The category image must be a file.',
            'cat_image.mimes' => 'The category image must be a valid image file.',
            'cat_image.max' => 'The category image must be less than 2MB.',
        ]);

        $data = $request->only('cat_name', 'status');

        if ($request->hasFile('cat_image')) {
            $img_name = $request->cat_image->hashName();
            $request->cat_image->move(public_path('uploads/category_image'), $img_name);
            $data['cat_image'] = $img_name;
        }

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
