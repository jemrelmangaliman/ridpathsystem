<!-- Sidebar -->
<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<div class="container-fluid bg-white pt-4 pb-4 border shadow">
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-5" href="dashboard.php">
        <div class="row d-flex flex-column mt-5">
            <div class="col">
                <img src="../img/ridpath.jpg" class="img w-100">
            </div>  
        </div>
    </a>
 </div>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Menu
</div>

<!-- Nav Item - Utilities Collapse Menu -->

<li class="nav-item">
    <a class="nav-link" href="profile.php">
        <i class="fas fa-regular fa-user"></i>
        <span>My Profile</span></a>
</li>




<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Manage Enrollment
</div>
<li class="nav-item">
    <a class="nav-link" href="registration.php">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Account Registration</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="examaccess.php">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Examination Access</span></a>
</li>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="bi bi-card-list"></i>
        <span>Enrollment Records</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="forassessment.php">For Assessment</a>
            <a class="collapse-item" href="forbalancesettlement.php">Balance Settlement</a>
            <a class="collapse-item" href="foradmission.php">Admission Confirmation</a>
            <a class="collapse-item" href="enrolled.php">Enrolled</a>
            <a class="collapse-item" href="enrolledwithbalance.php">Enrolled - With Balance</a>
            <a class="collapse-item" href="forresubmission.php">For Resubmission</a>

        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#classCollapse"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="bi bi-card-list"></i>
        <span>Section Management</span>
    </a>
    <div id="classCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="class-schedules.php">Class Schedules</a>
            <a class="collapse-item" href="class-students.php">Section Student List</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reportsCollapse"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="bi bi-card-list"></i>
        <span>Reports</span>
    </a>
    <div id="reportsCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="reports-enrollmentsummary.php">Enrollment Summary</a>
            <a class="collapse-item" href="reports-demographics.php">Demographics</a>
            <a class="collapse-item" href="reports-enrollmentcapacity.php">Enrollment Capacity</a>
        </div>
    </div>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->

</ul>
<!-- End of Sidebar -->