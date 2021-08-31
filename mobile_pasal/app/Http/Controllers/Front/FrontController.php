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
         
   
    return view ('front.home',$result);
    }
}