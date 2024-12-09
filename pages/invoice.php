<?php
    session_start();
    if( !isset($_SESSION['user']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    $get_pat_info = $conn -> query("SELECT pat_id, pat_name, pat_age, pat_mob, treat_name
    FROM patients INNER JOIN treat_doctors USING(treat_id) 
    WHERE pat_active = 1
    ORDER BY pat_id ") -> fetchAll(PDO::FETCH_ASSOC);
    $pat_info_text = json_encode($get_pat_info);
    file_put_contents("pat.json", $pat_info_text);
    $get_exam_table = $conn -> query("SELECT exam_id, exam_name
    FROM examinations WHERE exam_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
    $exam_table_txt = json_encode($get_exam_table);
    file_put_contents("exam.json", $exam_table_txt);
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Invoice</div>

    <div class="inv">
        <form action="invo.php" method="POST">
            <table>
                <caption>Heart Center</caption>
                <!-- invoice headear -->
                <thead>  
                    <tr>
                        <th>Patient</th>
                        <td>
                            <select name="patid" id="pat">
                                <option value="start">Select Patient</option>
                                <?php
                                    $get_patients = $conn -> query("SELECT pat_name FROM patients 
                                    WHERE pat_active = 1   ORDER BY pat_id") -> fetchAll(PDO::FETCH_COLUMN);
                                    for($i = 0; $i < count($get_patients); $i++):?>
                                        <option value="<?php echo $i;?>"><?php  echo $get_patients[$i]; ?></option>
                                    <?php endfor;?>
                            </select>
                        </td>
                        <th></th>
                        <th>Invoice ID</th>
                        <td>
                            <?php
                                $get_lsat_invoice = $conn -> query("SELECT invoice_id FROM
                                invoice ORDER BY invoice_id DESC LIMIT 1") -> fetchAll(PDO::FETCH_COLUMN) ;
                                $next_id = (count($get_lsat_invoice) > 0) ? $get_lsat_invoice[0] + 1 : 1;
                            ?>
                            <input type="number" name="invoice-id" readonly value="<?php echo $next_id; ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>Age</th>
                        <td id="age"></td>
                        <th></th>
                        <th>Invoice Date</th>
                        <td>
                            <input type="text" name="i-date" id="invoice-date" readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <th>Mobile</th>
                        <td id="mobile"></td>
                        <th></th>
                        <th>Invoice Time</th>
                        <td>
                            <input type="text" name="i-time" id="invoice-time" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                </thead>
                
                <!-- invoice body -->
                <tbody>
                    <tr class="r-h">
                        <th colspan="2">Examination</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Amount</th>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                    $get_exams = $conn -> query("SELECT exam_id, exam_name
                                    FROM examinations WHERE exam_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                    foreach($get_exams as $key => $value){
                                        echo "<option value=\"$key\">$value</option>";
                                    }
                                
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" readonly value="0">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                    foreach($get_exams as $key => $value){
                                        echo "<option value=\"$key\">$value</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" readonly value="0">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                    foreach($get_exams as $key => $value){
                                        echo "<option value=\"$key\">$value</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" readonly value="0">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                    foreach($get_exams as $key => $value){
                                        echo "<option value=\"$key\">$value</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" readonly value="0">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                    foreach($get_exams as $key => $value){
                                        echo "<option value=\"$key\">$value</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" readonly value="0">
                        </td>
                    </tr>

                    <tr id="end-row">
                        <td colspan="4" class="total-td">Total</td>
                        <td>
                            <input type="number" name="total" id="invoice-total" readonly value="0">
                        </td>
                    </tr>
                </tbody>
                
                <!-- invoice footer -->
                <tfoot>
                    <tr>
                        <td>
                            <input type="button" value="Add Row" onclick="addRow()">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                    <tr>
                        <th>Employee</th>
                        <th></th>
                        <th>Treatment Doctor</th>
                        <th></th>
                        <th>Examination Doctor</th>
                    </tr>
                    <tr>
                        <td><?php echo $_SESSION['user'] ;?></td>
                        <td></td>
                        <td id="t-d"></td>
                        <td></td>
                        <td>
                            <select name="empid">
                            <?php
                                $get_doctors = $conn -> query("SELECT emp_id, emp_name
                                FROM employees WHERE emp_active = 1 AND dept_id = 3") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach($get_doctors as $key => $value){
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                </tfoot>

            </table>

            <input type="submit" value="Save">
            <input type="button" value="Print" id="btn-print">
        </form>

    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<!-- custom js here -->
<script src="../master/js/invoice.js"></script>
<?php
    include "../master/sections/end.php";
?>