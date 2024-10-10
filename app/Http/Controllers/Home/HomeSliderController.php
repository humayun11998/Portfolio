<?php

namespace App\Http\Controllers\Home;

use App\Models\HomeSlide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class HomeSliderController extends Controller
{
    /**
     * Function for Get Home Slide
     */

    public function HomeSlider(){
        $homeSlide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeSlide'));
    }

     /**
     * Function for Update Home Slide
     */


     public function UpdateSlider(Request $request){
        $slide_id = $request->id;
        if ($request->file('home_slide')) {

            $image = $request->file('home_slide');

            $nameGen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(636,852)->save('upload/home_slide/'.$nameGen);

            $saveUrl = $nameGen;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'videos_url' => $request->video_url,
                'home_slide' => $saveUrl
            ]);

            $notification = [
            'message' => 'Home Slide Updated with Image Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

        }else{

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'videos_url' => $request->video_url
            ]);

            $notification = [
            'message' => 'Home Slide Updated without Image Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
     }
}
