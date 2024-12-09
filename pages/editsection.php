<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin'){
        header("location:out.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $sID = $_POST['s-id'];
        $secion = $_POST['section'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("REPLACE INTO sections(section_id, section_name, user_userid)
        VALUES(?,?,?)");
        $stmt -> execute([$sID, $secion, $userID]);
        header("location:section.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Sections</div>

    <?php
        $s_id = $_GET['section-id'];
        $section_info = $conn -> query("SELECT * FROM sections
        WHERE section_id = $s_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <input type="hidden" name="s-id" value="<?php echo $section_info[0]['section_id']; ?>">
                <input type="text" name="section"  autocomplete="off" value="<?php echo $section_info[0]['section_name']; ?>">
            </div>
            <input type="submit" value="Edit Section">
        </form>

    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->

<?php
    include "../master/sections/end.php";
?>