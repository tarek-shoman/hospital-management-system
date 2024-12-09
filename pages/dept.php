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

        <!-- search box -->
        <div class="search-box">
        <div class="search">
            <input type="search" id="dept" placeholder="search" autocomplete="off">
        </div>
        <div class="add">
            <a href="adddept.php"> Add Department</a>
        </div>
    </div>

    <!-- table -->
    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>ID</th>
                <th>Department</th>
                <th>Added By</th>
                <?php if($_SESSION['usertype'] == 'admin'): ?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
                
            <?php
                $get_records = $conn -> query("SELECT dept_id, dept_name, user_username
                FROM departments INNER JOIN users USING(user_userid)
                WHERE dept_active = 1");
                while($row = $get_records -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['dept_id']; ?></td>
                    <td><?php echo $row['dept_name']; ?></td>
                    <td><?php echo $row['user_username']; ?></td>
                    <?php if($_SESSION['usertype'] == 'admin'): ?>
                        <td class="e">
                            <form action="editdept.php" method="GET">
                                <input type="hidden" name="dept-id" value="<?php echo $row['dept_id'];?>">
                                <button>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                        </td>

                        <td class="trash">
                            <form action="deldept.php" method="GET">
                                <input type="hidden" name="dept-id" value="<?php echo $row['dept_id'];?>">
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
<script src="../master/js/dept_search.js"></script>

<?php
    include "../master/sections/end.php";
?>