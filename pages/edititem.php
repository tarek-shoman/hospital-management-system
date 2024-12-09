<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";


    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $item_id = $_POST['i-id'];
        $item = $_POST['item'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $uploaded_image = $_FILES['upload-image'];
        $old_path = $_POST['old-path'];

        if( $uploaded_image['size'] > 0){
            // create destination to save image 
            $item_destination = dirname(__FILE__, 2) . "/" . "uploaded_files/" . $uploaded_image['name'];
            //  create image path to save in db
            $image_path = "../uploaded_files" . "/" . $uploaded_image['name'];
            unlink($old_path);
            move_uploaded_file($uploaded_image['tmp_name'], $item_destination);
                $stmt = $conn -> prepare("REPLACE INTO items(item_id, item_name, item_price, item_quantity,
                item_photo) VALUES(?,?,?,?,?)");
                $stmt -> execute([$item_id,$item, $price, $quantity, $image_path]);
        }
        else{
            $stmt = $conn -> prepare("REPLACE INTO items(item_id, item_name, item_price, item_quantity,
            item_photo) VALUES(?,?,?,?,?)");
            $stmt -> execute([$item_id,$item, $price, $quantity, $old_path]);
        }

        header("location:item.php");
    }


    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Items</div>

    <?php
        $i_id = $_GET['item-id'];
        $item_info = $conn -> query("SELECT * FROM items 
        WHERE item_id = $i_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="i-id" value="<?php echo $item_info[0]['item_id'] ?>">

            <div>
                <span>Item Name:</span>
                <input type="text" name="item" placeholder="item name" autocomplete="off" value="<?php echo $item_info[0]['item_name'] ?>">
            </div>

            <div>
                <span>Item Price:</span>
                <input type="number" name="price" placeholder="item price" autocomplete="off" value="<?php echo $item_info[0]['item_price'] ?>">
            </div>

            <div>
                <span>Item Quantity:</span>
                <input type="number" name="quantity" placeholder="item quantity" autocomplete="off" value="<?php echo $item_info[0]['item_quantity'] ?>">
            </div>

            <div>
                <span>Item Photo:</span>
                <input type="file" name="upload-image">
                <input type="hidden" name="old-path" value="<?php echo $item_info[0]['item_photo'] ?>">
            </div>

            <div>
                <input type="submit" value="Edit Item">
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