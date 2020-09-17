@extends('layouts.master')
@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{url('home')}}">ThankCard</a></li>
        <li><a href="{{url('thankcard/sent')}}">Sent</a></li>
        <li><a href="#">Detail</a></li>
	</ol>
	<div id="receive_content">
		<div class="form-container" style="border: none;"> 
        	<div class="row">
	        	<form class="form-horizontal" action="{{url('thankcard/reply')}}/{{$thankcard[0]['Id']}}" method="post" id="frmReply">
	        		{{ csrf_field() }} 
	        		<div class="col-md-6" id="thankcard_img"> 
						<img src="{{ URL::asset('img/thankcard.jpg') }}" style="width: 100%" /> 
					</div> 
					<div class="col-md-6" id="reply_content">
						<div class="form-group">
					    	<label class="control-label col-sm-offset-9 col-sm-3">
					    		<strong>日付: {{date('d-m-Y',strtotime($thankcard[0]['SendDate']))}}</strong>
					    	</label> 
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2 left" >件名:</label>
							<div class="col-sm-10">
					    		<input type="text" value="{{$thankcard[0]['Title']}}" class="form-control" disabled name="title"> 
					    	</div> 
						</div>
						<div class="form-group">
					    	<label class="control-label col-sm-2 left" >From:</label>
					    	<div class="col-sm-10">
					    		<input type="text" value="{{$thankcard[0]['From_Employee_Name']}}" class="form-control" disabled name="from">
					    	</div>
					    </div>
					    <div class="form-group">
					    	<label class="control-label col-sm-2 left" >To:</label>
					    	<div class="col-sm-10">
					    		<input type="text" value="{{$thankcard[0]['To_Employee_Name']}}" class="form-control" disabled  name="to">
					    	</div> 
					    </div>
				    	<div class="form-group">
					    	<label class="control-label col-sm-2 left" >内容:</label>
					    	<div class="col-sm-10">
					    		<textarea id="w3review" class="form-control" rows="3" disabled name="send_text">{{$thankcard[0]['SendText']}}</textarea> 
					    	</div>
			    		</div>
			    		<div class="form-group">
					    	<label class="control-label col-sm-2 left" > 返信:</label>
					    	<div class="col-sm-10"> 
				    			<div id="reply_message">
						    		<textarea class="form-control" name="reply_message" rows="3" disabled>{{$thankcard[0]['ReplyText']}}</textarea>  
						        </div> 
					    	</div>
			    		</div> 
					</div> 
	        	</form>
	        </div>
        </div> 
	</div>
</div>
@endsection