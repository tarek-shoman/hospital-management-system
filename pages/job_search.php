<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$search_value = $_GET['q'];

?>

<table>
    <tr>
        <th>ID</th>
        <th>Job Title</th>
        <th>Added By</th>
        <?php if($_SESSION['usertype'] == 'admin'): ?>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif; ?>
    </tr>
        
    <?php
        $get_records = $conn -> query("SELECT job_id, job_title, user_username
        FROM jobs INNER JOIN users USING(user_userid)
        WHERE job_active = 1 AND job_title LIKE('$search_value%')");
        while($row = $get_records -> fetch()):
    ?>
        <tr>
            <td><?php echo $row['job_id']; ?></td>
            <td><?php echo $row['job_title']; ?></td>
            <td><?php echo $row['user_username']; ?></td>
            <?php if($_SESSION['usertype'] == 'admin'): ?>
                <td class="e">
                    <form action="editjob.php" method="GET">
                        <input type="hidden" name="job-id" value="<?php echo $row['job_id'];?>">
                        <button>
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                </td>

                <td class="trash">
                    <form action="deljob.php" method="GET">
                        <input type="hidden" name="job-id" value="<?php echo $row['job_id'];?>">
                        <button>
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
        <?php endif; ?>
        </tr>
    <?php endwhile; ?>

</table>