@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="#">Report</a></li> 
        <li><a href="#">Receive Card Detail</a></li>
	</ol>
	<div id="card_content">
		<form class="form-horizontal"  method="post" id="frmSearch">
			{{ csrf_field() }}
			<div class="form-group"> 
				<div class="col-sm-offset-8  col-sm-4">
					<div class="col-sm-offset-6 col-md-3" style="margin-top: 19px;">
						<label class="control-label" for="sub_department_id">Order By:</label> 
				        <select name="order" class="form-control" style="width: 80px;">
				        	<option value="asc">ASC</option>
				        	<option value="desc">DESC</option>
				        </select>
				    </div>
				    <div class="col-md-2">
				    	<label>&nbsp;</label> 
						<button type="button" class="btn btn-default btn-search" id="btnPrint">
							<i class="fa fa-download" aria-hidden="true"></i> Print
						</button>
				    </div>
				</div> 
				<input type="hidden" name="dept_id" value="{{$data['dept_id']}}"/>
				<input type="hidden" name="sub_dept_id" value="{{$data['sub_dept_id']}}"/>
				<input type="hidden" name="from_emp_id" value="{{$data['from_emp_id']}}"/>
				<input type="hidden" name="to_emp_id" value="{{$data['to_emp_id']}}"/>
				<input type="hidden" name="from_date" value="{{$data['from_date']}}"/>
				<input type="hidden" name="to_date" value="{{$data['to_date']}}"/>
			</div> 
		</form>
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
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript">
	$("#btnPrint").click(function() { 
	    var form = $("#frmSearch");
	    var url = "<?php echo url('pdfreports/employee/thankcard/receive/detail');?>";  
	    $.ajax({
	       type: "POST",
	       url: url,
	       data: form.serialize(), // serializes the form's elements.
	       success: function(data)
	       {
	           
	       }
    }); 
});

</script>
@endsection