
	<script>
        $('#alertmsg').fadeIn( 900 ).delay( 3000 ).fadeOut( 900 );
    </script>
	
	<!--Search Auto In Text Field-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
   	<!-- bootstrap color picker -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
   
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   
    

    <!-- FastClick -->
    <script src='<?php echo WEB_ROOT_TEMPLATE;  ?>/plugins/fastclick/fastclick.min.js'></script>
     <!-- AdminLTE App -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/dist/js/demo.js" type="text/javascript"></script>
	<!-- Calander javascript -->
	<script type="text/javascript" src="<?php echo WEB_ROOT_TEMPLATE;  ?>/date/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	
	
    <!-- Zabuto Calendar -->
	<script type="text/javascript" src="<?php echo WEB_ROOT_TEMPLATE;  ?>/zabuto_calendar.min.js" charset="UTF-8"></script>
	<script type="text/javascript">
		$('.form_datetime').datetimepicker({
			//language:  'fr',
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		$('.form_date').datetimepicker({
			language:  'fr',
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		});
		$('.form_time').datetimepicker({
			language:  'fr',
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 0,
			maxView: 1,
			forceParse: 0
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
    <script type="text/javascript">
    	//Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();
    </script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script type="text/javascript" >
    	//THIS IS TEXT EDITOR FOR EMAIL LIST PAGE
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