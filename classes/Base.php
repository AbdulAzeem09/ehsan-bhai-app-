<?php

class Base {

  /**
   * userId param
   */
  public $userId = "";

  /**
   * To check if user if logged in or not
   *
   */
  public function loginCheck(){
    $this->userId = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
    if(!$this->userId) {
      errorOut("Please login first");
    }        
  } 

}
