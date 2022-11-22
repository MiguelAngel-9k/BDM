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
                        <a href="<?php echo constant('API') ?>" class="nav-link fs-6 profile-name">
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

    <div class="container-fluid bg-primary">
        <div class="row">
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
                    <span class="badge <?php echo $product['qty'] == 'In Stock' ? 'bg-good' : 'bg-danger' ?>"><?php echo $product['qty'] ?></span>
                    <p>Saler: <a class="text-primary fw-bold"><?php echo $product['owner'] ?></a></p>
                </div>
                <div class="row">
                    <div class="col-3">
                        <span>
                            <h2>$<?php echo $product['price'] ?></h2>
                        </span>
                    </div>
                    <div class="col">
                        <p><?php echo $product['desc'] ?></p>
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
                        <a href="#" class="btn btn-block btn-success">Add to cart</a>
                        <a href="#" class="btn btn-block btn-success">Buy Now</a>
                        <form action="<?php echo constant('API') ?>wishList/addProducto" method="POST" id="addToList">
                            <input type="hidden" name="product" id="product" value="<?php echo $product['id']?>">
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
        <div class="row px-5">
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
            <!-- <a href="#">Show more</a> -->
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

    <?php include_once 'partials/tail.php' ?>

    <script>

        const baseURL = 'http://localhost/BDM/'

        const listCB = document.querySelector('#list');
        listCB.addEventListener('change', e => {
           const listId = e.target.value;
           const productId = document.querySelector('#product').value;

            addToList(listId, productId)
                .then( res => res.json() )
                .then( res => alert(res[0].res) )
                .catch( err => console.log(err) );
        })


        async function addToList(list, obj){
            const data = new FormData();
            
            return await fetch(`${baseURL}wishList/addProduct`, {
                method: 'POST',
                body: JSON.stringify({list, obj})
            });

        }

        

    </script>

    <script src="assets/js/nodes/buttons.js"></script>
    <script src="assets/js/nodes/card.js"></script>
    <!-- <script src="assets/js/carousel.js"></script> -->
    <script src="carousel.js"></script>
</body>