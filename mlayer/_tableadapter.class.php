<?php
 //echo $BaseUrl;
//   require_once($_SERVER['DOCUMENT_ROOT'] . "/sharepagego/Sharepage/univ/main.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/univ/main.php");

    // if(!isset($_SESSION))
    // session_start();
 

class _tableadapter
{
    // property declaration
    public $dbclose = false;
    public $table;
    public $join;
    public $uid;
    public $sql;
    public $rows = null;

    function __construct($t) {

        $this->table = strtolower($t);
    }

    /**
     * To escape characaters
     *
     * @param $data - String - Posted data
     * @return Clean data
     */
    public function escapeString($data){
      return mysqli_real_escape_string(_data::getConnection(), $data);
    }

    
    /**
     * To escape characaters
     *
     * @param $data - Array - Posted data
     * @return Clean data
     */
    public function escapeArray($data){
      $conn = _data::getConnection();
      foreach($data as $k => $v){
        $data[$k] = mysqli_real_escape_string($conn, $v);
      }
      return $data;
    }

    // CREATE
    public function create($data, $debug=false) {
        //print_r($data);
        //die('-----------');

        $conn = _data::getConnection();
        $sql;
        $columns = null;
        $values = null;
        $sql = "INSERT INTO " . $this->table . " (";
        foreach($data as $k => $v) {
            // print_r($data);exit();
            //ignore non-table columns sufix with _
            if (substr($k, -1) != "_") {
                if (substr($k, -1) == "#") {
                    $k = rtrim($k, "#");
                    if ($v != null) {
                        $timestamp = strtotime($v);
                        $v = date('Y-m-d', $timestamp);
                    }
                }
                $columns = $columns . trim($k) . ", ";
                if (strpos($v, "'") !== false)
                    $v = $conn->real_escape_string($v);
                $values = $values . "'" . trim($v) . "', ";
            }
        }
        $columns = rtrim(rtrim($columns), ",");
        $values = rtrim(rtrim($values), ",");
        $sql = $sql . $columns . ") VALUES (" . $values . ")";
        $this->sql = $sql;

        if ($debug=='debug'){
            echo $sql;
        } else {
            if (!mysqli_query($conn,$sql)) {
                die('error: ' . mysqli_error($conn));
            }
            else return mysqli_insert_id($conn);
            if ($this->dbclose) { _data::disconnect(); }
        }
    }

        public function createapi($data) {
        $conn = _data::getConnection();
        $sql;
        $columns = null;
        $values = null;
        $sql = "INSERT INTO " . $this->table . " (";
        foreach($data as $k => $v) {
            //ignore non-table columns sufix with _
            if (substr($k, -1) != "_") {
                if (substr($k, -1) == "#") {
                    $k = rtrim($k, "#");
                    if ($v != null) {
                        $timestamp = strtotime($v);
                        $v = date('Y-m-d', $timestamp);
                    }
                }
                $columns = $columns . trim($k) . ", ";
                if (strpos($v , "'") !== false)
                    $v = $conn->real_escape_string($v);
                $values = $values . "'" . trim($v) . "', ";
            }
        }
        $columns = rtrim(rtrim($columns), ",");
        $values = rtrim(rtrim($values), ",");
        $sql = $sql . $columns . ") VALUES (" . $values . ")";
        $this->sql = $sql;
        
        //echo $sql;

        if (!mysqli_query($conn,$sql)) {
            die('error: ' . mysqli_error($conn));
        }
        else return mysqli_insert_id($conn);
        if ($this->dbclose) { _data::disconnect(); }
    }

    // UPDATE
    public function update($data, $where, $debug=false) {

        $conn = _data::getConnection();
        // $sql = "UPDATE Persons SET Age=36 WHERE FirstName='Peter' AND LastName='Griffin'"
        $sql = "UPDATE " . $this->table . " as t SET "; //Age=36 WHERE FirstName='Peter' AND LastName='Griffin'"
        foreach($data as $k => $v) {
		
		//$v1=implode(" ",$v);
            //ignore non-table columns sufix with _
            if (substr($k, -1) != "_") {
                if (substr($k, -1) == "#") {
                    $k = rtrim($k, "#");
                    $timestamp = strtotime($v);
                    $v = date('Y-m-d', $timestamp);
					//print_r($v);die('=======');
                }
                if (strpos($v, "'") !== false)
                    $v = $conn->real_escape_string($v);
                $sql = $sql . " " . trim($k) . " = '" . trim($v) . "' , ";
            }
        }
        $sql = rtrim( rtrim( $sql ), "," );
        $sql = $sql . " " . $where;
        $this->sql = $sql;
        //echo $sql;
        if($debug==true){
            return $this->sql;
        }

        if (!mysqli_query($conn,$sql)) {
            die('Error: ' . mysqli_error($conn));
        }
        else  {return $conn->affected_rows; }
        if ($this->dbclose) { _data::disconnect(); }


    }

    // READ
    public function read($where = "", $order = "", $columns = "*", $join = "!", $debug=false) {
        $conn = _data::getConnection();
        $sql = "SELECT " . $columns . " FROM " . $this->table . " AS t " . strtolower(($join == "!" ? $this->join : $join)) . " " . strtolower($where) . " " . $order;
        $this->sql = $sql;
//        echo($sql);
//        echo '</br>';
//        echo '============================';
        if($debug == true){ return $this->sql; }  
        mysqli_query($conn,"use ". DBNAME);

        $result = mysqli_query($conn, $sql);

        if (is_object($result))
            $rowcount = $result->num_rows;
        else
            $rowcount = 0;
        if ($rowcount < 1) { $result = false; }
        return $result;
        if ($this->dbclose) { _data::disconnect(); }
    }

    // DELETE
    public function remove($where, $debug=false) {
        $conn = _data::getConnection();
        $sql = "DELETE t FROM " . $this->table . " AS t " . $where;
        
         $this->sql = $sql;     
        if($debug == true){ return $this->sql; }  
        
        mysqli_query($conn,"use " . DBNAME);

        $result = mysqli_query($conn, $sql);

        if($result){
            return $conn->affected_rows;
        } else {
            return false;
        }

        // if ($conn->affected_rows > 0)
        //     $rowcount = $result->num_rows;
        // else
        //     $rowcount = 0;
        // if ($rowcount < 1) { $result = false; }
        // return $result;
        
        if ($this->dbclose) { _data::disconnect(); }
    }

    public function blobload($key, $tmpName, $where){
        $conn = _data::getConnection();
        $sql = "UPDATE " . $this->table . " as t SET ";
        
        $fp = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);

        $v = $content;
        $sql = $sql . " " . trim($key) . " = '" . trim($v) . "' , ";
    
        $sql = rtrim( rtrim( $sql ), "," );
        $sql = $sql . " " . $where;
        $this->sql = $sql;
        //echo $sql;
        if (!mysqli_query($conn,$sql)) {
            die('Error: ' . mysqli_error($conn));
        }
        if ($this->dbclose) { _data::disconnect(); }
    }
}
?>
