<?php include 'partials/head.php' ?>

<body class="bg-primary">

    <div class="container">
        <div class="row my-5" id="wrapper">
            <div class="col" id="imgHolder">
                <nav class="nav">
                    <a href="landing_page.html" class="text-primary navbar-brand fs-4 fw-bold">
                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="" width="128"> -->
                        Mercadona
                    </a>
                </nav>
            </div>
            <div class="col align-self-center">
                <div class="row">
                    <h2 class="text-start text-primary">Create Account</h2>
                    <form action="http://localhost/user/register" method="POST" class="row g-3">
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="email@example.com">
                        </div>
                        <div class="col-12">
                            <label for="nickname" class="form-label">User Nickname</label>
                            <input type="text" name="nickname" id="nickname" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="pwd" class="form-label">Password</label>
                            <input type="password" name="pwd" id="pwd" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col d-grid gap-2">
                            <input type="submit" value="Submit" id="create" class="btn btn-success">
                            <!-- <a class="btn btn-success" id="usrpwd" onclick="valid()">Registrate</a> -->
                        </div>
                    </form>
                </div>
                <div class="row m-2">
                    <div class="col-12 m-3">
                        <small class="text-primary">
                            When you create a new account already accept terms and conditions on web page, you can see
                            all on
                            <a href="#" class="link">Terms and conditions</a>
                        </small>
                    </div>
                    <div class="col-12 m-3">
                        <small class="text-primary">
                            Already have an account, login on
                            <a href="#" class="link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGIN MODAL BUTTON -->

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-primary">
                <div class="modal-header">
                    <h5 class="modal-title fs-3 text-primary" id="loginModalLabel">Sign in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form action="<?php echo constant('API').'user/login' ?>" method="POST" class="row g-3">
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="email@example.com">
                                </div>
                                <div class="col-12">
                                    <label for="pwd" class="form-label">Password</label>
                                    <input type="password" name="pwd" id="pwd" class="form-control">
                                </div>
                                <div class="col d-grid gap-2">
                                    <input type="submit" value="Submit" id="create" class="btn btn-success">
                                    <!-- <a class="btn btn-success" id="usrpwd" onclick="valid()">Inicar sesión</a> -->

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-12">
                            <small class="fs-6 fw-light text-primary">
                                By continuing, you agree to Amazon's Conditions of Use and Privacy Notice.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'partials/tail.php' ?>
</body>