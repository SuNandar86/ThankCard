@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">ThankCard</a></li>
        <li><a href="#">Employee</a></li>
	</ol>
	<div class="gird" style="margin-top:30px;"> 
	   <h2>Please give card for...</h2> 
    </div>
    <div id="card_content">
    	<div id="search">
    		<form class="form-horizontal" action="{{url('thankcard/employees/search')}}" method="post">
    			{{ csrf_field() }}
	    		<div class="form-group"> 
			    	<div class="col-sm-3"> 
			    		<label class="control-label" for="user_id">Department:</label>
				      	<select name="department_id"  class="form-control"  required="required" id="department_id">	
			      			@php
					        	$department_id=Request::old('department_id');
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
				    <div class="col-sm-3">     
				        <label class="control-label" for="sub_department_id">Sub Department:</label>     
				        <select name="sub_department_id"  class="form-control" id="sub_department_id">
				        	<option value="%">Select Sub Department</option>
				        </select>
				    </div>
				    <div class="col-sm-3">
				    	<label class="control-label" for="sub_department_id">Select Employee:</label>  
				    	<select name="employee_id"  class="form-control" >
				        	<option value="%">All</option>
				         	@php
				        	    $employee=Request::old('employee');
			                @endphp
				        	@for($i=0;$i<count($employees);$i++)
					        	@if($employees[$i]['Emp_Id']==$employee)
					        		<option value="{{$employees[$i]['Emp_Id']}}" selected="selected">{{$roles[$i]['Name']}}</option>
					        	@else
					        		<option value="{{$employees[$i]['Emp_Id']}}">{{$employees[$i]['Emp_Name']}}</option>
					        	@endif
				        	@endfor 
						</select>
				    </div>
				    <div class="col-sm-3">
				    	<label>&nbsp;</label>
						<button type="submit" class="btn btn-default btn-search" id="">Search</button>
				    </div>
			    </div>
			 </form> 
			  
        <table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
	        <thead>
	            <tr>
	            	<th>No</th>
	                <th>Photo</th>
	                <th>Name</th>
	                <th>Department </th> 
	                <th>Subdepartment</th>  
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>
	            @for($i=0;$i<count($employees);$i++)
	                <tr>
	                	<td>{{$i+1}}</td>
	                    <td width="120" style="text-align: center;">
	                        <img src="{{ URL::asset('upload/images')}}/{{$employees[$i]['Emp_Id']}}/{{$employees[$i]['PhotoName']}}" width="80px" height="80px" />  
	                    </td> 
	                    <td>{{ $employees[$i]['Emp_Name']}}</td>
	                    <td>{{ $employees[$i]['Dept_Name']}}</td>
	                    <td>{{ $employees[$i]['Sub_Dept_Name']}}</td> 
	                    <td>
	                        <a href="{{url('thankcard/create')}}/{{ $employees[$i]['Emp_Name']}}/{{ $employees[$i]['Emp_Id']}}">Create</a>
	                    </td>
	                </tr> 
	            @endfor
	        </tbody>
	        <tfoot>
	            <tr>
	            	<th>No</th>
	                <th>Photo</th>
	                <th>Name</th>
	                <th>Department </th> 
	                <th>Subdepartment</th> 
	                <th>Action</th>                
	            </tr>
	        </tfoot>
    	</table>
    	</div>
    </div>
</div> 
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript"> 
var departments    = <?php echo json_encode($departments); ?>;
var subdepartments = <?php echo json_encode($subdepartments); ?>;

$(document).ready(function(){ 
	$dep_id=$("#department_id").val(); 
	getSubDepartment($dep_id);
	$("#sub_department_id").val('%');
 });	
$('#department_id').change(function() { 
 	getSubDepartment($(this).val(),'');
 	$("#sub_department_id").val('');
});
function getSubDepartment($id){ 
	$("#sub_department_id").html('');
	$("#sub_department_id").append(new Option('Select Sub Department', '%'));
	 
	$.each(subdepartments, function(key, item){ 
		if(item.Dept_Id ==$id){
			$("#sub_department_id").append(new Option(item.Sub_Dept_Name, item.Sub_Dept_Id));
		} 
    }); 
 } 

</script>
@endsection
<!-- $filepath = public_path('uploads/image/')."abc.jpg";
return Response::download($filepath); -->