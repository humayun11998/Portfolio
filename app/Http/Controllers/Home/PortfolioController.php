<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Carbon\Carbon;
use Image;


class PortfolioController extends Controller
{
    /**
     * Function for All Portfolio
     */

    public function AllPortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function AddPortfolio(){
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request){
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio name is Required',
            'portfolio_title.required' => 'Portfolio title is Required',
        ]);


            $image = $request->file('portfolio_image');

            $nameGen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(1020,519)->save('upload/portfolio_image/'.$nameGen);

            $saveUrl = 'upload/portfolio_image/'.$nameGen;

            Portfolio::insert([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $saveUrl,
                'created_at' => Carbon::now()
            ]);

            $notification = [
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
            ];

            return redirect()->route('all.portfolio')->with($notification);


}

     /**
     * Function for Update Portfolio
     */


public function EditPortfolio($id){
    $editPortfolio = Portfolio::findOrFail($id);
    return view('admin.portfolio.portfolio_edit', compact('editPortfolio'));
}


public function updatePortfolio(Request $request)
{
    $portfolioId = $request->id;

    // Validate the incoming request data
    $request->validate([
        'portfolio_name' => 'required|string|max:255',
        'portfolio_title' => 'required|string|max:255',
    ]);

    // Find the existing Portfolio record
    $portfolio = Portfolio::findOrFail($portfolioId);

    // Handle image upload if a new image is provided
    if ($request->file('portfolio_image')) {
        // Retrieve the old image path
        $oldImage = $portfolio->portfolio_image;

        $image = $request->file('portfolio_image');
        $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        // Resize and save the new image
        Image::make($image)->resize(1020, 519)->save('upload/portfolio_image/' . $nameGen);

        $saveUrl = 'upload/portfolio_image/' . $nameGen;

        // Delete the old image if it exists
        if ($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage)); // Delete the old image
        }

        // Update the portfolio with the new image
        $portfolio->update([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $saveUrl,
        ]);

        $notification = [
            'message' => 'Portfolio Updated with Image Successfully',
            'alert-type' => 'success'
        ];
    } else {
        // Update the portfolio without changing the image
        $portfolio->update([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
        ]);

        $notification = [
            'message' => 'Portfolio Updated without Image Successfully',
            'alert-type' => 'success'
        ];
    }

    return redirect()->route('all.portfolio')->with($notification);
}
    /**
     * Function for Delete Portfolio
     */

     public function DeletePortfolio($id){
        $portfolioId = Portfolio::findOrFail($id);
        $img = $portfolioId->portfolio_image;
        unlink($img);
        Portfolio::findOrFail($id)->delete();

        $notification = [
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
            ];

         return redirect()->route('all.portfolio')->with($notification);
     }


     public function PortfolioDetails($id){
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));
     }


}
