<?php include 'partials/head.php';

$user = $data['USER'];
$product =  $data['PRODUCT'];
// var_dump($product['media']);

?>

<body>

    <?php include 'partials/header.php' ?>
    <div class="container-fluid bg-primary vh-100 p-5">
        <div class="row bg-dark rounded">
            <p class="text-primary m-3">Video Games > Video Games</p>
            <div class="col-4">
                <div class="row">
                    <!-- IMAGES LIST -->
                    <div class="col-2">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($product['media'] as $media) { ?>
                                <li class="list-group-item">
                                    <img width="80" height="80" src="data:image/jpeg;base64,<?php echo base64_encode($media) ?>" alt="" class="rounded thumbnail d-block mx-auto">
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($product['media'][0]) ?>" alt="" class="product-thumbnail img-fluid mx-auto d-block">
                    </div>
                </div>
            </div>
            <div class="col-5 text-primary">
                <div class="row">
                    <h1 class="fw-normal"><?php echo $product['name'] ?></h1>
                    <!-- <p>Plataform: Xbox, Xbox one, windows, Xbox Series S</p> -->
                    <p>Saler: <a class="text-primary fw-bold" href="sales_user.html"><?php echo $product['owner'] ?></a></p>
                </div>
                <div class="row">
                    <div class="col-3">
                        <span>
                            <!-- <h2 class="text-danger fw-light text-decoration-line-through">$60.99</h2> -->
                            <h2>$<?php echo $product['price']; ?></h2>
                        </span>
                    </div>
                    <div class="col">
                        <p><?php echo $product['desc']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col text-primary">
                <a href="<?php echo constant('API') . '/product/aprove/' . $product['id']; ?>" class="btn btn-block btn-success">Aprove</a>
            </div>
        </div>
    </div>

    <?php include 'partials/tail.php'; ?>

    <script src="assets/js/nodes/buttons.js"></script>
    <script src="assets/js/nodes/card.js"></script>
    <!-- <script src="assets/js/carousel.js"></script> -->
    <script src="carousel.js"></script>
</body>