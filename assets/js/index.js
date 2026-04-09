$(function(){
  $(".btn").on("click",function(){
    $.notify({
      title: '<strong>notification alert</strong>',
      icon: 'glyphicon glyphicon-star',
      message: "hi how r u"
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
  });
});