@extends('layouts.master')
@section('content')
<div class="container" >
    <ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Employee</a></li>
    </ol>
	<header class="gird">
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>Employee List</h2> 
        <span class="table-add mb-3 mr-2">
    		<a href="{{ url('employee/add')}}" title="Dashboard">
    			<i class="fa fa-lg fa fa-plus"></i> 
            </a>
    	</span>
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
                <th>Photo</th>
                <th>Name</th>
                <th>Department </th> 
                <th>Subdepartment</th> 
                <th>User Name</th> 
                <th>Address</th> 
                <th>Email</th> 
                <th>Phone</th>
                <th>Created At</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($employees);$i++)
                <tr>
                    <td>
                        <img src="{{ URL::asset('upload/images')}}/{{$employees[$i]['Emp_Id']}}/{{$employees[$i]['PhotoName']}}" width="100px" height="100px" />  
                    </td> 
                    <td>{{ $employees[$i]['Emp_Name']}}</td>
                    <td>{{ $employees[$i]['Dept_Name']}}</td>
                    <td>{{ $employees[$i]['Sub_Dept_Name']}}</td>
                    <td>{{ $employees[$i]['User_Name']}}</td>
                    <td>{{ $employees[$i]['Address']}}</td>
                    <td>{{ $employees[$i]['Email']}}</td>
                    <td>{{ $employees[$i]['Phone']}}</td> 
                    <td>{{date('d-m-Y',strtotime($employees[$i]['Created_Date']))}}</td>
                    <td>
                        <a href="{{url('employee/edit')}}/{{$employees[$i]['Emp_Id']}}" data-href="#"  class="text-danger btn btn-default"><i class="fa fa-1x fa-edit"></i></a>
                        <a href="{{url('employee/delete')}}/{{$employees[$i]['Emp_Id']}}" class="text-danger btn btn-default"><i class="fa fa-1x fa-trash"></i></a>
                    </td>
                </tr> 
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Department </th> 
                <th>Subdepartment</th> 
                <th>User Name</th> 
                <th>Address</th> 
                <th>Email</th> 
                <th>Phone</th>
                <th>Created At</th> 
                <th>Action</th>                
            </tr>
        </tfoot>
    </table>
 </div>
@endsection