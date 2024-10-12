<?php
require '../shared/header_student.php';
?>


<!-- Begin Page Content -->
<div class="container-fluid">

<?php require '../shared/action-message.php'; ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admission</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">        
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Admission Details</h6>
                    </div>
                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">

                        </div>
                </div>
            </div>

    </div>
    <!-- End of Main Content -->
    <script>
        var exampleModal = document.getElementById('modal-View')
        exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var enrollmentID = button.getAttribute('data-bs-enrollmentID');
        
        var enrollmentIDHidden = exampleModal.querySelector('#enrollmentID_hidden'); 

        enrollmentIDHidden.value = enrollmentID;

        var paymentOptionDropdown = exampleModal.querySelector('#paymentmode');
        var qrPreview = exampleModal.querySelector('#qr-preview');

        paymentOptionDropdown.addEventListener("change", function() {
            var paymentOptionValue = paymentOptionDropdown.value;

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var src = this.responseText;

                        if (src != "") {
                            qrPreview.style.display = "block";
                            qrPreview.src = src;
                        }
                        else {
                            qrPreview.style.display = "none";
                        }
                    }
                };
            ajax.open("GET", "../ajax/Student_getQRurl.php?ID="+paymentOptionValue, true);
            ajax.send();

            });
        


    });
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>