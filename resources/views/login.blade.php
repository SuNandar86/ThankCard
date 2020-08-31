
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/utli.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					User Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" action="{{url('login')}}" method="post">
					{{ csrf_field() }} 
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="user_name" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
					<div class="container-login100-form-btn m-t-32">
						<input type="submit" class="login100-form-btn" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>
 
</body>
</html>