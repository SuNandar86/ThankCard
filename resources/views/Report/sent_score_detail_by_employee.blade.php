@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Report</a></li>
        <li><a href="#">Employee</a></li>
        <li><a href="#">Sent Score Detail</a></li>
	</ol>
	<div id="card_content">
		<table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
			<thead>
            <tr>
                <th>No</th>
                <th>From</th>
                <th>Department</th>
                <th>To</th> 
                <th>Date</th>                
                <th>Total Score</th> 
            </tr>
	        </thead>
	        <tbody>
	        	@for($i=0;$i<count($thankcards);$i++)
	        		<tr>
			            <td>{{$i+1}}</td>  
			            <td>{{ $thankcards[$i]['From_Emp']}}</td>
			            <td>{{ $thankcards[$i]['From_Dep_Name']}}</td> 
			            <td>{{ $thankcards[$i]['To_Emp']}} </td> 
			            <td>{{date('d-m-Y',strtotime($thankcards[$i]['Send_Date']))}}</td>
			            <td>{{ $thankcards[$i]['CountResult']}}</td>  
		        	</tr>
		        @endfor
	        </tbody>
	        <tfoot>
	            <tr>
	                <th>No</th>
	                <th>From</th>
	                <th>Department</th>
	                <th>To</th>  
	                <th>Date</th>
	                <th>Total Score</th>                
	            </tr>
	        </tfoot> 
		</table>
	</div>
@endsection