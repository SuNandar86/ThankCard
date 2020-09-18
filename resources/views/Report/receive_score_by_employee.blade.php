@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="#">Report</a></li>
        <li><a href="#">Total Received Card By Employee</a></li>
	</ol>
	<div id="card_content"> 
		<form class="form-horizontal" action="{{url('reports/employee/thankcard/receive/score')}}" method="post" id="frmSearch">
			{{ csrf_field() }}
			<div class="form-group">
				<div class="col-sm-offset-9 col-sm-3">
					<button type="submit" class="btn btn-default btn-search" id=""
					 style="margin-left: 92px;">
					  <i class="fa fa-eye" aria-hidden="true"></i> 検索
				    </button> 
					<button type="button" class="btn btn-default btn-search right" id="btnPrint">
						<i class="fa fa-download" aria-hidden="true"></i> プリント
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
					<label class="control-label" for="department_id">部署:</label>
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
					<label class="control-label">課部署:</label> 
			        <select name="sub_department_id"  class="form-control" id="sub_department_id">
			        	<option value="%">Select Sub Department</option>
			        </select>
				</div> 
				<div class="col-sm-2">
					<label class="control-label">社員選択:</label>
					<select name="employee_id"  class="form-control" id="employee_id" >
			        	<option value="%">All</option> 
					</select>
				</div> 
				<div class="col-sm-1">
					<label class="control-label" >並び順:</label> 
			        <select name="order" class="form-control">
			        	<option value="asc">降順</option>
			        	<option value="desc">昇順</option>
			        </select>
				</div> 
			</div>  
		</form>
		<table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>番号</th>
                <th>氏名</th> 
                <th>部署</th>
                <th>課部署 </th> 
                <th>From</th> 
                <th>To</th> 
                <th>合計</th>
                <th>操作</th>  
            </tr>
        </thead>
        <tbody>
        	@for($i=0;$i<count($thankcards);$i++)
        	  <tr>
	            <td>{{$i+1}}</td>  
	            <td>{{ $thankcards[$i]['Emp_Name']}} </td>
	            <td>{{ $thankcards[$i]['Dept_Name']}}</td>
	            <td>{{ $thankcards[$i]['Sub_Dep_Name']}}</td>  
	            <td>{{ date('d-m-Y',strtotime($thankcards[$i]['f_date']))}}</td>
	            <td>{{ date('d-m-Y',strtotime($thankcards[$i]['t_date']))}}</td>
	            <td>{{ $thankcards[$i]['CountResult']}}</td> 
	            <td>
		            <a href="{{url('reports/employee/thankcard/receive/detail')}}/{{$thankcards[$i]['To_Emp_Id']}}/{{$thankcards[$i]['Dep_Id']}}/{{$thankcards[$i]['Sub_Dept_Id']}}/{{$thankcards[$i]['f_date']}}/{{$thankcards[$i]['t_date']}}" 
										            			   title="View">
		            	<i class="fa fa-eye" aria-hidden="true"></i> View
		            </a>
		       </td>
		      </tr>
	        @endfor
        </tbody>
        <tfoot>
            <tr>
                <th>番号</th>
                <th>氏名</th> 
                <th>部署</th>
                <th>課部署 </th> 
                <th>From</th> 
                <th>To</th> 
                <th>合計</th>
                <th>操作</th>              
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

$("#btnPrint").click(function() {  
    var form = $("#frmSearch");
    var url = "<?php echo url('pdfreports/employee/thankcard/receive/score');?>";  
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