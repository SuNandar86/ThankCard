@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">Inbox</a></li>
        <li><a href="#">Receive</a></li>
	</ol>
	<div id="receive_content">
		@if(Session::has('receive.message')!="")
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6"> 
                <div class="alert {{Session::get('status')}}">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('receive.message') }}
                </div>
            </div> 
        </div>
        @endif  
        <div class="form-container" style="border: none;">
        	<form class="form-horizontal" action="{{url('thankcard/reply')}}/{{$thankcards[0]['Id']}}" method="post">
        		{{ csrf_field() }}  
        		<div class="form-group">
        			<label class="control-label col-sm-2" for="photo">&nbsp;</label>
	                <div class="col-sm-2 col-md-1" style="text-align: center;"> 
	                	@if($employee[0]['PhotoName'])
	                    	<img src="{{ URL::asset('upload/images')}}/{{$employee[0]['Emp_Id']}}/{{$employee[0]['PhotoName']}}" class="rounded-circle" alt="Cinque Terre" > 
	                    @else
	                    	<img src="{{URL::asset('img/default.jpg')}}" class="rounded-circle"/>  
	                    @endif
	                    <br/>
	                    <span class="display_name"><strong>{{$employee[0]['Emp_Name']}}</strong></span><br/> 
	                </div>  
	                <div class="col-sm-7 col-md-8">
	                	<div class="message"> 
	                	    {{$thankcards[0]['SendText']}} 
	                	</div>
	                	<div class="message_date">
	                		 <span><strong> Date:{{date('d-m-Y H:i:s',strtotime($thankcards[0]['SendDate']))}} <strong></span>
	                	</div>
	                </div>
        		</div>
        		<div class="form-group"> 
        			@if($thankcards[0]['ReplyText'])
        			<div id="reply_message">
            			<label class="control-label col-sm-2" for="photo">&nbsp;</label>
            			<div class="col-sm-2 col-md-1" style="text-align: center;"> 
            				@if({$user['employee_photo'])
		                    	<img src="{{ URL::asset('upload/images')}}/{{$user['employee_id']}}/{{$user['employee_photo']}}" class="rounded-circle" alt="Cinque Terre"  > 
		                    @else
		                    	<img src="{{URL::asset('img/default.jpg')}}" class="rounded-circle"/> 
		                    @endif
		                    <br/>
		                    <span class="display_name"><strong>{{$user['employee_name']}}</strong></span><br/> 
		                </div>
		                <div class="col-sm-7 col-md-8">
		                	 <a href="#" data-href="#" id="reply_edit" class="text-danger reply_edit" title="Edit your reply">
		                	 	<i class="fa fa-1x fa-edit"></i>
		                	 </a>
		                	<div class="message"> 
		                	    {{$thankcards[0]['ReplyText']}} 
		                	</div>
		                	<div class="message_date">
		                		 <span><strong> Date:{{date('d-m-Y H:i:s',strtotime($thankcards[0]['ReplyDate']))}} <strong></span>
		                	</div> 
		                </div> 
		            </div>
		            @endif
	                <div id="reply_message_edit">
	                	<label class="control-label col-sm-2" for="photo">&nbsp;</label>
            			<div class="col-sm-2 col-md-1"> 
		                    <img src="{{ URL::asset('upload/images')}}/{{$user['employee_id']}}/{{$user['employee_photo']}}" class="rounded-circle" alt="Cinque Terre"><br/>
		                    <span class="display_name"><strong>{{$user['employee_name']}}</strong></span><br/>
		                    <br/> 
		                </div> 
	                	<div class="col-sm-7 col-md-8" > 
            			    <input type="text" name="reply_message"   class="form-control txt_message" 
            			    value="{{$thankcards[0]['ReplyText']}}"/> 
            			    <button type="submit" class="btn btn-default  reply" >
            			    	<i class="fa fa-reply" aria-hidden="true"></i> Reply</button>
            			    @if($thankcards[0]['ReplyText'])
            			    <button type="button" class="btn btn-default  cancel" id="btn_cancel">Cancel</button>
            			    @endif
        				</div> 
	                </div>
        		</div> 
        	</form>
        </div> 
	</div>
</div>
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript">
	$("#reply_edit").click(function(){ 
		$("#reply_message").hide();
		$("#reply_message_edit").show();
	})
	$("#btn_cancel").click(function(){
		$("#reply_message").show();
		$("#reply_message_edit").hide();
	})
</script>
@endsection
