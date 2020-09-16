@extends('layouts.master')
@section('content') 
<div class="container">
	<ol class="breadcrumb"> 
       	<li><a href="#">User Setting</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
       	<h2>User Setting</h2> 
    </header> 
    <div class="form-container"> 
    	<form class="form-horizontal " action="{{url('user/setting/update')}}" method="post" enctype="multipart/form-data" files=
    	"true" role="form">
    		{{ csrf_field() }}     		
			@if(Session::has('setting.message')!="")
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6"> 
                    <div class="alert {{Session::get('status')}}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('setting.message') }}
                    </div>
                </div> 
            </div>
            @endif  
    		<div class="form-group">
		       	<label class="control-label col-sm-3" for="photo">Photo:</label>
		       	<div class="col-sm-9"> 
		       		@if($employee->photo_name)
		       			<img src="{{ URL::asset('upload/images') }}/{{$employee->id}}/{{$employee->photo_name}}" width="100" height="100" style="margin-bottom:15px;" /> 
		       		@else
		       			<img src="{{URL::asset('img/default.jpg')}}" class="rounded-circle"/>
		       		@endif
			       <input type="file" class="custom-file-input" id="customFile" name="photo"> 
	    		   <label class="custom-file-label" for="customFile">Choose file</label>
	    		   <input type="hidden" name="old_photo" value="{{$employee->photo_name}}"/>
	    		   <input type="hidden" name="role_id" value="{{$user->role_id}}"/>
		     	</div>
		    </div>
		    <div class="form-group">
			      <label class="control-label col-sm-3" for="email">User Name:</label>
			      <div class="col-sm-9">
			        <input type="text" class="form-control" id="email" placeholder="Enter User Name" name="user_name" value="{{Request::old('user_name')!=""?Request::old('user_name'):$user->name}}" required="required">
			        <input type="hidden" value="{{$user->id}}" name="user_id"/>
			      </div>
			</div>
			<div class="form-group">
		      <label class="control-label col-sm-3" for="pwd">Password:</label>
		      <div class="col-sm-9">          
		        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password"  value="{{Request::old('password')!=""?Request::old('password'):$user->password}}"  required="required">
			</div>
			</div> 
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="employee_name">Employee Name:</label>
		      <div class="col-sm-9">
		        <input type="text" class="form-control" id="employee_name" placeholder="Enter User Name" name="employee_name" value="{{Request::old('name')!=""?Request::old('name'):$employee->name}}" required="">
		      </div>
		    </div> 
		    <div class="form-group">
		    	<label class="control-label col-sm-3" for="user_id">Department:</label>
		    	<div class="col-sm-9"> 
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
			    <div class="col-sm-9">          
			        <select name="sub_department_id"  class="form-control" id="sub_department_id">
			        	
			        </select>
			    </div>
		    </div> 
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="email">Email:</label>
		      <div class="col-sm-9">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-envelope"></i></span>
				    	<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{Request::old('email')!=""?Request::old('email'):$employee->email}}" required>
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="phone">Phone:</label>
		      <div class="col-sm-9">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-mobile"></i></span>
				    	<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{Request::old('phone')!=""?Request::old('phone'):$employee->phone}}" required>
				  	</div>		        
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="address">Address:</label>
		      <div class="col-sm-9">
		      		<div class="input-group">
				    	<span class="input-group-addon"><i class="fa fa-md fa-map-marker"></i></span>
				    	<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{Request::old('address')!=""?Request::old('address'):$employee->address}}" required>
				  	</div>		        
		      </div>
		    </div>     		
	   		<div class="form-group">
		      	<div class="col-sm-offset-10 col-sm-2"> 
    		        <button type="submit" class="btn btn-default right">Update</button> 
		        </div>
	    	</div>
	    </form>
	</div>
</div>

<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('js/cascade_select.js') }}"></script>
<script type="text/javascript"> 
var subdepartments = <?php echo json_encode($subdepartments); ?>;
var sel_value = "<?php echo $employee->sub_deaprtment_id; ?>"; 
 
</script>
@endsection
