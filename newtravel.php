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
                        <button onclick="addItineraryDays(-1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                        <button onclick="addItineraryDays(1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                    </form>
                </div>
                <div class="row py-3">
                    <label class="ft-2 fw-bolder py-3">Day 1</label>
                    <div class="container">
                        <ul class="list-group list-group-numbered">
                            <li class="list-group-item">Item 1</li>
                            <li class="list-group-item">Item 2</li>
                            <li class="list-group-item">Item 3</li>
                            <li class="list-group-item">Item 4</li>
                            <li class="list-group-item">Item 5</li>
                            <li class="list-group-item">Item 6</li>
                            <li class="list-group-item">Item 7</li>
                            <li class="list-group-item">Item 8</li>
                        </ul>
                    </div>
                </div>
                <div class="row py-3">

                    <label class="ft-2 fw-bolder py-3">Day 2</label>
                    <div class="container">
                        <ul class="list-group list-group-numbered">
                            <li class="list-group-item">Item 1</li>
                            <li class="list-group-item">Item 2</li>
                            <li class="list-group-item">Item 3</li>
                            <li class="list-group-item">Item 4</li>
                            <li class="list-group-item">Item 5</li>
                            <li class="list-group-item">Item 6</li>
                            <li class="list-group-item">Item 7</li>
                            <li class="list-group-item">Item 8</li>
                        </ul>
                    </div>
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