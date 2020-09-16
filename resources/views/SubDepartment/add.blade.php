@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="{{ url('subdepartments') }}">Sub Department</a></li>
        <li><a href="#">{{$action}}</a></li>
    </ol>
    <header class="gird">
        <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
        <h2>Sub Department {{$action}}</h2> 
    </header> 
    <div class="form-container">
    	@php
    	    if($subdepartment->id){
    		  $path =url('subdepartment/update/').'/'.$subdepartment->id;
    	    }else{
    		  $path =url('subdepartment/add') ;
    	    }
    	@endphp
    	<form class="form-horizontal " action="{{$path}}" method="post">
    		{{ csrf_field() }}     		
			@if(Session::has('subdept.message')!="")
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6"> 
                    <div class="alert {{Session::get('status')}}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('subdept.message') }}
                    </div>
                </div> 
            </div>
            @endif 
             <div class="form-group">
                <label class="control-label col-sm-3" for="user_id">Departments:</label>
                <div class="col-sm-6">          
                    <select name="department_id"  class="form-control"  required="required">
                        <option value="">Select Department</option>
                        @php
                            $subdepartment_id=Request::old('department_id')!=""?
                                             Request::old('department_id'):$subdepartment->department_id;
                        @endphp
                        @for($i=0;$i<count($departments);$i++)
                            @if($departments[$i]['Id']==$subdepartment_id)
                                <option value="{{$departments[$i]['Id']}}" selected="selected">{{$departments[$i]['Name']}}</option>
                            @else
                                <option value="{{$departments[$i]['Id']}}">{{$departments[$i]['Name']}}</option>
                            @endif
                        @endfor 
                    </select>
                </div>
            </div>  
		    <div class="form-group">
		      <label class="control-label col-sm-3" for="name">Name:</label>
		      <div class="col-sm-6">
		        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{Request::old('name')!=""?Request::old('name'):$subdepartment->name}}" required="required">
		      </div>
		    </div> 
		    <div class="form-group">        
		      	<div class="col-sm-offset-8 col-sm-2">
    		      	@if($subdepartment->id)
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