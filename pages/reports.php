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
    <div class="page-title">Reports</div>

    <div class="widgets">
    <div class="widget-1">
        <a href="pat_report.php">Patients</a>
    </div>

    <div class="widget-2">
        
    </div>

    <div class="widget-3">

    </div>

    <div class="widget-4">

    </div>

    <div class="widget-5">

    </div>

    <div class="widget-6">

    </div>

</div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->

<?php
    include "../master/sections/end.php";
?>