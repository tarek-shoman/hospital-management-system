<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Patient Report</div>
    <div class="report-box">
        Patients Visit Us From <input type="date" id="from"> To <input type="date" id="to">:
    </div>
    <div class="tab" id="report-result">

    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->
<script src="../master/js/pat_rep.js"></script>

<?php
    include "../master/sections/end.php";
?>