@extends('layouts.master')
@section('content')
<div class="container">
	<ol class="breadcrumb">
        <li><a href="{{url('home')}}">ThankCard</a></li>
        <li><a href="#">Employee</a></li>
        <li><a href="#">Compose</a></li>
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
			<form class="form-horizontal" method="post"  action="{{url('thankcard/create')}}/{{$sender['to_name']}}/{{$sender['id']}}" id="frmCreateCard"> 
				{{ csrf_field() }}   
				<div class="form-group">
					<label class="control-label col-sm-offset-9 col-sm-3 left" >
						<strong>日付: {{date('d/m/Y')}} </strong>
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
			    	<label class="control-label col-sm-2 left" >件名:</label>
			    	<div class="col-sm-10">
			    		<input type="text" name="title" class="form-control left"/>
			    	</div> 
			    </div> 
			    <div class="form-group">
			    	<label class="control-label col-sm-2 left" >内容:</label>
			    	<div class="col-sm-10">
			    		<textarea id="w3review" name="send_text" rows="7" cols="50" class="form-control col-sm-3 left"></textarea>	 
			    	</div>
			    </div> 
			    <div class="form-group">
			    	<div class="col-sm-offset-10 col-sm-2">
			    		<button type="submit" class="btn btn-default" id="btnSend">送信</button>
			    	</div>
			    </div>
			</form>
		</div>
	</div> 
</div> 
@endsection