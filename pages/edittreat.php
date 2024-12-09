<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $tID = $_POST['t-id'];
        $treat = $_POST['treat'];
        $mob = $_POST['mob'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $sectionID = $_POST['section-id'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("REPLACE INTO treat_doctors(treat_id, treat_name, treat_mob, treat_address,
        treat_gender, section_id, user_userid) VALUES(?,?,?,?,?,?,?)");
        $stmt -> execute([$t_id, $treat, $mob, $address, $gender, $sectionID, $userID]);
        header("location:treat.php");
    
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Treatment Doctors</div>

    <?php
        $t_id = $_GET['treat-id'];
        $treat_info = $conn -> query("SELECT * FROM treat_doctors 
        WHERE treat_id = $t_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type="hidden" name="t-id" value="<?php echo $treat_info[0]['treat_id'] ; ?>">

            <div>
                <span>Doctor Name</span>
                <input type="text" name="treat"  autocomplete="off" value="<?php echo $treat_info[0]['treat_name'] ; ?>">
            </div>
            <div>
                <span>Mobile</span>
                <input type="number" name="mob" autocomplete="off" value="<?php echo $treat_info[0]['treat_mob'] ; ?>">
            </div>
            <div>
                <span>Address</span>
                <input type="text" name="address"  autocomplete="off" value="<?php echo $treat_info[0]['treat_address'] ; ?>">
            </div>
            <div>
                <span>Gender</span>
                <select name="gender">
                    <option value="male" <?php if( $treat_info[0]['treat_gender'] == 'male' ){ echo 'selected="selected"';} ?>>Male</option>
                    <option value="female" <?php if( $treat_info[0]['treat_gender'] == 'female' ){ echo 'selected="selected"';} ?>>Female</option>
                </select>
            </div>
            <div>
                <span>Section</span>
                <select name="section-id">
                    <?php
                        $sections_data = $conn -> query("SELECT section_id, section_name
                        FROM sections WHERE section_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach($sections_data as $key => $value){
                           if( $key == $treat_info[0]['section_id'] ){
                                echo "<option value=\"$key\" selected=\"selected\">$value</option>";
                           }
                           else{
                                echo "<option value=\"$key\">$value</option>";
                           }
                        }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Edit Doctor">
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