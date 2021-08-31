<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
  public function index()
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    {
     $result['data']=Product::all();
       return view ('admin/product',$result);
    }


public function manage_product(Request $request,$id=''){
    
 if($id>0){
 $arr=Product::where(['id'=>$id])->get();
 $result['category_id']=$arr['0']->category_id;
 $result['name']=$arr['0']->name;
 $result['image']=$arr['0']->image;
 $result['slug']=$arr['0']->slug;
 $result['brand']=$arr['0']->brand;
 $result['model']=$arr['0']->model;
 $result['short_desc']=$arr['0']->short_desc;
 $result['desc']=$arr['0']->desc;
 $result['keywords']=$arr['0']->keywords;
 $result['technical_specification']=$arr['0']->technical_specification;
 $result['uses']=$arr['0']->uses;
 $result['warranty']=$arr['0']->warranty;
 $result['status']=$arr['0']->status;

$result['id']=$arr['0']->id;

///////////////////////////////////////////////////
$result['productAttrArr']=DB::table('product_attributes')->where(['product_id'=>$id])->get();

$productImagesArr=DB::table('product_images')->where(['product_id'=>$id])->get();
if(!isset($productImagesArr[0])){
  $result['productImagesArr'][0]['images']='';
  $result['productImagesArr'][0]['id']='';

}else{
  $result['productImagesArr']=$productImagesArr;
}


}else{
    $result['category_id']='';
     $result['name']='';
     $result['slug']='';
     $result['image']='';
     $result['brand']='';
     $result['model']='';
     $result['short_desc']='';
     $result['desc']='';
     $result['keywords']='';
     $result['technical_specification']='';
     $result['uses']='';
     $result['warranty']='';
     $result['status']='';
     $result['id']=0;

     $result['productAttrArr'][0]['id']='';
     $result['productAttrArr'][0]['product_id']='';
     $result['productAttrArr'][0]['sku']='';
     $result['productAttrArr'][0]['image1']='';
     $result['productAttrArr'][0]['mrp']='';
     $result['productAttrArr'][0]['price']='';
     $result['productAttrArr'][0]['quantity']='';
     $result['productAttrArr'][0]['size_id']='';
     $result['productAttrArr'][0]['color_id']='';
     $result['productImagesArr'][0]['images']='';
     $result['productImagesArr'][0]['id']='';
     
 }
 $result['category']=DB::table('categories')->where(['status'=>1])->get();
  
 $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();
 $result['colors']=DB::table('colors')->where(['status'=>1])->get();
 return view ('admin/manage_product',$result);
     }

     

// -------------------//
public function manage_product_process(Request $request){
 
  if($request->post('id')>0){
    $image_validation="mimes:jpeg,jpg,png";
}else{
  $image_validation="required|mimes:jpeg,jpg,png";
}
   


$request->validate([
        'name'=>'required',
        'image'=> $image_validation,

        'slug'=>'required|unique:products,slug,'.$request->post('id'),
        'image1.*'=>'mimes:jpeg,jpg,png',
        'images.*'=>'mimes:jpeg,jpg,png'

      ]);
    $paidarr=$request->post('paid');
    $skuarr=$request->post('sku');
    
    $mrparr=$request->post('mrp');
    $pricearr=$request->post('price');
    $qtyarr=$request->post('quantity');
    $sizearr=$request->post('size_id');
    $colorarr=$request->post('color_id');
    
    
    foreach($skuarr as $key=>$val){
     $check=DB::table('product_attributes')->
     where('sku','=',$skuarr[$key])->
     where('id','!=',$paidarr[$key])->
      get();
    
      if(isset($check[0])){
        $request->session()->flash('sku_error',$skuarr[$key].'SKU already used');
      return redirect(request()->headers->get('referer'));
      }
    }

    if($request->post('id')>0){
    $model=Product::find($request->post('id'));
    $msg="Product updated";
}else{   
    $model=new Product();
    $msg="Product inserted";
}

 
if($request->hasfile('image')){
  $image=$request->file('image');
  $ext=$image->extension();
  $image_name=time().'.'.$ext;
  $image->storeAs('/public/media',$image_name);
  $model->image=$image_name;//image  path goes to database


}


    $model->category_id=$request->post('category_id');
    $model->name=$request->post('name');
    $model->slug=$request->post('slug');

    $model->brand=$request->post('brand');
    $model->model=$request->post('model');
    $model->short_desc=$request->post('short_desc');
    $model->desc=$request->post('desc');
    $model->keywords=$request->post('keywords');
    $model->technical_specification=$request->post('technical_specification');
    $model->uses=$request->post('uses');
    $model->warranty=$request->post('warranty');
     $model->status=1;
   $model->save();
   $pid=$model->id;
 
 
   /*Product att start */
 foreach($skuarr as $key=>$val){
 
  $productAttrArr['product_id']=$pid;
  $productAttrArr['sku']=$skuarr[$key];
  
  $productAttrArr['mrp']=(int)$mrparr[$key];;
  $productAttrArr['price']=(int)$pricearr[$key];;
  $productAttrArr['quantity']=(int)$qtyarr[$key];
  
  if($colorarr[$key]==''){
    $productAttrArr['color_id']=0;
  }
  else{ 
    $productAttrArr['color_id']=$colorarr[$key];
  }
  
  if($sizearr[$key]==''){
    $productAttrArr['size_id']=0;
  }
  else{
    $productAttrArr['size_id']=$sizearr[$key];
  }

if($request->hasFile("image1.$key")){
 
$image1=$request->file("image1.$key");
$rand=rand('111111111','999999999');
  $ext=$image1->extension();
  $image_name=$rand.'.'.$ext;
  $request->file("image1.$key")->storeAs('/public/media',$image_name);
  $productAttArr['image1']=$image_name;
  } 
 
if($paidarr[$key]!=''){
  DB::table('product_attributes')->where(['id'=>$paidarr[$key]])->update($productAttrArr);
 }else{
 DB::table('product_attributes')->insert($productAttrArr);
}

}
//  product att stop


//////product images
$piidarr=$request->post('piid');
foreach($piidarr as $key=>$val ){
 $productImagesArr['product_id']=$pid;
  if($request->hasFile("images.$key")){
 
    $images=$request->file("images.$key");
    $rand=rand('111111111','999999999');
      $ext=$images->extension();
      $image_name=$rand.'.'.$ext;
      $request->file("images.$key")->storeAs('/public/media',$image_name);
      $productImagesArr['images']=$image_name;
    
    
      if($piidarr[$key]!=''){
        DB::table('product_images')->where(['id'=>$piidarr[$key]])->update($productImagesArr);
       }else{
       DB::table('product_images')->insert($productImagesArr);
      }
      
    } 
}
/////////////////end images


$request->session()->flash('message',$msg);
return redirect('admin/product');
}



public function delete(Request $request,$id){
         $model=Product::find($id);
        $model->delete();
          $request->session()->flash('message','Product deleted');
        return redirect('admin/product');
      }
    

      public function product_attr_delete(Request $request,$paid,$pid){
        DB::table('product_attributes')->where(['id'=>$paid])->delete();
       return redirect('admin/product/manage_product/'.$pid);
     }
    

     
     public function product_images_delete(Request $request,$paid,$pid){
  
      DB::table('product_images')->where(['id'=>$paid])->delete();
     return redirect('admin/product/manage_product/'.$pid);
   }
  



   public function status(Request $request,$status,$id){
        $model=Product::find($id);
       $model->status=$status;
       $model->save();
         $request->session()->flash('message','Product Status Updated');
       return redirect('admin/product');

     }
 
    }