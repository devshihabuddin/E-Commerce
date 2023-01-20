<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->get();
        return view('backend.brand.index',compact('brands'));
    }

    public function brandstatus(Request $request){
        if($request->mode=='true'){
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('brands')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status','status'=>true]);
    }
   
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->all();
        $this->validate($request,[
            'title' => 'nullable|string',
            'photo' => 'required',
            'status'=> 'nullable|in:active,inadctive',
        ]);
        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;

        $status = Brand::create($data);
        return redirect()->route('brand.index')->with('success','Brand Successfully Created:)');
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
        $brand = Brand::find($id);
        return view('backend.brand.edit',compact('brand'));
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
       $brand = Brand::find($id);

        $this->validate($request,[
            'title' => 'nullable|string',
            'photo' => 'required',
            'status'=> 'nullable|in:active,inadctive',
        ]);
        $data = $request->all();

        
        $status = $brand->fill($data)->save();
        return redirect()->route('brand.index')->with('success','Brand Successfully Updated:)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->back()->with('success','Brand Successfully Deleted');
    }
}
