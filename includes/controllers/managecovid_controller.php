<?php
include("../../config/config.php");

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


// Get Data when clicked the view report button
if(isset($_GET['report_id']))
{
    $report_id = mysqli_real_escape_string($con, $_GET['report_id']);

    $query = "SELECT * FROM report INNER JOIN unit ON report.reporter_unit = unit.unit_no INNER JOIN resident ON unit.owner_ic = resident.ic WHERE report_id='$report_id'";

    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $report = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Report Fetch Successfully by id',
            'data' => $report
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'The Report Does not exist'
        ];
        echo json_encode($res);
        return;
    }
}

// DELETE 
if(isset($_POST['delete_report']))
{
    $report_id = mysqli_real_escape_string($con, $_POST['report_id']);

    $query = "DELETE FROM report WHERE report_id='$report_id'";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Report Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Report Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}



?>
