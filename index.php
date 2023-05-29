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
      <h1 class="text-white display-1 ft-1 fw-bolder ">Travel.me</h1>
      <p class="text-white-50 display-6 mb-2">Follow in our footsteps </p>
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
  <h2 class="text-center display-4 text-primary fw-bold  py-5">Our best travel destinations</h2>
  <section class=" pb-5">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="container-fluid container-itinerario bg-opacity-25" style="background-image: url('https://www.visitbritain.com/sites/default/files/consumer/paragraphs-bundles/image-banner/vb34141642-london-bond-ri_0.jpg');">
          <div class="row text-bg-primary text-white rounded pb-4 ">
            <div class="bg-gradient fw-bold display-4 bg-dark rounded text-white">London</div>
            <div class="row d-flex rounded">
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 1</label>
                <ul class="list-group">
                  <li class="list-group-item">Buckingham Palace</li>
                  <li class="list-group-item">The Tower Bridge</li>
                  <li class="list-group-item">Westminster Abbey</td>
                  <li class="list-group-item ">The British Museum</li>
                  <li class="list-group-item">Tate Modern</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 2</label>
                <ul class="list-group">
                  <li class="list-group-item">Houses of Parliament and Big Ben</li>
                  <li class="list-group-item">Covent Garden</li>
                  <li class="list-group-item">Borough Market</li>
                  <li class="list-group-item">The British Library</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 3</label>
                <ul class="list-group">
                  <li class="list-group-item">St. Paul's Cathedral</li>
                  <li class="list-group-item">Shakespeare's Globe Theatre</li>
                  <li class="list-group-item">Hyde Park</li>
                  <li class="list-group-item">The Shard</li>
                  <li class="list-group-item">West End Theatre District</li>
                  <li class="list-group-item">Tower of London</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </li>

      <li class="list-group-item">
        <div class="container-fluid container-itinerario bg-opacity-25" style="background-image: url('https://www.spagna.info/wp-content/uploads/sites/39/barcellona.jpg');">
          <div class="row text-bg-primary text-white rounded pb-4 ">
            <div class="bg-gradient fw-bold display-4 bg-dark rounded text-white">Barcelona</div>
            <div class="row d-flex rounded">
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 1</label>
                <ul class="list-group">
                  <li class="list-group-item">Sagrada Familia</li>
                  <li class="list-group-item">Casa Batlló</li>
                  <li class="list-group-item">Casa Milà (La Pedrera)</td>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 2</label>
                <ul class="list-group">
                  <li class="list-group-item">Park Güell</li>
                  <li class="list-group-item">Picasso Museum</li>
                  <li class="list-group-item">Park de la Ciutadella</li>
                  <li class="list-group-item">Gothic Quarter</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 3</label>
                <ul class="list-group">
                  <li class="list-group-item">Barceloneta Beach</li>
                  <li class="list-group-item">Camp Nou</li>
                  <li class="list-group-item">La Boqueria Market</li>
                  <li class="list-group-item">Poble Espanyol</li>
                  <li class="list-group-item">El Born</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 4</label>
                <ul class="list-group">
                  <li class="list-group-item">Montjuïc Hill</li>
                  <li class="list-group-item">Magic Fountain of Montjuïc</li>
                  <li class="list-group-item">Tibidabo</li>
                </ul>
              </div>
            </div>
          </div>
        </div>


      <li class="list-group-item">
        <div class="container-fluid container-itinerario bg-opacity-25" style="background-image: url('https://www.franciaturismo.net/wp-content/uploads/sites/4/parigi-hd.jpg');">
          <div class="row text-bg-primary text-white rounded pb-4 ">
            <div class="bg-gradient fw-bold display-4 bg-dark rounded text-white">Paris</div>
            <div class="row d-flex rounded">
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 1</label>
                <ul class="list-group">
                  <li class="list-group-item">Eiffel Tower</li>
                  <li class="list-group-item">Palace of Versailles</li>
                  <li class="list-group-item">Musée de l'Orangerie</td>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 2</label>
                <ul class="list-group">
                  <li class="list-group-item">Louvre Museum</li>
                  <li class="list-group-item">Musée d'Orsay</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 3</label>
                <ul class="list-group">
                  <li class="list-group-item">Saint-Germain-des-Prés</li>
                  <li class="list-group-item">Notre-Dame Cathedral</li>
                  <li class="list-group-item">Champs-Élysées</li>
                  <li class="list-group-item">Catacombs of Paris</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 4</label>
                <ul class="list-group">
                  <li class="list-group-item">Montmartre</li>
                  <li class="list-group-item">Sainte-Chapelle</li>
                  <li class="list-group-item">Père Lachaise Cemetery</li>
                </ul>
              </div>
              <div class="col">
                <label class="display-6 fw-bolder py-3">Day 5</label>
                <ul class="list-group">
                  <li class="list-group-item">Seine River Cruise</li>
                  <li class="list-group-item">Luxembourg Gardens</li>
                  <li class="list-group-item">Moulin Rouge</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </ul>


  </section>
  <?php include_once "assets/footer.html" ?>

</body>

</html>