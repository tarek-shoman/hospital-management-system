<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $dID = $_POST['d-id'];
        $dept = $_POST['dept'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("REPLACE INTO departments(dept_id, dept_name, user_userid)
        VALUES(?,?,?)");
        $stmt -> execute([$dID, $dept, $userID]);
        header("location:dept.php");
        
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Departments</div>

    <?php
        $d_id = $_GET['dept-id'];
        $dept_info = $conn -> query("SELECT * FROM departments
        WHERE dept_id = $d_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="d-id" value="<?php echo $dept_info[0]['dept_id']; ?>">
            <div>
                <input type="text" name="dept" autocomplete="off" value="<?php echo $dept_info[0]['dept_name']; ?>">
            </div>
            <div>
                <input type="submit" value="Edit Department">
            </div>
        </form>

        <?php

        ?>
    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->

<?php
    include "../master/sections/end.php";
?>