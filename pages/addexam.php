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
    <div class="page-title">Examinations</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <span>Examination Name:</span>
                <input type="text" name="exam" placeholder="examination name" autocomplete="off">
            </div>
            <div>
                <span>Examination Price:</span>
                <input type="number" name="price" placeholder="examination price" autocomplete="off">
            </div>
            <div>
                <input type="submit" value="Add Examination">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $exam = $_POST['exam'];
                $price = $_POST['price'];
                $userID = $_SESSION['userid'];
                if( empty($exam) || empty($price)){
                    echo '<div class="error">Enter data to dave examination.</div>';
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO examinations(exam_name, exam_price, user_userid)
                    VALUES(?,?,?)");
                    $stmt -> execute([$exam, $price, $userID]);
                    header("location:exam.php");
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