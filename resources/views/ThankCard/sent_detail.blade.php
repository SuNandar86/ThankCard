@extends('layouts.master')
@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="{{url('thankcard/sent')}}">Sent</a></li>
        <li><a href="#">Detail</a></li>
	</ol>
	<div id="receive_content">
		<div class="form-container" style="border:none">
			<div class="row"> 
				<div class="col-sm-2 col-sm-offset-2 col-md-1" style="text-align: center;">
					@if($thankcard[0]['From_Employee_Photo'])
						<img src="{{URL::asset('upload/images')}}/{{$thankcard[0]['From_Employee_Id']}}/{{$thankcard[0]['From_Employee_Photo']}}"
						class="rounded-circle" />
						<br/>
					@else
						<img src="{{URL::asset('img/default.jpg')}}"
						class="rounded-circle"/>
						<br/>
					@endif
		            <span class="display_name"><strong>Me</strong></span><br/>
				</div> 
				<div class="col-sm-7 col-md-8">
	            	<div class="message"> 
	            	    {{$thankcard[0]['SendText']}} 
	            	</div>
	            	<div class="message_date">
	            		 <span><strong> Date:{{date('d-m-Y H:i:s',strtotime($thankcard[0]['SendDate']))}} <strong></span>
	            	</div>
		        </div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-2 col-sm-offset-2 col-md-1" style="text-align: center;">
		    		@if($thankcard[0]['To_Employee_Photo'])
						<img src="{{URL::asset('upload/images')}}/{{$thankcard[0]['To_Employee_Id']}}/{{$thankcard[0]['To_Employee_Photo']}}"
						class="rounded-circle" />
					@else
						<img src="{{URL::asset('img/default.jpg')}}"
						class="rounded-circle"/>
						<br/>
					@endif
					<br/>
		            <span class="display_name"><strong>{{$thankcard[0]['To_Employee_Name']}}</strong></span><br/>
				</div> 
				<div class="col-sm-7 col-md-8">
	            	<div class="message"> 
	            	    {{$thankcard[0]['ReplyText']}} 
	            	</div>
	            	<div class="message_date">
	            		 <span><strong> Date:{{date('d-m-Y H:i:s',strtotime($thankcard[0]['ReplyDate']))}} <strong></span>
	            	</div>
		        </div>
		    </div>
		</div>
	</div>
</div>
@endsection