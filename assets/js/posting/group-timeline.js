
// document.addEventListener('DOMContentLoaded', function() {
function callAjax(cname, action, data, formdata, errorObj, successObj){
  // Make an AJAX call to add the comment
  var ajaxOptions = {
    url: "/api.php?class=" + cname + "&action=" + action,
    type: "POST",
    data: data,
    success: function(response) {
      response = JSON.parse(response);
      if (response.error !== undefined) {
      } else {
        if (successObj !== undefined) {
          successObj(response);
        }
      }
    },
    error: function(xhr, status, error) {
      errorObj.html(xhr.responseText);
      errorObj.show();
    }
  };
  if (formdata === 1) {
    ajaxOptions.processData = false;
    ajaxOptions.contentType = false;
  }
  $.ajax(ajaxOptions);
}

if ($("#timeline-container").length) {
  let membertype = $("#membertype").val();
  if(membertype =="owner" || membertype=="admin" || membertype=="asstadmin" || membertype=="member" ) 
  {
    callAjax("Timeline", "moreTimeline", { row: 0, pagename:'grouptimeline',groupid:$("#groupid").val() }, 0, function (error){
    $(".timelineload").css({
      display: "none"
    });
  }, function(success){     
    if (success.error == undefined && success != '{}') {
      var mainhtml = '';
      $('#all').val(success['count']);
      if(success['count'] > 11){
        $(".load-more").css({
          display: "block" 
        });
      }
      $.each(success['post'], function(index, item){
        var html = addDiv(item);
        mainhtml = mainhtml+html;
      });
      $(mainhtml).insertBefore("#loadMore");
      setupDropdownListeners();
    }
    $(".timelineload").css({
      display: "none"
    });
  });

  }// member condition ends

  
}

if ($("#pending-timeline-container").length) {   
  callAjax("Timeline", "pendingTimeline", { row: 0, pagename:'pending-timeline', groupid:$("#groupid").val() }, 0, 
  function (error){
    $(".timelineload").css({display: "none"});
  }, 
  function(success){
    if (success.error == undefined && success != '{}') {
      var mainhtml = '';
      $('#all').val(success['count']);
      if(success['count'] > 11){
        $(".load-more").css({
          display: "block" 
        });
      }
      if(success['count'] == 0){
        mainhtml = '<h5>No post found.</h5>';
      }else{
        $.each(success['post'], function(index, item){
          var html = addPendingDiv(item);
          mainhtml = mainhtml + html;
        });
      }
      $(mainhtml).insertBefore("#loadMore");
      setupDropdownListeners();
    }
    $(".timelineload").css({display: "none"});
  });
}

if (document.getElementById("makemepreview")) {
  document.getElementById("makemepreview").style.display = "none";
}
if (document.getElementById("storearrow")) {
  const arrow = document.getElementById('storearrow');
  const rotateButton = document.getElementById('storearrowbutton');
  let rotation = 180;
  rotateButton.addEventListener('click', () => {
    rotation += 180; // Rotate the arrow 180 degrees on each click
    arrow.style.transform = `rotate(${rotation}deg)`;
  });
}

// const channelarrow = document.getElementById('channelarrow');
// const channelrotateButton = document.getElementById('channelarrowbutton');
// let channelrotation = 180;
// channelrotateButton.addEventListener('click', () => {
//   channelrotation += 180; // Rotate the arrow 180 degrees on each click
//   channelarrow.style.transform = `rotate(${channelrotation}deg)`;
// });


if (document.getElementById("freelancearrow")) {
  const freelancerarrow = document.getElementById('freelancearrow');
  const freelancerrotateButton = document.getElementById('freelancearrowbutton');
  let freelancerrotation = 180;
  freelancerrotateButton.addEventListener('click', () => {
    freelancerrotation += 180; // Rotate the arrow 180 degrees on each click
    freelancerarrow.style.transform = `rotate(${freelancerrotation}deg)`;
  });
}

if (document.getElementById("eventarrow")) {
  const eventarrow = document.getElementById('eventarrow');
  const eventrotateButton = document.getElementById('eventarrowbutton');
  let eventrotation = 180;
  eventrotateButton.addEventListener('click', () => {
    eventrotation += 180; // Rotate the arrow 180 degrees on each click
    eventarrow.style.transform = `rotate(${eventrotation}deg)`;
  });
}

if (document.getElementById("videoarrow")) {
  const videoarrow = document.getElementById('videoarrow');
  const videorotateButton = document.getElementById('videoarrowbutton');
  let videorotation = 180;
  videorotateButton.addEventListener('click', () => {
    videorotation += 180; // Rotate the arrow 180 degrees on each click
    videoarrow.style.transform = `rotate(${videorotation}deg)`;
  });
}

if (document.getElementById("artarrow")) {
  const artarrow = document.getElementById('artarrow');
  const artrotateButton = document.getElementById('artarrowbutton');
  let artrotation = 180;
  artrotateButton.addEventListener('click', () => {
    artrotation += 180; // Rotate the arrow 180 degrees on each click
    artarrow.style.transform = `rotate(${artrotation}deg)`;
  });
}

if (document.getElementById("copyButton")) {
  document.getElementById('copyButton').addEventListener('click', function() {
    var referralCode = document.getElementById('refferalcodeurl').innerText;
    copyToClipboard(referralCode);
  });
}

function copyToClipboard(text) {
  navigator.clipboard.writeText(text) // Use Clipboard API to write text to clipboard
  .then(() => {
    console.log('Text copied to clipboard');
  })
  .catch(err => {
    console.error('Could not copy text: ', err);
  });
}

if (document.getElementById("addvideo")) {
  document.getElementById("addvideo").onchange = function(event) {
    let file = event.target.files[0];
    if(file.size <= 52428800){
      if (!file.type.startsWith('video/')) {
        document.getElementById("makemepreview").style.height = "50px";
      } else {
        document.getElementById("makemepreview").style.height = "240px";
      }

      let blobURL = URL.createObjectURL(file);
      document.getElementById("makemepreview").src = blobURL;
      document.getElementById("makemepreview").style.display = "block";
      document.getElementById("g2").style.display = "block";
      document.getElementById("s1").style.display = "block";

      if (file.type.startsWith('video/')) {
        const videoPlayer = document.getElementById('makemepreview');
        videoPlayer.load();
        videoPlayer.play();
      }
    }
  }
}

function validateMediaSize() {
  const input = document.getElementById('addvideo');
  if (input.files && input.files[0]) {
    if (input.files[0].type.indexOf('video/') === 0) {
      const maxAllowedSize = 50 * 1024 * 1024;
      if (input.files[0].size > 52428800) {
        Swal.fire('Video file is too big. Please select a file smaller than 50MB.');
        input.value = '';
      }
    } else if (input.files[0].type.indexOf('audio/') === 0) {
      const maxAllowedSize = 50 * 1024 * 1024;
      if (input.files[0].size > 52428800) { 
        Swal.fire('Audio file is too big. Please select a file smaller than 50MB.');
        input.value = '';
      }
    }
  }
}

window.validateDocumentSize = function() {
  const input = document.getElementById('addDocument');
  if (input.files && input.files[0]) {
    const maxAllowedSize = 5 * 1024 * 1024;
    if (input.files[0].size > maxAllowedSize) {
      Swal.fire('Document size is too big, Please select a file that is less than  5MB.');
      input.value = '';
    }
  }
}

window.validatephotoSize = function() {
  const fileList = document.getElementById('addphoto');
  if (fileList.files.length > 0) {
    for (var i = 0; i <= fileList.files.length - 1; i++) {
      const maxAllowedSize = 5 * 1024 * 1024;
      const fsize = fileList.files.item(i).size;
      const file = Math.round((fsize / 1024));
      if (fsize > maxAllowedSize) {
        Swal.fire('Image size is too big, Please select a file that is less than  5MB.');
        fileList.value = '';
      }
    }
  }
}

if (document.getElementById("dropdown-toggle") && document.getElementById("dropdown-content")) {
  var dropdownToggle = document.getElementById("dropdown-toggle");
  var dropdownContent = document.getElementById("dropdown-content");

  dropdownToggle.addEventListener("click", function(event) {
      event.preventDefault();
      if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
      } else {
          dropdownContent.style.display = "block";
      }
  });
}

window.addEventListener("click", function(event) {
    if (!event.target.matches("#dropdown-toggle") && !event.target.matches("#dropdown-content")) {
        dropdownContent.style.display = "none";
    }
    if (!event.target.closest("#profiledrop-down") && !event.target.closest(".dropdown-menu")) {
      var profileDropdown = document.getElementById("profiledrop-down");
      var dropdownMenu = profileDropdown.closest(".profile-item").querySelector(".dropdown-menu");
      if (dropdownMenu.classList.contains('show')) {
        dropdownMenu.classList.toggle('show');
      }
    }
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('whr-drop-hide')) {
          openDropdown.classList.remove('whr-drop-hide');
        }
      }
    }
});

if(document.getElementById("collapse-sidebar")){
  var sidebar = document.getElementById("side-bar");
  var collapseButton = document.getElementById("collapse-sidebar");
  collapseButton.addEventListener("click", function() {
      if (sidebar.style.transform === "translateY(-150%)") {
          sideBarOpen(); // Open sidebar if closed
      } else {
          sideBarClose(); // Close sidebar if open
      }
  });
}

$(document).ready(function() {
  var MAINURL = window.location.origin;
  if($(".select2").length){
    $(".select2").select2();
  }
  if($(".select3").length){
    $(".select3").select2();
  }

  $("#sourceSelect").on("change", function () {
    var value = $(this).val();
    if (value == "1") {
      $("#groupshow").removeClass("hidden");
      $("#profileshow").addClass("hidden");
    } else if (value == "2") {
      $("#profileshow").removeClass("hidden");
      $("#groupshow").addClass("hidden");
    } else {
      $("#groupshow").addClass("hidden");
      $("#profileshow").addClass("hidden");
    }
  });

  if($("#groupSelect").length){
    $('#groupSelect').select2({
      placeholder: "Select Groups",
      multiple: true,
      width:'100%',
      ajax: {
        url: MAINURL+'/api.php?class=Timeline&action=getGroupsList',
        data: function (params) {
          if (!params.term) {
            params.term = '';
          }
          return {
            searchTerm: params.term // search term
          };
        },
        processResults: function (response) {
          $('#checkingtoggle').text("");
          let data=JSON.parse(response);
          return {
            results: data.map(function(item) {
              return {
                id: item.idspGroup,
                text: item.spGroupName
              };
            })
          };
        },
        cache: true
      }
    });
  }
  
  if($("#friendSelect").length){
    $('#friendSelect').select2({
      allowClear:true,
      placeholder: "Select Friends",
      multiple: true,
      width:'100%',
      ajax: {
        url: MAINURL+'/api.php?class=Timeline&action=getFriendsList',
        data: function (data) {
          if (!data.term) {
            data.term = '';
          }
          return {
            searchTerm: data.term // search term
          };
        },
        processResults: function (response) {
          $('#checkingtoggle').text("");
          let data=JSON.parse(response);
          return {
            results: data.map(function(item) {
              return {
                id: item.idspProfiles,
                text: item.spProfileName
              };
            })
          };
        },
        cache: true
      }
    });
  }
  
  $(document).on('click', '.shareModalBtn', function() {
    var postId = $(this).data('id');
    $('#sharePostingId').val(postId);
  });
  
  $(document).on('click', '.followBtn', function() {
    var follower = $("#profileid").val();
    var btn = $(this);
    var following = btn.data('followid');
    callAjax("PublicView", "follow", {"follower": follower, "following": following}, 0, $("#month-error"), function(success){
      btn.removeClass('followBtn').addClass('unfollowBtn').text('following');
      $('.post_' + following).each(function() {
          $(this).removeClass('followBtn').addClass('unfollowBtn').text('following');
      });
    })
  });

  // timeline submit action

  $(document).on('click', '.unfollowBtn', function() {
    var follower = $("#profileid").val();
    var btn = $(this);
    var following = btn.data('followid');
    if(follower != undefined && following != undefined){
      Swal.fire({
        title: 'Are you sure you want to unfollow this profile ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonColor: '#FF0000',
        cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          var blockerror = $("#block_error");
          callAjax("PublicView", "unfollow", {"follower": follower, "following": following}, 0, $("#month-error"), function(success){
            btn.removeClass('unfollowBtn').addClass('followBtn').text('follow');
            $('.post_' + following).each(function() {
              $(this).removeClass('unfollowBtn').addClass('followBtn').text('follow');
          });
          })
        }
      });
    }
    //$('#sharePostingId').val(postId);
  });


  $('#share').on('click',function(){
    var bb=$('#checkingtoggle').text();
    var error=$('#checkingtoggle');
    if(bb != ''){
      Swal.fire("Please Choose Required Fields");
      return false;
    }else{
      var form_data = new FormData($("#shareform")[0]);
      callAjax("Timeline", "addShare", form_data, 1, error, function(response){
        $('#shareform')[0].reset();
        $("#profileshow").addClass("hidden");
        $("#groupshow").addClass("hidden");
        $('#sharePost').modal('hide');
        Swal.fire({
          title: 'Post shared successfully!',
          icon: 'success'
        })
      });
    }
  });

  var MAINURL = window.location.origin; // can be deleted after test - ganesh

  $("#spPostSubmitTimeline").on("click", function (ev) {
    $(".timelineload").css({ display: "block" });
    $("#youtubevideolink").text('');
    
    if(quillFull.getText().trim() == ""){
      $(".timelineload").css({ display: "none" });
      toastr.info("Please enter the post content.");
      return false;
    }

    if(quillFull != undefined){
      var grptimelinefrmtxt = quillFull.root.innerHTML;
    }
    var chkVideo = document.getElementById("addvideo").value;
    var chkDocument = document.getElementById("addDocument").value;
    var imgCount = $(".postingimg").length;
    var posterror = $("#posterror");
    var flag = 0;
    if (grptimelinefrmtxt != "") {
      var strArr = new Array(); 
      strArr = grptimelinefrmtxt.split("");
      if (strArr[0] == " ") // this is the the key part. you can do whatever you want here!
      {
        flag = 1;
      }
    }
    if (grptimelinefrmtxt == "" && chkVideo == "" && chkDocument == "" && imgCount == "0") {
      var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
      $(".timelineload").css({ display: "none" });
      $('#sp-form-post').each(function () {
        this.reset();
      });
      Swal.fire('Please Post Something.');
    } else if (flag == 1) {
      $(".timelineload").css({ display: "none" });
      var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
      Swal.fire({
        title: "Space not allowed in Post.",
        imageUrl: logo
      });
    } else {
      if ($(this).hasClass("editing")) postedit = true;
      else postedit = false;

      var btn = this;
      var idspprofile = $("#spProfiles_idspProfiles").val();
      var post_status = $("#post_status").val();
      var $form = $("#sp-form-post");
      if (idspprofile != "") {
        var postData = $form.serializeArray();
        postData.push({name: 'spPostingNotes', value: grptimelinefrmtxt});
        url = MAINURL+'/api.php?class=Timeline&action=postPost';
        $(".timelineload").css({ display: "block" });
        $.post(url, postData, function (data, status) { }).fail(function () {
          $(btn).effect("shake");
        }).done(function (data) {
          $(".timelineload").css({ display: "none" });
          if (post_status == 1) {
            var title = '<strong>Your post waiting for approval from group admin.</strong>';
            toastr.info(title);
            // showNofification(title);
          }
          quillFull.deleteText(0, quillFull.getLength());                    
          data = JSON.parse(data);
          if(data.error != undefined){
            $('#sp-form-post').each(function () {
              this.reset();
            });
            $(".timelineload").css({ display: "none" });
            Swal.fire(data.error);
            return false;
          }
          var postid = data.postid;
          var albumid = 0; //$(".album_id").val();  //-- DEBUG BY GANESH
          if ($("#catname").val() != "") {
            $(".timelineload").css({ display: "none" });
            Swal.fire({
              title: $("#spPostingTitle").val() + " Posted!",
              text: "View Your <a href='../post-details/?postid=" + postid + "' style='color:#F8BB86'>Post</a>",
              html: true
            });
          }
          // IMAGE
          var imgCount = $(".postingimg").length;
          $(".postingimg").each(function (i, e) {
            $(".timelineload").css({ display: "block" });
            var base64image = $(e).attr("src");
            var arr = base64image.match(/data:image\/[a-z]+;/);
            var ext = arr[0].replace("data:image/", "");
            ext = ext.replace(";", "");
            var form_data = new FormData();
            form_data.append('spPostings_idspPostings', postid);
            form_data.append('spPostingPic', $('#addphoto')[0].files[i]);
            $.ajax({
              url: MAINURL + "/api.php?class=Timeline&action=postPic",
              type: 'post',
              data: form_data,
              dataType: 'json',
              contentType: false,
              processData: false,
              complete: function (r) {
                if (i == imgCount - 1) {
                  $('#sp-form-post').each(function () {
                    this.reset();
                  });
                  callAjax("Timeline", "postTimeline", { postid: postid, pagename:'grouptimeline',groupid:$("#groupid").val() }, 0, posterror, function(success){
                    if (success.error == undefined && success != '{}') {
                      var html = addDiv(success);
                      $("#timeline-container").prepend(html);
                      setupDropdownListeners();
                    }
                    $(".timelineload").css({display: "none"});
                  });
                }
              }
            });
          });

          //Testing
          var vidCount = $("#mediaTitle").text();
          if (imgCount == 0 && vidCount == "") {
            $(".timelineload").css({ display: "block" });
            $('#sp-form-post').each(function () {
              this.reset();
            });
            callAjax("Timeline", "postTimeline", { postid: postid, pagename:'grouptimeline',groupid:$("#groupid").val()} , 0, posterror, function(success){
              if (success.error == undefined && success != '{}') {
                var html = addDiv(success);
                $("#timeline-container").prepend(html);
                setupDropdownListeners();
              }
              $(".timelineload").css({display: "none"});
            });
          }
          var chkVideo = document.getElementById("addvideo").value;
          if (chkVideo != '') {
            $(".timelineload").css({ display: "block" });
            ev.preventDefault();
            var form_data = new FormData($("#sp-form-post")[0]);
            form_data.append('spPostings_idspPostings', postid);
            form_data.append('spPostingAlbum_idspPostingAlbum_', albumid);
            callAjax("Timeline", "postMedia", form_data, 1, posterror, function(success){
              $("#addvideo").val("");
              $("#mediaTitlevideo").text("");
              $("#mediaTitle").text("");
              $("#showchekbox").addClass("hidden");
              $('#sp-form-post').each(function () {
                    this.reset();
                  });
              callAjax("Timeline", "postTimeline", { postid: postid, pagename:'grouptimeline',groupid:$("#groupid").val() }, 0, posterror, function(success){
                if (success.error == undefined && success != '{}') {
                  var html = addDiv(success);
                  $("#timeline-container").prepend(html);
                  setupDropdownListeners();
                }
                $(".timelineload").css({
                  display: "none"
                });
              });
            });
          }
          //for document
          var chkDocument = document.getElementById("addDocument").value;
          if (chkDocument != '') {
            $(".timelineload").css({ display: "block" });
            ev.preventDefault();
            var form_data = new FormData($("#sp-form-post")[0]);
            form_data.append('spPostings_idspPostings', postid);
            form_data.append('spPostingAlbum_idspPostingAlbum_', albumid);
            $.ajax({
              url: MAINURL + "/api.php?class=Timeline&action=postMedia",
              type: "POST",
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              contentType: false,
              success: function (vi) {
                $("#addDocument").val("");
                $("#showchekbox").addClass("hidden");
                $("#mediaTitle").text("");
                $('#sp-form-post').each(function () {
                    this.reset();
                  });
                callAjax("Timeline", "postTimeline", { postid: postid, pagename:'grouptimeline',groupid:$("#groupid").val() }, 0, posterror, function(success){
                  if (success.error == undefined && success != '{}') {
                    var html = addDiv(success);
                    $("#timeline-container").prepend(html);
                    setupDropdownListeners();
                  }
                  $(".timelineload").css({display: "none"});
                });
                //window.location.reload();
              },
              error: function (error) { }
            });
          }
          // $(".timelineload").css({ display: "none" });
          $(".grptimeline").val("");
          $(".grptimeline").html("");
          $("#dvPreview").html("");
          $("#clearnow").val("");
          $(".grptimeline").val("");
          $("#postform .form-control").val("");
        }).always(function () {});
      } else {
        alert("Please Select profile!..");
      }
    }
  });
  
  //timeline submit action end
  $(".postingpic").change(function () {
    var showFea = $(this).attr('showFeatured');
    var imgcound = $("#dvPreview  .imagepost").length;
    var files = $(this)[0].files;
    if (files.length <= 20) {
      if (imgcound < 20) {
        if (typeof (FileReader) != "undefined") {
          var dvPreview = $("#dvPreview");
          var regex = /^([a-zA-Z0-9\s_\\.\-:$()])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
          var r = 0;
          var sz = 0;
          $($(this)[0].files).each(function () {
            var file = $(this);
            if(file[0].size <= 20971520){
              if (regex.test(file[0].name.toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function (e) {
                  var countNum = $(".count").val();
                  countNum++;
                  r++;
                  sz = sz+e.total;
                  $("#count").val(countNum);
                  $('.featureImg:checkbox:checked:visible:first').val();
                  if (r == 1 && imgcound > 0) {
                    var img = $("<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg 222 closed'></span><img class='postingimg overlayImage11' style='width:100px; height: 100px; margin-right:5px;' data-name='fi_" + countNum + "' src='" + e.target.result + "'/><label style='font-size: 9px;'><input type='hidden' class='featureImg' name='featureImg_' id='fi_" + countNum + "' value='1' />Feature Image</label></div>");
                  } else if (r == 1) {
                    var htmlContent = "<div class='col-md-2 imagepost'><span onclick='removeImage()' class='fa fa-remove dynamicimg closed' style='margin-right:4px !important;'></span><img class='postingimg overlayImage22' style='width:100px; height: 100px; margin-right:5px;' data-name='fi_" + countNum + "' src='" + e.target.result + "'/>"; 
                    if(showFea === "1"){
                      htmlContent = htmlContent+"<label style='font-size: 9px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_" + countNum + "' value='1' checked />Feature Image</label>";
                    }
                    htmlContent = htmlContent+"</div>";
                    var img = $(htmlContent);
                  } else {
                    htmlContent = "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg 444 closed'></span><img class='postingimg overlayImage33' style='width:100px; height: 100px; margin-right:5px;' data-name='fi_" + countNum + "' src='" + e.target.result + "'/>";
                    if(showFea === "1"){
                      htmlContent = htmlContent+"<label style='font-size: 9px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_" + countNum + "' value='1' />Feature Image</label>";
                    }
                    htmlContent = htmlContent+"</div>";
                    var img = $(htmlContent);
                  }
                  dvPreview.append(img);
                  document.getElementById("dvPreview").classList.remove('hidden');
                }
                reader.readAsDataURL(file[0]);
              } else {
                var file_name = file[0].name + " is not a valid image file.";
                Swal.fire({
                  title: "Please select a valid image file.",
                  text: file_name,
                  type: "warning",
                  showCancelButton: false,
                  showConfirmButton: true,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "ok",
                  closeOnConfirm: false
                });
                return false;
              }
            } else {
              Swal.fire({
                title: "You can not upload more than 20 MB.",
                text: file_name,
                type: "warning",
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "ok",
                closeOnConfirm: false
              });
              $(".postingpic").val("");
              return false;
            }
          });
        } else {
          alert("This browser does not support HTML5 FileReader.");
        }
      } else {
        var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
        Swal.fire({
          title: "You can Upload 20 Images Only.",
          imageUrl: logo
        });
      }
    } else {
      var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
      Swal.fire({
        title: "You can Upload 20 Images Only.", 
        imageUrl: logo
      });
      $(".postingpic").val("");
    }
  });

  $('.load-more').click(function() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
    row = row + 11;
    if (row <= allcount) {
      $("#row").val(row);
      var profileid = $("#profiddd").val();
      $.ajax({
        url: MAINURL+'/api.php?class=Timeline&action=moreTimeline',
        type: 'post',
        data: {
          row: row,
          profile: profileid
        },
        beforeSend: function() {
          $(".load-more").text("Loading...");
        },
        success: function(response) {
          response = JSON.parse(response);
          var mainhtml = '';
          $.each(response['post'], function(index, item){
            var html = addDiv(item);
            mainhtml = mainhtml+html;
          });
          setTimeout(function() {
            $(".blogs:last").after(mainhtml).show().fadeIn("slow");
            $(".load-more").text("Load More");
            var rowno = row + 11;
            if (rowno > allcount) {
              $('.load-more').css("display", "none");
            } else {
              $(".load-more").text("Load more");
            }
            $(".load-more").text("Load More");
            setupDropdownListeners();
          }, 2000);
        }
      });
    } else {
      $('.load-more').text("Loading...");
      setTimeout(function() {
        $('.blogs:nth-child(3)').nextAll('.post').remove().fadeIn("slow");
        $("#row").val(0);
        $('.load-more').text("Load more");
        $('.load-more').css("background", "#15a9ce");
      }, 2000);
    }
  });

  $(".spDocument").change(function () {
    if (typeof (FileReader) != "undefined") {
      var myfile = "";
      myfile = $('.spDocument').val();
      var ext = myfile.split('.').pop();
      $($(this)[0].files).each(function () {
        var file = $(this);
        if(file[0].size <= 5097152){
          var fileName = "Uploaded: " + file[0].name;
          if (ext == 'pdf' || ext == 'doc' || ext == 'xls' || ext == 'docx' || ext == 'html' || ext == 'txt' || ext == 'php') {
            var reader = new FileReader();
            $("#mediaTitle").html(fileName);
            reader.onload = function (e) { }
            reader.readAsDataURL(file[0]);
            $("#showchekbox").removeClass("hidden");
          } else {
            var file_name = file[0].name + " is not a valid file. upload only documents";
            Swal.fire({
              title: "Please select a valid document file.",
              text: file_name,
              type: "warning",
              showCancelButton: false,
              showConfirmButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: "ok",
              closeOnConfirm: false
            });
            document.getElementById("sp-form-post").reset();  
            return false;
          }
        } else {
          Swal.fire({
            title: "You can not upload more than 5 MB.",
            text: file_name,
            type: "warning",
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "ok",
            closeOnConfirm: false
          });
          document.getElementById("sp-form-post").reset();
          return false;
        }
      });
    } else {
      alert("This browser does not support HTML5 FileReader.");
    }
  });

  $(".spmedia").change(function () {
    if (typeof (FileReader) != "undefined") {
      var mcontainer = $("#media-container");
      $($(this)[0].files).each(function () {
        var file = $(this);
        var fileName = "Uploaded: " + file[0].name;
        if(file[0].size <= 52428800){
          if (file[0].name.match(/.(mp4|3g2|3gp|avi|flv|f4v|h264|m4v|mkv|html5|mov|mp4|mpeg-2|mpg|rm|swf|vob|wmv|mp3|mpa|webm|avchd|mp2|3gp|mpeg|mpe|wav|mpv|ogg|wma|mts|mt2s|ts|qt|m4p|midi|mid)$/i)) {
            var reader = new FileReader();
            $("#mediaTitle").html(fileName);
            reader.onload = function (e) {
              var div = $("<div class='media-file-data postingvideo'></div>");
              div.attr("data-media", e.target.result);
              mcontainer.append(div);
            }
            reader.readAsDataURL(file[0]);
            $("#showchekbox").removeClass("hidden");
          } else {
            var file_name = file[0].name + " is not a valid video file."; 
            Swal.fire({
            title: "Please select a valid Audio/Video file.",
            text: file_name,
            type: "warning",
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "ok",
            closeOnConfirm: false
            });
            document.getElementById("sp-form-post").reset();
            return false;
          }
        } else {
          document.getElementById("mediaTitle").innerText = "";
          document.getElementById("g2").style.display = "none";
          document.getElementById("s1").style.display = "none";
          document.getElementById("makemepreview").style.display = "none";
          $(".acknowled").css({
            display: "none"
          });
          Swal.fire({
            title: "You can not upload more than 50 MB.",
            text: file_name,
            type: "warning",
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "ok",
            closeOnConfirm: false
          });
          document.getElementById("sp-form-post").reset();
          return false;
        }
      });
    } else {
      alert("This browser does not support HTML5 FileReader.");
    }
  });
});

function isMobileDevice() {
  return typeof window.orientation !== 'undefined' || navigator.userAgent.indexOf('IEMobile') !== -1;
}

function sideBarOpen() {
    const sideBar = document.getElementById('side-bar');
    const createPostWrapper = document.querySelector('.create-post-wrapper');
    sideBar.style.transform = 'translateX(0)';
    sideBar.style.width = '215px';
    createPostWrapper.style.width = `calc(100% - 490px)`;
    document.getElementById("logo-wrapper").style.display = "block";
    document.getElementById("collapse-sidebar").style.marginRight = "0px";
    
}

function sideBarClose() {
    const sideBar = document.getElementById('side-bar');
    const createPostWrapper = document.querySelector('.create-post-wrapper');
    sideBar.style.transform = 'translateY(-150%)';
    sideBar.style.width = '0';
    createPostWrapper.style.marginLeft = '0';
    createPostWrapper.style.width = `calc(100% - 275px)`;
    document.getElementById("logo-wrapper").style.display = "none";
    document.getElementById("collapse-sidebar").style.marginRight = "190px";
  
}
function leftsideBarOpen() {
  const sideBar = document.getElementById('side-bar');
  sideBar.style.transform = 'translateY(0)';
}

function leftsideBarClose() {
  const sideBar = document.getElementById('side-bar');
  sideBar.style.transform = 'translateY(-150%)';
}

function toggleClassOfDiv(id) {
  const collapseElement = document.getElementById(id);
  const isCollapsed = collapseElement.classList.contains('show');
  if (isCollapsed) {
    collapseElement.classList.remove('show');
  } else {
    collapseElement.classList.add('show');
  }
}


/*function myFunction(id) {
  document.getElementById("myDropdown" + id).classList.toggle("whr-drop-hide");
}*/

function removeImage() {
  $(".postingpic").val("");
  $("#dvPreview").html("");
}

function remove() {
  $("#addvideo").val("");
  document.getElementById("makemepreview").style.display = "none";
  document.getElementById("g2").style.display = "none";
  document.getElementById("mediaTitle").innerText = "";
  document.getElementById("s1").style.display = "none";
  $("#showchekbox").addClass("hidden");
}

function profilechange(id, link) {
  var btn = this;
  $.post("../api.php?class=Header&action=makeprofiledefault", {
    profileid: id
  }, function (r) {
    if(link == 0){
      location.reload();
    } else {
      window.location.href = window.location.origin+'/my-profile/';
    }
  });
};

function toggleDropdown(element) {
  var dropdownMenu = element.nextElementSibling;
  dropdownMenu.classList.toggle('show');
}

function setupDropdownListeners() {
    var dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    var dropdownContents = document.querySelectorAll('.dropdown-content');

    dropdownTriggers.forEach(function(trigger, index) {
        trigger.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownContents.forEach(function(content) {
                content.style.display = 'none';
            });
            dropdownContents[index].style.display = 'block';
        });
    });

    document.addEventListener('click', function(event) {
        dropdownContents.forEach(function(content) {
            if (!content.contains(event.target) && content.style.display === 'block') {
                content.style.display = 'none';
            }
        });
    });
}


function showflagPostModal(id,postprofileid){
  $("#flagPost #flagpostprofileid").val(postprofileid);
  $("#flagPost #spPosting_idspPosting").val(id);
  $("#flagPost").modal('show');
}

function flagPost() {
  $("#flagPost").modal('hide');
  var id = $("#flagPost #spPosting_idspPosting").val();
  var MAINURL = window.location.origin;
  Swal.fire({
    title: "Do you want to flag this post?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: MAINURL + "/api.php?class=Timeline&action=saveFlagpostes",
        type: "POST",
        data: {
          save : id,
          spProfile_idspProfile : $("#flagPost #spProfile_idspProfile").val(),
          flagpostprofileid : $("#flagPost #flagpostprofileid").val(),
          spPosting_idspPosting : $("#flagPost #spPosting_idspPosting").val(),
          why_flag : $('input[name="radReport"]:checked').val()
        },
        success: function (response) {
          toastr.success('Post Flaged successfully.');
          $("#saveFlagfun" + id).html('<span class="dropdown-item"  onclick="myUnsave(' + id + ')"><i class="fa fa-flag-checkered"></i></span>'
          );
        },
      });
    }
  });
}

function unflagPost(id, postprofileid) {
  var MAINURL = window.location.origin;
  Swal.fire({
    title: "Do you want to unflag this post?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: MAINURL + "/api.php?class=Timeline&action=saveFlagpostes",
        type: "POST",
        data: {
          unsave: id,
        },
        success: function (response) {
          toastr.success('Post Un-flaged successfully.');
          $("#saveFlagfun" + id).html(
            '<span class="dropdown-item" class="profile_section" onclick="showflagPostModal(' + id + ','+ postprofileid +');" ><i class="fa fa-flag"></i></span>'
          );
        },
      });
    }
  });
}

function savePosts(id) {
  var MAINURL = window.location.origin;
  Swal.fire({
    title: 'Do you want to Save this post?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: MAINURL + "/api.php?class=Timeline&action=savepostes",
        type: "POST",
        data: {
          save: id,
        },
        success: function(response) {
          $("#savefun" + id).html('<span class="dropdown-item" onclick="myUnsave('+id+')"><i class="fa fa-remove"></i></span>');
        }
      });
    }
  });
}

function myUnsave(id) {
  var MAINURL = window.location.origin;
  Swal.fire({
    title: 'Do you want to Unsave this post?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
        url: MAINURL + "/api.php?class=Timeline&action=savepostes",
        type: "POST",
        data: {
          unsave: id,
        },
        success: function(response) {
          $("#savefun" + id).html('<span class="dropdown-item"  onclick="savePosts(' + id + ')" ><i class="fa fa-save"></i></span>');
        }

      });
    }
  });
}

var allPostContents = {}
function addDiv(item) {
  var MAINURL = window.location.origin;
  var picture = MAINURL + "/assets/images/icon/blank-img.png";
  var profileid = $("#profileid").val();
  if (item.picture != undefined) {
    picture = item.picture;
  }
  var profilename = "";
  if (item.profilename != undefined) {
    profilename = item.profilename;
  }
  var time = "";
  if (item.time != undefined) {
    time = item.time;
  }
  var likeIcon = MAINURL + "/assets/images/mini-06.svg";
  if (item.isLiked != undefined && item.isLiked != false) {
    likeIcon = MAINURL + "/assets/images/like-fill.svg";
  }
  var commentIcon = MAINURL + "/assets/images/mini-07.svg";

  var loveIcon = MAINURL + "/assets/images/mini-08.svg";
  if (item.isLoved != undefined && item.isLoved != false) {
    loveIcon = MAINURL + "/assets/images/heard-fill.svg";
  }
  var shareIcon = MAINURL + "/assets/images/mini-09.svg";
  if (item.isShared != undefined && item.isShared != false) {
    shareIcon = MAINURL + "/assets/images/share-fill.svg";
  }
  if (item.spPostingNotes != undefined) {
    var postNotes = item.spPostingNotes;
    allPostContents[item.idspPostings] = postNotes;
    postNotes = $("<div/>").html(postNotes).html();
    if (item.bday_post != undefined && item.bday_post == 1) {
      postNotes =
        postNotes +
        '<a class="bdayname" href="' +
        MAINURL +
        "/friends/?profileid=" +
        item.bdayPid +
        '">' +
        item.bdayUser +
        "</a>";
    }

    if (item.spPostingNotes.length > 1500) {
      var regex =
        /(<\w+>.*?<\/\w+>\s*<\w+>.*?<\/\w+>\s*<\w+>.*?<\/\w+>\s*<\w+>.*?<\/\w+>)/gim;
      var m = regex.exec(postNotes.toString());
      if (m !== null) {
        postNotes =
          m[0] +
          "<span class='read-more' onClick='showAll(" +
          item.idspPostings +
          ");'> ..Read more</span>";
        postNotes = $("<div/>").html(postNotes).html();
      }
    }
  }

  var html =
    '<div class="blogs">' +
    '<div class="chat-user d-flex justify-content-between align-items-center mb-3">' +
    '<div class="user-margin-profile d-flex align-items-center">' +
    '<div class="user-img me-2 rounded-circle overflow-hidden">' +
    '<img src="' +
    picture +
    '" class="img-fluid" alt="" style="width: 50px; height: 50px;"/>' +
    "</div>" +
    '<div class="user-text  d-flex flex-column">' +
    '<div class="d-flex align-items-center">' +
    '<a style="text-decoration:none !important;color:inherit !important;margin-bottom: 5px !important;" href ="' +
    MAINURL +
    "/friends/?profileid=" +
    item.spProfiles_idspProfiles +
    '"><strong class="d-flex">' +
    profilename +
    "</strong></a>";
  if (profileid != item.spProfiles_idspProfiles) {
    if (item.isFollowing == true) {
      html +=
        '<span class="follow unfollowBtn post_' +
        item.spProfiles_idspProfiles +
        '" data-followid="' +
        item.spProfiles_idspProfiles +
        '" >following</span>';
    } else {
      html +=
        '<span class="follow followBtn post_' +
        item.spProfiles_idspProfiles +
        '" data-followid="' +
        item.spProfiles_idspProfiles +
        '" >follow</span>';
    }
  }
  html += '</div><span class="d-flex">' + time +'</span></div></div><div class="d-flex align-items-center more-link">' +
    "<div class='dropdown'><a class='text-dark' type='button' id='dropdownMenuButtonPosting1' data-bs-toggle='dropdown' aria-expanded='false'>" +
    '<img src="' + MAINURL + '/assets/images/dot-2.svg" class="img-fluid" alt=""/></a>' +
    '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPosting1">' + 
      '<li style="cursor:pointer;" id="savefun' + item.idspPostings + '">' ;
    
  if(item.isSaved == true){
    html += '<span class="dropdown-item" onclick="myUnsave(' + item.idspPostings + ');"><i class="fa fa-remove"></i></span>';
  }else{
    html += '<span class="dropdown-item" onclick="savePosts(' + item.idspPostings + ');"><i class="fa fa-save"></i></span>';
  }

  html += "<li>";
  html += '</li><li style="cursor:pointer;" id="saveFlagfun' + item.idspPostings + '">';
  if(item.isFlaged == true){
    html += '<span class="dropdown-item" onclick="unflagPost(' + item.idspPostings + ','+item.spProfiles_idspProfiles+');"><i class="fa-solid fa-flag-checkered"></i></span>';
  }else{
    html += '<span class="dropdown-item" onclick="showflagPostModal(' + item.idspPostings + ','+item.spProfiles_idspProfiles+');"><i class="fa-solid fa-flag"></i></span>';
  }

  html += "<li>";



  if (profileid == item.spProfiles_idspProfiles) {
    html += '<li style="cursor:pointer;">' + '<span class="dropdown-item edit-post" data-postid="' + item.idspPostings + '"><i class="fa fa-pencil-alt" ></i></span></span></li>' +
      '<li style="cursor:pointer;">' + '<span class="dropdown-item" onclick="deletePost(' + item.idspPostings + ');"><i class="fa fa-trash"></i></span></li>';
  }
  
  html += '</ul></div></div></div><div class="posting-notes" id="postingNote' + item.idspPostings +'" >' + postNotes +
    '</div>';
  if (
    item.timlinepostpic != undefined &&
    item.timlinepostpic.data != undefined &&
    item.timlinepostpic.data.length > 0
  ) {
    $.each(item.timlinepostpic.data, function (index, item1) {
      if (item1.spPostingPic != undefined) {
        html += '<div class="blog-img"><img src="' + item1.spPostingPic + '" class="img-fluid center" alt="" /></div>';
      }
    });
  }
  if (item.media != undefined) {
    if (item.media.sppostingmediaExt == "mp3") {
      html =
        html +
        '<div style="margin-left:15px;margin-right:15px;">' +
        '<audio class="center" style="width:90%" controls>' +
        '<source src="' +
        item.media.sppostingmediaTitle +
        '" type="audio/' +
        item.media.sppostingmediaExt +
        '">' +
        "Your browser does not support the audio element." +
        "</audio>" +
        "</div>";
    } else if (
      item.media.sppostingmediaExt == "pdf" ||
      item.media.sppostingmediaExt == "xls" ||
      item.media.sppostingmediaExt == "doc" ||
      item.media.sppostingmediaExt == "docx"
    ) {
      html =
        html +
        '<div class="row timelinefile" style="width:100%;">' +
        '<div class="col-md-offset-1 col-md-1 no-padding">' +
        '<img src="' +
        MAINURL +
        '/assets/images/pdf.png" alt="pdf" class="img-fluid"/>' +
        "</div>" +
        '<div class="col-md-10">' +
        "<h3>" +
        item.media.original_name +
        "</h3>" +
        "<small>" +
        item.media.sppostingmediaExt +
        "</small>" +
        '<a href="' +
        item.media.sppostingmediaTitle +
        '"  target="_blank" download>Preview</a>' +
        "</div>" +
        "</div>";
    } else if (
      item.media.sppostingmediaExt == "mp4" ||
      item.media.sppostingmediaExt == "webm" ||
      item.media.sppostingmediaExt == "ogg"
    ) {
      html += '<div style="margin-left:15px;margin-right:15px;">' +
        '<video class="custom-video center" style="width: 65%;!important;" controls>' +
        '<source src="' +
        item.media.sppostingmediaTitle +
        '" type="video/' +
        item.media.sppostingmediaExt +
        '">' +
        "</video>" +
        "</div>";
    }
  }

  html += '<div class="likes-icon">' +
    '<ul class="d-flex align-items-center p-0">' +
    '<li class="likes-list">' +
    '<div class="d-flex align-items-center lft_head">' +
    '<div class="photo-img " onClick="likePost(' +
    item.idspPostings +
    ', 7);">' +
    '<img id="likeImg' +
    item.idspPostings +
    '" src="' +
    likeIcon +
    '" alt="" />' +
    "</div>" +
    '<span  id="likeCount' +
    item.idspPostings +
    '" >(' +
    item.likeCount +
    ")</span>" +
    "</div>" +
    "</li>" +
    '<li class="likes-list">' +
    '<div class="d-flex align-items-center lft_head">' +
    // load comment and reply
    '<div class="photo-img" onclick="loadComment('+item.idspPostings+');">' +
    '<img id="commentImg' +
    item.idspPostings +
    '" src="' +
    commentIcon +
    '"  alt="" />' +
    "</div>" +
    '<span id="commentsCount' +
    item.idspPostings +
    '">(' +
    item.commentsCount +
    ")</span>" +
    "</div>" +
    "</li>" +
    '<li class="likes-list">' +
    '<div class="d-flex align-items-center lft_head">' +
    '<div class="photo-img " onClick="lovePost(' +
    item.idspPostings +
    ', 7);" >' +
    '<img id="loveImg' +
    item.idspPostings +
    '" src="' +
    loveIcon +
    '"  alt="" />' +
    "</div>" +
    '<span id="lovesCount' +
    item.idspPostings +
    '">(' +
    item.loveCount +
    ")</span>" +
    "</div>" +
    "</li>" +
    '<li class="likes-list">' +
    '<div class="d-flex align-items-center lft_head">' +
    '<div class="photo-img shareModalBtn" data-bs-toggle="modal" data-id="' +
    item.idspPostings +
    '" data-bs-target="#sharePost">' +
    '<img id="shareImg' +
    item.idspPostings +
    '" src="' +
    MAINURL +
    '/assets/images/mini-09.svg" alt="" />' +
    "</div>" +
    '<spanid="shareCount' +
    item.idspPostings +
    '">(' +
    item.shareCount +
    ")</span>" +
    "</div>" +
    "</li>" +
    "</ul>" +
    "</div>";
    
    html += '<div id="load_new_commnet_section_'+item.idspPostings+'">';
    html += loadCommentOnly(MAINURL, item.idspPostings);
    html += '</div>';

    html += '<div class="likes-input d-flex justify-content-center align-items-center">'+
    '<div class="input-group">' +
    '<input id="commentInput' +
    item.idspPostings +
    '" type="text" class="form-control" placeholder="Type your comment here..." aria-label="Username" aria-describedby="basic-addon1">' +
    "</div>" +
    '<div onClick="postComments(' +
    item.idspPostings +
    ');" class="plan-icon d-flex justify-content-center align-items-center">' +
    '<img src="' +
    MAINURL +
    '/assets/images/post-icon.svg" class="img-fluid" alt="" />' +
    "</div>" +
    "</div>" +
    '<span id="commentError' +
    item.idspPostings +
    '" style="color: red; display: none;"></span>' +
    "</div>";
  return html;
}

function loadCommentOnly(MAINURL,idspPostings, ajaxComment = "yes"){
  html = '';
  $.ajax({
    url: MAINURL + "/timeline/loadcomment.php",
    type: "POST",
    data: {
      id: idspPostings,
      ajaxComment : ajaxComment,
      groupid: $("#groupid").val()
    },
    async : false,
    dataType : "html",
    success: function (response) {
      html += response;
    },
  });
  return html;
}

function addPendingDiv(item){
  var MAINURL = window.location.origin;
  var picture = MAINURL + "/assets/images/icon/blank-img.png";
  var profileid = item.spProfiles_idspProfiles;
  var spProfile = item.spProfiles_idspProfiles;
  if(item.picture != undefined) { 
    picture = item.picture;
  }
  var profilename = "";
  if(item.profilename != undefined) { 
    profilename = item.profilename;
  }
  var time = "";
  if(item.time != undefined) { 
    time = item.time;
  }

  if(item.spPostingNotes != undefined){
    var postNotes = item.spPostingNotes;
    allPostContents[item.idspPostings] = postNotes;
    postNotes = $('<div/>').html(postNotes).text();
    if(item.bday_post != undefined && item.bday_post == 1){
      postNotes = postNotes+'<a class="bdayname" href="'+MAINURL+'/friends/?profileid='+item.bdayPid+'">'+item.bdayUser+'</a>';
    }
    
    if (item.spPostingNotes.length > 1500) {
      var regex = /(<\w+>.*?<\/\w+>\s*<\w+>.*?<\/\w+>\s*<\w+>.*?<\/\w+>\s*<\w+>.*?<\/\w+>)/gmi;
      var m = regex.exec(postNotes.toString());
      if(m !== null){
        postNotes = m[0]+"<span class='read-more' onClick='showAll("+item.idspPostings+");'> ..Read more</span>";
        postNotes = $('<div/>').html(postNotes).html();
      }
    }
  }


  
  var html = '<div class="blogs">'+  
  '<div class="chat-user d-flex justify-content-between align-items-center mb-3">'+
  '<div class="user-margin-profile d-flex align-items-center">'+
  '<div class="user-img me-4 rounded-circle overflow-hidden">'+
  '<img class="prflnk" id="'+profileid+'" src="'+picture+'" class="img-fluid" alt="" style="cursor: pointer; width: 50px; height: 50px;"/>'+
  '</div>'+

  '<div class="user-text  d-flex flex-column">'+
  '<a style="text-decoration:none !important; margin-bottom: 5px !important;" href="/friends/?profileid='+profileid+'">'+
  '<strong class="d-flex">'+profilename+'</strong></a>'+

  '<span class="d-flex">'+time+'</span>'+
  '</div>'+
  '</div>'+
  '<div class="d-flex align-items-center more-link">'+ 
  '<div>'+

  `<div class="d-flex align-items-center more-link">
  <div class="d-flex align-items-center more-link btns">
                                <button class="rjt_post" id="rjp_`+item.idspPostings+`" data-post="`+item.idspPostings+`" style="background-color: #EF1D26;">Reject</button>
                                <button class="acp_post" id="acp_`+item.idspPostings+`" data-post="`+item.idspPostings+`" style="background-color: #7649B3;">Accept</button>
                            </div>
                                    
                                </div>`+
  
  '</div>'+
  '</div>'+
  '</div>'+
  '<div class="posting-notes" id="postingNote'+item.idspPostings+'" >'+postNotes+'</div>'+
  '<!-- <a href="">Read more..[if long text]</a> -->';
  ;
  if(item.timlinepostpic != undefined && item.timlinepostpic.data != undefined && item.timlinepostpic.data.length > 0){
    $.each(item.timlinepostpic.data, function(index, item1){
      if(item1.spPostingPic != undefined){
        html = html+'<div class="blog-img">'+
        '<img src="'+item1.spPostingPic+'" class="img-fluid center" alt="" />'+
        '</div>';
      }
    });
  }
  if(item.media != undefined){
    if(item.media.sppostingmediaExt == 'mp3'){
      html = html+'<div style="margin-left:15px;margin-right:15px;">'+
      '<audio class="center" style="width:90%" controls>'+
      '<source src="'+item.media.sppostingmediaTitle+'" type="audio/'+item.media.sppostingmediaExt+'">'+
      'Your browser does not support the audio element.'+
      '</audio>'+
      '</div>';
    } else if(item.media.sppostingmediaExt == 'pdf' || item.media.sppostingmediaExt == 'xls' || item.media.sppostingmediaExt == 'doc' || item.media.sppostingmediaExt == 'docx'){
      html = html+'<div class="row timelinefile" style="width:100%;">'+
      '<div class="col-md-offset-1 col-md-1 no-padding">'+
      '<img src="'+MAINURL+'/assets/images/pdf.png" alt="pdf" class="img-fluid"/>'+
      '</div>'+
      '<div class="col-md-10">'+
      '<h3>'+item.media.original_name+'</h3>'+
      '<small>'+item.media.sppostingmediaExt+'</small>'+
      '<a href="'+item.media.sppostingmediaTitle+'"  target="_blank" download>Preview</a>'+
      '</div>'+
      '</div>';
    } else if(item.media.sppostingmediaExt == 'mp4' || item.media.sppostingmediaExt == 'webm' ||
      item.media.sppostingmediaExt == "ogg") {
      html = html+'<div style="margin-left:15px;margin-right:15px;">'+
      '<video class="custom-video center" style="width: 65%;!important;" controls>'+
      '<source src="'+item.media.sppostingmediaTitle+'" type="video/'+item.media.sppostingmediaExt+'">'+
      '</video>'+
      '</div>';
    }
  }

  html = html+
  '<span id="commentError'+item.idspPostings+'" style="color: red; display: none;"></span>'+
  '</div>';
  return html;
}

// profile image link
$(document).on('click', '.prflnk', function(e){
  window.location.href="/friends/?profileid="+$(this).attr('id');
})



//-- accept pending post
$(document).on('click', '.acp_post', function(e){
  var item_id = $(this).attr('data-post'); 
  $.post("common/group_action.php", {
    postid: item_id,
    grpid: groupid,
    accpt_post: true,
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status == 'accpt_post'){
      $("#acp_"+item_id).closest('.blogs').hide()
      $.alert({
          title: 'Message!',
          content: res.message,
      });
    }
    else {
      $.alert({
        title: res.status,
        content: "There is some error", //res.message
      });
  } });

});
//-- accept pending post


//-- reject pending post
$(document).on('click', '.rjt_post', function(e){

var item_id = $(this).attr('data-post'); 

  $.post("common/group_action.php", {
    postid: item_id,
    grpid: groupid,
    reject_post: true,
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status == 'reject_post'){
      $("#acp_"+item_id).closest('.blogs').hide()
      $.alert({
        title: 'Message!',
        content: res.message,
      });
    }
    else {
      $.alert({
          title: res.status,
          content: "There is some error", //res.message
      });
    } 
  });

});
//-- reject pending post

function showAll(id) {
  var postNotes = $("<div/>").html(allPostContents[id]).text();
  $("#postingNote" + id).html(postNotes);
}

//.... delete post from business profile
function deletePost(id) {
  var MAINURL = window.location.origin;
  Swal.fire({
    title: "Message will be deleted permanently. Are you sure you want to delete it?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes",
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      $(".timelineload").css({ display: "block" });
      $.ajax({
        url: MAINURL + "/api.php?class=Timeline&action=deletePosts",
        type: "POST",
        data: {
          postid: id,
        },
        success: function (response) {
          $(".timelineload").css({ display: "none" });
          $("#postMainId" + id).hide();
          location.reload();
        },
      });
    }
  });
}

function getComboA(selectObject) {
  var questionText = selectObject.replace(/[0-9]/g, "");
  var newtext = $(".cate_drop :selected").text();
  if (questionText == "-p") {
    $(".cate_drop")
      .find("option")
      .each(function (index, option) {
        $(option).html(
          $(option)
            .html()
            .replace(/ - Profile/g, "")
        );
      });
    $(".cate_drop")
      .find("option")
      .each(function (index, option) {
        $(option).html(
          $(option)
            .html()
            .replace(/ - Product/g, "")
        );
      });
    $(".cate_drop option:selected ").text(newtext + " - Profile");
  } else if (questionText == "-c") {
    $(".cate_drop")
      .find("option")
      .each(function (index, option) {
        $(option).html(
          $(option)
            .html()
            .replace(/ - Product/g, "")
        );
      });
    $(".cate_drop")
      .find("option")
      .each(function (index, option) {
        $(option).html(
          $(option)
            .html()
            .replace(/ - Profile/g, "")
        );
      });
    $(".cate_drop option:selected ").text(newtext + " - Product");
  }
}

function postComments(pid) {
  var comment = $("#commentInput" + pid)
    .val()
    .trim();
  var commentError = $("#commentError" + pid);

  if (comment === "") {
    commentError.html("Please enter a comment before posting.");
    commentError.show();
    return false;
  }

  commentError.hide();

  callAjax(
    "Timeline",
    "insertComment",
    {
      pid: pid,
      comment: comment,
    },
    0,
    commentError,
    function (response) {
      $("#commentInput" + pid).val("");
      $("#commentsCount" + pid).html("(" + response.total + ")");
      $("#commentImg" + pid).attr("src", "/assets/images/comment-fill.svg");
      var MAINURL = window.location.origin;
      $("#load_new_commnet_section_"+pid).html(loadCommentOnly(MAINURL, pid));
      toastr.success('Comment successfully posted');
    }
  );
}

function postModalComments(pid) {
  var comment = $("#model_input_message").val().trim();

  if (comment === "") {
    toastr.warning("Please enter a comment before posting.");
    return false;
  }

  var commentError = $("#commentError" + pid);
  callAjax(
    "Timeline",
    "insertComment",
    {
      pid: pid,
      comment: comment,
    },
    0,
    commentError,
    function (response) {
      $("#commentInput" + pid).val("");
      $("#commentsCount" + pid).html("(" + response.total + ")");
      $("#commentImg" + pid).attr("src", "/assets/images/comment-fill.svg");
      var MAINURL = window.location.origin;
      $("#load_new_commnet_section_"+pid).html(loadCommentOnly(MAINURL, pid));
      $("#load_modal_new_commnet_section_"+pid).html(loadCommentOnly(MAINURL, pid, "no"));
      $("#post_total_count").text(response.total);
      $("#model_input_message").val('')
      toastr.success('Comment successfully posted');
    }
  );
}

function likePost(pid, reactionId) {
  var commentError = $("#commentError" + pid);
  callAjax(
    "Timeline",
    "addLike",
    {
      pid: pid,
      reactionId: reactionId,
    },
    0,
    commentError,
    function (response) {
      $("#likeCount" + pid).html("(" + response.total + ")");
      if (response.action === "deleted") {
        $("#likeImg" + pid).attr("src", "/assets/images/mini-06.svg");
      } else {
        $("#likeImg" + pid).attr("src", "/assets/images/like-fill.svg");
      }
    }
  );
}

function lovePost(pid) {
  var commentError = $("#commentError" + pid);
  callAjax(
    "Timeline",
    "addLove",
    {
      pid: pid,
    },
    0,
    commentError,
    function (response) {
      $("#lovesCount" + pid).html("(" + response.total + ")");
      if (response.action === "deleted") {
        $("#loveImg" + pid).attr("src", "/assets/images/mini-08.svg");
      } else {
        $("#loveImg" + pid).attr("src", "/assets/images/heard-fill.svg");
      }
    }
  );
}

function redirectToPage(href) {
  window.location.href = href;
}

if($("#postMessagae").length){
  var quillEditFull = new Quill("#postMessagae", {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: "snow",
    placeholder: "Type your message..."
  });
}

$(document).on( "click", ".edit-post", function(){
  var id = $(this).data('postid');
  var message = $("#postingNote"+id).html();
  quillEditFull.root.innerHTML = message;
  $("#edit_post_id").val(id);
  $("#editPost").modal('show');
});


$("#updatePost").click(function(){
  var id = $("#edit_post_id").val();
  var content = quillEditFull.root.innerHTML;
  $("#postingNote"+id).html(content);
  submitEdit(id);
})

function submitEdit(id) {
  var MAINURL = window.location.origin;
  var content = quillEditFull.root.innerHTML;
  $.ajax({
    url: MAINURL + "/api.php?class=Timeline&action=editpost",
    type: "POST",
    data: {
      id: id,
      content: content,
    },
    success: function (response) {
      $("#editPost").modal('hide');
      toastr.success('Post updated successfully.');
    },
    error: function (xhr, status, error) {},
  });
}

$(document).on( "click", ".editcomment", function(){
  var message = $(this).data('commenttext');
  var id = $(this).data('commentid');
  var postid = $(this).data('postid');
  var type = "comment";
  var html = '<div class="d-flex flex-row align-items-center p-3 commentsBar">'+
    '<input type="text" id="input_message_edit_'+id+'" value="'+message+'" class="form-control" placeholder="Enter your comment...">'+
    '<div class="d-flex">' +
        '<div data-type="'+type+'" data-postid="'+postid+'" data-id="'+id+'" class="editCommentMessage plan-icon d-flex justify-content-center align-items-center" style="top: 24px;right: 22px;"><img src="https://sharepage_codes.test/assets/images/post-icon.svg" class="img-fluid" alt=""></div><div data-message="'+message+'" data-class="edit_comment_box_" class="remove_editor" data-id="'+id+'" style="position: absolute;cursor: pointer;top: 31px;right: -3px;"><i class="fa fa-trash"></i></div>' +
    '</div>' +
  '</div>';
  $(".edit_comment_box_"+id).html(html);
});

$(document).on( "click", ".editreplycomment", function(){
  var message = $(this).data('commenttext');
  var id = $(this).data('commentid');
  var type = "replycomment";
  var html = '<div class="d-flex flex-row align-items-center p-3 commentsBar">'+
    '<input type="text" id="input_message_reply_edit_'+id+'" value="'+message+'" class="form-control" placeholder="Enter your comment...">'+
    '<div class="d-flex">' +
        '<div data-type="'+type+'" data-id="'+id+'" class="editReplyCommentMessage plan-icon d-flex justify-content-center align-items-center" style="top: 24px;right: 22px;"><img src="https://sharepage_codes.test/assets/images/post-icon.svg" class="img-fluid" alt=""></div><div data-message="'+message+'" data-class="edit_comment_reply_box_" class="remove_editor" data-id="'+id+'" style="position: absolute;cursor: pointer;top: 31px;right: -3px;"><i class="fa fa-trash"></i></div>' +
    '</div>' +
  '</div>';
  $(".edit_comment_reply_box_"+id).html(html);
});

$(document).on( "click", ".editCommentMessage", function(){
  var MAINURL = window.location.origin;
  var id = $(this).data('id');
  var type = $(this).data('type');
  var postid = $(this).data('postid');

  if($('#postComments').is(':visible')){
    var messagae = $('#load_modal_new_commnet_section_'+postid+' #input_message_edit_'+id).val();
  }else{
    var messagae = $('#load_new_commnet_section_'+postid+' #input_message_edit_'+id).val();
  }

  $.ajax({
    url: MAINURL + "/api.php?class=Timeline&action=editComment",
    type: "POST",
    data: {
      id: id,
      content: messagae,
    },
    success: function (response) {
      $('#load_new_commnet_section_'+postid+' .editcomment_'+id).data('commenttext', messagae);
      $('#load_new_commnet_section_'+postid+' .edit_comment_box_'+id).html(messagae);

      $('#load_modal_new_commnet_section_'+postid+' .editcomment_'+id).data('commenttext', messagae);
      $('#load_modal_new_commnet_section_'+postid+' .edit_comment_box_'+id).html(messagae);
      toastr.success('Message edited successfully.');
    },
    error: function (xhr, status, error) {},
  });
});

$(document).on( "click", ".editReplyCommentMessage", function(){
  var MAINURL = window.location.origin;
  var id = $(this).data('id');
  var messagae = $('#input_message_reply_edit_'+id).val();

  $.ajax({
    url: MAINURL + "/api.php?class=Timeline&action=editReplyComment",
    type: "POST",
    data: {
      id: id,
      content: messagae,
    },
    success: function (response) {
      $('.edit_reply_comment_'+id).data('commenttext', messagae);
      $('.edit_comment_reply_box_'+id).html(messagae);
      toastr.success('Message edited successfully.');
    },
    error: function (xhr, status, error) {},
  });
}); 

$(document).on( "click", ".remove_editor", function(){
  var classs = $(this).data('class');
  var id = $(this).data('id');
  var message = $(this).data('message');
  $("."+classs+''+id).html(message);
});

function showModal(id) {
  $("#" + id).modal("show");
}


// editor toolbar options
var toolbarOptions = {
  container: [
    [{
      'header': [1, 2, 3, 4, 5, 6, false]
    }],
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    ['blockquote'],

    [{
      'header': 1
    }, {
      'header': 2
    }], // custom button values
    [{
      'list': 'ordered'
    }, {
      'list': 'bullet'
    }],
    [{
      'indent': '-1'
    }, {
      'indent': '+1'
    }], // outdent/indent
    [{
      'size': ['small', false, 'large', 'huge']
    }], // custom dropdown

    [{
      'color': []
    }, {
      'background': []
    }], // dropdown with defaults from theme
    [{
      'align': []
    }],
    ['link']
  ]
};

// editor toolbar options end


//initializeing editor
if ($("#grptimelinefrmtxt").length) {
  var quillFull = new Quill('#grptimelinefrmtxt', {
    modules: {
      toolbar: toolbarOptions
    },
    theme: 'snow',
    placeholder: "Type your message..."
  });
  var em = new EmojiPicker({
      trigger: [
          {
              selector: '.second-btn',
              insertInto: '#emojiManager'
          }
      ],
      closeButton: true,
      //specialButtons: green
  });


}

//initializeing editor end

//edit group image
$('#editgorupimageButton').on('click', function() {
  $('#editgorupimage').click();
});

$('#editgorupimage').on('change', function() {
  var file = this.files[0]; // Get the selected file
  // Check if file is selected
  if (file) {
      var fileType = file.type; // Get file type
      // Validate the file type
      if (fileType === 'image/jpeg' || fileType === 'image/png') {
        var formData = new FormData();
        formData.append('groupid', $("#image_group_id").val());
        formData.append('editGrouopImage', "yes");
        formData.append('spgroupimage', file); 
        
        $.ajax({
          type: "POST",
          url: '/grouptimelines/common/group_action.php',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            response = JSON.parse(response);
            if(response.status == "success"){ 
              toastr.success(response.message);
              $(".covimg").css('background' , 'url('+response.path+')');
            }else{
              toastr.error(response.message);
            }
          }
        });
      } else {
        toastr.error('Please upload image in jpeg, png format only.');
      }
  }
});
