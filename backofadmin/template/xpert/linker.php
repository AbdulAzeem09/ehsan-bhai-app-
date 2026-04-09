    

    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?> | The SharePage</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="<?php echo WEB_ROOT_TEMPLATE.'/assets/admin/dist/img/logo-black.png'?>" sizes="16x16" type="image/png">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- custom css -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/css/custom.css" rel="stylesheet" type="text/css" />

 <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/css/style.css" rel="stylesheet" type="text/css" />

   <!--  <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/css/style.css" rel="stylesheet" type="text/css" /> -->

    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/intlTelInput.css" rel="stylesheet" type="text/css" />


     <!--   Sweetalert popup -->
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <script>
        function showDay(){
            var max_fields  = 10;
            var wrapper     = $(".customDay"); 
            var x = document.getElementById("countiing").value; 
            if(x < max_fields){ 
                x++; 
                $(wrapper).append('<div class="col-md-4"> <div class="form-group"><label>Gallery Image '+ x +'</label><input type="file" name="gallImg[]" class="form-control" value="" /> </div></div>'); //add input box
                $("#countiing").val(x);
            }else{
                alert('You Reached the limits')
            }
        }
    </script>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>


    <!-- multiple -->
     <link href="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/multiple/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
     <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/dist/multiple/bootstrap-multiselect.js" type="text/javascript"></script>
     <script type="text/javascript">
        //USER ONE
        $(function () {
            $('#txtNeCat').multiselect({
                includeSelectAllOption: true
            });
            
        });
        
    </script>
	<script type="text/javascript">
            $(function() {
                $('#respUserEphone').keypress(function(event){
                    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                       event.preventDefault(); //stop character from entering input
                    }
               });
            });
        </script>


