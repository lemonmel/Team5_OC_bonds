<?php

$pageTitle = "Profile";
include 'includes/header.php';
?>
<!-- 
  use <?php //echo $Resident->getName()
      ?>  to fetch dynamic   
-->

<div class="container main-content-container">
  <div class="profile_container row my_container p-4">
    <div class="mycontainer col-9 d-flex flex-column justify-content-start">
      <form onsubmit="return confirmEdit();" method="POST" action="profile_Edit.php" id="mainForm">
        <div class="generalInformationSection">
          <h3>General Information</h3>
          <hr />
          <div class="row">
            <div class="col">
              <label for="profile-name" class="form-label">Name</label>
              <input type="text" class="form-control" value=<?= "'" . $Resident->getName() . "'"; ?> id="profile-name" name="profile-name" required disabled />
            </div>
            <div class="col">
              <label for="profile-ic" class="form-label">Identity Number</label>
              <input type="text" class="form-control" value="<?= $Resident->getIc(); ?>" id="profile-ic" name="profile-ic" disabled required />
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="profile-dob" class="form-label">Date Of Birth (mm/dd/YYYY)</label>
              <input type="date" class="form-control" value="<?= $Resident->getDob(); ?>" id="profile-dob" name="profile-dob" disabled required />
            </div>
            <div class="col">
              <label for="profile-gender" class="form-label">Gender</label>
              <select name="profile-gender" id="profile-gender" disabled class="form-select" disabled required>
                <?php
                //use php to get the value inside DB and make it selected
                //make the current gender as selected 
                $currentGender = $Resident->getGender();
                $genderSelections = array("Male", "Female", "Other");

                $selectInputString = "";

                foreach ($genderSelections as $gender) {
                  if ($gender == $currentGender) {
                    $selectInputString .= "<option selected value='$currentGender'>$currentGender</option>";
                  } else {
                    $selectInputString .= "<option value='$gender'>$gender</option>";
                  }
                }
                echo $selectInputString;
                ?>
                <!-- <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option> -->
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="profile-email" class="form-label">Email</label>
              <input type="email" class="form-control" value="<?= $Resident->getEmail() ?>" id="profile-Email" name="profile-Email" disabled required />
            </div>
            <div class="col">
              <label for="profile-contact" class="form-label">Contact Number</label>
              <input type="text" class="form-control" value="<?= $Resident->getContact() ?>" id="profile-contact" name="profile-contact" disabled required />
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="profile-emergencyContact" class="form-label">Emergency Contact</label>
              <input type="text" class="form-control" value="<?= $Resident->getEmergencyContact() ?>" id="profile-emergencyContact" name="profile-emergencyContact" disabled required />
            </div>
            <div class="col">
              <label for="profile-race" class="form-label">Race</label>
              <select name="profile-race" id="profile-race" name="profile-race" class="form-select" disabled required>
                <?php
                //make the current gender as selected 
                $currentRace = $Resident->getRace();
                $raceSelections = array("Malay", "Chinese", "Indian", "Other");

                $raceOptionString = "<option selected value='$currentRace'>$currentRace</option>";

                // then create the other 2 option input
                foreach ($raceSelections as $race) {
                  if ($race != $currentRace) {
                    $raceOptionString .= "<option value='$race'>$race</option>";
                  }
                }
                echo $raceOptionString;
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="profile-vaccinationStatus" class="form-label">Vaccination Status</label>

              <!-- Since it will not be editable, so changed it to text input instead of select box -->
              <input type="text" class="form-control" value="<?= $Resident->getVaccineStatus() ?>" id="profile-vaccinationStatus" disabled required />

              <!-- <select name="profile-vaccinationStatus" id="profile-vaccinationStatus" class="form-select"
                  disabled required>

                  <option value="0">Not Vaccinated At All</option>
                  <option value="1">1st Dose</option>
                  <option value="2">2nd Dose</option>
                  <option value="3">3rd Dose (Booster)</option>
                </select> -->
            </div>
          </div>
        </div>

        <div id="editValidationBtn"></div>
        <div id="editSuggestion"></div>
        <button class="btn btn_mygreen w-100 mt-4" id="editBtn" onclick="edit()" type="button">
          <i class="me-2 fa fa-edit" aria-hidden="true"></i>Edit
        </button>
      </form>
      <div class="accomodationInformationSection" style="margin-top: 10%">
        <h3>Accomodation Information</h3>
        <hr />
        <div class="row">
          <div class="col">
            <label for="profile-roomNum" class="form-label">Unit</label>
            <input type="text" class="form-control" value='<?= $Resident->getUnit() ?>' id="profile-roomNum" disabled />
          </div>
          <div class="col">
            <label for="profile-carPark" class="form-label">Carpark ID</label>
            <input type="text" class="form-control" value='<?= $Resident->getCarPark() ?>' id="profile-carPark" disabled />
          </div>
        </div>
      </div>
      <form onsubmit="return confirmChangePassword()" method="post" action="changePassword.php" id="changePasswordForm">
        <div class="changePasswordDiv" style="margin-top: 10%">
          <h3>Change Password</h3>
          <hr />
          <div class="row">
            <div class="col" style="display: none;">
              <label for="profile-password" class="form-label">Current Password</label>
              <div class="row">
                <div class="col">
                  <input type="password" class="form-control"  value=<?= "'" . $Resident->getPassword() . "'"; ?> id="profile-password" name="profile-password" required disabled />
                </div>
                <div class="col" style="margin-top:10px;">
                  <i class="bi bi-eye-slash" id="toggleOriginalPassword"></i>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="col">
                <label for="profile-newPassword" class="form-label">New Password</label>
                <div class="row">
                  <div class="col">
                    <input type="password" class="form-control" value="" placeholder="New Password Here" id="profile-newPassword" name="profile-newPassword" required />
                  </div>
                  <div class="col" style="margin-top:10px;">
                    <i class="bi bi-eye-slash" id="toggleNewPassword"></i>
                  </div>
                </div>
              </div>
              <p id="samePassword" style="color: red; font-size:10px;"></p>
            </div>
          </div>
          <button class="btn btn-warning w-100 mt-4" style="color:aliceblue;" id="chgPassBtn" type="submit"><i style="margin-right: 10px;" class="bi bi-pencil-fill"></i>Change Password</button>
          <br />
          

        </div>
      </form>
      <hr/>
      
      <div class="dangerZone">
      <h3>Danger Zone</h3>
        <form onsubmit="return confirmDelete()" method="post" action="deleteAccount.php" id="deleteForm">
          <button class="btn btn-danger w-100 mt-4" id="deleteBtn" type="submit" value="Delete Account"><i style="margin-right: 10px;" class="bi bi-trash3" style="margin-right: 10px;"></i>Delete Account</button>
        </form>
      </div>
    </div>
    <div class="minimizeProfileSide" id="minimizeProfileSide" onclick="toggleSide()">
      <div id="toggleSideButton2"></div>
      <img src=<?php echo $Resident->getProfilePic() ?> alt="profile-image" class="small_profile_picture">
      <h6><?php echo $Resident->getName() ?></h6>
    </div>
      <div class="profileImgSide" id="profileImgSide">
        <div onclick="toggleSide()" id="toggleSideButton"></div>

        <div class="image" style="margin-top: 20px;">
          <img src=<?php echo $Resident->getProfilePic() ?> alt="profile image" id="profile-image" class=""> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill editImage button button_link" viewBox="0 0 16 16" onclick="changeProfileImage()">
            <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
            <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
          </svg> </img>

         
        </div>
        <hr />
        <div class="details">
          <h2><?php echo $Resident->getName() ?></h2>
          <h2><?php echo $Resident->getUnit() ?></h2>
        </div>
        <?php
              if($Resident->getCovidStatus()=="Negative"){
                echo '
                <div class="riskStatus">
                <i class="fa-solid fa-virus"></i>
                <div>
                  <h5>COVID-19 Risk Status</h5>
                  <h3>Low Risk No Symptom</h3>
                  </div>
                </div>
                ';
              } 
              else if($Resident->getCovidStatus()=="Close Contact"){
                echo '
                <div class="riskStatus" style="background-color:orange; ">
                <i class="fa-solid fa-virus"></i>
                <div>
                  <h5>COVID-19 Risk Status</h5>
                  <h3>Close Contact</h3>
                  </div>
                </div>
                ';
              } 
              else if($Resident->getCovidStatus()=="Positive"){
                echo '
                <div class="riskStatus" style="background-color:red; ">
                <i class="fa-solid fa-virus"></i>
                <div>
                  <h5>COVID-19 Risk Status</h5>
                  <h3>Infected</h3>
                  </div>
                </div>
                ';
              } 
            ?>
        <div class="vacinnationStatus">
          <i class="fa-solid fa-syringe"></i>
          <div>
            <h5>COVID-19 Vaccination Status</h5>
            <?php
              if($Resident->getVaccineStatus()=="Not Vaccinated At All"){
                echo "<h3>Not Vaccinated at All</h3>"; 
              }
              else if($Resident->getVaccineStatus()=="1st Dose"){
                echo "<h3>First Dose</h3>"; 
              }
              else if($Resident->getVaccineStatus()=="2nd Dose"){
                echo "<h3>Second Dose</h3>"; 
              }
              else{
                echo "<h3>Fully Vaccinated (Third Dose)</h3>"; 
              }
            ?>
          </div>
        </div>


      </div>
    
  </div>
</div>

<!-- Pop-up Modal Start-->
<div class="modal fade" id="alert-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-flex flex-column align-items-center">
        <div class="alert" role="alert"></div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn_mygreen" data-bs-dismiss="modal" id="yes-button" onclick="">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Pop-up Modal End-->

<!-- This file only JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script type="text/javascript">
var email = "<?= $Resident->getEmail() ?>"; 
var name ="<?= $Resident->getName()  ?>"
$("#profile-newPassword").on('keyup',function(){
  console.log("lol")
  let currentPass=document.getElementById("profile-newPassword").value

  let oriPass = document.getElementById("profile-password").value
  var hash = CryptoJS.SHA1("bonds");
  var encryptedCurrentPass = CryptoJS.MD5(currentPass)
  if(oriPass==encryptedCurrentPass){
    document.getElementById("samePassword").innerHTML="New password cannot same with previous password"
    document.getElementById("chgPassBtn").disabled=true;
    document.getElementById("chgPassBtn").className="btn btn-secondary w-25 mt-4";
  }
  else{
    document.getElementById("samePassword").innerHTML=""
    document.getElementById("chgPassBtn").disabled=false;
    document.getElementById("chgPassBtn").className="btn btn-warning w-25 mt-4"; 
  }
})

</script>
<script src="assets/js/profile.js">
</script>
<?php include 'includes/footer.php'; ?>
