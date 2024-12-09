<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $eID = $_POST['e-id'];
        $emp = $_POST['emp'];
        $job = $_POST['job-id'];
        $dept = $_POST['dept-id'];
        $salary = $_POST['salary'];
        $hd = $_POST['hd'];
        $mob = $_POST['mob'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $nid = $_POST['nid'];
        $address = $_POST['address'];
        $userID = $_SESSION['userid'];
        $stmt1 = $conn -> prepare("REPLACE INTO contacts(con_id , emp_mob, emp_email, emp_address) 
        VALUES(?,?,?,?)");
        $stmt1 -> execute([$eID, $mob, $email, $address]);
        $stmt2 = $conn -> prepare("REPLACE INTO employees(emp_id, emp_name, job_id, dept_id, salary,
        hire_date, emp_age, emp_gender, national_id, user_userid) 
        VALUES(?,?,?,?,?,?,?,?,?,?)");
        $stmt2 -> execute([$eID,$emp, $job, $dept, $salary, $hd, $age, $gender, $nid, $userID]);
        header("location:emp.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Employees</div>

    <?php
        $e_id = $_GET['emp-id'];
        echo $e_id;
        $emp_info = $conn -> query("SELECT * FROM employees 
        WHERE emp_id = $e_id") -> fetchAll(PDO::FETCH_ASSOC);
        $con_info = $conn -> query("SELECT * FROM contacts 
        WHERE con_id = $e_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type="hidden" name="e-id" value="<?php echo $emp_info[0]['emp_id']; ?>">

            <div>
                <span>Employee Name</span>
                <input type="text" name="emp" autocomplete="off" value="<?php echo $emp_info[0]['emp_name']; ?>">
            </div>
            <div>
                <span>Jobt Title</span>
                <select name="job-id">
                    <?php
                        $jobs_data = $conn -> query("SELECT job_id, job_title
                        FROM jobs WHERE job_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach($jobs_data as $key => $value){
                            if( $key == $emp_info[0]['job_id'] ){
                                echo "<option value=\"$key\" selected=\"selected\">$value</option>";
                            }
                            else{
                                echo "<option value=\"$key\">$value</option>";
                            }
 
                        }
                    ?>
                </select>
            </div>
            
            <div>
                <span>Department</span>
                <select name="dept-id">
                    <?php
                        $dept_data = $conn -> query("SELECT dept_id, dept_name
                        FROM departments WHERE dept_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach($dept_data as $key => $value){
                            if( $key == $emp_info[0]['dept_id'] ){
                                echo "<option value=\"$key\" selected=\"selected\">$value</option>";
                            }
                            else{
                                echo "<option value=\"$key\">$value</option>";
                            }
                        }
                    ?>
                </select>
            </div>

            
            <div>
                <span>Salary</span>
                <input type="number" name="salary" autocomplete="off" value="<?php echo $emp_info[0]['salary']; ?>">
            </div>

            <div>
                <span>Hire Date</span>
                <input type="date" name="hd" autocomplete="off" value="<?php echo $emp_info[0]['hire_date']; ?>">
            </div>

            <div>
                <span>Mobile</span>
                <input type="number" name="mob" autocomplete="off" value="<?php echo $con_info[0]['emp_mob']; ?>">
            </div>

            <div>
                <span>Email</span>
                <input type="text" name="email" autocomplete="off" value="<?php echo $con_info[0]['emp_email']; ?>">
            </div>

            <div>
                <span>Age</span>
                <input type="number" name="age" autocomplete="off" value="<?php echo $emp_info[0]['emp_age']; ?>">
            </div>

            <div>
                <span>Gender</span>
                <select name="gender">
                    <option value="male" <?php if($emp_info[0]['emp_gender'] == 'male'){echo 'selected="selected"';}?>>Male</option>
                    <option value="female" <?php if($emp_info[0]['emp_gender'] == 'female'){echo 'selected="selected"';}?>>Female</option>
                </select>
            </div>

            <div>
                <span>National ID</span>
                <input type="number" name="nid" autocomplete="off" value="<?php echo $emp_info[0]['national_id']; ?>">
            </div>

            <div>
                <span>Address</span>
                <input type="text" name="address" autocomplete="off" value="<?php echo $con_info[0]['emp_address']; ?>">
            </div>

            <div>
                <input type="submit" value="Edit Employee">
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