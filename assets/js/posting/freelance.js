	
	//POSTING SCRIPT
	
	$(document).ready(function () {
		var hostUrl = window.location.host; 
		var hostSchema = window.location.protocol;
		var MAINURL = hostSchema+'//'+hostUrl;
		// THIS IS IMPORTANT SCRIPT FOR CUSTOM FIELDS
		function readCustomFields($form, $postid) {
			var allinputs = $form.find(".spPostField");
			var formfields = new Array();
			var inputs = null;
			allinputs.each(function (i, e) {
				var l = $("label[for='" + e.id + "']").text();
				var n = $(e).attr("name");
				var v = $(e).val();
				var f = $(e).data("filter");
				inputs = {spPostFieldLabel: l, spPostFieldName: n, spPostFieldValue: v, spPostings_idspPostings: $postid, spCategories_idspCategory: $(".spCategories_idspCategory").val(), spPostFieldIsFilter: f, editing_: postedit};
				formfields.push(inputs);
			});
			return formfields;
		}
		// STORE
		//=================POST A FREELANCE FORM START=============
		$("#spPostSubmitFreelance").on("click", function () {
			//alert();
			var sendUrl = MAINURL;
			
			if ($(this).hasClass("editing"))
				postedit = true;
			else
				postedit = false;
			
			var btn = this;
			var idspprofile = $("#spProfiles_idspProfiles").val();

			var $form = $("#sp-form-post");

			if(idspprofile != ""){

				var title = document.getElementById("spPostingTitle").value;
				var category = $('#spPostingCategory_ option:selected').val();
				var subcategory = $('#spPostInSubCategory_ option:selected').val();
				var experience = $('#spPostExperienceLevl_ option:selected').val();
				//var closingDate = document.getElementById("spClosingDate_").value;
				var skills = document.getElementById("tokenfield-typeahead").value;
				var description = $('#spPostingNotes').val();
				var price = $('#sppostcost').val();
				//alert(description.length);
		if(title == "" && category == 0 && subcategory == 0 && experience == 0 && skills == "" && price == "" && description == ""){

            $(".lbl_1").addClass("label_error");
                    $(".lbl_1").addClass("label_error");
					$("#title_error").text("Please Enter Title");
					$("#spPostingTitle").focus();
					
					$(".lbl_2").addClass("label_error");
                    $("#category_error").text("Please Enter Category");

                   // $(".lbl_3").addClass("label_error");
					//$("#subcategory_error").text("Please Enter Sub Category");

					$(".control-label").addClass("label_error");
				    $("#experience_error").text("Please Enter  Experience level");

				    $(".lbl_5").addClass("label_error");
					$("#skill_error").text("Please Enter Skills");

					$(".price_label").addClass("label_error");
				    $("#price_error").text("Please Enter price");

				    $(".lbl_6").addClass("label_error");
					$("#description_limit").text("Please Enter Description");


			}else{
				if(title == ""){
					$(".lbl_1").addClass("label_error");
					$("#title_error").text("Please Enter Title");
					$("#spPostingTitle").focus();
				}else{
					$("#title_error").text("");
					$(".lbl_1").removeClass("label_error");
					if(category == 0){
						$(".lbl_2").addClass("label_error");
                        $("#category_error").text("Please Enter Category");
					    $("#spPostingCategory_").focus();
						
					}else{
						$(".lbl_2").removeClass("label_error");
						  $("#category_error").text("");
						if(subcategory == 0){
							$(".lbl_3").addClass("label_error");
							   $("#subcategory_error").text("Please Enter Sub Category");
					           $("#spPostInSubCategory_").focus();
						}else{
							$(".lbl_3").removeClass("label_error");
							$("#subcategory_error").text("");
							/*if(closingDate == ""){
								$(".lbl_4").addClass("label_error");
							}else{*/
								//$(".lbl_4").removeClass("label_error");
								
								if(experience == 0){
									$(".control-label").addClass("label_error");
									$("#experience_error").text("Please Enter  Experience level");
					                $("#spPostExperienceLevl_").focus();
								}else{
							$(".lbl_3").removeClass("label_error");
								$(".control-label").removeClass("label_error");
									$("#experience_error").text("");
						/*	if(closingDate == ""){
								$(".lbl_4").addClass("label_error");
							}else{*/
								$(".lbl_4").removeClass("label_error");
								if(skills == ""){
									$(".lbl_5").addClass("label_error");
									$("#skill_error").text("Please Enter Skills");
					                $("#tokenfield-typeahead").focus();


								}else{
									$(".lbl_5").removeClass("label_error");
									$("#skill_error").text("");

									if(price == ""){
									$(".price_label").addClass("label_error");
									$("#price_error").text("Please Enter price");
					                $("#sppostcost").focus();

								}else{	
									$(".price_label").removeClass("label_error");
									$("#price_error").text("");
									if(description == ""){
									$(".lbl_6").addClass("label_error");
									$("#description_limit").text("Please Enter Description");
					                $("#spPostingNotes").focus();
								}else if(description.length < 100  ){
                                       
                                       $("#description_limit").text(" Please Enter Description more than 100 Character.");

								}else{
									$(".lbl_6").removeClass("label_error");
									//alert(description);

									
									//console.log("Success");
									// HERE WE WRITE A COMPLETE CODE
									$(".loadbox").css({ display: "block" });
									$(btn).button('loading...');
									term = $form.serializeArray();
									url = $form.attr("action");
									$.post(url, term, function (data, status) {
										//alert(data);
									}).fail(function () {
										$(btn).effect("shake");
									}).done(function (data) {
										//alert(data);
										var postid = data;
										var albumid = $(".album_id").val();
										
										
										// CUSTOM FIELDS 
							var inputs = readCustomFields($("#sp-form-post"), postid);
							$.each(inputs, function (i, val) {
							$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
											
											//alert(response);
											});
										});
										
										
										//Video post finaly
										//ev.preventDefault();
										var form_data = new FormData($("#sp-form-post")[0]);
							//form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
										form_data.append('spPostings_idspPostings', postid);
										form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
										$.ajax({
											url: sendUrl+"/post-ad/addpostmedia.php",
											type: "POST",
											data:  form_data ,
											contentType: false,
											cache: false,
											processData:false,
											success: function(vi){
												//alert(vi);
												//window.location.reload();
												$("#dvPreview").html("");
												$("#spPreview").html("");
												$("#clearnow").val("");
												$(".grptimeline").val("");
												$("#postform .form-control").val("");
												//document.getElementById("sp-form-post").reset();
												if(postedit == true){
													//window.location.reload();
												}
											},
											error: function(error){
												//alert(error);
											}          
										});
									
										
										//Testing Complete
										//Media
										$(".media-file-data").each(function (i, e){
											var base64image = $(e).attr("data-media");
											var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
											var ext = arr[0].replace("data:", "");

											$.post("../addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
												//alert(r);
											});
										});


										//notification message from send box

		
/*
										$.notify({

											title: '<strong>Posted Successfully</strong>',
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
*/

										//Message after form submited
										/*$("#dvPreview").html("");
										$("#spPreview").html("");
										$("#clearnow").val("");
										$(".grptimeline").val("");
										$("#postform .form-control").val("");*/
										//document.getElementById("sp-form-post").reset();
										//this script for delay a redirect page for another page.
										//var seconds = 10;

                        //window.location.href = "posting.php?postid="+postid.trim();

                        window.location.href = "../../freelancer/dashboard/active-bid.php?ppost=posting1";


/*		swal({ 
               title: "Posted Successfully",
             //text:  "<b>Saved in the draft. </b>",
             imageUrl: '../../assets/images/logo/tsp_trans.png',


             html: true,

             showConfirmButton: true
            },

            function() {
                
             window.location.href = "posting.php?postid="+postid.trim();
             
            });*/
									/*setInterval(function () {
											seconds--;
											if (seconds == 0) {
												window.location.href = "posting.php?postid="+postid.trim();
												//window.location.reload();
											}
										}, 1000);*/
										//====end=====


									}).always(function () {
										//$(btn).button('reset');
									});
									
								}
							}
                        }
                     }

						}
					}
				}
			}
				
			}else{
				$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select profile...!</div>");
			}
		});
		//=================POST A FREELANCE FORM END=============
		//=================POST A FREELANCE FORM AS DRAFT===========
		//Save in Draft
		var postedit = false;
		$("#spSaveDraftFreelance").on("click", function () {

			//alert();
			var sendUrl = MAINURL;
			
			var visibility = $("#spPostingVisibility").val();
			$("#spPostingVisibility").val("0");
			
			if ($(this).hasClass("editing"))
				postedit = true;
			else
				postedit = false;
			
			var btn = this;
			var idspprofile = $("#spProfiles_idspProfiles").val();
			var $form = $("#sp-form-post");
			if(idspprofile != ""){
				var title = document.getElementById("spPostingTitle").value;
				var category = $('#spPostingCategory_ option:selected').val();
				var subcategory = $('#spPostInSubCategory_ option:selected').val();
				var experience = $('#spPostExperienceLevl_ option:selected').val();
				//var closingDate = document.getElementById("spClosingDate_").value;
				var skills = document.getElementById("tokenfield-typeahead").value;
				var description = $('#spPostingNotes').val();
				var price = $('#sppostcost').val();

				
		
				if(title == "" && category == 0 && experience == 0 && skills == "" && price == "" && description == ""){

            $(".lbl_1").addClass("label_error");
                    $(".lbl_1").addClass("label_error");
					$("#title_error").text("Please Enter Title");
					$("#spPostingTitle").focus();
					
					$(".lbl_2").addClass("label_error");
                    $("#category_error").text("Please Enter Category");

                    $(".lbl_3").addClass("label_error");
					$("#subcategory_error").text("Please Enter Sub Category");

					$(".control-label").addClass("label_error");
				    $("#experience_error").text("Please Enter  Experience level");

				    $(".lbl_5").addClass("label_error");
					$("#skill_error").text("Please Enter Skills");

					$(".price_label").addClass("label_error");
				    $("#price_error").text("Please Enter price");

				    $(".lbl_6").addClass("label_error");
					$("#description_limit").text("Please Enter Description");


			}else{
				if(title == ""){
					$(".lbl_1").addClass("label_error");
					$("#title_error").text("Please Enter Title");
					$("#spPostingTitle").focus();
				}else{
					$(".lbl_1").removeClass("label_error");
					$("#title_error").text("");
					if(category == 0){
						$(".lbl_2").addClass("label_error");
						 $("#category_error").text("Please Enter Category");
					    $("#spPostingCategory_").focus();
					}else{
						$(".lbl_2").removeClass("label_error");
						 $("#category_error").text("");
						// if(subcategory == 0){
						// 	// $(".lbl_3").addClass("label_error");
						// 	// $("#subcategory_error").text("Please Enter Sub Category");
					    //     // $("#spPostInSubCategory_").focus();
						// }//else{
							// $(".lbl_3").removeClass("label_error");
							// $("#subcategory_error").text("");
							/*if(closingDate == ""){
								$(".lbl_4").addClass("label_error");
							}else{*/
								//$(".lbl_4").removeClass("label_error");
								
								if(experience == 0){
									$(".control-label").addClass("label_error");
									$("#experience_error").text("Please Enter  Experience level");
					                $("#spPostExperienceLevl_").focus();
								}else{
							$(".control-label").removeClass("label_error");
							$("#experience_error").text("");
							/*if(closingDate == ""){
								$(".lbl_4").addClass("label_error");
							}else{*/
								//$(".lbl_4").removeClass("label_error");
								
								if(skills == ""){
									$(".lbl_5").addClass("label_error");
									$("#skill_error").text("Please Enter Skills");
					                $("#tokenfield-typeahead").focus();
								}else{
									$(".lbl_5").removeClass("label_error");
									$("#skill_error").text("");

									if(price == ""){
									$(".price_label").addClass("label_error");
									$("#price_error").text("Please Enter price");
					                $("#sppostcost").focus();

								}else{
									$(".lbl_5").removeClass("label_error");
									$(".price_label").removeClass("label_error");
									$("#price_error").text("");
									if(description == ""){
									$(".lbl_6").addClass("label_error");
									$("#description_limit").text("Please Enter Description");
					                $("#spPostingNotes").focus();
								}else if(description.length < 100  ){
                                       
                                       $("#description_limit").text(" Please Enter Description more than 100 Character.");

								}else{
									$(".lbl_6").removeClass("label_error");

									
									// HERE WE WRITE A COMPLETE CODE
									$(".loadbox").css({ display: "block" });
									$(btn).button('loading...');
									term = $form.serializeArray();
									url = $form.attr("action");
									
									$.post(url, term, function (data, status) {
										
									}).fail(function () {
										$(btn).effect("shake");
										$(btn).button('reset');
									}).done(function (data) {
										var postid = data;
										var albumid = $(".album_id").val();
										// CUSTOM FIELDS 
										var inputs = readCustomFields($("#sp-form-post"), postid);
										$.each(inputs, function (i, val) {

											$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
												//alert(response);
											});
										});
										
										$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");

										// IMAGE
										var imgCount = $(".postingimg").length;
										$(".postingimg").each(function (i, e){
											//this is for featured image strt
											var fichek = $(e).attr("data-name");
											var isCheckeed = $('#'+fichek+':checked').val()?true:false;
											if(isCheckeed == true){
												spFeatureimg = 1;
											}else{
												spFeatureimg = 0;
											}
											//this is for featured image end
											var base64image = $(e).attr("src");
											var arr = base64image.match(/data:image\/[a-z]+;/);
											var ext = arr[0].replace("data:image/", "");
											ext = ext.replace(";", "");
											$.post(sendUrl+"/post-ad/addpostingpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
												//alert(r);
												//Timeline prepending
												if (i == imgCount - 1) {
													$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
														$("#timeline-container").prepend(r);
														//$(btn).button('reset');
													});
												}
											});
										});
										//Media
										$(".media-file-data").each(function (i, e)
										{
											var base64image = $(e).attr("data-media");
											var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
											var ext = arr[0].replace("data:", "");
											$.post(sendUrl+"/post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
												//alert(r);
											});
										});
										$("#dvPreview").html("");
										
										//notification message from send box

										/*$.notify({
											title: '<strong>Saved in the draft!</strong>',
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
										});*/

										//this script for delay a redirect page for another page.
										/*var seconds = 10;
										setInterval(function () {
											seconds--;
											if (seconds == 0) {
												window.location.href = "posting.php?postid="+postid.trim();
												//window.location.reload();
											}
										}, 1000);*/

/* window.location.href = "posting.php?postid="+postid.trim();*/
window.location.href = "../../freelancer/dashboard/draft.php";


										//====end=====
/*			swal({                     
            // title: "<img src='../../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
             title: "Saved in the draft",
             //text:  "<b>Saved in the draft. </b>",
             imageUrl: '../../assets/images/logo/tsp_trans.png',
             html: true,
             showConfirmButton: true
            
            },function() {
                
             window.location.href = "posting.php?postid="+postid.trim();
             
             
            });*/
									}).always(function () {
										$(btn).button('reset');
									});
								}
							}
						}
					  }
					//}
				}
              }
		     }		
			}else{
				$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
			}
		});
		//=================POST A STORE FORM DRAFT END=======

		//=================POST A FREELANCE FORM AS UPDATE===========
		//Save in Draft
		var postedit = false;
		$("#spUpdateFreelance").on("click", function () {

			//alert();
			var sendUrl = MAINURL;
			
			var visibility = $("#spPostingVisibility").val();
			
			
			if ($(this).hasClass("editing"))
				postedit = true;
			else
				postedit = false;
			
			var btn = this;
			var idspprofile = $("#spProfiles_idspProfiles").val();
			var $form = $("#sp-form-post");
			if(idspprofile != ""){
				var title = document.getElementById("spPostingTitle").value;
				var category = $('#spPostingCategory_ option:selected').val();
				var subcategory = $('#spPostInSubCategory_ option:selected').val();
				var experience = $('#spPostExperienceLevl_ option:selected').val();
				//var closingDate = document.getElementById("spClosingDate_").value;
				var skills = document.getElementById("tokenfield-typeahead").value;
				var description = $('#spPostingNotes').val();
				var price = $('#sppostcost').val();

				
		
				if(title == "" && category == 0 && experience == 0 && skills == "" && price == "" && description == ""){

            $(".lbl_1").addClass("label_error");
                    $(".lbl_1").addClass("label_error");
					$("#title_error").text("Please Enter Title");
					$("#spPostingTitle").focus();
					
					$(".lbl_2").addClass("label_error");
                    $("#category_error").text("Please Enter Category");

                    $(".lbl_3").addClass("label_error");
					$("#subcategory_error").text("Please Enter Sub Category");

					$(".control-label").addClass("label_error");
				    $("#experience_error").text("Please Enter  Experience level");

				    $(".lbl_5").addClass("label_error");
					$("#skill_error").text("Please Enter Skills");

					$(".price_label").addClass("label_error");
				    $("#price_error").text("Please Enter price");

				    $(".lbl_6").addClass("label_error");
					$("#description_limit").text("Please Enter Description");


			}else{
				if(title == ""){
					$(".lbl_1").addClass("label_error");
					$("#title_error").text("Please Enter Title");
					$("#spPostingTitle").focus();
				}else{
					$(".lbl_1").removeClass("label_error");
					$("#title_error").text("");
					if(category == 0){
						$(".lbl_2").addClass("label_error");
						 $("#category_error").text("Please Enter Category");
					    $("#spPostingCategory_").focus();
					}else{
						$(".lbl_2").removeClass("label_error");
						 $("#category_error").text("");
						// if(subcategory == 0){
						// 	// $(".lbl_3").addClass("label_error");
						// 	// $("#subcategory_error").text("Please Enter Sub Category");
					    //     // $("#spPostInSubCategory_").focus();
						// }//else{
							// $(".lbl_3").removeClass("label_error");
							// $("#subcategory_error").text("");
							/*if(closingDate == ""){
								$(".lbl_4").addClass("label_error");
							}else{*/
								//$(".lbl_4").removeClass("label_error");
								
								if(experience == 0){
									$(".control-label").addClass("label_error");
									$("#experience_error").text("Please Enter  Experience level");
					                $("#spPostExperienceLevl_").focus();
								}else{
							$(".control-label").removeClass("label_error");
							$("#experience_error").text("");
							/*if(closingDate == ""){
								$(".lbl_4").addClass("label_error");
							}else{*/
								//$(".lbl_4").removeClass("label_error");
								
								if(skills == ""){
									$(".lbl_5").addClass("label_error");
									$("#skill_error").text("Please Enter Skills");
					                $("#tokenfield-typeahead").focus();
								}else{
									$(".lbl_5").removeClass("label_error");
									$("#skill_error").text("");

									if(price == ""){
									$(".price_label").addClass("label_error");
									$("#price_error").text("Please Enter price");
					                $("#sppostcost").focus();

								}else{
									$(".lbl_5").removeClass("label_error");
									$(".price_label").removeClass("label_error");
									$("#price_error").text("");
									if(description == ""){
									$(".lbl_6").addClass("label_error");
									$("#description_limit").text("Please Enter Description");
					                $("#spPostingNotes").focus();
								}else if(description.length < 100  ){
                                       
                                       $("#description_limit").text(" Please Enter Description more than 100 Character.");

								}else{
									$(".lbl_6").removeClass("label_error");

									
									// HERE WE WRITE A COMPLETE CODE
									$(".loadbox").css({ display: "block" });
									$(btn).button('loading...');
									term = $form.serializeArray();
									url = $form.attr("action");
									
									$.post(url, term, function (data, status) {
										
									}).fail(function () {
										$(btn).effect("shake");
										$(btn).button('reset');
									}).done(function (data) {
										var postid = data;
										var albumid = $(".album_id").val();
										// CUSTOM FIELDS 
										var inputs = readCustomFields($("#sp-form-post"), postid);
										$.each(inputs, function (i, val) {

											$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
												//alert(response);
											});
										});
										
										$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");

										// IMAGE
										var imgCount = $(".postingimg").length;
										$(".postingimg").each(function (i, e){
											//this is for featured image strt
											var fichek = $(e).attr("data-name");
											var isCheckeed = $('#'+fichek+':checked').val()?true:false;
											if(isCheckeed == true){
												spFeatureimg = 1;
											}else{
												spFeatureimg = 0;
											}
											//this is for featured image end
											var base64image = $(e).attr("src");
											var arr = base64image.match(/data:image\/[a-z]+;/);
											var ext = arr[0].replace("data:image/", "");
											ext = ext.replace(";", "");
											$.post(sendUrl+"/post-ad/addpostingpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
												//alert(r);
												//Timeline prepending
												if (i == imgCount - 1) {
													$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
														$("#timeline-container").prepend(r);
														//$(btn).button('reset');
													});
												}
											});
										});
										//Media
										$(".media-file-data").each(function (i, e)
										{
											var base64image = $(e).attr("data-media");
											var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
											var ext = arr[0].replace("data:", "");
											$.post(sendUrl+"/post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
												//alert(r);
											});
										});
										$("#dvPreview").html("");
										
										//notification message from send box

										/*$.notify({
											title: '<strong>Saved in the draft!</strong>',
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
										});*/

										//this script for delay a redirect page for another page.
										/*var seconds = 10;
										setInterval(function () {
											seconds--;
											if (seconds == 0) {
												window.location.href = "posting.php?postid="+postid.trim();
												//window.location.reload();
											}
										}, 1000);*/

/* window.location.href = "posting.php?postid="+postid.trim();*/
window.location.href = "../../freelancer/dashboard/expire.php";


										//====end=====
/*			swal({                     
            // title: "<img src='../../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
             title: "Saved in the draft",
             //text:  "<b>Saved in the draft. </b>",
             imageUrl: '../../assets/images/logo/tsp_trans.png',
             html: true,
             showConfirmButton: true
            
            },function() {
                
             window.location.href = "posting.php?postid="+postid.trim();
             
             
            });*/
									}).always(function () {
										$(btn).button('reset');
									});
								}
							}
						}
					  }
					//}
				}
              }
		     }		
			}else{
				$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
			}
		});
		//=================POST A STORE FORM UPDATE END=======
		//=================POST A STORE FORM DE-ACTIVATE===========
		//Save in Draft
		var postedit = false;
		$("#spSaveDeactiveStore").on("click", function () {
			var sendUrl = MAINURL;
			
			var visibility = $("#spPostingVisibility").val();
			$("#spPostingVisibility").val("-2");
			
			if ($(this).hasClass("editing"))
				postedit = true;
			else
				postedit = false;
			
			var btn = this;
			var idspprofile = $("#spProfiles_idspProfiles").val();
			var $form = $("#sp-form-post");
			if(idspprofile != ""){
				var title = document.getElementById("spPostingTitle").value;
				var country = $('#spUserCountry option:selected').val();
				var state = $('#spUserState option:selected').val();
				var shipping = document.getElementById("sppostingShippingCharge").value;
				var inudstryType = $('#industryType_ option:selected').val();
		
				if(title == ""){
					$(".lbl_1").addClass("label_error");
				}else{
					$(".lbl_1").removeClass("label_error");
					if(country == 0){
						$(".lbl_2").addClass("label_error");
					}else{
						$(".lbl_2").removeClass("label_error");
						if(state == 0){
							$(".lbl_3").addClass("label_error");
						}else{
							$(".lbl_3").removeClass("label_error");
							if(shipping == ""){
								$(".lbl_4").addClass("label_error");
							}else{
								$(".lbl_4").removeClass("label_error");
								//here is industry type
								var type = 0;
								if(inudstryType == "Retail"){
									var retailPrice = document.getElementById("retailPrice").value;
									var retailQuantity = document.getElementById("retailQuantity_").value;
									
									if(retailPrice == ""){
										$(".lbl_5").addClass("label_error");
									}else{
										$(".lbl_5").removeClass("label_error");
										if(retailQuantity == ""){
											$(".lbl_6").addClass("label_error");
										}else{
											$(".lbl_6").removeClass("label_error");
											type = 1;
										}
									}
								}else if(inudstryType == "Wholesaler"){
									var fobprice = document.getElementById("fobprice").value;
									var minorderqty = document.getElementById("minorderqty_").value;
									var supplyability = document.getElementById("supplyability_").value;
									var paymentterm = document.getElementById("paymentterm_").value;
									if(fobprice == ""){
										$(".lbl_5").addClass("label_error");
									}else{
										$(".lbl_5").removeClass("label_error");
										if(minorderqty == ""){
											$(".lbl_6").addClass("label_error");
										}else{
											$(".lbl_6").removeClass("label_error");
											if(supplyability == ""){
												$(".lbl_7").addClass("label_error");
											}else{
												$(".lbl_7").removeClass("label_error");
												if(paymentterm == ""){
													$(".lbl_8").addClass("label_error");
												}else{
													$(".lbl_8").removeClass("label_error");
													type = 1;
													
												}
											}
										}
									}
								}else if(inudstryType == "Manufacturer"){
									var manufacturerprice = document.getElementById("manufacturerprice").value;
									var minorderqty = document.getElementById("minorderqty_").value;
									var supplyability = document.getElementById("supplyability_").value;
									var paymentterm = document.getElementById("paymentterm_").value;
									if(manufacturerprice == ""){
										$(".lbl_5").addClass("label_error");
									}else{
										$(".lbl_5").removeClass("label_error");
										if(minorderqty == ""){
											$(".lbl_6").addClass("label_error");
										}else{
											$(".lbl_6").removeClass("label_error");
											if(supplyability == ""){
												$(".lbl_7").addClass("label_error");
											}else{
												$(".lbl_7").removeClass("label_error");
												if(paymentterm == ""){
													$(".lbl_8").addClass("label_error");
												}else{
													$(".lbl_8").removeClass("label_error");
													type = 1;
													
												}
											}
										}
									}
								}else if(inudstryType == "Distributors"){
									var distributorsprice = document.getElementById("distributorsprice").value;
									var minorderqty = document.getElementById("minorderqty_").value;
									var supplyability = document.getElementById("supplyability_").value;
									var paymentterm = document.getElementById("paymentterm_").value;
									if(distributorsprice == ""){
										$(".lbl_5").addClass("label_error");
									}else{
										$(".lbl_5").removeClass("label_error");
										if(minorderqty == ""){
											$(".lbl_6").addClass("label_error");
										}else{
											$(".lbl_6").removeClass("label_error");
											if(supplyability == ""){
												$(".lbl_7").addClass("label_error");
											}else{
												$(".lbl_7").removeClass("label_error");
												if(paymentterm == ""){
													$(".lbl_8").addClass("label_error");
												}else{
													$(".lbl_8").removeClass("label_error");
													type = 1;
													
												}
											}
										}
									}
								}else if(inudstryType == "PersonalSale"){
									var personalSalePrice = document.getElementById("personalSalePrice").value;
									var personalSaleQuantity = document.getElementById("personalSaleQuantity_").value;
									var personalSaleDiscount = document.getElementById("personalSaleDiscount_").value;
									if(personalSalePrice == ""){
										$(".lbl_5").addClass("label_error");
									}else{
										$(".lbl_5").removeClass("label_error");
										if(personalSaleQuantity == ""){
											$(".lbl_6").addClass("label_error");
										}else{
											$(".lbl_6").removeClass("label_error");
											if(personalSaleDiscount == ""){
												$(".lbl_7").addClass("label_error");
											}else{
												$(".lbl_7").removeClass("label_error");
												type = 1;
												
											}
										}
									}
								}
								if(type == 1){
									// HERE WE WRITE A COMPLETE CODE
									$(".loadbox").css({ display: "block" });
									$(btn).button('loading...');
									term = $form.serializeArray();
									url = $form.attr("action");
									
									$.post(url, term, function (data, status) {
										
									}).fail(function () {
										$(btn).effect("shake");
										$(btn).button('reset');
									}).done(function (data) {
										var postid = data;
										var albumid = $(".album_id").val();
										// CUSTOM FIELDS 
										var inputs = readCustomFields($("#sp-form-post"), postid);

										$.each(inputs, function (i, val) {
											$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
												//alert(response);
											});
										});
										
										$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");

										// IMAGE
										var imgCount = $(".postingimg").length;
										$(".postingimg").each(function (i, e){
											//this is for featured image strt
											var fichek = $(e).attr("data-name");
											var isCheckeed = $('#'+fichek+':checked').val()?true:false;
											if(isCheckeed == true){
												spFeatureimg = 1;
											}else{
												spFeatureimg = 0;
											}
											//this is for featured image end
											var base64image = $(e).attr("src");
											var arr = base64image.match(/data:image\/[a-z]+;/);
											var ext = arr[0].replace("data:image/", "");
											ext = ext.replace(";", "");
											$.post(sendUrl+"/post-ad/addpostingpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
												//alert(r);
												//Timeline prepending
												if (i == imgCount - 1) {
													$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
														$("#timeline-container").prepend(r);
														//$(btn).button('reset');
													});
												}
											});
										});
										//Media
										$(".media-file-data").each(function (i, e)
										{
											var base64image = $(e).attr("data-media");
											var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
											var ext = arr[0].replace("data:", "");
											$.post(sendUrl+"/post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
												//alert(r);
											});
										});
										$("#dvPreview").html("");
										
										//notification message from send box
										$.notify({
											title: '<strong>Post is deactivated.</strong>',
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
										//this script for delay a redirect page for another page.
										var seconds = 10;
										setInterval(function () {
											seconds--;
											if (seconds == 0) {
												window.location.href = "posting.php?postid="+postid.trim();
												//window.location.reload();
											}
										}, 1000);
										//====end=====
									}).always(function () {
										$(btn).button('reset');
									});
								}
							}
						}
					}
				}
			}else{
				$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
			}
		});
		//=================POST A STORE FORM DEACTIVATE END=======
		
	});


//========================Bid On Post=====================

/*	$("#freelancer_placebid").on("click", function () {

		alert();
				var bid= $('#bidPrice').val();
				alert(bid);
				var percentage = $('#initialPercentage').val();
				
				var days = $('#totalDays').val();
				var letter = $('#coverLetter').val();
				

				//alert(description.length);
		
				if(bid == ""){
					$(".lbl_1").addClass("label_error");
				}else{
					$(".lbl_1").removeClass("label_error");
					if(percentage == ""){
					   $(".lbl_2").addClass("label_error");
							}else{
								$(".lbl_2").removeClass("label_error");
								if(days == ""){
									$(".lbl_3").addClass("label_error");
								}else{
									$(".lbl_3").removeClass("label_error");
									
									if(letter == ""){
									$(".lbl_4").addClass("label_error");
								}else{
									$(".lbl_4").removeClass("label_error");

									swal({                     
             title: "<img src='../../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
             text:  "<b>Posted Successfully. </b>",
             html: true,

             showConfirmButton: true
            },

            function() {
                
             $("#freelancer_bidform").submit();
                window.location = "<?php echo $BaseUrl;?>/freelancer/project-detail.php";
             
            });

				




								}
							}
						}
					}



		});*/



