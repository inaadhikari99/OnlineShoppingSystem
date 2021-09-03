@extends('front/layout')
@section('page_title',$product[0]->name)
@section('container')


  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{asset('storage/media/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{asset('storage/media/'.$product[0]->image)}}" width="50px" >
                          </a>                                    
                          
                        @if(isset($product_images[$product[0]->id][0]))

          @foreach($product_images[$product[0] ->id] as $list)
        <a data-big-image="{{asset('storage/media/'.$list->images)}}" data-lens-image="{{asset('storage/media/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#">
         <img src="{{asset('storage/media/'.$list->images)}}" width="50px" >
</a>
          @endforeach
                        @endif

                        

                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$product[0]->name}}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">Rs {{$product_attr[$product[0]->id][0]->mrp}}</span>
                      <span class="aa-product-view-price"><del>&nbsp;&nbsp;{{$product_attr[$product[0]->id][0]->price}}</del></span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                     BRAND:<p> {{$product[0]->brand}}</p>
                     
                      Warranty:<p>{{$product[0]->warranty}}</p>
                    </div>
                   Short-description:<p>{{$product[0]->short_desc}}</p>
                   <!-- ////////////////////////  -->



                   @if($product_attr[$product[0]->id][0]->size_id>0)
                   <h4>Size</h4>
                    <div class="aa-prod-view-size">
@php 
$arrSize=[];
foreach($product_attr[$product[0]->id] as $attr){
  $arrSize[]=$attr->size;

}
$arrSize=array_unique($arrSize);

@endphp




                    @foreach($arrSize as $attr)
                    @if($attr!='')
                      <a href="javascript:void(0)" id="size_{{$attr}}" class="size_link" onclick="showColor('{{$attr}}')">  {{$attr}}</a>
                      @endif
                   
                    @endforeach
                      
                    </div>
                    @endif
                    @if($product_attr[$product[0]->id][0]->color_id>0)
    
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                    @foreach($product_attr[$product[0]->id] as $attr)

                    @if($attr->color!='')
                      <a href="javascript:void(0)" class="aa-color-{{strtolower($attr->color)}} product_color size_{{$attr->size}}"  onclick=change_color_image("{{asset('storage/media/'.$attr->image1)}}","{{$attr->color}}")></a>
                      @endif
                      @endforeach                      
                    </div>
                   @endif

                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="qty" name="qty">
                         @for($i=1;$i<8;$i++)
                          <option value="{{$i}}">{{$i}}</option>
                      @endfor
                        </select>
                      </form>
                      <p class="aa-prod-category">
                      Model: <a href="#">{{$product[0]->model}}</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                            <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{$product_attr[$product[0]->id][0]->color_id}}')">Add To Cart</a>
                      
                    </div>
                    <div id="cart_msg"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical specification</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                {!!$product[0]->desc!!}
                </div>
                <div class="tab-pane fade " id="technical_specification">
                {!!$product[0]->technical_specification!!}
                </div>
                <div class="tab-pane fade " id="uses">
                {!!$product[0]->uses!!}
                </div>
                <div class="tab-pane fade " id="warranty">
                {{$product[0]->warranty}}
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                    
                      <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>
            
               
           </div>  
  </div>
  </div>
  </div>
    </div>
  </section>
 <form id="formAddToCart"> 
  <input type="hidden"name="size_id" id="size_id"/>
  <input type="hidden"name="color_id" id="color_id"/>
   <input type="hidden"name="pqty" id="pqty"/>
  <input type="hidden"name="product_id" id="product_id"/>
   @csrf
</form>
  <!-- / product category -->

<!-- ////////////////////////////////////////////////////////////////////// -->
<script>
function change_color_image(img,color){
  jQuery('#color_id').val(color);
  jQuery('.simpleLens-big-image-container').html('<a data-lens-image="'+img+'" class="simpleLens-lens-image"><img src="'+img+'"></a>');
}

</script>

<script>
function showColor(size){
 jQuery('#size_id').val(size); 
jQuery('.product_color').hide();
jQuery('.size_'+size).show();
jQuery('.size_link').css('border','0px');
jQuery('#size_'+size).css('border','1px solid black');
}
</script>

<script>
function add_to_cart(id,size_str_id,color_str_id){
  jQuery('#cart_msg').html('');
 var color_id= jQuery('#color_id').val();
  var size_id=jQuery('#size_id').val(); 
  
  
  if(size_str_id==0 && color_str_id==0){
    size_id='N/A';
    color_id='N/A';
  }
  if(size_id=='' &&  size_id!='N/A'){
jQuery('#cart_msg').html('<h2>Please select size</h2>');
  }else if(color_id==''  &&  color_id!='N/A'){
    jQuery('#cart_msg').html('<h2>Please select color</h2>');
  }else{
    jQuery('#product_id').val(id);
    jQuery('#pqty').val(jQuery('#qty').val());
jQuery.ajax({
url:'http://localhost:8081/Laravel/ecom/mobile_pasal/public/add_to_cart',
data:jQuery('#formAddToCart').serialize(),
type:'post',
success:function(result){
 alert('Product' + result.msg)
}
});
  }
}
</script>
<!-- ??????????????????????????????????????????????????????????????????????????/ -->
@endsection