<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageTitle = "Explore";
include 'includes/header.php'; 
?>

<!-- This style is too add to cards to hide unrelated cards to the search result-->
<style>
    .is-hidden { display: none; }
</style>

<?php
//building "outside condo" cards
function buildOutside($type){
    $objects = mysqli_query(connection(), "SELECT * FROM shop WHERE type = '$type'");
    $check_objects = mysqli_num_rows($objects) > 0;
    $i = 1;
    if ($check_objects) {
        while ($row = mysqli_fetch_array($objects)) {
            $image = $row['image'];
            $name = $row['name'];
            $location = $row['location'];
            $rating = $row['rating'];
            $category = $row['category'];
            $service = $row['service'];
            $address = $row['address'];
            $hours = $row['hours'];
            $reviews = $row['reviews'];
            $phone = $row['phone'];
            echo '
            <!-- Single Card Component -->
            <div class="card col-lg-3 col-md-4 col-sm-6">
                <div class="card-body text-center">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal'.$type.$i.'">
                        <img src='.$image.' class="card-img-top" alt="...">
                        <h5 class="card-title">'.$name.'</h5>
                        <p class="">'.$location.'</p>
                        <p>'.$rating.'</p>
                    </a>
                </div>
            </div>
            <!-- Single Card Component End -->

            <!-- Scrollable modal -->
            <div class="modal fade" id="exampleModal'.$type.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                '.$category.' </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex">
                            <img src='.$image.' alt="">
                            <div class="tab">
                                <br><br><br>
                                <h2><strong>'.$name.'</strong></h2>
                                <p><strong>Service </strong>&nbsp : '.$service.' </p>
                                <span>
                                    <p><strong>Address </strong>&nbsp : <a href="https://www.google.com/maps/search/'.$address.'" target="_blank">'.$address.'</a></p>
                                </span>
                                <p><strong>Hours </strong>&nbsp : '.$hours.' </p>
                                <p><strong>Ratings </strong>&nbsp : '.$reviews.' </p>
                                <p><strong>Phone </strong>&nbsp : '.$phone.' </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $i++;
        }
    } else {
        echo "No Record Found";
    }
}

//building "inside condo" cards
function buildInside($type){
    $objects = mysqli_query(connection(), "SELECT * FROM explore WHERE facility_type = '$type'");
    $check_objects = mysqli_num_rows($objects) > 0;
    $i = 1;
    if ($check_objects) {
        while ($row = mysqli_fetch_array($objects)) {
            $image = $row['image'];
            $name = $row['facility_name'];
            $address = $row['facility_addr'];
            $operating_time = $row['operating_time'];
            $operating_day = $row['operating_day'];
            $status = $row['facility_status'];
            echo '
            <div class="card col-lg-3 col-md-4 col-sm-6">
                <div class="card-body text-center">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal'.$type.$i.'">
                        <img src='.$image.' class="card-img-top" alt="...">
                        <h5 class="card-title">'.$name.'</h5>
                        <p class="">'.$address.'</p>
                    </a>
                </div>
            </div>

            <div class="modal fade" id="exampleModal'.$type.$i.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex">
                            <img src="'.$image.'" alt="">
                            <div class="tab">
                                <br><br><br>
                                <h2><strong>'.$name.'</strong></h2>
                                <p><strong>Address </strong>&nbsp : '.$address.'</p>
                                <p><strong>Operating Hours </strong>&nbsp : '.$operating_time.'</p>
                                <p><strong>Operating Days </strong>&nbsp : '.$operating_day.'</p>
                                <p><strong>Status </strong>&nbsp : '.getBadge($status).'</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $i++;
        }
    } else {
        echo "No Record Found";
    }
}

function getBadge($status){
    switch ($status) {
            //warning
        case "Under Maintenance":
            return "<span class='badge rounded-pill bg-opacity-75 bg-warning'>$status</span>";
            //danger
        case "Closed":
            return "<span class='badge rounded-pill bg-opacity-75 bg-danger'>$status</span>";
            //success
        case "Opened":
            return "<span class='badge rounded-pill bg-opacity-75 bg-success'>$status</span>";
    }
}
?>

<div class="mycontainer">
    <div class="row d-flex align-items-center">
        <ul class="nav nav-tabs d-flex align-items-start" id="exploreTab" role="tablist">
            <li class="w-50" role="presentation">
                <button class="w-100 nav-link active fw-bold" id="outside-tab" data-bs-toggle="tab" data-bs-target="#outside-tab-content" type="button" role="tab" aria-controls="outside-tab-content" aria-selected="true">Explore
                    Outside</button>
            </li>
            <li class="w-50" role="presentation">
                <button class="w-100 nav-link fw-bold" id="inside-tab" data-bs-toggle="tab" data-bs-target="#inside-tab-content" type="button" role="tab" aria-controls="inside-tab-content" aria-selected="false">Explore
                    Inside</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <!-- Outside Tab Start-->
            <div class="tab-pane fade active show" id="outside-tab-content" role="tabpanel" aria-labelledby="outside-tab">
                <!-- Outside Tab Content Here -->
                <div class="col-12">
                    <div class="mt-4">
                        <!-- Navigation Bar -->
                        <div class="container p-0 mt-3">
                            <div class="row">
                                <div class="col-md-2 col-sm-12">
                                    <div class="nav flex-column nav-pills">
                                        <a href="#v-pills-food" data-bs-toggle="pill" class="nav-link active show">Food</a>
                                        <a href="#v-pills-beverages" data-bs-toggle="pill" class="nav-link" >Beverages</a>
                                        <a href="#v-pills-shop" data-bs-toggle="pill" class="nav-link">Shop</a>
                                        <a href="#v-pills-facility" data-bs-toggle="pill" class="nav-link">Facilities</a>
                                        <a href="#v-pills-entertainment" data-bs-toggle="pill" class="nav-link">Entertainment</a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-12">
                                    <div class="tab-content">
                                    <div class="input-group mb-3">
                                        <input type="text" name="searchbox" id="searchbox1" oninput=liveSearch1() class="filterinput form-control" placeholder="Search">
                                    </div>
                                        <!-- Pills Content Start -->
                                        <div id="v-pills-food" class="tab-pane fade active show">
                                            <div class="row explore-page">
                                                <!-- Will Get from DB and Use Loop Later -->
                                                <?php
                                                buildOutside('foods');
                                                ?>
                                            </div>
                                        </div>
                                        <!-- BEVERAGES -->
                                        <div id="v-pills-beverages" class="tab-pane fade">
                                            <div class="row explore-page">
                                                <?php
                                                buildOutside('beverages');
                                                ?>
                                            </div>
                                        </div>
                                        <!-- SHOP -->
                                        <div id="v-pills-shop" class="tab-pane fade">
                                            <div class="row explore-page">
                                                <?php
                                                buildOutside('shop');
                                                ?>
                                            </div>
                                        </div>
                                        <!-- FACILITY -->
                                        <div id="v-pills-facility" class="tab-pane fade">
                                            <div class="row explore-page">
                                                <?php
                                                buildOutside('facility');
                                                ?>
                                            </div>
                                        </div>
                                        <!--ENTERTAINMENT -->
                                        <div id="v-pills-entertainment" class="tab-pane fade">
                                            <div class="row explore-page">
                                                <?php
                                                buildOutside('entertainment');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inside Tab Start-->
            <div class="tab-pane fade" id="inside-tab-content" role="tabpanel" aria-labelledby="inside-tab">
                <!-- Inside Tab Content Here -->
                <div class="col-12">
                    <div class="mt-4">
                        <!-- Navigation Bar -->
                        <div class="container p-0 mt-3">
                            <div class="row">
                                <div class="col-md-2 col-sm-12">
                                    <div class="nav flex-column nav-pills">
                                        <a href="#v-pills-sports" data-bs-toggle="pill" class="nav-link active show">Sports</a>
                                        <a href="#v-pills-leisure" data-bs-toggle="pill" class="nav-link">Leisure</a>
                                        <a href="#v-pills-others" data-bs-toggle="pill" class="nav-link">Others</a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-12">
                                    <div class="tab-content">
                                    <div class="input-group mb-3">
                                        <input type="text" name="searchbox" id="searchbox2" oninput=liveSearch2() class="filterinput form-control" placeholder="Search">
                                    </div>
                                        <!-- SPORTS -->
                                        <div id="v-pills-sports" class="tab-pane fade active show">
                                            <div class="row explore-page">
                                                <?php
                                                buildInside('sports');
                                                ?>
                                            </div>
                                        </div>
                                        <!-- LEISURE -->
                                        <div id="v-pills-leisure" class="tab-pane fade">
                                            <div class="row explore-page">
                                                <?php
                                                buildInside('leisure');
                                                ?>
                                            </div>
                                        </div>
                                        <!-- OTHERS -->
                                        <div id="v-pills-others" class="tab-pane fade">
                                            <div class="row explore-page">
                                                <?php
                                                buildInside('others');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                                        



<script>
//function for searching in different tabs
function liveSearch1() {
  // Locate the card elements
  let cards = document.getElementById("outside-tab-content").querySelectorAll('.card')
  // Locate the search input
  let search_query = document.getElementById("searchbox1").value;
  // Loop through the cards
  for (var i = 0; i < cards.length; i++) {
    // If the text is within the card...
    if(cards[i].innerText.toLowerCase()
      // ...and the text matches the search query...
      .includes(search_query.toLowerCase())) {
        // ...remove the `.is-hidden` class.
        cards[i].classList.remove("is-hidden");
    } else {
      // Otherwise, add the class.
      cards[i].classList.add("is-hidden");
    }
  }
}

function liveSearch2() {
  // Locate the card elements
  let cards = document.getElementById("inside-tab-content").querySelectorAll('.card')
  // Locate the search input
  let search_query = document.getElementById("searchbox2").value;
  // Loop through the cards
  for (var i = 0; i < cards.length; i++) {
    // If the text is within the card...
    if(cards[i].innerText.toLowerCase()
      // ...and the text matches the search query...
      .includes(search_query.toLowerCase())) {
        // ...remove the `.is-hidden` class.
        cards[i].classList.remove("is-hidden");
    } else {
      // Otherwise, add the class.
      cards[i].classList.add("is-hidden");
    }
  }
}
</script>

<?php include 'includes/footer.php'; ?>
