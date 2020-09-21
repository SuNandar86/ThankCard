@extends('layouts.master')
@section('content')
   <div class="container">
   		<ol class="breadcrumb"> 
	        <li><a href="#">Activities</a></li> 
		</ol>
		<div class="img_banner">
			&nbsp;
		</div>
		<div class="row">
           <h1 style="text-align: center;padding:30px;"> <strong>Our Activities</strong></h1>
           <div class="col-md-4">
           	 	<img src="{{ asset('img/activity_1.jpg') }}" style="width: 100%">
           </div>
           <div class="col-md-4">
           	 	<img src="{{ asset('img/activity_2.png') }}" style="height: 202px;" />
           </div>
           <div class="col-md-4">
           	 	<img src="{{ asset('img/activity_3.png') }}" style="width: 100%"/>
           </div> 
		</div>
		<div class="row">
			<div class="center" style="padding-top:30px;font-size:16px;">
				<p>Year Memories</p>
				<p>We created our happy memories together</p>
				<p>We spent most of our time together</p>
				<p>We created every good things together.</p>
				<p>I wish all of us to be happy.</p> 
			</div> 
		</div>
   </div> 
@endsection