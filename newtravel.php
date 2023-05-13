<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
        $email = $_SESSION["email"];
        $travel = $_POST["saveitinerary"];
        $days = $_POST["daysitinerary"];
        $stmt = $dbconn->prepare("INSERT INTO itinerary (user_id, travel, days) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $travel, $days);
        $stmt->execute();
        $stmt->close();
        header("Location: myarea.php");
        $dbconn->close();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - MyArea</title>
</head>

<body onload="createMap()">
    <?php include_once "assets/navbar.php" ?>

    <!-- Content section-->
    <section class="container py-5">
        <div class="row">
            <div class="col-sm-4 text-center">
                <label class="display-5 fw-bolder py-5">Your Itinerary</label>
                <div class="row">
                    <form class="mx-1" role="search">
                        <label class="">Add or remove Days</label>
                        <button onclick="addItineraryDays(-1)" class="btn-secondary btn-block btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                        <button onclick="addItineraryDays(1)" class="btn-secondary btn-block btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                    </form>
                </div>
                <div class="add-day">
                </div>
            </div>
            <div class="col-sm-4 text-center ">
                <label class="display-5 fw-bolder py-5">Search a new place</label>
                <div class="container py-3">
                    <div class="input-group">
                        <input type="search" onchange="findPlace()" class="form-control rounded" placeholder="Enter a place" aria-label="Search" aria-describedby="search-addon" id="search-place" />
                        <button type="button" onclick="findPlace()" class="btn-primary btn mx-1">Search</button>
                    </div>
                </div>
                <div class="container">
                    <ul class="list-group list-result">
                    </ul>

                </div>

            </div>
            <div class="col-sm-4 text-center">
                <label class="display-5 fw-bolder py-5">Place map</label>
                <div id="map"></div>
                <label class="display-5 fw-bolder pt-5 pb-2">Completed your itinerary?</label>
                <form action="newtravel.php" method="POST" onsubmit="return checksubmit()">
                    <input type="hidden" name="saveitinerary" id="saveitinerary"/>
                    <input type="hidden" name="daysitinerary" id="daysitinerary"/>
                    <button type="submit" class="btn-primary btn mx-1">Submit</button>
                </form>
            </div>
        </div>
        
    </section>

    <?php include_once "assets/footer.html" ?>
</body>

</html>