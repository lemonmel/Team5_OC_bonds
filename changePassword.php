<?php 
    include "profile.php";
    $newPassword = $_POST["profile-newPassword"];
    $newPassword = md5($newPassword);
    if($newPassword != $Resident->getPassword()){
        $sql = "UPDATE resident SET password='".$newPassword."' WHERE ic='".$Resident->getIc()."'";
        mysqli_query($con,$sql);
        header("Location:profile.php");
    }
    else{
        echo '<script>alert("Cannot use same password")</script>';
    }
?>