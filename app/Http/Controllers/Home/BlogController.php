<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class BlogController extends Controller
{
    /**
     * Function for Blog Page
     */

     public function AllBlog(){
        $allBlogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('allBlogs'));
     }

     public function AddBlog(){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_add', compact('categories'));
     }

     public function StoreBlog(Request $request){
        $request->validate([
            'blog_category_id' => 'required|integer|min:1',
            'blog_title' => 'required',
        ]);


            $image = $request->file('blog_image');

            $nameGen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(430,327)->save('upload/blog_image/'.$nameGen);

            $saveUrl = 'upload/blog_image/'.$nameGen;

            Blog::insert([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
                'blog_image' => $saveUrl,
                'created_at' => Carbon::now()
            ]);

            $notification = [
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.blog')->with($notification);
     }

     public function EditBlog($id){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.blogs_edit', compact('blog','categories'));
     }

     public function UpdateBlog(Request $request){

    $blogId = $request->id;

    // Validate the incoming request data
    $request->validate([
        'blog_category_id' => 'required|integer|min:1',
        'blog_title' => 'required',
    ]);

    // Find the existing blog record
    $portfolio = Blog::findOrFail($blogId);

    // Handle image upload if a new image is provided
    if ($request->file('blog_image')) {
        // Retrieve the old image path
        $oldImage = $portfolio->blog_image;

        $image = $request->file('blog_image');
        $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        // Resize and save the new image
        Image::make($image)->resize(430,327)->save('upload/blog_image/' . $nameGen);

        $saveUrl = 'upload/blog_image/' . $nameGen;

        // Delete the old image if it exists
        if ($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage)); // Delete the old image
        }

        // Update the portfolio with the new image
        $portfolio->update([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_description' => $request->blog_description,
            'blog_tags' => $request->blog_tags,
            'blog_image' => $saveUrl,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Blog Updated with Image Successfully',
            'alert-type' => 'success'
        ];
    } else {
        // Update the portfolio without changing the image
        $portfolio->update([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_description' => $request->blog_description,
            'blog_tags' => $request->blog_tags,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Blog Updated without Image Successfully',
            'alert-type' => 'success'
        ];
    }

    return redirect()->route('all.blog')->with($notification);

     }

     public function DeleteBlog($id){
        $blogId = Blog::findOrFail($id);
        $img = $blogId->blog_image;
        unlink($img);
        Blog::findOrFail($id)->delete();

        $notification = [
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
            ];

         return redirect()->route('all.blog')->with($notification);
     }

     public function BlogDetails($id){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allBlogs = Blog::latest()->limit(5)->get();
        $blog = Blog::findOrFail($id);
        return view('frontend.blogs_details', compact('blog','allBlogs','categories'));
     }

     public function CategoryBlog($id){
         $blogPost = Blog::where('blog_category_id',$id)->orderBy('id', 'DESC')->get();
         $allBlogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $categoryName = BlogCategory::findOrFail($id);
        return view('frontend.category_blog_details', compact('blogPost','allBlogs','categories','categoryName'));

     }

     public function HomeBlog(){
        $allBlogs = Blog::latest()->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('frontend.blog', compact('allBlogs', 'categories'));
     }
}
