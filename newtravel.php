<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "assets/head.html" ?>
    <title>Travel.me - MyArea</title>
</head>

<body>
    <?php include_once "assets/navbar.php" ?>

    <!-- Content section-->
    <section class="">
        <div class="row py-1 d-flex">
            <div class="col">
                <div class="container-xl overflow-auto ">
                    <label class="ft-1 fw-bolder">Itinerary</label>
                    <div class="row">
                        <form class="mx-1" role="search">
                            <label class="">Add or remove Days</label>
                            <button onclick="addDays(-1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> do_not_disturb_on </span> </button>
                            <button onclick="addDays(1)" class="btn-secondary btn mx-1" type="button"> <span class="material-symbols-outlined"> add_circle </span> </button>
                        </form>
                    </div>
                    <div class="row">
                        <label class="ft-2 text-center fw-bolder">Day 1</label>
                        <ul id="sortable" class="list-group">

                        </ul>
                    </div>
                    <div class="row py-1">

                        <label class="ft-2 text-center fw-bolder">Day 2</label>
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
                    <div class="row py-1">
                        <label class="ft-2 text-centerfw-bolder">Day 3</label>
                        <ul class="list-group data-mdb-sortable">
                            <li class="list-group-item">Luogo 1</li>
                            <li class="list-group-item">Luogo 2</li>
                            <li class="list-group-item">Luogo 3</li>
                            <li class="list-group-item">Luogo 4</li>
                            <li class="list-group-item">Luogo 5</li>
                        </ul>
                    </div>
                    <div class="row py-1">
                        <label class="ft-2 text-centerfw-bolder">Day 4</label>
                        <ul class="list-group">
                            <li class="list-group-item">Luogo 1</li>
                            <li class="list-group-item">Luogo 2</li>
                            <li class="list-group-item">Luogo 3</li>
                            <li class="list-group-item">Luogo 4</li>
                            <li class="list-group-item">Luogo 5</li>
                    </div>
                    </ul>
                </div>
            </div>
            <div class="col">
                search bar

            </div>
            <div class="col">

            </div>
        </div>

    </section>

    <?php include_once "assets/footer.html" ?>
</body>

</html>