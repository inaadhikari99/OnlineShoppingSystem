<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
  public function index()
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    {
     $result['data']=Coupon::all();
       return view ('admin/coupon',$result);
    }


public function manage_coupon(Request $request,$id=''){
    
 if($id>0){
 $arr=Coupon::where(['id'=>$id])->get();
 $result['title']=$arr['0']->title;
 $result['code']=$arr['0']->code;
 $result['value']=$arr['0']->value;
$result['id']=$arr['0']->id;


}else{
     $result['title']='';
     $result['code']='';
     $result['value']='';
     $result['id']=0;
     
 }
  return view ('admin/manage_coupon',$result);
     }

// -------------------//
public function manage_coupon_process(Request $request){

    $request->validate([
        'title'=>'required',
        'value'=>'required',
         //for unique things
        'code'=>'required|unique:coupons,code,'.$request->post('id'),
   
      ]);
if($request->post('id')>0){
    $model=Coupon::find($request->post('id'));
    $msg="Coupon updated";
}else{
    $model=new Coupon();
    $msg="Coupon inserted";
}
    
    $model->title=$request->post('title');
    $model->code=$request->post('code');
    $model->value=$request->post('value');
   $model->status=1;  
$model->save();
$request->session()->flash('message',$msg);
return redirect('admin/coupon');
}



public function delete(Request $request,$id){
         $model=Coupon::find($id);
        $model->delete();
          $request->session()->flash('message','Coupon deleted');
        return redirect('admin/coupon');
      }
    

   public function status(Request $request,$status,$id){
        $model=Coupon::find($id);
       $model->status=$status;
       $model->save();
         $request->session()->flash('message','Coupon Status Updated');
       return redirect('admin/coupon');

     }
 
    }