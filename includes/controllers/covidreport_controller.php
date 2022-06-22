<?php
    // Submit Covid Report
    if(isset($_POST['covid_report_btn'])) {
        //Get new report ID
        $report_id = (int)mysqli_fetch_array(mysqli_query($con, "SELECT MAX(report_id) FROM report"))[0];
        $report_id += 1;

        // Method To Submit Form
        $covid_unit = $_POST['covid-unit'];
        $report_for = $_POST['covid-report_for'];

        //submit only if it is a different status
        if($report_for!=$Resident->getCovidStatus()){
            $date = date("Y-m-d");
            $query = mysqli_query($con, "INSERT INTO report VALUES ('$report_id','$covid_unit','covid','$report_for','evidence','$date')");

            // Upload Image
            $target_Dir = "assets/images/";
            $filename = str_replace(" ", "_", basename($_FILES["covid-evidence"]["name"]));
            $target_file_path=$target_Dir.$filename;
            if(move_uploaded_file($_FILES[ "covid-evidence"]["tmp_name"], $target_file_path)){
                $sql = "UPDATE report SET evidence='". $target_file_path."' WHERE report_id='".$report_id."'";
                mysqli_query($con,$sql);
            } 
            //Thank you modal
            echo "<script type='text/javascript'>
            $(document).ready(function(){
            $('#myModal').modal('show');
            });
            </script>";
        }
    }

    // Submit Update Vaccine
    if(isset($_POST['vaccine_report_btn'])) {
        $report_id = (int)mysqli_fetch_array(mysqli_query($con, "SELECT MAX(report_id) FROM report"))[0];
        $report_id += 1;

        $vaccine_unit = $_POST['vaccine-unit'];
        $report_for = $_POST['vaccine-report_for'];
        $date = date("Y-m-d");

        // Upload Image
        $target_Dir = "assets/images/";
        $filename = basename($_FILES["vaccine-evidence"]["name"]);
        $filename = str_replace(" ", "_", basename($_FILES["vaccine-evidence"]["name"]));
        $target_file_path=$target_Dir.$filename;

        if(move_uploaded_file($_FILES[ "vaccine-evidence"]["tmp_name"], $target_file_path)){
            $query = mysqli_query($con, "INSERT INTO report VALUES ('$report_id','$vaccine_unit','vaccine','$report_for','$target_file_path','$date')");
            //Thank you modal
            echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#myModal').modal('show');
                });
                </script>";
        } 
    }

    //get Date for dynamic current Date and time in webpage
    function getDateNow($offset,$amount,$format){
        $Date = date("d-M-Y H:i:s");
        return trim(date($format, strtotime($Date.$offset."".$amount."")), "'");

    }

    //get all covid report for graph
    function getCurrentReport(){
        $blocks = array("A", "B", "C", "D");
        $blockcount = array();
        foreach ($blocks as $block) {
            $covid_report = mysqli_fetch_array(mysqli_query(connection(), 
            "SELECT COUNT(name) FROM resident WHERE covid_status='Positive' AND 
            ic IN (SELECT owner_ic FROM unit WHERE unit_no LIKE '".$block."%')"));
            array_push($blockcount, $covid_report);
        }
        return $blockcount;
    }

    //get Today's Active Cases
    function getActiveCases(){
        $covid_report = mysqli_fetch_array(mysqli_query(connection(), 
        "SELECT COUNT(name) FROM resident WHERE covid_status='Positive'"));
        return $covid_report[0];
    }

    //get Today's New Cases
    function getNewCases(){
        $today = date("Y-m-d");
        $covid_report = mysqli_fetch_array(mysqli_query(connection(), 
        "SELECT * FROM covidcases WHERE date='$today'"));
        $newCases=0;
        if($covid_report != null){
            $newCases = $covid_report['new'];
        }
        return $newCases;
    }
    
    //get Array of Past Week
    function createWeekArray(){
        $weekArr = array();
        for ($x = 7; $x >= 1; $x--) {
            array_push($weekArr, getDateNow(-$x,"days","'d M Y'"));
        }
        return $weekArr;
    }

    //get Report of Last Week's Cases
    function getWeeklyReport(){
        $weekArr = array();
        for ($x=7; $x>=1; $x--) {
            array_push($weekArr, getDateNow(-$x,"days","'Y-m-d'"));
        }
        $activeArr = array();
        $newArr = array();
        $recoveredArr = array();
        foreach ($weekArr as $day) {
            $covid_report = mysqli_fetch_array(mysqli_query(connection(),
            "SELECT active FROM covidcases WHERE date ='$day'"));
            if($covid_report == null){
                array_push($activeArr, 0);
            }else{
                array_push($activeArr, $covid_report[0]);
            }
            $covid_report2 = mysqli_fetch_array(mysqli_query(connection(), 
            "SELECT new FROM covidcases WHERE date ='$day'"));
            if($covid_report2 == null){
                array_push($newArr, 0);
            }else{
                array_push($newArr, $covid_report2[0]);
            }
            $covid_report3 = mysqli_fetch_array(mysqli_query(connection(), 
            "SELECT recover FROM covidcases WHERE date ='$day'"));
            if($covid_report3 == null){
                array_push($recoveredArr, 0);
            }else{
                array_push($recoveredArr, $covid_report3[0]);
            }
        }
        return array($activeArr,$newArr,$recoveredArr);
    }

    //get Array of Past Month
    function createMonthArray(){
        $month = date("m",strtotime(getDateNow(-1,"months","'d-M-Y'")));
        $year = date("Y",strtotime(getDateNow(-1,"months","'d-M-Y'")));
        $monthArr = array();
        for ($x=1; $x<=cal_days_in_month(CAL_GREGORIAN, $month, $year); $x++){
            array_push($monthArr, $x);
        }
        return $monthArr;
    }

    //get Report of Last Month's Cases
    function getMonthlyReport(){
        $month = date("m",strtotime(getDateNow(-1,"months","'d-M-Y'")));
        $year = date("Y",strtotime(getDateNow(-1,"months","'d-M-Y'")));
        $monthArr = array();
        for ($x=1; $x<=cal_days_in_month(CAL_GREGORIAN, $month, $year); $x++) {
            array_push($monthArr, date('Y-m-d',strtotime($year."-".$month."-".$x)));
        }

        $monthlyReport = array();
        foreach ($monthArr as $day) {
            $covid_report = mysqli_fetch_array(mysqli_query(connection(),
            "SELECT active FROM covidcases WHERE date ='$day'"));
            if($covid_report == null){
                array_push($monthlyReport, 0);
            }else{
                array_push($monthlyReport, $covid_report[0]);
            }
        }
        return $monthlyReport;
    }
?>
