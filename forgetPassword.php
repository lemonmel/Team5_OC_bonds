
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php
// include 'config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
include 'pwdLoading.html';
// include "index.php"; 

$login_type = $_POST['forget-login_type']; //'resident' or 'admin'
$ic = $_POST['forget-ID']; //Get ic
// $result = mysqli_query($con, "SELECT * FROM $login_type WHERE ic='$ic'") or die(mysqli_error($con));
$check_database_query = mysqli_query($con, "SELECT * FROM $login_type WHERE ic='$ic'");
$check_login_query = mysqli_num_rows($check_database_query);//see how many result row

if($check_login_query == 1) {
    $row = mysqli_fetch_array($check_database_query);// get result as an array
    $email = $row['email'];
    $name = $row['name'];

    //updating temporary password
    $oriPass = generate_password(8);
    $temp= md5($oriPass);
    $sql = "UPDATE $login_type SET password='$temp' WHERE ic='$ic'";
    mysqli_query($con,$sql); ?>
    <script type="text/javascript">
        var recipientMail = '<?php echo $email ?>';
        var recipientName = '<?php echo $name ?>';
        var tempPass = '<?php echo $temp ?>';
        var oriPass = '<?php echo $oriPass ?>';
        (function() {
            emailjs.init('wkWBWZfzXNOTK2cig'); //please encrypted user id for malicious attacks
        })();
        //set the parameter as per you template parameter[https://dashboard.emailjs.com/templates]
        var templateParams = {
            to_name: recipientName,
            from_name: "bonds",
            message: 'Your new temporary password is been reset to :' + oriPass,
            email: recipientMail
        };

        emailjs.send('bonds_service', 'verificationEmail', templateParams)
            .then(function(response) {
                console.log('SUCCESS!', response.status, response.text);
            }, function(error) {
                console.log('FAILED...', error);
            });
    </script>
    <?php echo "
        <div id='alert-modal' tabindex='-1' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
            <div class='modal-body d-flex flex-column align-items-center'>
                <div class='alert' role='alert'>Please login again with the password sent. Redirecting you back to login page</div>
            </div>
            </div>
        </div>
    </div>
        " ?>
    <script>
        setTimeout(function() {
            window.location = "index.php";
        }, 3000);
    </script>
<?php
        }else { echo "<div id='alert-modal' tabindex='-1' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                <div class='modal-body d-flex flex-column align-items-center'>
                    <div class='alert' role='alert'>Invalid ID with credidential. Redirecting you back to login page</div>
                </div>
                </div>
            </div>
        </div>"?>
<script>setTimeout(function(){ window.location="index.php";}, 3000);</script>

    <?php
}

function generate_password($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);
}
?>


