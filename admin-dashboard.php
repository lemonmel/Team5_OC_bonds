<?php 
$pageTitle = "Dashboard";
include 'includes/admin-header.php';
?>
                 <div class="row p-0">
                        <div class="col-md-6 col-lg-4 mt-4 mt-lg-0">
                            <div class="mycontainer">
                                <div class="d-flex align-items-center py-auto">
                                    <i class="bi bi-people-fill fs-2 text-primary"></i>
                                    <h2 class="ms-2">
                                        <?php
                                        $data_query = mysqli_query($con, "SELECT * FROM resident");
                                        $resident_num = mysqli_num_rows($data_query);
                                        ?>
                                        <?= $resident_num ?>
                                    </h2>
                                </div>
                                <h5>Total Residents</h5>
                                <a href="admin-manageuser.php" class="btn btn-primary">Manage Resident</a>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mt-4 mt-lg-0 ">
                            <div class="mycontainer">
                                <div class="d-flex align-items-center py-auto">
                                    <i class="bi bi-shield-fill-plus fs-2 text-primary"></i>
                                    <h2 class="ms-2">
                                        <?php
                                        $data_query = mysqli_query($con, "SELECT * FROM `resident` WHERE covid_status = 'Positive'");
                                        $covid_num = mysqli_num_rows($data_query);
                                        ?>
                                        <?= $covid_num ?>
                                    </h2>
                                </div>
                                <h5>Active Cases</h5>
                                <a href="admin-managecovid.php" class="btn btn-primary">Manage Covid</a>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mt-4 mt-lg-0 ">
                            <div class="mycontainer">
                                <div class="d-flex align-items-center py-auto">
                                    <i class="bi bi-person-badge-fill fs-2 text-primary"></i>
                                    <h2 class="ms-2">
                                        <?php
                                            $today = date('Y-m-d H:i:s', mktime(0,0,0));
                                            $data_query = mysqli_query($con, "SELECT * FROM visitorpass WHERE start_time >'$today'");
                                            $visitor_num = mysqli_num_rows($data_query);
                                        ?>
                                        <?= $visitor_num ?>
                                    </h2>
                                </div>
                                <h5>Upcoming Visitors</h5>
                                <a href="admin-manageuser.php#VisitorTable" class="btn btn-primary">Manage Visitor</a>
                            </div>
                        </div>
                </div>

                        <!-- Post Announcement -->
                        <div class="row p-0">

                            <div class="col-12 mx-lg-auto mt-4">
                                <!-- announcement submit form -->
                                <div class="mycontainer">
                                    <h2>Post A New Announcement</h2>
                                    <form id="announcement" method="POST" action="admin-dashboard.php">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Title" name="announcement-title" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" placeholder="Your Announcement Content Here" name="announcement-content" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="announcement_btn">Post</button>
                                    </form>
                                </div>

                                <?php
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
                                            $_POST = array();
                                        }
                                        // Method To Submit Announcement
                                        if(isset($_POST['announcement_btn'])){
                                            $title = $_POST['announcement-title'];
                                            $content = $_POST['announcement-content'];
                                            $time = date("Y-m-d h:i:s");

                                            $query_run = mysqli_query($con, "INSERT INTO announcement (title, description, date_time) VALUES ('$title','$content','$time')");

                                            if($query_run) { 
                                                echoToast("New announcement posted.");
                                            }else{ 
                                                echoToast("Post failed. Please try again.");
                                            }
                                        }

                                ?>
    
                                <!-- Announcement Container -->
                                <div id="announcement_container">
                                <?php
                                    $data_query = mysqli_query($con, "SELECT * FROM announcement ORDER BY date_time DESC");

                                    if(mysqli_num_rows($data_query) > 0)
                                    {
                                        foreach($data_query as $announcement)
                                        {
                                            $formattedDate = $announcement['date_time'];
                                ?>
                                        <div class="card mt-4 mycontainer">
                                            <div class="card-body">
                                                <h5><?=$announcement['title']?></h5>
                                                <span class="text-muted ms-auto"><?=$formattedDate?></span>
                                                <p class="card-text mt-3" style="white-space: pre-line"><?=$announcement['description']?></p>
                                            </div>
                                        </div>  
                                <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        <!-- Modal End -->

                        <!-- (Included In This file Only)Manage Covid JS -->

<?php include 'includes/admin-footer.php';?>

                        

                        
