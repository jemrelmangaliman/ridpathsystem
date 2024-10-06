<?php 
$conn = require '../config/config.php';

$strandSubjectID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM strandsubjects ss
                                        LEFT JOIN strands st ON ss.strandID = st.strandID
                                        LEFT JOIN subjects sj ON ss.subjectID = sj.subjectID
                                        WHERE strandSubjectID = '$strandSubjectID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$strandID = $DataArray['strandID'];
$subjectID = $DataArray['subjectID'];
$gradelevel = $DataArray['gradelevel'];
$syID = $DataArray['schoolYearID'];
$status = $DataArray['isactive'];


$isActivetext = '';
$subjectdropdowntext = '';
$stranddropdowntext = '';
$gradeleveldropdowntext = '';
$sydropdowntext = '';

//configure subject options and selected value based on retrieved subjectID on database
$fetchQuery1 = "SELECT * FROM subjects WHERE isactive = 'Yes' ORDER BY subjectname ASC";
$fetchedData1 = mysqli_query($conn, $fetchQuery1);
while ($DataArray1 = mysqli_fetch_assoc($fetchedData1)) {
    if ($DataArray1['subjectID'] == $subjectID) {
        $subjectdropdowntext .= '<option value="' . $DataArray1['subjectID'] . '" selected>' . $DataArray1['subjectname'] . '</option>';
    }
    else {
        $subjectdropdowntext .= '<option value="' . $DataArray1['subjectID'] . '">' . $DataArray1['subjectname'] . '</option>';
    }

}

//configure strand options and selected value based on retrieved strandID on database
$fetchQuery2 = "SELECT * FROM strands WHERE isactive = 'Yes' ORDER BY strandname ASC";
$fetchedData2 = mysqli_query($conn, $fetchQuery2);
while ($DataArray2 = mysqli_fetch_assoc($fetchedData2)) {
    if ($DataArray2['strandID'] == $strandID) {
        $stranddropdowntext .= '<option value="' . $DataArray2['strandID'] . '" selected>' . $DataArray2['strandname'] . '</option>';
    }
    else {
        $stranddropdowntext .=  '<option value="' . $DataArray2['strandID'] . '">' . $DataArray2['strandname'] . '</option>';
    }
}

//configure semester options and selected value based on retrieved semesterID on database
$fetchQuery3 = "SELECT * FROM schoolyear WHERE isactive = 'Yes' ORDER BY schoolyearname ASC";
$fetchedData3 = mysqli_query($conn, $fetchQuery3);
while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
    if ($DataArray3['schoolYearID'] == $syID) {
        $sydropdowntext .= '<option value="' . $DataArray3['schoolYearID'] . '" selected>' . $DataArray3['schoolyearname'].' ('.date('M d, Y',strtotime($DataArray3['startdate'])).' to '.date('M d, Y',strtotime($DataArray3['enddate'])). ')</option>';
    }
    else {
        $sydropdowntext .=  '<option value="' . $DataArray3['schoolYearID'] . '">' . $DataArray3['schoolyearname'].' ('.date('M d, Y',strtotime($DataArray3['startdate'])).' to '.date('M d, Y',strtotime($DataArray3['enddate'])). ')</option>';
    }
}

//configuring grade level dropdown options
if ($gradelevel == '11') {
    $gradeleveldropdowntext .= '
                                <option value="11" selected>Grade 11</option>
                                <option value="12">Grade 12</option>
                                ';
}
else {
    $gradeleveldropdowntext .=  '
                                <option value="11">Grade 11</option>
                                <option value="12" selected>Grade 12</option>
                                ';
}

if ($status == "Yes") {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="yes" value="Yes" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="no" value="No" required>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}
else {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="yes" value="Yes" required>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="no" value="No" required checked>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}


echo '<form action="../processes/Admin_EditStrandSubject.php" method="POST">
            <div class="row mb-1">
                <div class="col">
                    <div class="form-group">
                        <small for="subject">Strand</small>
                        <select class="form-select w-100" name="strand" id="stranddropdown" required>
                            <option value="0" disabled selected>--Select a strand--</option>
                            '.$stranddropdowntext.'
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    <div class="form-group">
                        <small for="subject">Grade Level</small>
                        <select class="form-select w-100" name="gradelevel" id="gradeleveldropdown" required>
                           '.$gradeleveldropdowntext.'
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    <div class="form-group">
                        <small for="subject">School Year</small>
                        <select class="form-select w-100" name="sy" id="sydropdown" required>
                            '.$sydropdowntext.'
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    <div class="form-group">
                        <small for="subject">Subject</small>
                        <select class="form-select w-100" name="subject" id="subjectdropdown" required>
                            <option value="0" disabled selected>--Select a subject--</option>
                            '.$subjectdropdowntext.'
                        </select>
                    </div>
                </div>
            </div>
        
            <div class="row mb-1">
                <small>Is Active</small>
                <div class="col">
                    '.$isActivetext.'
                </div>
            </div>
            <div class="row mt-3">
                <center>
                    <div class="row">
                        <input type="text" class="form-control" name="strandSubjectID" hidden value="'.$strandSubjectID.'">
                            <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                            <button class="btn btn-success" id="page-btn" name="EditStrandSubject" style="width:50%;">Submit</button>
                    </div>
                </center>
            </div>
        </form>';
?>