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
    echo $response;
}
?>