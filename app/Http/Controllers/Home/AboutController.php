<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;
use Image;




class AboutController extends Controller
{

    /**
     * Function for Get About Page
     */

     public function AboutPage(){
        $aboutPage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutPage'));
    }


    /**
     * Function for Update Home About
     */


     public function UpdateAbout(Request $request){
        $aboutId = $request->id;
        if ($request->file('about_image')) {

            $image = $request->file('about_image');

            $nameGen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(523,605)->save('upload/home_about/'.$nameGen);

            $saveUrl = 'upload/home_about/'.$nameGen;

            About::findOrFail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $saveUrl
            ]);

            $notification = [
            'message' => 'About Page Updated with Image Successfully',
            'alert-type' => 'success'
            ];
        }else{

            About::findOrFail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = [
            'message' => 'Home Slide Updated without Image Successfully',
            'alert-type' => 'success'
            ];

        }
        
        return redirect()->back()->with($notification);

     }


    /**
     * Function for Show About Data
     */

     public function HomeAbout(){
        $aboutPage = About::find(1);
        return view('frontend.about_page', compact('aboutPage'));
     }

    /**
     * Function for Upload Multiple Image
     * at a one Time.
     */

     public function AboutMultiImage(){
        return view('admin.about_page.multi_image');
     }

     public function StoreMultiImage(Request $request){
        $image = $request->file('multi_image');

        foreach($image as $multiimage){

            $nameGen = hexdec(uniqid()).'.'.$multiimage->getClientOriginalExtension();

            Image::make($multiimage)->resize(220,220)->save('upload/multi_images/'.$nameGen);

            $saveUrl = 'upload/multi_images/'.$nameGen;

            MultiImage::insert([
                'multi_image' => $saveUrl,
                'created_at' => Carbon::now()
            ]);

        } // endForeach

            $notification = [
            'message' => 'Multi image Inserted Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.multi.image')->with($notification);


     }


     public function AllMultiImage(){

            $allMultiImages = MultiImage::all();
            return view('admin.about_page.all_multiImage', compact('allMultiImages'));
     }

     public function EditMultiImage($id){
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));

     }

     public function UpdateMultiImage(Request $request){

        $multiImageId = $request->id;

        if ($request->file('multi_image')) {

            $image = $request->file('multi_image');

            $nameGen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(220,220)->save('upload/multi_images/'.$nameGen);

            $saveUrl = 'upload/multi_images/'.$nameGen;

            MultiImage::findOrFail($multiImageId)->update([
                'multi_image' => $saveUrl
            ]);

            $notification = [
            'message' => 'Multi Image Updated Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

        }

     }

      /**
     * Function for Delete Multi Image
     */

     public function DeleteMultiImage($id){
        $multiId = MultiImage::findOrFail($id);
        $img = $multiId->multi_image;
        unlink($img);
        MultiImage::findOrFail($id)->delete();

        $notification = [
            'message' => 'Multi Images Deleted Successfully',
            'alert-type' => 'success'
            ];

         return redirect()->route('all.multi.image')->with($notification);
     }


}
