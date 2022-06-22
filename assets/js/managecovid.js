
    var datatable; //initialize datatable variable


/* call this function when window load */
$(document).ready(function () {
    buildTable('#CovidTable')
    buildTable('#ReportTable')
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



// When Edit Covid Button Clicked
$(document).on('click', '.editCovidBtn', function () {
    var resident_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "includes/controllers/managecovid_controller.php?resident_id="+resident_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {
                alert("error "+res.message)
            }else if(res.status == 200){
                
                $('#covid-ic').val(res.data.ic)
                $('#covid-name').text(res.data.name)

                $('#covid-covidstatus').val(res.data.covid_status)
                $('#covid-vaccinestatus').val(res.data.vaccine_status)   

                $('#covid-select').val(res.data.covid_status)           
                $('#vaccine-select').val(res.data.vaccine_status)          
                
                $('#CovidUpdateModal').modal('show')
            }
            
        }
    });

});

// When View Covid Report Button Clicked
$(document).on('click', '.viewReportBtn', function () {
    var report_id = $(this).val();

    $.ajax({
        type: "GET",
        url: "includes/controllers/managecovid_controller.php?report_id=" + report_id,
        success: function (response) {

            var res = jQuery.parseJSON(response)
            if(res.status == 404) {
                alert("error"+res.message)
            }else if(res.status == 200){
                
                $('#report-id').text('#'+res.data.report_id);
                $('#report-name').text(res.data.name);
                
                $('#report-covidstatus').val(res.data.covid_status);
                $('#report-vaccinestatus').val(res.data.vaccine_status);     
                $('#report-type').text(res.data.report_type);     
                $('#report-for').text(res.data.report_for_status);     
                $('#report-evidence').attr('src',res.data.evidence);     
                
                
                $('#report-input-id').val(res.data.report_id);
                $('#delete-report-button').val(res.data.report_id);
                $('#report-ic').val(res.data.ic);
                $('#report-covid-select').val(res.data.covid_status);               
                $('#report-vaccine-select').val(res.data.vaccine_status);
                
                $('#ViewReportModal').modal('show')
            }

        }
    });

});

/* Delete resident function */
$(document).on('click', '.deleteReportBtn', async function (e) {//when clicked delete button
    e.preventDefault();

    if(confirm('Are you sure you want to delete this report?')){
        var report_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "includes/controllers/managecovid_controller.php",
            data: {
                'delete_report': true,
                'report_id': report_id
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

                    $('#ReportTable').load(location.href + " #ReportTable");
                    setTimeout(function(){ window.location="admin-managecovid.php";}, 2000);

                }
            }
        });
    }
});