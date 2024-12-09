<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
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
        $stmt1 = $conn -> prepare("INSERT INTO contacts(emp_mob, emp_email, emp_address) 
        VALUES(?,?,?)");
        $stmt1 -> execute([$mob, $email, $address]);
        $stmt2 = $conn -> prepare("INSERT INTO employees(emp_name, job_id, dept_id, salary,
        hire_date, emp_age, emp_gender, national_id, user_userid) 
        VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt2 -> execute([$emp, $job, $dept, $salary, $hd, $age, $gender, $nid, $userID]);
        header("location:emp.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Employees</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <span>Employee Name</span>
                <input type="text" name="emp" placeholder="employee name" autocomplete="off">
            </div>
            <div>
                <span>Jobt Title</span>
                <select name="job-id">
                    <?php
                        $job_obj -> data_select();
                    ?>
                </select>
            </div>
            
            <div>
                <span>Department</span>
                <select name="dept-id">
                    <?php
                        $dept_obj -> data_select();
                    ?>
                </select>
            </div>

            
            <div>
                <span>Salary</span>
                <input type="number" name="salary" placeholder="salary" autocomplete="off">
            </div>

            <div>
                <span>Hire Date</span>
                <input type="date" name="hd" autocomplete="off">
            </div>

            <div>
                <span>Mobile</span>
                <input type="number" name="mob" placeholder="mobile" autocomplete="off">
            </div>

            <div>
                <span>Email</span>
                <input type="text" name="email" placeholder="email" autocomplete="off">
            </div>

            <div>
                <span>Age</span>
                <input type="number" name="age" placeholder="age" autocomplete="off">
            </div>

            <div>
                <span>Gender</span>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div>
                <span>National ID</span>
                <input type="number" name="nid" placeholder="nationa ID" autocomplete="off">
            </div>

            <div>
                <span>Address</span>
                <input type="text" name="address" placeholder="address" autocomplete="off">
            </div>

            <div>
                <input type="submit" value="Add Employee">
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