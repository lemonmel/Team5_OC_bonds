<?php 
    $pageTitle = "Manage Residents";
    include 'includes/admin-header.php';
    //Alert Message
    function echoToast($message){
        echo '<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 100;">
        <div class="toast-container position-fixed bottom-0 end-0 m-3">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                <div class="toast-header">
                    <span class="bg-primary px-2 rounded">&nbsp;</span>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    '.$message.'
                </div>
            </div>
        </div>
    </div>
    <script> $(document).ready(function() {
        $(".toast").toast("show");
    });</script>';
    }

    // Create Resident Function and insert into unit
    if(isset($_POST['create_resident'])){
        $unit = $_POST['new-unit'];
        $ic = $_POST['new-ic'];
        $name = $_POST['new-name'];
        $dob = $_POST['new-dob'];
        $gender = $_POST['new-gender'];
        $race = $_POST['new-race'];
        $contact = $_POST['new-contact'];
        $emergency = $_POST['new-emergency'];
        $email = $_POST['new-email'];
        $datetime = date("Y-m-d H:i:s");
        $profilepic = 'assets/images/defaultProPic.jpg';
        $covidstatus = $_POST['new-covidstatus'];
        $password = md5('bonds');//set default password as bonds
        $vaccinestatus = $_POST['new-vaccinestatus'];
        $rentalstatus = "renting";

        // Check If The IC Exist
        $checkIcQuery = "SELECT * FROM resident WHERE ic='$ic'";
        $checkIcQuery_run = mysqli_query($con, $checkIcQuery);

        if(mysqli_num_rows($checkIcQuery_run)>0){
            //means ic already exist 
            echoToast("IC cannot be used as already found in database.");
        }else{
            $query = mysqli_query($con, "INSERT INTO resident VALUES ('$ic','$name','$dob','$gender','$race','$contact','$emergency','$email','$datetime','$profilepic','$covidstatus','$password','$vaccinestatus','$rentalstatus')");
            $query = mysqli_query($con, "UPDATE unit SET owner_ic='$ic' WHERE unit_no='$unit'");//Need to pre create the unit in order to assign the unit to resident
            echoToast("New resident added.");
        }
    }

    if(isset($_POST['update_resident'])){
        $ic = $_POST['editResident-ic'];
        $name = $_POST['editResident-name'];
        $dob = $_POST['editResident-dob'];
        $gender = $_POST['editResident-gender'];
        $race = $_POST['editResident-race'];
        $contact = $_POST['editResident-contact'];
        $emergency_contact = $_POST['editResident-emergencycontact'];
        $email = $_POST['editResident-email'];
        $rental_status = $_POST['editResident-status'];
        $check_in_date = $_POST['editResident-checkindate'];
        $profile_pic = $_POST['editResident-profile_pic'];
        
	$query = "UPDATE resident SET name='$name', contact='$contact' , dob='$dob', gender='$gender', race='$race', contact='$contact',
        emergency_contact='$emergency_contact', email='$email', rental_status='$rental_status', check_in_date='$check_in_date', 
        profile_pic='$profile_pic'
                    WHERE ic='$ic'";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) { 
            echoToast("Resident data updated.");
        }else{ 
            echoToast("Update failed. Please try again.");
        }
    }
?>

<script>
	// prevent form resubmission
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>

<!-- Toast Notification Container at bottom right-->
<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 100;">
    <div class="toast-container position-fixed bottom-0 end-0 m-3">

    </div>
</div>

<div class="col-12 mycontainer mx-auto">
    <div class="title d-flex align-items-center mb-2">
        <h2>Resident Accounts</h2>
    
    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addResidentModal"><i
            class="bi bi-plus-square"></i> Register New Resident</button>

    </div>
    <!-- Resident Table Start -->
    <table class="display" id="ResidentTable">
        <thead>
            <tr>
                <th scope="col">Unit</th>
                <th scope="col">Host Name</th>
                <th scope="col">Gender</th>
                <th scope="col">IC Number</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Emergency Number</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="ResidentTableBody">

            <!-- Use PHP to fetch from database and create table row -->
            <?php
                $data_query = mysqli_query($con, "SELECT * FROM unit INNER JOIN resident ON unit.owner_ic = resident.ic");

                if(mysqli_num_rows($data_query) > 0)
                {
                    foreach($data_query as $resident)
                    {
            ?>
                        <tr>
                            <td><?= $resident['unit_no'] ?></td>
                            <td><?= $resident['name'] ?></td>
                            <td><?= $resident['gender'] ?></td>
                            <td><?= $resident['ic'] ?></td>
                            <td><?= $resident['contact'] ?></td>
                            <td><?= $resident['emergency_contact'] ?></td>
                            <td>
                                <button type="button" value="<?=$resident['ic'];?>" class='btn editResidentBtn'><i class='bi bi-pencil-square text-primary'></i></button>
                                <button type="button" value="<?=$resident['ic'];?>" class='btn deleteResidentBtn'><i class='bi bi-trash3 text-danger'></i></button>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
            
        </tbody>
    </table>
    <!-- User Table End -->

</div>

<div class="col-12 mycontainer mt-4">
    <div class="title d-flex align-items-center mb-2">
        <h2>Stop Rental Requests</h2>
    </div>
    <!-- Request Table Start -->
    <table class="display" id="RequestTable">
        <thead>
            <tr>
                <th scope="col">Unit</th>
                <th scope="col">Host Name</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="RequestTableBody">
            <?php
                $data_query = mysqli_query($con, "SELECT * FROM unit INNER JOIN resident ON unit.owner_ic = resident.ic WHERE rental_status='request to stop'");

                if(mysqli_num_rows($data_query) > 0)
                {
                    foreach($data_query as $resident)
                    {
            ?>
                        <tr>
                            <td><?= $resident['unit_no'] ?></td>
                            <td><?= $resident['name'] ?></td>
                            <td><?= $resident['contact'] ?></td>
                            <td>
                                <button type="button" value="<?=$resident['ic'];?>" class='btn editResidentBtn'><i class='bi bi-pencil-square text-primary'></i></button>
                                <button type="button" value="<?=$resident['ic'];?>" class='btn deleteResidentBtn'><i class='bi bi-trash3 text-danger'></i></button>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
    <!-- Request Table End -->
</div>

<div class="col-12 mycontainer mt-4">
    <div class="title d-flex align-items-center mb-2">
        <h2>Registered Visitor</h2>
        <input type="button" class="btn btn-primary ms-auto" id="showUpcoming" value="Show Upcoming"/>
    </div>
    <!-- Visitor Table Start -->
    <table class="display" id="VisitorTable">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Visitor Name</th>
                <th scope="col">Visiting Unit</th>
                <th scope="col">Car Plate</th>
                <th scope="col">Visitor Contact</th>
            </tr>
        </thead>
        <tbody id="VisitorTableBody">
            <?php
                $data_query = mysqli_query($con, "SELECT * FROM visitorpass");

                if(mysqli_num_rows($data_query) > 0)
                {
                    foreach($data_query as $visitor)
                    {
            ?>
                        <tr>
                            <td><?= $visitor['start_time'] ?></td>
                            <td><?= $visitor['visitor_name'] ?></td>
                            <td><?= $visitor['unit'] ?></td>
                            <td><?= $visitor['car_plate'] ?></td>
                            <td><?= $visitor['visitor_contact'] ?></td>
                        </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
    <!-- Visitor Table End -->
</div>

<!-- ################################################################### -->
                        <!-- MODAL POPUP -->
<!-- ################################################################### -->

<!-- addResidentModal -->
<div class="modal fade" id="addResidentModal" tabindex="-1" aria-labelledby="AddModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalLabel">Add New Resident: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="edit">
                <form method="POST" action="admin-manageuser.php">
                    <div class="mb-3">
                        <label for="unit" class="col-form-label">Unit:</label>
                        <?php
                            $dropdown = '<select name="new-unit" class="form-select" required>';

                            $query = mysqli_query($con, "SELECT * FROM unit WHERE owner_ic=''");
                            while($row = mysqli_fetch_array($query)) {
                                $unit_no = $row['unit_no'];
                
                                $dropdown = $dropdown . "<option value='$unit_no'>$unit_no</option>";
                            }

                            echo $dropdown. "</select>";
                        
                        ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="col-form-label">Resident Name </label>
                            <input type="text" name="new-name" class="form-control" id="name" required placeholder="Full Name">
                        </div>
                        <div class="col">
                            <label for="ic" class="col-form-label">IC Number </label>
                            <input type="text" class="form-control" name="new-ic" id="ic" placeholder="010616-14-1303" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="race" class="col-form-label">Race</label>
                            <select name="new-race" id="race" class="form-select" required>
                                <option value="Malay">Malay</option>    
                                <option value="Chinese">Chinese</option>
                                <option value="Indian">Indian</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="" class="col-form-label">Gender</label>
                            <select name="new-gender" id="new-gender" class="form-select" required>
                                <option value="Male">Male</option>    
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dob" class="col-form-label">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="new-dob" required>
                        </div>
                        <div class="col">
                            <label for="contact" class="col-form-label">Phone Number:</label>
                            <input type="text" class="form-control" id="contact" name="new-contact" placeholder="012-3456789" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="emergency" class="col-form-label">Emergency Phone Number: </label>
                            <input type="text" class="form-control" id="emergency" name="new-emergency" placeholder="012-3456789" required>
                        </div>
                        <div class="col">
                            <label for="email" class="col-form-label">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="new-email" placeholder="example@mail.com" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col">
                        <label for="covidstatus" class="col-form-label">Covid Status:</label>
                        <select name="new-covidstatus" id="covidstatus" class="form-select">
                                <option value="Negative">Negative</option>
                                <option value="Close Contact">Close Contact</option>
                                <option value="Positive">Positive</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="vaccinestatus" class="col-form-label">Vaccine Status:</label>
                        <!-- select input later -->
                        <select name="new-vaccinestatus" id="vaccinestatus" class="form-select">
                                <option value="Not Vaccinated At All">Not Vaccinated At All</option>
                                <option value="1st Dose">1st Dose</option>
                                <option value="2nd Dose">2nd Dose</option>
                                <option value="3rd Dose (Booster)">3rd Dose (Booster)</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="vaccinestatus" name="new-vaccinestatus" required> -->
                    </div>
                    </div>
                    <input type="submit"  class="me-lg-3 btn btn-primary" id="submit" name="create_resident">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- addResidentModal END -->

<!-- Edit Modal Popup-->
    <div class="modal fade" id="editResidentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My Edit Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateResident" method="POST" action="admin-manageuser.php">
                <div class="modal-body">

                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                    <input type="hidden" name="resident_ic" id="resident_ic" >
                    <div class="row mb-3">
                        <div class="col">
                            <label for="ic">IC</label>
                            <input type="text" name="editResident-ic" id="editResident-ic" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" name="editResident-name" id="editResident-name" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Date of Birth</label>
                            <input type="date" name="editResident-dob" id="editResident-dob" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="" class="col-form-label">Gender</label>
                            <select name="editResident-gender" id="editResident-gender" class="form-select" required>
                                <option value="Male">Male</option>    
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="race" class="col-form-label">Race</label>
                            <select name="editResident-race" id="editResident-race" class="form-select" required>
                                <option value="Malay">Malay</option>    
                                <option value="Chinese">Chinese</option>
                                <option value="Indian">Indian</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="status" class="col-form-label">Rental Status</label>
                            <select name="editResident-status" id="editResident-status" class="form-select" required>
                                <option value="renting">Renting</option>
                                <option value="request to stop">Request to stop</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Contact</label>
                            <input type="text" name="editResident-contact" id="editResident-contact" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="">Emergency Contact</label>
                            <input type="text" name="editResident-emergencycontact" id="editResident-emergencycontact" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Email</label>
                            <input type="text" name="editResident-email" id="editResident-email" class="form-control" required />
                        </div>
                        <div class="col">
                            <label for="">Check In Date</label>
                            <input type="text" name="editResident-checkindate" id="editResident-checkindate" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Profile Picture</label>
                            <input type="text" name="editResident-profile_pic" id="editResident-profile_pic" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="update_resident" value="Update Resident" />
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- Edit Modal Popup END-->

<!-- (Included In This file Only)Manage User JS -->
<script src="assets/js/manageuser.js"></script>
<?php include 'includes/admin-footer.php';?>
