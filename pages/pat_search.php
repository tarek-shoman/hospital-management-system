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
        <th>Patient</th>
        <th>Phone</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Treatment Doctor</th>
        <th>Added By</th>
        <?php if($_SESSION['usertype'] == 'admin'): ?>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif; ?>
    </tr>
        
    <?php
        $get_records = $conn -> query("SELECT pat_id, pat_name, pat_mob, pat_age, 
        pat_gender, treat_name, user_username
        FROM (( patients
                INNER JOIN treat_doctors USING(treat_id))
                INNER JOIN users ON patients.user_userid = users.user_userid)
        WHERE pat_active = 1 AND pat_mob LIKE('$search_value%')");
        while($row = $get_records -> fetch()):
    ?>
        <tr>
            <td><?php echo $row['pat_name']; ?></td>
            <td><?php echo $row['pat_mob']; ?></td>
            <td><?php echo $row['pat_age']; ?></td>
            <td><?php echo $row['pat_gender']; ?></td>
            <td><?php echo $row['treat_name']; ?></td>
            <td><?php echo $row['user_username']; ?></td>
            <?php if($_SESSION['usertype'] == 'admin'): ?>
                <td class="e">
                    <form action="editpat.php" method="GET">
                        <input type="hidden" name="pat-id" value="<?php echo $row['pat_id'];?>">
                        <button>
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                </td>

                <td class="trash">
                    <form action="delpat.php" method="GET">
                        <input type="hidden" name="pat-id" value="<?php echo $row['pat_id'];?>">
                        <button>
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
        <?php endif; ?>
        </tr>
    <?php endwhile; ?>

</table>