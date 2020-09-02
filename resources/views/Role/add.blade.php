@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="{{url('roles')}}">Role</a></li>
        <li><a href="#">Add</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>Role Add</h2> 
    </header> 
    <div class="form-container">
    	@php
    	  if($user_role->id){
    		$path =url('role/update').'/'.$user_role->id;
    	  }else{
    		$path =url('role/add') ;
    	  }
    	@endphp
    	<form class="form-horizontal" action="{{$path}}" method="post">
    		{{ csrf_field() }} 
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="name">Name:</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="name" placeholder="Enter Role Name" name="name" value="{{$user_role->name}}">
		      </div>
		    </div>  
		    <div class="form-group">        
		      <div class="col-sm-offset-8 col-sm-2">
		      	@if($user_role->id)
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