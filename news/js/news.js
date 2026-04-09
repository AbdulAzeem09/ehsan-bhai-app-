$(document).ready(function() {
    $('.bookmark').on('click',function(){
      var website_name = $(this).data('website-name');
      var news_link = $(this).data('link');
      var news_title = $(this).data('title');
      var news_description = $(this).data('description');
      var pubDate = $(this).data('publish-date');
      var news_added_to = 'bookmark';

      // console.log(pubDate);
      $.ajax({  
        url:"storebookmarknews.php",  
        method:"POST",
        data:{"news_link":news_link,"news_title":news_title,"news_description":news_description,"pubDate":pubDate, "website_name":website_name, "news_added_to":news_added_to},  
        context: this,
        success:function(response){
          if(response == 1){
            $(this).addClass('bookmarked-news');
            swal({
              title: "Bookmarked",
              text: "News Added to Bookmark",
              icon: "success",
              button: "Ok",
            });
          }
          // .then(function() {
          //     location.reload();
          //   });
         
        }  
      });
  });

  $('.bucket').on('click',function(){
    var website_name = $(this).data('website-name');
    var news_link = $(this).data('link');
    var news_title = $(this).data('title');
    var news_description = $(this).data('description');
    var pubDate = $(this).data('publish-date');
    var news_added_to = 'bucket';

    // console.log(pubDate);
    $.ajax({  
      url:"storebookmarknews.php",  
      method:"POST",
      data:{"news_link":news_link,"news_title":news_title,"news_description":news_description,"pubDate":pubDate, "website_name":website_name, "news_added_to":news_added_to},  
      context: this,
      success:function(response){
        if(response == 1){
          $(this).addClass('bookmarked-news');
          swal({
            title: "Bucket",
            text: "News Added to Bucket",
            icon: "success",
            button: "Ok",
          });
        }
        // .then(function() {
        //     location.reload();
        //   });
      }  
    });
  });
});
    
