<?php
$hostname = "localhost";
$dbname = "heart_nov_2022";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:hostname=$hostname;dbname=$dbname", $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $e ){
    echo $e -> getMessage();
}

class Conn2Col{
    public $first_column;
    public $second_column;
    public $table_name;
    public $active_column;

    function __construct($f_col, $s_col, $t_name, $a_c){
        $this -> first_column = $f_col;
        $this -> second_column = $s_col;
        $this -> table_name = $t_name;
        $this -> active_column = $a_c;
    }

    public function getRecords(){
        $records = $GLOBALS['conn'] -> query("SELECT $this->first_column, $this->second_column FROM $this->table_name WHERE $this->active_column = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
        return $records;
    }

    public function data_select(){
        foreach( $this->getRecords() as $key => $value ){
            echo "<option value=\"$key\">$value</option>";
        }
    }
}

$job_obj = new Conn2Col("job_id", "job_title", "jobs", "job_active");
$dept_obj = new Conn2Col("dept_id", "dept_name", "departments", "dept_active");
$dept_obj = new Conn2Col("dept_id", "dept_name", "departments", "dept_active");
$dept_obj = new Conn2Col("dept_id", "dept_name", "departments", "dept_active");
$dept_obj = new Conn2Col("dept_id", "dept_name", "departments", "dept_active");

