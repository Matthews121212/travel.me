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
        echo '<h2 class="text-center text-primary fw-bold fs-1 py-3">' . $placename . ' Database results: </h2>';
        if ($result->num_rows > 0) { //DB ITINERARY
            foreach ($result as $record) {
                $travel = json_decode($record['travel']);

                echo '<h3 class="text-center">Travel by ' . $record['user_id'];
                if ($authenticated)
                    echo '<button onclick="loadItinerary(' . $record['travel_id'] . ')" class="btn-secondary btn mx-1" type="button"> Load and edit <i class="bi bi-pencil-square"></i></button></h3>';
                else
                    echo '<button onclick="alertlogin()" class="btn-secondary btn mx-1" type="button" > Load and edit <i class="bi bi-pencil-square"></i></button></h3>';
                echo '</tbody></table></div>';

                $variabile = 1;
                echo '<hr class="hr" />';
                echo '<div class="row mx-5 d-flex justify-content-center py-3 ">';
                echo '<h3 class="text-center"></h3>';
                echo '<table class="table table-striped table-responsive. align-middle">';
                echo '<thead> <tr>';
                foreach ($travel as $daytravel) {
                    echo '<th>Day ' . $variabile . '</th>';
                    $variabile += 1;
                }

                echo '</tr></thead><tbody>';

                $numColumns = count($travel);

                for ($i = 0; $i < $numColumns; $i++) {
                    echo '<tr>';
                    foreach ($travel as $daytravel) {
                        if ($daytravel[$i] ?? null) {
                            $placetravel = $daytravel[$i];
                            echo '<td>' . explode("&", $placetravel)[0] . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                    }
                    echo '</tr>';
                }

                echo '</tbody></table></div>';
            }
        } else {
            echo '<h3 class="text-center">No results found.</h3>';
        }
        $dbconn->close();
        //AI GENERATE ITINERARY
        echo '<h2 class="text-center text-primary fw-bold fs-1 py-3">' . $placename . ' AI results: </h2>';
        echo '<hr class="hr" />';
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
        $resultai = json_decode($response);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo '<div class="container py-3">';
            echo '<ul class="list-group">';
            foreach ($resultai->plan as $days) {
                echo '<div class="row py-3 add-day-' . $days->day . '"><label class="ft-2 fw-bolder py-3">Day ' . $days->day . '</label><div class="container"><ul class="list-group item-day-' . $days->day . '"></ul></div></div>';
                foreach ($days->activities as $activity) {
                    echo '<li class="list-group-item">' . $activity->description . '</li>';
                }
            }
            echo '</ul>';
            echo '</div>';
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