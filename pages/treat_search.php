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
        <th>Doctor Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Section</th>
        <th>Added By</th>
        <?php if($_SESSION['usertype'] == 'admin'): ?>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif; ?>
    </tr>
        
    <?php
        $get_records = $conn -> query("SELECT treat_id, treat_name, treat_mob, treat_address, 
        treat_gender, section_name, user_username
        FROM (( treat_doctors
                INNER JOIN sections USING(section_id))
                INNER JOIN users ON treat_doctors.user_userid = users.user_userid)
        WHERE treat_active = 1 AND treat_name LIKE('$search_value%')");
        while($row = $get_records -> fetch()):
    ?>
        <tr>
            <td><?php echo $row['treat_name']; ?></td>
            <td><?php echo $row['treat_mob']; ?></td>
            <td><?php echo $row['treat_address']; ?></td>
            <td><?php echo $row['treat_gender']; ?></td>
            <td><?php echo $row['section_name']; ?></td>
            <td><?php echo $row['user_username']; ?></td>
            <?php if($_SESSION['usertype'] == 'admin'): ?>
                <td class="e">
                    <form action="edittreat.php" method="GET">
                        <input type="hidden" name="treat-id" value="<?php echo $row['treat_id'];?>">
                        <button>
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                </td>

                <td class="trash">
                    <form action="deltreat.php" method="GET">
                        <input type="hidden" name="treat-id" value="<?php echo $row['treat_id'];?>">
                        <button>
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
        <?php endif; ?>
        </tr>
    <?php endwhile; ?>

    </table>