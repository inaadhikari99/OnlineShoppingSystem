<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    
    public function index(Request $request){
   $result['home_categories']=DB::table('categories')
   ->where(['status'=>1])
   ->where(['is_home'=>1])
     ->get();
  

    foreach($result['home_categories']as $list){
     
       $result['home_categories_product'][$list->id]=DB::table('products')
        ->where(['status'=>1])
        ->where(['category_id'=>$list->id])
       ->get();

       foreach($result['home_categories_product'][$list->id] as $list1){
        
          $result['home_product_attr'][$list1->id]=DB::table('product_attributes')
       
        ->leftJoin('colors','colors.id','=','product_attributes.color_id')
        ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
        ->where(['product_attributes.product_id'=>$list1->id])
          ->get();  
        }
  
      }
      //for result to show in front page banner
      $result['banner']=DB::table('banners')
      ->where(['status'=>1])
        ->get();
       
   
    return view ('front.home',$result);
    }

    public function product(Request $request,$slug)
    {
     
       $result['product']=DB::table('products')
        ->where(['status'=>1])
        ->where(['slug'=>$slug])
       ->get();

       foreach($result['product']as $list1){
        
          $result['product_attr'][$list1->id]=DB::table('product_attributes')
       
        ->leftJoin('colors','colors.id','=','product_attributes.color_id')
        ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
        ->where(['product_attributes.product_id'=>$list1->id])
          ->get();  
        }
  //  echo"<pre>";
  //  print_r($result);
  foreach($result['product']as $list1){
        
    $result['product_images'][$list1->id]=DB::table('product_images')
 
 
  ->where(['product_images.product_id'=>$list1->id])
    ->get();  
  }
  


      return view ('front.product',$result);
}

public function add_to_cart(Request $request)
{
  if($request->session()->has('USER_LOGIN')){
    $uid=$request->session()->get('USER_LOGIN');
    $user_type="Reg";

  }
  else{
    $uid=getUserTempId();
    $user_type="NotReg";
  }
  $size_id=$request->post('size_id');
  $color_id=$request->post('color_id');
  $pqty=$request->post('pqty');
  $product_id=$request->post('product_id');

  $result=DB::table('product_attributes')
  ->select('product_attributes.id')
  
  ->leftJoin('colors','colors.id','=','product_attributes.color_id')
  ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
  
  ->where(['product_id'=>$product_id])
        ->where(['sizes.size'=>$size_id])
        ->where(['colors.color'=>$color_id])
        ->get();
$product_attr_id=$result[0]->id;
$check=DB::table('cart')
->where(['user_id'=>$uid])
->where(['user_type'=>$user_type])
->where(['product_id'=>$product_id])
->where(['product_attr_id'=>$product_attr_id])
->get();
if(isset($check[0])){
  $update_id=$check[0]->id;

  if($pqty==0){
    DB::table('cart')
->where(['id'=>$update_id])
->delete();
$msg="removed";

  }else{

    DB::table('cart')
    ->where(['id'=>$update_id])
    ->update(['quantity'=>$pqty]);
    $msg="updated";

  }
}
  else{
  $id=DB::table('cart')->insertGetId([
    'user_id'=>$uid,
    'user_type'=>$user_type,
    'product_id'=>$product_id,
    'product_attr_id'=>$product_attr_id,
    'quantity'=>$pqty,
    'added_on'=>date('Y-m-d h:i:s')
  ]);
  $msg="added";
  }


return response()->json(['msg'=>$msg]);


}

public function cart(Request $request)
    {
      if($request->session()->has('USER_LOGIN')){
        $uid=$request->session()->get('USER_LOGIN');
        $user_type="Reg";
    
      }
      else{
        $uid=getUserTempId();
        $user_type="NotReg";
      }
      $result['list']=DB::table('cart')
      ->leftJoin('products','products.id','=','cart.product_id')
      ->leftJoin('product_attributes','product_attributes.id','=','cart.product_attr_id')
      ->leftJoin('colors','colors.id','=','product_attributes.color_id')
       ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
  
->where(['user_id'=>$uid])
->where(['user_type'=>$user_type])
->select('cart.quantity','products.name','products.image','sizes.size','colors.color','product_attributes.price','products.slug','products.id as pid','product_attributes.id as pa_id')
->get();

return view("front.cart",$result);

    }  

     

  }