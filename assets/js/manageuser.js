
/* call this function when window load */
$(document).ready(function () {
    buildTable('#ResidentTable')
    buildTable('#RequestTable')
    buildTable('#VisitorTable')
})

/* Build tables functions  */
function buildTable(tableID) {
    //initialize datatable
    $(tableID).DataTable({
        "initComplete": function (settings, json) {
            $(tableID).wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
        },
        "scrollCollapse": true,
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    })
}
// ########################################
        // After Change To PHP

/* Delete resident function */
$(document).on('click', '.deleteResidentBtn', async function (e) {//when clicked delete button
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?')){
        var resident_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "includes/controllers/resident_controller.php",
            data: {
                'delete_resident': true,
                'resident_id': resident_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    alert(res.message);
                }else{
                    $('.toast-container').empty()
                    var toastr = `
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                            <div class="toast-header">
                                <span class="bg-primary px-2 rounded">&nbsp;</span>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                ${res.message}
                            </div>
                        </div>
                    `
                    $('.toast-container').append(toastr);
                    $('.toast').toast('show');

                    $('#ResidentTable').load(location.href + " #ResidentTable");
                    setTimeout(function(){ window.location="admin-manageuser.php";}, 2000);
                }
            }
        });
    }
});

/* Edit resident function to fill in the fields*/
$(document).on('click', '.editResidentBtn', function () {
    var resident_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "includes/controllers/resident_controller.php?resident_id=" + resident_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){
                
                document.getElementById("editResident-dob").value = res.data.dob;
                document.getElementById("editResident-gender").value = res.data.gender;
                document.getElementById("editResident-race").value = res.data.race;
                $('#editResident-ic').val(res.data.ic);
                $('#editResident-name').val(res.data.name);
                $('#editResident-contact').val(res.data.contact);
                $('#editResident-emergencycontact').val(res.data.emergency_contact);
                $('#editResident-email').val(res.data.email);
                $('#editResident-status').val(res.data.rental_status);
                $('#editResident-checkindate').val(res.data.check_in_date);
                $('#editResident-profile_pic').val(res.data.profile_pic);
                
                document.getElementById("editResident-ic").readOnly = true;
                document.getElementById("editResident-checkindate").readOnly = true;
                $('#editResidentModal').modal('show');
            }
        }
    });
});

/* Visitor table showing data function */
Number.prototype.padLeft = function(base,chr){
    var  len = (String(base || 10).length - String(this).length)+1;
    return len > 0? new Array(len).join(chr || '0')+this : this;
}

$(document).on('click', '#showUpcoming', function () {
    console.log("show upcoming");
    // Declare variables
    var table, tr, td, i;
    var d = new Date,
    today = [d.getFullYear(),
        (d.getMonth()+1).padLeft(),
        d.getDate().padLeft()].join('-') +' ' +
       [d.getHours().padLeft(),
        d.getMinutes().padLeft(),
        d.getSeconds().padLeft()].join(':');
    table = document.getElementById("VisitorTableBody");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
    
      td = tr[i].getElementsByTagName("td")[0].innerHTML;
      console.log(td);
      console.log(today);
      if (td) {
        if (td > today) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
    document.getElementById('showUpcoming').id = 'cancelFilter';
    document.getElementById('cancelFilter').value = 'Show All';
});

$(document).on('click', '#cancelFilter', function () {
    // Declare variables
    var table, tr, i;
    table = document.getElementById("VisitorTableBody");
    tr = table.getElementsByTagName("tr");
    // Loop through all table rows, cancel .display="none"
    for (i = 0; i < tr.length; i++) {
        tr[i].style.display = "";
    }
    document.getElementById('cancelFilter').id = 'showUpcoming';
    document.getElementById('showUpcoming').value= 'Show Upcoming';
});
