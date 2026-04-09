<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');


/**
   * To get list of the state based on country
   *
  **/

  class LoadStateCity extends Base{

   public function readstate(){
   
    $countryId = isset($_POST['countryId']) ? (int)$_POST['countryId'] : 0;
    
    $sql ="SELECT * FROM tbl_state AS t where country_id = ? order by state_title asc";
    $params = [$countryId];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }
  
  /**
   * To get list of the city based on state
   *
  **/
  public function readcity(){
   
    $state = isset($_POST['stateId']) ? (int)$_POST['stateId'] : 0;
    
    $sql ="SELECT * FROM tbl_city AS t where state_id = ? order by city_title asc";
    $params = [$state];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }
  
  
}
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
?>
