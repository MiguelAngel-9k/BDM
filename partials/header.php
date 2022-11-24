<!-- MAIN NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
        <a href="<?php echo constant('API') ?>product/landing" class="text-primary navbar-brand fs-4 fw-bold">
                Mercadona
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse justify-content-center" id="menu">
                <form action="<?php echo constant('API') ?>product/search" method="POST" class="d-flex w-75 position-relative ">
                    <input type="search" name="search" class="form-control me-2" placeholder="Find some" aria-label="Seach">
                    <button class="btn position-absolute" active style="right: 10px;" type="submit">Seach</button>
                </form>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="<?php echo constant('API'); ?>user/profile " class="nav-link fs-6 profile-name">
                            <?php echo $user['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sales_user.html" class="nav-link">
                            <img width="32" height="32" src="data:image/jpeg;base64,<?php echo base64_encode($user['img']) ?>" alt="User image" class="rounded-circle mx-auto d-block">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>