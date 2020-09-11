@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Report</a></li>
        <li><a href="#">Receive Score By Employee</a></li>
	</ol>
	<div id="card_content">
		<form class="form-horizontal" action="{{url('reports/employee/thankcard/receive/score')}}" method="post">
			{{ csrf_field() }}
			<div class="form-group">
				<div class="col-sm-offset-10 col-sm-2">
					<button type="submit" class="btn btn-default btn-search" id="">
					  <i class="fa fa-eye" aria-hidden="true"></i> View
				    </button> 
					<button type="submit" class="btn btn-default btn-search" id="">
						<i class="fa fa-print" aria-hidden="true"></i> Print
					</button>
				</div>
			</div>
			<div class="form-group"> 
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
					<label class="control-label" for="department_id">Department:</label>
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
				<div class="col-sm-3">
					<label class="control-label">Sub Department:</label> 
			        <select name="sub_department_id"  class="form-control" id="sub_department_id">
			        	<option value="%">Select Sub Department</option>
			        </select>
				</div> 
				<div class="col-sm-1">
					<label class="control-label" >Order By:</label> 
			        <select name="order" class="form-control">
			        	<option value="asc">ASC</option>
			        	<option value="desc">DESC</option>
			        </select>
				</div>
				<div class="col-sm-2">
					<label class="control-label">Employee:</label>
					<select name="employee_id"  class="form-control" >
			        	<option value="%">All</option>
			         	@php
			        	    $employee=Request::old('employee_id');
		                @endphp
			        	@for($i=0;$i<count($employees);$i++)
				        	@if($employees[$i]['Emp_Id']==$employee)
				        		<option value="{{$employees[$i]['Emp_Id']}}" selected="selected">{{$employees[$i]['Emp_Name']}}</option>
				        	@else
				        		<option value="{{$employees[$i]['Emp_Id']}}">{{$employees[$i]['Emp_Name']}}</option>
				        	@endif
			        	@endfor 
					</select>
				</div> 
			</div> 

		</form>
		<table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Department</th>
                <th>Sub Department </th> 
                <th>Name</th> 
                <th>From</th> 
                <th>To</th> 
                <th>Total Score</th>
                <th>Action</th>  
            </tr>
        </thead>
        <tbody>
        	@for($i=0;$i<count($thankcards);$i++)
	            <td>{{$i+1}}</td>  
	            <td>{{ $thankcards[$i]['Dept_Name']}}</td>
	            <td>{{ $thankcards[$i]['Sub_Dep_Name']}}</td> 
	            <td>{{ $thankcards[$i]['Emp_Name']}} </td>
	            <td>{{ $thankcards[$i]['f_date']}}</td>
	            <td>{{ $thankcards[$i]['t_date']}}</td>
	            <td>{{ $thankcards[$i]['CountResult']}}</td> 
	            <td>
		            <a href="{{url('reports/employee/thankcard/receive/detail')}}
										            			   /{{$thankcards[$i]['To_Emp_Id']}}}}
										            			   /{{$thankcards[$i]['Dep_Id']}}}}
										            			   /{{$thankcards[$i]['Sub_Dept_Id']}}}}
										            			   /{{$thankcards[$i]['f_date']}}}}
										            			   /{{$thankcards[$i]['t_date']}}}}" 
										            			   title="View">
		            	<i class="fa fa-eye" aria-hidden="true"></i> View
		            </a>
		       </td>
	        @endfor
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Department</th>
                <th>Sub Department </th>
                <th>Name</th>  
                <th>From</th> 
                <th>To</th> 
                <th>Total Score</th> 
                <th>Action</th>               
            </tr>
        </tfoot>
    </table>
	</div>
</div>
 
@endsection