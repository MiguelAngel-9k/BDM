<?php include 'partials/head.php' ?>

<?php

$user = $data['user'];
$categories = $data['categories']

?>

<body class="bg-primary">

    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a href="#" class="text-primary navbar-brand fs-4 fw-bold">
                <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="" width="128"> -->
                Mercadona
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse justify-content-center" id="menu">
                <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Profile
                        </a>
                    </li>
                </ul> -->
                <form action="products.html" class="d-flex w-75 position-relative ">
                    <input type="search" class="form-control me-2" placeholder="Find some" aria-label="Seach">
                    <button class="btn position-absolute" active style="right: 10px;" type="submit">Seach</button>
                </form>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="<?php echo constant('API'); ?>user/profile " class="nav-link fs-6 profile-name">
                            <?php echo $user['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sales_user.html" class="nav-link">
                            <img width="32" height="32" src="data:image/jpeg;base64,<?php echo base64_encode($user['img']) ?>" alt="User image" class="rounded-circle mx-auto d-block">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- MAIN CONTENT -->
    <div class="container-fluid" id="main">
        <div class="row my-2 py-3">
            <!-- CAROUSEL -->
            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="first.png" class="d-block w-100" height="280" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="second.png" class="d-block w-100" height="280" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="third.png" class="d-block w-100" height="280" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-3">
            <?php
            foreach ($categories as $category) {
            ?>
                <div style="background-color: #d6d6d6;" class="m-2 p-3 rounded col h-50">
                    <h2 class="text-light"><?php echo $category['NAME'] ?></h2>
                    <img src="https://images-na.ssl-images-amazon.com/images/W/WEBP_402378-T1/images/G/01/AmazonExports/Fuji/2020/May/Dashboard/Fuji_Dash_Electronics_1x._SY304_CB432774322_.jpg" alt="" class="thumbnail rounded mx-auto d-block">
                </div>
            <?php
            }
            ?>
        </div>
        <div class="row justify-content-center p-3 m-3">
            <h2>Lo mas comprado</h2>
            <div class="col-1 align-items-center d-flex">
                <p id="prev" class="text-light mx-auto text-center bg-success">PREV</p>
            </div>
            <div class="col">
                <div class="row justify-content-center" id="content">

                </div>
            </div>
            <div class="col-1 align-items-center d-flex">
                <p id="next" class="text-light mx-auto text-center bg-success">NEXT</p>
            </div>
        </div>
        <!-- FOOTER -->
        <div class="row bg-dark">
            <!-- FOOTER -->
            <div class="col">
                <div class="row">
                    <p class="text-light text-center border-bottom border-2 my-2">Back to top</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center bg-dark">
            <div class="col-lg-4 text-center">
                <h3 class="text-light">
                    Get to know us
                </h3>
            </div>
            <div class="col-lg-4 text-center">
                <h3 class="text-light">
                    Payment products
                </h3>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php include 'partials/tail.php' ?>
    <!-- <script src="assets/js/carousel.js"></script> -->
    <script src="carousel.js"></script>
</body>