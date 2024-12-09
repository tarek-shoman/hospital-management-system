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
    <div class="page-title">Employees</div>

    <!-- search box -->
    <div class="search-box">
        <div class="search">
            <input type="search" id="employee" placeholder="search" autocomplete="off">
        </div>
        <div class="add">
            <a href="addemp.php"> Add Employee</a>
        </div>
    </div>

    <!-- table -->
    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>Employee</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>National ID</th>
                <th>Address</th>
                <th>Added By</th>
                <?php if($_SESSION['usertype'] == 'admin'): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
                
            <?php
                $get_records = $conn -> query("SELECT emp_id, emp_name, job_title, dept_name, salary,
                hire_date, emp_mob, emp_email, emp_age, emp_gender, national_id, emp_address, user_username
                 FROM (((( employees
                           INNER JOIN jobs USING(job_id))
                           INNER JOIN departments USING(dept_id))
                           CROSS JOIN contacts ON employees.emp_id = contacts.con_id)
                           INNER JOIN users ON employees.user_userid = users.user_userid)
                WHERE emp_active = 1");
                while($row = $get_records -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['emp_name']; ?></td>
                    <td><?php echo $row['job_title']; ?></td>
                    <td><?php echo $row['dept_name']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td><?php echo $row['hire_date']; ?></td>
                    <td><?php echo $row['emp_mob']; ?></td>
                    <td><?php echo $row['emp_email']; ?></td>
                    <td><?php echo $row['emp_age']; ?></td>
                    <td><?php echo $row['emp_gender']; ?></td>
                    <td><?php echo $row['national_id']; ?></td>
                    <td><?php echo $row['emp_address']; ?></td>
                    <td><?php echo $row['user_username']; ?></td>
                    <?php if($_SESSION['usertype'] == 'admin'): ?>
                        <td class="e">
                            <form action="editemp.php" method="GET">
                                <input type="hidden" name="emp-id" value="<?php echo $row['emp_id'];?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>

                        <td class="trash">
                            <form action="delemp.php" method="GET">
                                <input type="hidden" name="emp-id" value="<?php echo $row['emp_id'];?>">
                                <button>
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                <?php endif; ?>
                </tr>
            <?php endwhile; ?>

        </table>
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->
<script src="../master/js/emp_search.js"></script>

<?php
    include "../master/sections/end.php";
?>