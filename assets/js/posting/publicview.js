document.addEventListener('DOMContentLoaded', function() {
  var MAINURL = window.location.origin;
  var profileid = $("#user-profileid").text();
  var userid = $("#user-userid").text();
  var profileType = $("#pro-type").text();
  var profileerror = $("#profile_error");
  if(profileType == 'Freelancer' || profileType == "Employment" || profileType == "Personal" || profileType == "Professional"){
    var experror = $("#experience_error");
    callAjax("PublicView", "getUserExperience", {profileid: profileid}, 0, experror, function(success){
      if (success.error == undefined && success != '{}') {
        if(success.experience != undefined && success.experience.length > 0){
          var mainhtml = '<div class="text-wrapper">'+
          '<div class="heading">'+
          'Experience'+
          '</div>'+
          '<div id="exp-list">';
          $.each(success['experience'], function(index, item){
            var html = addExperience(item);
            mainhtml = mainhtml+html;
          });
          mainhtml = mainhtml+'</div>';
          if(success.count > 2){
            mainhtml = mainhtml+'<a class="view-all" id="exp-all">'+
            'View All '+success.count+' experiences'+
            '</a>'+
            '<input type="hidden" id="exp_all" value="'+success.count+'">'+
            '</div>';
          }
          $("#experience").append(mainhtml);
        }
      }
    });
    var eduerror = $("#education_error");
    callAjax("PublicView", "getUserEducation", {profileid: profileid}, 0, eduerror, function(success){
      if (success.error == undefined && success != '{}') {
        if(success != undefined && success.length > 0){
          var mainhtml = '<div class="heading">'+
          'Education'+
          '</div>'+
          '<div class="table-wrapper">'+
          '<table>'+
          '<thead>'+
          '<tr>'+
          '<th>School/College</th>'+
          '<th>Degree</th>'+
          '<th>Field of Study</th>'+
          '<th>Year</th>'+
          '</tr>'+
          '</thead>'+
          '<tbody>';
          $.each(success, function(index, item){
            var html = '<tr>'+
            '<td>'+item.school+'</td>'+
            '<td>'+item.empdegree+'</td>'+
            '<td>'+item.study+'</td>'+
            '<td>'+item.year+'</td>'+
            '</tr>';
            mainhtml = mainhtml+html;
          });
          mainhtml = mainhtml+'</tbody>'+
          '</table>'+
          '</div>';
          $("#education_table").append(mainhtml);
        }
      }
    });
  }
  if(profileType == 'Family'){
    var familyerror = $("#family_error");
    callAjax("PublicView", "getUserFamilyMembers", {profileid: profileid}, 0, familyerror, function(success){
      if (success.error == undefined && success != '{}') {
        if(success != undefined && success.length > 0){
          var mainhtml = '<div class="table-wrapper">'+
          '<table>'+
          '<thead>'+
          '<tr>'+
          '<th style="width: 30%">Family Member Name</th>'+
          '<th>Relation Type</th>'+
          '</tr>'+
          '</thead>'+
          '<tbody>';
          $.each(success, function(index, item){
            var html = '<tr>'+
            '<td style="color:  rgba(118, 73, 179, 1);">'+item.family_name+'</td>'+
            '<td>'+item.family_relation+'</td>'+
            '</tr>';
            mainhtml = mainhtml+html;
          });
          mainhtml = mainhtml+'</tbody>'+
          '</table>'+
          '</div>';
          $("#family-about").append(mainhtml);
        }
      }
    });
  }
  jobPosts(profileid, 0);
  projectPosts(profileid, 0);
  productPosts(profileid, 0);
  realEstatePosts(profileid, 0);
  docPosts(profileid, 0);
  callAjax("Timeline", "getUserPost", { profileid: profileid, access: 1 }, 0, profileerror, function(success){
    if (success.error == undefined && success != '{}') {
      if(success.post != undefined && success.post.length > 0){
        var mainhtml = '';
        if(success['count'] != undefined){
          $('#post_all').val(success['count']);
          if(success['count'] > 10){
            $(".show-all.post").css({
              display: "block"
            });
          }
        }
        $.each(success['post'], function(index, item){
          var html = addDiv(item);
          mainhtml = mainhtml+html;
        });
        $("#postlist").append(mainhtml);
        setupDropdownListeners();
      }
    }
  });
  mediaPosts(profileid, 0);
  var profiletype = $("#user-profiletype").text();
  callAjax("PublicView", "getUserPorfolio", { userid: userid, profiletype: profiletype }, 0, profileerror, function(success){
    if (success.error == undefined && success != '{}') {
      if(success.length > 0){
       var mainhtml = '';
        $.each(success, function(index, item){
          var html = '<div class="portfolio">'+
            '<div class="title">'+
            item.spTitle+
            '</div>';
            if(item.image != undefined){
              html = html+'<div class="img-wrapper">'+
              '<img src="'+MAINURL+'/dashboard/portfolio/image/'+item.image+'" style="max-width: 1230px;height:350px;object-fit:fill;" alt="">'+
              '</div>';
            }
            html = html+'<div class="desc">'+
            'Description'+ 
            '</div>'+
            '<div class="text">'+
            item.desPort+
            '</div>'+
            '<div class="globe" style="margin-top: 20px;">'+
            '<img src="'+MAINURL+'/assets/images/website.svg" alt="">'+
            '<span style="padding-left: 5px; color: #7649B3; font-size: 14px;">'+
            item.spWeblink+
            '</span>'+
            '</div>'+
            '</div>';
            mainhtml = mainhtml+html;
        });
        $("#portfoliolist").append(mainhtml);
      }
    }
  });
})

$(document).on('click', '#exp-all', function() {
  var profileid = $("#user-profileid").text();
  var MAINURL = window.location.origin;
  var allcount = Number($('#exp_all').val());
  var experror = $("#experience_error");
  callAjax("PublicView", "getUserExperience", {profileid: profileid, skip: 2, limit: allcount}, 0, experror, function(success){
    if (success.error == undefined && success != '{}') {
      if(success.experience != undefined && success.experience.length > 0){
        var mainhtml = "";
        $.each(success['experience'], function(index, item){
          var html = addExperience(item);
           mainhtml = mainhtml+html;
        });
        $("#exp-all").css({
          display: "none"
        });
        $("#exp-list").append(mainhtml);
      }
    }
  });
});
  
$('.show-all').click(function() {
  var MAINURL = window.location.origin;
  var profileid = $("#user-profileid").text();
  var section = $(this).find('.section-link').val();
  $('.job.'+section).removeAttr('style');
  var row = Number($('#'+section+'_row').val());
  var allcount = Number($('#'+section+'_all').val());
  var clickedElement = $(this);
  if(section == 'post'){
    row = row + 10;
    if (row <= allcount) {
      $("#"+section+"_row").val(row);
      $.ajax({
        url: MAINURL+'/api.php?class=Timeline&action=getUserPost',
        type: 'post',
        data: {
          skip: row,
          profileid: profileid
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
            var rowno = row + 10;
            if (rowno > allcount) {
              clickedElement.css("display", "none");
            }
            setupDropdownListeners();
          }, 2000);
        }
      });
    } else {
      setTimeout(function() {
        $('.blogs:nth-child(3)').nextAll('.post').remove().fadeIn("slow");
        $("#"+section+"_row").val(0);
      }, 2000);
    }
  } else {
    if(section == 'media' || section == 'doc'){
      row = row + 16;
    } else {
      row = row + 10;
    }
    if (row <= allcount) {
      $("#"+section+"_row").val(row);
      if(section == 'media'){
        mediaPosts(profileid, row);
      }
      if(section == 'jobs'){
        jobPosts(profileid, row);
      }
      if(section == 'project'){
        projectPosts(profileid, row);
      }
      if(section == 'store'){
        productPosts(profileid, row);
      }
      if(section == 'properties'){
        realEstatePosts(profileid, row);
      }
      if(section == 'doc'){
        docPosts(profileid, row);
      }
      if(section == 'media' || section == 'doc'){
       var rowno = row + 16;
      } else {
        var rowno = row + 10;
      }
      if (rowno > allcount) {
        clickedElement.css("display", "none");
      }
    }
  }
});

$(document).ready(function() {
  $('.mag').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true
    },
    image: {
      titleSrc: 'alt'
    },
    removalDelay: 300,
    mainClass: 'mfp-fade',
    fixedContentPos: false
  });
});

function addExperience(item){
  var toDate = "PRESENT";
  var toyear = "";
  if(item.tomonth != undefined && item.tomonth != "" && item.tomonth != null && item.toyear != undefined && item.toyear != "" && item.toyear != null){
    toDate = item.tomonth+" "+item.toyear;
    toyear = item.toyear;
  } else {
    toyear = new Date().getFullYear();
  }
  var fromyear = "";
  if(item.fromyear != undefined && item.fromyear != "" && item.fromyear != null){
    fromyear = item.fromyear;
    if(toyear != ""){
      var expYear = toyear - item.fromyear;
      if(expYear > 0){
        toDate = toDate+" . "+expYear+" Years";
      }
    }
  }
  var frommonth = "";
  if(item.frommonth != undefined && item.frommonth != "" && item.frommonth != null){
    frommonth = item.frommonth;
  }
  var jobtitle = "";
  if(item.jobtitle != undefined){
    jobtitle = item.jobtitle;
  }
  var company = "";
  if(item.company != undefined){
    company = item.company;
  }
  var emptype = "";
  if(item.emptype != undefined){
    emptype = item.emptype;
  }
  var description = "";
  if(item.description != undefined){
    description = item.description;
  }
  var html = '<div class="bold-title" style="margin-bottom: 5px;">'+
  jobtitle+
  '</div>'+
  '<div class="title">'+
  company+' . '+emptype+'</br>'+
  frommonth+' '+fromyear+' - '+toDate+'</br>'+
  '</div>'+
  '<div class="text" style="margin-bottom: 10px;">'+
   description+
   '</div>';
   return html;
}

function productPosts(profileid, skip){
  var producterror = $("#store_error");
  callAjax("PublicView", "getUserProduct", { profileid: profileid, skip: skip }, 0, producterror, function(success){
    if (success.error == undefined && success != '{}') {
      var count = success.product.length;
      if(success.product != undefined && success.product.length > 0){
        var mainhtml = '';
        if(success['count'] != undefined && skip == 0){
          $('#store_all').val(success['count']);
          if(success['count'] > 10){
            $(".show-all.store").css({
              display: "block"
            });
          }
        }
        $.each(success['product'], function(index, item){
          var last = 0;
          if(index == count - 1){
            last = 1;
          }
          var html = addPost(item, 'Buy Now', 'store', last);
            mainhtml = mainhtml+html;
        });
        $("#storelist").append(mainhtml);
      }
    }
  });
}

function projectPosts(profileid, skip){
  var projecterror = $("#project_error");
  var user_ptid = $("#user-ptid").text();
  var button = 'View';
  if(user_ptid == 2){
    button = 'BID';
  }
  callAjax("PublicView", "getUserProject", { profileid: profileid, skip: skip }, 0, projecterror, function(success){
    if (success.error == undefined && success != '{}') {
      var count = success.project.length;
      if(success.project != undefined && count > 0){
        var mainhtml = '';
        if(success['count'] != undefined && skip == 0){
          $('#project_all').val(success['count']);
          if(success['count'] > 10){
            $(".show-all.project").css({
              display: "block"
            });
          }
        }
        $.each(success['project'], function(index, item){
          var last = 0;
          if(index == count - 1){
            last = 1;
          }
          var html = addPost(item, button, 'project', last);
            mainhtml = mainhtml+html;
        });
        $("#projectlist").append(mainhtml);
      }
    }
  });
}
function addPost(item, button, type, last){
  var title = 'Key Skills:';
  var titleValue = item.spPostingSkill;
  var MAINURL = window.location.origin;
  var link = "";
  if(type == 'project'){
    link = MAINURL+'/freelancer/project-detail.php?project='+item.idspPostings;
  }
  if(type == 'store'){
    title = 'Specifications:';
    var titleValue = item.specification;
    link = MAINURL+'/store/detail.php?catid=1&postid='+item.idspPostings;
  }
  if(type == 'properties'){
    title = 'Property Type:';
    var titleValue = item.spPostingPropertyType;
    link = MAINURL+'/real-estate/property-detail.php?postid='+item.idspPostings;
  }
  if(type == 'jobs'){
    link = MAINURL+'/job-board/job-detail.php?postid='+item.idspPostings;
  }
  var style = "";
  if(last == 1){
    style = "style='border: none'";
  }
  var html = '<div class="job '+type+'" '+style+'>'+
  '<div class="job-heading">'+
  item.spPostingTitle+
  '</div>';
  if(type == 'jobs' || type == 'properties'){
    html = html+'<div class="location">'+
    '<img src="'+MAINURL+'/assets/images/location.svg" alt="">';
    if(type == 'jobs' && item.location.length > 0){
      html = html + item.location.join(", ");
    }
    if(type == 'properties'){
      html = html+item.spPostingAddress;
    }
    html = html+'</div>';
  }
  html = html+'<div class="title">'+
  title+ 
  '</div>'+
  '<div class="text">'+
  titleValue+
  '</div>'+
  '<div class="btns">'+
  '<a href="'+link+'"><button class="active">'+button+'</button></a>';
  if(type == 'jobs'){
    if(item.issaved != undefined && item.issaved == 1){
      html = html+'<button onclick="unsave(\''+item.idspPostings+'\')">Unsave</button>';
    } else {
      html = html+'<button onclick="save(\''+item.idspPostings+'\')">Save</button>';
    }
  }
  html = html+'</div>'+
  '<span class="save_error" id="save_error_'+item.idspPostings+'" class="p-1" style="color:red;"></span>'+
  '</div>';
  return html;
}

function realEstatePosts(profileid, skip){
  var MAINURL = window.location.origin;
  var joberror = $("#properties_error");
  callAjax("PublicView", "getUserRealestate", { profileid: profileid, skip: skip }, 0, joberror, function(success){
    if (success.error == undefined && success != '{}') {
      var count = success.property.length;
      if(success.property != undefined && success.property.length > 0){
        var mainhtml = '';
        if(success['count'] != undefined && skip == 0){
          $('#properties_all').val(success['count']);
          if(success['count'] > 10){
            $(".show-all.property").css({
              display: "block"
            });
          }
        }
        $.each(success['property'], function(index, item){
          var last = 0;
          if(index == count - 1){
            last = 1;
          }
          var html = addPost(item, 'Send Enquiry', 'properties', last);
            mainhtml = mainhtml+html;
        });
        $("#propertieslist").append(mainhtml);
      }
    }
  });
}

function jobPosts(profileid, skip){
  var MAINURL = window.location.origin;
  var joberror = $("#job_error");
  callAjax("PublicView", "listPostedJobs", { profileid: profileid, skip: skip }, 0, joberror, function(success){
    if (success.error == undefined && success != '{}') {
      var count = success.job.length;
      if(success.job != undefined && count > 0){
        var mainhtml = '';
        if(success['count'] != undefined && skip == 0){
          $('#jobs_all').val(success['count']);
          if(success['count'] > 10){
            $(".show-all.jobs").css({
              display: "block"
            });
          }
        }
        $.each(success['job'], function(index, item){
          var last = 0;
          if(index == count - 1){
            last = 1;
          }
          var html = addPost(item, 'Apply', 'jobs', last);
            mainhtml = mainhtml+html;
        });
        $("#joblist").append(mainhtml);
      }
    }
  });
}

function mediaPosts(profileid, skip){
  var mediaerror = $("#media_error");
  callAjax("PublicView", "getUserMedia", { profileid: profileid, skip: skip }, 0, mediaerror, function(success){
    if (success.error == undefined && success != '{}') {
      if(success.media != undefined && success.media.length > 0){
        var mainhtml = '';
        if(success['count'] != undefined && skip == 0){
          $('#media_all').val(success['count']);
          if(success['count'] > 16){
            $(".show-all.media").css({
              display: "block"
            });
          }
        }
        $.each(success['media'], function(index, item){
          var html = '<div class="img-wrapper col-md-3 col-sm-6 mb-3">'+
          '<a class="thumbnail mag" data-effect="mfp-newspaper"  href="'+item.spPostingPic+'"><img src="'+item.spPostingPic+'" alt="" class="img-fluid"></a>'+
          '</div>';
          mainhtml = mainhtml+html;
        });
        $("#medialist").append(mainhtml);
      }
    }
  });
}

function docPosts(profileid, skip){
  var MAINURL = window.location.origin;
  var mediaerror = $("#doc_error");
  callAjax("PublicView", "getUserDocs", { profileid: profileid, skip: skip }, 0, mediaerror, function(success){
    if (success.error == undefined && success != '{}') {
      if(success.doc != undefined && success.doc.length > 0){
        var mainhtml = '';
        if(success['count'] != undefined && skip == 0){
          $('#doc_all').val(success['count']);
          if(success['count'] > 16){
            $(".show-all.doc").css({
              display: "block"
            });
          }
        }
        $.each(success['doc'], function(index, item){
          var originalname = item.original_name;
          if(originalname.length > 15){
            originalname = originalname.substring(0, 15) + '...';
          }
          var html = '<div class="img-wrapper col-md-3 col-sm-6 mb-3">'+
          '<a class="thumbnail mag" data-effect="mfp-newspaper"  href="'+item.sppostingmediaTitle+'">'+
          '<img src="'+MAINURL+'/assets/images/pdf.png" alt="doc" style="width:auto;padding-bottom:10px;"></a>'+
          '<h5>'+originalname+'</h5>'+
          '</div>';
          mainhtml = mainhtml+html;
        });
        $("#doclist").append(mainhtml);
      }
    }
  });
}

function block(status, userby, userto){
  if(status != undefined || userby != undefined || userto != undefined){
    var action = "blockUser";
    var msg = "block";
    if(status == 1){
      action = "unBlockUser";
      msg = "un block";
    }
    Swal.fire({
      title: 'Are you sure you want to '+msg+' this profile ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes',
      cancelButtonColor: '#FF0000',
      cancelButtonText: 'No',
    }).then((result) => {
      if (result.isConfirmed) {
        var blockerror = $("#block_error");
        callAjax("PublicView", action, { userby: userby, userto: userto }, 0, blockerror, function(success){
          window.location.reload();
        });
      }
    });
  }
}

function follow(follower, following){
  if(follower != undefined && following != undefined){
    callAjax("PublicView", "follow", {"follower": follower, "following": following}, 0, $("#month-error"), function(success){
      window.location.reload();
    })
  }
}

function unfollow(follower, following, type){
  if(follower != undefined && following != undefined){
    var msg = 'unfollow';
    if(type == 1){
      msg = 'remove';
    }
    Swal.fire({
      title: 'Are you sure you want to '+msg+' this profile ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes',
      cancelButtonColor: '#FF0000',
      cancelButtonText: 'No',
    }).then((result) => {
      if (result.isConfirmed) {
        var blockerror = $("#follow_error");
        callAjax("PublicView", "unfollow", {"follower": follower, "following": following}, 0, $("#month-error"), function(success){
          window.location.reload();
        })
      }
    });
  }
}

function follow(follower, following){
  if(follower != undefined && following != undefined){
    callAjax("PublicView", "follow", {"follower": follower, "following": following}, 0, $("#follow_error"), function(success){
      window.location.reload();
    })
  }
}

function request(status, sender, receiver){
  if(status != undefined || sender != undefined || receiver != undefined){
    var blockerror = $("#block_error");
    var action = "addFriend";
    if(status == 1){
      action = "unfriend";
    }
    callAjax("PublicView", action, { sender: sender, receiver: receiver }, 0, blockerror, function(success){
      window.location.reload();
    });
  }
}

function save(postid){
          if(postid != undefined){
            $(".save_error").html("");
            var saveerror = $("#save_error_"+postid);
            callAjax("PublicView", "saveJob", { postid: postid }, 0, saveerror, function(success){
              //console.log(success);
               window.location.reload();
            });
          } else {
             $("#save_error_"+postid).html("invalid post");
          }
        }
        
        function unsave(postid){
          if(postid != undefined){
            $(".save_error").html("");
            var saveerror = $("#save_error_"+postid);
            callAjax("PublicView", "unsaveJob", { postid: postid }, 0, saveerror, function(success){
              window.location.reload();
            });
          } else {
             $("#save_error_"+postid).html("invalid post");
          }
        }
        
        function showContent(event, contentId, mainclass) {
          // Hide all content elements
          var contents = document.querySelectorAll(mainclass);
          for (var i = 0; i < contents.length; i++) {
            contents[i].classList.add('hidden');
          }

          // Show the selected content
          var selectedContent = document.getElementById(contentId);
          if (selectedContent) {
            selectedContent.classList.remove('hidden');
          }
          var linkclass = '.actiivities-wrapper';
          var link = '.act';
          var active = 'active';
          if(mainclass == '.content-section'){
            linkclass = '.group-navigation';
            link = '.link';
            active = 'active-link';
          }
          var links = document.querySelectorAll(linkclass+' '+link);
          for (var j = 0; j < links.length; j++) {
              links[j].classList.remove(active);
          }
          event.currentTarget.classList.add(active);
          
        }
        const threeDotWrapper = document.getElementById('three-dot-wrapper')
        function clickThreeDot() {
            if(threeDotWrapper.style.display == 'none') {
                threeDotWrapper.style.display = 'flex'
            } else {
                threeDotWrapper.style.display = 'none'
            }
        }
