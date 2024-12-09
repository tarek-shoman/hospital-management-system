<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$search_value = $_GET['q'];

$get_search_record = $conn -> query("SELECT section_id, section_name, user_username
    FROM sections INNER JOIN users USING(user_userid)
    WHERE section_active = 1 AND section_name LIKE('%$search_value%')");

?>

<table>
    <tr>
        <th>ID</th>
        <th>Section</th>
        <th>Added By</th>
        <?php if($_SESSION['usertype'] == 'admin'): ?>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif; ?>
    </tr>
    <?php while($row = $get_search_record -> fetch()): ?>
        <tr>
            <td><?php echo $row['section_id']; ?></td>
            <td><?php echo $row['section_name']; ?></td>
            <td><?php echo $row['user_username']; ?></td>
            <?php if($_SESSION['usertype'] == 'admin'): ?>
                <td class="e">
                    <form action="editsection.php" method="GET">
                        <input type="hidden" name="section-id" value="<?php echo $row['section_id'];?>">
                        <button>
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                </td>

                <td class="trash">
                    <form action="delsection.php" method="GET">
                        <input type="hidden" name="section-id" value="<?php echo $row['section_id'];?>">
                        <button>
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endwhile; ?>
</table>