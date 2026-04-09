

		<script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/js/mycustom.js" type="text/javascript"></script>
	    <!-- jQuery UI 1.11.2 -->
	    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
	    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	    <script>
	      //$.widget.bridge('uibutton', $.ui.button);
	    </script>
	    <!-- Bootstrap 3.3.2 JS -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>  
	    

	    <!-- Morris.js charts -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	    <!-- <script src="<?php ///echo base_url();?>assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script> -->
	    <!-- Sparkline -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
	    <!-- jvectormap -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
	    <!-- jQuery Knob Chart -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
	    <!-- daterangepicker -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	    <!-- datepicker -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<script type="text/javascript">
	        $(function () {
	            $('.datepicker').datepicker({
					startDate: new Date(),
	                format: 'mm-dd-yyyy'
	            });
	        });
	    </script>

	    <!-- Bootstrap WYSIHTML5 -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	    <!-- Slimscroll -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/fastclick/fastclick.min.js'></script>
	    <!-- AdminLTE App -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/js/app.min.js" type="text/javascript"></script>    
	    
	    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	    <!-- <script src="<?php //echo base_url();?>assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> -->    
	    
	    <!-- AdminLTE for demo purposes -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/js/demo.js" type="text/javascript"></script>
	    <!-- DATA TABES SCRIPT -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/intlTelInput.js" type="text/javascript"></script>
	    <script>
            var input = document.querySelector("#respUserEphone");
            window.intlTelInput(input, {

              // allowDropdown: false,
              // autoHideDialCode: false,
              // autoPlaceholder: "off",
              // dropdownContainer: document.body,
              // excludeCountries: ["us"],
              // formatOnDisplay: false,
              // geoIpLookup: function(callback) {
              //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
              //     var countryCode = (resp && resp.country) ? resp.country : "";
              //     callback(countryCode);
              //   });
              // },
              // hiddenInput: "full_number",
              initialCountry: "auto",
              // localizedCountries: { 'de': 'Deutschland' },
              // nationalMode: false,
              // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
              // placeholderNumberType: "MOBILE",
               preferredCountries: ['us', 'ca'],
               separateDialCode: true,

                utilsScript: "<?php echo WEB_ROOT_TEMPLATE;?>/assets/admin/utils.js",
            });
			
			var countryCode = "";

			$("#country-listbox li").on("click", function(){ 
				countryCode = $(this).attr('data-dial-code');
				$("#countrycode").val(countryCode);
			});
			
			

        </script>




	    <!-- Bootstrap WYSIHTML5 -->
	    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	    <script type="text/javascript">
	      $(function () {
	        // Replace the <textarea id="editor1"> with a CKEditor
	        // instance, using default configuration.
	        //CKEDITOR.replace('editor1');
	        //bootstrap WYSIHTML5 - text editor
	        $(".textarea").wysihtml5();
	      });
	    </script>
	   	<script type="text/javascript">
		    $(function () {
		        $("#example1").dataTable();
		        $('#example2').dataTable({
		          "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": true,
		          "bInfo": true,
		          "bAutoWidth": false
		        });
		    });
		</script>
		<script>
	      	$(function () {
	        	//Add text editor
	        	$("#compose-textarea").wysihtml5();
	      	});
	    </script>
	<?php
	$n = count($script);
	for ($i = 0; $i < $n; $i++) {
		if ($script[$i] != '') {
			echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT_ADMIN. 'js/modules/' . $script[$i]. '"></script>';
		}
	}
	?>