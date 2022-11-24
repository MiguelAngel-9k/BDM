<?php include 'partials/head.php';
$user = $data['user'];
$sales = $data['sales'];
?>

<body class="bg-primary">
    <?php include 'partials/header.php' ?>

    <div class="container mt-4 bg-secondary rounded">
        <div class="row">
            <div class="col">
                <h1 class="text-primary text-center">Sales Report</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Existencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <td><?php echo $sale->getDate() ?></td>
                                <td><?php echo $sale->getCategory() ?></td>
                                <td><?php echo $sale->getName() ?></td>
                                <td><?php echo $sale->getPrice() ?></td>
                                <td><?php echo $sale->getQuantity() ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>