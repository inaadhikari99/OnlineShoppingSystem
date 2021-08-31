@extends('admin/layout')
@section('page_title','Customer') 
@section('customer_select','active')
@section('container')
{{session('message')}}
<h1 class="mb10" >Customer</h1>

<div class="row m-t-30">
   <div class="col-md-12">
      <!-- DATA TABLE-->
      <div class="table-responsive m-b-100">
         <table class="table table-borderless table-data3">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile-No</th>
                  <th>city</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($data as $list)
               <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->name}}</td>
                  <td>{{$list->email}}</td>
                  <td>{{$list->mobile}}</td>
                  <td>{{$list->city}}</td>

                  <td>
                     <a href="{{url('admin/customer/show/')}}/{{($list->id)}}"><button type="button" class="btn btn-success">View</button></a>
                   
                     @if($list->status==1)
                     <a href="{{url('admin/customer/status/0')}}/{{($list->id)}}"><button type="button" class="btn btn-info">Active</button></a>
                     @elseif($list->status==0)
                     <a href="{{url('admin/customer/status/1')}}/{{($list->id)}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                     @endif
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <!-- END DATA TABLE-->
   </div>
</div>
@endsection