<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $eID = $_POST['e-id']; 
        $exam = $_POST['exam'];
        $price = $_POST['price'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("REPLACE INTO examinations(exam_id, exam_name, 
        exam_price, user_userid) VALUES(?,?,?,?)");
        $stmt -> execute([$eID, $exam, $price, $userID]);
        header("location:exam.php");
        
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Examinations</div>

    <?php
        $e_id = $_GET['exam-id'];
        $exam_info = $conn -> query("SELECT * FROM examinations
        WHERE exam_id = $e_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type="hidden" name="e-id" value="<?php echo $exam_info[0]['exam_id'] ; ?>">

            <div>
                <span>Examination Name:</span>
                <input type="text" name="exam" autocomplete="off" value="<?php echo $exam_info[0]['exam_name'] ; ?>">
            </div>
            <div>
                <span>Examination Price:</span>
                <input type="number" name="price" autocomplete="off" value="<?php echo $exam_info[0]['exam_price'] ; ?>">
            </div>
            <div>
                <input type="submit" value="Edit Examination">
            </div>
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