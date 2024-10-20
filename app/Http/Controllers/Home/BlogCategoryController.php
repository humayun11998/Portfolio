<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use image;

class BlogCategoryController extends Controller
{
    /**
     * Function for All Blog Category
     */

    public function AllBlogCategory(){
        $blogCategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('blogCategory'));
    }

    public function AddBlogCategory(){
        return view('admin.blog_category.blog_category_add');
    }

    public function StoreBlogCategory(Request $request){
        $request->validate([
            'category_name' => 'required'
        ]);

        BlogCategory::insert([
            'blog_category' => $request->category_name
        ]);

        $notification = [
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.blog.category')->with($notification);
    }


    public function EditBlogCategory($id){
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.blog_category_edit', compact('blogCategory'));
    }

    public function UpdateBlogCategory(Request $request){

        $categoryId = $request->id;

        $request->validate([
            'category_name' => 'required'
        ]);

        $category = BlogCategory::findOrFail($categoryId);

        $category->update([
            'blog_category' => $request->category_name
        ]);

        $notification = [
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog.category')->with($notification);

    }

    public function DeleteBlogCategory($id){

        BlogCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
            ];

         return redirect()->route('all.blog.category')->with($notification);
    }


}
