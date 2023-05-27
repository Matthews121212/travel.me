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
    <section class="p-2 g-2">
        <div class="row rounded g-5">
            <h1 class="text-center fw-bolder py-5"> Make your own itinrary with us! </h1>
            <div class="col container-lg text-center rounded bg-light">
                <div class="row text-center rounded bg-light">
                    <h1 class="py-2 bg-dark rounded text-white">Your Itinerary</h1>
                    <div class="row gy-2">
                        <form class="row" action="newtravel.php" method="POST" onsubmit="return checksubmit()">
                            <div class="col">
                                <label>
                                    <h5>Add or remove Days</h5>
                                </label>
                                <button onclick="addItineraryDays(-1)" class="btn-secondary btn-block btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                                <button onclick="addItineraryDays(1)" class="btn-secondary btn-block btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                            </div>
                            <div class="col">
                                <label>
                                    <h5>Completed your itinerary?</h5>
                                </label>
                                <input type="hidden" name="saveitinerary" id="saveitinerary" />
                                <input type="hidden" name="daysitinerary" id="daysitinerary" />
                                <button type="submit" class="btn-secondary btn mx-1">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="add-day">
                    </div>
                </div>
            </div>

            <div class="col container-lg rounded g-5 m-0">
                <div class="row text-center rounded bg-light ">
                    <h1 class="py-2 bg-dark rounded text-white ">Search a new place</h1>
                    <div class="container text-center rounded bg-light ">
                        <h1 class="fw-bolder py-2">Place map</h1>
                        <div id="map"></div>
                    </div>
                    <div class="container py-3">
                        <div class="input-group">
                            <input type="search" onchange="findPlace()" class="form-control rounded" placeholder="Enter a place" aria-label="Search" aria-describedby="search-addon" id="search-place" />
                            <button type="button" onclick="findPlace()" class="btn-primary btn mx-1">Search</button>
                        </div>

                    </div>
                    <div class="container">
                        <form class="form-horizontal">
                            <ul class="list-group list-result align-middle">
                            </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>


    </section>

    <?php include_once "assets/footer.html" ?>
</body>

</html>