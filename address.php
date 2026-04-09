<?php

$output ="";
      //  $address = $this->input->post('address');

                 $address = $_POST['address'];

       // $user_type = $this->input->post('user_type');
  
        // $address =$_POST['address']; // Google HQ
        /*  if($address == " "){*/
        $prepAddr = str_replace(' ','+',$address);
        /* }else{
        $prepAddr = "";
        //$geocode = "";
        }*/
        @$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyBieUg1JxCo9zNvoNsp5uCBSYERY_-H-zg&address='.$prepAddr.'&sensor=false');
        //print_r($geocode);
        if($geocode){
            $output= json_decode($geocode);
            //https://maps.google.com/maps/api/geocode/json?key=AIzaSyDPmwsBRxE-EfeyHMpKneTCB19nhsaZDmU&address=" + youraddress + "&sensor=true
            //  print_r($output);
            $cur_latitude = @$output->results[0]->geometry->location->lat;
            $cur_longitude = @$output->results[0]->geometry->location->lng;
            $address_suggested = @$output->results[0]->formatted_address;

             
          
 echo json_encode(array('address'=> $address_suggested,'latitude' => $cur_latitude,'longitude'=>$cur_longitude));

   
        }else{
            $output= "";
        }


?>