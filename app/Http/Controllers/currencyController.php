<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class currencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function currencyLoad(Request $request){
        session()->put('currency_code',$request->currency_code);
        $currency = Currency::where('code',$request->currency_code)->first();
        session()->put('currency_symbol',$currency->symbol);
        session()->put('currency_exchange_rate',$currency->exchange_rate);
        $response['status'] = true;
        return $response;
     }
    public function index()
    {
        $currencies = Currency::latest()->get();
        return view('backend.currency.index',compact('currencies'));
    }

    public function currencyStatus(Request $request){
        if($request->mode=='true'){
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.currency.create');
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
            'name'          => 'required|string',
            'symbol'        => 'required|string',
            'exchange_rate' => 'numeric|string',
            'code'          => 'required',
            'status'        => 'nullable|in:active,inadctive',
        ]);
        $data = $request->all();

        $status = Currency::create($data);
        return redirect()->route('currency.index')->with('success','CUrrency Successfully Created:)');
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
        $currency = Currency::find($id);
        return view('backend.currency.edit',compact('currency'));
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
       // dd($request->all());
        $currency = Currency::find($id);
        $this->validate($request,[
            'name'          => 'required|string',
            'symbol'        => 'required|string',
            'exchange_rate' => 'numeric|string',
            'code'          => 'required',
            'status'        => 'nullable|in:active,inadctive',
        ]);
        $data = $request->all();

        $status=$currency->fill($data)->save();
        return redirect()->route('currency.index')->with('success','Currency Updated Successfully :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Currency::find($id)->delete();
        return redirect()->back()->with('success','Currency successfully deleted');
    }
}
