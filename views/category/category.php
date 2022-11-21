<?php include 'partials/head.php' ?>

<?php

$user = $data['user'];
$categories = $data['categories'];
$products = $data['products'];
$catName = $data['idCat'];
?>


<body class="bg-secondary">
    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top">
        <div class="container-fluid">
            <a href="<?php echo constant('API') ?>product/landing" class="text-primary navbar-brand fs-4 fw-bold">
                <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="" width="128"> -->
                Mercadona
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse justify-content-center" id="menu">
                <form action="" class="d-flex w-75 position-relative ">
                    <input type="search" class="form-control me-2" placeholder="Buscar" aria-label="Search">
                    <button class="btn position-absolute" active style="right: 10px;" type="submit">Busqueda</button>
                </form>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="<?php echo constant('API') ?>" class="nav-link fs-6 profile-name">
                            <?php echo $user['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sales_user.html" class="nav-link">
                            <?php echo '<img width="32" height="32" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '" class="rounded-circle mx-auto d-block"/>'; ?>
                            <!-- <img width="32" height="32" src="data:image/png;base64,'<?php echo base64_encode($user['img']) ?>'" class="rounded-circle mx-auto d-block"> -->
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CATEGOIRES NAVS -->
    <nav class="nav">
        <?php
        foreach ($categories as $category) {

            if ($category['ID'] == $catName)
                $catName = $category['NAME'];
        ?>
            <a href='<?php echo constant('API') ?>category/category/<?php echo $category['ID'] ?>' class="nav-link">
                <?php echo $category['NAME']; ?>
            </a>
        <?php
        }
        ?>
    </nav>

    <div class="container-fluid bg-primary text-primary">
        <!-- MAIN CONTENT -->
        <div class="row mt-4">
            <div class="col-2 my-2 border-end border-5 border-success">
                <!-- FILTERS -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="fw-bold fs-6 text-primary">Relate Date</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="#">Last 30 days</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">Last 60 days</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">Last 90 days</a>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold fs-6 text-primary">Price</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item form-check form-switch">
                                <a href="#">Under $10</a>
                            </li>
                            <li class="list-group-item form-check form-switch">
                                <a href="#">$10 to $15</a>
                            </li>
                            <li class="list-group-item form-check form-switch">
                                <a href="#">$15 to $20</a>
                            </li>
                            <li class="list-group-item form-check form-switch">
                                <a href="#">$20 to $25</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col m-2">
                <div class="row">
                    <h1><?php echo $catName; ?></h1>
                </div>
                <div class="row">
                    <div class="col m-3">
                        <div class="row justify-content-center">
                            <?php foreach ($products as $product) { ?>

                                <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                                    <div class="card rounded p-2 m-1" style="width:18rem;">
                                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($product->getCover()) . '" alt="Imagen" class="card-img-top rounded">' ?>
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                <?php echo $product->getName(); ?>
                                            </h3>
                                            <p class="card-text">
                                                <?php echo $product->getDescription(); ?>
                                            </p>
                                            <small class="text-success fw-bold fs-4">
                                                <?php echo "$" . $product->getPrice(); ?>
                                            </small>
                                            <a href="<?php echo $product->getID(); ?>" class="my-2 btn text-light d-block btn-success">
                                                Comprar
                                            </a>
                                            <a href="<?php echo constant('API').'product/product/'.$product->getID(); ?>" class="my-2 btn text-light d-block btn-success-light">
                                                See More
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- CAROUSEL -->
        <div class="row justify-content-center p-3 m-3">
            <h2>Relacionado</h2>
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

    <?php include 'partials/tail.php' ?>

    <script src="assets/js/nodes/buttons.js"></script>
    <script src="assets/js/nodes/card.js"></script>
    <!-- <script src="assets/js/carousel.js"></script> -->
    <script src="carousel.js"></script>
</body>