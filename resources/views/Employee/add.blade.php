@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="{{ url('employees') }}">Employees</a></li> 
       	<li><a href="#">{{$action}}</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
       	<h2>Employee {{$action}}</h2> 
    </header> 
    <div class="form-container">
    	@php
    	    if($employee->id){
    		  $path =url('employee/update/').'/'.$employee->id;
    	    }else{
    		  $path =url('employee/add') ;
    	    }
    	@endphp
    	<form class="form-horizontal " action="{{$path}}" method="post" enctype="multipart/form-data" files=
    	"true" role="form">
    		{{ csrf_field() }}     		
			@if(Session::has('employee.message')!="")
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6"> 
                    <div class="alert {{Session::get('status')}}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('employee.message') }}
                    </div>
                </div> 
            </div>
            @endif 
    		<div class="form-group">
		       	<label class="control-label col-sm-3" for="photo">Photo:</label>
		       	<div class="col-sm-6"> 
		       		@if($employee->photo_name)
		       			<img src="{{ URL::asset('upload/images') }}/{{$employee->id}}/{{$employee->photo_name}}" width="100" height="100" style="margin-bottom:15px;" /> 
		       		@endif
			       <input type="file" class="custom-file-input" id="customFile" name="photo"> 
	    		   <label class="custom-file-label" for="customFile">Choose file</label>
		     	</div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="employee_name">Name:</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="employee_name" placeholder="Enter User Name" name="employee_name" value="{{Request::old('name')!=""?Request::old('name'):$employee->name}}" required="">
		      </div>
		    </div> 
		    <div class="form-group">
		    	<label class="control-label col-sm-3" for="user_id">Department:</label>
		    	<div class="col-sm-6"> 
			      	<select name="department_id"  class="form-control"  required="required" id="department_id">	
			      		@php
			      			$department_id=Request::old('department_id')!=""?
                                             Request::old('department_id'):$employee->department_id;

			      		@endphp
			        	<option value="">Select Department</option>
			        	@for($i=0;$i<count($departments);$i++)
				        	@if($departments[$i]['Id']==$department_id)
				        		<option value="{{$departments[$i]['Id']}}" selected="selected">{{$departments[$i]['Name']}}</option>
				        	@else
				        		<option value="{{$departments[$i]['Id']}}">{{$departments[$i]['Name']}}</option>
				        	@endif
			        	@endfor 
				    </select>
				</div>
		    </div>
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="sub_department_id">Sub Department:</label>
			    <div class="col-sm-6">          
			        <select name="sub_department_id"  class="form-control" id="sub_department_id">
			        	
			        </select>
			    </div>
		    </div>
		    <div class="form-group">
		      	<label class="control-label col-sm-3" for="user_id">User:</label>
		      	<div class="col-sm-6"> 
				    <select name="user_id"  class="form-control"  required="required">
				    	@php
			      			$user_id=Request::old('user_id')!=""?
                                             Request::old('user_id'):$employee->user_id;

			      		@endphp
			        	<option value="">Select User</option>
			        	@for($i=0;$i<count($users);$i++)
				        	@if($users[$i]['Id']==$user_id)
				        		<option value="{{$users[$i]['Id']}}" selected="selected">{{$users[$i]['User_Name']}}</option>
				        	@else
				        		<option value="{{$users[$i]['Id']}}">{{$users[$i]['User_Name']}}</option>
				        	@endif
			        	@endfor 
				    </select>
			    </div>
		    </div>  
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="email">Email:</label>
		      <div class="col-sm-6">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-envelope"></i></span>
				    	<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{Request::old('email')!=""?Request::old('email'):$employee->email}}" required>
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="phone">Phone:</label>
		      <div class="col-sm-6">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-mobile"></i></span>
				    	<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{Request::old('phone')!=""?Request::old('phone'):$employee->phone}}" required>
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="address">Address:</label>
		      <div class="col-sm-6">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-map-marker"></i></span>
				    	<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{Request::old('address')!=""?Request::old('address'):$employee->address}}" required>
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">        
		      	<div class="col-sm-offset-8 col-sm-2">
    		      	@if($employee->id)
    		        <button type="submit" class="btn btn-default">Update</button>
    		        @else
    		        <button type="submit" class="btn btn-default">Add</button>
    		        @endif
		        </div>
		    </div>
	    </form>
	</div>
</div>
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript"> 
	var departments    = <?php echo json_encode($departments); ?>;
	var subdepartments = <?php echo json_encode($subdepartments); ?>;
	var edit_sub_dep_id = "<?php echo $employee->sub_deaprtment_id; ?>";

	$(document).ready(function(){ 
		$dep_id=$("#department_id").val(); 
		getSubDepartment($dep_id,edit_sub_dep_id);
		$("#sub_department_id").val(edit_sub_dep_id);
	});	
    $('#department_id').change(function() { 
     	getSubDepartment($(this).val(),'');
     	$("#sub_department_id").val('');
	});
	 
	function getSubDepartment($id,$sel_value){  
		$("#sub_department_id").html('');
		$("#sub_department_id").append(new Option('Select Sub Department', ''));
		 
 		$.each(subdepartments, function(key, item){ 
 			if(item.Dept_Id ==$id){
 				$("#sub_department_id").append(new Option(item.Sub_Dept_Name, item.Sub_Dept_Id));
 			} 
        }); 
 	}
</script>
@endsection
