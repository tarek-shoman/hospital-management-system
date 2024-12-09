<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $jID = $_POST['j-id'];
        $job = $_POST['job'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("REPLACE INTO jobs(job_id, job_title, user_userid)
        VALUES(?,?,?)");
        $stmt -> execute([$jID, $job, $userID]);
        header("location:jobs.php");
    
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Jobs</div>

    <?php
        $j_id = $_GET['job-id'];
        $job_info = $conn -> query("SELECT * FROM jobs
        WHERE job_id = $j_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type="hidden" name="j-id" value="<?php echo $job_info[0]['job_id']; ?>">

            <div>
                <input type="text" name="job" autocomplete="off" value="<?php echo $job_info[0]['job_title']; ?>">
            </div>
            <div>
                <input type="submit" value="Add Job">
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