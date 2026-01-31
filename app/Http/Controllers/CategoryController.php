<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('user_id',auth()->id())
                    ->withCount([
                        'tasks',
                        'tasks as completed_tasks_count' => function ($q) {
                            $q->where('is_completed', 1);
                        }
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('categories.index', ['categories' => $categories]);
    }

    public function workIndex(){
        $categories = Category::where('user_id', auth()->id())
                    ->where('name', 'Work')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);
        return view('categories.workIndex', ['categories' => $categories]);
    }

    public function personalIndex(){
        $categories = Category::where('user_id', auth()->id())
                    ->where('name', 'Personal')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);
        return view('categories.personalIndex', ['categories' => $categories]);
    }

    public function shoppingIndex(){
        $categories = Category::where('user_id', auth()->id())
                    ->where('name', 'Shopping')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);
        return view('categories.shoppingIndex', ['categories' => $categories]);
    }

    public function creaetCategoryForm(){
        return view('categories.create');
    }

    public function storeCategoryForm(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 0;
        while(Category::where('slug', $slug)->exists()){
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Category::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'slug' => $slug,
            'color' => $request->color,
            'icon' => $request->icon,
            'description' => $request->description
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Creaetd Successfully');
    }

    public function updateCategoryFormData($id, Request $request){
        $category = Category::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'color' => 'nullable|string|max:20',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);

        if($category->name !== $request->name){
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;

            while(Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()){
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $category->slug = $slug;
        }

        $category->update([
            'name' => $request->name,
            'color' => $request->icon,
            'icon' => $request->icon,
            'description' => $request->description
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function editCategoryForm($id){
        $category = Category::find($id);
        return view('categories.edit', data: ['category' => $category]);
    }

    public function deleteCategory($id){
        $category = Category::findOrFail($id);

        if($category->user_id !== auth()->id()){
            abort(403, 'UnAuthorized');
        }

        $category->delete();
        
        return redirect()->back()->with('success', 'Category Deleted successfully');
    }
}
