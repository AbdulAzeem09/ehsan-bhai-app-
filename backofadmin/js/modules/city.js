	
	// JavaScript Document
	//ADD
	function addCity(){
		window.location.href = 'index.php?view=add';
	}
	// Delete
	function deleteCity(cityId){
		if (confirm('Do You Want Delete this City?')) {
			window.location.href = 'processCity.php?action=delete&cityId=' + cityId;
		}
	}
	$(".country").change(function() {
		var idCountry = this.value;
		if(idCountry > 0){
			url = "loadState.php";
			$.ajax({
				url: url,
				type: "POST",
				data:  'idCountry='+idCountry ,
				success: function(vi){
					//alert(vi);
					$("#stateShow").html(vi);
				},
				error: function(error){
					
				}          
			});
			
			
			
			
		}
	});
	
	
	