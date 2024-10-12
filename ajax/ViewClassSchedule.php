<?php 
$conn = require '../config/config.php';

$classID = $_GET['ID'];
$operator = $_GET['operator'];
$fetchData = mysqli_query($conn, "SELECT * FROM classschedule cs
LEFT JOIN sections ss ON cs.sectionID = ss.sectionID
LEFT JOIN strands st ON ss.strandID = st.strandID WHERE classID = '$classID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$classID = $DataArray['classID'];
$strandID = $DataArray['strandID'];
$sectionID = $DataArray['sectionID'];
$syID = $DataArray['schoolYearID'];
$strandSubjectID = $DataArray['strandSubjectID'];
$dayID = $DataArray['dayID'];
$starttime = $DataArray['starttime'];
$endtime = $DataArray['endtime'];

$sectiondropdowntext = '';
$subjectdropdowntext = '';
$sydropdowntext = '';
$daydropdowntext = '';

$fetchQuery3 = "SELECT * FROM sections ss LEFT JOIN strands st ON ss.strandID = st.strandID WHERE ss.isactive = 'Yes' ORDER BY ss.gradelevel ASC, st.abbreviation ASC, ss.sectionname ASC";
$fetchedData3 = mysqli_query($conn, $fetchQuery3);
while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
    if ($DataArray3['sectionID'] == $sectionID) {
        $sectiondropdowntext .='<option value="' . $DataArray3['sectionID'] . '" selected>' . $DataArray3['abbreviation'].' '.$DataArray3['gradelevel'].' - '.$DataArray3['sectionname'] . '</option>';
    }
    else {
        $sectiondropdowntext .='<option value="' . $DataArray3['sectionID'] . '">' . $DataArray3['abbreviation'].' '.$DataArray3['gradelevel'].' - '.$DataArray3['sectionname'] . '</option>';
    }
}

$fetchQuery3 = "SELECT * FROM schoolyear WHERE isactive = 'Yes' ORDER BY schoolyearname ASC";
$fetchedData3 = mysqli_query($conn, $fetchQuery3);
while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
    if ($DataArray3['schoolYearID'] == $syID) {
        $sydropdowntext .= '<option value="' . $DataArray3['schoolYearID'] . '" selected>' . $DataArray3['schoolyearname'].' ('.date('M d, Y',strtotime($DataArray3['startdate'])).' to '.date('M d, Y',strtotime($DataArray3['enddate'])). ')</option>';
    }
    else {
        $sydropdowntext .= '<option value="' . $DataArray3['schoolYearID'] . '">' . $DataArray3['schoolyearname'].' ('.date('M d, Y',strtotime($DataArray3['startdate'])).' to '.date('M d, Y',strtotime($DataArray3['enddate'])). ')</option>';
    }
}

$fetchQuery3 = "SELECT * FROM days";
$fetchedData3 = mysqli_query($conn, $fetchQuery3);
while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
    if ($DataArray3['dayID'] == $dayID) {
        $daydropdowntext .= '<option value="' . $DataArray3['dayID'] . '" selected>' . $DataArray3['dayname'] . '</option>';
    }
    else {
        $daydropdowntext .= '<option value="' . $DataArray3['dayID'] . '">' . $DataArray3['dayname'] . '</option>';
    } 
}

$fetchQuery3 = "SELECT * FROM strandsubjects ss LEFT JOIN subjects sb ON ss.subjectID = sb.subjectID WHERE ss.isactive = 'Yes' AND ss.strandID = '$strandID' ORDER BY sb.subjectname ASC";
$fetchedData3 = mysqli_query($conn, $fetchQuery3);
while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
    if ($DataArray3['strandSubjectID'] == $strandSubjectID) {
        $subjectdropdowntext .= '<option value="' . $DataArray3['strandSubjectID'] . '" selected>' . $DataArray3['subjectname'] . '</option>';
    }
    else {
        $subjectdropdowntext .= '<option value="' . $DataArray3['strandSubjectID'] . '">' . $DataArray3['subjectname'] . '</option>';
    } 
}


echo '<form action="../processes/EditClassSchedule.php" method="POST">
        <div class="form-group">
            <label for="section">Section</label>
            <select class="form-select w-100" name="section" id="e-sectiondropdown" required>
                '.$sectiondropdowntext.'
            </select>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select class="form-select w-100" name="sy" id="e-sydropdown" required>
                '.$sydropdowntext.'
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <select class="form-select w-100" name="strandsubject" id="e-subjectdropdown" required>
                '.$subjectdropdowntext.'
            </select>
        </div>
        <div class="form-row mb-3">
            <div class="col">
            <label for="day">Day</label>
            <select class="form-select w-100" name="day" id="e-daydropdown" required>
                '.$daydropdowntext.'
            </select>
            </div> 
        </div>
        <div class="form-row">
            <div class="col">
                <label for="end-time">Start Time</label>
                <input type="time" class="form-control" id="e-starttime" name="starttime" value="'.$starttime.'" required>
            </div>
            <div class="col">
                <label for="end-time">End Time</label>
                <input type="time" class="form-control" id="e-endtime" name="endtime" value="'.$endtime.'" required>  
            </div>  
        </div>
        <div class="row mt-3">
            <center>
                <div class="row">
                        <input type="hidden" value="'.$classID.'" name="classID">
                        <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                        <button class="btn btn-success" id="page-btn" name="'.$operator.'EditClassSchedule" style="width:50%;">Submit</button>
                </div>
            </center>
        </div>
    </form>';
?>