<?php
$conn = require '../config/config.php';

$sectionID = $_GET['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM sections ss 
LEFT JOIN strands str ON ss.strandID = str.strandID
WHERE ss.sectionID='$sectionID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$strandID = $DataArray['strandID'];
$gradelevel = $DataArray['gradelevel'];
$sectionname = $DataArray['abbreviation'].' '.$gradelevel.' - '.$DataArray['sectionname'];
$strandname = $DataArray['strandname'];

//fetch the currently active school year
$fetchSYData = mysqli_query($conn, "SELECT * FROM schoolyear where isactive ='Yes'");
$SYArray = mysqli_fetch_assoc($fetchSYData);
$syID = $SYArray['schoolYearID'];

//get all the enrolled students aligned with the section's strand and grade level
$fetchStudentData = mysqli_query($conn, "SELECT * FROM students st
LEFT JOIN enrollmentrecords er ON st.tempID = er.studentID
WHERE er.schoolYearID = '$syID' AND er.strandID = '$strandID' AND gradelevel='$gradelevel' ORDER BY st.lastname");
$studentlist_dropdown = '';
while ($StudentData = mysqli_fetch_assoc($fetchStudentData)) {
    $studentnumber = $StudentData['studentnumber'];
    $tempID = $StudentData['tempID']; //temporary use only
    $Studentname = $StudentData['lastname'].', '.$StudentData['firstname'].' '.$StudentData['middlename'];
 $studentlist_dropdown .= '<option value=""></option>';
}


//fetch the student list under the section
$fetchSLData = mysqli_query($conn, "SELECT * FROM sectionstudentlist where sectionID ='$sectionID'");
$counter = 1;
$studentlist = '<div class="col-3">';
$gotosecondrow = true;
$gotothirdrow = true;
$gotofourthrow = true;

if (mysqli_num_rows($fetchSLData) == 0) {
    $studentlist .= '<small>List is currently empty</small></div>';
}

while($StudentData = mysqli_fetch_assoc($fetchSLData)) {
    if ($counter > 12 && $gotosecondrow == true){
            $studentlist .= '</div>
            <div class="col-3">
            ';
            $gotosecondrow = false;
    }
    if ($counter > 24 && $gotothirdrow == true){
        $studentlist .= '</div>
        <div class="col-3">
        ';
        $gotothirdrow = false;
    }
    if ($counter > 36 && $gotofourthrow == true){
        $studentlist .= '</div>
        <div class="col-3">
        ';
        $gotofourthrow = false;
    }

        //$studentlist .= '<small style="font-size: 13px;">'.$counter.'.&nbsp&nbsp&nbsp John Smith</small><br>';
        $studentlist .='<div class="row" style="font-size: 14px;">
                            <div class="col-3">
                                <small>'.$counter.'.</small>
                            </div>
                            <div class="col-9">
                                <small>'.$Studentname.'</small>
                            </div>
                        </div>';
    $counter++;
}

// while($counter <= 48) {
//     if ($counter > 12 && $gotosecondrow == true){
//         $studentlist .= '</div>
//         <div class="col-3">
//         ';
//         $gotosecondrow = false;
// }
// if ($counter > 24 && $gotothirdrow == true){
//     $studentlist .= '</div>
//     <div class="col-3">
//     ';
//     $gotothirdrow = false;
// }
// if ($counter > 36 && $gotofourthrow == true){
//     $studentlist .= '</div>
//     <div class="col-3">
//     ';
//     $gotofourthrow = false;
// }

//     $studentlist .='<div class="row" style="font-size: 14px;">
//                         <div class="col-3">
//                             <small>'.$counter.'.</small>
//                         </div>
//                         <div class="col-9">
//                             <small>John Smith</small>
//                         </div>
//                     </div>';
    
//     $counter++;
// }





echo '<div class="container border shadow py-3 bg-gradient-primary">
<form action="AddStudentsToSection.php" method="POST" class="mx-4">
    <h5 class="text-white">Student List</h5>
    <div class="row">
        <div class="col">
            <small class="text-white">Section</small>
            <input type="text" class="form-control" value="'.$sectionname.'" disabled>
        </div>
    </div>
    <!--<div class="row">
        <div class="col">
            <small class="text-white">Enrolled Students ('.$strandname.')</small>
            <select class="form-select" name="student">
                '.$studentlist_dropdown.'
            </select>
        </div>
    </div>-->

    <div class="row mt-2">
        <div class="col">
            <small class="text-white">Student List</small>
            <div class="row bg-white mx-1 p-2" style="border-radius: 7px;">
                
                    '.$studentlist.'
                    
   
            </div>
        </div>
    </div>
    <div class="row mt-3 d-flex justify-content-end">
        <div class="col-3">
            <button type="button" class="btn btn-outline-light w-100" onclick="hideStudentList()">Close</button>
        </div>
    </div>
    
</form>
</div>';
?>
