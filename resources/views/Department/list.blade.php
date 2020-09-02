@extends('layouts.master')
@section('content')
<div class="container" >
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Departments</a></li>
    </ol>
	<header class="gird">
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>Department List</h2> 
        <span class="table-add mb-3 mr-2">
    		<a href="#" title="Dashboard">
    			<i class="fa fa-lg fa fa-plus"></i> 
            </a>
    	</span>
    </header>
    <table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Password</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td> 
            </tr>
                 
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Password</th>
                 
            </tr>
        </tfoot>
    </table>
 </div>
@endsection