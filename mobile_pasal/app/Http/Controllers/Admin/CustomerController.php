<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    

  public function index()
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    {
     $result['data']=Customer::all();
       return view ('admin/customer',$result);
    }


public function show(Request $request,$id=''){
 $arr=Customer::where(['id'=>$id])->get();
 $result['customer_list']=$arr['0'];
 
 
return view ('admin/show_customer',$result);
     }

// -------------------//



   public function status(Request $request,$status,$id){
        $model=Customer::find($id);
       $model->status=$status;
       $model->save();
         $request->session()->flash('message','Customer Status Updated');
       return redirect('admin/customer');

     }
 
    }
