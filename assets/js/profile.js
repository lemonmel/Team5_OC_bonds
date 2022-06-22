/* Building the modal content */
function buildEditAlert() {
  $(".alert").empty();
  newBody = `<p>Confirm Edit?</p>`;
  $(".alert").append(newBody);
}

function buildDeleteAlert() {
  $(".alert").empty();
  newBody = `
    <p>Are you sure you want to delete your account?</p>
    <important style="color: red; font-size:10px;">⁕Once delete, you will have to request for account
    activation from admin of Bonds!!</important><br>`;
  $(".alert").append(newBody);
}

function buildChgPassAlert() {
  $(".alert").empty();
  newBody = `
    <p>Are you sure you want to change your password?</p>`;
  $(".alert").append(newBody);
}

function buildVerificationAlert() {
  $(".alert").empty();
  newBody = `
    <p>A verification code had been send to your email</p>
    <div class="row verificationDiv">
      <label for="veriCodeUser">Verification Code: </label>
      <div class="col">
        <input id="veriCodeUser" type="text" name="veriCodeUser" required/> 
      </div>
      <div class="col">
        <p id="timer"></p>
      </div>
    </div>
    <p id="incorrectCode"></p>
  `;
  $(".alert").append(newBody);
}

//function to set countdown timer for verification code
var timeout = 60;
function startTimer() {
  timeout = 60;
  const element = document.getElementById("timer");
  var interval = setInterval(function () {
    if (timeout <= 0) {
      clearInterval(interval);
      element.innerHTML = "<button onclick='resendCode()' class='btn btn-primary btn-sm'>Resend Code</button>";
    } else {
      element.innerHTML = timeout;
      timeout -= 1;
    }
  }, 1000);
}

function resendCode() {
  startTimer();
  verificationCode = generateOTP();
  sendEmail();
}

function buildFooter() {
  $(".modal-footer").empty();
  newFooter = `
    <button type="button" class="btn btn_mygreen" data-bs-dismiss="modal" id="yes-button" onclick="">Yes</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
  `;
  $(".modal-footer").append(newFooter);
}

function buildChangeImg() {
  $(".alert").empty();
  newBody = `
    <h5 class="message">Change Profile Picture?</h5>
    <form id="formChangeProfile" method="post" action="changeProfilePic.php" enctype="multipart/form-data">
      <input type="file" class="form-control" name="newProfilePic" id="newProfilePic" accept="image/*" required />
      <br>
      <input type="submit" name="submit" class="me-lg-3 btn btn_mygreen" id="submit">
    </form>
  `;
  $(".alert").append(newBody);

  $(".modal-footer").empty();
  newFooter = `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="buildFooter()">Cancel</button>`;
  $(".modal-footer").append(newFooter);
}

/* Changing Profile Image */
function changeProfileImage() {
  buildChangeImg();
  $("#alert-modal").modal("show");

}

var tempImg = "";
function loadNewImage() {
  tempImg = URL.createObjectURL(event.target.files[0]);
}

function confirmChange() {
  var image = document.getElementById("profile-image");
  image.src = tempImg;
  $("#alert-modal").modal("hide");
  buildFooter();
}

/* Edit information */
function edit() {
  var allitem = document.getElementById("mainForm").querySelectorAll("input");
  for (var i = 0; i < allitem.length; i++) {
    if (i != allitem.length - 1) {
      allitem[i].disabled = false;
    }
  }
  var allitemselect = document.querySelectorAll("select");
  for (var i = 0; i < allitemselect.length; i++) {
    allitemselect[i].disabled = false;
  }
  document.getElementById("profile-ic").disabled = true; //primary key cannot been edited
  document.getElementById("editBtn").style.display = "none";
  document.getElementById("editValidationBtn").innerHTML =
    " <input type='submit' class='btn btn_mygreen w-25 mt-4' value='Confirm'/><button type='button' class='btn btn-danger w-25 mt-4' onclick='cancelEdit()' style='margin-left:3%;'>Cancel</button>";
  document.getElementById("editSuggestion").innerHTML =
    "<p style='color:red;'>⁕Edit the details inside the text box</p>";
}

function cancelEdit() {
  document.getElementById("editBtn").style.display = "";
  document.getElementById("editValidationBtn").innerHTML = "";
  document.getElementById("editSuggestion").innerHTML = "";

  var allitem = document.getElementById("mainForm").querySelectorAll("input");
  for (var i = 0; i < allitem.length; i++) {
    allitem[i].disabled = true;
  }
  var allitemselect = document.querySelectorAll("select");
  for (var i = 0; i < allitemselect.length; i++) {
    allitemselect[i].disabled = true;
  }
  location.reload();
}

function handleEdit(event) {
  console.log(document.getElementById("profile-firstName").value);
}

var confirmed = false;

function confirmEdit() {
  if (!confirmed) {
    buildEditAlert();
    $("#alert-modal").modal("show");
    $("#yes-button").attr(
      "onClick",
      'confirmed = true; document.getElementById("mainForm").submit();'
    );
    return false;
  } else {
    return true;
  }
}

/* Deletion of Account */
var confirmedDelete = false;

function confirmDelete() {
  if (!confirmedDelete) {
    buildDeleteAlert();
    $("#alert-modal").modal("show");
    $("#yes-button").attr(
      "onClick",
      'confirmedDelete = true; document.getElementById("deleteForm").submit();'
    );
    return false;
  } else {
    return true;
  }
}

function deleteAccount() {
  // further deletion of account in database
  console.log("delete");
}

/* Toggle Sidebar */
var initialTogglestate = true;
if (initialTogglestate) {
  document.getElementById("toggleSideButton").innerHTML =
    "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-compact-down' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z'/></svg>";
}

function toggleSide() {
  if (initialTogglestate) {
    document.getElementById("profileImgSide").style.display = "none";
    document.getElementById("minimizeProfileSide").style.display = "flex";
  } else {
    document.getElementById("profileImgSide").style.display = "block";
    document.getElementById("minimizeProfileSide").style.display = "none";
  }
  initialTogglestate = !initialTogglestate;
}

const toggleOriginalPassword = document.querySelector("#toggleOriginalPassword");
const originalPassword = document.querySelector("#profile-password");

toggleOriginalPassword.addEventListener("click", function () {
  const type =
  originalPassword.getAttribute("type") === "password" ? "text" : "password";
  originalPassword.setAttribute("type", type);
  // toggle the icon
  this.classList.toggle("bi-eye");
});

const toggleNewPassword = document.querySelector("#toggleNewPassword");
const newPassword = document.querySelector("#profile-newPassword");

toggleNewPassword.addEventListener("click", function () {
  const type2 =
    newPassword.getAttribute("type") === "password" ? "text" : "password";
  newPassword.setAttribute("type", type2);
  // toggle the icon
  this.classList.toggle("bi-eye");
});

let verificationCode = 0;

function generateOTP() {
  return Math.floor(Math.random() * 900000 + 100000);
}

var confirmedChangePassword = false;
function confirmChangePassword() {
  verificationCode = generateOTP();
  sendEmail();
  console.log(verificationCode);
  if (!confirmedChangePassword) {
    buildVerificationAlert();
    $("#alert-modal").modal("show");
    startTimer();
    $("#yes-button").click(function () {
      if (document.getElementById("veriCodeUser").value == verificationCode) {
        confirmedChangePassword = true;
        document.getElementById("changePasswordForm").submit();
      } else {
        document.getElementById("incorrectCode").innerHTML="Incorrect Code"
      }
    });
    return false;
  } else {
    return true;
  }
}

// function to send Email for verification code
function sendEmail(){
  var data = {
    service_id: 'bondsService',
    template_id: 'verificationEmail',
    user_id: '4R4tjUWwsWbbfoi8W',
    template_params: {
        'from_name':"bonds",
        'to_name': name,
        'message': 'Your verification code for password reset is :' + verificationCode,
        email: email
    }
};
$.ajax('https://api.emailjs.com/api/v1.0/email/send', {
    type: 'POST',
    data: JSON.stringify(data),
    contentType: 'application/json'
}).done(function() {
    message => console.log(message)
}).fail(function(error) {
  console.log(JSON.stringify(error))
});
}
