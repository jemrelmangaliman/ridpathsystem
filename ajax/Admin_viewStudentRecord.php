<?php 
$conn = require '../config/config.php';

$ID = $_GET['ID'];
$fetchQuery = "SELECT * FROM students where tempID = '$ID'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$DataArray = mysqli_fetch_assoc($fetchedData);
$firstname = $DataArray['firstname'];
$middlename = $DataArray['middlename'];
$lastname = $DataArray['lastname'];
$email = $DataArray['email'];
$gender = $DataArray['gender'];
$birthday = $DataArray['birthday'];
$contactnumber = $DataArray['contactnumber'];
$studentnumber = $DataArray['studentnumber'];
$address = $DataArray['address'];

$genderdropdowntext = '';
$isMale = ($gender == "Male") ? "selected" : "" ;
$isFemale = ($gender == "Female") ? "selected" : "" ;
$isOther = ($gender == "Other") ? "selected" : "" ;
$hasStudentNumber = ($studentnumber != null) ? "required" : "" ;

echo '
<form action="../processes/Admin_EditStudent.php" method="POST">
    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <small>First Name</small>
            <input type="text" class="form-control" name="ID" hidden value="'.$ID.'">
            <input type="text" class="form-control" name="firstname" value="'.$firstname.'" placeholder="First Name" required>
        </div>
        <div class="col-sm-4">
            <small>Middle Name</small>
            <input type="text" class="form-control" name="middlename" value="'.$middlename.'" placeholder="Middle Name" required>
        </div>
        <div class="col-sm-4">
            <small>Last Name</small>
            <input type="text" class="form-control" name="lastname" value="'.$lastname.'" placeholder="Last Name" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <small>Student Number</small>
            <input type="number" class="form-control" name="studentnumber" value="'.$studentnumber.'" placeholder="Student Number" '.$hasStudentNumber.'>
        </div>
    </div> 
    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <small>Birthday</small>
            <input type="date" name="birthday" class="form-control" value="'.$birthday.'">
        </div>
        <div class="col-sm-4">
            <small>Gender</small>
            <select class="form-select" name="gender" placeholder="Gender">
                <option value="Male" '.$isMale.'>Male</option>
                <option value="Female" '.$isFemale.'>Female</option>
                <option value="Other" '.$isOther.'>Other</option>
            </select>
        </div>
        <div class="col-sm-4">
        <small>Contact Number</small>
        <input type="text" class="form-control" name="contactnumber" value="'.$contactnumber.'" placeholder="Contact Number" required>
        </div>
    </div>
    <div class="form-group">
        <small>Email</small>
        <input type="email" class="form-control" name="email" value="'.$email.'" placeholder="Email Address" required>
    </div>
    <div class="form-group">
        <small>Home Address</small>
        <textarea type="text" class="form-control" name="address" placeholder="Home Address" required>'.$address.'</textarea>
    </div>
    
    <div class="row mt-3 d-flex justify-content-center">
            
    </div>
    <div class="row mt-3">
        <center>
            <div class="row w-75">
                <div class="col">
                    <button type="button" id="page-btn" class="btn btn-danger w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col">
                    <button class="btn btn-success w-100" id="page-btn" type="submit" name="EditStudentDetails">Save Changes</button> 
                </div>        
            </div>
        </center>
    </div>
</form>
';
?>