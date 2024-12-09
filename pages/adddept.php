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
    <div class="page-title">Departments</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <input type="text" name="dept" placeholder="department name" autocomplete="off">
            </div>
            <div>
                <input type="submit" value="Add Department">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $dept = $_POST['dept'];
                $userID = $_SESSION['userid'];
                if( empty($dept) ){
                    echo '<div class="error">Enter department name to save.</div>';
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO departments(dept_name, user_userid)
                    VALUES(?,?)");
                    $stmt -> execute([$dept, $userID]);
                    header("location:dept.php");
                }
            }
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