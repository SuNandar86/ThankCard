@extends('layouts.master')
@section('content') 
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="{{ url('employees') }}">Employees</a></li> 
       	<li><a href="#">{{$action}}</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        @if(!$employee->id)
       	<h2>社員追加</h2> 
       	@else
       	<h2>社員修正</h2>
       	@endif
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
            <fieldset>
    			<legend>社員情報:</legend>
	    		<div class="form-group">
			       	<label class="control-label col-sm-3" for="photo">写真:</label>
			       	<div class="col-sm-9"> 
			       		@if($employee->photo_name)
			       			<img src="{{ URL::asset('upload/images') }}/{{$employee->id}}/{{$employee->photo_name}}" width="100" height="100" style="margin-bottom:15px;" /> 
			       		@else
			       			<img src="{{URL::asset('img/default.jpg')}}" class="rounded-circle"/>
			       		@endif
				       <input type="file" class="custom-file-input" id="customFile" name="photo">

		    		   <label class="custom-file-label" for="customFile">Choose file</label>
		    		   <input type="hidden" name="old_photo" value="{{$employee->photo_name}}"/>
			     	</div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-3" for="employee_name">氏名:</label>
			      <div class="col-sm-9">
			        <input type="text" class="form-control" id="employee_name" placeholder="Enter User Name" name="employee_name" value="{{Request::old('name')!=""?Request::old('name'):$employee->name}}" required="">
			      </div>
			    </div> 
			    <div class="form-group">
			    	<label class="control-label col-sm-3" for="user_id">部署:</label>
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
			      	<label class="control-label col-sm-3" for="sub_department_id">課部署:</label>
				    <div class="col-sm-9">          
				        <select name="sub_department_id"  class="form-control" id="sub_department_id">
				        	
				        </select>
				    </div>
			    </div> 
			    <div class="form-group">
			      <label class="control-label col-sm-3" for="email">メール:</label>
			      <div class="col-sm-9">
			      		<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-md fa-envelope"></i></span>
					    	<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{Request::old('email')!=""?Request::old('email'):$employee->email}}" required>
					  	</div>		        
			      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-3" for="phone">携帯電話:</label>
			      <div class="col-sm-9">
			      		<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-md fa-mobile"></i></span>
					    	<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{Request::old('phone')!=""?Request::old('phone'):$employee->phone}}" required>
					  	</div>		        
			      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-3" for="address">住所:</label>
			      <div class="col-sm-9">
			      		<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-md fa-map-marker"></i></span>
					    	<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{Request::old('address')!=""?Request::old('address'):$employee->address}}" required>
					  	</div>		        
			      </div>
			    </div>
			 </fieldset>
			<fieldset>
    			<legend>ユーザーアカウント情報:</legend>
    			    <input type="hidden" value="{{$user->id}}" name="user_id"/>
	    			<div class="form-group">
				      <label class="control-label col-sm-3" for="email">ユーザー名:</label>
				      <div class="col-sm-9">
				        <input type="text" class="form-control" id="email" placeholder="Enter User Name" name="user_name" value="{{Request::old('user_name')!=""?Request::old('user_name'):$user->name}}" required="required">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-3" for="pwd">パスワード:</label>
				      <div class="col-sm-9">          
				        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password"  value="{{Request::old('password')!=""?Request::old('password'):$user->password}}"  required="required">
				      </div>
				    </div>  
				    <div class="form-group">
				    	<label class="control-label col-sm-3" for="pwd">権限:</label>
				    	<div class="col-sm-9"> 
						    <select name="role_id"  class="form-control"  required="required">
					        	<option value="">Select Role</option>
					         	@php
					        	     $role_id=Request::old('role_id')!=""?
		                                             Request::old('role_id'):$user->role_id;
		                        @endphp
					        	@for($i=0;$i<count($roles);$i++)
						        	@if($roles[$i]['Id']==$role_id)
						        		<option value="{{$roles[$i]['Id']}}" selected="selected">{{$roles[$i]['Name']}}</option>
						        	@else
						        		<option value="{{$roles[$i]['Id']}}">{{$roles[$i]['Name']}}</option>
						        	@endif
					        	@endfor 
							 </select>
						</div>
					</div>
    	    </fieldset>
		    <div class="form-group">        
		      	<div class="col-sm-offset-9 col-sm-3 col-md-2">
    		      	@if($employee->id)
    		        <button type="submit" class="btn btn-default btn-sv">更新</button>
    		        @else
    		        <button type="submit" class="btn btn-default btn-sv">追加</button>
    		        @endif
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
