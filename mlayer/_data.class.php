<?php

//	require_once($_SERVER['DOCUMENT_ROOT'] . "/sharepagego/Sharepage/univ/main.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/univ/main.php");
 
class _data {	
	private static $instance  = NULL;	
	private static $connection = NULL;
	public static function getConnection(){	
		if(is_null(self::$instance)){	
			$coni= mysqli_connect(DOMAIN, UNAME, PASS, DBNAME) or die("Looks like our server is having a few issues. Try accessing our site in a few moments.");			// Check connection		
			if (mysqli_connect_errno()) {		
				echo "Failed to connect to MySQL: " . mysqli_connect_error();		
			}		
			self::$instance = new self();		
			self::$connection = $coni; 			
			mysqli_query($coni,"SET time_zone = '-07:00'"); 	
		}	
		return self::$connection;
	}	
	public static function disconnect() {
		mysqli_close(self::$connection); 
	}
}
?>