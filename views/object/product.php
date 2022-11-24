<?php include 'partials/head.php' ?>

<?php $user = $data['USER'];
// $categories = $data['CATEGOIRES'];
$product = $data['PRODUCT'];
$lists = $data['WLISTS'];
// var_dump($product);
/* 
foreach($categories as $category)
    var_dump($category['ID']); */
?>

<body class="bg-primary">



    <?php include 'partials/header.php' ?>

    <div class="container-fluid bg-primary">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <!-- IMAGES LIST -->
                    <div class="col-2">
                        <ul class="list-group list-group-flush">
                            <?php
                            foreach ($product['media'] as $media) {
                                if ($media['type'] == 'image') {
                            ?>
                                    <li class="list-group-item">
                                        <img width="80" height="80" src="data:<?php echo $media['type'] ?>/jpeg;base64,<?php echo base64_encode($media['resource']) ?>" alt="" class="rounded thumbnail d-block mx-auto">
                                    </li>

                            <?php }
                            } ?>
                        </ul>
                    </div>
                    <div class="col">
                        <?php if ($product['media'][0]['type'] == 'image') { ?>
                            <img src="data:<?php echo $product['media'][0]['type'] ?>/jpeg;base64,<?php echo base64_encode($product['media'][0]['resource']) ?>" alt="" class="product-thumbnail img-fluid mx-auto d-block">
                        <?php } else { ?>
                            <video width="440" height="320" autoplay muted>
                                <source src="data:<?php echo $product['media'][0]['type'] ?>/<?php echo $product['media'][0]['ext'] ?>;base64,<?php echo base64_encode($product['media'][0]['resource']) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php } ?>
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
                <div class="card" style="width: 18rem; ">
                    <div class="card-body">
                        <h5 class="card-title">
                            $<?php echo $product['price'] ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 <?php echo $product['qty'] == 'In Stock' ? 'text-good' : 'text-danger' ?>"><?php echo $product['qty'] ?></h6>
                        <?php if ($product['price'] != 'Cotizar') { ?>
                            <a href="<?php echo constant('API') . 'product/addToCart/' . $product['id'] ?>" class="btn btn-block btn-success">Add to cart</a>
                        <?php } ?>
                        <form action="<?php echo constant('API') ?>wishList/addProducto" method="POST" id="addToList">
                            <input type="hidden" name="product" id="product" value="<?php echo $product['id'] ?>">
                            <select class="form-select m-2" aria-label="Default select example" name="list" id="list">
                                <option selected>Add to Wish List</option>
                                <?php foreach ($lists as $list) { ?>
                                    <option value="<?php echo $list->getID(); ?>"><?php echo $list->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </form>
                        <p><?php echo $product['desc'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h1 class="text-primary text-center m-2">Resources</h1>
            <?php
            foreach ($product['media'] as $media) {
                if ($media['type'] == 'video') {
            ?>
                    <div class="col-lg-4 bg-dark rounded d-flex justify-content-center">
                        <video width="440" height="320" autoplay muted>
                            <source src="data:<?php echo $media['type'] ?>/<?php echo $media['ext'] ?>;base64,<?php echo base64_encode($media['resource']) ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

            <?php }
            } ?>
        </div>
        <!-- <div class="row px-5">
            <h3 class="text-primary">Top reviws</h3>
            <ul class="list-group">
                <li class="list-group-item  text-primary bg-secondary rounded p-3  m-2">
                    <span class="d-flex">
                        <img width="60" height="60" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="User image" class="mx-2 rounded-circle float-left">
                        <p class="fw-light">Jhon Peterson</p>
                    </span>
                    <p class="fw-bold m-0 p-0">Never Again</p>
                    <p class="text-warning m-0 p-0">4/5</p>
                    <p class="p-3">i was looking for controllers to give to my son after his old one got stick drift and
                        wouldnt
                        work properly. he wanted it to come ASAP since he hates having stick drift. so when looking for
                        controllers, i was mainly looking at when they come, which was my mistake. this one said, "fast
                        shipping, comes tomorrow." perfect! its a nice price, and he can get it tomorrow. so when it
                        arrived, he was excited. after playing with it for 3 hours, he came to me and told me something
                        was wrong with it. so here are the pros and cons of this controller:
                    </p>
                </li>
                <li class="list-group-item text-primary bg-secondary rounded p-3  m-2">
                    <span class="d-flex">
                        <img width="60" height="60" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="User image" class="mx-2 rounded-circle float-left">
                        <p class="fw-light">Jhon Peterson</p>
                    </span>
                    <p class="fw-bold m-0 p-0">Never Again</p>
                    <p class="text-warning m-0 p-0">4/5</p>
                    <p class="p-3">i was looking for controllers to give to my son after his old one got stick drift and
                        wouldnt
                        work properly. he wanted it to come ASAP since he hates having stick drift. so when looking for
                        controllers, i was mainly looking at when they come, which was my mistake. this one said, "fast
                        shipping, comes tomorrow." perfect! its a nice price, and he can get it tomorrow. so when it
                        arrived, he was excited. after playing with it for 3 hours, he came to me and told me something
                        was wrong with it. so here are the pros and cons of this controller:
                    </p>
                </li>
                <li class="list-group-item text-primary bg-secondary rounded p-3  m-2">
                    <span class="d-flex">
                        <img width="60" height="60" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="User image" class="mx-2 rounded-circle float-left">
                        <p class="fw-light">Jhon Peterson</p>
                    </span>
                    <p class="fw-bold m-0 p-0">Never Again</p>
                    <p class="text-warning m-0 p-0">4/5</p>
                    <p class="p-3">i was looking for controllers to give to my son after his old one got stick drift and
                        wouldnt
                        work properly. he wanted it to come ASAP since he hates having stick drift. so when looking for
                        controllers, i was mainly looking at when they come, which was my mistake. this one said, "fast
                        shipping, comes tomorrow." perfect! its a nice price, and he can get it tomorrow. so when it
                        arrived, he was excited. after playing with it for 3 hours, he came to me and told me something
                        was wrong with it. so here are the pros and cons of this controller:
                    </p>
                </li>
            </ul>
            <!-- <a href="#">Show more</a> --
            <span class="d-flex m-2 text-primary">
                <img width="60" height="60" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="User image" class="mx-2 rounded-circle float-left">
                <p class="fw-light">Jhon Peterson</p>
            </span>
            <div class="form-floating">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Comment title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                </div>
                <div class="mb-3 gap-2 d-grid">
                    <input type="submit" value="Comment" class="g-3 btn btn-success">
                </div>
            </div>
        </div>
        <div class="row justify-content-center p-3 m-3">
            <h2 class="text-primary">Compare with similar products</h2>
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
        </div> -->
        <!-- FOOTER --
        <div class="row bg-dark">
            <!-- FOOTER --
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
    </div> -->

        <div class="modal fade" id="cotizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cotizarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-primary">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="cotizarLabel">Cotizar producto</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo constant('API') . 'product/addToCart/' . $product['id'] ?>" method="POST">
                            <div class="row">
                                <input type="hidden" id="user" value="<?php echo $user['email']; ?>">
                                <input type="hidden" id="item" value="<?php echo $product['id']; ?>">
                                <div class="m-2 col-12">
                                    <label for="cant" class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" id="cant">
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-2 col-12">
                                    <label for="description" class="form-label">Precio cotizado</label>
                                    <input type="text" class="form-control text-dark" id="precioCotizado" readonly>
                                </div>
                            </div>
                            <div class="d-grid m-2 gap-2">
                                <a id="ask" class="btn btn-success btn-block text-light">Cotizar</a>
                                <input value="Add to cart" type="submit" id="accept" class="btn btn-secondary btn-block text-light" />
                                <!-- <a id="btn-category" class="btn btn-success btn-block text-light">Agrergar</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once 'partials/tail.php' ?>

        <script>
            const baseURL = 'http://localhost/BDM/'

            const listCB = document.querySelector('#list');
            listCB.addEventListener('change', e => {
                const listId = e.target.value;
                const productId = document.querySelector('#product').value;

                addToList(listId, productId)
                    .then(res => res.json())
                    .then(res => 'Agregado')
                    .catch(err => console.log(err));
            })


            async function addToList(list, obj) {
                const data = new FormData();

                return await fetch(`${baseURL}wishList/addProduct`, {
                    method: 'POST',
                    body: JSON.stringify({
                        list,
                        obj
                    })
                });

            }
        </script>

        <script>
            const askBtn = document.querySelector('#ask');
            askBtn.addEventListener('click', e => {
                const item = document.querySelector('#item');
                const cant = document.querySelector('#cant');
                const user = document.querySelector('#user');

                console.log(item.value, cant.value, user.value);

                cotizar(cant.value, item.value, user.value)
                    .then(res => res.json())
                    .then(res => {
                        const price = document.querySelector('#precioCotizado');
                        price.value = `$${res.price}`;
                    })
                    .catch(err => console.log(err));
            })

            const cotizar = async (cant, item, user) => {


                return await fetch(`${baseURL}product/cotizar`, {
                    method: 'POST',
                    body: JSON.stringify({
                        item,
                        cant,
                        user
                    })
                })
            }
        </script>

        <script src="assets/js/nodes/buttons.js"></script>
        <script src="assets/js/nodes/card.js"></script>
        <!-- <script src="assets/js/carousel.js"></script> -->
        <script src="carousel.js"></script>
</body>