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

<body onload="uploadItinerary()">
    <?php include_once "assets/navbar.php" ?>

    <!-- Content section-->
    <section class="p-2 g-2 ">
        <div class="container mb-6  pb-4">
            <div class="row rounded g-5">
                <h1 class="text-center display-1 fw-bolder py-5"> Make your own itinerary with us! </h1>
                <div class="col container-lg text-center rounded bg-light">
                    <div class="row text-center rounded bg-light">
                        <h1 class="py-2 bg-dark rounded text-white">Your Itinerary</h1>
                        <div class="row gy-2 pb-4">
                            <form class="row" action="newtravel.php" id="itineraryForm" method="POST" onsubmit="return checksubmit()">
                                <div class="col">
                                    <label>
                                        <h5>Click to add or remove days</h5>
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

    <script>
        function uploadItinerary() {
            var travel_id = localStorage.getItem("travel_id");
            var travel = "";
            createMap();

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    travel = JSON.parse(this.responseText);
                    travel = JSON.parse(travel["travel"]);
                    for (var i = 0; i < travel.length; i++) {
                        addItineraryDays(1);
                        for (var j = 0; j < travel[i].length; j++) {
                            loadPlaceToDay(travel[i][j], i + 1);
                        }
                    }
                }
            };
            xhttp.open("GET", "itinerarydownload.php?travel_id=" + travel_id, true);
            xhttp.send();
        }
    </script>

    <script>
        window.addEventListener('beforeunload', function(event) { //Se provo ad uscire dalla pagina
            if (!formSubmitted) {
                event.returnValue = 'Sei sicuro di voler lasciare la pagina? Tutti i dati non salvati andranno persi.';
            }
        });

        var form = document.getElementById('itineraryForm');
        var formSubmitted = false;

        form.addEventListener('submit', function() {
            formSubmitted = true;
        });

        window.addEventListener('unload', function() { // se esco dalla pagina pulisco local storage
            localStorage.clear();
        });
    </script>



</body>

</html>