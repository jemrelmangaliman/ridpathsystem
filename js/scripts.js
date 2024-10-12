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

function checkEnrollmentInputs () {
    event.preventDefault();
    event.stopPropagation();
    var noError = true;
    var interestdropdown = document.getElementById('interest-dropdown');
    var stranddropdown = document.getElementById('strand-dropdown');
    const enrollmentform = document.getElementById('enrollmentform');

    if(interestdropdown.value == '0') {
        noError = false;
        interestdropdown.classList.add("is-invalid");
        interestdropdown.classList.remove("is-valid");
    }
    else {
        noError = true;
        interestdropdown.classList.add("is-valid")
        interestdropdown.classList.remove("is-invalid")
    }

    if(stranddropdown.value == '0') {
        noError = false;
        stranddropdown.classList.add("is-invalid");
        stranddropdown.classList.remove("is-valid");
    }
    else {
        noError = true;
        stranddropdown.classList.add("is-valid")
        stranddropdown.classList.remove("is-invalid")
    }

    if (noError == true) {
        enrollmentform.submit();
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