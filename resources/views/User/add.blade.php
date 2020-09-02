@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Users</a></li>
        <li><a href="#">Add</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>User Add</h2> 
    </header> 
    <div class="form-container">
    	<form class="form-horizontal " action="/action_page.php">
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="email">User Name:</label>
		      <div class="col-sm-6">
		        <input type="email" class="form-control" id="email" placeholder="Enter User Name" name="user_name" value="{{$user->user_name}}">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="pwd">Password:</label>
		      <div class="col-sm-6">          
		        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password"  value="{{$user->password}}">
		      </div>
		    </div> 
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="pwd">Role:</label>
		      	<div class="col-sm-6">          
		        	<select name="role_id"  class="form-control">
		        		<option>Select Role</option>
		        	</select>
		      	</div>
		    </div>
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="pwd">Employee:</label>
			    <div class="col-sm-6">          
			        <select name="employee_id"  class="form-control">
			        	<option>Select Employee</option>
			        </select>
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