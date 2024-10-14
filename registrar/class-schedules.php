<?php
    require '../shared/header_registrar.php';
?>


<?php require '../shared/action-message.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php require '../shared/action-message.php'; ?>
                    
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Manage Class Schedules</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row" id="page-btn-container">
                                        <div class="col-4">
                                        <button class="btn btn-primary" id="page-btn" data-bs-toggle="modal" data-bs-target="#modal-Add"><i class="bi bi-plus-lg"></i> Add New Schedule</button>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-bordered table-sm w-100" id="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center" id="th"><small>Schedule ID</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Section</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>School Year</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Subject</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Day</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Start Time</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>End Time</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $fetchQuery = "SELECT * FROM classschedule cs 
                                                    left join sections s on s.sectionID = cs.sectionID
                                                    left join schoolyear st on st.schoolYearID = cs.schoolYearID
                                                    left join strandsubjects ss on ss.strandSubjectID = cs.strandSubjectID
                                                    left join subjects sb ON sb.subjectID = ss.subjectID
                                                    left join days d on d.dayID = cs.dayID
                                                    ";
                                                    $fetchedData = mysqli_query($conn, $fetchQuery);

                                                    while ($DataArray = mysqli_fetch_assoc($fetchedData)) {

                                                        
                                                        $ID = $DataArray['classID'];
                                                        $sectionname = $DataArray['gradelevel'].' - '.$DataArray['sectionname'];
                                                        $syname = $DataArray['schoolyearname'];
                                                        $subjectname = $DataArray['subjectname'];
                                                        $dayname = $DataArray['dayname'];
                                                        $starttime = $DataArray['starttime'];
                                                        $endtime = $DataArray['endtime'];
                                                       
                                                        $starttimetext = '';
                                                        $endtimetext = '';
                                                        
                                                        $starttimetext = date('h:i A',strtotime($starttime));
                                                        $endtimetext = date('h:i A',strtotime($endtime));

                                                    ?>
                                                        <tr>
                                                            <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                            <td class="text-center" id="td"><?php echo $sectionname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $syname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $subjectname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $dayname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $starttimetext; ?></td>
                                                            <td class="text-center" id="td"><?php echo $endtimetext; ?></td>
                                                            <td class="text-center" id="td">
                                                                <button class="btn btn-success border-0" title="Edit" id="table-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-Edit"
                                                                    data-bs-classID="<?php echo $ID; ?>">
                                                                    <i class="bi bi-pencil-fill" id="table-btn-icon"></i> <span id="tablebutton-text">Edit</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modals -->
                     <div class="modal fade" id="modal-Edit" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body p-4" style="font-family: Arial;">
                                            <h5>Edit Class Schedule</h5>
                                            <div class="container mb-2" id="edit-container">
                                                
                                            </div>      
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal fade" id="modal-Add" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-4" style="font-family: Arial;">
                                        <h5><b>Class Schedule Information</b></h5>
                                        <div class="container mb-2">
                                            <form action="../processes/AddClassSchedule.php" method="POST">
                                                <div class="form-group">
                                                    <label for="section">Section</label>
                                                    <select class="form-select w-100" name="section" id="sectiondropdown" required>
                                                        <option value="0" disabled selected>--Select a section--</option>
                                                        <?php
                                                        $fetchQuery3 = "SELECT * FROM sections ss LEFT JOIN strands st ON ss.strandID = st.strandID WHERE ss.isactive = 'Yes' ORDER BY ss.gradelevel ASC, st.abbreviation ASC, ss.sectionname ASC";
                                                        $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                        while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                            echo '<option value="' . $DataArray3['sectionID'] . '">' . $DataArray3['abbreviation'].' '.$DataArray3['gradelevel'].' - '.$DataArray3['sectionname'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="semester">School Year</label>
                                                    <select class="form-select w-100" name="sy" id="sydropdown" required>
                                                        <option value="0" disabled selected>--Select a School Year--</option>
                                                        <?php
                                                        $fetchQuery3 = "SELECT * FROM schoolyear WHERE isactive = 'Yes' ORDER BY schoolyearname ASC";
                                                        $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                        while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                            echo '<option value="' . $DataArray3['schoolYearID'] . '">' . $DataArray3['schoolyearname'].' ('.date('M d, Y',strtotime($DataArray3['startdate'])).' to '.date('M d, Y',strtotime($DataArray3['enddate'])). ')</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="subject">Subject</label>
                                                    <select class="form-select w-100" name="strandsubject" id="subjectdropdown" required>
                                                        <option value="0" disabled selected>--Select a subject--</option>
                                                    </select>
                                                </div>
                                                <div class="form-row mb-3">
                                                    <div class="col">
                                                    <label for="day">Day</label>
                                                    <select class="form-select w-100" name="day" id="daydropdown" required>
                                                        <option value="0" disabled selected>--Select a day--</option>
                                                        <?php
                                                        $fetchQuery3 = "SELECT * FROM days";
                                                        $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                        while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                            echo '<option value="' . $DataArray3['dayID'] . '">' . $DataArray3['dayname'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    </div> 
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="end-time">Start Time</label>
                                                        <input type="time" class="form-control" id="starttime" name="starttime" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="end-time">End Time</label>
                                                        <input type="time" class="form-control" id="endtime" name="endtime" required>  
                                                    </div>  
                                                </div>
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" name="RegistrarAddClassSchedule" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>
                                        </div>                         
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#table').DataTable();
    });

    var exampleModal = document.getElementById('modal-Edit');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        //Button that triggered the modal
        var button = event.relatedTarget
        var classID = button.getAttribute('data-bs-classID');
        
        //ajax call 
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var editcontainer = exampleModal.querySelector('#edit-container');
                    editcontainer.innerHTML = this.responseText;
                    
                    var sectiondropdown = exampleModal.querySelector('#e-sectiondropdown');
                    $(sectiondropdown).on('change', function(event) {
                        var sectionID = sectiondropdown.value;
                        $.ajax({
                            url: '../ajax/GetStrandSubjects.php',
                            method: 'GET',
                            data: { id: sectionID }, 
                            dataType: 'json',
                            success: function(data) {
                                // Populate dropdown with options
                                $('#e-subjectdropdown').empty();
                                $('#e-subjectdropdown').append(
                                        $('<option>', {
                                            value: '0',
                                            text: '--Select a Subject--',
                                            disabled: true
                                        })
                                    );
                                data.forEach(function(item) {
                                    $('#e-subjectdropdown').append(
                                        $('<option>', {
                                            value: item.strandSubjectID,
                                            text: item.subjectname 
                                        })
                                    );
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    });
                }
                else {
                    console.log(this.status);
                }
            };
        ajax.open("GET", "../ajax/ViewClassSchedule.php?ID="+classID+"&operator=Registrar", true);
        ajax.send();  
            
    });

    var addModal = document.getElementById('modal-Add');
    addModal.addEventListener('show.bs.modal', function (event) {

       var sectiondropdown = addModal.querySelector('#sectiondropdown');
            $(sectiondropdown).on('change', function(event) {
                var sectionID = sectiondropdown.value;
                $.ajax({
                    url: '../ajax/GetStrandSubjects.php',
                    method: 'GET',
                    data: { id: sectionID }, 
                    dataType: 'json',
                    success: function(data) {
                        // Populate dropdown with options
                        $('#subjectdropdown').empty();
                        $('#subjectdropdown').append(
                                $('<option>', {
                                    value: '0',
                                    text: '--Select a Subject--',
                                    disabled: true
                                })
                            );
                        data.forEach(function(item) {
                            $('#subjectdropdown').append(
                                $('<option>', {
                                    value: item.strandSubjectID,
                                    text: item.subjectname 
                                })
                            );
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
    });

</script>

<?php
    require '../shared/footer.php';
?>
