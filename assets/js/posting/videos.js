	
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
		//=================POST A STORE FORM START=============
		$("#spPostVideo").on("click", function () {
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
				var category = $('#videocategory_ option:selected').val();
				var lyric = document.getElementById("spPostMusicLyrics_").value;
				var director = document.getElementById("spPostMusicDirector_").value;
				var artist = document.getElementById("spPostArtistName_").value;
				var composer = document.getElementById("spPostingMusicCmpId_").value;
				var tag = document.getElementById("tag_").value;
				
				if(title == ""){
					$(".lbl_1").addClass("label_error");
				}else{
					$(".lbl_1").removeClass("label_error");
					if(category == ""){
						$(".lbl_2").addClass("label_error");
					}else{
						$(".lbl_2").removeClass("label_error");
						if(lyric == ""){
							$(".lbl_3").addClass("label_error");
						}else{
							$(".lbl_3").removeClass("label_error");
							if(director == ""){
								$(".lbl_4").addClass("label_error");
							}else{
								$(".lbl_4").removeClass("label_error");
								if(artist == ""){
									$(".lbl_5").addClass("label_error");
								}else{
									$(".lbl_5").removeClass("label_error");
									if(composer == ""){
										$(".lbl_6").addClass("label_error");
									}else{
										$(".lbl_6").removeClass("label_error");
										if(tag == ""){
											$(".lbl_7").addClass("label_error");
										}else{
											$(".lbl_7").removeClass("label_error");
											
												//=============END OF VALIDATION
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
													//LYRICS UPDATE TEXT EDITOR START
													var lyrics = $("#lyrics_").Editor("getText");
													$.post(sendUrl+"/post-ad/videos/updatelyric.php", {postid: postid, lyrics: lyrics}, function (nte) {
														//alert(nte);
													});
													//LYRICS UPDATE TEXT EDITOR END
													
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
													//update music id from music table
													var musicId = document.getElementById("spMusicmediaId_").value;
													if(musicId > 0){
														$.post(sendUrl+"/videos/updatevideo.php", {spPostings_idspPostings: postid, musicId: musicId}, function (r) {
															//alert(r);
														});
													}
													//Testing
													if (imgCount == 0){
														$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
															$("#timeline-container").prepend(r);
															//$(btn).button('reset');
															//alert(r);
														});
													}
													//notification message from send box
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
													//Message after form submited
													$("#dvPreview").html("");
													$("#spPreview").html("");
													$("#clearnow").val("");
													$(".grptimeline").val("");
													$("#postform .form-control").val("");
													//document.getElementById("sp-form-post").reset();
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
													//$(btn).button('reset');
												});
											
										}
									}
								}
							}
						}
					}
				}
			}else{
				$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
			}
		});
		//=================POST A STORE FORM END=============
		//=================POST A STORE FORM DRAFT===========
		
		//=================POST A STORE FORM DRAFT END=======
		//=================POST A STORE FORM DE-ACTIVATE===========
		
		//=================POST A STORE FORM DEACTIVATE END=======
		
	});