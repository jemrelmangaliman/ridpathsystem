<?php
session_start();
?>
<?php require 'shared/action-message.php'; 
session_unset();
?>

<!DOCTYPE html>
<html lang="en" style="height:100vh;">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ridpath Academy of Mabuhay - Login</title>

    <link rel="icon" type="image/x-icon" href="img/ridpath.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/bootstrap5.min.css" rel="stylesheet">

</head>

<body class="bg-success">

    <div class="container-fluid">

        <!-- Nested Row within Card Body -->
        <div class="row" style="height:100vh;">
            <div class="col-lg-6 d-flex justify-content-center">
                <img src="img/ridpath.png" class="w-100">
            </div>
            <div class="col-lg-6 bg-white d-flex align-items-center justify-content-center">
                <div class="p-5 w-100">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Ridpath Academy of Mabuhay</h1>
                    </div>
                    <form class="user" action="login.php" method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control form-control-user"
                                id="username" aria-describedby="username"
                                placeholder="username or email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user"
                                id="password" placeholder="Password" required>
                        </div>
                        
                        <button class="btn btn-outline-success fw-bold  btn-user btn-block" type="submit">Login</button>


                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small text-decoration-none" href="register_form.php">Click here to create an account!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>