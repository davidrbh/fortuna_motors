<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Davidrbh">
    <link rel="shortcut icon" href="<?= media(); ?>/images/favicon_vzl.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.min.css"> -->
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title><?= $data['page_tag']; ?></title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Fortuna Admin</h1>
        </div>
        <div class="login-box">
            <!-- <div id="divLoading">
                <div>
                    <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
                </div>
            </div> -->
            <form class="login-form" name="formLogin" id="formLogin" autocomplete="off" action="">
                <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN IN</h3>
                <div class="mb-3">
                    <label class="form-label">USERNAME</label>
                    <input class="form-control" type="text" placeholder="Email" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">PASSWORD</label>
                    <input class="form-control" type="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <div class="utility">
                        <div>
                            <p class="semibold-text mb-2"><a href="#top" data-toggle="flip-right">Sign up</a></p>
                        </div>
                        <p class="semibold-text mb-2"><a href="#top" data-toggle="flip-left">Forgot Password ?</a></p>
                    </div>
                </div>
                <div class="mb-3 btn-container d-grid">
                    <button class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN
                        IN</button>
                </div>
            </form>
            <form id="formResetPass" name="formResetPass" autocomplete="off" class="forget-form-left" action="">
                <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Forgot Password ?</h3>
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="mb-3 btn-container d-grid">
                    <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>RESET</button>
                </div>
                <div class="mb-3 mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip-left"><i
                                class="bi bi-chevron-left me-1"></i>
                            Back to Login</a></p>
                </div>
            </form>
            <form id="formSignUp" name="formSignUp" autocomplete="off" class="signup-form-right" action="">
                <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>SIGN UP</h3>
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="mb-3 btn-container d-grid">
                    <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>CONTINUE</button>
                </div>
                <div class="mb-3 mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip-right"><i
                                class="bi bi-chevron-left me-1"></i>
                            Back to Login</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- Essential javascript's for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.7.0.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
    <script type="text/javascript">

    </script>
</body>

</html>