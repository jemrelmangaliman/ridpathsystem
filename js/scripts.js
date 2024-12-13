function getSuggestedStrands() {
    var description = document.getElementById("interest-dropdown").value;
        
    //ajax call 
    var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var suggestedstrandcontainer = document.getElementById('suggestedstrandcontainer');
                suggestedstrandcontainer.innerHTML = this.responseText;   
                }
            };
        ajax.open("GET", "../ajax/Student_getSuggestedStrand.php?description="+description, true);
        ajax.send(); 

        //call to execute getMiscFee function
        getMiscFee(strandID);
}
function getTuitionFee() {
    var strandID = document.getElementById("strand-dropdown").value;
        
    //ajax call 
    var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tuitionfeetext = document.getElementById('tuitionfeetext');
                    tuitionfeetext.innerHTML = this.responseText;   
                }
            };
        ajax.open("GET", "../ajax/Student_getTuitionFee.php?ID="+strandID, true);
        ajax.send(); 

        //call to execute getMiscFee function
        getMiscFee(strandID);
}

function getMiscFee(strandID) {
        //ajax call 
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var miscfeecontainer = document.getElementById('miscfeecontainer');
                    miscfeecontainer.innerHTML = this.responseText;   
                }
            };
        ajax.open("GET", "../ajax/Student_getMiscFee.php?ID="+strandID, true);
        ajax.send(); 

        computeEnrollmentCostTotal(strandID);
}

function computeEnrollmentCostTotal(strandID) {
    //ajax call 
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var totalamounttext = document.getElementById('totalamounttext');
            totalamounttext.innerHTML = this.responseText;   
            }
        };
    ajax.open("GET", "../ajax/Student_getEnrollmentTotalCost.php?ID="+strandID, true);
    ajax.send(); 
}

function onchangeGradeLevel() {
    var gradelevel = document.getElementById('gradelevel').value;
    const required = document.querySelectorAll('#required-indicator');
    const enrollmentformfile = document.getElementById('enrollmentformfile');
    const reportcardfile = document.getElementById('reportcard');
    const psafile  = document.getElementById('psa');
    const submitbtn = document.getElementsByName('EnrollStudent');
    const examcontainer = document.getElementById('exambutton-container');
    const examlabel = document.getElementById('exambutton-label');
    
    if (gradelevel == "12") {
        required.forEach(function(element) {
            element.style.display = 'none'; // Hides each element
            enrollmentformfile.removeAttribute('required');
            reportcardfile.removeAttribute('required');
            psafile.removeAttribute('required');
            submitbtn.forEach(function(element) {
                element.removeAttribute('disabled');
            });
        });
        examcontainer.style.display = "none";
        examlabel.style.display = "none";
    }
    if (gradelevel == "11"){
        required.forEach(function(element) {
            element.style.display = 'inline-block';
            enrollmentformfile.setAttribute('required', true);
            reportcardfile.setAttribute('required', true);
            psafile.setAttribute('required', true);
            submitbtn.forEach(function(element) {
                element.disabled = true;
            });
        });
        examcontainer.style.display = "block";
        examlabel.style.display = "block";
    }

}

function checkEnrollmentInputs (element) {
    event.preventDefault();
    event.stopPropagation();
    var noError = true;
    var stranddropdown = document.getElementById('strand-dropdown');
    const enrollmentformfile = document.getElementById('enrollmentformfile');
    const reportcardfile = document.getElementById('reportcard');
    const psafile  = document.getElementById('psa');
    const enrollmentform = document.getElementById('enrollmentform');
    var gradelevel = document.getElementById('gradelevel').value;

    if (gradelevel == "11") {
        if(!psafile.files.length) {
            noError = false;
            psafile.classList.add("is-invalid");
            psafile.classList.remove("is-valid");
        }
        else {
            psafile.classList.remove("is-invalid")
        }
    
        if(!reportcardfile.files.length) {
            noError = false;
            reportcardfile.classList.add("is-invalid");
            reportcardfile.classList.remove("is-valid");
        }
        else {
            reportcardfile.classList.remove("is-invalid")
        }
    
        if(!enrollmentformfile.files.length) {
            noError = false;
            enrollmentformfile.classList.add("is-invalid");
            enrollmentformfile.classList.remove("is-valid");
        }
        else {
            enrollmentformfile.classList.remove("is-invalid")
        }
    
    
        if(stranddropdown.value == '0') {
            noError = false;
            stranddropdown.classList.add("is-invalid");
            stranddropdown.classList.remove("is-valid");
        }
        else {
            stranddropdown.classList.add("is-valid")
            stranddropdown.classList.remove("is-invalid")
        }
    }
    else {
        if(stranddropdown.value == '0') {
            noError = false;
            stranddropdown.classList.add("is-invalid");
            stranddropdown.classList.remove("is-valid");
        }
        else {
            stranddropdown.classList.add("is-valid")
            stranddropdown.classList.remove("is-invalid")
        }
    }
    

    if (noError == true) {
        enrollmentform.submit();
        element.disabled = true;
    }
}

function AddStudentToSection (element) {
    var SectionID = element.getAttribute("data-bs-sectionID");
    $("#ViewStudentContainer").show();
    //ajax call 
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var viewstudentcontainer = document.querySelector('#ViewStudentContainer');
            viewstudentcontainer.innerHTML = this.responseText;   
            }
            else {
                console.log(this.status);
            }
        };
    ajax.open("GET", "../ajax/getSectionStudentList.php?ID="+SectionID, true);
    ajax.send(); 
}
function hideStudentList() {
    $("#ViewStudentContainer").hide();
}
function disableButton(element) {
    const form = document.getElementById("ExamForm");

    if (!form.checkValidity()) {
        event.preventDefault(); 
        element.disabled = true;
    }
    else {
        form.submit();
    }

}

function RegistrationValidation () {
    event.preventDefault();
    event.stopPropagation();
    var noError = true;
    var fname = document.getElementById('registerform');
    var fname = document.getElementById('firstname');
    var mname = document.getElementById('middlename');
    var lname = document.getElementById('lastname');
    var email = document.getElementById('email');
    var bday = document.getElementById('birthday');
    var contact = document.getElementById('contactnumber');
    var pass = document.getElementById('password');
    var confirmpass = document.getElementById('repeatpassword');
    var passvalidation = document.getElementById('password1');
    var confirmpassvalidation = document.getElementById('password2');
    var code = document.getElementById('code');
    var codevalidation = document.getElementById('codevalidation');
    codevalidation.textContent = "Registration code is required";
    var isValidCode = "";

    if(fname.value == '') {
        noError = false;
        fname.classList.add("is-invalid");
        fname.classList.remove("is-valid");
    }
    else {
        fname.classList.remove("is-invalid")
    }

    if(mname.value == '') {
        noError = false;
        mname.classList.add("is-invalid");
        mname.classList.remove("is-valid");
    }
    else {
        mname.classList.remove("is-invalid")
    }

    if(lname.value == '') {
        noError = false;
        lname.classList.add("is-invalid");
        lname.classList.remove("is-valid");
    }
    else {
        lname.classList.remove("is-invalid")
    }

    if(email.value == '') {
        noError = false;
        email.classList.add("is-invalid");
        email.classList.remove("is-valid");
    }
    else {
        email.classList.remove("is-invalid")
    }

    if(bday.value == '') {
        noError = false;
        bday.classList.add("is-invalid");
        bday.classList.remove("is-valid");
    }
    else {
        bday.classList.remove("is-invalid")
    }

    if(contact.value == '') {
        noError = false;
        contact.classList.add("is-invalid");
        contact.classList.remove("is-valid");
    }
    else {
        contact.classList.remove("is-invalid")
    }

    if((confirmpass.value != '' && pass.value != '')) {
        if (pass.value != confirmpass.value) {
            noError = false;
            pass.classList.add("is-invalid");
            pass.classList.remove("is-valid");
            confirmpass.classList.add("is-invalid");
            confirmpass.classList.remove("is-valid");
            passvalidation.textContent = "Passwords do not match";
            confirmpassvalidation.textContent = "Passwords do not match";
        } 
    }
    else if (pass.value == '' && confirmpass.value != '') {
        noError = false;
        pass.classList.add("is-invalid");
        pass.classList.remove("is-valid");
    }
    else if(pass.value != '' && confirmpass.value == '') {
        noError = false;
        confirmpass.classList.add("is-invalid");
        confirmpass.classList.remove("is-valid");
    }
    else {
        noError = false;
        pass.classList.add("is-invalid");
        pass.classList.remove("is-valid");
        confirmpass.classList.add("is-invalid");
        confirmpass.classList.remove("is-valid");
    }

    if(code.value == '') {
        noError = false;
        code.classList.add("is-invalid");
    }
    else {
        //check if registration code exists and is correct
        $.ajax({
            url: "ajax/Registrar_getCodeValidity.php",
            type: "GET",
            data: {
                code: code.value,
                email: email.value
            },
            success: function(response) {
                isValidCode = response;
                if (isValidCode == "No") {
                    noError = false;
                    code.classList.add("is-invalid");
                    codevalidation.textContent = "Invalid code. Please check again";
                }
                else if (isValidCode == "Used") {
                    noError = false;
                    code.classList.add("is-invalid");
                    codevalidation.textContent = "Code is already used. Please request a new one";
                }
                else {
                    code.classList.remove("is-invalid");
                    codevalidation.textContent = "Registration code is required";
                }

                if (noError == true) {
                    registerform.submit();
                    element.disabled = true;
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);  // Optional: handle the error if needed
            }
        });        
    }

}

let isUserInput = false;

function generateCode() {
    var registrationCodeField = document.getElementById('code');

    const button = document.getElementById('generatebutton');

    const array = new Uint8Array(8); // Create an array of 8 random bytes
    window.crypto.getRandomValues(array); // Fill it with random values
    
    var code = Array.from(array, byte => byte.toString(16).padStart(2, '0')).join('').slice(0, 8); 
    registrationCodeField.value = code;
    button.disabled = true;
    registrationCodeField.setAttribute('readonly',true);
    isUserInput = true;
    registrationCodeField.classList.remove("is-invalid");
}

function clearField() {
    var registrationCodeField = document.getElementById('code');

    if (isUserInput == false) {
        registrationCodeField.value = '';
        registrationCodeField.classList.add("is-invalid");
    }
    else {
        registrationCodeField.classList.remove("is-invalid");
    }
}