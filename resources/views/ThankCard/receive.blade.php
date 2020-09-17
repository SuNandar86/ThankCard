@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb"> 
        <li><a href="#">Inbox</a></li>
        <li><a href="#">Reply</a></li>
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
        	<div class="row">
        		<div class="col-sm-offset-10 col-sm-2 print_card">
        			<button type="button" class="btn btn-default right" id="btnPrint">
				        <i class="fa fa-download" aria-hidden="true"></i> プリント
				   </button> 
        		</div>
        	</div>
        	<div class="row">
	        	<form class="form-horizontal" action="{{url('thankcard/reply')}}/{{$thankcards[0]['Id']}}" method="post" id="frmReply">
	        		{{ csrf_field() }} 
	        		<div class="col-md-6" id="thankcard_img"> 
						<img src="{{ URL::asset('img/thankcard.jpg') }}" style="width: 100%" /> 
					</div> 
					<div class="col-md-6" id="reply_content">
						<div class="form-group">
					    	<label class="control-label col-sm-offset-9 col-sm-3">
					    		<strong>Date: {{date('d-m-Y',strtotime($thankcards[0]['SendDate']))}}</strong>
					    	</label>
					    	<input type="hidden" name="send_date" value="{{date('d-m-Y',strtotime($thankcards[0]['SendDate']))}}"/>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2 left" >件名:</label>
							<div class="col-sm-10">
					    		<input type="text" value="{{$thankcards[0]['Title']}}" class="form-control" disabled name="title"> 
					    	</div> 
						</div>
						<div class="form-group">
					    	<label class="control-label col-sm-2 left" >From:</label>
					    	<div class="col-sm-10">
					    		<input type="text" value="{{$employee[0]['Emp_Name']}}" class="form-control" disabled name="from">
					    	</div>
					    </div>
					    <div class="form-group">
					    	<label class="control-label col-sm-2 left" >To:</label>
					    	<div class="col-sm-10">
					    		<input type="text" value="{{$user['employee_name']}}" class="form-control" disabled  name="to">
					    	</div> 
					    </div>
				    	<div class="form-group">
					    	<label class="control-label col-sm-2 left" >内容:</label>
					    	<div class="col-sm-10">
					    		<textarea id="w3review" class="form-control" rows="3" disabled name="send_text">{{$thankcards[0]['SendText']}}</textarea> 
					    	</div>
			    		</div>
			    		<div class="form-group">
					    	<label class="control-label col-sm-2 left" >返信:</label>
					    	<div class="col-sm-10"> 
					    		@if($thankcards[0]['ReplyText'])
					    			<div id="reply_message">
							    		<textarea class="form-control" name="reply_message" rows="3" disabled>{{$thankcards[0]['ReplyText']}}</textarea> 
							    		<a href="#" id="reply_edit"><i class="fa fa-1x fa-edit"></i> 編集</a>
							        </div>
							        <div id="reply_message_edit">
							        	<textarea class="form-control reply_text" name="reply_message" rows="3" name="reply_text">{{$thankcards[0]['ReplyText']}}</textarea>
							        	<button type="submit" class="btn btn-default  reply"  
						    		     >
				            			    <i class="fa fa-reply" aria-hidden="true"></i> 返信
				            		 	</button>
					            		 <button type="button" class="btn btn-default  reply"  
							    		     id="btn_cancel" style="width: 120px !important;">
					            			    <i class="fa fa-remove" aria-hidden="true"></i> キャンセル
					            		 </button>
							        </div>
						    	@else
						    		<textarea class="form-control reply_text" name="reply_message" rows="3" name="reply_text">{{$thankcards[0]['ReplyText']}}</textarea>
						    		 <button type="submit" class="btn btn-default  reply"  
						    		     >
				            			    <i class="fa fa-reply" aria-hidden="true"></i> 返信
				            		 </button> 
						    	@endif
					    	</div>
			    		</div> 
					</div> 
	        	</form>
	        </div>
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
	$("#btnPrint").click(function() {  
		$("input").removeAttr('disabled');	
		$("textarea").removeAttr('disabled');
	    var form = $("#frmReply"); 
	    var url = "<?php echo url('thankcard/print/card');?>";  
	    $.ajax({
	       type: "POST",
	       url: url,
	       data: form.serialize(), // serializes the form's elements.
	       success: function(data)
	       {
	           $("input").attr('disabled','disabled');
	           $("textarea").attr('disabled','disabled');
	       }
	    }); 
	}); 
</script>
@endsection
