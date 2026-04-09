<?php 
include('../../univ/baseurl.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    $activePage = 7;


    if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }

include '../../mpdf/mpdf.php';

$mpdf=new mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0); 



                                           
                                            $pet = new _spevent_transection;

                                             $p  = new _spevent;

                                             $d = new _spprofiles;
                                            $res = $pet->orderread($_GET['id']); 


                                            if($res != false){
                                                $i = 1;
                                                while ($row = mysqli_fetch_assoc($res)) { 
                                                    //posting fields
                                             $result_pf = $p->read($row['postid']);
                                                
                                              
                                            $sellerName = $d->getProfileName($row['sellid']);
                                                    if($result_pf){

                                                        $venu = "";
                                                        $startDate = "";
                                                        $startTime    = "";
                                                        $endTime = "";
                                                        $catName = "";

                                                        while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                            /*echo "<pre>";
                                                            print_r($row2);*/


                                                          $venu = $row2['spPostingEventVenue'];
                                                          $startDate = $row2['spPostingStartDate'];
                                                          $startTime = $row2['spPostingStartTime'];
                                                          $endTime = $row2['spPostingEndTime'];
                                                          $catName = $row2['eventcategory'];
														  $OrgName = $row2['spPostingEventOrgName'];

                                                          
                                                       
                                                        $strDate = new DateTime($startDate);


                                                        $dtstrtTime = strtotime($startTime);
                                                        $dtendTime = strtotime($endTime); 

                                                                       
															
                                                                       $i++;


 $Date = new DateTime($row2['spPostingDate']);
 $startTime = $row2['spPostingStartTime'];
 $dtstrtTime = strtotime($startTime);
 $firstname = $row['first_name'];
 $lastname = $row['last_name'];
 $order_taxrate = $row['order_taxrate'];
 $order_notax = $row['order_notax'];
 $orderId = $row['id'];
 $eventId = $row['postid'];

 $html ='
<html lang="en-US">
    
    <head>

    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

      <style>

        .showeventrating{
          margin-left: 45px;
            margin-right: 45px;
            margin-bottom: 10px;
        }

        .pdftablehead{
          font-weight: bold;
            font-size: 16px;
        }
        tr td{
            padding: 15px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .tddata{
            padding-left : 14px;
             text-transform: capitalize;
        }
        .textboxcenter{
          
         border:1px solid black;
            width:50%;
            height:100px;
            margin-left: 180px;
            
        }
        .trdata .newtddata{
             padding: 7px!important;
             border:none!important;
            vertical-align: top!important;
            padding-left : 40px;
           
        }
        .bordernone{
             border:none!important;
        }
      
        
      </style> 
        
    </head>    

<body class="bg_gray">

  <section class="main_box">            
            <div class="container">
                    

                <div class="row">


                    <div class="col-sm-12">
                    <div class="bg_white detailEvent m_top_10">

      

                 <div class="row">
                     <div class="showeventrating">


                           <p style="text-align:center; padding-top:20px;"> <img src="'.$BaseUrl.'/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 100px;"></p>
                           <p style="font-size: 30px; text-align:center;">The SharePage</p>
                        <div class="textboxcenter">
 <div class="col-md-6">                                 
 <table class="table">

   
    <tbody>
      <tr class="trdata">
        <td class="pdftablehead newtddata">Event Title :</td>
        <td class="tddata newtddata">'.$row2['spPostingTitle'].'</td>
        
      </tr>
      <tr class="trdata">
        <td class="pdftablehead newtddata">Date :</td>
        <td class="tddata newtddata">'.$Date->format('d M Y').'</td>
      
      </tr>
      <tr class="trdata">
        <td class="pdftablehead newtddata">Start Time :</td>
        <td class="tddata newtddata" style="text-transform: uppercase;">'.date("h:i A", $dtstrtTime).'</td>
        
      </tr>
    </tbody>
  </table>

  </div>

    </div>

                    

 <br>



<div class="row">
<div class="col-md-6" style="width:50%; float:left;">                                 
 <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
        <td class="pdftablehead" style="border:none!important;" >Name : </td>
        <td class="tddata" style="font-weight:bold; border:none!important;">'.$firstname.'    '.$lastname.'</td>
        
      </tr>
      <tr>
        <td class="pdftablehead">Organized By :</td>
        <td class="tddata">'.ucwords($OrgName).'</td>
        
      </tr>
      
      <tr>
        <td class="pdftablehead">Venue :</td>
        <td class="tddata">'.$row2['spPostingEventVenue'].'</td>
        
      </tr>
    </tbody>
  </table>

  </div>
  <div class="col-md-6"  style="width:50%;float:right;">
      <table class="table">
   
    <tbody>
      <tr style="border:none!important;">
    <td class="pdftablehead" style="padding-left:80px; border:none!important;">Total Ticket Quantity : </td>
        <td class="tddata" style="padding-left:20px; border:none!important;">'.$row['quantity'].'</td>
        
      </tr>
      <tr>
        <td class="pdftablehead"></td>
        <td class="tddata" style="padding-bottom:35px;"></td>
      
      </tr>
      <tr>
        <td class="pdftablehead"></td>
        <td class="tddata"  style="padding-left:30px;"></td> 
        
      </tr>
    </tbody>
  </table>

  </div>
 </div>

 <hr>                          
                             
<div class="row">
<div class="col-sm-12" style="width:100%; float:left;">                                 
 <table class="table" style="width:100%;">
   
    <tbody>
      <tr style="border:none!important;">
        <td class="pdftablehead" style="border:none!important;">Ticket Type.</td>
		<td class="pdftablehead" style="border:none!important;">Ordered Qty.</td>
		<td class="pdftablehead" style="border:none!important;">Price</td>
		<td class="pdftablehead" style="border:none!important;text-align:left;padding-left: 2px;">Total Price</td>     
        
      </tr>';

		$prictype = new _spevent_type_price;
	    $historyq = $prictype->read_pricetype_order_history($orderId,$eventId);
		$subtot = 0;
		$totals = 0;
		$taxamount = 0;
		while ($historydata = mysqli_fetch_assoc($historyq)) {

			$subtot += round(($historydata['order_ticket_qty']*$historydata['order_ticket_price']),2);

			if($order_notax==0)
			 {
			   $taxamount += round( (($historydata['order_ticket_qty']*$historydata['order_ticket_price']) / 100) * $order_taxrate, 2);
			 }

	  $html .='<tr>
        <td>'.$historydata['ticket_type'].'</td>
		<td>'.$historydata['order_ticket_qty'].'</td>
		<td>$'.round($historydata['order_ticket_price'], 2).'</td>
		<td style="text-align:left;padding-left:2px;" >$'.round(($historydata['order_ticket_qty']*$historydata['order_ticket_price']),2).'</td>     
        
      </tr>';

		}
	
	 $totals = $subtot +	$taxamount;

	 $html .='<tr>
        <td style="padding-top:5px;padding-bottom: 0px;" ></td>
		<td style="padding-top:5px;padding-bottom: 0px;" ></td>
		<td style="text-align:right;padding-right: 0px;padding-top:5px;padding-bottom: 0px;"><strong>Sub Total :</strong></td>
		<td style="text-align:left;padding-left: 2px;padding-top:5px;padding-bottom: 0px; ">$'.$subtot.'</td>     
        
      </tr>';
	  
	  $html .='<tr style="border:none!important;">
        <td style="border-top: none;padding-top:0px;padding-bottom: 0px;" ></td>
		<td  style="border-top: none;padding-top:0px;padding-bottom: 0px;" ></td>
		<td style="text-align:right;padding-right: 0px;border-top: none;padding-top:0px;padding-bottom: 0px;"><strong>Tax :</strong></td>
		<td style="text-align:left;padding-left: 2px;border-top: none;padding-top:0px;padding-bottom: 0px; ">$'.$taxamount.'</td>     
        
      </tr>';

	  $html .='<tr style="border:none!important;">
        <td  style="border-top: none;padding-top:0px;padding-bottom: 0px;" ></td>
		<td  style="border-top: none;padding-top:0px;padding-bottom: 0px;" ></td>
		<td style="text-align:right;padding-right: 0px;border-top: none;padding-top:0px;padding-bottom: 0px;"><strong>Total :</strong></td>
		<td style="text-align:left;padding-left: 2px;border-top: none;padding-top:0px;padding-bottom: 0px; ">$'.$totals.'</td>     
        
      </tr>';
     
    $html .='</tbody>
  </table>

  </div>
 </div><hr>';


 $html .='<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Booked on : '.date("Y-m-d H:i:A",strtotime($row['payment_date'])).'</p>


<div style="float:left; padding-left: 12px;" >
<p font-size: 12px;>'.$row['remark'].' <br> Transaction ID : '.$row['txn_id'].'</p>
</div>

<p style="text-align:center; padding-top:60px;">Paid Online From- www.TheSharePage.com</p>
 </div>
  </div>
                               </div>
                                </div>
                                 </div>
                                  </div>
                               
</section>
</body>
</html>'; 




                                                    }
                                                }
                                            }
                                        }

  


 ob_start();
 echo $html;
 $body = ob_get_clean();

$body = iconv("UTF-8","UTF-8//IGNORE",$body);
//write html to PDF
$mpdf->WriteHTML($body);
 
//output pdf
$mpdf->Output();

}
?>