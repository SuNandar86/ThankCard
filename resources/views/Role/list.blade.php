@extends('layouts.master')
@section('content')
<div class="container" >
    <ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Role</a></li>
    </ol>
	<header class="gird">
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>Role List</h2> 
        <span class="table-add mb-3 mr-2">
    		<a href="{{url('role/add')}}" title="Dashboard">
    			<i class="fa fa-lg fa fa-plus"></i> 
            </a>
    	</span>
    </header>
    <table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Active</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($roles);$i++)
            <tr>
                <td>{{$roles[$i]['Name']}}</td>
                <td>
                    @if($roles[$i]['isActive'])
                        Yes
                    @else
                        No
                    @endif
                </td> 
                <td>
                    <a href="{{url('role/edit')}}/{{$roles[$i]['Id']}}" data-href="#"  class="text-danger btn btn-default"><i class="fa fa-1x fa-edit"></i></a>
                    <a href="{{url('role/delete')}}/{{$roles[$i]['Id']}}" class="text-danger btn btn-default"><i class="fa fa-1x fa-trash"></i></a> 
                </td>
            </tr>
            @endfor                 
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Active</th>
                <th>Action</th>                 
            </tr>
        </tfoot>
    </table>
 </div>
@endsection