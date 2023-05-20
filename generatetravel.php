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
                    <?php
                    session_start();
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $placename = ucfirst($_POST["place"]);
                        $quantity = $_POST["quantity"];
                        $curl = curl_init();

                        /*curl_setopt_array($curl, [
                            CURLOPT_URL => 'https://ai-trip-planner.p.rapidapi.com/?days=' . $quantity . '&destination=' . $placename . '',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => [
                                "X-RapidAPI-Host: ai-trip-planner.p.rapidapi.com",
                                "X-RapidAPI-Key: e37c15540cmsha3c72df1d15c5e7p12357ejsn27500c2593d7"
                            ],
                        ]);

                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        */

                        $err = "";
                        $response = '{"_id": "64690c22a2ede0dd399c8cc8","plan": [{"day": 1,"activities": [{"time": "9:00 AM","description": "Arrive in Rome and check-in to hotel"},{"time": "11:00 AM","description": "Visit the Vatican Museums"},{"time": "2:00 PM","description": "Explore St Peters Basilica"},{"time": "4:00 PM","description": "Tour the Colosseum"},{"time": "7:00 PM","description": "Dine at a local restaurant"}]},{"day": 2,"activities": [{"time": "9:00 AM","description": "Visit the Roman Forum"},{"time": "12:00 PM","description": "Explore the Pantheon"},{"time": "3:00 PM","description": "Walk around Piazza Navona"},{"time": "6:00 PM","description": "Visit the Trevi Fountain"},{"time": "9:00 PM","description": "Experience Romes nightlife"}]},{"day": 3,"activities": [{"time": "10:00 AM","description": "Take a day trip to Pompeii"},{"time": "3:00 PM","description": "Return to Rome and explore Trastevere neighborhood"},{"time": "6:00 PM","description": "Visit the Spanish Steps"},{"time": "8:00 PM","description": "Enjoy a final dinner in Rome"}]}],"key": "3-rome"}';
                        $response = json_decode($response);

                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            echo '<div class="container py-3">';
                            echo '<ul class="list-group">';
                            foreach ($response->plan as $days) {
                                echo '<script type="text/javascript">addItineraryDays(1);</script>';
                                foreach ($days->activities as $activity) {
                                    #echo '<li class="list-group-item">' . $activity->description . '</li>';
                                }
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                    }
                    ?>
                    
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