@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Department</a></li>
        <li><a href="#">Add</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>Department Add</h2> 
    </header> 
    <div class="form-container">
    	<form class="form-horizontal " action="/action_page.php">
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="name">Name:</label>
		      <div class="col-sm-6">
		        <input type="email" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$department->name}}">
		      </div>
		    </div>
		     
		    <div class="form-group">        
		      <div class="col-sm-offset-8 col-sm-2">
		        <button type="submit" class="btn btn-default">{{$status}}</button>
		      </div>
		    </div>
	    </form>
	</div>
</div>
@endsection