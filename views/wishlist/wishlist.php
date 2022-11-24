<?php include_once 'partials/head.php';

$list = $data['list'];
$lists = $data['lists'];
$user = $data['user'];
$items = $data['items'];



?>

<body class="bg-primary">
    <?php include 'partials/header.php' ?>

    <!-- CONTENT     -->
    <div class="mt-5 container-fluid">
        <div class="row">
            <!-- OWN LISTS -->
            <div class="col-lg-2">
                <div class="row">
                    <h3 class="fw-bold text-primary text-center">Listas de deseos</h3>
                    <div class="list-group list-group-flush border-bottom border-success border-5">
                        <?php foreach ($lists as $userlist) { ?>
                            <div class="list-group-item my-2">
                                <a href="<?php echo constant('API') . 'wishList/list/' . $userlist->getID(); ?>" class="fs-5 fw-normal"><?php echo $userlist->getName() ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- WISH LIST CONTENT -->
            <div class="col m-3">
                <!-- WISH LIST BANNER -->
                <div class="row rounded border border-5 border-success bg-success">
                    <div class="col-3 p-2">
                        <img width="200" src="data:image/jpeg;base64,<?php echo base64_encode($list['cover']) ?>" alt="" class="mx-auto img-thumbnail">
                    </div>
                    <div class="col text-primary">
                        <p class="m-0 fs-6 fw-light privacy"><?php echo $list['privacy'] ?></p>
                        <h1 class="m-0 p-0"><?php echo $list['name'] ?></h1>
                        <p class="fs-4"><?php echo $list['description'] ?></p>
                        <small><?php echo $list['owner'] ?></small>
                    </div>
                    <div class="col">
                        <a href="<?php echo constant('API') . 'wishList/removeList/' . $list['id'] ?>" class="btn btn-danger">Eliminar lista</a>
                        <a href="<?php echo constant('API') . 'wishList/privacy/' . $list['id'] . '/' . $list['privacy'] ?>" class="btn btn-primary">Change privacy</a>
                    </div>
                </div>
                <!-- WISH LIST CONTENT -->
                <?php foreach ($items as $item) { ?>
                    <a href="<?php echo constant('API') . '/product/product/' . $item->getID() ?>" class="wish-object rounded row my-3 border-success text-primary p-2 border-bottom border-2">
                        <?php if ($product->medType == 'image') { ?>
                            <div class="col-1 p-2">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($item->getCover()) . '" alt="Imagen" class="card-img-top rounded">' ?>
                            </div>
                        <?php } else { ?>
                            <div class="col-1 p-2">
                                <video width="120" height="140" autoplay muted>
                                    <source src="data:<?php echo $item->type ?>/<?php echo $item->ext ?>;base64,<?php echo base64_encode($item->getCover()) ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php } ?>
                        <div class="col-8">
                            <h3 class="m-0"><?php echo $item->getName(); ?></h3>
                            <!-- <p class="m-0">Estrellas</p> -->
                            <p class="m-0 fs-4">$<?php echo $item->getPrice(); ?></p>
                        </div>
                        <div class="col my-3 justify-content-center d-flex">
                            <div class="g-grid g-2">
                                <!-- <input type="hidden" value="<?php echo $item->getID(); ?>" id="item" /> -->
                                <!-- <input type="hidden" value="<?php echo $list['id'] ?>" id="list" /> -->
                                <a id="deleteItem" href="<?php echo constant('API') . 'wishList/removeItem/' . $item->getID() . '/' . $list['id']; ?>" class="text-primary justify-content-end btn btn-danger">Delete from list</a>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- NUEVA WISH LIST MODAL -->
    <div class="modal fade" id="addWishlistModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addWishlistModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="addCategoryLabel">Nueva Categoria</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="m-2 col-12">
                                <label for="category" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="category">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <input type="submit" value="Agregar" class="btn btn-warning btn-block text-light">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row bg-secondary">
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

    <?php include_once 'partials/tail.php'; ?>

</body>

</html>