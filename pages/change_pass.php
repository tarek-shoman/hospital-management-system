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
    <div class="page-title">DashBoard</div>
    <?php
        $user_id = $_SESSION['userid'];
        $get_old_pass = $conn -> query("SELECT user_password FROM
        users WHERE user_userid = $user_id") -> fetchAll(PDO::FETCH_COLUMN);
    ?>
    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <span>Current Password</span>
                <input type="password" name="old-pass" autocomplete="off" value="<?php echo $get_old_pass[0]; ?>" disabled>
            </div>
            <div>
                <span>New Password</span>
                <input type="password" name="new-pass" placeholder="enter new password" autocomplete="off">
            </div>
            <div>
                <input type="submit" value="Change Password">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $pass = $_POST['new-pass'];
                if(empty($pass)){
                    echo '<div class="error">Enter password to Chnage password</div>';
                }
                else{
                    $sql = "UPDATE users SET user_password = '$pass' WHERE user_userid = $user_id";
                    $conn -> exec($sql);
                    header("location:out.php");
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