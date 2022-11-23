<?php include 'partials/head.php' ?>

<?php

$user = $data['user'];
$carts = $data['cart'];

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

    <div class="container mt-4 bg-secondary rounded">
        <div class="row">
            <div class="col">
                <h1 class="text-primary text-center">Review Purchase</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $ammount = 0;
                        foreach ($carts as $cart) {
                        ?>
                            <tr>
                                <td><?php echo $cart->getName() ?></td>
                                <td>$<?php echo $cart->getPrice() ?></td>
                                <td><?php echo $cart->getCategory() ?></td>
                                <td><?php echo $cart->getQuantity() ?></td>
                                <td><?php echo $cart->getDate() ?></td>
                            </tr>
                        <?php

                        $ammount += $cart->getPrice();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <h3 class="text-primary text-end">Total $: <?php echo $ammount ?></h3>
            <a href="<?php echo constant('API').'product/pay/'.$user['email'] ?>" class="fs-5 btn btn-primary">Pay</a>
        </div>

    </div>

</body>