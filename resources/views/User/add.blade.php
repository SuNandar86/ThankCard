@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="{{url('users')}}">Users</a></li>
        <li><a href="#">{{$action}}</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>User {{$action}}</h2> 
    </header> 
    <div class="form-container">
    	@php
    	    if($user->id){
    		  $path =url('user/update/').'/'.$user->id;
    	    }else{
    		  $path =url('user/add');
    	    }
    	@endphp
    	<form class="form-horizontal " action="{{$path}}" method="post">
    		{{ csrf_field() }}
    		@if(Session::has('user.message')!="")
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6"> 
                    <div class="alert {{Session::get('status')}}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('user.message') }}
                    </div>
                </div> 
            </div>
            @endif    
    		@if(Session::has('user.message') && Session::get('user.message') !="" )
			<div class="form-group"> 
			    <div class="col-sm-offset-3 col-sm-6"> 
			        <div class="alert {{Session::get('user.status')}}">
			            {{ Session::get('message') }}
			        </div>
			    </div> 
			</div> 
		    @endif 
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="email">User Name:</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="email" placeholder="Enter User Name" name="user_name" value="{{Request::old('name')!=""?Request::old('name'):$user->name}}" required="required">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="pwd">Password:</label>
		      <div class="col-sm-6">          
		        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password"  value="{{Request::old('password')!=""?Request::old('password'):$user->password}}"  required="required">
		      </div>
		    </div>  
		    <div class="form-group">
		    	<label class="control-label col-sm-3" for="pwd">Role:</label>
		    	<div class="col-sm-6"> 
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
		    <div class="form-group">        
		      <div class="col-sm-offset-8 col-sm-2">
    		      	@if($user->id)
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