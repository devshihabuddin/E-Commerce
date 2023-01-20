<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('Backend.Coupon.index',compact('coupons'));
    }

    public function couponStatus(Request $request){
        if($request->mode=='true'){
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Staus', 'status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Coupon.create');
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
            'code'  => 'required|min:2',
            'type'  => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status'=> 'required|in:active,inactive'
        ]);
        $data = $request->all();
        Coupon::create($data);
        return redirect()->route('coupon.index')->with('success','Coupon Created Successfully');
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
        $coupon = Coupon::find($id);
        return view('Backend.Coupon.edit',compact('coupon'));
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
        $coupon = Coupon::find($id);
        $this->validate($request,[
            'code'  => 'required|min:2',
            'type'  => 'required|in:fixed,percent',
            'value' => 'nullable|numeric',
            'status'=> 'nullable|in:active,inactive'
        ]);
        $data = $request->all();
        $updatecoupon=$coupon->fill($data)->save();
        return redirect()->route('coupon.index')->with('success','Coupon Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return back()->with('success','Coupon Successfully Deleted!');
    }
}
