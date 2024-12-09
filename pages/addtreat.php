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
    <div class="page-title">Treatment Doctors</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <span>Doctor Name</span>
                <input type="text" name="treat" placeholder="doctor name" autocomplete="off">
            </div>
            <div>
                <span>Mobile</span>
                <input type="number" name="mob" placeholder="mobile" autocomplete="off">
            </div>
            <div>
                <span>Address</span>
                <input type="text" name="address" placeholder="address" autocomplete="off">
            </div>
            <div>
                <span>Gender</span>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div>
                <span>Section</span>
                <select name="section-id">
                    <?php
                        $sections_data = $conn -> query("SELECT section_id, section_name
                        FROM sections WHERE section_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach($sections_data as $key => $value){
                            echo "<option value=\"$key\">$value</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Add Doctor">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $treat = $_POST['treat'];
                $mob = $_POST['mob'];
                $address = $_POST['address'];
                $gender = $_POST['gender'];
                $sectionID = $_POST['section-id'];
                $userID = $_SESSION['userid'];
                if( empty($treat) || empty($mob) || empty($address) ){
                    echo '<div class="error">Enter data to save treatment doctor.</div>';
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO treat_doctors(treat_name, treat_mob, treat_address,
                    treat_gender, section_id, user_userid) VALUES(?,?,?,?,?,?)");
                    $stmt -> execute([$treat, $mob, $address, $gender, $sectionID, $userID]);
                    header("location:treat.php");
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