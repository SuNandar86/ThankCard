@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">ThankCard</a></li>
        <li><a href="#">Sent</a></li>
	</ol>
	<div class="gird" style="margin-top:30px;"> 
	   <h2>Your's Sent List</h2> 
    </div>
	<div id="card_content">
		<div id="search">
    		<form class="form-horizontal" action="{{url('thankcard/sent')}}" method="post">
    			{{ csrf_field() }}
	    		<div class="form-group">
	    			<div class="col-sm-2">
		    			<label for="employee_id">Select Employee:</label>
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
@endsection