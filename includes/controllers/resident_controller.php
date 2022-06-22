<?php
include("../../config/config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DELETE 
if(isset($_POST['delete_resident']))
{
    $resident_id = mysqli_real_escape_string($con, $_POST['resident_id']);

    $query = "DELETE FROM resident WHERE ic='$resident_id'";
    $query2 = "UPDATE unit SET owner_ic = '' WHERE owner_ic = '$resident_id'";
    $query_run2 = mysqli_query($con, $query2);
    $query_run = mysqli_query($con, $query);
    if($query_run && $query_run2)
    {
        $res = [
            'status' => 200,
            'message' => 'Resident Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Resident Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

// Get Data when clicked the edit button
if(isset($_GET['resident_id']))
{
    $resident_id = mysqli_real_escape_string($con, $_GET['resident_id']);

    $query = "SELECT * FROM resident WHERE ic='$resident_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $resident = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Resident Fetch Successfully by id',
            'data' => $resident
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Resident Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
?>
