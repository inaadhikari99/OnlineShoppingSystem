@extends('admin/layout')
@section('page_title','Manage Product') 
@section('container')
@section('product_select','active')
@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif

<h1 class="mb10" > Manage Product</h1>
@error('images.*')
                  <div class="alert alert-danger" role="alert">
                     {{$message}}
                  </div>
                  @enderror 
  
                  @error('sku_error')
                  <div class="alert alert-danger" role="alert">
                     {{$message}}
                  </div>
                  @enderror 



<a href="{{url('admin/product')}}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
<div class="col-md-12">
<form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data" >
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               @csrf
               <div class="form-group">
                  <label for="name" class="control-label mb-1">Name</label>
                  <input id="name" name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                  @error('category_name')
                  <div class="alert alert-danger" role="alert">
                     {{$message}}
                  </div>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="slug" class="control-label mb-1"> Slug</label>
                  <input id="slug" value="{{$slug}}" name="slug"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                  @error('slug')
                  <div class="alert alert-danger" role="alert">
                     {{$message}}
                  </div>
                  @enderror 
               </div>
               <div class="form-group">
                  <label for="image" class="control-label mb-1"> Image</label>
                  <input id="image"  name="image"  type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                  @error('image')
                  <div class="alert alert-danger" role="alert">
                     {{$message}}
                  </div>
                  @enderror 
                  @if($image!='')<a href="{{asset('storage/media/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/media/'.$image)}}"/></a>
                        @endif
                  
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="category_id" class="control-label mb-1"> Category</label>
                        <select id="category_id"  name="category_id"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                           >
                           <option value=""> Select Categories  </option>
                           @foreach   ($category as $list)
                           <option value="{{$list->id}}"> {{$list->category_name}}  </option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label for="brand" class="control-label mb-1"> Brand</label>
                        <input id="brand" value="{{$brand}}" name="brand"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                     </div>
                     <div class="col-md-4">
                        <label for="model" class="control-label mb-1"> Model</label>
                        <input id="model" value="{{$model}}" name="model"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="short_desc" class="control-label mb-1"> Short_desc</label>
                  <textarea id="short_desc" name="short_desc"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>
               </div>
               <div class="form-group">
                  <label for="desc" class="control-label mb-1"> Desc</label>
                  <textarea id="desc" name="desc"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$desc}}</textarea>
               </div>
               <div class="form-group">
                  <label for="keywords" class="control-label mb-1"> Keywords</label>
                  <textarea id="keywords" name="keywords"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$keywords}}</textarea>
               </div>
               <div class="form-group">
                  <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                  <textarea id="technical_specification" name="technical_specification"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$technical_specification}}</textarea>
               </div>
               <div class="form-group">
                  <label for="uses" class="control-label mb-1"> Uses</label>
                  <textarea id="uses" name="uses"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$uses}}</textarea>
               </div>
               <div class="form-group">
                  <label for="warranty" class="control-label mb-1"> Warranty</label>
                  <textarea id="warranty" name="warranty"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$warranty}}</textarea>
               </div>
            </div>
         </div>
      </div>
</div>
      <!-- ////////////////////////////////////////////////// -->
     <h2 class="mb10">Product images</h2>
      <div class="col-lg-12" >
     
      <div class="card" >
            <div class="card-body">
      
               <div class="form-group">
                  <div class="row" id="product_images_box">
                  @php
      $loop_count_num=1

      @endphp
      @foreach($productImagesArr as $key=>$value)
      @php
      $loop_count_prev=$loop_count_num;
      $pIArr=(array)$value;
     @endphp
     <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}" >  
                     <div class="col-md-4 product_images_{{$loop_count_num++}}" >
                        <label for="images" class="control-label mb-1"> Images</label>
                     
                        <input id="images"  name="images[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                        @if($pIArr['images']!='')<a href="{{asset('storage/media/'.$pIArr['images'])}}" target="_blank"><img width="100px" src="{{asset('storage/media/'.$pIArr['images'])}}"/></a>
                        @endif
                     </div>
                     <div class="col-md-1">
                        <label for="images" class="control-label mb-1">&nbsp; &nbsp; &nbsp; &nbsp; </label>
                           @if($loop_count_num==2)
                           <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()"> <i class="fa fa-plus"></i>Add </button>
                       @else
                     <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}">  <button type="button" class="btn btn-danger btn-lg" > <i class="fa fa-minus"></i>Remove </button></a>
                     @endif
                  </div> 
                    @endforeach 
                  </div>
                
               </div>
            </div>
         </div>
       
</div>
    
    <!-- ////////////////////////////// -->
    
    
      <h2 class="mb10">Product Attributes</h2>
      <div class="col-lg-12" id="product_attr_box">
     @php
      $loop_count_num=1

      @endphp
      @foreach($productAttrArr as $key=>$value)
      @php
      $loop_count_prev=$loop_count_num;
      $pArr=(array)$value;
     @endphp
     <input id="paid" type="hidden" name="paid[]" value="{{$pArr['id']}}" >
      <div class="card" id="product_attr_{{$loop_count_num++}}">
            <div class="card-body">
      
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-2">
                        <label for="sku" class="control-label mb-1"> SKU</label>
                        <input id="sku"  name="sku[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pArr['sku']}}" required>
                     </div>
                     <div class="col-md-2">
                        <label for="mrp" class="control-label mb-1"> MRP</label>
                        <input id="mrp" name="mrp[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pArr['mrp']}}" required>
                     </div>
                     <div class="col-md-2">
                        <label for="price" class="control-label mb-1"> Price</label>
                        <input id="price" name="price[]"  type="text" class="form-control" aria-required="true" aria-invalid="false"value="{{$pArr['price']}}" required>
                     </div>
                     <div class="col-md-2">
                        <label for="quantity" class="control-label mb-1"> Quantity</label>
                        <input id="quantity" name="quantity[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pArr['quantity']}}"required>
                     </div>
                     <div class="col-md-3">
                        <label for="size_id" class="control-label mb-1">Size</label>
                        <select id="size_id" name="size_id[]" class="form-control" >
                           <option value="">Select Size</option>
                           @foreach($sizes as $list)
                           @if($pArr['size_id']==$list->id)
                           <option value="{{$list->id}}" selected>{{$list->size}}</option>
                          @else{
                           <option value="{{$list->id}}" >{{$list->size}}</option>  
                          }
                          @endif
                           @endforeach 
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label for="color_id" class="control-label mb-1">Color</label>
                        <select id="color_id" name="color_id[]" class="form-control" >
                           <option value="">Select Color</option>
                           @foreach($colors as $list)
                           @if($pArr['color_id']==$list->id)
                           <option value="{{$list->id}}" selected>{{$list->color}}</option>
                         @else{
                           <option value="{{$list->id}}" >{{$list->color}}</option>  
                          }
                          @endif
                           @endforeach 
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label for="image1" class="control-label mb-1"> Image</label>
                     
                        <input id="image1"  name="image1[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                        @if($pArr['image1']!='')<a href="{{asset('storage/media/'.$pArr['image1'])}}" target="_blank"><img width="100px" src="{{asset('storage/media/'.$pArr['image1'])}}"/>
                        @endif
                     </div>
                    

                     <div class="col-md-1">
                        <label for="add" class="control-label mb-1">&nbsp; &nbsp; &nbsp; &nbsp; </label>
                           @if($loop_count_num==2)
                           <button type="button" class="btn btn-success btn-lg" onclick="add_more()"> <i class="fa fa-plus"></i>Add </button>
                       @else
                     <a href="{{url('admin/product/product_attr_delete/')}}/{{$pArr['id']}}/{{$id}}">  <button type="button" class="btn btn-danger btn-lg" > <i class="fa fa-minus"></i>Remove </button></a>
                     @endif
                  </div>
                  </div>
                  
               </div>
            </div>
         </div>
        @endforeach 
</div>
</div>
         <!-- ///////////////// -->
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>     
         </div>
         <input type="hidden" name="id" value="{{$id}}"/>                          
</form>
</div>
</div>


<script>
   
   var loop_count=1;
   
function add_more(){  
      loop_count++;
     var html='<input id="paid"  name="paid[]"  ><div class="card" id="product_attr_'+ loop_count +'"><div class="card-body"> <div class="form-group"><div class="row">';
      html+=' <div class="col-md-2"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku"  name="sku[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';                              
      html+='<div class="col-md-2">  <label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp" name="mrp[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" required> </div>';
      html+=' <div class="col-md-2"> <label for="price" class="control-label mb-1"> Price</label> <input id="price" name="price[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" required> </div>';
   
      html+='  <div class="col-md-1"> <label for="quantity" class="control-label mb-1"> Quantity</label>  <input id="quantity" name="quantity[]"  type="text" class="form-control" aria-required="true" aria-invalid="false" required> </div>';
      var size_id_html=jQuery('#size_id').html();
      html+='   <div class="col-md-3"> <label for="size_id" class="control-label mb-1">Size</label><select id="size_id" name="size_id[]" class="form-control" > '+size_id_html+' </select>  </div>';
      var color_id_html=jQuery('#color_id').html();
      html+=' <div class="col-md-3"> <label for="color_id" class="control-label mb-1">Color</label>  <select id="color_id" name="color_id[]" class="form-control" > '+color_id_html+'</select>  </div>';
      html+='  <div class="col-md-4"><label for="image1" class="control-label mb-1"> Image</label>  <input id="image1"  name="image1[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+=' <div class="col-md-1">  <label for="add" class="control-label mb-1">&nbsp; &nbsp; &nbsp; </label><button type="button" class="btn btn-danger btn-lg" onclick= remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp;Remove</button></div>';  
                                    
       
    html+='</div></div></div></div>';
    jQuery('#product_attr_box').append(html)
   }

 function remove_more(loop_count){
    jQuery('#product_attr_'+ loop_count).remove();
 } 
</script>

<script>
var loop_image_count=1;
   
    function add_image_more(){
      loop_image_count++; 
    
     var  html+=' <input id="piid" type="hidden" name="piid[]" value="" > <div class="col-md-4 product_images_'+loop_image_count+'" ><label for="images" class="control-label mb-1"> Images</label>  <input id="images"  name="images[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';
      html+=' <div class="col-md-1" product_images_'+loop_image_count+'">  <label for="images" class="control-label mb-1">&nbsp; &nbsp; &nbsp; </label><button type="button" class="btn btn-danger btn-lg" onclick= remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp;Remove</button></div>';   

      jQuery('#product_images_box').append(html)

    }


    function remove_image_more(loop_image_count){
    jQuery('.product_images_'+ loop_image_count).remove();
 }               
</script>
@endsection