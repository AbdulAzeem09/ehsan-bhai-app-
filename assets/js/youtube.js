	
	var hostUrl = window.location.host; 
	var hostSchema = window.location.protocol;
	var BASE_URL = hostSchema+'//'+hostUrl+'/';
	$(document).ready(function() {
		
		$(".commentprofile").on("keyup", ".grptimeline", function () {
			var getUrl  = $('.grptimeline').text();
			//console.log(getUrl);
			
				//alert('hi');
				//url to match in the text field
				var match_url = /\b(https?):\/\/([\-A-Z0-9.]+)(\/[\-A-Z0-9+&@#\/%=~_|!:,.;]*)?(\?[A-Z0-9+&@#\/%=~_|!:,.;]*)?/i;
				//returns true and continue if matched url is found in text field
				if (match_url.test(getUrl)) {
						$("#youtubevideolink").hide();
						$("#loading_indicator").show(); //show loading indicator image
						
						var extracted_url = getUrl.match(match_url)[0]; //extracted first url from text filed
						
						//ajax request to be sent to extract-process.php
						$.post(BASE_URL+'library/youtube/extract-process.php',{'url': extracted_url}, function(data){         
							//console.log(data.id);
							
							extracted_images = data.images;
							total_images = parseInt(data.images.length-1);
							img_arr_pos = total_images;
							
							if(total_images>0){
								inc_image = '<div class="extracted_thumb" id="extracted_thumb"><img src="'+data.images[img_arr_pos]+'" width="100" height="100"></div>';
							}else{
								inc_image ='';
							}
							//content to be loaded in #results element
							//var content = '<div class="extracted_url">'+ inc_image +'<div class="extracted_content"><h4><a href="'+extracted_url+'" target="_blank">'+data.title+'</a></h4><div class="thumb_sel"><span class="prev_thumb" id="thumb_prev">&nbsp;</span><span class="next_thumb" id="thumb_next">&nbsp;</span> </div><span class="small_text" id="total_imgs">'+img_arr_pos+' of '+total_images+'</span><span class="small_text">&nbsp;&nbsp;Choose a Thumbnail</span></div></div>';
							
							var content = '<div class="videoshow"><img src="http://img.youtube.com/vi/'+data.id+'/sddefault.jpg" class="img-responsive" /><div class="titlebox"><a href="'+extracted_url+'" target="_blank">'+data.title+'</a></div></div>';
							
							//load results in the element
							$("#youtubevideolink").html(content); //append received data into the element
							$("#youtubevideolink").slideDown(); //show results with slide down effect
							$("#loading_indicator").hide(); //hide loading indicator image
						},'json');
				}
			
		});
		
		
		var getUrl  = $('.grptimeline'); //url to extract from text field
		
		


		//user clicks previous thumbail
		$("body").on("click","#thumb_prev", function(e){		
			if(img_arr_pos>0) 
			{
				img_arr_pos--; //thmubnail array position decrement
				
				//replace with new thumbnail
				$("#extracted_thumb").html('<img src="'+extracted_images[img_arr_pos]+'" width="100" height="100">');
				
				//show thmubnail position
				$("#total_imgs").html((img_arr_pos) +' of '+ total_images);
			}
		});
		
		//user clicks next thumbail
		$("body").on("click","#thumb_next", function(e){		
			if(img_arr_pos<total_images)
			{
				img_arr_pos++; //thmubnail array position increment
				
				//replace with new thumbnail
				$("#extracted_thumb").html('<img src="'+extracted_images[img_arr_pos]+'" width="100" height="100">');
				
				//replace thmubnail position text
				$("#total_imgs").html((img_arr_pos) +' of '+ total_images);
			}
		});
	});
