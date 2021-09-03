<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class   BannerController extends Controller{

public function index()
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    {
     $result['data']=Banner::all();
       return view ('admin/banner',$result);
    }


public function manage_banner(Request $request,$id=''){
   
 if($id>0){
 $arr=Banner::where(['id'=>$id])->get();
 $result['image']=$arr['0']->image;
 $result['btn_txt']=$arr['0']->btn_txt;
 $result['btn_link']=$arr['0']->btn_link;
 $result['id']=$arr['0']->id;
}else{
     $result['image']='';
     $result['btn_txt']='';
     $result['btn_link']='';
     $result['id']=0;
 
    }

  return view ('admin/manage_banner',$result);
     }

// -------------------//
public function manage_banner_process(Request $request){
//for validation of required elements 
    $request->validate([
       
        'image'=> 'required|mimes:jpeg,jpg,png',
       
    ]);
if($request->post('id')>0){
    $model=Banner::find($request->post('id'));
    $msg="Banner updated";
}else{
    $model=new Banner();
    $msg="Banner inserted";
}
//submitting
if($request->hasfile('image')){
  $image=$request->file('image');
  $ext=$image->extension();
  $image_name=time().'.'.$ext;
  $image->storeAs('/public/media/banner/',$image_name);
  $model->image=$image_name;//image  path goes to database
  

}
    
    $model->btn_txt=$request->post('btn_txt');
    $model->btn_link=$request->post('btn_link');
    
    $model->status=1;
$model->save();
$request->session()->flash('message',$msg);
return redirect('admin/banner');
}



public function delete(Request $request,$id){
         $model=Banner::find($id);
        $model->delete();
          $request->session()->flash('message','Banner deleted');
        return redirect('admin/banner');
      }
    

   public function status(Request $request,$status,$id){
        $model=Banner::find($id);
       $model->status=$status;
       $model->save();
         $request->session()->flash('message','Banner Status Updated');
       return redirect('admin/banner');

     }
 
    }