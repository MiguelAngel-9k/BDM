<?php include 'partials/head.php' ?>

<?php $user = $data['USER'];
$categories = $data['CATEGOIRES'];
$products = $data['PRODUCTS'];
// var_dump($products);
/* 
foreach($categories as $category)
    var_dump($category['ID']); */
?>

<body class="bg-primary">


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
                        <a href="sales_user.html" class="nav-link fs-6 profile-name">
                            <?php echo $user['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sales_user.html" class="nav-link">
                            <?php echo '<img width="32" height="32" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '"/>'; ?>
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
        ?>
            <a href='<?php echo constant('API') ?>category/category/<?php echo $category['ID'] ?>' class="nav-link">
                <?php echo $category['NAME']; ?>
            </a>
        <?php
        }
        ?>
    </nav>

    <!-- USER INFORMATION -->
    <div class="mt-5 container-fluid">
        <div class="row">
            <div class="col-lg-2 mx-4">
                <?php echo '<img class="rounded-circle mx-auto d-block" width="200" height="200" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '"/>'; ?>

                <!-- <img width="200" height="200" src="data:image/jpeg;base64,'<?php echo base64_encode($data['img']) ?>'" alt="User image" class="rounded-circle mx-auto d-block"> -->
            </div>
            <div class="col m-4">
                <div class="row">
                    <h1 class="d-flex text-primary border-bottom border-5 border-success p-2">
                        <?php
                        echo $user['name'] . '<p class="m-0 ms-1 p-0 fs-5 align-self-center"> (' . $user['nickname'] . ')</p>';

                        ?>
                    </h1>
                    <small id="user" class="text-primary">
                        <?php echo $user['email']; ?>
                    </small>
                </div>
            </div>
        </div>


        <!-- PROFILE CONTENT -->
        <div class="row mt-4">
            <!-- WISH LISTS -->
            <div class="col-lg-3">
                <div class="list-group border-bottom border-success border-5" id="wish-container">
                    <div class="my-2 list-group-item list-group">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <a href="#" class="fs-5 fw-normal">Compras Skate</a>
                                </div>
                                <div class="row">
                                    <p class="fst-italic fw-light text-primary fs-6">10/08/22</p>
                                </div>
                            </div>
                            <div class="col my-auto">
                                <?php echo '<img width="64" height="64" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '"/>'; ?>
                                <!-- <img width="64" height="64" src="http://www.codiceskateshop.com/media/catalog/product/cache/1/image/600x800/9df78eab33525d08d6e5fb8d27136e95/t/a/tabla-baker-brand-logo-black-white_1.jpg" alt="" class="float-end rounded"> -->
                            </div>
                        </div>
                    </div>
                    <div class="list-group my-2">
                        <div class="list-group-item list-group">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <a href="#" class="fs-5 fw-normal">Bocinas para fiestas</a>
                                    </div>
                                    <div class="row">
                                        <p class="fst-italic fw-light text-primary fs-6">10/08/22</p>
                                    </div>
                                </div>
                                <div class="col my-auto">
                                    <img width="64" height="64" src="https://m.media-amazon.com/images/I/71KC6YWsyLL._AC_SS450_.jpg" alt="" class="float-end rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group my-2">
                        <div class="list-group-item list-group action">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <a href="#" class="fs-5 fw-normal">Monitores</a>
                                    </div>
                                    <div class="row">
                                        <p class="fst-italic fw-light text-primary fs-6">10/08/22</p>
                                    </div>
                                </div>
                                <div class="col my-auto">
                                    <img width="64" height="64" src="https://static-geektopia.com/storage/t/p/128/128028/816x381/aw3423dw.webp" alt="" class="float-end rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-3">
                    <h3 class="text-primary">Opciones</h3>
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
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                Agregar Categoria
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="wish_list.html">
                                Wish lists
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="sales_report.html">Reporte de ventas</a>
                        </li>
                        <li class="list-group-item">
                            <a href="purchase_report.html">Reporte de compras</a>
                        </li>
                        <li class="list-group-item">
                            <div class="text-light form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="privacy" <?php echo $user['priv'] == 1 ? "checked" : ""; ?>>
                                <label class="form-check-label" for="privacy">Publico</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <?php if ($user['rol'] == 'V') { ?>
                <div class="col m-2">
                    <p id="wrapper-title" class="fs-1 fw-bold text-light text-center"><?php echo $user['priv'] == 1 ? 'Productos Disponibles' : 'Cuenta Privada' ?></p>
                    <div class="row justify-content-center <?php echo $user['priv'] == 1 ? 'd-flex' : 'd-none' ?>" id="wrapper">
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
                                            <?php echo "$" . $product->getPrice(); ?>
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
            <?php } else if ($user['rol'] == 'A') { ?>
                <div class="col m-2">
                    <p id="wrapper-title" class="fs-1 fw-bold text-light text-center">Producto pendientes por aprobar</p>
                    <div class="row justify-content-center" id="wrapper">
                        <div class="col m-2">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Aprobar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                            <tr>
                                                <td><?php echo $product->getName(); ?> </td>
                                                <td>$<?php echo $product->getPrice(); ?> </td>
                                                <td><?php echo $product->getCategory(); ?> </td>
                                                <td><?php echo $product->getDate(); ?> </td>
                                                <td><?php echo $product->getQuantity(); ?>Pz </td>
                                                <td><a class="btn text-light btn-success-light" href="<?php echo constant('API')."product/preview/".$product->getID(); ?>">See more</a></td>
                                                <td><a class="btn btn-success" href="<?php echo constant('API')."product/aprove/".$product->getID(); ?>">Aprove</a></td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>

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

        <!-- EDITAR PERFIL MODAL -->
        <!-- Modal -->
        <div class="modal fade" id="editProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog text-primary">
                <div class="modal-content bg-primary">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Editar Pefil</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-primary">
                        <div class="row p-3">
                            <div class="col">
                                <form action="http://localhost/user/edit" method="POST" class="row g-3" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $user['email'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="nickname" class="form-label">User Nickname</label>
                                        <input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $user['nickname'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name'] ?>">
                                    </div>
                                    <div class="m-2 col-12 align-self-center">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo $user['gender'] == 1 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo $user['gender'] == 0 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  <div class="col-12">
                                    <label for="avatar" class="form-label">Change avatar Image</label>
                                    <input type="file" name="avatar" id="avatar" class="form-control">
                                </div> -->
                                    <div class="col d-grid gap-2">
                                        <input type="submit" value="Submit" id="create" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CAMBIAR CONTRASENIA -->
        <div class="modal fade" id="editPassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPass" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-primary">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="editPass">Cambiar contraseña</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo constant('API'); ?>user/pass" method="POST" class="justify-content-center">
                            <div class="row">
                                <input type="hidden" name="owner" value="<?php echo $user['email']; ?>">
                                <div class="m-2 col-12">
                                    <label for="oldPass" class="form-label">Contraseña</label>
                                    <input type="text" class="form-control" id="oldPass" name="oldPass">
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-2 col-12">
                                    <label for="newPass" class="form-label">Nueva Contraseña</label>
                                    <input type="text" class="form-control" id="newPass" name="newPass">
                                </div>
                            </div>
                            <div class="d-grid m-2 gap-2">
                                <input type="submit" value="Cambiar" class="btn btn-success btn-block text-light">
                                <!-- <a id="btn-category" class="btn btn-success btn-block text-light">Agrergar</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- AGREGAR CATEGORIA -->
        <!-- MODAL -->
        <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-primary">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="addCategoryLabel">Nueva Categoria</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo constant('API'); ?>category/add" method="POST" class="justify-content-center">
                            <div class="row">
                                <input type="hidden" name="owner" value="<?php echo $user['email']; ?>">
                                <div class="m-2 col-12">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-2 col-12">
                                    <label for="description" class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                            </div>
                            <div class="d-grid m-2 gap-2">
                                <input type="submit" value="Agregar" class="btn btn-success btn-block text-light">
                                <!-- <a id="btn-category" class="btn btn-success btn-block text-light">Agrergar</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARRITO DE COMPRAS -->
        <!-- MODAL -->
        <div class="modal fade" id="carritoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="carritoModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-dark text-primary">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="carritoLabel">Carrito de compras</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-light table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gameboy advance</td>
                                    <td>$15.99</td>
                                    <td>Video Games</td>
                                    <td>10/05/2022</td>
                                </tr>
                                <tr>
                                    <td>Gameboy advance</td>
                                    <td>$15.99</td>
                                    <td>Video Games</td>
                                    <td>10/05/2022</td>
                                </tr>
                                <tr>
                                    <td>Gameboy advance</td>
                                    <td>$15.99</td>
                                    <td>Video Games</td>
                                    <td>10/05/2022</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AGREGAR PRODUCTO MODAL -->
        <!-- MODAL -->
        <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-primary text-primary">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="staticBackdropLabel">Nuevo Producto</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addProduct" action="<?php echo constant('API'); ?>product/newProduct" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="pOwner" value="<?php echo $user['email'] ?>" />
                            <div class="row">
                                <div class="m-2 col-8">
                                    <label for="pName" class="form-label">Nombre del producto</label>
                                    <input type="text" name="pName" id="pName" class="form-control">
                                </div>
                                <div class="m-2 col-2">
                                    <label for="pQty" class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" id="pQty" name="pQty">
                                </div>
                                <div class="m-2 col-4">
                                    <label for="pPrice" class="form-label">Fijar percio base</label>
                                    <input type="text" name="pPrice" id="pPrice" class="form-control">
                                </div>
                                <div class="m-2 col-5 align-self-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="pCot" name="pCot">
                                        <label class="form-check-label" for="cot">Mostrar el precio</label>
                                    </div>
                                </div>
                                <div class="m-2 col-12">
                                    <label for="pMedia" class="form-label">Imagenes o Videos</label>
                                    <input class="form-control" type="file" id="pMedia" name="pMedia[]" multiple="multiple">
                                </div>
                                <div class="m-2 col-12">
                                    <label for="pCat" class="form-label">Categoria</label>
                                    <select class="form-select" aria-label="Default select example" id="pCat" name="pCat">
                                        <?php
                                        foreach ($categories as $category)
                                            echo "<option value = '" . $category['ID'] . "'> " . $category['NAME'] . " </option> ";
                                        ?>
                                    </select>
                                </div>
                                <div class="m-2 col-12">
                                    <label for="pDesc" class="form-label">Mas informacion acerca</label>
                                    <textarea class="form-control" id="pDesc" name="pDesc" rows="3"></textarea>
                                </div>
                                <div class="m-2 d-grid gap-2">
                                    <input type="submit" value="Agregar" class="btn btn-success btn-block text-light">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($user['lg'] == 1) { ?>

            <div class="modal fade" id="usr-img" data-bs-backdrop="static" aria-hidden="false" data-bs-keyboard="false" aria-labelledby="usr-img-modal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-primary text-primary">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="usr-img-modal">Vamos configurar tu cuenta en Mecadona!!</h1>
                            <!-- <p>Comencemos con tu imagen, como los demas te reconoceran es muy importante.</p> -->
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body p-3">
                            <div class="row">
                                <h2 class="fs-5 p-3 border-bottom border-primary border-3">Comencemos con tu imagen, como los demas te reconoceran es muy importante.</h2>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <img id="init-img" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="" width="200" height="200" class="m-5 img-thumbnail rounded-circle float-start">
                                </div>
                                <div class="col m-4 align-self-center">
                                    <div class="mx-2">
                                        <input accept="image/*" class="form-control" type="file" name="avatar-img" id="avatar-img">
                                        <a id="put-img" class="btn btn-primary d-block mt-2" data-bs-target="#side" data-bs-toggle="modal">Listo!!</a>
                                    </div>
                                    <p class="fs-6 text-center">Podras cambiar tu imagen de perfil cuando lo desees.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="side" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-primary text-primary">
                        <div class="modal-header d-block">
                            <h1 class="modal-title fs-4" id="usr-img-modal">Que tipo de cuenta necesitas? <?php echo $user['nickname'] ?></h1>
                            <p>Recuerda que no podras cambiar el tipo de cuenta despues.</p>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-between p-3">
                                <div id="customer" class=" rounded col-5 bg-body shadow-lg p-2" data-bs-target="#welcome" data-bs-toggle="modal">
                                    <h3 class="text-center">COMPRADOR</h3>
                                </div>
                                <div id="saler" class="text-white rounded col-5 bg-body shadow-lg p-2" data-bs-target="#welcome" data-bs-toggle="modal">
                                    <h3 class="text-center">VENDEDOR</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="welcome" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-primary text-primary">
                        <div class="modal-body">
                            <div class="row justify-content-between p-3">
                                <h3 class="text-center">
                                    Te damos la bienvenida!!, todo esta listo.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="location.reload()">Comenzar a navegar</button>
                    </div>
                </div>
            </div>
            <!-- <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a> -->
        <?php
        } else if ($user['lg'] == 0) {
        ?>
            <!-- CAMBIAR AVATAR -->
            <div class="modal fade" id="cambiar-avatar" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false" aria-labelledby="usr-img-cambiar" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-primary text-primary">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="usr-img-cambiar">Vamos configurar tu cuenta en Mecadona!!</h1>
                            <!-- <p>Comencemos con tu imagen, como los demas te reconoceran es muy importante.</p> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-3">
                            <div class="row">
                                <h2 class="fs-5 p-3 border-bottom border-primary border-3">Comencemos con tu imagen, como los demas te reconoceran es muy importante.</h2>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <?php echo '<img id="init-img" class="m-5 img-thumbnail rounded-circle float-start" width="200" height="200" src="data:image/jpeg;base64,' . base64_encode($user['img']) . '"/>'; ?>
                                </div>
                                <div class="col m-4 align-self-center">
                                    <div class="mx-2">
                                        <input accept="image/*" class="form-control" type="file" name="avatar-img" id="avatar-img">
                                        <a id="put-img" class="btn btn-primary d-block mt-2" data-bs-target="#side" data-bs-toggle="modal">Listo!!</a>
                                    </div>
                                    <p class="fs-6 text-center">Podras cambiar tu imagen de perfil cuando lo desees.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <?php include 'partials/tail.php' ?>

        <script>
            const customerside = document.querySelector('#customer');
            const salerside = document.querySelector('#saler');

            document.addEventListener('click', e => {
                if (e.target.id == 'customer') {
                    setSide('C')
                        .then(res => res.json())
                        .then(res => {
                            console.log(res)
                            $('#side').modal('hide');
                        })
                        .catch(err => console.log(err));


                } else if (e.target.id == 'saler') {
                    setSide('V')
                        .then(res => res.json())
                        .then(res => {
                            console.log(res)
                            $('#side').modal('hide');
                        })
                        .catch(err => console.log(err));

                    $('#side').modal('hide');
                }
            })

            async function setSide(side) {
                try {
                    let res = await fetch('http://localhost/BDM/user/side', {
                        method: "POST",
                        body: JSON.stringify({
                            side,
                            user
                        })
                    })

                    return res;
                } catch {
                    return new Error('Cannot chose a side');
                }
            }
        </script>

        <script>
            window.onload = () => {
                $('#usr-img').modal('show');
            }

            const img = document.querySelector('#avatar-img');
            const avatar = document.querySelector('#init-img');
            const save = document.querySelector('#put-img');

            img.addEventListener('change', e => {
                let file = (e.target.files[0]);
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.addEventListener('load', function() {
                    avatar.src = this.result;
                })
            })

            save.addEventListener('click', async e => {

                const formData = new FormData();
                const user = document.querySelector('#user');
                formData.append('user', user.textContent.trim());
                formData.append('img', img.files[0]);

                await fetch('http://localhost/BDM/user/ImageEdit', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => {
                        if ($('#usr-img') != undefined) {
                            $('#usr-img').modal('hide');
                            return;
                        }
                        location.reload();

                    })
                    .catch(err => console.log(err));

            })
        </script>

        <script>
            /* EMPAQUETAR FUNCIONALIDAD */
            const URL = 'http://localhost/BDM'
            const privacyCheck = document.querySelector('#privacy');

            async function setPrivacy(data) {
                try {
                    const response = await fetch(`${URL}/user/privacy`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    return response.json();
                } catch {
                    return 'Cannot set privacy';
                }
            }

            function privateAccount() {
                const container = document.querySelector('#wrapper');
                const containerTitle = document.querySelector('#wrapper-title');

                //WISH LIST CONTAINER
                const wContainer = document.querySelector('#wish-container');
                wContainer.classList.add('d-none');

                container.classList.remove('d-flex');
                container.classList.add('d-none');

                containerTitle.textContent = 'Cuenta Privada'
            }

            function publicAccount() {
                const container = document.querySelector('#wrapper');
                const containerTitle = document.querySelector('#wrapper-title');

                //WISH LIST CONTAINER
                const wContainer = document.querySelector('#wish-container');
                wContainer.classList.remove('d-none')
                wContainer.classList.add('block');

                container.classList.remove('d-none');
                container.classList.add('d-flex');

                containerTitle.textContent = 'Productos Disponibles';
            }

            privacyCheck.addEventListener('change', (e) => {
                if (e.target.id == 'privacy') {
                    setPrivacy({
                            user: document.querySelector('#user').textContent.trim(),
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

        <!--  <script>

        const prductoForm = document.querySelector('#addProduct');
        prductoForm.addEventListener('change', e => {
            if(e.target.id = 'cot')
                alert(e.target.checked);
        })

    </script> -->
</body>

</html>