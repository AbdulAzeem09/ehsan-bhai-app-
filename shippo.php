<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo  'comig jere';
require_once('Shippo/lib/Shippo.php');

\Shippo::setApiKey('shippo_test_01988b1f578f3419862239c7a476ec5c569cc9b0');

$from_address = array(
    'name' => 'Marina Hossain',
    'company' => 'Shippo',
    'street1' => '215 Clayton St.',
    'city' => 'San Francisco',
    'state' => 'CA',
    'zip' => '94117',
    'country' => 'US',
    'phone' => '+17412589630',
    'email' => 'mr-hippo@goshipppo.com', 
);
$to_address = array(
    'name' => 'nandini pr',
    'company' => 'Regents Park',
    'street1' => 'Outer Cir',
    'city' => 'London',
    'zip' => 'NW1 4RY',
    'country' => 'IN',
    'phone' => '+17412589630',
    'email' => 'ms-hippo@goshipppo.com',
    'metadata' =>  'For Order Number 123',
);
$parcel = array(
    'length'=> '5',
    'width'=> '5',
    'height'=> '5',
    'distance_unit'=> 'in',
    'weight'=> '2',
    'mass_unit'=> 'lb',
);
$customs_item = array(
    'description' => 'T-Shirt',
    'quantity' => '2',
    'net_weight' => '400',
    'mass_unit' => 'g',
    'value_amount' => '20',
    'value_currency' => 'INR',
    'origin_country' => 'INDIA',
    'tariff_number' => '',
);
$customs_declaration = \Shippo_CustomsDeclaration::create(
    array(
        'contents_type'=> 'MERCHANDISE',
        'contents_explanation'=> 'T-Shirt purchase',
        'non_delivery_option'=> 'RETURN',
        'certify'=> 'true',
        'certify_signer'=> 'Mr Hippo',
        'items'=> array($customs_item),
    ));
$shipment = \Shippo_Shipment::create(
    array(
        'address_from' => $from_address,
        'address_to' => $to_address,
        'parcels'=> array($parcel),
        'customs_declaration' => $customs_declaration -> object_id,
        'async' => false,
    )
);
$rate = $shipment['rates'][0];
$transaction = Shippo_Transaction::create(array(
    'rate'=> $rate['object_id'],
    'async'=> false,
));
echo '<pre>';print_r($transaction);exit;
if ($transaction['status'] == 'SUCCESS'){
    echo "--> " . "Shipping label url: " . $transaction['label_url'] . "\n";
    echo "--> " . "Shipping tracking number: " . $transaction['tracking_number'] . "\n";
} else {
    echo "Transaction failed with messages:" . "\n";
    foreach ($transaction['messages'] as $message) {
        echo "--> " . $message . "\n";
    }
}

?>