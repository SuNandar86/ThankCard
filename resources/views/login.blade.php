
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/util.css') }}">
</head>
<body>
	
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{url('login')}}" method="post">
					{{ csrf_field() }} 
					<span class="login100-form-title p-b-26">
						Login
					</span> 
					 
					@if($message)
					<div class="alert alert-danger">
  						<strong>Danger!</strong>{{$message}}
					</div>
					<br/>
					@endif

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="user_name" required="required">
						<span class="focus-input100" data-placeholder="User Name"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" >
						<span class="focus-input100" data-placeholder="Password" required="required"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div> 
							<button class="login100-form-btn" type="submit">
								Login
							</button>

						</div>
					</div> 
				</form>
			</div>
		</div>
	</div>	
 
</body>
<script src="{{ asset('js/vendor/jquery/jquery-3.2.1.min.js')}}"></script> 
<script src="{{ asset('js/input_animate.js')}}"></script>  
</html>