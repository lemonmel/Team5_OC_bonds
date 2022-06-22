<?php 
$pageTitle = "Dashboard";
include 'includes/header.php';?>

    <div class="col p-0 m-0">
        <div class="col-12 col-lg-8 mycontainer mx-auto">
            <h2>Hi 
                <span> <?php echo $Resident->getName() ?></span> 
            , Welcome to Bonds App </h2>
            <p class="text-muted m-0">Get in touch with us!</p>
        </div>
        
        <h1 class="mt-4 text-center">Admin Announcements:</h1>
        <!-- New Announcement Container -->
        <div class="col-12 col-lg-8 mt-4 mx-auto">
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

<?php include 'includes/footer.php';?>
                    
