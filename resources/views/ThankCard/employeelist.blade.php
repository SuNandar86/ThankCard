@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">  
        <li><a href="#">Employee</a></li>
        <li><a href="#">ThankCard</a></li>
        <li><a href="#">Compose</a></li>
	</ol>
	<div class="gird" style="margin-top:30px;"> 
	   <h4>感謝カード作成</h4> 
    </div>
    <div id="card_content">
    	<div id="search">
    		<form class="form-horizontal" action="{{url('thankcard/employees/search')}}" method="post">
    			{{ csrf_field() }}
	    		<div class="form-group"> 
			    	<div class="col-sm-3"> 
			    		<label class="control-label" for="user_id">部署:</label>
				      	<select name="department_id"  class="form-control"  required="required" id="department_id">	
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
				        <label class="control-label" for="sub_department_id">課部署:</label>     
				        <select name="sub_department_id"  class="form-control" id="sub_department_id"  >
				        	<option value="%">Select Sub Department</option>
				        </select>
				    </div>
				    <div class="col-sm-3">
				    	<label class="control-label" for="sub_department_id">社員選択:</label>  
				    	<select name="employee_id"  class="form-control" id="employee_id">
				        	<option value="%">All</option> 
						</select>
				    </div>
				    <div class="col-sm-3">
				    	<label>&nbsp;</label>
						<button type="submit" class="btn btn-default btn-search" id="">検索</button>
				    </div>
			    </div>
			 </form> 
			  
        <table id="dtThankCard" class="table table-striped table-bordered" style="width:100%">
	        <thead>
	            <tr>
	            	<th>番号</th>
	                <th>写真</th>
	                <th>氏名</th>
	                <th>部署 </th> 
	                <th>課部署</th>  
	                <th>操作</th>
	            </tr>
	        </thead>
	        <tbody>
	            @for($i=0;$i<count($search_employees);$i++)
	                <tr>
	                	<td>{{$i+1}}</td>
	                    <td width="120" style="text-align: center;">
	                        <img src="{{ URL::asset('upload/images')}}/{{$search_employees[$i]['Emp_Id']}}/{{$search_employees[$i]['PhotoName']}}" width="80px" height="80px" />  
	                    </td> 
	                    <td>{{ $search_employees[$i]['Emp_Name']}}</td>
	                    <td>{{ $search_employees[$i]['Dept_Name']}}</td>
	                    <td>{{ $search_employees[$i]['Sub_Dept_Name']}}</td> 
	                    <td>
	                        <a href="{{url('thankcard/create')}}/{{ $search_employees[$i]['Emp_Name']}}/{{ $search_employees[$i]['Emp_Id']}}">Compose</a>
	                    </td>
	                </tr> 
	            @endfor
	        </tbody>
	        <tfoot>
	            <tr>
	            	<th>番号</th>
	                <th>写真</th>
	                <th>氏名</th>
	                <th>部署 </th> 
	                <th>課部署</th>  
	                <th>操作</th>                
	            </tr>
	        </tfoot>
    	</table>
    	</div>
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