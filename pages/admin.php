<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin' ){
        header("location:out.php");
    }
    include "../master/sections/connect.php";
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">DashBoard</div>

    <!-- widgets -->
    <div class="widgets">
        <div class="widget-1">
            <span>Patients</span>
            <?php
                $pat_count = $conn -> query("SELECT COUNT(pat_id) 
                FROM patients WHERE pat_active = 1 ") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $pat_count[0]; ?></span>
        </div>

        <div class="widget-2">
            <span>Treatment Doctors</span>
            <?php
                $treat_count = $conn -> query("SELECT COUNT(treat_id) 
                FROM treat_doctors WHERE treat_active = 1 ") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $treat_count[0]; ?></span>
        </div>

        <div class="widget-3">
            <span>Employees</span>
            <?php
                $emp_count = $conn -> query("SELECT COUNT(emp_id) 
                FROM employees WHERE emp_active = 1 ") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $emp_count[0]; ?></span>
        </div>

        <div class="widget-4">
            <span>Invoices</span>
            <?php
                $invoice_count = $conn -> query("SELECT COUNT(invoice_id) 
                FROM invoice WHERE invoice_active = 1 ") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $invoice_count[0]; ?></span>
        </div>

        <div class="widget-5">
            <span>Total Income</span>
            <?php
                $invoices_total = $conn -> query("SELECT SUM(invoice_total) 
                FROM invoice WHERE invoice_active = 1 ") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $invoices_total[0] . " LE."; ?></span>
        </div>

        <div class="widget-6">
        <span>Last Invoice Date</span>
        <?php
                $last_date = $conn -> query("SELECT invoice_date FROM invoice WHERE invoice_active = 1
                ORDER BY invoice_id DESC LIMIT 1 ") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $last_date[0]; ?></span>
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