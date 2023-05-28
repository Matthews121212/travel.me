<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/head.html" ?>
        <title>Travel.me</title>
    </head>
    
    <body>
        <?php include_once "assets/navbar.php" ?>
        
        <header class="py-5 bg-image-full header">
            <div class="text-center my-5">
                <!--<img class="img-fluid rounded-circle mb-4" src="https://dummyimage.com/150x150/6c757d/dee2e6.jpg" alt="..." />-->
                <h1 class="text-white ft-1 fw-bolder">Travel.me</h1>
                <p class="text-white-50 mb-2">Follow in our footsteps </p>
            </div>

            <!-- Search bar-->
            <div class="text-center my-2 justify-content-center text-white">
                    <div class="container">
                        <form class="d-inline-flex mx-1" role="search" action="search.php" id="myForm" method="POST">
                            <input class="form-control me-2" style="flex: 6;" type="search" id="place" name="place" placeholder="Choose destination and days of itinerary" aria-label="Search" required>
                            <button onclick="addDays(-1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                            <input type="text" style="flex: 1;" value="1" id="quantity" name="quantity" class="form-control mx-1" readonly="readonly" required>
                            <button onclick="addDays(1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                            <button class="btn-primary btn mx-1" type="submit">Search</button>
                        </form>
                    </div>
            </div>
        </header>

        <!-- Content section-->
        <h2 class="text-center text-primary fw-bold fs-1 py-5">Our best travel destinations</h2>
        <section class=" pb-5">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="container-fluid container-itinerario " style="background-image: url('https://www.visitbritain.com/sites/default/files/consumer/paragraphs-bundles/image-banner/vb34141642-london-bond-ri_0.jpg');">  
                        <div class="row text-bg-primary text-white">
                            <div class="bg-gradient fw-bold fs-1">London</div>
                            <table class="table text-white">
                                <thead>
                                  <tr>
                                    <th scope="col">Day 1</th>
                                    <th scope="col">Day 2</th>
                                    <th scope="col">Day 3</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Buckingham Palace</td>
                                    <td>The Tower Bridge</td>
                                    <td>Westminster Abbey</td>
                                  </tr>
                                  <tr>
                                    <td>The British Museum</td>
                                    <td>Tate Modern</td>
                                    <td>Houses of Parliament and Big Ben</td>
                                  </tr>
                                  <tr>
                                    <td>Covent Garden</td>
                                    <td>Borough Market</td>
                                    <td>The British Library</td>
                                  </tr>
                                  <tr>
                                    <td>St. Paul's Cathedral</td>
                                    <td>Shakespeare's Globe Theatre</td>
                                    <td>Hyde Park</td>
                                  </tr>
                                  <tr>
                                    <td>Tower of London</td>
                                    <td>The Shard</td>
                                    <td>West End Theatre District</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="container-fluid container-itinerario " style="background-image: url('https://www.spagna.info/wp-content/uploads/sites/39/barcellona.jpg');">  
                        <div class="row text-bg-primary text-white">
                            <div class="bg-gradient fw-bold fs-1">Barcelona</div>
                            <table class="table text-white">
                                <thead>
                                  <tr>
                                    <th scope="col">Day 1</th>
                                    <th scope="col">Day 2</th>
                                    <th scope="col">Day 3</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Sagrada Familia</td>
                                    <td>Casa Batlló</td>
                                    <td>Casa Milà (La Pedrera)</td>
                                  </tr>
                                  <tr>
                                    <td>Park Güell</td>
                                    <td>Picasso Museum</td>
                                    <td>Park de la Ciutadella</td>
                                  </tr>
                                  <tr>
                                    <td>Gothic Quarter</td>
                                    <td>Barceloneta Beach</td>
                                    <td>Camp Nou</td>
                                  </tr>
                                  <tr>
                                    <td>La Boqueria Market</td>
                                    <td>Poble Espanyol</td>
                                    <td>El Born</td>
                                  </tr>
                                  <tr>
                                    <td>Montjuïc Hill</td>
                                    <td>Magic Fountain of Montjuïc</td>
                                    <td>Tibidabo</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="container-fluid container-itinerario " style="background-image: url('https://www.franciaturismo.net/wp-content/uploads/sites/4/parigi-hd.jpg');">  
                        <div class="row text-bg-primary text-white">
                            <div class="bg-gradient fw-bold fs-1">Paris</div>
                            <table class="table table-responsive. align-middle text-white">
                                <thead>
                                  <tr>
                                    <th scope="col">Day 1</th>
                                    <th scope="col">Day 2</th>
                                    <th scope="col">Day 3</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Eiffel Tower</td>
                                    <td>Palace of Versailles</td>
                                    <td>Musée de l'Orangerie</td>
                                  </tr>
                                  <tr>
                                    <td>Louvre Museum</td>
                                    <td>Musée d'Orsay</td>
                                    <td>Saint-Germain-des-Prés</td>
                                  </tr>
                                  <tr>
                                    <td>Notre-Dame Cathedral</td>
                                    <td>Champs-Élysées</td>
                                    <td>Catacombs of Paris</td>
                                  </tr>
                                  <tr>
                                    <td>Montmartre</td>
                                    <td>Sainte-Chapelle</td>
                                    <td>Père Lachaise Cemetery</td>
                                  </tr>
                                  <tr>
                                    <td>Seine River Cruise</td>
                                    <td>Luxembourg Gardens</td>
                                    <td>Moulin Rouge</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </li>
            </ul>
        

        </section>
        <?php include_once "assets/footer.html" ?>
    
      </body>
</html>
