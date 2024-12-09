<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $pID = $_POST['p-id'];
        $pat = $_POST['pat'];
        $mob = $_POST['mob'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $treatID = $_POST['treat-id'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("REPLACE INTO patients(pat_id, pat_name, pat_mob, pat_age,
        pat_gender, treat_id, user_userid) VALUES(?,?,?,?,?,?,?)");
        $stmt -> execute([$pID, $pat, $mob, $age, $gender, $treatID, $userID]);
        header("location:pat.php");
        
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Patients</div>
    
    <?php
        $p_id = $_GET['pat-id'];
        $pat_info = $conn -> query("SELECT * FROM patients 
        WHERE pat_id = $p_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type="hidden" name="p-id" value="<?php echo $pat_info[0]['pat_id'] ; ?>">

            <div>
                <span>Patient Name</span>
                <input type="text" name="pat" autocomplete="off" value="<?php echo $pat_info[0]['pat_name'] ; ?>">
            </div>
            <div>
                <span>Mobile</span>
                <input type="number" name="mob" autocomplete="off" value="<?php echo $pat_info[0]['pat_mob'] ; ?>">
            </div>
            <div>
                <span>Age</span>
                <input type="number" name="age" autocomplete="off" value="<?php echo $pat_info[0]['pat_age'] ; ?>">
            </div>
            <div>
                <span>Gender</span>
                <select name="gender">
                    <option value="male" <?php if( $pat_info[0]['pat_gender'] == 'male' ){ echo 'selected="selected"';} ?>>Male</option>
                    <option value="female" <?php if( $pat_info[0]['pat_gender'] == 'female' ){ echo 'selected="selected"';} ?>>Female</option>
                </select>
            </div>
            <div>
                <span>Section</span>
                <select name="treat-id">
                    <?php
                        $sections_data = $conn -> query("SELECT treat_id, treat_name
                        FROM treat_doctors WHERE treat_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach($sections_data as $key => $value){
                            if( $key == $pat_info[0]['treat_id'] ){
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
                <input type="submit" value="Edit Patient">
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