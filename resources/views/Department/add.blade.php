@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="{{url('departments')}}">Departments</a></li>
        <li><a href="#">{{$action}}</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>Department {{$action}}</h2> 
    </header> 
    <div class="form-container">
    	@php
    	  if($department->id){
    		  $path =url('department/update').'/'.$department->id;
    	  }else{
    		  $path =url('department/add') ;
    	  }
    	@endphp
    	<form class="form-horizontal " action="{{$path}}" method="post">
    		{{ csrf_field() }}  
			@if(Session::has('dept.message')!="")
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6"> 
                    <div class="alert {{Session::get('status')}}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('dept.message') }}
                    </div>
                </div> 
            </div>
            @endif    
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="name">Name:</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{Request::old('name')!=""?Request::old('name'):$department->name}}">
		      </div>
		    </div>		     
		    <div class="form-group">        
		        <div class="col-sm-offset-8 col-sm-2">
    		      	@if($department->id)
    		        <button type="submit" class="btn btn-default">Update</button>
    		        @else
    		        <button type="submit" class="btn btn-default">Add</button>
    		        @endif
		        </div>
		    </div>
	    </form>
	</div>
</div>
@endsection