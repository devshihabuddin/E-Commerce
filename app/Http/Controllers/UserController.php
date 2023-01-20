<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('Backend.user.index',compact('users'));
    }

    public function userstatus(Request $request){
        if($request->mode=='true'){
            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('Backend.user.create');
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

            'full_name' => 'string|required',
            'username'  => 'string|nullable',
            'email'     => 'string|required|unique:users,email',
            'phone'     => 'numeric|nullable',
            'password'  => 'min:3|required',
            'photo'     => 'string|nullable',
            'address'   => 'string|nullable',
            'role'      => 'required|in:admin,customer,vendor',
            'status'    => 'required|in:active,inactive'
        ]);

        $user=$request->all();
        $user['password']= Hash::make($request->password);
       // return $user;
       $data = User::create($user);
       return redirect()->route('user.index')->with('success','User Created Successfully');
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
        $user = User::find($id);
        return view('Backend.user.edit',compact('user'));
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
        $users = User::find($id);
        $this->validate($request,[

            'full_name' => 'string|required',
            'username'  => 'string|nullable',
            'email'     => 'string|required|exists:users,email',
            'phone'     => 'numeric|nullable',
            'photo'     => 'string|nullable',
            'address'   => 'string|nullable',
            'role'      => 'required|in:admin,customer,vendor',
            'status'    => 'required|in:active,inactive'
        ]);

        $user=$request->all();
       // return $user;
       $data = $users->fill($user)->save();
       return redirect()->route('user.index')->with('success','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','User deleted Successfully.');
    }
}
