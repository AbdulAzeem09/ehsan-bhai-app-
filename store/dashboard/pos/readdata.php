<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

function sp_autoloader($class){
include '../../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


												$id=$_POST['id'];


												$p = new _pos;
															
												$result = $p->read_data1($id);     
							
                                                            
                                               $row = mysqli_fetch_assoc($result);	
											   //print_r($row);
											   //die('==');
											   $data['phone']=$row['phone'];
											   $data['email']=$row['email'];
											   $data['id']=$row['id'];
											   echo json_encode($data);






?>