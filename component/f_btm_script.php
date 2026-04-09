<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js?v=2"></script>


<!-- chat script -->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/chat/chat.js"></script>

<!-- date-time -->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script src="<?php echo $BaseUrl.'/assets/js/fstdropdown.js'?>"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script> -->
<!-- youtube links -->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/youtube.js"></script>

<!-- SWEET ALERT MSG -->
<link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/sweetalert.min.js"></script>
<!-- END -->

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">

<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">

$('.thumbnail').magnificPopup({
  type: 'image'
  // other options
});


</script> 
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script src="<?php echo $BaseUrl;?>/assets/js/popper.min.js"></script>
<script src="<?php echo $BaseUrl;?>/assets/js/bootstrap.js?12"></script>

<!-- Begin emoji-picker JavaScript -->
<script src="<?php echo $BaseUrl;?>/assets/lib_emoji/js/config.js"></script>
<script src="<?php echo $BaseUrl;?>/assets/lib_emoji/js/util.js"></script>
<script src="<?php echo $BaseUrl;?>/assets/lib_emoji/js/jquery.emojiarea.js"></script>
<script src="<?php echo $BaseUrl;?>/assets/lib_emoji/js/emoji-picker.js"></script>
<!-- End emoji-picker JavaScript -->
<script>
$(function() {
  if($('[data-emojiable="true"]').length){
    // Initializes and creates emoji set from sprite sheet
    window.emojiPicker = new EmojiPicker({
      emojiable_selector: '[data-emojiable=true]',
      assetsPath: '<?php echo $BaseUrl;?>/assets/lib_emoji/img/',
      popupButtonClasses: 'fa fa-smile-o'
    });
    
    // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
    // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
    // It can be called as many times as necessary; previously converted input fields will not be converted again
    window.emojiPicker.discover();
  }
});
</script>
<!--this is script for scroller start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/scroller/jquery.overlayScrollbars.js"></script>
<script>

$('.rightscrooler').overlayScrollbars({
  className       : "os-theme-round-dark",
  resize          : "both",
  sizeAutoCapable : true,
  paddingAbsolute : true
}); 
</script>
<!--this is script for scroller End-->

<!-- <script type="text/javascript">
$('.test-popup-link').magnificPopup({
  type: 'image'
  // other options
});
</script> -->

<script type="text/javascript">
  $(function(){
    $('#carousel-example-generic').carousel({
      interval: 3000
    });

    $('#carousel-example-Newsfees').carousel({
      interval: 4000
    });

    $('#carousel-example-group').carousel({
      interval: 4000
    });

    $('#carousel-example-event').carousel({
      interval: 4000
    });  
  });
</script>

<script type="text/javascript">

// $('.form_datetime').datetimepicker({
  
  //     //language:  'fr',
  //     weekStart: 1,
  //     todayBtn:  1,
  //     autoclose: 1,
  //     todayHighlight: 1,
  //     startView: 2,
  //     forceParse: 0,
  //     minView: 2,
  //     pickerPosition: "top-right"
  // });
  
  
  </script>
  <script type="text/javascript">
  $(".form_datetime2").datetimepicker({
    format: "dd MM yyyy - hh:ii P",
    autoclose: true,
    todayBtn: true,
    pickerPosition: "bottom-left"
  });
  $('.form_datetime_age').datetimepicker({
    endDate: '-1d',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
    minView: 2,
  });
  $('.form_datetime').datetimepicker({
    //language:  'fr',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
    minView: 2,
  });
  
  $('.form_time_3').datetimepicker({
    //language:  'fr',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    forceParse: 0,
    showMeridian: 1
  });
  </script>
  <script type="text/javascript">
  $(document).ready(function () {
    <?php
    if(isset($_SESSION['msg']) && $_SESSION['count'] == 0){ 
      ?>
      $.notify({
        title: "<?php echo '<strong>'.$_SESSION['msg'].'</strong>' ?>",
        icon: '',
        message: ""
      },{
        type: 'success',
        animate: {
          enter: 'animated fadeInUp',
          exit: 'animated fadeOutRight'
        },
        placement: {
          from: "top",
          align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
      });
      <?php
      $_SESSION['count']++;
      unset($_SESSION['err']);
    }
    ?>
    
  });
  </script>
  
