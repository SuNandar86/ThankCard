@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Report</a></li>
        <li><a href="#">Employee</a></li>
        <li><a href="#">Receive Score Detail</a></li>
	</ol>
	<div id="card_content">
		<table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
			<thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Department</th>
                <th>Date</th>  
                <th>Total Score</th> 
            </tr>
	        </thead>
	        <tbody>
	        	@for($i=0;$i<count($thankcards);$i++)
		            <td>{{$i+1}}</td>  
		            <td>{{ $thankcards[$i]['To_Emp']}}</td>
		            <td>{{ $thankcards[$i]['To_Dep_Name']}}</td> 
		            <td><!-- {{ $thankcards[$i]['Emp_Name']}}  --></td> 
		            <td>{{ $thankcards[$i]['CountResult']}}</td> 
		            <td>
			            <a href="#" title="View"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
			       </td>
		        @endfor
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>No</th>
	                <th>Name</th>
	                <th>Department</th>
	                <th>Date</th>  
	                <th>Total Score</th>                
	            </tr>
	        </tfoot> 
		</table>
	</div>
@endsection