<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use App\Models\ControllerNames;
use App\Library\ACL;
use Route;
class GetControllerNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['getControllerName'] = ACL::getAllController();

        
        $data['allControllerList'] = ControllerNames::paginate(20);

        $data['allControllerListJson'] = json_decode(json_encode($data['allControllerList']),True);
        return view('acl.controller-list',$data);
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

        try{
            $bug=0;
            if(isset($input['access'])){
           
               $controller_arr = array();
               foreach ($input['access'] as $key => $value) {
                   

                   $controller_arr['full_name'] = $value['controller_name'];
                   $controller_arr['surname'] = $value['sur_name'];

                   ControllerNames::create($controller_arr);
                   
               }
               
            }

        }catch(\Exception $e){
            $bug=$e->getMessage();
        }

        if($bug==0){
            Session::flash('flash_message','Controller Name Successfully Saved !');
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
        $data=ControllerNames::findOrFail($id);
        $input=$request->all();
        $validator = Validator::make($input, [
                    'surname' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $newData['surname'] = $request->surname;
        

        try{
            $bug=0;
            $data->update($newData);
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Controller List Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found !');
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
        //
    }
}
