@extends('front/layout')
@section('page_title','Cart Page')
@section('container')

   <!-- catg header banner section -->
   <section id="aa-catg-head-banner">
 
   <div class="aa-catg-head-banner-area">
     <div class="container">
    
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->



   <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
                 @if(isset($list[0]))
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach( $list as $data)
                      <tr id="cart_box{{$data->pa_id}}">
                        <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{$data->pid}}','{{$data->size}}','{{$data->color}}','{{$data->pa_id}}')"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="{{url('product/'.$data->slug)}}"><img src="{{asset('storage/media/'.$data->image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="{{url('product/'.$data->slug)}}">{{$data->name}}</a>
</br>
                    @if($data->size!='')
                    SIZE:{{$data->size}} </br>
                     @endif

                     
                    @if($data->color!='')
                    COLOR:{{$data->color}}
                     @endif
                    </td>
                        <td>Rs{{$data->price}}</td>
                        <td><input class="aa-cart-quantity" id="qty{{$data->pa_id}}" type="number" value="{{$data->quantity}}" onchange="updateQ('{{$data->pid}}','{{$data->size}}','{{$data->color}}','{{$data->pa_id}}','{{$data->price}}')"></td>
                        <td id="total_price_{{$data->pa_id}}">Rs{{$data->price*$data->quantity}}</td>
                      </tr>
                      @endforeach
                      <tr>
                      <td colspan="6" class="aa-cart-view-bottom">
                          <input class="aa-cart-view-btn" type="button" value="Checkout">
                        </td>
                   <tr>
                      </tbody>
                  </table>
                </div>
                @else
<h2>EMPTY!!!</h2>
@endif
</form>


             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>$450</td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>$450</td>
                   </tr>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <input type="hidden" id="qty" value="1"/>
  <form id="formAddToCart"> 
  <input type="hidden"name="size_id" id="size_id"/>
  <input type="hidden"name="color_id" id="color_id"/>
   <input type="hidden"name="pqty" id="pqty"/>
  <input type="hidden"name="product_id" id="product_id"/>
   @csrf
</form>
 <!-- / Cart view section -->
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
<!-- ??????????????????????????????????????????????????// -->
<script>
function deleteCartProduct(pid,size,color,attr_id){
    jQuery('#color_id').val(color);
      jQuery('#size_id').val(size);
    jQuery('#qty').val(0)
     add_to_cart(pid,size,color);
    // jQuery('#total_price_'+attr_id).html('Rs'+qty*price);
   jQuery('#cart_box'+attr_id).remove();

    }  
      </script>

<script>
function updateQ(pid,size,color,attr_id,price){
    jQuery('#color_id').val(color);
      jQuery('#size_id').val(size);
    var qty=  jQuery('#qty'+attr_id).val();
    jQuery('#qty').val(qty)
      add_to_cart(pid,size,color);
      jQuery('#total_price_'+attr_id).html('Rs'+qty*price);

    }  
    


    </script>
@endsection 