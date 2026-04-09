	$(document).ready(function() {

		$("#sidebarCollapse").on("click", function() {
			$("#sidebar").toggleClass("active");
			$(this).toggleClass("active");
		});
	});
//////////////////////////////////
	$('#myCarousel').carousel({
		interval: 10000
	})

	$('#myCarousel').on('slid.bs.carousel', function() {
    	//alert("slid");
    });
////////////////////////////////////////////////
	