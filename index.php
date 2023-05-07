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
                        <form class="d-inline-flex mx-1" role="search">
                            <input class="form-control me-2" style="flex: 6;" type="search" placeholder="Choose destination and days of itinerary" aria-label="Search" required>
                            <button onclick="addDays(-1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                            <input type="text" pattern="[0-9]+" style="flex: 1;" value="1" placeholder="Days" id="quantity" name="quantity" class="form-control mx-1"  disabled required>
                            <button onclick="addDays(1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                            <button class="btn-primary btn mx-1 "  type="submit">Search</button>
                            <button class="btn-primary btn mx-1"  type="submit">Find</button>
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
                                    <td>Big Ben and Westminster</td>
                                    <td>Big Ben and Westminster</td>
                                    <td>Big Ben and Westminster</td>
                                  </tr>
                                  <tr>
                                    <td>Westminster Abbey</td>
                                    <td>Westminster Abbey</td>
                                    <td>Westminster Abbey</td>
                                  </tr>
                                  <tr>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                  </tr>
                                  <tr>
                                    <td>Trafalgar Square</td>
                                    <td>Trafalgar Square</td>
                                    <td>Trafalgar Square</td>
                                  </tr>
                                  <tr>
                                    <td>British Museum o National Gallery</td>
                                    <td>British Museum o National Gallery</td>
                                    <td>British Museum o National Gallery</td>
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
                                    <td>Big Ben and Westminster</td>
                                    <td>Big Ben and Westminster</td>
                                    <td>Big Ben and Westminster</td>
                                  </tr>
                                  <tr>
                                    <td>Westminster Abbey</td>
                                    <td>Westminster Abbey</td>
                                    <td>Westminster Abbey</td>
                                  </tr>
                                  <tr>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                  </tr>
                                  <tr>
                                    <td>Trafalgar Square</td>
                                    <td>Trafalgar Square</td>
                                    <td>Trafalgar Square</td>
                                  </tr>
                                  <tr>
                                    <td>British Museum o National Gallery</td>
                                    <td>British Museum o National Gallery</td>
                                    <td>British Museum o National Gallery</td>
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
                                    <td>Big Ben and Westminster</td>
                                    <td>Big Ben and Westminster</td>
                                    <td>Big Ben and Westminster</td>
                                  </tr>
                                  <tr>
                                    <td>Westminster Abbey</td>
                                    <td>Westminster Abbey</td>
                                    <td>Westminster Abbey</td>
                                  </tr>
                                  <tr>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                    <td>Buckingham Palace e Cambio della Guardia</td>
                                  </tr>
                                  <tr>
                                    <td>Trafalgar Square</td>
                                    <td>Trafalgar Square</td>
                                    <td>Trafalgar Square</td>
                                  </tr>
                                  <tr>
                                    <td>British Museum o National Gallery</td>
                                    <td>British Museum o National Gallery</td>
                                    <td>British Museum o National Gallery</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </li>
            </ul>
        

        <div id="ww_f03b78024e4c" v='1.3' loc='id' a='{"t":"responsive","lang":"en","sl_lpl":1,"ids":["wl4529"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"#000000","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722","cl_odd":"#FFFFFF17"}'>Weather Data Source: <a href="https://oneweather.org/paris/" id="ww_f03b78024e4c_u" target="_blank">Weather Paris tomorrow hourly</a></div><script async src="https://app1.weatherwidget.org/js/?id=ww_f03b78024e4c"></script>
        </section>
        <?php include_once "assets/footer.html" ?>
    
      </body>
</html>
