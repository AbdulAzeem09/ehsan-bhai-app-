$(document).ready(function() {
  $('.video-gallery').magnificPopup({
  delegate: 'a', 
  type: 'iframe',
  gallery:{
    enabled:true
  }
});
});

$('#clsOpenImgUpload').click(function(){ $('#clsImgUpload').trigger('click'); });
