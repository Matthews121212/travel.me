<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - MyArea</title>
</head>

<body>
    <?php include_once "assets/navbar.php" ?>

    <!-- Content section-->
    <section class="container py-5">
        <div class="row">
            <div class="col-sm-4 text-center">
                <label class="display-5 fw-bolder py-5">Your Itinerary</label>
                <div class="row">
                    <form class="mx-1" role="search">
                        <label class="">Add or remove Days</label>
                        <button onclick="addItineraryDays(-1)" class="btn-secondary btn-block btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                        <button onclick="addItineraryDays(1)" class="btn-secondary btn-block btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                    </form>
                </div>
                <div class="container itinerary-days">
                    <ul class="list-group place-list">
                        <li class="list-group-item d-flex-row itinerary-days">
                            <div class="container d-flex py-4">
                                <p class="p-0 m-0 flex-grow-1">Day 1</p> <button class="btn btn-secondary" onclick=addItineraryDays()> <i class="bi bi-arrow-bar-up"></i> </button> <button class="btn btn-secondary" onclick=moveDown()> <i class="bi bi-arrow-bar-down"></i> </button> <button class="btn btn-secondary" onclick=addItineraryDays()> <i class="bi bi-x-lg"></i> </button>
                            </div>
                            <div class="container list-Place">
                                <ul class="list-group list-group-numbered place-list">
                                    <li class="list-group-item d-flex">
                                        <p class="p-0 m-0 flex-grow-1">First item</p> <button class="btn btn-secondary" onclick=moveUp()> <i class="bi bi-arrow-bar-up"></i> </button> <button class="btn btn-secondary" onclick=moveDown()> <i class="bi bi-arrow-bar-down"></i> </button> <button class="btn btn-secondary" onclick=removePlace()> <i class="bi bi-x-lg"></i> </button>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <p class="p-0 m-0 flex-grow-1">First item</p> <button class="btn btn-secondary" onclick=moveUp()> <i class="bi bi-arrow-bar-up"></i> </button> <button class="btn btn-secondary" onclick=moveDown()> <i class="bi bi-arrow-bar-down"></i> </button>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-sm-4 text-center ">
                <label class="display-5 fw-bolder py-5">Search a new place</label>
                <div class="container py-3">
                    <div class="input-group">
                        <input type="search" onchange=findPlace() class="form-control rounded" placeholder="Search a new place" aria-label="Search" aria-describedby="search-addon" id="search-place" />
                        <button type="button" onclick=findPlace() class="btn btn-outline-primary">search</button>
                    </div>
                </div>
                <div class="container">
                    <ul class="list-group list-result">
                    </ul>

                </div>

            </div>
            <div class="col-sm-4 text-left">
                <label class="display-5 fw-bolder py-5">Place info</label>
                <ul class="list-group">
                    <li class="list-group-item">Place Name:</li>
                    <li class="list-group-item">Tel Number:</li>
                    <li class="list-group-item">Street address:</li>
                </ul>

                <div id="map"></div>
            </div>
        </div>
    </section>

    <?php include_once "assets/footer.html" ?>
</body>

</html>