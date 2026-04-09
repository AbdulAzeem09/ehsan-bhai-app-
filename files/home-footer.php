<footer class="foot">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="footlogo">
							<img src="<?php echo $BaseUrl;?>/img/logo/logo-foot.png" class="img-responsive" />
							<p>The SharePage</p>
						</div>
						<div class="btmfotlog">
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer</p>
						</div>
					</div>
					<div class="col-md-offset-1 col-md-4">
						<div class="locationlink">
							<h2>Useful Links</h2>
							<a href="copyrights/"><p>Copyrights</p></a>
							<a href="sitemap/"><p>Site Map</p></a>
							<a href="helps/"><p>Help</p></a>
							<a href="jobs/"><p>Jobs</p></a>
							<a href="legal/"><p>Legal</p></a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="contactbox">
							<h2>Contact us</h2>
							<p><i class="fa fa-phone"></i> &nbsp;: 00-000-000-000</p>
							<p><i class="fa fa-envelope"></i> : <?php echo CONTACT ?></p>
							<div class="space-md"></div>
							<div class="sociallinks">
								<a href="#" class="fa fa-facebook"></a>
								<a href="#" class="fa fa-twitter"></a>
								<a href="#" class="fa fa-linkedin"></a>
							</div>
						</div>
					</div>
				</div>
				
			</div>

		</footer>
		<div class="btm_footer">
			<p>&copy; <?php echo COMPANY ?>, <?php echo COUNTRY ?>. <?php echo date('Y');?></p>
		</div>
		<script src="<?php echo $BaseUrl;?>/css/owl-carousel/owl.carousel.js"></script>
      
	    <script>
	        $(document).ready(function() {
	          $("#owl-demo").owlCarousel({
	            items : 4,
	            lazyLoad : true,
	            navigation : true
	          });

	        });
	    </script>
		<script type="text/javascript" >
	        $(document).ready(function() {
	            $('#Carousel').carousel({
	                interval: 5000
	            })
	        });
	    </script>