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
    <div class="page-title">Sections</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <input type="text" name="section" placeholder="section name" autocomplete="off">
            </div>
            <div>
                <input type="submit" value="Add Section">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $section = $_POST['section'];
                $userID = $_SESSION['userid'];
                if( empty($section) ){
                    echo '<div class="error">Enter section name to save.</div>';
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO sections(section_name, user_userid)
                    VALUES(?,?)");
                    $stmt -> execute([$section, $userID]);
                    header("location:section.php");
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