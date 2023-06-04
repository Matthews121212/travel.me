<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me</title>
</head>

<body>
    <?php include_once "assets/navbar.php" ?>

    <?php
    $itinerary = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
        $placename = ucwords($_POST["place"]);
        $place = '%' . $placename . '%';
        $quantity = $_POST["quantity"];
        $stmt = $dbconn->prepare("SELECT user_id, travel_id, travel FROM itinerary WHERE travel LIKE ? AND days = ?");
        $stmt->bind_param("ss", $place, $quantity);
        $stmt->execute();
        $result = $stmt->get_result();
        echo '<h2 class="display-4 text-center text-primary fw-bold py-3">' . $placename . ' Database results: </h2>';
        if ($result->num_rows > 0) { //DB ITINERARY
            foreach ($result as $record) {
                $travel = json_decode($record['travel']);
                echo '<div class="container  ">';
                echo '<div class="row py-2 bg-dark rounded text-white ">';
                echo '<h3 class="text-center">Travel by ' . $record['user_id'];
                if ($authenticated)
                    echo '<button onclick="loadItinerary(' . $record['travel_id'] . ')" class="btn-secondary btn mx-1 " type="button"> Load and edit <i class="bi bi-pencil-square"></i></button></h3>';
                else
                    echo '<button onclick="alertlogin()" class="btn-secondary btn mx-1" type="button" > Load and edit <i class="bi bi-pencil-square"></i></button></h3>';

                $variabile = 1;

                echo '</div><div class="row d-flex rounded bg-dark bg-opacity-10 pb-4">';
                foreach ($travel as $daytravel) {
                    echo '<div class="col">';
                    echo '<label class="ft-2 fw-bolder py-3">Day ' . $variabile . '</label><ul class="list-group">';
                    foreach ($daytravel as $placetravel) {
                        echo '<li class="list-group-item">' . explode("&", $placetravel)[0] . '</li>';
                    }
                    echo '</ul></div>';
                    $variabile += 1;
                }
                echo '</div></div></div>';
                echo '<hr class="hr" />';
            }
        } else {
            echo '<h3 class="text-center">No results found.</h3>';
        }
        $dbconn->close();
        //AI GENERATE ITINERARY
        echo '<h2 class="display-4 text-center text-primary fw-bold py-3">' . $placename . ' AI results: </h2>';

        $curl = curl_init();
        curl_setopt_array($curl, [
                            CURLOPT_URL => 'https://ai-trip-planner.p.rapidapi.com/?days=' . $quantity . '&destination=' . urlencode($placename) . '',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => [
                                "X-RapidAPI-Host: ai-trip-planner.p.rapidapi.com",
                                "X-RapidAPI-Key: "
                            ],
                        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $resultai = json_decode($response);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo '<div class="container mb-4">';
            echo '<div class="row py-2 bg-dark rounded text-white">';
            echo '<h3 class="text-center">Travel by IA Trip Planner';
            echo '</div>';
            echo '<div class="row">';
            echo '</div><div class="row d-flex rounded bg-dark bg-opacity-10 pb-4">';
            foreach ($resultai->plan as $days) {
                echo '<div class="col">';
                echo '<label class="ft-2 fw-bolder py-3">Day ' . $days->day . '</label><ul class="list-group">';
                foreach ($days->activities as $activity) {
                    echo '<li class="list-group-item">' . $activity->description . '</li>';
                }
                echo '</ul></div>';
            }
            echo '</div></div></div>';
        }
    }
    ?>


    <script>
        function loadItinerary(travel_id) {
            localStorage.setItem("travel_id", travel_id);
            window.open("newtravel.php");
        }

        function alertlogin() {
            alert("Please login to user this funtion")
            window.open("login.php");
        }
    </script>

    <?php include_once "assets/footer.html" ?>

</body>

</html>
