<?php
include '../../univ/baseurl.php';


function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}


spl_autoload_register("sp_autoloader");


$offset = $_POST['offset'];


$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
    while ($row3 = mysqli_fetch_assoc($result3)) {

        /* print_r($row3);*/

        $countrydata[] = array('country_id' => $row3['country_id'], 'country' => $row3['country_title']);
    }

    $data = array("status" => 200, "message" => "success", "data" => $countrydata);
} else {

    $data = array("status" => 1, "message" => "No Record Found.");

}


echo json_encode($data);

?>  