@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Employee</a></li>
        <li><a href="#">Add</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>Employee Add</h2> 
    </header> 
    <div class="form-container">
    	<form class="form-horizontal " action="/action_page.php">
    		<div class="form-group">
		       	<label class="control-label col-sm-3" for="email">Photo:</label>
		       	<div class="col-sm-6">
		       		@if($employee->id)
		       			<img src="" />  
		       		@endif
			       <input type="file" class="custom-file-input" id="customFile" name="photo">
	    			<label class="custom-file-label" for="customFile">Choose file</label>
		     	</div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="employee_name">Name:</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="employee_name" placeholder="Enter User Name" name="employee_name" value="{{$employee->name}}">
		      </div>
		    </div> 
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="department_id">Department:</label>
		      	<div class="col-sm-6">          
		        	<select name="department_id"  class="form-control">
		        		<option>Select Department</option>
		        	</select>
		      	</div>
		    </div>
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="sub_department_id">Employee:</label>
			    <div class="col-sm-6">          
			        <select name="sub_department_id"  class="form-control">
			        	<option>Select Sub Department</option>
			        </select>
			    </div>
		    </div>
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="user_id">User:</label>
			    <div class="col-sm-6">          
			        <select name="user_id"  class="form-control">
			        	<option>Select User</option>
			        </select>
			    </div>
		    </div>  
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="email">Email:</label>
		      <div class="col-sm-6">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-envelope"></i></span>
				    	<input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{$employee->email}}">
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="phone">Phone:</label>
		      <div class="col-sm-6">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-mobile"></i></span>
				    	<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{$employee->phone}}">
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="address">Address:</label>
		      <div class="col-sm-6">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-map-marker"></i></span>
				    	<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{$employee->address}}">
				  	</div>		        
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