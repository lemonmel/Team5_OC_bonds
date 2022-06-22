<?php
include 'config/config.php';

// fpdf library, downloaded from geekforgeeks
// https://www.geeksforgeeks.org/how-to-generate-pdf-file-using-php/
require 'vendor/fpdf/fpdf.php';
class PDF extends FPDF {
    // Page header
    function Header() {
        // Add logo to page
        $this->Image('assets/images/resident.png',10,8,33);
        // Set font family to Arial bold 
        $this->SetFont('Arial','B',20);
        // Move to the right
        $this->Cell(80);
        // Header
        $this->Cell(50,10,'Bonds Condominium Visitor Pass',0,0,'C');
        // Line break
        $this->Ln(20);
    }
    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page ' . $this->PageNo() . '/{nb}',0,0,'C');
    }
    // Simple table
    function getSimpleTable($data) {
        // Data
        foreach($data as $row) {
            foreach($row as $col)
                $this->Cell(95, 8, $col, 1);
            $this->Ln(); // Set current position
        }
    }
}

// fetch visitor pass data from database
if(isset($_POST['pass_id'])){
    $pass_id = $_POST['pass_id'];
    $query = mysqli_query($con, "SELECT * FROM visitorpass WHERE pass_id='$pass_id'");
    while($result = mysqli_fetch_array($query)) { 		
        $unit = $result['unit'];
        $visitor_name = $result['visitor_name'];
        $visitor_ic = $result['visitor_ic'];
        $visitor_contact = $result['visitor_contact'];
        $car_details = $result['car_details'];
        $car_plate = $result['car_plate'];
        $start_time = $result['start_time'];
        $end_time = $result['end_time'];
        $visitor_num = $result['visitor_num'];

        // echo "<h1>pass_id: $pass_id</h1>";
        // echo "<h1>unit: $unit</h1>";
        // echo "<h1>visitor_name: $visitor_name</h1>";
        // echo "<h1>visitor_ic: $visitor_ic</h1>";
        // echo "<h1>visitor_contact: $visitor_contact</h1>";
        // echo "<h1>car_details: $car_details</h1>";
        // echo "<h1>car_plate: $car_plate</h1>";
        // echo "<h1>start_time: $start_time</h1>";
        // echo "<h1>end_time: $end_time</h1>";
        // echo "<h1>visitor_num: $visitor_num</h1>";
    }
    mysqli_close($con);

    $visitor_pass = array(
        array("Unit", $unit),
        array("Visitor", $visitor_name),
        array("IC no.", $visitor_ic),
        array("H/P no.", $visitor_contact),
        array("Car Model", $car_details),
        array("Car Plate", $car_plate),
        array("Starting Time", $start_time),
        array("Ending Time", $end_time),
        array("No. of visitors", $visitor_num)
    );

    // $visitor_pass = array(
    //     "Unit\t\t\t\t: " . $unit,
    //     "Visitor\t\t\t: " . $visitor_name,
    //     "IC no.\t\t\t\t: " . $visitor_ic,
    //     "H/P no.\t\t\t: " . $visitor_contact,
    //     "Car Model\t\t\t: " . $car_details,
    //     "Car Plate\t\t\t: " . $car_plate,
    //     "Starting Time\t\t: " . $start_time,
    //     "Ending Time\t\t: " . $end_time,
    //     "No. of visitors\t: " . $visitor_num
    // );

    // Generate pdf file
    // Instantiation of FPDF class
    $pdf = new PDF();
    
    // Define alias for number of pages
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',14);

    // Generate table
    // https://www.geeksforgeeks.org/how-to-create-a-table-in-pdf-file-from-external-text-files-using-php/
    $pdf->getSimpleTable($visitor_pass);

    $pdf->Cell(0, 10, "", 0, 1);
    $pdf->Cell(0, 10, "Please show this Visitor Pass to the person in charge upon entry.", 0, 1);
    $pdf->Cell(0, 10, "Bonds Condominium reserve the rights to reject the entry if this Visitor Pass deemed invalid.", 0, 1);
    
    // $i = 0;
    // for( ; $i < count($visitor_pass); $i++)
    //     $pdf->Cell(0, 10, $visitor_pass[$i], 0, 1);
    
    // Generate the pdf output
    $pdf->Output();
    
}

?>