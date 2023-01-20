<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.index',compact('products'));
    }

    public function productstatus(Request $request){
        if($request->mode=='true'){
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('Backend.product.create');
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

            'title'                 => 'string|required',
            'summary'               => 'string|required',
            'description'           => 'string|nullable',
            'additional_info'       => 'string|nullable',
            'return_cancellation'   => 'string|nullable',
            'stock'                 => 'nullable|numeric',
            'price'                 => 'nullable|numeric',
            'discount'              => 'nullable|numeric',
            'photo'                 => 'required',
            'size_guide'            => 'nullable',
            'cat_id'                => 'required|exists:categories,id',
            'child_cat_id'          => 'nullable|exists:categories,id',
            'size'                  => 'nullable',
            'vendor_id'             => 'nullable',
            'conditions'            => 'nullable',
            'status'                => 'nullable|in:active,inactive'
        ]);

        $data = $request->all();

        $slug = Str::slug($request->title);
        $slug_count = Product::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        $data['offer_price']=($request->price-(($request->price*$request->discount)/100));
        
       // return $data;
       $products =Product::create($data);
    //    if($products){
    //        return redirect()->route('product.index')->with('success','Product Successfully Created');
    //    }else{
    //        return back()->with('error','something worng!');
    //    }
    return redirect()->route('product.index')->with('success','Product Successfully Created');
  
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $productattr = ProductAttribute::where('product_id',$id)->orderBy('id','DESC')->get();
        return view('Backend.product.product-attribute',compact('product','productattr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('Backend.product.edit',compact('product'));
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
        $product=Product::find($id);
        $this->validate($request,[
            'title'                 => 'string|required',
            'summary'               => 'string|required',
            'description'           => 'string|nullable',
            'additional_info'       => 'string|nullable',
            'return_cancellation'   => 'string|nullable',
            'stock'                 => 'nullable|numeric',
            'price'                 => 'nullable|numeric',
            'discount'              => 'nullable|numeric',
            'cat_id'                => 'required|exists:categories,id',
            'child_cat_id'          => 'nullable|exists:categories,id',
            'size'                  => 'nullable',
            'vendor_id'             => 'nullable',
            'conditions'            => 'nullable',
            'photo'                 => 'nullable',
            'size_guide'            => 'nullable',
            'status'                => 'nullable|in:active,inactive'
        ]);

        $data =$request->all();
        $data['offer_price']=($request->price-(($request->price*$request->discount)/100));
        
       // return $data;
       $products =$product->fill($data)->save();
      return redirect()->route('product.index')->with('success','Product Successfully Updated');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with('success','Product successfully Deleted.');
    }

    public function addProductAttribute(Request $request,$id){

        

        $data = $request->all();

        foreach($data['original_price'] as $key=>$val){
            if(!empty($val)){
                $attribute = new ProductAttribute;
                $attribute['original_price']=$val;
                $attribute['offer_price'] =$data['offer_price'][$key];
                $attribute['stock'] = $data['stock'][$key];
                $attribute['product_id'] = $id;
                $attribute['size'] = $data['size'][$key];
                $attribute->save();
            }
        }
        return redirect()->back()->with('success','Product Attribute successfully added.');
    }

    public function roductAttributeDelete($id){
        ProductAttribute::find($id)->delete();
        return redirect()->back()->with('success','Product  Attribute delete Successfully');
    }
}
