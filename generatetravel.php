
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/head.html" ?>
        <title>Travel.me</title>
    </head>
    
    <body>
        <?php include_once "assets/navbar.php" ?>

        <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $placename = ucfirst($_POST["place"]);
        $quantity = $_POST["quantity"];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://ai-trip-planner.p.rapidapi.com/?days='.$quantity.'&destination='.$placename.'',
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
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo '<div class="container py-3">';
            echo '<ul class="list-group">';
            foreach ($response as $days) {
                echo 'gettype($response)';
                echo '<li class="list-group-item text-center text-primary fw-bold"> Day '. $days .'</li>';
                foreach ($days as $activity) {
                    echo '<li class="list-group-item">'. $activity .'</li>';
                }
            }
            echo '</ul>';
            echo '</div>';  
        }
    }
    ?>

        <?php include_once "assets/footer.html" ?>
    
    </body>
</html>
