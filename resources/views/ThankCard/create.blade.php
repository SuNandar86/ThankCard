@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="#">ThankCard</a></li>
        <li><a href="#">Create</a></li>
	</ol>
	<div id="card_content form-container" style="margin-top:60px;"> 
		<div class="show_message">
			<div class="form-group">
                <div class="col-sm-offset-3 col-sm-6" id="show_message"> 
                    
                </div> 
            </div>
		</div>
		<div class="col-md-6" id="thankcard_img"> 
			<img src="{{ URL::asset('img/thankcard.jpg') }}" style="width: 100%" /> 
		</div>
		<div class="col-md-6" id="thankcard_content">
			<form class="form-horizontal" method="post"  id="frmCreateCard">
				{{ csrf_field() }}  
				<input type="hidden" value="{{ url('thankcard/create') }}/{{$sender['to_name']}}/{{$sender['id']}}" id="url_path">
				<div class="form-group">
					<label class="control-label col-sm-offset-9 col-sm-3 left" >
						<strong>Date: {{date('d/m/Y')}} </strong>
					</label>
				</div>
				<div class="form-group">
			    	<label class="control-label col-sm-2 left" >From:</label>
			    	<label class="control-label col-sm-7 left"  >{{$sender['from_name']}}</label> 
			    </div>
			    <div class="form-group">
			    	<label class="control-label col-sm-2 left" >To:</label>
			    	<label class="control-label col-sm-10 left" >{{$sender['to_name']}}</label>	 
			    </div>
			    <div class="form-group">
			    	<label class="control-label col-sm-2 left" >Title:</label>
			    	<div class="col-sm-10">
			    		<input type="text" name="title" class="form-control left"/>
			    	</div> 
			    </div> 
			    <div class="form-group">
			    	<label class="control-label col-sm-2" >Description:</label>
			    	<div class="col-sm-10">
			    		<textarea id="w3review" name="send_text" rows="8" cols="50" class="form-control col-sm-3 left"></textarea>	 
			    	</div>
			    </div> 
			    <div class="form-group">
			    	<div class="col-sm-offset-10 col-sm-2">
			    		<button type="button" class="btn btn-default" id="btnSend">Send</button>
			    	</div>
			    </div>
			</form>
		</div>
	</div> 
</div>
<script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript">
	$("#btnSend").click(function(){ 
		var serializedData = $("#frmCreateCard").serialize();
		var path =$("#url_path").val();
		$.post(path, serializedData, function(response) {
			var objData = jQuery.parseJSON(response);
			if(objData.status=="success"){
				$html ='<div class="alert alert-success">'
                        +'<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        +'Your Thank Card is successfully sent!' 
                        +'</div>';
                   
				$("#show_message").append($html);
				window.open(window.location.origin+'/file/ThankYouCard.pdf', '_blank');
			} 
		});
	});	
</script>
@endsection