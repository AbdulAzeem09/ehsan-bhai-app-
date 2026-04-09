<?php   

    session_start();

    $user_login_id = true;
    if($_SESSION['login_user'] != '' && $_SESSION['uid'] != ''){
        $user_login_id = false;  
    }

    if (isset($_GET['destroy_register_session']) && $_GET['destroy_register_session'] == true) {
        session_start();
        
        // Unset only the 'event' session variable
        if (isset($_SESSION['event'])) {
            unset($_SESSION['event']);
        }
        if (isset($_SESSION['event_user'])) {
            $_SESSION['event_user'] = 0;
        }
        
        // Redirect to another page after unsetting the session variable

        header("Location: $BaseUrl/page/event_details.php");

        exit(); // Make sure to exit after redirection
    }
    if (isset($_GET['destroy_sponsor_session']) && $_GET['destroy_sponsor_session'] == true) {
        session_start();
        
        // Unset only the 'event' session variable
        if (isset($_SESSION['sponsor_user'])) {
            unset($_SESSION['sponsor_user']);
        }
        if (isset($_SESSION['sponsor'])) {
            $_SESSION['sponsor'] = 0;
        }
        
        // Redirect to another page after unsetting the session variable
        header("Location: $BaseUrl/page/event_details.php");
        exit(); // Make sure to exit after redirection
    }

    function getCurrentFormattedTime() {
        // Set the timezone to Eastern Standard Time

        date_default_timezone_set('America/Vancouver');


        // Get the current date and time
        $currentDateTime = new DateTime();

        // Format the date and time
        return $currentDateTime->format('l, g:ia T');
    }

    /*error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);*/
    if (isset($_SESSION['afterlogin'])) {
        unset($_SESSION['afterlogin']);
    }
    $pay_status = 0;
    include("../univ/baseurl.php" );
    require_once '../backofadmin/library/config.php';

    // require_once '../smtp/event_register_success.php';

    //session_start();
    //print_r($_SESSION);
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
        
    }
    spl_autoload_register("sp_autoloader");
    
    if (isset($_GET['page']) && $_GET['page'] != '') {
        $paget = str_replace('_', ' ', strtolower($_GET['page'])) ;
        
        $m = new _spAllStoreForm;
        
        
        $result = $m->readPageTitle($paget);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $pageTitle = $row['page_title'];
            $pageDesc = $row['page_content']; 
            }else{
            $pageTitle = "";
            $pageDesc = "";
        }
        }else{
        $pageTitle = "";
        $pageDesc = "";
    }
    // echo "<pre>";print_r($_SESSION);die();
    $paymentAmountZero = true;
    $ticket_price = isset($_SESSION['event']['ticket_price'])?$_SESSION['event']['ticket_price']:'';    
    if($ticket_price == 0){

        $sponsorDescription = '';
        $user_id = isset($_SESSION['uid'])?$_SESSION['uid']:'';
        $fistname = isset($_SESSION['login_user'])?$_SESSION['login_user']:'';
        $event_id = isset($_SESSION['event']['event_id'])?$_SESSION['event']['event_id']:'';
        $registration_type = isset($_SESSION['event']['registration_type'])?$_SESSION['event']['registration_type']:'';
        $ticket_price = isset($_SESSION['event']['ticket_price'])?$_SESSION['event']['ticket_price']:'';
        $discountAmt1 = isset($_SESSION['event']['discountAmt'])?$_SESSION['event']['discountAmt']:'';
        $ticket_gst = isset($_SESSION['event']['ticket_gst'])?$_SESSION['event']['ticket_gst']:'';        
        $pyament_status = 'succes';
        $formType = 'event';        
        
        $emailQuery = "SELECT `spUserEmail` FROM `spuser` WHERE `idspUser` = $user_id";
        $email = '';
        $result = mysqli_query($dbConn, $emailQuery);
        if ($row = mysqli_fetch_assoc($result)) {
            $email = $row['spUserEmail'];
        }

        
        
        $eventsql = "INSERT INTO register_event(user_id,event_id,formType, registration_type,ticket_price,discount_amt,ticket_gst,fistname,lastname,email,card_number,card_month,card_cvv,card_name,billing_address,postcode,country,province,city,pyament_status,description) VALUES ('".$user_id."','".$event_id."','".$formType."','".$registration_type."','".$ticket_price."','".$discountAmt."','".$ticket_gst."','".$fistname."','".$lastname."','".$email."','*********','".$card_month."','".$card_cvv."','".$card_name."','".$billing_address."','".$postcode."','".$country."','".$province."','".$city."','".$pyament_status."','".$sponsorDescription."')";  

        $eventquery = mysqli_query($dbConn, $eventsql);    

        $statussql = "UPDATE register_event SET pyament_status = 'success' WHERE id = ".$last_id;
        $statusquery = mysqli_query($dbConn, $statussql);  
        $pay_status = 'succes';
        $paymentAmountZero = false;

        $data = [
            'BaseUrl'=>$BaseUrl,

            'name' => 'CAREER AND INNOVATION EXPO',
            'location' => '900 West Georgia St. Vancouver, British Columbia , Canada, V6C 2W6',            
            'registration_type' => $registration_type,
            'ticket_price' => $ticket_price,
            'discountAmt' => $discountAmt1,
            'ticket_gst' => $ticket_gst,
            'formType' =>$formType,
            'paydate'=> date('F j, Y'),
            'dateOfEvent'=>'March 26, 2025',

            'time_of_registration'=>getCurrentFormattedTime(),

        ];
        


      
		
		/*************for email fixing***************/
		
        $to = $email ;
        $subject = "The SharePage Event Registration Successful";

        // Construct the registration package table rows
        $htm = '';
        if ($data['formType'] == 'event') {
            if (isset($data['registration_type'])) {                   
                $package = json_decode($data['registration_type']);
                $package_rows = '';
                foreach ($package as $value) {
                    $package_rows .= '
                        <tr>
                            <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>' . $value->reg_name . '</strong></td>
                            <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd">' . number_format($value->price, 2,'.', ',') . ' X ' . $value->quantity . '</td>
                        </tr>';
                }
                $htm = $package_rows;
            }
        } else {
            if (isset($data['registration_type'])) {                   
                $package = json_decode($data['registration_type']);
                $htm = '
                    <tr>    
                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd"><strong>' . $package->name . '</strong></td>
                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd">' . number_format($package->value, 2, '.', ',') . '</td>
                    </tr>';
            } 
        }

        $logoUrl = $data['BaseUrl'] . '/image/logosharepage%201.png'; // Ensure this path is correct and accessible

        // $logoUrl = 'https://thesharepage.sofkpvtltd.com/image/logosharepage1.png';
        $message = '
            <!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Event Confirmation</title>
            </head>
            <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4; padding: 20px;">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0" width="800px" align="center" style="background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <tr>
                                    <td style="text-align: center; padding-bottom: 20px;">
                                        <img  alt="Logo" width="130" style="border: 0;" src="'.$logoUrl.'">
                                    </td>
                                </tr>
                            
                                <tr>
                                    <td style="padding-bottom: 5px;padding-left: 10px; font-size: 18px; font-weight: bold; color: #333333;">
                                        Event Details
                                    </td>
                                </tr>                         
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Name:</strong></td>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['name'] . '</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Location:</strong></td>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['location'] . '</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Date of Event:</strong></td>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd; line-height:20px;">' . $data['dateOfEvent'] . '<br>'.$data['timeOfEvent'].'</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Registration date:</strong></td>
                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['paydate'] . '<br>' . $data['time_of_registration'] . '</td>
                                            </tr>
                                        </table>
                                        <table width="300px" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
                                            ' . $htm . '                                  
                                        </table>
                                    </td>
                                </tr>';

                                if ($data['ticket_price'] > 0) {
                                    $message .= '<tr>
                                        <td style="padding-bottom: 20px;padding-left: 10px; font-size: 16px;">                               
                                            <strong style="margin-right: 15px;line-height: 25px;">Sub Total : </strong>CAD ' . number_format((($data['ticket_price'] + $data['discountAmt']) - $data['ticket_gst']), 2, '.', ',') . '<br>
                                            <strong style="margin-right: 15px;line-height: 25px;">Discount : </strong>CAD ' . number_format($data['discountAmt'], 2, '.', ',') . ' ('.$data['discount_perce'].'%)<br>
                                            <strong style="margin-right: 15px;line-height: 25px;">GST : </strong>CAD ' . number_format($data['ticket_gst'], 2, '.', ',') . '<br>                                  
                                            <hr style="background: #000;margin:7px 0;height: 1px;">                                  
                                            <strong style="margin-right: 15px;color: green;">Total Amount : </strong>CAD ' . number_format($data['ticket_price'], 2, '.', ',') . '<br>
                                        </td>                            
                                    </tr>';
                                }
                                
                                $message .= '<tr>
                                    <td style="padding: 20px; text-align: center; background-color: #f4f4f4; font-size: 12px; color: #666666;">
                                        &copy; 2024 <a href="https://www.thesharepage.com/">The SharePage</a>. All rights reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body> 
            </html>';
        // echo $message;
        // exit;
        $subject = "Career Expo Registration Jan 28, 2025";

        $em = new _email;
        $em->send_all_email($to,$subject,$message);


		/********************************************/
		
		
    }
        /*sponsor */
    $sponsorTotalPrice = isset($_SESSION['sponsor']['sponsorTotalPrice'])?$_SESSION['sponsor']['sponsorTotalPrice']:'';  
    if($sponsorTotalPrice == 0){      
      
        $user_id = isset($_SESSION['uid'])?$_SESSION['uid']:'';
        $fistname = isset($_SESSION['login_user'])?$_SESSION['login_user']:'';
        $event_id = isset($_SESSION['sponsor']['sponsor_id'])?$_SESSION['sponsor']['sponsor_id']:'';
        $registration_type = isset($_SESSION['sponsor']['registration_type'])?$_SESSION['sponsor']['registration_type']:'';        
        $ticket_price = isset($_SESSION['sponsor']['sponsorTotalPrice'])?$_SESSION['sponsor']['sponsorTotalPrice']:'';
        $discountAmt = isset($_SESSION['sponsor']['sponsor_discountAmt'])?$_SESSION['sponsor']['sponsor_discountAmt']:'';
        $ticket_gst = isset($_SESSION['sponsor']['sponsorGst'])?$_SESSION['sponsor']['sponsorGst']:'';   
        $sponsorDescription = isset($_SESSION['sponsor']['sponsorDescription'])?$_SESSION['sponsor']['sponsorDescription']:'';   ;
        $formType = 'sponsor';
        $pyament_status = 'succes';

        $eventsql = "INSERT INTO register_event(user_id,event_id,formType, registration_type,ticket_price,discount_amt,ticket_gst,fistname,lastname,email,card_number,card_month,card_cvv,card_name,billing_address,postcode,country,province,city,pyament_status,description) VALUES ('".$user_id."','".$event_id."','".$formType."','".$registration_type."','".$ticket_price."','".$discountAmt."','".$ticket_gst."','".$fistname."','".$lastname."','".$email."','".$card_number."','".$card_month."','".$card_cvv."','".$card_name."','".$billing_address."','".$postcode."','".$country."','".$province."','".$city."','".$pyament_status."','".$sponsorDescription."')";  
        $eventquery = mysqli_query($dbConn, $eventsql);    

        $statussql = "UPDATE register_event SET pyament_status = 'success' WHERE id = ".$last_id;
        $statusquery = mysqli_query($dbConn, $statussql);  
        $pay_status = 'succes';
        $paymentAmountZero = false;
       
    }

    if(isset($_POST['submit_pay'])){

        $user_id = isset($_SESSION['uid'])?$_SESSION['uid']:'';
        
        if(isset($_SESSION['event']['ticket_price']) && isset($_SESSION['event']['discountAmt']) && isset($_SESSION['event']['ticket_gst'])){            
            $event_id = isset($_SESSION['event']['event_id'])?$_SESSION['event']['event_id']:'';
            $registration_type = isset($_SESSION['event']['registration_type'])?$_SESSION['event']['registration_type']:'';
            $ticket_price = isset($_SESSION['event']['ticket_price'])?$_SESSION['event']['ticket_price']:'';
            $discountAmt = isset($_SESSION['event']['discountAmt'])?$_SESSION['event']['discountAmt']:'';
            $ticket_gst = isset($_SESSION['event']['ticket_gst'])?$_SESSION['event']['ticket_gst']:'';            
        }
        $sponsorDescription = '';
        if(isset($_SESSION['sponsor']['sponsorTotalPrice']) && isset($_SESSION['sponsor']['sponsor_discountAmt']) && isset($_SESSION['sponsor']['sponsorGst'])){
            $event_id = isset($_SESSION['sponsor']['sponsor_id'])?$_SESSION['sponsor']['sponsor_id']:'';
            $registration_type = isset($_SESSION['sponsor']['registration_type'])?$_SESSION['sponsor']['registration_type']:'';        
            $ticket_price = isset($_SESSION['sponsor']['sponsorTotalPrice'])?$_SESSION['sponsor']['sponsorTotalPrice']:'';
            $discountAmt = isset($_SESSION['sponsor']['sponsor_discountAmt'])?$_SESSION['sponsor']['sponsor_discountAmt']:'';
            $ticket_gst = isset($_SESSION['sponsor']['sponsorGst'])?$_SESSION['sponsor']['sponsorGst']:'';   
            $sponsorDescription = isset($_SESSION['sponsor']['sponsorDescription'])?$_SESSION['sponsor']['sponsorDescription']:'';   ;
        }    
        
        $fistname = isset($_POST['fistname'])?$_POST['fistname']:'';
        $lastname = isset($_POST['lastname'])?$_POST['lastname']:'';
        $email = isset($_POST['email'])?$_POST['email']:'';
        $card_number = isset($_POST['card_number'])?$_POST['card_number']:'';
        $card_month = isset($_POST['card_month'])?$_POST['card_month']:'';
        $card_cvv = isset($_POST['card_cvv'])?$_POST['card_cvv']:'';
        $card_name = isset($_POST['card_name'])?$_POST['card_name']:'';
        $billing_address = isset($_POST['billing_address'])?$_POST['billing_address']:'';
        $postcode = isset($_POST['postcode'])?$_POST['postcode']:'';
        $country = isset($_POST['country'])?$_POST['country']:'';
        $province = isset($_POST['province'])?$_POST['province']:'';
        $city = isset($_POST['city'])?$_POST['city']:'';
        $pyament_status = 'pending';
        $formType = '';
        // print_r($_SESSION);
        // exit;
        if (isset($_SESSION['formType']) && $_SESSION['formType'] == 'event') {
            $formType = 'event';
        }
        if (isset($_SESSION['formType']) && $_SESSION['formType'] == 'sponsor') {
            $formType = 'sponsor';
        }

        $eventsql = "INSERT INTO register_event(user_id,event_id,formType, registration_type,ticket_price,discount_amt,ticket_gst,fistname,lastname,email,card_number,card_month,card_cvv,card_name,billing_address,postcode,country,province,city,pyament_status,description) VALUES ('".$user_id."','".$event_id."','".$formType."','".$registration_type."','".$ticket_price."','".$discountAmt."','".$ticket_gst."','".$fistname."','".$lastname."','".$email."','".$card_number."','".$card_month."','".$card_cvv."','".$card_name."','".$billing_address."','".$postcode."','".$country."','".$province."','".$city."','".$pyament_status."','".$sponsorDescription."')";  
        $eventquery = mysqli_query($dbConn, $eventsql);        
        $last_id = $dbConn->insert_id;
        

        if(!empty($_POST['stripeToken']) && $ticket_price > 0){
            $cardmy = explode('/', $card_month);
            $cmonth = $cardmy[0];
            $cyear = $cardmy[1];
            // get token and user details
            $stripeToken  = $_POST['stripeToken'];
            $customerName = $fistname .' '.$lastname;
            $cardNumber = $card_number;
            $cardCVC = $card_cvv;
            $cardExpMonth = $cmonth;
            $cardExpYear = $cyear; 
            $cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;


            //include Stripe PHP library
            require_once('../stripe-php/init.php'); 
            
            //set stripe secret key and publishable key
            $stripe = array(
            "secret_key"      => SECRET_KEY,
            "publishable_key" => PUBLIC_KEY
            //"secret_key"      => 'sk_test_cQeXAPPqlbRpiQ4QWmU9sr9o', //SECRET_KEY,
            //"publishable_key" => 'pk_test_qrF3o2A0vHlbhxSOf6nOMpCa' //PUBLIC_KEY
            );    
            \Stripe\Stripe::setApiKey($stripe['secret_key']);    


            try{ 
                //add customer to stripe
                $customer = \Stripe\Customer::create(array(
                    'name' => $customerName,
                    'description' =>  'PRO TITLE',
                    'email' => $email,
                    'source'  => $stripeToken,
                    "address" => ["city" => $city, "country" => $country, "line1" => $billing_address, "line2" => "", "postal_code" => $postcode, "state" => $province]
                    ));  
                    // item details for which payment made
                    //$seller_id = $_POST['seller_id'];
                    //$itemPrice = number_format($_POST['price'], 2, '.', '');
                    //$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
                    $totalAmount = $ticket_price;
                    //$totalAmount = $totalprice;  //$totalprice
                    $currency = 'CAD';
                    //$orderQty = $_POST['spOrderQty'];
                    $orderNumber ="WER12345";   
                    //print_r($_POST); die('=================');
                    // details for which payment performed
                    $payDetails = \Stripe\Charge::create(array(
                    'customer' => $customer->id,
                    'amount'   => (int)$totalAmount*100,
                    'currency' => $currency,
                    'description' => 'ITEM NAME',
                    'metadata' => array(
                    'order_id' => $orderNumber
                    )
                )); 

                $paymenyResponse = $payDetails->jsonSerialize();
                /*echo "<pre>";
                print_r($paymenyResponse);*/
                //exit;
                if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
                    if($paymenyResponse['status'] == 'succeeded'){
                        $pay_status = 'succes';
                        $statussql = "UPDATE register_event SET transactions_id = '".$paymenyResponse['id']."',  pyament_status = 'success' WHERE id = ".$last_id;
                        $statusquery = mysqli_query($dbConn, $statussql);  
                        

                        $data = [
                            'BaseUrl'=>$BaseUrl,
                            'name' => 'CAREER AND INNOVATION EXPO',
                            'location' => '900 West Georgia St. Vancouver, British Columbia , Canada, V6C 2W6',            
                            'registration_type' => $registration_type,
                            'ticket_price' => $ticket_price,
                            'discountAmt' => $discountAmt,
                            'ticket_gst' => $ticket_gst,
                            'formType' =>$formType,
                            'paydate'=> date('F j, Y'),
                            'dateOfEvent'=>'March 26, 2025',

                            'time_of_registration'=>getCurrentFormattedTime(),
                        ];
                        
                        // sendEventSuccessEmail($email,$data);
                        /*************for email fixing***************/
            
                        $to = $email ;
                        $subject = "The SharePage Event Registration Successful";

                        // Construct the registration package table rows
                        $htm = '';
                        if ($data['formType'] == 'event') {
                            if (isset($data['registration_type'])) {                   
                                $package = json_decode($data['registration_type']);
                                $package_rows = '';
                                foreach ($package as $value) {
                                    $package_rows .= '
                                        <tr>
                                            <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>' . $value->reg_name . '</strong></td>
                                            <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd">' . number_format($value->price, 2,'.', ',') . ' X ' . $value->quantity . '</td>
                                        </tr>';
                                }
                                $htm = $package_rows;
                            }
                        } else {
                            if (isset($data['registration_type'])) {                   
                                $package = json_decode($data['registration_type']);
                                $htm = '
                                    <tr>    
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd"><strong>' . $package->name . '</strong></td>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd">' . number_format($package->value, 2, '.', ',') . '</td>
                                    </tr>';
                            } 
                        }

                        $logoUrl = $data['BaseUrl'] . '/image/logosharepage%201.png'; // Ensure this path is correct and accessible

                        // $logoUrl = 'https://thesharepage.sofkpvtltd.com/image/logosharepage1.png';
                        $message = '
                            <!DOCTYPE html>
                            <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Event Confirmation</title>
                            </head>
                            <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4; padding: 20px;">
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" border="0" width="800px" align="center" style="background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                                <tr>
                                                    <td style="text-align: center; padding-bottom: 20px;">
                                                        <img  alt="Logo" width="130" style="border: 0;" src="'.$logoUrl.'">
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td style="padding-bottom: 5px;padding-left: 10px; font-size: 18px; font-weight: bold; color: #333333;">
                                                        Event Details
                                                    </td>
                                                </tr>                         
                                                <tr>
                                                    <td style="padding-bottom: 20px;">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Name:</strong></td>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['name'] . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Location:</strong></td>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['location'] . '</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Date of Event:</strong></td>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd; line-height:20px;">' . $data['dateOfEvent'] . '<br>'.$data['timeOfEvent'].'</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Registration date:</strong></td>
                                                                <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['paydate'] . '<br>' . $data['time_of_registration'] . '</td>
                                                            </tr>
                                                        </table>
                                                        <table width="300px" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
                                                            ' . $htm . '                                  
                                                        </table>
                                                    </td>
                                                </tr>';

                                                if ($data['ticket_price'] > 0) {
                                                    $message .= '<tr>
                                                        <td style="padding-bottom: 20px;padding-left: 10px; font-size: 16px;">                               
                                                            <strong style="margin-right: 15px;line-height: 25px;">Sub Total : </strong>CAD ' . number_format((($data['ticket_price'] + $data['discountAmt']) - $data['ticket_gst']), 2, '.', ',') . '<br>
                                                            <strong style="margin-right: 15px;line-height: 25px;">Discount : </strong>CAD ' . number_format($data['discountAmt'], 2, '.', ',') . ' ('.$data['discount_perce'].'%)<br>
                                                            <strong style="margin-right: 15px;line-height: 25px;">GST : </strong>CAD ' . number_format($data['ticket_gst'], 2, '.', ',') . '<br>                                  
                                                            <hr style="background: #000;margin:7px 0;height: 1px;">                                  
                                                            <strong style="margin-right: 15px;color: green;">Total Amount : </strong>CAD ' . number_format($data['ticket_price'], 2, '.', ',') . '<br>
                                                        </td>                            
                                                    </tr>';
                                                }
                                                
                                                $message .= '<tr>
                                                    <td style="padding: 20px; text-align: center; background-color: #f4f4f4; font-size: 12px; color: #666666;">
                                                        &copy; 2024 <a href="https://www.thesharepage.com/">The SharePage</a>. All rights reserved.
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </body> 
                            </html>';
                        // echo $message;
                        // exit;
                        $subject = "Career Expo Registration Jan 28, 2025";
                    
                        $em = new _email;
                        $em->send_all_email($to,$subject,$message);

                        /********************************************/

                    }else{
                        $pay_status = 'fail';
                        $statussql = "UPDATE register_event SET transactions_id = '".$paymenyResponse['id']."',  pyament_status = 'fail' WHERE id = ".$last_id;  
                        $statusquery = mysqli_query($dbConn, $statussql);  
                    }
                }
            }
            catch (Error\Card $e) { 

                $paymentMessage ='Your card was declined '. $e->getMessage().'card_declined '.$e->getStripeCode().'generic_decline '.$e->getDeclineCode().'exp_month '. $e->getStripeParam();            
                $pay_status = 'fail';
            }
            catch (Error\InvalidRequest $e) { 

                $paymentMessage = "<strong>".ucfirst($e->getStripeParam())."</strong> ".$e->getMessage();
                $pay_status = 'fail';
            } 
            catch (\Exception $e) { 
                $paymentMessage = "<strong>".ucfirst($e->getStripeParam())." </strong> ".$e->getMessage();
                $pay_status = 'fail';
            } 
            
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <link rel="stylesheet" href="../assets/css/landingpage/style.css">
        <link rel="stylesheet" href="../assets/css/landingpage/all.css">  <!-- fontawesome icon -->

        <!--<link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.css">-->
        <!--<link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.min.css">-->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../image/logosharepage 1.png">

        <?php include('../component/f_links.php');  ?> 
        <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.css">
        <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.min.css">        
        <?php // include '../component/custom.css.php';?>
        <script>document.getElementsByTagName("html")[0].className += " js";</script>
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/media.css">
        <link rel="stylesheet" href="assets/css/style.scss">
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script>
            Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');
        </script>
		<style>
		select{
			height: 32px !important;
			margin-top: 7px !important;
			font-size: 11px !important;
			background: #f9fafb !important;
			}
		</style>
    </head>
    <body>
        <header class="header inr-logo">
            <div class="container-fluid">
                <nav class="row">
                    <div class="col-md-3 logo">
                        <a href="<?php echo $BaseUrl; ?>">
                        <img src="../image/logosharepage 1.png" alt="logo">
                        <span class="a">The SharePage</span>
                        </a>
                    </div>
                    <div class="col-md-9">
                        <div class="row justify-content-lg-end">
                            <div id="slide-bar" >
                                <div id="toggle" class="d-flex"></div>
                            </div>
                            <ul id="sidebar" class="row menu">
                                <li><a href="#" class="active">Home</a></li>
                                <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=investment_opportunities">Investment Opportunities</a></li> -->
                                <li><a href="<?php echo $BaseUrl;?>/page/?page=referral__commissions">Earning Opportunities</a></li>
                                <li><a href="<?php echo $BaseUrl;?>/page/event.php?page=event">Event</a></li>
                                <li><a href="<?php echo $BaseUrl;?>/page/howtos.php?page=howtos">How To</a></li>
                                <?php if (isset($_SESSION['uid'])) { ?>
                                    <li><a href="<?php echo $BaseUrl . '/timeline'; ?>"  class="timeline btn-border-radius">My Timeline</a></li>
                                    <li><a href="<?php echo $BaseUrl . '/authentication/logout.php'; ?>"  class="timeline btn-border-radius">Log Out</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- <div class="col-md-2 bar">

                        <div class="bar-1"></div>
                        <div class="bar-2"></div>
                        <div class="bar-3"></div>
                    </div> -->

                </nav>
            </div>
        </header>
        <style>
            a:hover,button:hover{    opacity: 0.8;
            color: #fff;}
            .clearfix:before, .clearfix:after, .dl-horizontal dd:before, .dl-horizontal dd:after, .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after, .form-horizontal .form-group:before, .form-horizontal .form-group:after, .btn-toolbar:before, .btn-toolbar:after, .btn-group-vertical > .btn-group:before, .btn-group-vertical > .btn-group:after, .nav:before, .nav:after, .navbar:before, .navbar:after, .navbar-header:before, .navbar-header:after, .navbar-collapse:before, .navbar-collapse:after, .pager:before, .pager:after, .panel-body:before, .panel-body:after, .modal-header:before, .modal-header:after, .modal-footer:before, .modal-footer:after{display:none;}
        </style>
        <div class="container first_share_events">
            <div class="career_login">
                <div class="container">
                    <div class="career_login_div">
                        <h2>The SharePage Events</h2>
                        <!--<a href="#">login / dashboard</a>-->
                        <?php if(isset($_SESSION['uid'])){?>
                            <a href="<?php echo $BaseUrl?>/events/dashboard/booking.php"> My Bookings</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="career_banner">
                <div class="container">
                    <div class="career_banner_div">
                        <img src="<?php echo $BaseUrl;?>/assets/img/event_page1.png">
                    </div>
                    <div class="career_cards_excpo">
                        <div class="career_cards_first">
                            <h2>CAREER AND INNOVATION EXPO</h2>
                            <div class="career_cards_first_icon">
                                <a href="#"><img src="<?php echo $BaseUrl;?>/assets/img/like_svg.svg" alt=""></a>
                                <a href="#"><img src="<?php echo $BaseUrl;?>/assets/img/wishlist_svg.svg" alt=""></a>
                                <a href="#"><img src="<?php echo $BaseUrl;?>/assets/img/share_svg.svg" alt=""></a>
                            </div>
                        </div>        
                    </div>
                    <div class="discount_text">
                        <p>
                            Early Bird Special! <br>
                            15% off if you register before February 28, 2025. <br>
                            Don’t miss out—secure your spot and save! <br>
                            <a target="_blank" href="<?php echo $BaseUrl;?>/assets/CAREER-INNOVATION EXPO_JAN28_2025.pdf" target="_blank">Find out about more exciting discounts we have for you!</a> <br>
                        </p>
                    </div>
                </div>
            </div>
            <section class="date_and_time">
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="date_title">
                                <h4>Date and Time</h4>
                            </div>
                            <p class="date_and_time_detail">
                                Wednesday, March 26, 2025,<br>
                                10am to 4pm EST
                                <br><br>
                                <!-- At Fairmont Hotel, BC BallRoom <br>
                                900 W. BURRARD ST. Vancouver, BC -->
                                900 West Georgia St. Vancouver,<br> BC, Canada, V6C 2W6
                            </p>
                            <div class="date_title">
                                <h4>Event Detail</h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="button">
                                <button type="button" id="register_btn" class="btn-lg register_btn" data-toggle="modal" data-target="#register">
                                    REGISTER
                                </button>
                                <button type="button" class="btn-lg sponsor_btn" data-toggle="modal" data-target="#sponsor">
                                    SPONSOR
                                </button>
                                <a target="_blank" href="<?php echo $BaseUrl;?>/assets/CAREER-INNOVATION EXPO_March26_2025.pdf" download class="download_brochure_btn">
                                    DOWNLOAD BROCHURE
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="career_and_expo_columns">
                <div class="container">
                    <div class="row left">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="content">
                                <div class="title">
                                    <h4>EMPLOYERS/RECRUITING AGENCIES</h4>
                                </div>
                                <p>Attract top talent to your organization at our Job and Innovation Fair. This event offers employers a unique platform to engage with a diverse pool of job seekers who are eager to make a difference. Promote your open positions, conduct on-the-spot interviews, and build relationships with potential employees. Don't miss the chance to find the perfect candidates for your team.</p>
                                <!--<ul class="disc">-->
                                <!--    <li>Capacity: 5000</li>-->
                                <!--    <li>Highlights: Groove To The Beats Of Local And-->
                                <!--        Headliner DJs In An Electrifying Outdoor-->
                                <!--        Music Experience. Dance The Day Away With-->
                                <!--        The Stunning Backdrop Of False Creek.</li>-->
                                <!--    <li>Special Finale: As The Sun Sets, Prepare To-->
                                <!--        Be Mesmerized By A Spectacular Live Drone-->
                                <!--        Show Over The Water. Enjoy Synchronized DJ-->
                                <!--        Music And An Unparalleled 3D View Of The-->
                                <!--        Drone Show, Exclusively Available To Ticket-->
                                <!--        Holders Within The Main Music Stage Area</li>-->
                                <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                                <!--</ul>-->
                                <div class="button">
                                    <button type="button" class="btn-lg register_btn" data-toggle="modal" data-target="#register">
                                        REGISTER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="image">
                                <img src="<?php echo $BaseUrl;?>/assets/img/recruiter.png" alt="" >
                            </div>
                        </div>
                    </div>
                    <div class="row right">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="image">
                                <img src="<?php echo $BaseUrl;?>/assets/img/job_seeker.png" alt="" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="content">
                                <div class="title">
                                    <h4>JOB SEEKERS</h4>
                                </div>
                                <p>Are you looking for your next big career move? Our Job and Innovation Fair is the perfect opportunity to connect with top employers across various industries. Meet recruiters face-to-face, explore a wide range of job opportunities, and showcase your skills to potential employers. Whether you are just starting out or looking for a new challenge, this fair will give you the chance to take your career to the next level.</p>
                                <!--<ul>-->
                                <!--    <li>Capacity: 5000</li>-->
                                <!--    <li>Highlights: Groove To The Beats Of Local And-->
                                <!--        Headliner DJs In An Electrifying Outdoor-->
                                <!--        Music Experience. Dance The Day Away With-->
                                <!--        The Stunning Backdrop Of False Creek.</li>-->
                                <!--    <li>Special Finale: As The Sun Sets, Prepare To-->
                                <!--        Be Mesmerized By A Spectacular Live Drone-->
                                <!--        Show Over The Water. Enjoy Synchronized DJ-->
                                <!--        Music And An Unparalleled 3D View Of The-->
                                <!--        Drone Show, Exclusively Available To Ticket-->
                                <!--        Holders Within The Main Music Stage Area</li>-->
                                <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                                <!--</ul>-->
                                <div class="button">
                                    <button type="button" class="btn-lg register_btn" data-toggle="modal" data-target="#register">
                                        REGISTER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row left">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="content">
                                <div class="title">
                                    <h4>FREELANCERS</h4>
                                </div>
                                <p>Take your freelance business to the next level by securing a booth at our Job and Innovation Fair. This is a great opportunity to showcase your services to a wide audience of businesses and individuals seeking specialized skills. Whether you’re a designer, writer, developer, or consultant, you’ll have the chance to network, gain new clients, and grow your freelance business.</p>
                                <!--<ul class="disc">-->
                                <!--    <li>Capacity: 5000</li>-->
                                <!--    <li>Highlights: Groove To The Beats Of Local And-->
                                <!--        Headliner DJs In An Electrifying Outdoor-->
                                <!--        Music Experience. Dance The Day Away With-->
                                <!--        The Stunning Backdrop Of False Creek.</li>-->
                                <!--    <li>Special Finale: As The Sun Sets, Prepare To-->
                                <!--        Be Mesmerized By A Spectacular Live Drone-->
                                <!--        Show Over The Water. Enjoy Synchronized DJ-->
                                <!--        Music And An Unparalleled 3D View Of The-->
                                <!--        Drone Show, Exclusively Available To Ticket-->
                                <!--        Holders Within The Main Music Stage Area</li>-->
                                <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                                <!--</ul>-->
                                <div class="button">
                                    <button type="button" class="btn-lg register_btn" data-toggle="modal" data-target="#register">
                                        REGISTER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="image">
                                <img src="<?php echo $BaseUrl;?>/assets/img/freelancer.png" alt="" >
                            </div>
                        </div>
                    </div>
                    <div class="row right">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="image">
                                <img src="<?php echo $BaseUrl;?>/assets/img/start_up.png" alt="" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="content">
                                <div class="title">
                                    <h4>START-UPS</h4>
                                </div>
                                <p>Elevate your startup by participating in our Job and Innovation Fair. This event is designed to help you gain visibility, attract potential clients, and connect with investors who can help take your business to the next level. Present your innovative ideas, network with other entrepreneurs, and showcase what makes your startup unique. This is your chance to shine and scale your business.</p>
                                <!--<ul>-->
                                <!--    <li>Capacity: 5000</li>-->
                                <!--    <li>Highlights: Groove To The Beats Of Local And-->
                                <!--        Headliner DJs In An Electrifying Outdoor-->
                                <!--        Music Experience. Dance The Day Away With-->
                                <!--        The Stunning Backdrop Of False Creek.</li>-->
                                <!--    <li>Special Finale: As The Sun Sets, Prepare To-->
                                <!--        Be Mesmerized By A Spectacular Live Drone-->
                                <!--        Show Over The Water. Enjoy Synchronized DJ-->
                                <!--        Music And An Unparalleled 3D View Of The-->
                                <!--        Drone Show, Exclusively Available To Ticket-->
                                <!--        Holders Within The Main Music Stage Area</li>-->
                                <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                                <!--</ul>-->
                                <div class="button">
                                    <button type="button" class="btn-lg register_btn" data-toggle="modal" data-target="#register">
                                        REGISTER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row left">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="content">
                                <div class="title">
                                    <h4>Businesses: Promote Your Brand at the Career & Innovation Expo!</h4>
                                </div>
                                <p>Businesses have the opportunity to showcase their services and products at dedicated booths during the expo. Whether you're launching a new product or promoting your existing offerings, this is the perfect platform to engage with a diverse audience, build brand awareness, and attract new customers. Don't miss the chance to connect directly with potential clients, boost your visibility, and elevate your brand in an exciting, interactive environment!</p>                   
                                <div class="button">
                                    <button type="button" class="btn-lg register_btn" data-toggle="modal" data-target="#register">
                                        REGISTER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="image">
                                <img src="<?php echo $BaseUrl;?>/assets/img/buisness.png" alt="" >
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="date_and_time map">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="date_title">
                                <h4>Date and Time</h4>
                            </div>
                            <p class="date_and_time_detail">
                                Wednesday, March 26, 2025,<br>
                                10am to 4pm EST
                                <br><br>
                            

                                <!-- At Fairmont Hotel, BC BallRoom<br> -->
                                900 West Georgia St. Vancouver,<br> BC, Canada, V6C 2W6
                            </p>
                            <div class="date_title">
                                <h4>Hotel Booking</h4>
                            </div>
                            <p class="click_here_room_rate">
                            Hotel accommodation is available at a discounted rate.
                                <br><br>
                                <a href="<?php echo $BaseUrl;?>/contact.php"  style="">Contact us for more details</a>
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="image">
                                <!--<img src="<?php echo $BaseUrl;?>/assets/img/map.png" alt="" >-->
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.6139883541728!2d-123.12588120321045!3d49.283711200000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca8a831ddfdb11d%3A0x1ef4a42318d00a33!2sFairmont%20Hotel%20Vancouver!5e0!3m2!1sen!2sin!4v1725428123672!5m2!1sen!2sin" width="445" height="375" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>   
        </div>
        <div class="modal" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <?php if((!isset($_SESSION['uid']) && $_SESSION['uid'] == '') || $_SESSION['event_user'] == 0){ ?>
                    <div class="register_popss" id="step_1">
                        <div class="modal-content">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                            <!--  <span aria-hidden="true">&times;</span>-->
                            <!--</button>-->
                            <div class="modal-body">
                                <div class="register_popup">
                                    <h2>CAREER AND INNOVATION EXPO</h2>
                                    <h3> March 26, 2025</h3>
                                    <h4>900 West Georgia St. Vancouver,<br> BC, Canada, V6C 2W6</h4>
                                    <h5>SELECT REGISTRATION TYPE</h5>
                                    <?php                                                                
                                    $sql =  "SELECT * FROM registration_type where type = 'event'";
                                    $result  = mysqli_query($dbConn, $sql);
                                    if ($result->num_rows > 0) {            
                                    ?>
                                        <div class="register_type">
                                            <ul>
                                                <?php while($row = $result->fetch_assoc()) {?>
                                                <li>
                                                    <input type="hidden" name="price" id="price" class="form-control input-number" value="<?php echo $row['price'];?>" >
                                                    <input type="hidden" name="reg_name" id="reg_name" class="form-control input-number" value="<?php echo $row['name'];?>" >  
                                                    <input type="hidden" name="reg_id" id="reg_id" class="form-control input-number" value="<?php echo $row['id'];?>" >                                        
                                                    <p><?php echo $row['name'];?> (CAD <?php echo $row['price'];?>) </p>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number"
                                                                data-type="minus" data-field="quant[1]">
                                                                <span class="glyphicon glyphicon-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quantity" class="form-control input-number"
                                                            value="0" min="0" >                                            
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number"
                                                                data-type="plus" data-field="quant[1]">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </li>
                                                <?php } ?>                                    
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    <div class="btms_gst">
                                        <div class="register_sub_total">
                                            <p>Sub Total <span class="sub_total">CAD 0.00</span></p>
                                            <?php
                                                $date = new DateTime();                                
                                                $day = $date->format('d'); 
                                                $month = $date->format('m'); 
                                                $year = $date->format('Y');
                                                
                                                // Initialize discount value
                                                $discount_value = 0;

                                                // Check if the current date is before Feb 28
                                                if(($month == '2' && $day <28) ){
                                                    $discount_value = 15; // Set discount for Feb
                                                } 
                                            ?>
                                            <p>Discount <span class="discount" data-disountValue="<?= $discount_value?>">CAD 0.00</span></p>
                                                    
                                            <p>5% GST <span class="gst_totals">CAD 0.00</span></p>

                                        </div>
                                        <hr>
                                        <div class="register_total">
                                            <p>Total Amount <span class="final_total">CAD 0.00</span></p>
                                        </div>
                                        <form action="<?php echo $BaseUrl;?>/sign-up.php" method="post">
                                            <div class="get_tcks_grps">
                                                    <a href="javascript:void(0);" id="show_step_2">Get Ticket</a>
                                                    <input type="hidden" name="event_id" id="event_id" value="1">
                                                    <input type="hidden" name="registration_type" id="registration_type">
                                                    <input type="hidden" name="ticket_price" id="ticket_price">
                                                    <input type="hidden" name="discountAmt" id="discountAmt">
                                                    <input type="hidden" name="ticket_gst" id="ticket_gst" value="">
                                                    <button type="submit" id="event_user" name="event_user" value="event_user" class="d-none"></button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div> -->
                        </div>
                        <div class="pops_btm_para">
                            <p>Note: Please login or create an account to register for this event</p>
                        </div>
                    </div>
                <?php }else{ ?>
                    <?php if(isset($pay_status) && $pay_status == 0)
                    { ?>
                    <script>
                        $( document ).ready(function() {
                            $('#register_btn').trigger('click');
                        });
                    </script>
                    <div class="register_popss" id="step_2">
                        <div class="modal-content">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                            <!--  <span aria-hidden="true">&times;</span>-->
                            <!--</button>-->
                            <div class="modal-body">
                                    <div class="register_popup registrate_booth">
                                    <h2>CAREER AND INNOVATION EXPO</h2>
                                    <h3> March 26, 2025</h3>
                                    <h4>900 West Georgia St. Vancouver,<br> BC, Canada, V6C 2W6</h4>
                                    
                                    <h6>Discount: <span><?php echo (isset($_SESSION['event']['discountAmt']) && !empty($_SESSION['event']['discountAmt'])) ?  'CAD '.number_format($_SESSION['event']['discountAmt'], 2) : 'CAD 00.00';?></span></h6> 

                                    <h6>Total Amount: <span><?php echo isset($_SESSION['event']['ticket_price']) ?  'CAD '.number_format($_SESSION['event']['ticket_price'], 2) : 'CAD 00.00';?></span></h6> 
                                    <div class="ttls_upds">
                                        <a href="#">UPDATE</a>
                                    </div>
                                    <div class="btms_gst">
                                        <form action="" method="post" id="paymentForm">
                                            <div class="card_payment_sec">
                                                <div class="card_span">
                                                    <img src="<?php echo $BaseUrl;?>/assets/img/card_Vector.png" alt="">
                                                    <span>Card</span>
                                                </div>
                                                <?php  

                                                if(isset($_SESSION['uid'])){        
                                                    $sql2 =  "SELECT * FROM `spuser` WHERE `idspUser` = ".$_SESSION['uid'];
                                                    $result2  = mysqli_query($dbConn, $sql2);
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                }
                                                    
                                                ?>

                                                    
                                                <div class="paymenrts_dls_pop">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fistname">First Name <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="fistname" name="fistname" placeholder="First Name" value="<?php echo isset($row2['spUserFirstName']) ? $row2['spUserFirstName'] : ''; ?>" required>
                                                                    <span id="errorfistname" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="lastname">Last Name <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="lastname"  name="lastname" placeholder="Last Name" value="<?php echo isset($row2['spUserLastName']) ? $row2['spUserLastName'] : ''; ?>" required>
                                                                    <span id="errorlastname" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email Address <span>*</span> </label>
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?php echo isset($row2['spUserFirstName']) ? $row2['spUserEmail'] : ''; ?>" required>
                                                            <span id="erroremail" class="text-danger"></span>
                                                        </div>
                                                        <!-- <div class="form-group form-check">

                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                            <label class="form-check-label" for="exampleCheck1">Use as billing
                                                                name</label>
                                                        </div> -->

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail3">Card Number <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="cardNumber" name="card_number" aria-describedby="emailHelp" placeholder="0000 0000 0000 0000" maxlength="16" required>
                                                                    <span id="errorCardNumber" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            
                                                                    <input type="hidden" class="form-control" id="cardExpMonth" name="card_month" aria-describedby="emailHelp" placeholder="MM/YY"  required value='01/24'>
                                                                   
                                                            </div-->
															<div class="col-md-3">
																<label for="">Exp MM/YY<span>*</span></label>
																<div class='row'>
																<select class="form-control col-sm-6" id='card_ex_mm'>
																	<?php for($i=1;$i<=12;$i++){ ?>
																	<option><?=sprintf('%02d',$i) ?></option>
																	<?php } ?>
																</select>
																<select class="form-control col-sm-6"  id='card_ex_yy'>
																	<?php for($i=24;$i<=30;$i++){ ?>
																	<option><?= $i ?></option>
																	<?php } ?>
																</select>
																</div>
															</div>
															
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail5">CVV <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="cardCVC" name="card_cvv" aria-describedby="emailHelp" placeholder="CVV" maxlength="3" required>
                                                                    <span id="errorCardCvc" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword6">Card Holders Name <span>*</span>
                                                            </label>
                                                            <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Card Holders Name" required>
                                                            <span id="errorcard_name" class="text-danger"></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword7">Billing address
                                                                        <span>*</span> </label>
                                                                    <input type="text" class="form-control" placeholder="Billing Address" id="billing_address" name="billing_address" required>
                                                                    <span id="errorbilling_address" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="postcode">Postal Code
                                                                        <span>*</span> </label>
                                                                    <input type="text" class="form-control" id="postcode" placeholder="Postal Code" id="postcode" name="postcode" required>
                                                                    <span id="errorpostcode" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect2">Country
                                                                        <span>*</span></label>
                                                                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>                                                            
                                                                    <!-- <select class="form-control" id="exampleFormControlSelect2">

                                                                        <option>Country</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                    </select> -->

                                                                    <span id="errorcountry" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect3">Province
                                                                        <span>*</span></label>
                                                                    <input type="text" class="form-control" id="province" name="province" placeholder="province" required>                                                            
                                                                    <!-- <select class="form-control" id="exampleFormControlSelect3">

                                                                        <option>City</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                    </select> -->

                                                                    <span id="errorprovince" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect4">City
                                                                        <span>*</span></label>
                                                                    <input type="text" class="form-control" id="city" name="city" placeholder="city" required>                                                            
                                                                    <!-- <select class="form-control" id="exampleFormControlSelect4">

                                                                        <option>Country</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                    </select> -->

                                                                    <span id="errorcity" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input" id="save_details">
                                                            <label class="form-check-label" for="exampleCheck1">Save card details
                                                                for future</label>
                                                        </div>
                                                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                                    
                                                </div>
                                            </div>
                                            <div class="get_tcks_grps">
                                                <input type="hidden" name="submit_pay" value="pay">
                                                <button type="submit" class="btn btn-secondary" name="submit_pay" value="pay" id="payNow" onclick="stripePay(event)">Pay</button>
                                                <a href="<?= $BaseUrl;?>/page/event_details.php?destroy_register_session=true" id="show_step_4">Cancel</a>
                                            </div>
                                        </form>
                                        <div class="pops_btm_para">
                                            <p>Note: You have to login or create an account to purchase your ticket</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div> -->
                        </div>
                    </div>
                    <?php 
                    } 
                } ?>
                
                <?php 
                if(isset($pay_status) && $pay_status == 'succes'){ 

                    $_SESSION['event_user'] = 0;
                    $_SESSION['event'] = '';
                    // $sql = "SELECT * FROM register_event WHERE user_id = " . $_SESSION['uid'] . " AND id = " . $last_id;
                    // $result = dbQuery($dbConn, $sql);
                    // $data = '';
                    // while($row = mysqli_fetch_assoc($result)) {
                    //     $data = $row;
                    // }
                    // print_r($data);
                    // exit;
                ?>
                    <div class="register_popss" id="step_3">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="register_popup registrate_booth">
                                    <div class="step_three_pops">
                                        <a href="https://www.thesharepage.com">
                                            <img src="https://www.thesharepage.com/image/logosharepage%201.png" alt="logo">
                                            <span class="a">The SharePage</span>
                                        </a>
                                    </div>
                                    <div class="step_three_popscards">
                                        <img src="<?php echo $BaseUrl;?>/assets/img/check_green.png" alt="">                                 
                                        <?php
                                        if($paymentAmountZero){
                                            ?>
                                                <h2>Payment Successful !</h2>     
                                                <p>Thank you for registering for the Career and Innovation Expo! </p>                                      
                                                <h4>We have received payment amount of</h4>
                                                <h5><?php echo isset($ticket_price) ?  'CAD'.number_format($ticket_price, 2) : 'CAD 00.00';?></h5>
                                            <?php
                                        }else{
                                            ?>
                                            <h2>Register Success!</h2>
                                            <p>
                                                Thank you for registering for the Career and Innovation Expo! You can now create an Employment Profile to help recruiters easily find and connect with you! 
                                                <br>
                                                <br>
                                                Your event registration details are saved in the dashboard of Event Module- under “events attending” 
                                            </p>
                                            <?php
                                        }
                                        ?>
                                        <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details"  style="margin-top:10px;">Continue</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(isset($pay_status) && $pay_status == 'fail'){ 
                    $_SESSION['event_user'] = 0;
                    $_SESSION['event'] = '';
                    ?>
                <div class="register_popss" id="step_4">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="register_popup registrate_booth">
                                <div class="step_three_pops">
                                    <a href="https://www.thesharepage.com">
                                        <img src="https://www.thesharepage.com/image/logosharepage%201.png" alt="logo">
                                        <span class="a">The SharePage</span>
                                    </a>
                                </div>
                                <div class="step_three_popscards step_four_popscards">
                                    <img src="<?php echo $BaseUrl;?>/assets/img/fail_red.png" alt="">
                                    <h2>Payment Failed</h2>
                                    <h4>Something went wrong we couldn’t process your payment.</h4>
                                    <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details">Retry Payment</a>
                                </div>
                
                            </div>
                        </div>
                    </div>            
                </div>
                <?php } ?>
            </div>
        </div>


        <div class="modal" id="sponsor" tabindex="-1" role="dialog" aria-labelledby="sponsorLabel" aria-hidden="true" data-toggle="modal" data-target="#myModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <?php if ((!isset($_SESSION['uid']) && $_SESSION['uid'] == '') || $_SESSION['sponsor_user'] == 0) { ?>
                    <div class="register_popss">
                        <div class="register_pops_first_title">
                            <h2>CAREER AND INNOVATION EXPO</h2>
                            <h3> March 26, 2025</h3>
                            <h4>900 West Georgia St. Vancouver,<br> BC, Canada, V6C 2W6</h4>
                        </div>
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="register_popup spons_popup">
                                <?php
                                    
                                    
                                    ?>
                                    <h5>SPONSORSHIP REGISTRATION</h5>
                                    <div class="spon_packages">
                                        <form id="sponsorshipForm" method="post" action="<?php echo $BaseUrl; ?>/sign-up.php">
                                            <div class="form-group">
                                                <label for="sponsorshipPackage">Select Sponsorship Package <span>*</span></label>
                                                <select class="form-control" id="sponsorshipPackage">
                                                    <option value="0" data-id="" data-name="">Select Sponsorship Package</option>
                                                    <?php

                                                    $sql2 = "SELECT * FROM registration_type where type = 'sponsor'";
                                                    $result2 = mysqli_query($dbConn, $sql2);
                                                    if ($result2->num_rows > 0) {
                                                        while ($row2 = $result2->fetch_assoc()) { ?>

                                                            <option value="<?php echo $row2['price']; ?>"
                                                                    data-id="<?php echo $row2['id']; ?>"
                                                                    data-name="<?php echo $row2['name']; ?>">
                                                                <?php echo $row2['name']; ?> ($<?php echo $row2['price']; ?>)
                                                            </option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                            <!-- Hidden fields to store selected package data for form submission -->
                                            <input type="hidden" name="sponsor_id" id="sponsorId" value="1">
                                            <input type="hidden" name="sponsor_name" id="sponsorName">
                                            <input type="hidden" name="price" id="sponsorPrice">
                                            <input type="hidden" name="gst" id="sponsorGst">
                                            <input type="hidden" name="sponsor_discountAmt" id="sponsor_discountAmt">
                                            <input type="hidden" name="total_price" id="sponsorTotalPrice">
                                            <input type="hidden" name="description" id="sponsorDescription">

                                            <div class="form-group">
                                                <label for="description">Package Detail</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"
                                                        placeholder="Sponsorship Package Detail"></textarea>
                                            </div>

                                            <div class="btms_gst">
                                                <div class="register_sub_total">
                                                    <p>Sub Amount <span id="subTotalAmount">CAD 0.00</span></p>
                                                    <?php
                                                        $date = new DateTime();                                
                                                        $day = $date->format('d'); 
                                                        $month = $date->format('m'); 
                                                        $year = $date->format('Y');
                                                        
                                                        // Initialize discount value
                                                        $discount_value = 0;

                                                        // Check if the current date is before Feb 28
                                                        if(($month == '2' && $day <28) ){
                                                            $discount_value = 15; // Set discount for Feb
                                                        ?>
                                                            <p>Discount <span class="sponsor_discount" data-disountValue="<?= $discount_value?>">CAD 0.00</span></p>
                                                            <?php
                                                        }
                                                    ?>
                                                    <p>5% GST <span id="gstAmount">CAD 0.00</span></p>
                                                </div>
                                                <hr>
                                                <div class="register_total">
                                                    <p>Total Amount <span id="totalAmount">CAD 0.00</span></p>
                                                </div>

                                                <div class="cance_policy">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                                    <label for="exampleCheck1" style="margin-left: 20px;">I acknowledge that I have read and agree to the cancellation policy</label>
                                                </div>

                                                <div class="get_tcks_grps purchase_grps">
                                                    <a href="javascript:void(0);" id="purchaseBtn">PURCHASE</a>
                                                    <button type="submit" id="sponsor_user" name="sponsor_user" value="sponsor_user" class="d-none"></button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>
                    <script>               
                        $( document ).ready(function() {
                            $('.sponsor_btn').trigger('click');
                        });
                    </script>
                    <?php if(isset($pay_status) && $pay_status == 0)
                    { ?>
                    <div class="register_popss" id="sponsor_step_2">
                        <div class="modal-content">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                            <!--  <span aria-hidden="true">&times;</span>-->
                            <!--</button>-->
                            <div class="modal-body">                       
                                    <div class="register_popup registrate_booth">
                                    <h2>CAREER AND INNOVATION EXPO</h2>
                                    <h3> March 26, 2025</h3>
                                    <h4>900 West Georgia St. Vancouver,<br> BC, Canada, V6C 2W6</h4>                               
                                    <h6>Discount: <span><?php  echo isset($_SESSION['sponsor']['sponsor_discountAmt']) ?  'CAD'.number_format($_SESSION['sponsor']['sponsor_discountAmt'], 2) : 'CAD 00.00'; ?></span></h6>
                                    <h6>Total Amount: <span><?php echo isset($_SESSION['sponsor']['sponsorTotalPrice']) ?  'CAD'.number_format($_SESSION['sponsor']['sponsorTotalPrice'], 2) : 'CAD 00.00'; ?></span></h6>

                                    <div class="ttls_upds">
                                        <a href="#">UPDATE</a>
                                    </div>
                                    <div class="btms_gst">
                                        <form action="" method="post" id="paymentForm">
                                            <div class="card_payment_sec">
                                                <div class="card_span">
                                                    <img src="<?php echo $BaseUrl;?>/assets/img/card_Vector.png" alt="">
                                                    <span>Card</span>
                                                </div>
                                                <?php  

                                                if(isset($_SESSION['uid'])){        
                                                    $sql2 =  "SELECT * FROM `spuser` WHERE `idspUser` = ".$_SESSION['uid'];
                                                    $result2  = mysqli_query($dbConn, $sql2);
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                }
                                                    
                                                ?>

                                                    
                                                <div class="paymenrts_dls_pop">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fistname">First Name <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="fistname" name="fistname" placeholder="First Name" value="<?php echo isset($row2['spUserFirstName']) ? $row2['spUserFirstName'] : ''; ?>" required>
                                                                    <span id="errorfistname" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="lastname">Last Name <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="lastname"  name="lastname" placeholder="Last Name" value="<?php echo isset($row2['spUserLastName']) ? $row2['spUserLastName'] : ''; ?>" required>
                                                                    <span id="errorlastname" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email Address <span>*</span> </label>
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?php echo isset($row2['spUserFirstName']) ? $row2['spUserEmail'] : ''; ?>" required>
                                                            <span id="erroremail" class="text-danger"></span>
                                                        </div>
                                                        <!-- <div class="form-group form-check">

                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                            <label class="form-check-label" for="exampleCheck1">Use as billing
                                                                name</label>
                                                        </div> -->

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail3">Card Number <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="cardNumber" name="card_number" aria-describedby="emailHelp" placeholder="0000 0000 0000 0000" maxlength="16" required>
                                                                    <span id="errorCardNumber" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail4">MM/YY<span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="cardExpMonth" name="card_month" aria-describedby="emailHelp" placeholder="MM/YY" pattern="([0-9]{2}[/]?){2}" required>
                                                                    <span id="errorCardExpMonth" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail5">CVV <span>*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="cardCVC" name="card_cvv" aria-describedby="emailHelp" placeholder="CVV" maxlength="3" required>
                                                                    <span id="errorCardCvc" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword6">Card Holders Name <span>*</span>
                                                            </label>
                                                            <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Card Holders Name" required>
                                                            <span id="errorcard_name" class="text-danger"></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword7">Billing address
                                                                        <span>*</span> </label>
                                                                    <input type="text" class="form-control" placeholder="Billing Address" id="billing_address" name="billing_address" required>
                                                                    <span id="errorbilling_address" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="postcode">Postal Code
                                                                        <span>*</span> </label>
                                                                    <input type="text" class="form-control" id="postcode" placeholder="Postal Code" id="postcode" name="postcode" required>
                                                                    <span id="errorpostcode" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect2">Country
                                                                        <span>*</span></label>
                                                                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>                                                            
                                                                    <!-- <select class="form-control" id="exampleFormControlSelect2">

                                                                        <option>Country</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                    </select> -->

                                                                    <span id="errorcountry" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect3">Province
                                                                        <span>*</span></label>
                                                                    <input type="text" class="form-control" id="province" name="province" placeholder="province" required>                                                            
                                                                    <!-- <select class="form-control" id="exampleFormControlSelect3">

                                                                        <option>City</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                    </select> -->

                                                                    <span id="errorprovince" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect4">City
                                                                        <span>*</span></label>
                                                                    <input type="text" class="form-control" id="city" name="city" placeholder="city" required>                                                            
                                                                    <!-- <select class="form-control" id="exampleFormControlSelect4">

                                                                        <option>Country</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                    </select> -->

                                                                    <span id="errorcity" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input" id="save_details">
                                                            <label class="form-check-label" for="exampleCheck1">Save card details
                                                                for future</label>
                                                        </div>
                                                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                                    
                                                </div>
                                            </div>
                                            <div class="get_tcks_grps">
                                                <input type="hidden" name="submit_pay" value="pay">
                                                <button type="submit" class="btn btn-secondary" name="submit_pay" value="pay" id="payNow" onclick="stripePay(event)">Pay</button>
                                                <a href="<?= $BaseUrl;?>/page/event_details.php?destroy_sponsor_session=true" id="show_step_4">Cancel</a>
                                            </div>
                                        </form>
                                        <div class="pops_btm_para">
                                            <p>Note: You have to login or create an account to purchase your ticket</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div> -->
                        </div>
                    </div>
                    <?php } 
                } ?>
                <?php 
                if(isset($pay_status) && $pay_status == 'succes'){ 
                    $_SESSION['sponsor_user'] = 0;
                    $_SESSION['sponsor'] = '';
                    ?>
                <div class="register_popss" id="sponsor_step_3">
                    <div class="modal-content">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                        <!--  <span aria-hidden="true">&times;</span>-->
                        <!--</button>-->
                        <div class="modal-body">
                            <div class="register_popup registrate_booth">
                                <div class="step_three_pops">
                                    <a href="https://www.thesharepage.com">
                                        <img src="https://www.thesharepage.com/image/logosharepage%201.png" alt="logo">
                                        <span class="a">The SharePage</span>
                                    </a>
                                </div>
                                <div class="step_three_popscards">
                                    <img src="<?php echo $BaseUrl;?>/assets/img/check_green.png" alt="">
                                    <?php
                                    if($paymentAmountZero){
                                        ?>
                                        <h2>Payment Successful !</h2>
                                        <p>Thank you for registering for the Career and Innovation Expo! </p>      
                                        <h4>We have received payment amount of</h4>
                                        <h5><?php echo isset($_SESSION['sponsor']['sponsorTotalPrice']) ?  'CAD'.number_format($_SESSION['sponsor']['sponsorTotalPrice'], 2) : 'CAD 00.00';?></h5>
                                    <?php
                                    }else{
                                        ?>
                                            <h2>Register Success!</h2>
                                            <p>
                                                Thank you for registering for the Career and Innovation Expo! You can now create an Employment Profile to help recruiters easily find and connect with you! 
                                                <br>
                                                <br>
                                                Your event registration details are saved in the dashboard of Event Module- under “events attending” 
                                            </p>
                                        <?php
                                    }
                                        ?>
                                    <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details" style="margin-top:10px;">Continue</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($pay_status) && $pay_status == 'fail'){ 
                $_SESSION['sponsor_user'] = 0;
                    $_SESSION['sponsor'] = '';
                    ?>
                <div class="register_popss" id="sponsor_step_4">
                    <div class="modal-content">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                        <!--  <span aria-hidden="true">&times;</span>-->
                        <!--</button>-->
                        <div class="modal-body">
                            <div class="register_popup registrate_booth">
                                <div class="step_three_pops">
                                    <a href="https://www.thesharepage.com">
                                        <img src="https://www.thesharepage.com/image/logosharepage%201.png" alt="logo">
                                        <span class="a">The SharePage</span>
                                    </a>
                                </div>
                                <div class="step_three_popscards step_four_popscards">
                                    <img src="<?php echo $BaseUrl;?>/assets/img/fail_red.png" alt="">
                                    <h2>Payment Failed</h2>
                                    <h4>Something went wrong we couldn’t process your payment.</h4>
                                    <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details">Retry Payment</a>
                                </div>
                
                            </div>
                        </div>
                    </div>            
                </div>
                <?php } ?>
            </div>
        </div>
        
        <script> 
            document.getElementById('purchaseBtn').addEventListener('click', function() {
                document.getElementById('sponsor_user').click();
            });
        </script>      

        <script>
            //side menu bar
            const toggle = document.getElementById('toggle');
            const sidebar = document.getElementById('sidebar');

            document.onclick = function(e){
                if(e.target.id !== 'sidebar' && e.target.id !== 'toggle')
                {
                    toggle.classList.remove('active')
                    sidebar.classList.remove('active')
                }
            }
            toggle.onclick = function () {
                toggle.classList.toggle('active');
                sidebar.classList.toggle('active');

            }
        </script>
        <?php 
            include('../component/f_footer.php');
            include('../component/f_btm_script.php'); 
        ?>
        
        <script src="<?php echo $BaseUrl;?>/assets/js/util.js"></script> 
        <script src="<?php echo $BaseUrl;?>/assets/js/main.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/css/owl-carousel/owl.carousel.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.js"></script>  
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/event_payment.js"></script>      
        <script>        
            $(document).ready(function () {


                //Sort random function
                function random(owlSelector) {
                    owlSelector.children().sort(function () {
                        return Math.round(Math.random()) - 0.4;
                    }).each(function () {
                        $(this).appendTo(owlSelector);
                    });
                }

                $("#platinum_owl").owlCarousel({
                    navigation: true,
                    navigationText: [
                        "<i class='icon-chevron-left icon-white'></i>",
                        "<i class='icon-chevron-right icon-white'></i>"
                    ],
                    beforeInit: function (elem) {
                        //Parameter elem pointing to $("#owl-demo")
                        random(elem);
                    }

                });

                $("#gold_owl").owlCarousel({
                    navigation: true,
                    navigationText: [
                        "<i class='icon-chevron-left icon-white'></i>",
                        "<i class='icon-chevron-right icon-white'></i>"
                    ],
                    beforeInit: function (elem) {
                        //Parameter elem pointing to $("#owl-demo")
                        random(elem);
                    }

                });


                $("#silver_owl").owlCarousel({

                    navigation: true,
                    navigationText: [
                        "<i class='icon-chevron-left icon-white'></i>",
                        "<i class='icon-chevron-right icon-white'></i>"
                    ],
                    beforeInit: function (elem) {
                        //Parameter elem pointing to $("#owl-demo")
                        random(elem);
                    }

                });

            });


        </script>       
        <script>
            $('.btn-number').click(function(e){
                e.preventDefault();
                
                fieldName = $(this).attr('data-field');
                type      = $(this).attr('data-type');
                var input = $(this).parent('span').parent('div').find("input");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if(type == 'minus') {
                        
                        if(currentVal > 0) {
                            input.val(currentVal - 1).change();
                        } 
                        /*if(parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }*/
            
                    } else if(type == 'plus') {
            
                        //if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();

                        //}
                        /*if(parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }*/

            

                    }
                } else {
                    input.val(0);
                }
            });
        </script>
        <script>

            $(document).on("click",".btn-number",function() {
                price = 0;
                quantity = 0;  
                sub_total = 0;
                
                gst_totals = 0;
                
                final_total = 0;
                myjson_array = [];
                $('.register_type li').each(function(index, element) {
                    if($(this).find('input[name=quantity]').val() > 0){

                        myArray = [];
                        reg_id = $(this).find('input[name=reg_id]').val();
                        reg_name = $(this).find('input[name=reg_name]').val();
                        price = $(this).find('input[name=price]').val();
                        quantity = $(this).find('input[name=quantity]').val();
                        sub_total = sub_total + parseInt(price) * parseInt(quantity);

                        
                        myArray['reg_id'] = reg_id;
                        myArray['reg_name'] = reg_name;
                        myArray['price'] = price;
                        myArray['quantity'] = quantity;                
                        
                        myjson_array.push(Object.assign({}, myArray));                                        
                        $('.sub_total').html('CAD '+sub_total.toFixed(2));                                                

                    }
                });
                $discountedAmt = null;
                var discountValue = $('.discount').data('disountvalue');

                if(discountValue && discountValue !== ''){                       
                    $discountedAmt = sub_total * (discountValue / 100);
                    sub_total = sub_total - (sub_total * (discountValue / 100));
                    $('.discount').html('CAD '+$discountedAmt.toFixed(2))

                }
                $('#discountAmt').val($discountedAmt);

                gst_totals = parseInt((sub_total * 5) / 100);
                $('#ticket_gst').val(gst_totals);

                $('.gst_totals').html('CAD '+gst_totals.toFixed(2));
                
                final_total = parseInt(sub_total) + parseInt(gst_totals);
                $('.final_total').html('CAD '+final_total.toFixed(2));
                $('#ticket_price').val(final_total);
                myJsonString =JSON.stringify(myjson_array);

                jQuery("#registration_type").val(myJsonString);
            });
        </script>
        <script>
            $('.register_btn').click(function () {

                $('input[name=quantity]').each(function(index, element) {

                    $(this).val(0);
                });
                $('.gst_totals').html('CAD 0.00');
                $('.sub_total').html('CAD 0.00');
                $('.final_total').html('CAD 0.00');
            });
            $(document).ready(function () {
                $("#show_step_2").click(function () {
                    qty = 0;

                    $('.register_type li').each(function(index, element) {
                        qty = qty + $(this).find('input[name=quantity]').val();
                    });
                    if(qty > 0){
                        $('#event_user').trigger('click');
                    }else{
                        $('.text-danger').remove();
                        $('#show_step_2').before('<span class="text-danger" style="font-size: 18px;font-weight: bold;">Please Select Any One</span>');

                    }
                });

                /*$("#step_3").hide();
                $("#show_step_3").click(function () {
                    $("#step_3").show();
                    $("#step_2").hide();
                });

                $("#step_4").hide();
                $("#show_step_4").click(function () {
                    $("#step_4").show();
                    $("#step_2").hide();
                });*/
                // $("#show").click(function () {
                //     $("p").show();
                // });
            });
        </script>
        <!--  sponser related js start-->

        <!-- <script>
            document.getElementById('sponsorshipPackage').addEventListener('change', function () {
                // Get the selected package price, sponsor ID, and name
                var selectedPrice = parseFloat(this.value);
                var selectedSponsorId = this.options[this.selectedIndex].getAttribute('data-id');
                var selectedName = this.options[this.selectedIndex].getAttribute('data-name');

                document.getElementById('sponsorId').value = selectedSponsorId;
                document.getElementById('sponsorName').value = selectedName;

                sub_total = selectedPrice;
                document.getElementById('subTotalAmount').textContent = 'CAD' + sub_total.toFixed(2);            
                document.getElementById('sponsorPrice').value = sub_total.toFixed(2);
                
                // Calculate GST (5% of the selected price)
                
                // Calculate total amount
                // var totalAmount = selectedPrice + gst;
                // var gst = selectedPrice * 0.05;
                
                $discountedAmt = null;
                var discountValue = $('.sponsor_discount').data('disountvalue');
                if(discountValue && discountValue !== ''){                       
                    $discountedAmt = sub_total * (discountValue / 100);
                    sub_total = sub_total - (sub_total * (discountValue / 100));
                    $('.sponsor_discount').html('CAD'+$discountedAmt.toFixed(2))
                }
                $('#sponsor_discountAmt').val($discountedAmt);

                gst_totals = parseInt((sub_total * 5) / 100);
                // Update the displayed values
                document.getElementById('gstAmount').textContent = 'CAD' + gst_totals.toFixed(2);
            
                document.getElementById('totalAmount').textContent = 'CAD' + gst_totals.toFixed(2);

                // Set the hidden input values for form submission
            
                document.getElementById('sponsorGst').value = gst_totals.toFixed(2);
                document.getElementById('sponsorTotalPrice').value = totalAmount.toFixed(2);
            });

        </script> -->
        <script>
            document.getElementById('sponsorshipPackage').addEventListener('change', function () {
                // Get the selected package price, sponsor ID, and name
                var selectedPrice = parseFloat(this.value);
                var selectedSponsorId = this.options[this.selectedIndex].getAttribute('data-id');
                var selectedName = this.options[this.selectedIndex].getAttribute('data-name');

                // Set the sponsor ID and Name in hidden fields
                // document.getElementById('sponsorId').value = selectedSponsorId;
                // document.getElementById('sponsorName').value = selectedName;.
                let myjson_array = {
                    'value': $(this).val(),
                    'id': selectedSponsorId,
                    'name': selectedName
                };

                let myJsonString = JSON.stringify(myjson_array);
                jQuery("#sponsorName").val(myJsonString);

                // Calculate the subtotal (selected price)
                var sub_total = selectedPrice;

                document.getElementById('subTotalAmount').textContent = 'CAD ' + selectedPrice.toFixed(2);            
                document.getElementById('sponsorPrice').value = selectedPrice.toFixed(2);
                

                // Initialize discount variables
                var discountValue = $('.sponsor_discount').data('disountvalue');
                var discountedAmt = 0; // Initialize to 0


                if (discountValue && discountValue !== '') {                       

                    discountedAmt = sub_total * (discountValue / 100);
                    sub_total = sub_total - discountedAmt; // Subtract discount from subtotal
                    $('.sponsor_discount').html('CAD' + discountedAmt.toFixed(2));
                }

                
                $('#sponsor_discountAmt').val(discountedAmt.toFixed(2)); // Set discount amount hidden field
                
                // Calculate GST (5% of subtotal)
                var gst = sub_total * 0.05;
                document.getElementById('gstAmount').textContent = 'CAD ' + gst.toFixed(2);
                

                // Calculate the total amount (subtotal + GST)
                var totalAmount = sub_total + gst;
                document.getElementById('totalAmount').textContent = 'CAD ' + totalAmount.toFixed(2);

                // Set the hidden input values for form submission
                document.getElementById('sponsorGst').value = gst.toFixed(2);
                document.getElementById('sponsorTotalPrice').value = totalAmount.toFixed(2);
            });

            $(document).ready(function (){ 
                $('#card_ex_mm, #card_ex_yy').on('change', function () { 
                    var month = $('#card_ex_mm').val(); var year = $('#card_ex_yy').val(); $('#cardExpMonth').val(month + '/' + year); 
                });
            });

        </script>

        <!--  sponser related js end-->
    </body>
</html>

