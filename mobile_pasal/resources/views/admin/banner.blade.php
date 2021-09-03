@extends('admin/layout')
@section('page_title','Banner') 
@section('banner_select','active')
@section('container')
{{session('message')}}
<h1 class="mb10" >Banner</h1>
<a href="{{url('admin/banner/manage_banner')}}">
<button type="button" class="btn btn-success">Add Banner</button>
</a>
<div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-100">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Btn link</th> 
                                                 <th>Image</th>
                                                <th>Btn text</th>
                                                  <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $list)
                                         <tr>
                                             <td>{{$list->id}}</td>
                                             <td>{{$list->btn_link}}</td>
                                             <td>
                                             <img width="100px" src="{{asset('storage/media/banner/'.$list->image)}}"/>
                                                </td>   
                                                <td>{{$list->btn_txt}}</td> 
                                                <td>
                                                
                                                <a href="{{url('admin/banner/manage_banner/')}}/{{($list->id)}}"><button type="button" class="btn btn-success">Edit</button></a>
                                                <a href="{{url('admin/banner/delete/')}}/{{($list->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>                                 
                                               @if($list->status==1)

                                              
                                                
                                                <a href="{{url('admin/banner/status/0')}}/{{($list->id)}}"><button type="button" class="btn btn-info">Active</button></a>
                                                @elseif($list->status==0)
                                                <a href="{{url('admin/banner/status/1')}}/{{($list->id)}}"><button type="button" class="btn btn-warning">Deactive</button></a>
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