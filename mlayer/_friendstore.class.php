<?php 
class _friendstore
{
	//spCountries
	//idspCountries, spCountriesName
    public $dbclose = false;
	private $conn;
	public $ta;
		function __construct() { 
		$this->ta = new _tableadapter("spPostings");
		$this->ta->dbclose = false;
	} 
	function friend(){
		$result = $this->ta->read("WHERE t.spPostingVisibility=0");
		 //echo $this->ta->sql;
		 <table border="2">
  <thead>
    <tr>
      <th>Studid</th>
      <th>Name</th>
      <th>Phno</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
	 if ($a->num_rows > 0) {
    //  output data of each row
     while($row = $a->fetch_assoc()) {
       //  echo "id: " . $row["idstudents"]. " - Name: " . $row["name"]. " - phno:" . $row["phno"]. "<br>";   <td>{$row['name']}</td><td>{$row['phno']}</td></tr>\n";
	   echo "<tr><td>{$row['spPostingTitle']}</td></tr>";
    }
 } else {
     echo "0 results";
 }
	
   
    ?>
  </tbody>
</table>
	}
	 
	
}
?>