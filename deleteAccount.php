<?php 
include "includes/header.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "UPDATE resident SET rental_status='request to stop' WHERE ic='".$Resident->getIc()."'";
    mysqli_query($con,$sql);
}
session_destroy();
header("Location:index.php");
?>