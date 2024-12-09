<?php
session_start();
if( !isset($_SESSION['user']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$from_date = $_GET['q_f'];
$to_date = $_GET['q_t'];
?>
<table id="pdf-area">
            <tr>
                <th>Patient</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Treatment Doctor</th>
            </tr>
                
            <?php
                $get_rep_info = $conn -> query("SELECT invoice_id, pat_id, pat_name, pat_mob, pat_age, pat_gender, treat_name 
                FROM ((invoice
                       INNER JOIN patients USING(pat_id))
                       INNER JOIN treat_doctors ON patients.treat_id = treat_doctors.treat_id)
                WHERE invoice_date BETWEEN '$from_date' AND '$to_date'");
                while($row = $get_rep_info -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['pat_name']; ?></td>
                    <td><?php echo $row['pat_mob']; ?></td>
                    <td><?php echo $row['pat_age']; ?></td>
                    <td><?php echo $row['pat_gender']; ?></td>
                    <td><?php echo $row['treat_name']; ?></td>
                </tr>
            <?php endwhile; ?>

        </table>

        <button onclick="mkPDF()">PDF</button>