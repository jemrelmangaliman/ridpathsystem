
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
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/bootstrap5.min.css" rel="stylesheet">

<style>
.invalid-feedback {
    font-size: 12px;
}
</style>
</head>

<body class="bg-success">
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
                            <form class="user" action="register.php" method="POST" id="registerform" novalidate>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <small style="font-size: 11px;">First Name</small>
                                        <input type="text" class="form-control form-control-user" name="firstname" id="firstname" required>
                                        <div class="invalid-feedback">First name is required</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <small style="font-size: 11px;">Middle Name</small>
                                        <input type="text" class="form-control form-control-user" name="middlename" id="middlename" required>
                                        <div class="invalid-feedback">Middle name is required</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <small style="font-size: 11px;">Last Name</small>
                                        <input type="text" class="form-control form-control-user" name="lastname" id="lastname" required>
                                        <div class="invalid-feedback">Last name is required</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <small style="font-size: 11px;">Email Address</small>
                                    <input type="email" class="form-control form-control-user" name="email" id="email" required>
                                    <div class="invalid-feedback">Email address is required</div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <small style="font-size: 11px;">Birthday</small>
                                        <input type="date" class="form-control form-control-user" name="birthday" id="birthday" required>
                                        <div class="invalid-feedback">Birthday is required</div>
                                    </div>
                                    <div class="col">
                                        <small style="font-size: 11px;">Contact Number</small>
                                        <input type="text" class="form-control form-control-user" name="contactnumber" id="contactnumber" required>
                                        <div class="invalid-feedback">Contact number is required</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <small style="font-size: 11px;">Gender</small>
                                        <select class="form-control" style="border-radius: 20px;" name="gender" id="gender" placeholder="Gender">
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="invalid-feedback">Gender is required</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <small style="font-size: 11px;">Password</small>
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required>
                                        <div class="invalid-feedback" id="password1">Password is required</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small style="font-size: 11px;">Confirm Password</small>
                                        <input type="password" class="form-control form-control-user" name="repeatpassword" id="repeatpassword" placeholder="Repeat Password" required>
                                        <div class="invalid-feedback" id="password2">Password confirmation is required</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <small style="font-size: 11px;">Registration Code</small>
                                        <input type="text" class="form-control form-control-user" name="code" id="code" required>
                                        <div class="invalid-feedback" id="codevalidation">Registration code is required</div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success fw-bold btn-user btn-block" onclick="RegistrationValidation()">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small  text-decoration-none" href="index.php">Already have an account? Click here to login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>
