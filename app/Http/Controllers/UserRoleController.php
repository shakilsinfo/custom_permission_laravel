<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\ControllerNames;
use Validator;
use Session;
class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata'] = UserRole::orderBy('role_name', 'asc')->paginate(10);
        $data['getControllerList'] = ControllerNames::get();
        return view('acl.user-role-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input  = $request->all();
        $validator = Validator::make($request->all(), [
                    'role_name' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $newData['role_name'] = $request->role_name;
        if(isset($input['access'])){
            $newData['user_role'] = json_encode($input['access']);
        }

        try{
            $bug=0;
            $insert= UserRole::create($newData);
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }

        if($bug==0){
            Session::flash('flash_message','User Role Successfully Saved !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','danger');
        }
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
        //
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
        $data=UserRole::findOrFail($id);
        $input=$request->all();
        $validator = Validator::make($input, [
                    'role_name' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $newData['role_name'] = $request->role_name;
        if(isset($input['access'])){
            $newData['user_role'] = json_encode($input['access']);
        }else{
            $newData['user_role'] = null;
        }

        try{
            $bug=0;
            $data->update($newData);
        }catch(\Exception $e){
            $bug = $e->getMessage();
        }

        if($bug==0){
            Session::flash('flash_message','User Role Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UserRole::findOrFail($id);

        try
        {
            $bug=0;
            $delete = $data->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }

        if($bug==0){

            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect('user-type')->with('status_color','danger');

        }else{

            Session::flash('flash_message',$bug);
            return redirect()->back()->with('status_color','danger');
        }
    }
}
