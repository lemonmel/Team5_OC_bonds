<?php 
include 'config/config.php';
include 'includes/controllers/login_controller.php';

// if there is session already, redirects them to dashboard
if (isset($_SESSION['login_type'])){
	$_SESSION['login_type']=='admin'?//redirect to index.php which is the main page or dashboard
		header("Location: admin-dashboard.php"):header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login | Bonds</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- Fontawesome CDN -->
	<script src="https://kit.fontawesome.com/db51efbc0b.js" crossorigin="anonymous"></script>
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="assets/images/resident-favicon.png">
	<!-- CSS file -->
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

	<div class="container-login">
		<div class="wrap-login">
			<div class="login-pic js-tilt" data-tilt>
				<img src="assets/images/resident.png" alt="Bonds">
			</div>

			<form class="login-form" style="width: 290px" action="index.php" method="POST">
				<h2>User Login</h2>

				<div class="wrap-input">
					<input class="input" type="text" id="id" placeholder="ID" name="login_ic" required
					oninvalid="this.setCustomValidity('Login ID is required')" oninput="this.setCustomValidity('')">
					<span class="focus-input"></span>
					<span class="symbol-input">
						<i class="fa-solid fa-id-card" aria-hidden="true"></i>
					</span>
				</div>

				<div class="wrap-input">
					<input class="input" type="password" id="password" placeholder="Password" name="login_password" required
						oninvalid="this.setCustomValidity('Password is required')" oninput="this.setCustomValidity('')">
					<span class="focus-input"></span>
					<span class="symbol-input">
						<i class="fa fa-lock" aria-hidden="true"></i>
						<i class="bi bi-eye-slash"></i>
					</span>
				</div>

				<div class="d-flex">
					<div class="w-50 text-left">
						<p>Select login status</p>
						<select class="select" id="role" name="login_type">
							<option value="resident">Resident</option>
							<option value="admin">Admin</option>
						</select>
					</div>
				</div>

				<!-- Login Button -->
				<div class="p-4">
					<input type="submit" class="submit" id="submit" name="login_button" value="Login">
				</div>

				<div class="text-center p-5">
					<a class="txt1" href="#" onclick="forgetPassword()">
						Forgot Password?
					</a>
				</div>

			</form>
		</div>
	</div>

	<!-- Alert Modal Start-->
	<div class="modal fade" id="alert-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-body d-flex flex-column align-items-center">
			<div class="alert" role="alert"> Email or password or credidential was incorrect. </div>
		</div>
		<div class="modal-footer" id="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="forgetPassword()">Forget Password</button>
			<button type="button" class="btn btn_mygreen" data-bs-dismiss="modal">Try Again</button>
		</div>
		</div>
	</div>
	</div>
	<!-- Alert Modal End-->

<!-- Forget Password Modal Start-->
<div class="modal fade" id="forgetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forget Password: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<div class="modal-body d-flex flex-column align-items-center">
            	<form method="POST" action="forgetPassword.php" id="forgotPasswordForm">
				<div class="mb-3">
                	<label for="">Login ID</label>
                	<input type="text" placeholder="Enter your login ID" name="forget-ID" id="forget-ID" class="form-control" 
					oninvalid="this.setCustomValidity('Login ID is required')" oninput="this.setCustomValidity('')" required/>
            	</div>
				<div class="d-flex">
					<div class="w-50 text-left">
						<p>Select login status</p>
						<select class="select" id="role" name="forget-login_type">
							<option value="resident">Resident</option>
							<option value="admin">Admin</option>
						</select>
					</div>
				</div>
				<div class="modal-footer d-flex flex-column align-items-center" id="modal-footer">
					<input type="submit" class="btn btn_mygreen" name="forget-pass" value="Send temporary password"/>
					<p id="sent">Click to send temporary password to your email</p>
				</div>
				</form>
			</div>
        </div>
    </div>
</div>
<!-- Forget Password Modal End-->

<script>
function forgetPassword(){
	$("#forgetPasswordModal").modal('show');
} 


</script>

	<!-- Jquery CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
		integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- Bootstrap CDN -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Tilting effect CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.0.3/tilt.jquery.min.js"
		integrity="sha512-14AZ/DxUrlF26z6v7egDkpJHKyJRn/7ue2BgpWZ/fmqrqVzf4PrQnToy99sHmKwzKev/VZ1tjPxusuTV/n8CcQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

</body>

</html>