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
    <div class="page-title">Patients</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="form1">
            <div>
                <span>Patient Name</span>
                <input type="text" name="pat" placeholder="patient name" autocomplete="off" class="validate">
                <div class="error hide-show validate-message">Please enter patient name</div>
            </div>
            <div>
                <span>Mobile</span>
                <input type="number" name="mob" placeholder="mobile" autocomplete="off" class="validate">
                <div class="error hide-show validate-message">Please enter patient mobile</div>
            </div>
            <div>
                <span>Age</span>
                <input type="number" name="age" placeholder="age" autocomplete="off" class="validate">
                <div class="error hide-show validate-message">Please enter patient age</div>
            </div>
            <div>
                <span>Gender</span>
                <select name="gender" class="validate">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <div class="error hide-show validate-message">Please select gender</div>
            </div>
            <div>
                <span>Section</span>
                <select name="treat-id" class="validate">
                    <option value="">Select Dcotor</option>
                    <?php
                        $sections_data = $conn -> query("SELECT treat_id, treat_name
                        FROM treat_doctors WHERE treat_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach($sections_data as $key => $value){
                            echo "<option value=\"$key\">$value</option>";
                        }
                    ?>
                </select>
                <div class="error hide-show validate-message">Please select section</div>
            </div>
            <div>
                <input type="submit" value="Add Patient">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $pat = $_POST['pat'];
                $mob = $_POST['mob'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $treatID = $_POST['treat-id'];
                $userID = $_SESSION['userid'];
                if( empty($pat) || empty($mob) || empty($age) ){
                    echo '<div class="error">Enter data to save patient.</div>';
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO patients(pat_name, pat_mob, pat_age,
                    pat_gender, treat_id, user_userid) VALUES(?,?,?,?,?,?)");
                    $stmt -> execute([$pat, $mob, $age, $gender, $treatID, $userID]);
                    header("location:pat.php");
                }
            }
        ?>
    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->
<script src="../master/js/validate.js"></script>
<?php
    include "../master/sections/end.php";
?>