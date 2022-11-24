<?php include 'partials/head.php' ?>

<?php

$user = $data['user'];
$carts = $data['cart'];

?>

<body class="bg-primary">
    <?php include 'partials/header.php' ?>

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