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

    <!-- page title -->
    <div class="page-title">Sections</div>

    <!-- search box -->
    <div class="search-box">
        <div class="search">
            <input type="search" id="section" placeholder="search" autocomplete="off">
        </div>
        <div class="add">
            <a href="addsection.php"> Add Section</a>
        </div>
    </div>

    <!-- table -->
    <div class="tab" id="search-result">
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
                
            <?php
                $get_records = $conn -> query("SELECT section_id, section_name, user_username
                FROM sections INNER JOIN users USING(user_userid)
                WHERE section_active = 1");
                while($row = $get_records -> fetch()):
            ?>
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
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->
<script src="../master/js/section_search.js"></script>

<?php
    include "../master/sections/end.php";
?>