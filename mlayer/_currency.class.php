<?php 
class _currency
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("managecurrency");
		$this->tad = new _tableadapter("spuser");
		$this->tat = new _tableadapter("currency1");
		$this->ta->dbclose = false;
	}
	
	//read
	function readCurrency(){
		return $this->tat->read("ORDER BY id ASC");		
	}

		
	function updateCurrencyuser($user_id, $currency){
		return $this->tad->update(array( 'currency' => $currency), "WHERE idspUser ='".$user_id."'");
	}
	function readCurrencyuser($postid){
		return $this->tad->read("WHERE idspUser =" . $postid);
	}
	// read country name
	function readCountryName($id){
		return $this->ta->read("WHERE country_id = $id");
	}


	function convert_Currency($fromCurrency,$toCurrency,$amount){

	$fromCurrency = urlencode($fromCurrency);
	$toCurrency = urlencode($toCurrency);	
	$url  = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
	$get = file_get_contents($url);
	$data = preg_split('/\D\s(.*?)\s=\s/',$get);
	$exhangeRate = (float) substr($data[1],0,7);
	$convertedAmount = $amount*$exhangeRate;
 return	$data = array( 'exhangeRate' => $exhangeRate, 'convertedAmount' =>$convertedAmount,
 'fromCurrency' => strtoupper($fromCurrency), 'toCurrency' => strtoupper($toCurrency));
	

	}

	
}
?>