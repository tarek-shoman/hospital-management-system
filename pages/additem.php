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

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <span>Item Name:</span>
                <input type="text" name="item" placeholder="item name" autocomplete="off">
            </div>

            <div>
                <span>Item Price:</span>
                <input type="number" name="price" placeholder="item price" autocomplete="off">
            </div>

            <div>
                <span>Item Quantity:</span>
                <input type="number" name="quantity" placeholder="item name" autocomplete="off">
            </div>

            <div>
                <span>Item Photo:</span>
                <input type="file" name="upload-image">
            </div>

            <div>
                <input type="submit" value="Add Item">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $item = $_POST['item'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $uploaded_image = $_FILES['upload-image'];
                if( empty($item) || empty($price) || empty($quantity)){
                    echo '<div class="error">Enter data to save item</div>';
                }
                else{

                    // create destination to save image 
                    $item_destination = dirname(__FILE__, 2) . "/" . "uploaded_files/" . $uploaded_image['name'];
                    //  create image path to save in db
                    $image_path = "../uploaded_files" . "/" . $uploaded_image['name'];

                    if( move_uploaded_file($uploaded_image['tmp_name'], $item_destination) ){
                        $stmt = $conn -> prepare("INSERT INTO items(item_name, item_price, item_quantity,
                        item_photo) VALUES(?,?,?,?)");
                        $stmt -> execute([$item, $price, $quantity, $image_path]);
                    }

                    else{
                        echo '<div class="error">Can\'t upload image and save item.</div>';
                    }
                    header("location:item.php");
                }
            }
        ?>
    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->

<?php
    include "../master/sections/end.php";
?>