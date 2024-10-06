<?php
if (isset($_SESSION['action-error'])) {
    echo '<div class="alert" role="alert" id="error-AlertDialog">
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-center">'.$_SESSION['action-error'].'</p>
            </div>
        </div>
    </div>';
}
unset($_SESSION['action-error']);


if (isset($_SESSION['action-success'])) {
   echo' <div class="alert" role="alert" id="success-AlertDialog">
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-center">'.$_SESSION['action-success'].'</p>
            </div>
        </div>
    </div>';
}
unset($_SESSION['action-success']);
?>
