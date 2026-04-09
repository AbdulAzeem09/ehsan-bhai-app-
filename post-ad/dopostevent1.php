<?php







//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

//include('../univ/baseurl.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

/* function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postings;
if(isset($_POST["idspPostings"]))
{
$postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
echo trim($_POST["idspPostings"]);
}

else
{
if($_POST["spProfiles_idspProfiles"]!=""){
if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
$postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
else
$postid = $p->post($_POST, $_FILES);
echo trim($postid);
}
} */


function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}


//print_r($_FILES); die('===========');



if(isset($_POST['sponsorId'])){

    if(is_array($_POST['sponsorId']))
    {
        @$_POST['sponsorId'] = implode(",",$_POST['sponsorId']);
    }else
    {
        @$_POST['sponsorId'] =$_POST['sponsorId'];
    }
}



if($_POST['addfeaturning']){
    $addfeaturning = implode(",",$_POST['addfeaturning']);
}else{
    $addfeaturning = "";
}
//echo $addfeaturning;

if($_POST['spPostingCohost']){
    $cohost= implode(",",$_POST['spPostingCohost']);
}else{
    $cohost="";
}
$_POST['addfeaturning'] = '';
$_POST['spPostingCohost'] = '';
//$tickettype = $_POST['Ticket_Type'];
// $ticketprice = $_POST['Price'];
$ticketcape = $_POST['Capacity'];

$TicketTypeadd = $_POST['Ticket_Typeadd'];
$Capacityadd = $_POST['Capacity'];
$Priceadd = $_POST['Price'];

//unset($_POST['Ticket_Typeadd']);
//unset($_POST['Capacityadd']);
//unset($_POST['Priceadd']);
/*unset($_POST['Ticket_Type_add']);
unset($_POST['Capacity_add']);
unset($_POST['Price_add']);*/
//echo"<pre>";
//print_r($_POST);
//echo"</pre>";
//exit;
/*
$_POST['Ticket_Type'] = implode(",",$_POST['Ticket_Type']);
$_POST['Price'] = implode(",",$_POST['Price']);
$_POST['Capacity'] = implode(",",$_POST['Capacity']);
*/


spl_autoload_register("sp_autoloader");
$p = new _spevent;
$re = new _redirect;
$prictype = new _spevent_type_price;
//
$event_category = $_POST['spCategories_idspCategory'];
$event_title = $_POST['spPostingTitle'];
$catchy_phrase = $_POST['specification'];
$event_description = $_POST['spPostingNotes'];
$county = $_POST['spPostingsCountry'];
$state = $_POST['spPostingsState'];
$city = $_POST['spPostingsCity'];
$event_address = $_POST['eventaddress'];
$name_of_place = $_POST['spPostingEventVenue'];
$event_type = $_POST['event_payment_type'];
$registaion = $_POST['registration_req'];
$event_capacity = $_POST['hallcapacity'];
$organizer_name = $_POST['spPostingEventOrgName'];
$EventOrgId = $_POST['spPostingEventOrgId'];
$start_date = $_POST['spPostingStartDate'];
$end_date = $_POST['spPostingExpDt'];
$start_time = $_POST['spPostingStartTime'];
$end_time = $_POST['spPostingEndTime'];
$sponsorId= $_POST['sponsorId'];
$event_platform_title = $_POST['event_platform_title'];
$user_id = $_SESSION['uid'];

$event = [
    'event_category '=>$event_category,
    'event_title'=>$event_title,
    'catchy_phrase'=>$catchy_phrase,
    'event_description'=>$event_description,
    'county'=>$county,
    'state'=>$state,
    'city'=>$city,
    'event_address'=>$event_address,
    'name_of_place'=>$name_of_place,
    'event_platform_title'=>$event_platform_title,
    'event_type'=>$event_type,
    'registaion'=>$registaion,
    'event_capacity'=>$event_capacity,
    'organizer_name'=>$organizer_name,
    'eventOrgId'=>$EventOrgId,
    'start_date'=>$start_date,
    'end_date'=>$end_date,
    'start_time'=>$start_time,
    'end_time'=>$end_time,
    'sponsorId'=>$sponsorId,
    'user_id'=> $user_id
];

//$postid = $p->post($dataevent, $_FILES);
$postidEvent = $p->createEventData($event);


if($_POST['Ticket_Type_add']){
    if(count($_POST['Ticket_Type_add'])> 0){
        foreach($_POST['Ticket_Type_add'] as $index=>$item){
            $ticket = [];
            $Capacity_add = $_POST['Capacity_add'][$index];
            $Price_add = $_POST['Price_add'][$index];
            $ticket['post_id'] = $postidEvent;
            $ticket['ticket_type'] = $item;
            $ticket['capacity'] = $Capacity_add;
            $ticket['price'] = $Price_add;
            $p->event_tickets($ticket);
        }
    }
}

    $event_gallery = [];
    $file_name = $_FILES["spPostingPic"]["name"];
    $file_tmp_name = $_FILES["spPostingPic"]["tmp_name"];
    $file_size = $_FILES["spPostingPic"]["size"];
    $file_type = $_FILES["spPostingPic"]["type"];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_extension_type  = explode(".",$file_name);
    $file_extension  = strtolower(end($file_extension_type));
    $file_match = array("jpg","png","jpeg",'jfif');
    $upload_location = '../events/image';
    $time = date("d-m-Y")."-".time();

    $new_file_name = $time.".".$ext;

    $path = $upload_location.$new_file_name;
    move_uploaded_file($file_tmp_name,$path);

    $event_gallery['post_id'] = $postidEvent;
    $event_gallery['image'] = $new_file_name;


if($_FILES["spPostingGallery"]){
    $galleryFiles = [];
    $name1 = $_FILES["spPostingGallery"]['name'];
    $tmp_name = $_FILES["spPostingGallery"]['tmp_name'];
    if(count($name1) > 0){
        $count = 0;
        foreach ($name1 as $item) {
            $file_name1 = $item;
            $file_tmp_name1 = $tmp_name[$count];
            $file_extension_type1  = explode(".",$file_name1);
            $file_extension1  = strtolower(end($file_extension_type1));
            $file_match = array("jpg","png","jpeg",'jfif');

            $time1 = date("d-m-Y")."-".time();
            $ext1 = pathinfo($file_name1, PATHINFO_EXTENSION);
            $new_file_name1 = $time1.".".$file_extension1;
            $path2 = $upload_location.$new_file_name1;
            move_uploaded_file($file_tmp_name1,$path2);
            $galleryFiles[] =  $new_file_name1;
            $count++;
        }
    }
    $event_gallery['gallery'] = implode(',',$galleryFiles);
}

if( $_FILES["spPostingPicaaas"]){
    $sittingFiles = [];
    $name2 = $_FILES["spPostingPicaaas"]['name'];
    $tmp_name2 = $_FILES["spPostingPicaaas"]['tmp_name'];
    $count = 0;

    if(count($name2) > 0){
        foreach ($name2 as $item) {
            $file_name2 = $item;
            $file_tmp_name2 = $tmp_name2[$count];
            $file_extension_type2  = explode(".",$file_name2);
            $file_extension2  = strtolower(end($file_extension_type2));

            $file_match = array("jpg","png","jpeg",'jfif');
            $time2 = date("d-m-Y")."-".time();
            $ext2 = pathinfo($file_name2, PATHINFO_EXTENSION);
            $new_file_name2 = $time2.".".$file_extension2;
            $path1 = $upload_location.$new_file_name2;
            move_uploaded_file($file_tmp_name2,$path1);
            $sittingFiles[] =  $new_file_name2;
            $count++;
        }
    }
    $event_gallery['sitting_layout'] = implode(',',$sittingFiles);
}




$p->eventGallery($event_gallery);

$_SESSION['count'] = 0;
$_SESSION['errorMessage'] = "<strong>Success!</strong> Event Flagged Successfully!";
$redirctUrl = $BaseUrl . "/events";

//$redirctUrl = $BaseUrl . "/post-ad/events/posting.php?postid=$postid";
$re->redirect($redirctUrl);

if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {
    $pst_id = $_POST["idspPostings"];
    $_POST["spPostings_idspPostings"] = $_POST["idspPostings"];


//echo "<pre>";
//	print_r($_POST);
    /*
    $total = count($_FILES['spPostingGallery']['name']);
    for($i=0;$i<$total;$i++){
    $fileName = $_FILES['spPostingGallery']['name'][$i];
    $newFileName = $fileName.rand(100000,999999);
    $fileDest = $BaseUrl.'uploadimage1/'.$newFileName;
    move_uploaded_file($_FILES['spPostingGallery']['tmp_name'][$i], $fileDest);
    $GalleryArray = array(
    "post_id"=>$pst_id,
    "image_name"=>$newFileName
    );
    $p->createGallery($GalleryArray);
    }
    */


    $dataevent_edit = array(
        'spCategories_idspCategory' =>$_POST['spCategories_idspCategory'],
        'spPostingVisibility' => $_POST['spPostingVisibility'],
        'default_currency' => $_POST['default_currency'],
        'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
        'spPostingAlbum_idspPostingAlbum_' => $_POST['spPostingAlbum_idspPostingAlbum_'],
        'eventcategory' => $_POST['eventcategory'],
        'spPostingTitle' => $_POST['spPostingTitle'],
        'specification' => $_POST['specification'],
        'spPostingNotes' =>  $_POST['spPostingNotes'],
        'spPostingsCountry' => $_POST['spPostingsCountry'],
        'spPostingsState' => $_POST['spPostingsState'],
        'spPostingsCity' => $_POST['spPostingsCity'],
        'eventaddress' => $_POST['eventaddress'],
        'spPostingEventVenue' => $_POST['spPostingEventVenue'],
        'event_payment_type' => $_POST['event_payment_type'],
        'hallcapacity' => $_POST['hallcapacity'],
        'taxrate' =>$_POST['taxrate'],
        'notax' =>$_POST['notax'],
        'spPostingEventOrgId' => $_POST['spPostingEventOrgId'],
        'spPostingEventOrgName' => $_POST['spPostingEventOrgName'],
        'spPostingStartDate' => $_POST['spPostingStartDate'],
        'spPostingExpDt' => $_POST['spPostingExpDt'],
        'spPostingStartTime' => $_POST['spPostingStartTime'],
        'spPostingEndTime' => $_POST['spPostingEndTime'],
        'sponsorId' => $_POST['sponsorId'],
        'registration_req' => $_POST['registration_req'],
        'group_' => $_POST['group_'],
        'addfeaturning' => $addfeaturning,
        'spPostingCohost' => $cohost);

    $postid = $p->updateEvnt($dataevent_edit, $pst_id);
//echo trim($postid);
    $resultdata = $prictype->read($_POST["idspPostings"]);


    echo  $_POST["idspPostings"];
//print_r($resultdata);
//exit;
    $totalrow = $resultdata->num_rows;



//if($totalrow == 0)
//{

    /*$total5_type = count($TicketTypeadd);
    if($total5_type>0)
    {

    foreach ($TicketTypeadd as $key1 => $value1) {

    $postData1 = array("event_id" => $_POST["idspPostings"] ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

    $price_type_id = $prictype->create($postData1);
    }
    }*/
// }
// else
//	{

    $tickettype = $_POST['Ticket_Type'];

// print_r($tickettype); die();
    if($tickettype){
        $total_type = count($tickettype);
//$total_type = $_POST['typeid_new'];
//die('kkkkkkkkk');
        if($total_type>0)
        {


//for($l=0; $l<$total_type; $l++)
//{
            $keyss = array();
            $prictype->delete_data($_POST["idspPostings"]);
            foreach ($TicketTypeadd as $key1 => $value1) {
                echo $key;
                $resultdata2 = $prictype->readtypid($key);
                $totalrow2 = $resultdata2->num_rows;
                $keyss[] = $key;

                $postData1 = array("event_id" => $_POST["idspPostings"] ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

//print_r($postData1);

                $price_type_id = $prictype->create($postData1);



            }



//}
        }
    }

    /*
    foreach ($TicketTypeadd as $key1 => $value1) {

    $postData1 = array("event_id" => $_POST["idspPostings"] ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

    $price_type_id = $prictype->create($postData1);



    }


    */

    if($resultdata != false){
        while ($pricedata = mysqli_fetch_assoc($resultdata)) {
            if($keyss){
                if(!in_array($pricedata['typeid'],$keyss))
                {
                    $price_type_id = $prictype->remove($pricedata['typeid']);
                }
            }

        }
    }



// }

//echo trim($_POST["idspPostings"]);

} else {

    $result8 = $p->eventExists();
    if ($result8) {
        $row8 = mysqli_fetch_assoc($result8);

        if($row8['spPostingTitle']==$_POST["spPostingTitle"]&&$row8['eventcategory']==$_POST["eventcategory"]&&$row8['spPostingEventOrgName']==$_POST["spPostingEventOrgName"]&&$row8['spPostingEventVenue']==$_POST["spPostingEventVenue"]&&$row8['eventaddress']==$_POST["eventaddress"]){
        }else{

            $dataevent = array(	'spCategories_idspCategory' =>$_POST['spCategories_idspCategory'],
                'spPostingVisibility' => $_POST['spPostingVisibility'],
                'default_currency' => $_POST['default_currency'],
                'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
                'spPostingAlbum_idspPostingAlbum_' => $_POST['spPostingAlbum_idspPostingAlbum_'],
                'eventcategory' => $_POST['eventcategory'],
                'groupid' => $_POST['groupid'],
                'spPostingTitle' => $_POST['spPostingTitle'],
                'specification' => $_POST['specification'],
                'spPostingNotes' =>  $_POST['spPostingNotes'],
                'spPostingsCountry' => $_POST['spPostingsCountry'],
                'spPostingsState' => $_POST['spPostingsState'],
                'spPostingsCity' => $_POST['spPostingsCity'],
                'eventaddress' => $_POST['eventaddress'],
                'spPostingEventVenue' => $_POST['spPostingEventVenue'],
                'event_payment_type' => $_POST['event_payment_type'],
                'hallcapacity' => $_POST['hallcapacity'],
                'taxrate' =>$_POST['taxrate'],
                'notax' =>$_POST['notax'],
                'spPostingEventOrgId' => $_POST['spPostingEventOrgId'],
                'spPostingEventOrgName' => $_POST['spPostingEventOrgName'],
                'spPostingStartDate' => $_POST['spPostingStartDate'],
                'spPostingExpDt' => $_POST['spPostingExpDt'],
                'spPostingStartTime' => $_POST['spPostingStartTime'],
                'spPostingEndTime' => $_POST['spPostingEndTime'],
                'sponsorId' => $_POST['sponsorId'],
                'registration_req' => $_POST['registration_req'],
                'group_' => $_POST['group_'],
                'addfeaturning' => $addfeaturning,
                'spPostingCohost' => $cohost );


            echo trim($postid);
            if($TicketTypeadd == ''){
                $total5_type = 0;
            }
            else{
                $total5_type = count($TicketTypeadd);
            }
            if($total5_type>0)
            {
// print_r($TicketTypeadd);
                foreach ($TicketTypeadd as $key1 => $value1) {
                    $postData1 = array("event_id" => $postid ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);
                    $price_type_id = $prictype->create($postData1);
                }
            }



        }

    }
}

$_SESSION['count'] = 0;
$_SESSION['errorMessage'] = "<strong>Success!</strong> Event Flagged Successfully!";
$redirctUrl = $BaseUrl . "/events";
//$redirctUrl = $BaseUrl . "/post-ad/events/posting.php?postid=$postid";
	$re->redirect($redirctUrl);
?>