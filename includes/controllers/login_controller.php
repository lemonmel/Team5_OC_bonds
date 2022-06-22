<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php

if(isset($_POST['login_button'])) {
    // Get login type (resident / admin) from the select box value
    $login_type = $_POST['login_type']; //'resident' or 'admin'
    
    $ic = $_POST['login_ic']; //Get ic
	$password = md5($_POST['login_password']); //Get password
	// $password = md5($_POST['login_password']); //to encrypt the password

    // based on the option selected in the select box, decide which database to search for to fetch username and password
    $check_database_query = mysqli_query($con, "SELECT * FROM $login_type WHERE ic='$ic' AND password='$password'");

	$check_login_query = mysqli_num_rows($check_database_query);//see how many result row

	// if the result has only 1 row (means username and password correct)
	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);// get result as an array
		$_SESSION['ic'] = $row['ic'];//get the username inside the array and assign to session
		$_SESSION['login_type'] = $login_type; //set login type session
        $login_type=='admin'?//redirect to index.php which is the main page or dashboard
			header("Location: admin-dashboard.php"):header("Location: dashboard.php");
		exit();
	}
	else {?>
		<script type="text/javascript"> 
			$(function() {
				$('#alert-modal').modal('show')
			});
		</script>

<?php		   
	}

}
?>