<?php 
$pageTitle = "Visitor Pass";
include 'includes/header.php';?>

    <div class="col-12 mycontainer">
        <h2>Register a Visitor Pass</h2>
        <h6 class="mb-3 text-black-50">For visit in group at the same time slot, only one representative is required to register.</h6>

        <form action="visitorpass.php" method="POST" class="visitorForm">
            <!-- use $loggedInUnit to-->
            <input type="hidden" name="visitor-unit" value='<?=$loggedInUnit?>'>

            <!-- visitor details -->
            <h4>Visitor Details</h4>
            <div class="mb-3 visitorName">
                <label for="visitorname" class="form-label">Visitor Name</label>
                <input required type="text" class="form-control w-50" id="visitorname"
                    placeholder="e.g Karry Wang" name="visitor-name">
            </div>
            <div class="mb-3 visitorIC">
                <label for="visitorname" class="form-label">Visitor IC Number</label>
                <input required type="text" class="form-control w-50" id="visitoric"
                    placeholder="e.g 980605-03-7488 (with '-')" name="visitor-ic" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}">
            </div>
            <div class="mb-3 visitorPhone">
                <label for="visitorphone" class="form-label">Visitor Phone</label>
                <input required type="text" class="form-control w-50" id="visitorphone"
                    placeholder="e.g 012-3456789 (with '-')" name="visitor-phone">
            </div>

            <div class="mb-3 visitorCarModel">
                <label for="visitorcar" class="form-label">Visitor Car Model & Color</label>
                <input required type="text" class="form-control w-50" id="visitorcar"
                    placeholder="e.g BMW M4 Blue (put '-' for visitor without vehicle)" name="visitor-car">
            </div>
            <div class="mb-3 visitorCarNum">
                <label for="visitorcarnum" class="form-label">Visitor Car Register Number</label>
                <input required type="text" class="form-control w-50" id="visitorcarnum"
                    placeholder="e.g PPP1234 (put '-' for visitor without vehicle)" name="visitor-carplate">
            </div>
            <br><br>

            <!-- Visitation details -->
            <h4>Visitation Details</h4>
            <h6 class="mt-4">Expected Visit Time</h6>
            <div class="container">
                <div class="row mb-3">
                    <div class="col-auto">
                        <h6>Start Time:</h6>
                        <input required type="datetime-local" class="form-control w-40"
                            id="datetime1" name="visitor-starttime">
                    </div>
                    <div class="col-auto">
                        <h6>End Time:</h6>
                        <input required type="datetime-local" class="form-control w-40"
                            id="datetime2" name="visitor-endtime">
                    </div>
                </div>
            </div>
            
            <div class="mb-3 numOfVisitors">
                <h6 for="numofvisitors" class="form-label mt-4">Number of Visitor(s)</h6>
                <input required type="number" class="form-control w-50" id="numofvisitors" placeholder="e.g 5" name="visitor-num">
            </div>
            <br><br><h6 class="mb-3 text-black-50">Please fill in all required details before submitting.</h6>
            <input type="submit"  class="me-lg-3 btn btn_mygreen" name="visitorpass_btn">
        </form>

        <?php
        // Method To Submit Form
        if(isset($_POST['visitorpass_btn'])){
           $unit = $_POST['visitor-unit'];
           $name = $_POST['visitor-name'];
           $ic = $_POST['visitor-ic'];
           $phone = $_POST['visitor-phone'];
           $car = $_POST['visitor-car'];
           $carplate = $_POST['visitor-carplate'];
           $starttime = $_POST['visitor-starttime'];
           $endtime = $_POST['visitor-endtime'];
           $number = $_POST['visitor-num'];

           $query = mysqli_query($con, "INSERT INTO visitorpass (unit, visitor_name, visitor_ic, visitor_contact, car_details, car_plate, start_time, end_time, visitor_num)
           VALUES ('$unit','$name','$ic','$phone','$car','$carplate','$starttime','$endtime','$number')"); 
        }

        ?>

    </div>

    <div class="col-12 mycontainer mt-4" style='overflow-x:auto; width:100%;position:relative;'>
        <h2>Your History</h2>
        <h6 class="mb-3 text-black-50">Click to download visitor pass pdf file.</h6>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Visitor Name</th>
                    <th scope="col">IC</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Car</th>
                    <th scope="col">Car Plate</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">No. of Visitors</th>

                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Get Visitor Pass for loggedIn Unit
                $query = mysqli_query($con, "SELECT * FROM visitorpass WHERE unit='$loggedInUnit' ORDER BY start_time DESC");

                if(mysqli_num_rows($query) > 0)
                {
                    foreach($query as $visitorpass)
                    {
                        $pass_id = $visitorpass['pass_id'];
                        $unit = $visitorpass['unit'];
                        $visitor_name = $visitorpass['visitor_name'];
                        $visitor_ic = $visitorpass['visitor_ic'];
                        $visitor_contact = $visitorpass['visitor_contact'];
                        $car_details = $visitorpass['car_details'];
                        $car_plate = $visitorpass['car_plate'];
                        $start_time = $visitorpass['start_time'];
                        $end_time = $visitorpass['end_time'];
                        $visitor_num = $visitorpass['visitor_num'];
                ?>
                        <tr>
                            <td><?= $visitor_name ?></td>
                            <td><?= $visitor_ic ?></td>
                            <td><?= $visitor_contact ?></td>
                            <td><?= $car_details ?></td>
                            <td><?= $car_plate ?></td>
                            <td><?= $start_time ?></td>
                            <td><?= $end_time ?></td>
                            <td><?= $visitor_num ?></td>
                            
                            <td>
                                <!-- target="_blank" to open page in new tab -->
                                <form method="POST" action="generate_passPDF.php" target="_blank">
                                    <input type="hidden" name="pass_id" value="<?php echo $pass_id ?>">
                                    <input type="submit" class="me-lg-3 btn btn_mygreen" value="Download">
                                </form>
                            </td>
                        </tr>
                <?php
                        }
                    }
                    else{
                       echo "<td>You do not have any visitor pass previously</td>";
                    }
                ?>
            </tbody>
        </table>
    </div>

<?php include 'includes/footer.php';?>
