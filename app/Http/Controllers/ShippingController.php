<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::orderBy('id','DESC')->get();
        return view('backend.Shipping.index',compact('shippings'));
    }

    public function shippingStatus(Request $request){
        if($request->mode=='true'){
            DB::table('shippings')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('shippings')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status','status'=>true]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Shipping.create');
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
            'shipping_address' => 'required|string',
            'delivery_time'    => 'required|string',
            'delivery_charge'  => 'nullable|numeric',
            'status'           => 'nullable|in:active,inactive'
        ]);
        $data = $request->all();
        Shipping::create($data);
        return redirect()->route('shipping.index')->with('success','Shipping Successfully Done');
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
        $shipping = Shipping::find($id);
        return view('backend.Shipping.edit',compact('shipping'));
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
        $shipping = Shipping::find($id);
        $this->validate($request,[
            'shipping_address' => 'required|string',
            'delivery_time'    => 'required|string',
            'delivery_charge'  => 'nullable|numeric',
            'status'           => 'nullable|in:active,inactive'
        ]);
        $data = $request->all();
        $shipping->fill($data)->save();
        return redirect()->route('shipping.index')->with('success','Shipping Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shipping::find($id)->delete();
        return back()->with('success','Shipping history Successfully deleted.');
    }
}
