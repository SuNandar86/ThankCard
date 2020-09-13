@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Report</a></li>
        <li><a href="#">Department Relation</a></li>
	</ol>
	<div id="card_content">
		<form class="form-horizontal" action="{{url('reports/thankcard/department/relation')}}" method="post" id="frmSearch">
			{{ csrf_field() }}
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
				<div class="col-sm-3">
					<label class="control-label" for="sub_department_id">Sub Department:</label> 
			        <select name="sub_department_id"  class="form-control" id="sub_department_id">
			        	<option value="%">Select Sub Department</option>
			        </select>
				</div> 
				<div class="col-sm-1">
					<label class="control-label" for="sub_department_id">Order By:</label> 
			        <select name="order" class="form-control">
			        	<option value="asc">ASC</option>
			        	<option value="desc">DESC</option>
			        </select>
				</div>
				<div class="col-sm-2">
					<label>&nbsp;</label>
						<button type="submit" class="btn btn-default btn-search" id="">
						  <i class="fa fa-eye" aria-hidden="true"></i> View
					    </button> 
						<button type="submit" class="btn btn-default btn-search" id="btnPrint">
							<i class="fa fa-download" aria-hidden="true"></i> Print
						</button>
				</div>
			</div>

		</form>
		 <table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>From Department</th>
                <th>To Department </th> 
                <th>From</th> 
                <th>To</th> 
                <th>Total Score</th> 
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($thankcards);$i++)
                <tr>
                    <td>{{$i+1}}</td>  
                    <td>{{ $thankcards[$i]['F_Dept_Name']}}</td>
                    <td>{{ $thankcards[$i]['T_Dept_Name']}}</td> 
                    <td>{{ $thankcards[$i]['f_date']}}</td>
                    <td>{{ $thankcards[$i]['t_date']}}</td>
                    <td>{{ $thankcards[$i]['CountResult']}}</td> 
                </tr> 
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>From Department</th>
                <th>To Department </th> 
                <th>From</th> 
                <th>To</th> 
                <th>Total Score</th>                
            </tr>
        </tfoot>
    </table>
	</div>
</div>
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('js/cascade_select.js') }}"></script>
<script type="text/javascript">  
    var subdepartments = <?php echo json_encode(isset($subdepartments)?$subdepartments:""); ?>;
 	var sel_value = "%";

	$("#btnPrint").click(function() {  
	    var form = $("#frmSearch");
	    var url = "<?php echo url('pdfreports/thankcard/department/relation');?>";  
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