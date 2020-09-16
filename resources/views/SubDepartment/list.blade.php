@extends('layouts.master')
@section('content')
<div class="container" >
    <ol class="breadcrumb">
        <li><a href="{{url('departments')}}">Departments</a></li>
        <li><a href="#">Sub Departments</a></li>
    </ol>
	<header class="gird">
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>Sub Department List</h2> 
         @if(App\Helper::HasAccess('Create'))
        <span class="table-add mb-3 mr-2">
    		<a href="{{url('subdepartment/add')}}" title="Dashboard">
    			<i class="fa fa-lg fa fa-plus"></i> 
            </a>
    	</span>
        @endif
    </header> 
    @if(Session::has('message')!="")
    <div class="col-sm-offset-3 col-sm-6"> 
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('message') }}
        </div>
    </div> 
    @endif  
    <table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Department</th> 
                <th>Sub Department Name</th> 
                @if(App\Helper::HasAccess('Update') || App\Helper::HasAccess('Delete'))
                <th>Action</th>
                @endif 
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($subdepartments);$i++)
            <tr>
                <td>{{$subdepartments[$i]['Dept_Name']}}</td>
                <td>{{$subdepartments[$i]['Sub_Dept_Name']}}</td>

                @if(App\Helper::HasAccess('Update') ||  (App\Helper::HasAccess('Delete'))) 
                <td>
                @endif
                @if(App\Helper::HasAccess('Update'))
                    <a href="{{url('subdepartment/edit')}}/{{$subdepartments[$i]['Sub_Dept_Id']}}" data-href="#"  class="text-danger btn btn-default"><i class="fa fa-1x fa-edit"></i></a>
                @endif
                @if(App\Helper::HasAccess('Delete'))
                    <a href="{{url('subdepartment/delete')}}/{{$subdepartments[$i]['Sub_Dept_Id']}}/{{$subdepartments[$i]['Dept_Id']}}" class="text-danger btn btn-default"
                     onclick="return confirm('Are you sure you want to delete this item?');">
                     <i class="fa fa-1x fa-trash" ></i>
                    </a> 
                @endif
                @if(App\Helper::HasAccess('Update') ||  (App\Helper::HasAccess('Delete')))
                </td>
                @endif
            </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <th>Department</th> 
                <th>Sub Department Name</th>
                @if(App\Helper::HasAccess('Update') || App\Helper::HasAccess('Delete')) 
                <th>Action</th>  
                @endif               
            </tr>
        </tfoot>
    </table>
 </div>
@endsection