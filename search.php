
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
        $dbconn = new mysqli("localhost", "root", "", "travel.me", 3306) or die("Could not connect: " . mysqli_connect_error());
        $placename = ucfirst($_POST["place"]);
        $place = '%' . $placename . '%';
        $quantity = $_POST["quantity"];
        $stmt = $dbconn->prepare("SELECT travel_id, travel FROM itinerary WHERE travel LIKE ? AND days = ?");
        $stmt->bind_param("ss", $place, $quantity);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            echo '<h2 class="text-center text-primary fw-bold fs-1 py-3">' . $placename . ' results: </h2>';
            

            foreach ($result as $record) {
                //$id = $record['travel_id'];
                $travel = json_decode($record['travel']);
                $variabile = 1;
                echo '<div class="container py-3">';
                echo '<ul class="list-group">';
                foreach ($travel as $daytravel) {
                    echo '<li class="list-group-item text-center text-primary fw-bold"> Day '. $variabile .'</li>';
                    foreach ($daytravel as $placetravel) {
                        echo '<li class="list-group-item">'. $placetravel .'</li>';
                    }
                    $variabile += 1;
                }
                echo '</ul>';
                echo '</div>';   
            }

            
        } else {
            echo "Nessun risultato trovato.";
        }
        $dbconn->close();
    }
?>

        <?php include_once "assets/footer.html" ?>
    
    </body>
</html>
