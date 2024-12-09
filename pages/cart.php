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
    <div class="page-title">Cart</div>

        <!-- search box -->
        <div class="search-box">
        <div class="search">
            <input type="search" id="dept" placeholder="search" autocomplete="off">
        </div>

    </div>

    <!-- table -->
    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
                
            <?php
                $userID = $_SESSION['userid'];
                $get_records = $conn -> query("SELECT cart_id, item_id, item_name, item_price
                FROM cart INNER JOIN items USING(item_id)
                WHERE user_userid = $userID");
                while($row = $get_records -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['item_id']; ?></td>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['item_price']; ?></td>
                
                    <td class="e">
                        <form action="editcart.php" method="GET">
                            <input type="hidden" name="cart-id" value="<?php echo $row['cart_id'];?>">
                            <button>
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                    </td>

                    <td class="trash">
                        <form action="delcart.php" method="GET">
                            <input type="hidden" name="cart-id" value="<?php echo $row['cart_id'];?>">
                            <button>
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>

                </tr>
                <?php endwhile;?>
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