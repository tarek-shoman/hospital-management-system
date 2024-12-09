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
    <div class="page-title">Items</div>

    <!-- search box -->
    <div class="search-box">
        <div class="search">
            <input type="search" id="item" placeholder="search" autocomplete="off">
        </div>
        <div class="add">
            <a href="additem.php"> Add Item</a>
        </div>
    </div>

    <div class="gallery">
        <?php
            $get_records = $conn -> query("SELECT * FROM items");
            while($row = $get_records -> fetch()):
        ?>
            <div>
                <input type="hidden" class="p-id" value="<?php echo $row['item_id']?>">
                <img src="<?php echo $row['item_photo'] ; ?>">
                <div class="item-name"><?php echo $row['item_name'] ; ?></div>
                <div class="item-price"><?php echo $row['item_price'] ; ?></div>
                <div class="i-e">
                    <form action="edititem.php" method="GET">
                        <input type="hidden" name="item-id" value="<?php echo $row['item_id'] ; ?>">
                        <button><i class="fas fa-edit"></i></button>
                    </form>
                </div>
                <div class="add-cart">Add TO Cart</div>
                <!-- <a href="<?php //echo $row['item_photo'] ; ?>" target="_blank">Image</a> -->
            </div>
        <?php endwhile; ?>
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->
<script src="../master/js/cart.js"></script>

<?php
    include "../master/sections/end.php";
?>