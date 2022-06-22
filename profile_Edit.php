<?php
    include 'includes/header.php';
    $loginIC = $Resident->getIc();
    $name = $_POST["profile-name"];
    $gender = $_POST["profile-gender"];
    $DOB = $_POST["profile-dob"];
    $email=$_POST["profile-Email"];
    $phone_Number = $_POST["profile-contact"];
    $emergency_contact = $_POST["profile-emergencyContact"];
    $profile_race=$_POST["profile-race"];

    $sql = "UPDATE resident SET ic='".$loginIC."', name='".$name."', dob='".$DOB."', gender='".$gender."', race='".$profile_race."', contact='".$phone_Number."', emergency_contact='".$emergency_contact."', email='".$email."' WHERE ic='".$loginIC."'";
    $result = mysqli_query($con, $sql);  
    header("Location:profile.php");
?>
