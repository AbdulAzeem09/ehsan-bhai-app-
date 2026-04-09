<?php



error_reporting(E_ALL);
ini_set('display_errors', 'On');

$row = 1;
$counter = 0;
$urls = array();

$desdir = $_SERVER["DOCUMENT_ROOT"]."/democsv";
//Ex:  250x250/ for current directory, create the directory with named 250x250
/*
if (($handle = fopen("targetfile.csv", "r")) !== FALSE) {
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { */
//$num = count($data);
//$counter++;

//$row++;

//if($counter > 1 && is_array($data) && sizeof($data) > 3){

    $tmppos = ('/home/ajay/Desktop/unnamed.png');

   // if($tmppos === 0){
    //    $file = $data[3];
    //    $farry = explode("/",$file);
  //      $filename = end($farry);
        //echo $filename."<br>";
        //$urls[$counter] = $file;
		  $filename ='unnamed.png';

        //$current = file_get_contents($file);
    //    if(!file_exists($desdir.$filename)){
            copy($tmppos,$desdir.$filename);
     //   }
 //   }

 // }
/*
}
 fclose($handle);
}

*/

?>