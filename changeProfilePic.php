<?php 
    include 'includes/header.php';
    $target_Dir="assets/images/";
    $filename = str_replace(" ", "_", basename($_FILES["newProfilePic"]["name"])); //to allow upload image with space in filename
    $target_file_path=$target_Dir.$filename;
    // $file_Type = pathinfo($target_file_path,$PATHINFO_EXTENSION);

    if(isset($_POST["submit"]) && !empty($_FILES["newProfilePic"]["name"])){
        // $allowTypes = array('jpg','png','jpeg','gif','pdf');
        
            if(move_uploaded_file($_FILES["newProfilePic"]["tmp_name"],$target_file_path)){
                $sql = "UPDATE resident SET profile_pic='".$target_file_path."' WHERE ic='".$Resident->getIc()."'";
                mysqli_query($con,$sql);
                header("Location:profile.php");
            }
        
    }

?>
