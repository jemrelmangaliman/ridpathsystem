<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ridpath Academy of Mabuhay - Register</title>

    <link rel="icon" type="image/x-icon" href="img/ridpath.jpg">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/boostrap5.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="img/ridpath.jpg" class="w-100 ml-4 my-5">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">Create an Account!</h1>
                            </div>
                            <form class="user" action="register.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <small style="font-size: 11px;">First Name</small>
                                        <input type="text" class="form-control form-control-user" name="firstname" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <small style="font-size: 11px;">Middle Name</small>
                                        <input type="text" class="form-control form-control-user" name="middlename" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <small style="font-size: 11px;">Last Name</small>
                                        <input type="text" class="form-control form-control-user" name="lastname" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <small style="font-size: 11px;">Email Address</small>
                                    <input type="email" class="form-control form-control-user" name="email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <small style="font-size: 11px;">Birthday</small>
                                        <input type="date" class="form-control form-control-user" name="birthday" required>
                                    </div>
                                    <div class="col">
                                        <small style="font-size: 11px;">Contact Number</small>
                                        <input type="text" class="form-control form-control-user" name="contactnumber" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <small style="font-size: 11px;">Gender</small>
                                        <select class="form-control" style="border-radius: 20px;" name="gender" placeholder="Gender">
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <small style="font-size: 11px;">Password</small>
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <small style="font-size: 11px;">Confirm Password</small>
                                        <input type="password" class="form-control form-control-user" name="repeatpassword" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        // Check if there's an error parameter in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        if (error === 'password_mismatch') {
            alert('Passwords do not match.');
        }
    </script>
</body>

</html>
