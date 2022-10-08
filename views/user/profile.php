<?php include 'partials/head.php' ?>

<?php $user = $data['USER'];
$categories = $data['CATEGOIRES'];
// var_dump($user) 
?>

<body class="bg-primary">


    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top">
        <div class="container-fluid">
            <a href="landing_page.html" class="text-primary navbar-brand fs-4 fw-bold">
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
                            <img width="32" height="32" src="data:image/png;base64,'<?php echo base64_encode($user['img']) ?>'" class="rounded-circle mx-auto d-block">
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
            <a href='<?php echo constant('API') ?>category/get/<?php echo $category['ID'] ?>' class="nav-link">
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
                <img width="200" height="200" src="data:image/png;base64,'<?php echo base64_encode($data['img']) ?>'" alt="User image" class="rounded-circle mx-auto d-block">
            </div>
            <div class="col m-4">
                <div class="row">
                    <h1 class="d-flex text-primary border-bottom border-5 border-success p-2">
                        <?php
                        echo $user['name'];
                        if ($user['rol'] == 'V') {
                            echo '<p class="fs-6 fw-light">(Sale man)</p>';
                        }
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
                <div class="list-group border-bottom border-success border-5">
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
                                <img width="64" height="64" src="http://www.codiceskateshop.com/media/catalog/product/cache/1/image/600x800/9df78eab33525d08d6e5fb8d27136e95/t/a/tabla-baker-brand-logo-black-white_1.jpg" alt="" class="float-end rounded">
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
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editProfileModal">Cambiar avatar</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editProfileModal">Configuracion de cuenta</a>
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
            <div class="col m-2">
                <p id="wrapper-title" class="fs-1 fw-bold text-light text-center"><?php echo $user['priv'] == 1 ? 'Productos Disponibles' : 'Cuenta Privada' ?></p>
                <div class="row justify-content-center <?php echo $user['priv'] == 1 ? 'd-flex' : 'd-none' ?>" id="wrapper">
                    <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                        <div class="card rounded p-2 m-1" style="width:18rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_754237-MLA44715287415_012021-F.webp" alt="Imagen" class="card-img-top rounded">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Bocinas JBL
                                </h3>
                                <p class="card-text">
                                    cupiditate molestias distinctio, officiis quidem nobis?
                                </p>
                                <small class="text-success fw-bold fs-4">
                                    $1,500
                                </small>
                                <a href="product.html" class="my-2 btn text-light d-block btn-success">
                                    Comprar
                                </a>
                                <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                    Añadir al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                        <div class="card rounded p-2 m-1" style="width:18rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_754237-MLA44715287415_012021-F.webp" alt="Imagen" class="card-img-top">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Bocinas JBL
                                </h3>
                                <p class="card-text">
                                    cupiditate molestias distinctio, officiis quidem nobis?
                                </p>
                                <small class="text-success fw-bold fs-4">
                                    $1,500
                                </small>
                                <a href="product.html" class="my-2 btn text-light d-block btn-success">
                                    Comprar
                                </a>
                                <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                    Añadir al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                        <div class="card rounded p-2 m-1" style="width:18rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_754237-MLA44715287415_012021-F.webp" alt="Imagen" class="card-img-top">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Bocinas JBL
                                </h3>
                                <p class="card-text">
                                    cupiditate molestias distinctio, officiis quidem nobis?
                                </p>
                                <small class="text-success fw-bold fs-4">
                                    $1,500
                                </small>
                                <a href="product.html" class="my-2 btn text-light d-block btn-success">
                                    Comprar
                                </a>
                                <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                    Añadir al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                        <div class="card rounded p-2 m-1" style="width:18rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_754237-MLA44715287415_012021-F.webp" alt="Imagen" class="card-img-top">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Bocinas JBL
                                </h3>
                                <p class="card-text">
                                    cupiditate molestias distinctio, officiis quidem nobis?
                                </p>
                                <small class="text-success fw-bold fs-4">
                                    $1,500
                                </small>
                                <a href="product.html" class="my-2 btn text-light d-block btn-success">
                                    Comprar
                                </a>
                                <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                    Añadir al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                        <div class="card rounded p-2 m-1" style="width:18rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_754237-MLA44715287415_012021-F.webp" alt="Imagen" class="card-img-top">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Bocinas JBL
                                </h3>
                                <p class="card-text">
                                    cupiditate molestias distinctio, officiis quidem nobis?
                                </p>
                                <small class="text-success fw-bold fs-4">
                                    $1,500
                                </small>
                                <a href="product.html" class="my-2 btn text-light d-block btn-success">
                                    Comprar
                                </a>
                                <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                    Añadir al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 col-md-4">
                        <div class="card rounded p-2 m-1" style="width:18rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_754237-MLA44715287415_012021-F.webp" alt="Imagen" class="card-img-top">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Bocinas JBL
                                </h3>
                                <p class="card-text">
                                    cupiditate molestias distinctio, officiis quidem nobis?
                                </p>
                                <small class="text-success fw-bold fs-4">
                                    $1,500
                                </small>
                                <a href="product.html" class="my-2 btn text-light d-block btn-success">
                                    Comprar
                                </a>
                                <a href="#" class="my-2 btn text-light d-block btn-success-light">
                                    Añadir al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $data['email'] ?>">
                                </div>
                                <div class="col-12">
                                    <label for="nickname" class="form-label">User Nickname</label>
                                    <input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $data['nickname'] ?>">
                                </div>
                                <div class="col-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $data['name'] ?>">
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
                    <form action="">
                        <div class="row">
                            <div class="m-2 col-8">
                                <label for="pName" class="form-label">Nombre del producto</label>
                                <input type="text" name="pName" id="pName" class="form-control">
                            </div>
                            <div class="m-2 col-2">
                                <label for="pQty" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" id="pQty">
                            </div>
                            <div class="m-2 col-4">
                                <label for="pPrice" class="form-label">Fijar percio base</label>
                                <input type="text" name="pPrice" id="pPrice" class="form-control">
                            </div>
                            <div class="m-2 col-5 align-self-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Mostrar el
                                        precio</label>
                                </div>
                            </div>
                            <div class="m-2 col-12">
                                <label for="pMedia" class="form-label">Imagenes o Videos</label>
                                <input class="form-control" type="file" id="pMedia" multiple>
                            </div>
                            <div class="m-2 col-12">
                                <label for="pCat" class="form-label">Categoria</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">Calzado</option>
                                    <option value="2">Tecnologia</option>
                                    <option value="3">Electronica</option>
                                </select>
                            </div>
                            <div class="m-2 col-12">
                                <label for="pDesc" class="form-label">Mas informacion acerca</label>
                                <textarea class="form-control" id="pDesc" rows="3"></textarea>
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

    <?php include 'partials/tail.php' ?>

    <script>

        /* EMPAQUETAR FUNCIONALIDAD */
        const URL = 'http://localhost'
        const privacyCheck = document.querySelector('#privacy');

        async function setPrivacy(data) {
            try {
                const response = await fetch(`${URL}/user/privacy`, {
                    method: 'POST',
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                return response.json();
            } catch {
                return 'Cannot set privacy';
            }
        }

        function privateAccount(){
            const container = document.querySelector('#wrapper');
            const containerTitle = document.querySelector('#wrapper-title');

            container.classList.remove('d-flex');
            container.classList.add('d-none');

            containerTitle.textContent = 'Cuenta Privada'
        }

        function publicAccount(){
            const container = document.querySelector('#wrapper');
            const containerTitle = document.querySelector('#wrapper-title');

            container.classList.remove('d-none');
            container.classList.add('d-flex');

            containerTitle.textContent = 'Productos Disponibles';
        }

        privacyCheck.addEventListener('change', (e) => {
            if (e.target.id == 'privacy') {
                setPrivacy({user: document.querySelector('#user').textContent.trim(), mode: e.target.checked})
                    .then(res => {
                        if(res.privacy){
                            publicAccount();
                        }else if(!res.privacy){
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

</html>