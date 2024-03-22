<?php

// memanggil file function.php dan koneksi databases

require_once('functions.php')
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-info bg-gradient">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light  my-4">Register</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" name="username" required />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" required />
                                            <label for="username">Email</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password"
                                                type="password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>



                                        <button type="submit" name="register"
                                            class="bg-warning text-success">Register</button>
                                        <div class="card-footer text-center py-3">
                                            <div class="small">
                                                <i>Sudah punya akun <a href="login.php">Login di sini</a></i>
                                            </div>
                                        </div>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>