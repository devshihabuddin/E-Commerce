<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('backend.banners.index',compact('banners'));
    }

    public function bannerstatus(Request $request){
        if($request->mode=='true'){
            DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'title'        => 'required',
            'description'  => 'string|nullable',
            'photo'        => 'required',
            'condition'    => 'nullable|in:banner,promo',
            'status'       => 'nullable|in:active,inactive'
        ]);
        // $data = $request->all();
        $banners = Banner::create($request->all());
    
        // if($banners){
        //     return redirect()->route('banner.index')->with('success','Successfully Created Banner');
        // }else{
        //     return back()->with('error','Something went wrong');
        // }
        return redirect()->route('banner.index')->with('success','Successfully Created Banner');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('backend.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $this->validate($request,[
            'title'       => 'required',
            'description' => 'string|nullable',
            'photo'       => 'required',
            'condition'   => 'nullable|in:banner,promo',
            'status'      => 'nullable|in:active,inactive'
        ]);
        // $data = $request->all();
        $banners = $banner->fill($request->all())->save();
    
        return redirect()->route('banner.index')->with('success','Successfully Updated Banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();
        return redirect()->back()->with('success','Successfully deleted');
    }
}
