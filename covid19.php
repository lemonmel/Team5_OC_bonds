<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
    $pageTitle = "Covid 19";
    include 'includes/header.php';
    include 'includes/controllers/covidreport_controller.php';?>
    <!-- Covid Report Statistics -->
    <div class="col-lg-9">
        <div class="mycontainer">
            <!-- Start View Covid Bar -->
            <div class="row d-flex align-items-center">
                <h2 class="text-decoration-none fs-1 fw-bold mydarkgreen text-center">View Covid 19 Cases</h2>
                <div class="col-12 col-md-4">
                    <button class="btn btn_mygreen" onClick="window.location.reload();">Refresh Page</button>
                </div>    
                <div class="col-12 col-md-8">
                    <ul class="nav nav-tabs d-flex align-items-start" id="myTab" role="tablist">
                        <li class="ms-auto" role="presentation">
                            <button class="nav-link active" id="overall-tab" data-bs-toggle="tab"
                                data-bs-target="#overall-tab-content" type="button" role="tab"
                                aria-controls="overall-tab-content"
                                aria-selected="true">Today</button>
                        </li>
                        <li class="" role="presentation">
                            <button class="nav-link" id="week-tab" data-bs-toggle="tab"
                                data-bs-target="#week-tab-content" type="button" role="tab"
                                aria-controls="week-tab-content" aria-selected="false">Week</button>
                        </li>
                        <li class="" role="presentation">
                            <button class="nav-link" id="month-tab" data-bs-toggle="tab"
                                data-bs-target="#month-tab-content" type="button" role="tab"
                                aria-controls="month-tab-content"
                                aria-selected="false">Month</button>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="tab-content" id="myTabContent">
                <!-- Overall Cases Tab -->
                <div class="tab-pane fade show active" id="overall-tab-content" role="tabpanel"
                aria-labelledby="overall-tab">
                <div class="text-center">
                    <h3 class="">Daily Cases: Updated <?=getDateNow(0,"days","'d M Y - h:i A'");?></span> </h3>
                    <h3 class="text-danger">New Cases: <span><?=getNewCases()?></span></h3>
                    <h3 class="text-warning">Active Cases: <span><?=getActiveCases()?></span></h3>
                </div>
                <div class="row">
                        <div class="ps-4 container mt-2 w-50 mx-auto">
                            <h6 id="Block A" class="alert">Block A: <span>0</span></h6>
                            <h6 id="Block B" class="alert">Block B: <span>0</span></h6>
                            <h6 id="Block C" class="alert">Block C: <span>0</span></h6>
                            <h6 id="Block D" class="alert">Block D: <span>0</span></h6>
                            <div class="d-flex justify-content-around">
                                <span class="alert alert-success p-1 mx-1">(0)</span>
                                <span class="alert alert-primary p-1">(1-4)</span>
                                <span class="alert alert-warning p-1">(5-9)</span>
                                <span class="alert alert-danger p-1">(>=10)</span>
                            </div>
                        </div>
                        <div class="w-50 mx-auto p-4">
                            <canvas id="dailyActiveCovidGraph" class=""></canvas>
                        </div>
                    </div>
                </div>
                <!-- Overall Cases Tab End -->

                <!-- Last Month Cases Tab -->
                <div class="tab-pane fade" id="month-tab-content" role="tabpanel"
                    aria-labelledby="month-tab">
                    <div class="text-center">
                        <h3 class="pt-2">Last Month's Cases: <span><?=getDateNow(-1,"months","'M Y'");?></span></h3>
                        <small class="text-muted">Last Updated: <?=getDateNow(-1,"days","'d M Y'");?></small>
                    </div>
                    <div id="covid_monthly">
                        <canvas id="monthlyActiveCovidGraph"></canvas>
                    </div>
                </div>
                <!-- Last Month Cases Tab End -->

                <!-- Last Week Cases Tab -->
                <div class="tab-pane fade" id="week-tab-content" role="tabpanel"
                    aria-labelledby="week-tab">
                    <div class="text-center">
                        <h3 class="pt-2">Last Week's Cases: <span><?=getDateNow(-7,"days","'d'");?>-<?=getDateNow(-1,"days","'d M Y'");?> </span></h3>
                        <small class="text-muted">Last Updated: <?=getDateNow(-1,"days","'d M Y'");?></small>
                    </div>
                    <div id="covid_weekly">
                        <!-- Weekly Graph -->
                        <canvas id="weeklyCovidGraph"></canvas>
                    </div>
                </div>
                <!-- Last Week Cases Tab End -->
            </div>
            <!-- End View Covid Bar -->
        </div>
    </div>

    <!-- Report Buttons -->
    <div class="col-lg-3 mt-lg-0 mt-4">
        <!-- For Trggering Covid Report -->
        <div class="mycontainer">
            <h3>Report Covid</h3>
            <p>Diagnosed Yourself?<br>Made a Recovery?<br>Make a report below to let us know</p>
            <button class="btn btn_mygreen" data-bs-toggle="modal"
                data-bs-target="#covidModal">Report</button>
        </div>
        <!-- For Trggering Update Vaccine -->
        <div class="mycontainer mt-4">
            <h3>Update Vaccine</h3>
            <p>Just had a new shot?<br>Update your vaccine status here</p>
            <button class="btn btn_mygreen" data-bs-toggle="modal"
                data-bs-target="#vaccineModal">Update</button>
        </div>
    </div>
    <!-- End Report Buttons -->

    <!-- Covid Report Popup Modal -->
    <div class="modal fade" id="covidModal" tabindex="-1" aria-labelledby="covidModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="covidModalLabel">Make A Covid Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cancel"></button>
                </div>
                <form class="modal-body" method="POST" id="myForm" enctype="multipart/form-data">
                    <!-- Unit No. and current Covid Status Will Be Get from db Dynamically -->
                    <h6 class="mt-4">Unit</h6>
                    <input type="text" class="form-control" name="covid-unit" value='<?=$loggedInUnit?>' readonly>
                    <h6 class="mt-4">Reporting For</h6>
                    <select class="form-select" aria-label="Default select example" name="covid-report_for" required>
                        <option value="" selected disabled hidden>Choose here</option>
                        <option value="Negative">Negative</option>
                        <option value="Close Contact">Close Contact</option>
                        <option value="Positive">Positive</option>
                    </select>
                    <p>(Your Current Covid Status: <?=$Resident->getCovidStatus()?>)</p>
                    <h6 class="mt-4">PCR Kit Image</h6>
                    <input class="form-control form-control-sm" type="file" name="covid-evidence" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn_mygreen" id="submit" name="covid_report_btn" value="Report">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Covid Report Modal -->

    <!-- Vaccine Report Popup Modal -->
    <div class="modal fade" id="vaccineModal" tabindex="-1" aria-labelledby="vaccineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vaccineModalLabel">Update Your Vaccine Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cancel"></button>
                </div>
                <form class="modal-body" method="POST" id="updateVaccineForm" enctype="multipart/form-data">
                    <!-- Unit No. and current Vaccine Status Will Be Get from db Dynamically -->
                    <h6 class="mt-4">Unit</h6>
                    <input type="text" class="form-control" name="vaccine-unit" value='<?=$loggedInUnit?>' readonly>
                    <h6 class="mt-4">Updating to:</h6>
                    <select class="form-select" name="vaccine-report_for" required>
                        <option value="" selected disabled hidden>Choose here</option>
                        <option value="Not Vaccinated At All">Not Vaccinated At All</option>
                        <option value="1st Dose">1st Dose</option>
                        <option value="2nd Dose">2nd Dose</option>
                        <option value="3rd Dose (Booster)">3rd Dose (Booster)</option>
                    </select>
                    <p>(Your Current Vaccine Status: <?=$Resident->getVaccineStatus()?>)</p>
                    <h6 class="mt-4">Image Evidence</h6>
                    <input class="form-control form-control-sm" type="file" name="vaccine-evidence" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn_mygreen" id="submit" name="vaccine_report_btn" value="Report">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Vaccine Report Modal -->

    <!-- Thank you Pop-up Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="thankyouModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-flex flex-column align-items-center">
                    <div class="mx-auto">
                        <img src="https://cdn.dribbble.com/users/251873/screenshots/9289747/13540-sign-for-success-alert.gif"
                            alt="success-image" width="200">
                    </div>
                    <div class="alert" role="alert">
                        Thank you for reporting yourself!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_mygreen"
                        data-bs-dismiss="modal" onClick="window.location.reload();">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Thank you Pop-up Modal-->

    <!-- JS File with functions -->
    <script src="assets/js/covid.js"></script>

    <!-- Script to connect JS and PHP functions -->
    <script>
        //Prevent Option to choose current Covid or Vaccine status
        var covid_status = <?php echo json_encode($Resident->getCovidStatus()); ?>;
        var vaccine_status = <?php echo json_encode($Resident->getVaccineStatus()); ?>;
        $("option").each(function(){
            if ($(this).val().toLowerCase() == covid_status.toLowerCase() || $(this).val().toLowerCase() == vaccine_status.toLowerCase()) {
                $(this).attr("disabled", "disabled").siblings().removeAttr("disabled");
            }
        });

        // Create yesterday data
        var covid_report = <?php echo json_encode(getCurrentReport()); ?>;
        //Daily Chart
        currentCases(covid_report);

        // Create weekly data
        var week_arr = <?php echo json_encode(createWeekArray()); ?>;
        var weekly_report = <?php echo json_encode(getWeeklyReport()); ?>;
        // Weekly Graph
        weeklyCases(week_arr, weekly_report);

        // Create Monthly Data
        var month_arr = <?php echo json_encode(createMonthArray()); ?>;
        var monthlyReport = <?php echo json_encode(getMonthlyReport()); ?>;
        // Monthly Cases
        monthlyCases(month_arr, monthlyReport);
    </script>
<?php include 'includes/footer.php';?>

