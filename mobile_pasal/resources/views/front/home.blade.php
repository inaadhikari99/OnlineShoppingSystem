@extends('front/layout')
@section('page_title','Home Page')
@section('container')

  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
            
                <div class="col-md-12 no-padding">
                    <div class="aa-promo-right">
                    @foreach($home_categories as $list)
              <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{asset('storage/media/category/'.$list->category_image)}}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>New Arrivals</span>
                        <h4><a href="{{url('category/'.$list->category_slug)}}">{{$list->category_name}}</a></h4>                        
                      </div>
                    </div>
                  </div>
                 @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
  </section>

  <!-- / Promo section -->
  <!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach($banner as $list)
            <li>
              <div class="seq-model">
                <img data-seq src="{{asset('storage/media/banner/'.$list->image)}}" />
              </div>
              <div class="seq-title">
              <a data-seq href="{{$list->btn_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$list->btn_txt}}</a>
              </div>
            </li>
              @endforeach             
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                    @foreach($home_categories as $list)

                    <li class=""><a href="#cat{{$list->id}}" data-toggle="tab">{{$list->category_name}}</a></li>
                    @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    @php 
                    $loop_count=1;
                    @endphp
                    @foreach($home_categories as $list)
                    @php
                    $cat_class="";
                    if($loop_count==1){
                      $cat_class="in active";
                      $loop_count++;
                    }
                    @endphp
                    <div class="tab-pane fade {{$cat_class}}" id="cat{{$list->id}}">
                      <ul class="aa-product-catg">
                       @if(isset($home_categories_product[$list->id][0]))
                      @foreach($home_categories_product[$list->id] as $productArr)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$home_product_attr[$productArr->id][0]->size}}','{{$home_product_attr[$productArr->id][0]->color}}')"><span class="fa fa-shopping-cart" ></span>Add To Cart</a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs{{$home_product_attr[$productArr->id][0]->price}}</span><span class="aa-product-price"><del>Rs{{$home_product_attr[$productArr->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>                          
                          
                        </li>
                        @endforeach 
                        @else
                       <li>
                         <figure>

              NOT AVAILABLE
                  
                  </figure>
                       </li>
                        @endif
                                          
                      </ul>
                    </div>
          @endforeach

                   </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('front_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#popular" data-toggle="tab">Popular</a></li>
                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#latest" data-toggle="tab">Latest</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="popular">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    
                    
                    <!-- start single product item -->
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="img/man/t-shirt-1.png" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      </figure>
                      <figcaption>
                        <h4 class="aa-product-title"><a href="#">T-Shirt</a></h4>
                        <span class="aa-product-price">$45.50</span>
                      </figcaption>
                      <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                       
                      </div>
                      <!-- product badge -->
                       <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                    </li>
                    
                                                                 
                  </ul>
              
                </div>
                <!-- / popular product category -->
                
                <!-- start featured product category -->
                <div class="tab-pane fade" id="featured">
                 <ul class="aa-product-catg aa-featured-slider">
                   
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="img/women/girl-3.png" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                          <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                        </figcaption>
                      </figure>                     
                      <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                       
                      </div>
                    </li>
                    
                                                                                              
                  </ul>
                  
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="latest">
                  <ul class="aa-product-catg aa-latest-slider">
                  
                    
                   
                  
                   
                    <li>
                      <figure>
                        <a class="aa-product-img" href="#"><img src="img/man/polo-shirt-4.png" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                          <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                        </figcaption>
                      </figure>                     
                      <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                      
                      </div>
                      <!-- product badge -->
                      <span class="aa-badge aa-hot" href="#">HOT!</span>
                    </li> 
                    <!-- start single product item -->
                                                                                 
                  </ul>
                  
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  
 

  
  <!-- Client Brand -->
  <section id="aa-client-brand">
    
    <div class="container">
      <h2>BRANDS</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            
            <ul class="aa-client-brand-slider">
               <li><a href="#"><img src="{{asset('front_assets/img/1.png')}}" alt=""></a></li>
              <li><a href="#"><img src="{{asset('front_assets/img/2.png')}}" alt=""></a></li>
              <li><a href="#"><img src="{{asset('front_assets/img/3.png')}}" alt=""></a></li>

              <li><a href="#"><img src="{{asset('front_assets/img/images.png')}}" alt=""></a></li>
              <li><a href="#"><img src="{{asset('front_assets/img/images (1).png')}}" alt=""></a></li>
              <li><a href="#"><img src="{{asset('front_assets/img/images (2).png')}}" alt=""></a></li>
             
              
             
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->
  <input type="hidden" id="qty" value="1"/>
  <form id="formAddToCart"> 
  <input type="hidden"name="size_id" id="size_id"/>
  <input type="hidden"name="color_id" id="color_id"/>
   <input type="hidden"name="pqty" id="pqty"/>
  <input type="hidden"name="product_id" id="product_id"/>
   @csrf
</form>

<script>
function home_add_to_cart(id,size_str_id,color_str_id){
      jQuery('#color_id').val(color_str_id);
      jQuery('#size_id').val(size_str_id);
      add_to_cart(id,size_str_id,color_str_id);
    }  
  </script>
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

@endsection 