
<?php
    //***********************************************************
    //              INTEREST * ((1 + INTEREST) ^ TOTALPAYMENTS)
    // PMT = LOAN * -------------------------------------------
    //                  ((1 + INTEREST) ^ TOTALPAYMENTS) - 1
    //***********************************************************

    

    $principal      = $_POST['principal']; //Mortgage Amount 
    $interest_rate  = $_POST['interest_rate']; //Interest Rate %
    //$down = $principal *0.20; //20% down payment
    $down           = $_POST['down'];
    $years          = $_POST['years'];
    $months         = 0;
    $compound       = 2; //compound is always set to 2
    $frequency      = 12; //Number of months (Monthly (12), Semi-Monthly (24), Bi-Weekly(26) and Weekly(52) 

    function calcPay($MORTGAGE, $AMORTYEARS, $AMORTMONTHS, $INRATE, $COMPOUND, $FREQ, $DOWN){
        $MORTGAGE = $MORTGAGE - $DOWN;
        $compound = $COMPOUND/12;
        $monTime = ($AMORTYEARS * 12) + (1 * $AMORTMONTHS);
        $RATE = ($INRATE*1.0)/100;
        $yrRate = $RATE/$COMPOUND;
        $rdefine = pow((1.0 + $yrRate),$compound)-1.0;
        $PAYMENT = ($MORTGAGE*$rdefine * (pow((1.0 + $rdefine),$monTime))) / ((pow((1.0 + $rdefine),$monTime)) - 1.0);
        if($FREQ==12){
            return $PAYMENT;}
        if($FREQ==26){
            return $PAYMENT/2.0;}
        if($FREQ==52){
            return $PAYMENT/4.0;}
        if($FREQ==24){
            $compound2 = $COMPOUND/$FREQ;
            $monTime2 = ($AMORTYEARS * $FREQ) + ($AMORTMONTHS * 2);
            $rdefine2 = pow((1.0 + $yrRate),$compound2)-1.0;
            $PAYMENT2 = ($MORTGAGE*$rdefine2 * (pow((1.0 + $rdefine2),$monTime2)))/  ((pow((1.0 + $rdefine2),$monTime2)) - 1.0);
            return $PAYMENT2;
        }
    }

    $payment = calcPay($principal, $years, $months, $interest_rate, $compound, $frequency, $down);
    echo $result = round($payment);
?>
    
