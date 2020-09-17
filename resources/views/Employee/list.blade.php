@extends('layouts.master')
@section('content')
<div class="container" >
    <ol class="breadcrumb"> 
        <li><a href="#">Employee</a></li>
    </ol>
	<header class="gird">
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>社員一覧</h2> 
        @if(App\Helper::HasAccess('Create') )
        <span class="table-add mb-3 mr-2">
    		<a href="{{ url('employee/add')}}" title="Dashboard">
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
                <th>写真</th>
                <th>氏名</th>
                <th>ユーザー名</th>
                <th>部署 </th> 
                <th>課部署</th> 
                <th>住所</th> 
                <th>作成日</th> 
                @if(App\Helper::HasAccess('Update') ||  (App\Helper::HasAccess('Delete')))
                <th>操作</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($employees);$i++)
                <tr>
                    <td>
                        @if(isset($employees[$i]['PhotoName']) && $employees[$i]['PhotoName']!="")
                            <img src="{{ URL::asset('upload/images')}}/{{$employees[$i]['Emp_Id']}}/{{$employees[$i]['PhotoName']}}" width="100px" height="100px" />  
                        @else
                            <img src="{{URL::asset('img/default.jpg')}}" class="rounded-circle"/>  
                        @endif
                    </td> 
                    <td>{{ $employees[$i]['Emp_Name']}}</td>
                    <td>{{ $employees[$i]['User_Name']}}</td>
                    <td>{{ $employees[$i]['Dept_Name']}}</td>
                    <td>{{ $employees[$i]['Sub_Dept_Name']}}</td> 
                    <td>{{ $employees[$i]['Address']}}</td> 
                    <td>{{date('d-m-Y',strtotime($employees[$i]['Created_Date']))}}</td>
                    @if(App\Helper::HasAccess('Update') ||  (App\Helper::HasAccess('Delete')))
                    <td>
                    @endif
                        @if(App\Helper::HasAccess('Update'))
                        <a href="{{url('employee/edit')}}/{{$employees[$i]['Emp_Id']}}" data-href="#"  class="text-danger btn btn-default"><i class="fa fa-1x fa-edit"></i></a>
                        @endif
                        @if(App\Helper::HasAccess('Delete'))
                        <a href="{{url('employee/delete')}}/{{$employees[$i]['Emp_Id']}}" class="text-danger btn btn-default"  onclick="return confirm('Are you sure you want to delete this item?');">
                            <i class="fa fa-1x fa-trash"></i>
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
                <th>写真</th>
                <th>氏名</th>
                <th>ユーザー名</th>
                <th>部署 </th> 
                <th>課部署</th> 
                <th>住所</th> 
                <th>作成日</th> 
                @if(App\Helper::HasAccess('Update') ||  (App\Helper::HasAccess('Delete')))
                <th>操作</th>
                @endif          
            </tr>
        </tfoot>
    </table>
 </div>
@endsection