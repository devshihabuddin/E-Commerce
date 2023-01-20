<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index(){
        $about = AboutUs::first();
        return view('backend.about.index',compact('about'));
    }


    public function aboutusUpdate(Request $request){
        $about = AboutUs::first();
        $status =$about->update([
            'heading'           => $request->heading,
            'content'           => $request->content,
            'experience'        => $request->experience,
            'happy_customer'    => $request->happy_customer,
            'team_advisor'      => $request->team_advisor,
            'return_customer'   => $request->return_customer,
            'image'             => $request->input('image')
        ]);
        //dd($status);
        if($status){
            return redirect()->back()->with('success', 'About Us successfully Updated');
        }
        else{
            return back()->with('error', 'something wrong!');
        }
        
    }


}
