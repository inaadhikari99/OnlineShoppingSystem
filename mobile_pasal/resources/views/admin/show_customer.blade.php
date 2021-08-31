@extends('admin/layout')
@section('page_title','Show Customer Details') 
@section('customer_select','active')
@section('container')
<!-- {{session('message')}} -->
<h1 class="mb10" >Customer Details</h1>

<div class="row m-t-30">
   <div class="col-md-10">
      <!-- DATA TABLE-->
      <div class="table-responsive m-b-100">
         <table class="table table-borderless table-data3">
          <h2 class="mb10">{{$customer_list->name}}</h2>
            <tbody>
               
               <tr>
                <td><strong>Name</strong></td>
                 <td>{{$customer_list->name}}</td>
                 </tr>
                 <tr>
                <td><strong>email</strong></td>
                 <td>{{$customer_list->email}}</td>
                 </tr>
                 <tr>
                <td><strong>mobile</strong></td>
                 <td>{{$customer_list->mobile}}</td>
                </tr>
                 <tr>
                <td><strong>address</strong></td>
                 <td>{{$customer_list->address}}</td>
                 </tr>
                 <tr>
                <td><strong>city</strong></td>
                 <td>{{$customer_list->city}}</td>
                 </tr>
                 <tr>
                <td><strong>Added on</strong></td>
                 <td>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i:s' )}}</td>
                 </tr>
                 <tr>
                <td><strong>Updated on</strong></td>
                 <td>{{\Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-Y h:i:s')}}</td>
                 </tr>
            
            </tbody>
         </table>
      </div>
      <!-- END DATA TABLE-->
   </div>
</div>
@endsection