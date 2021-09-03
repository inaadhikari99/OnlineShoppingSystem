@extends('admin/layout')
@section('page_title','Manage Banner') 
@section('container')
@section('banner_select','active')
<h1 class="mb10" > Manage Banner</h1>
<a href="{{url('admin/banner')}}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <form action="{{route('banner.manage_banner_process')}}" method="post" enctype="multipart/form-data" >
                     @csrf
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-6">
                              <label for="btn_txt" class="control-label mb-1">Btn text</label>
                              <input id="btn_txt" name="btn_txt" value="{{$btn_txt}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                           
                           </div>
                           <div class="col-md-6">
                              <label for="btn_link" class="control-label mb-1">Btn Link</label>
                              <input id="btn_link" name="btn_link" value="{{$btn_link}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                           
                           </div>
                           
                     
                     <div class="form-group">
                  <label for="image" class="control-label mb-1"> Image</label>
                  <input id="image"  name="image"  type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                  @error('image')
                  <div class="alert alert-danger" role="alert">
                     {{$message}}
                  </div>
                  @enderror 
                  
                  @if($image!='')<a href="{{asset('storage/media/banner/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/media/banner/'.$image)}}"/></a>
                        @endif
               </div>
               

                     <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                     Submit
                     </button>
               </div>
               <input type="hidden" name="id" value="{{$id}}"/>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection