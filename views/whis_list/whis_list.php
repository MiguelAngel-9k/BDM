<?php include 'partials/head.php' ?>
<?php

$user = $data['user'];
$categories = $data['categories'];
$products = $data['productos'];
?>

<body class="bg-primary">
    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top">
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
                <!--  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                <form action="" class="d-flex w-75 position-relative ">
                    <input type="search" class="form-control me-2" placeholder="Find some" aria-label="Seach">
                    <button class="btn position-absolute" active style="right: 10px;" type="submit">Seach</button>
                </form>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="sales_user.html" class="nav-link fs-6 profile-name">
                        <?php echo $user['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#"class="nav-link" data-bs-toggle="modal" data-bs-target="#OpcionesPerfil">
                        <?php echo '<img class="rounded-circle mx-auto d-block" width="32" height="32" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '"/>'; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT     -->
    <div class="mt-5 container-fluid">
        <div class="row">
            <!-- OWN LISTS -->
            <div class="col-lg-2">
                <div class="row">
                    <h3 class="fw-bold text-primary text-center">Listas de deseos</h3>
                    <div class="list-group list-group-flush border-bottom border-success border-5">
                        <div class="list-group-item my-2">
                            <a href="#" class="fs-5 fw-normal">Compras de skate</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#" class="fs-5 fw-normal">Bocinas para fiesta</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#" class="fs-5 fw-normal">Monitores</a>
                        </div>
                    </div>
                </div>
                <!-- MORE LISTS FROM OWNER -->
                <div class="row mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="dropdown">
                                <a href="sales_user.html" class="dropdown-toggle" role="button" id="lists" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Mas listas de <b><?php echo $user['name']; ?></b>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="lists">
                                    <li><a href="#" class="dropdown-item">Compras Skate</a></li>
                                    <li><a href="#" class="dropdown-item">Bocinas para fiestas</a></li>
                                    <li><a href="#" class="dropdown-item">Monitores</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addWishlistModal">
                                Crear lista
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- WISH LIST CONTENT -->
            <div class="col m-3">
                <!-- WISH LIST BANNER -->
                <div class="row rounded border border-5 border-success bg-success">
                    <div class="col-3 p-2">
                        <img width="200"
                            src="http://www.codiceskateshop.com/media/catalog/product/cache/1/image/600x800/9df78eab33525d08d6e5fb8d27136e95/t/a/tabla-baker-brand-logo-black-white_1.jpg"
                            alt="" class="mx-auto img-thumbnail">
                    </div>
                    <div class="col text-primary">
                        <p class="m-0 fs-6 fw-light privacy">Public List</p>
                        <h1 class="m-0 p-0">Bocinas para fiesta</h1>
                        <p class="fs-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempore, dolor
                            adipisci, sapiente eos, </p>
                        <small><?php echo $user['name']; ?></small>
                    </div>
                </div>
                <!-- WISH LIST CONTENT -->
                <a href="product.html" class="wish-object rounded row my-3 border-success text-primary p-2 border-bottom border-2">
                    <div class="col-1 p-2">
                        <img width="100"
                            src="http://www.codiceskateshop.com/media/catalog/product/cache/1/image/600x800/9df78eab33525d08d6e5fb8d27136e95/t/a/tabla-baker-brand-logo-black-white_1.jpg"
                            alt="" class="img-thumbnail">
                    </div>
                    <div class="col-8">
                        <h3 class="m-0">Tabla Baker</h3>
                        <p class="m-0">Estrellas</p>
                        <p class="m-0 fs-4">$60</p>
                        <small class="text-good">In Stock</small>
                    </div>
                    <div class="col my-3 justify-content-center d-flex">
                        <div class="g-grid g-2">
                            <input value="Agregar al carrito" type="submit" class="text-primary justify-content-end btn btn-success-light">
                        </div>
                    </div>
                </a>
                <a href="product.html" class="wish-object rounded row my-3 text-primary border-success p-2 border-bottom border-2">
                    <div class="col-1 p-2">
                        <img width="100" src="https://m.media-amazon.com/images/I/71KC6YWsyLL._AC_SS450_.jpg" alt=""
                            class="img-thumbnail">
                    </div>
                    <div class="col-8">
                        <h3 class="m-0">Bocinas JBL</h3>
                        <p class="m-0">Estrellas</p>
                        <p class="m-0 fs-4">$45</p>
                        <small class="text-good">In Stock</small>
                    </div>
                    <div class="col justify-content-center d-flex">
                        <div class="g-grid g-2">
                            <input value="Agregar al carrito" type="submit" class="text-primary justify-content-end btn btn-success-light">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- NUEVA WISH LIST MODAL -->
    <div class="modal fade" id="addWishlistModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addWishlistModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-primary text-primary">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="addCategoryLabel">Nueva Lista</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo constant('API'); ?>product/newList" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="owner" id="owner" value="<?php echo $user['email'] ?>" />    
                    <div class="row">
                            <div class="m-2 col-12">
                                <label for="category" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="NameList" name="NameList">
                            </div>
                        </div>
                        <div class="row">
                            <div class="m-2 col-12">
                                <label for="category" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                            </div>
                        </div>
                        <label for="pMediaa" class="form-label">Imagene</label>
                                    <input class="form-control" type="file" id="pMedia" name="pMedia" multiple="multiple">
                        <input class="form-check-input" type="checkbox" role="switch" id="privacy" name="privacy">
                        <label class="form-check-label" for="privacy">Publico</label>
                        <div class="d-grid gap-2">
                            <input type="submit" value="Agregar" class="btn btn-success btn-block text-light">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row bg-secondary">
            <!-- FOOTER -->
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script>
    const privacyCheck = document.querySelector('#privacy');
        privacyCheck.addEventListener('change', (e) => {
                if (e.target.id == 'privacy') {
                    setPrivacy({
                            mode: e.target.checked
                        })
                        .then(res => {
                            if (res.privacy) {
                                publicAccount();
                            } else if (!res.privacy) {
                                privateAccount();
                            }
                        })
                        .catch(err => {
                            console.log(err)
                        });
                }
            })
        </script>
</body>