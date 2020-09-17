@extends('layouts.master')
@section('content')
<div class="container" >
    <ol class="breadcrumb"> 
        <li><a href="#">Role</a></li>
    </ol>
	<header class="gird">
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>権限一覧</h2>  
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
                <th>氏名</th> 
                @if(App\Helper::HasAccess('Update'))
                <th>操作</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($roles);$i++)
            <tr>
                <td>{{$roles[$i]['Name']}}</td> 
                @if(App\Helper::HasAccess('Update'))
                <td>
                    <a href="{{url('role/edit')}}/{{$roles[$i]['Id']}}" data-href="#"  class="text-danger btn btn-default"><i class="fa fa-1x fa-edit"></i></a> 
                </td>
                @endif
            </tr>
            @endfor                 
        </tbody>
        <tfoot>
            <tr>
               <th>氏名</th> 
                @if(App\Helper::HasAccess('Update'))
                <th>操作</th>
                @endif                
            </tr>
        </tfoot>
    </table>
 </div>

@endsection
