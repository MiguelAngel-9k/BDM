<?php include 'partials/head.php' ?>

<?php

$user = $data['user'];
$categories = $data['categories'];
$products = $data['productos'];
?>

<body class="bg-primary">

    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a href="landing_page.html" class="text-primary navbar-brand fs-4 fw-bold">
                <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="" width="128"> -->
                Mercadona
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

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
                        <a href="#" class="nav-link fs-6 profile-name">
                        <?php echo $user['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#OpcionesPerfil">
                        <?php echo '<img class="rounded-circle mx-auto d-block" width="32" height="32" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '"/>'; ?>
                        
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Menu Modal -->
    <div class="modal fade" id="OpcionesPerfil" data-bs-backdrop="static" style="" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog text-primary ">
                <div class="modal-content bg-primary"><div class="row m-3">
                <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Opciones</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editProfileModal">Editar
                                Pefil</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#cambiar-avatar">Cambiar avatar</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editPassModal">Cambiar contraseña</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#carritoModal">
                                Carrito</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#addProduct">
                                Agregar producto
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo constant('API') . 'product/whis_list' ?>">
                                Wish lists
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="purchase_report.html">Reporte de compras</a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    <!-- MAIN CONTENT -->
    <div class="container-fluid" id="main">
        <div class="row my-2 py-3">
            <!-- CAROUSEL -->
            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/BDM-MAIN/blobImages/oferta.jpg" class="d-block w-100" height="280" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: black" >¡Las mejores promociones!</h5>
                            <p>No lo encontrarás a un mejor precio.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/BDM-MAIN/blobImages/moda.jpg" class="d-block w-100" height="280" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Atrevete</h5>
                            <p>Escápate con la moda y explora tu libertad.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/BDM-MAIN/blobImages/electrodomesticos.jpg" class="d-block w-100" height="280" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Mejora tu vida</h5>
                            <p>Busca entre los productos de mejor calidad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-3">
        <?php if ($user['rol'] == 'C') { ?>
                <div class="col m-2">
                    <p id="wrapper-title" class="fs-1 fw-bold text-light text-center"></p>
                    <div class="row justify-content-center"  id="wrapper">
                        <?php
                        foreach ($products as $product) {
                        ?>
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
                                            <?php echo "$".$product->getPrice(); ?>
                                        </small>
                                        <a href="<?php echo $product->getID(); ?>" class="my-2 btn text-light d-block btn-success">
                                            Comprar
                                        </a>
                                        <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                            Añadir al carrito
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                       
                    </div>
                </div>
        </div>
    <?php } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="assets/js/nodes/buttons.js"></script>
    <script src="assets/js/nodes/card.js"></script>
    <!-- <script src="assets/js/carousel.js"></script> -->
    <script src="carousel.js"></script>
</body>