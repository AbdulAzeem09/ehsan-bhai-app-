<?php
class _redirect {
	///******************** Function for Redirection ********************/
	function redirect($url) { 
		echo "<html><head><meta http-equiv=refresh content=0;URL=" . $url . "></head><body></body></html>";
	}
}
?>