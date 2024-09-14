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