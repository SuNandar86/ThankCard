@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="#">ThankCard</a></li>
        <li><a href="#">Sent</a></li>
	</ol>
	<div class="gird"> 
	   <h4>{{App\Helper::EmployeeName()}}'s Sent List</h4>
    </div>
	<div id="card_content">
		<div id="search">
    		<form class="form-horizontal" action="{{url('thankcard/sent')}}" method="post">
    			{{ csrf_field() }}
	    		<div class="form-group">
	    			<div class="col-sm-2">
						<label class="control-label" for="user_id">Department:</label>
				      	<select name="department_id"  class="form-control"  id="department_id">	
			      			@php
					        	$department_id=Request::old('department_id');
				            @endphp
				        	<option value="%">All</option>
				        	@for($i=0;$i<count($departments);$i++)
					        	@if($departments[$i]['Id']==$department_id)
					        		<option value="{{$departments[$i]['Id']}}" selected="selected">{{$departments[$i]['Name']}}</option>
					        	@else
					        		<option value="{{$departments[$i]['Id']}}">{{$departments[$i]['Name']}}</option>
					        	@endif
				        	@endfor 
					    </select>
					</div>
					<div class="col-sm-2">
						<label class="control-label" for="sub_department_id">Sub Department:</label>
				        <select name="sub_department_id"  class="form-control" id="sub_department_id">
				        	<option value="%">All</option>
				        </select>
					</div>
	    			<div class="col-sm-2">
		    			<label for="employee_id">Select Employee:</label>
						<select name="employee_id"  class="form-control" id="employee_id" >
				        	<option value="%">All</option> 
						</select>
					</div>
					<div class="col-sm-2">
						<label for="email">From:</label>
						<input type="date" id="from_date" name="from_date" class="form-control"
						value="{{Request::old('from_date')}}">
					</div>
					<div class="col-sm-2">
						<label for="email">To:</label>
						<input type="date" id="to_date" name="to_date" class="form-control"
						value="{{Request::old('to_date')}}" >
					</div>
					<div class="col-sm-2">
						<label>&nbsp;</label>
						<button type="submit" class="btn btn-default btn-search">Search</button>
						<a  href="{{url('thankcard/employees')}}" class="btn btn-default btn-search" style="width: 80px;">Compose</a>
					</div>
				</div>	
    		</form>	
	    </div>
	    <table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
		        <thead>
		            <tr>
		            	<th>No</th>
		                <th>Name</th>
		                <th>Department</th>
		                <th>Sub Department</th>
		                <th>Date</th>
		                <th>Card</th>
		                <th>Status</th> 
		                <th>Action</th> 
		            </tr>
		        </thead>
		        <tbody>
		            @for($i=0;$i<count($thankcards);$i++)
		            <tr>
		            	<td>{{$i+1}}</td>
		            	<td>{{$thankcards[$i]['Emp_Name']}}</td>
		            	<td>{{$thankcards[$i]['Dept_Name']}}</td>
		            	<td>{{$thankcards[$i]['Sub_Dept_Name']}}</td>
		            	<td>{{date('d-m-Y',strtotime($thankcards[$i]['Date']))}}</td>
		            	<td>1</td>
		            	<td>{{$thankcards[$i]['Status']}}</td>
		            	<td>
		            		<a href="{{url('thankcard/sent/detail')}}/{{$thankcards[$i]['Thank_Id']}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
		            	</td>
		            </tr>	
		            @endfor
		        </tbody>
		        <tfoot>
		            <tr>
		                <th>No</th>
		                <th>Name</th>
		                <th>Department</th>
		                <th>Sub Department</th>
		                <th>Date</th>
		                <th>Card</th>
		                <th>Status</th> 
		                <th>Action</th>                  
		            </tr>
		        </tfoot>
		    </table>
	</div>
</div>
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('js/cascade_select.js') }}"></script>
<script type="text/javascript">  
    var subdepartments = <?php echo json_encode(isset($subdepartments)?$subdepartments:""); ?>;
 	var sel_value =  "<?php echo  Request::old('sub_department_id')!=""?
							  Request::old('sub_department_id'):"%"; ?>";
    var employees =<?php echo json_encode($employees);?>;  

    var sel_emp_val ="<?php echo  Request::old('employee_id')!=""?
							  Request::old('employee_id'):"%"; ?>"; 
 
     
</script>
@endsection