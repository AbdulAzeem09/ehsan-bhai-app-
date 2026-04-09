

//add friend on group by timeline
/*$(".join-group-modal").on("click", "#addmemontimeline", function () {
 alert("+++++");   
$("#addmemontimeline").each(function (i, e) {
//add date with new member
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
dd = '0' + dd
}
if (mm < 10) {
mm = '0' + mm
}

today = yyyy + '-' + mm + '-' + dd;
var pid = $("#addmemontimeline").attr('data-pid');
var gid = $("#addmemontimeline").attr('data-gid');
//alert(gid);
$.post("../my-groups/addmember.php", {
spProfiles_idspProfiles: pid,
spGroup_idspGroup: gid,
spProfileIsAdmin: 0,
spApproveRegect: 0,
spGroup_newMember_Date: today
}, function (r) {
location.reload();
//$(e).closest(".hidefriend").html("");
});
});
});*/

//add friend on group by timeline end

// if member exist

var grpown = $("#grpown").val();
var ownprof = "/friends/?profileid="+grpown;
var membertype='nomember';

check_status(); // second check member type

function check_status(){
  if(profid == grpown ){
    $(".explore-bar-access").hide();    
    $("#explore-bar-access-more-link").hide();
    return false;
  }

  $.post("/public-group/check_status.php", {
    gid: groupid, pid: profid
  }, function (r) {
    let res = JSON.parse(r);
    membertype = res.status;
    switch(res.status) {
      case "nomember":
        $(".cancel-btn, .exit-btn").hide();
        $(".join-btn").show();
        break;
      case "admin":
        $(".explore-bar-access").hide();
        $(".exit-btn").show();
        $(".join-btn").hide();
        break;
      case "asst_admin":
        $(".explore-bar-access").hide();
        $(".exit-btn").show();
        $(".join-btn").hide();
        break;
      case "member":
        $(".explore-bar-access").hide();
        $(".cancel-btn").hide();
        $(".join-btn").hide();
        $(".exit-btn").show();
        break;
      case "pending":
        $(".cancel-btn").show();
        $(".join-btn").hide();
        $(".exit-btn").hide();
        break;
      case "blocked":
        blocked_msg();
        break;
      case "rejected":
        rejected_msg();
        break;
      default:
        // code block
    }
  });
}

// rejected msg
function rejected_msg(){
  $.alert({
    title: 'Attention!',
    content: `<p> Your request was rejected<br>
              Please Contact admin <br>
              <a href='`+ownprof+`'>Contact Now!</a></p>`,
    // autoClose: 'Close|10000',
    buttons: {          
      Close: function () {
          window.location.replace("/my-groups");
      }
    }    
  });
}
//---------------


// blocked msg
function blocked_msg(){
  $.alert({
  title: 'Attention',
  content: `<p> You membership is blocked<br>
            Please Contact admin <br>
            <a href='`+ownprof+`'>Contact Now!</a></p>`,
  // autoClose: 'Close|10000',
  buttons: {          
      Close: function () {
          window.location.replace("/my-groups");
      }
    }       
  });
}
//---------------


//send Request
$(".joingroup").on("click", function () {
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("/public-group/sendrequest.php", {
    gid: $(this).data("gid"),
    pid: $(this).data("pid")
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    $.alert({
        title: 'Message!',
        content: res.message,
    });
    $(".btn-cancel").click();
    $(".join-btn").hide();
    $(".cancel-btn").show();
  });
});

$(document).on("change","#group_join_chk", function(){
  if(this.checked){
    $(".group_join_chk").removeClass( "disabled" )
  }
  else { 
    $(".group_join_chk").addClass( "disabled" )
  }

})

//--- morelink
function threeDot(item) {
  const dotContent = $(item).parent().find(".more-links"); 
  dotContent.toggle();
}
//--- morelink

//-- accept users request
$(document).on('click', '.acpt_rqst', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof'); 
  $.post("common/group_action.php", {
    profid: item_id,
    grpid: groupid,
    accpt_rqst: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'accpet_request'){
      $("#acp_"+item_id).closest('.friend').hide();
        $.alert({
            title: 'Message!',
            content: res.message,
        });
    }
    else {
      $.alert({
        title: 'Error!',
        content: "There is some error",
      });
    }

  });
});
//-- accept users requestt

//-- reject user request
$(document).on('click', '.rejct_rqst', function(){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
    profid: item_id,
    grpid: groupid,
    rjct_rqst: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'reject_request'){
      $("#rjt_"+item_id).closest('.friend').hide();
        $.alert({
            title: 'Message!',
            content: res.message,
        });
    }
    else {
      $.alert({
        title: 'Error!',
        content: "There is some error", //res.message
      });
    }

  });

});
//-- reject user request

//-- view user profile
$(document).on('click', '.view_prof', function(){
  window.location.href="/friends/?profileid="+$(this).attr('data-prof');
});
//-- view user profile


//-- add user to connect
function add_to_connect(sender, receiver, status=0){
  if(status != undefined || sender != undefined || receiver != undefined){
    var blockerror = $("#block_error");
    var action = "addFriend";
    if(status == 1){
      action = "unfriend";
    }
    // cname, action, data, formdata, errorObj, successObj
    callAjax("PublicView", action, { sender: sender, receiver: receiver }, 0, blockerror, 
      function(success){
        console.log(success);
        $.alert({ title: "Add to connect",  content: "Connection request sent"  }); 
        // window.location.reload();
      });
    }
}

function check_connect(sender, receiver){   
  if( sender != undefined || receiver != undefined){
   $.post("common/group_action.php", {
        sender: sender,  receiver: receiver, check_connect: true,
      }, function (r) {
        
        let res = JSON.parse(r);
        if(res.status == 'connected'){                
          $.alert({ title: res.status,  content: "Already in connect"  });          
        }
        if(res.status == 'connect_error') {             
          add_to_connect(sender, receiver, status=0)
        }  
      });

   //resp = 0;
  }
}


$(document).on('click', '.add_conct', function(e){
  var receiver = $(this).attr('data-prof');
  var sender = profid;
  check_connect(sender, receiver);
});
//-- add user to connect end


//-- add user as asst admin
$(document).on('click', '.add_asstadm', function(e){
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
          profid: item_id,    grpid: groupid,  add_asstadm: true,
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status == 'add_asstadm'){
      $("#astadm_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- add user as asst admin end


//-- remove user as asst admin
$(document).on('click', '.rmv_asstadm', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
          profid: item_id,    grpid: groupid,  rmv_asstadm: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'rmv_asstadm'){
      $("#astadm_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- remove user as asst admin end

//-- add user as admin
$(document).on('click', '.add_adm', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
    profid: item_id,    grpid: groupid,  add_adm: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'add_adm'){
      $("#adm_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- add user as admin end

//-- remove user as admin
$(document).on('click', '.rmv_adm', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
          profid: item_id,    grpid: groupid,  rmv_adm: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'rmv_adm'){
      $("#adm_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- remove user as admin end


//-- block the user
$(document).on('click', '.blk_prof', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
          profid: item_id,    grpid: groupid,  blk_prof: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'blk_prof'){
      $("#blk_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- block the user end


//-- unblock the user
$(document).on('click', '.unblk_prof', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
          profid: item_id,    grpid: groupid,  unblk_prof: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'unblk_prof'){
      $("#blk_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- unblock the user end



//-- approve the user
$(document).on('click', '.apv_prof', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
          profid: item_id,    grpid: groupid,  apv_prof: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'apv_prof'){
      $("#blk_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { $.alert({ title: 'Error!',  content: "There is some error"  }); }
  });
});
//-- approve the user end

//-- remove the user
$(document).on('click', '.rmv_prof', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  var item_id = $(this).attr('data-prof');
  $.post("common/group_action.php", {
    profid: item_id,    
    grpid: groupid, 
    type: "owner", 
    rmv_prof: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'rmv_prof'){
      $("#rmv_"+item_id).closest(".three-dot").closest(".friend").hide();
        $.alert({ title: 'Message!', content: res.message,   });
    }
    else { 
      $.alert({ title: 'Error!',  content: res.message  }); 
    }
  });
});
//-- remove the user end


//invitee list 
let invitees=[];
//invitee list end

// invitation cancel model
$(document).on('click', '.cncl_invite', function(e){
  invitees=[];
  $(".srchKey").val("");
  $("#invite_list").html("");  
  $(".selected").html("");  
  $("#ttl_invtee").html(invitees.length);
  $(".user_invite").addClass("disabled");
})
// invitation cancel model end

// invite user
$(document).on('click', '.user_invite', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    groupid: groupid, 
    sender: profid, 
    invitees: invitees.toString(), 
    invite_user: true 
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);  
    if(res.status == 'invite_user'){
      $.alert({ title: "User invited",  content: "Invitation sent successfully, pending for approval."  });
      mark_invitees(res.data);
    }
    else { 
      $.alert({ title: 'Error!',  content: res.message  }); 
    }
  });
})
// invite user end

//mark invitees
function mark_invitees(res_list){
  $( invitees ).each(function( key, val ) {
    if(res_list.includes(val)){
      $("#"+val+"_inv_sts").html("invited");
      $("#"+val+"_inv_sts").css("background","#5caf15");
    }
    else {  
      $("#"+val+"_inv_sts").html("pending");
      $("#"+val+"_inv_sts").css("background","#cf5d08");
    }
  })
}
//mark invitees end

// reset invitee list
$(document).on('click', '.cncl_all', function(e){
  invitees=[]; 
  $(".selected").html("");  $("#ttl_invtee").html(invitees.length);
  $(".user_invite").addClass("disabled");

})
// reset invitee list end


//remove each invitees
$(document).on('click', '.inv_cls', function(e){  
  let udiv = $(this).closest(".user");
  invitees = jQuery.grep(invitees, function(value) {
    return value != udiv.find(".inv_check").val();
  });

 $("#ttl_invtee").html(invitees.length);
  if(invitees.length==0){$(".user_invite").addClass("disabled");}
  $(udiv).animate({left:200, height:0 , mozTransition:'500ms ease-out',
    webkitTransition:' 1000ms ease-out'},
    function(){
      $(".list").prepend(udiv);         
      $(udiv).animate({left:0, height:70,  mozTransition:' 500ms ease-out',
      webkitTransition:' 500ms ease-out'});
      udiv.find(".inv_check").trigger("click")  
    }
  );   
})
//remove each invitees end

// sorlist invitees
$(document).on('click', '.checkmark', function(e){
  let chkbx = $(this).prev(".inv_check");
  let udiv = $(this).closest(".user");  
  invitees.push(udiv.find(".inv_check").val());
  $("#ttl_invtee").html(invitees.length);
  if(invitees.length > 0){
    $(".user_invite").removeClass("disabled");
  }

  $(udiv).animate({left:400, height:20, mozTransition:'1000ms ease-out',
    webkitTransition:' 1000ms ease-out'},
    function(){
      $(".selected").prepend(udiv);         
      $(udiv).animate({height:70, left:0, mozTransition:' 1000ms ease-out',
      webkitTransition:' 1000ms ease-out'});  
    }
  );
  udiv.css("animation","to_color 1s");  
})
// sorlist invitees end

// invitation search
$(".srchKey").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
      $('.invite_srch').trigger("click")
    }
});

$(document).on('click', '.invite_srch', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  let keytxt = $(".srchKey").val();
  $.post("common/group_action.php", {
    srch: keytxt, 
    group:groupid, 
    invite_srch: true,
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == 'invite_srch'){
      $("#invite_list").html(generate_user_invite(res.data));
    }
    else { 
      $.alert({ 
        title: 'Result',  
        content: res.message
      }); 
    }
  });
})
// invitation search end


//user invite search result
function generate_user_invite(user_data){
  let div = '';
  $( user_data ).each(function( key, val ) {
    let invite_sts = member_cls = '';
    if(val.invitation_status == 1 && val.group_id == groupid){
      invite_sts = "<span class='accepted'>member</span>";   
      member_cls = "d-none";     
    }
    if(val.invitation_status == 0 && val.group_id == groupid){
      invite_sts = "<span class='accepted'>pending</span>";   
      member_cls = "d-none";     
    }
    
    val.pfpc = (val.pfpc == null) ? "../assets/images/icon/blank-img.png" : val.pfpc;
    div+= `<div class="user">
        <div class="check-box `+member_cls+`">
            <label class="main-container">
                <input class="inv_check" type="checkbox" value="`+val.pid+`">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="pfpc" style="width:42px;"> 
          <a href="/friends/?profileid=`+val.pid+`"><img onerror="this.src='../assets/images/icon/blank-img.png'" src="`+val.pfpc+`" alt=""></a>
        </div>                                 
        <div class="detail" style="width:70%; height:auto;">
            <div class="name" style="font-size:14px;max-height:70px;">
              <a style="text-decoration:none;" href="/friends/?profileid=`+val.pid+`">` + val.pname + ` (` + val.ptype + `)</a> <br>`+invite_sts+`
            </div>                                    
        </div>
        <span class="inv_cls">
          <img src="./images/cross-2.svg" alt="" role="button">
          <i id="`+val.pid+`_inv_sts" class="inv_sts"></i>
        </span>
      </div>`;
  });

  return div;
}

//user invite search result

// cancel self initiated request

$(document).on('click', '.cncl_self_rqst', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    profid: $(this).data("pid"),
    type: "self",
    rmv_prof: true
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == "rmv_prof"){
      $(".cancel-button").click();
      $(".join-btn").hide();
      $(".cancel-btn").show();
      $.alert({
        title: 'Cancelled!',
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
          title: 'Error!',
          content: res.message,
      });
    }   
  });

})


// cancel self initiated request end

// user self exit the group

$(document).on('click', '.self_exit_grp', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    profid: $(this).data("pid"),
    type: "self",
    rmv_prof: true
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == "rmv_prof"){
      $(".cancel-exit-button").click();
      $.alert({
        title: 'Miss you!',
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
          title: 'Error!',
          content: res.message,
      });
    }   
  });

})


// user self exit the group end


// user accept the group invitation
$(document).on('click', '.accept-invitation-btn', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    id: $(this).data("id"),
    action_grp_invitation: true,
    action : 'accept'
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == "action_grp_invitation"){
      $.alert({
        title: 'Welcome to Group!',
        content: 'Thank for accept the invitation.',
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
          title: 'Error!',
          content: "Your request failed, Please contact admin",
      });
    }   
  });

})
// user accept invitation the group end

// user reject the group invitation
$(document).on('click', '.reject-invitation-btn', function(e){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    id: $(this).data("id"),
    action_grp_invitation: true,
    action : 'reject'
  }, function (r) {
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    let res = JSON.parse(r);
    if(res.status == "action_grp_invitation"){
      $.alert({
        title: 'Miss you!',
        content: 'We are sorry to see you go.',
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
          title: 'Error!',
          content: "Your request failed, Please contact admin",
      });
    }   
  });

})
// user reject invitation the group end


// grp abt update

$(document).on('click', '#grp_abt_upd', function(e){
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    grpnm: $("#grp_name").val(),
    grpabt: $("#grp_dsc").val(),
    abt_upd: true
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status=="abt_upd"){
      $.alert({
        title: 'Data updated',
        content: 'Group details has been successfully updated',  
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: "Data could not be updated, Please contact admin",
      });
    }
  });
})

// grp abt update

// grp rule update

$(document).on('click', '#grp_rul_upd', function(e){
  if($("#grp_rule_title").val() == ""){
    toastr.error('Please enter title');
    return false;
  }

  if($("#grp_rule").val() == ""){
    toastr.error('Please enter the rules.');
    return false;
  }

  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),  
    grprule: $("#grp_rule").val(),
    grpruletitle: $("#grp_rule_title").val(),
    rule_upd: true
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status=="rule_upd"){
      $.alert({
        title: 'Success!',
        content: 'Group rules has been successfully updated', 
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: "Failed to udpate group rules. Please try again.",           
      });
    }   
  });

})

// grp rule update


// grp privacy update
 var grptype= 0;

$(document).on('click', '#grp_public', function(e){
   grptype = 0;
})

$(document).on('click', '#grp_private', function(e){
   grptype = 1;
})

$(document).on('click', '#grp_pvc_upd', function(e){
  var btn = this;
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    grp_privacy: true,
    grp_type: grptype
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status=="grp_privacy"){
      $.alert({
        title: 'Data updated',
        content: 'Group privacy has been successfully updated',
      });
    }
    else {
      $.alert({
          title: 'Error!',
          content: "Data could not be updated, Please contact admin",
           
      });
    }
   
  });

})

// grp location update

$(document).on('click', '#grp_location_upd', function(e){
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    grcountry: $("#spUserCountry").val(),
    grstate: $("#spUserState").val(),
    grcity: $("#spUserCity").val(),
    grp_location_upd: true
  }, function (r) {
    let res = JSON.parse(r);
    if(res.status == "grp_location_upd"){
      $.alert({
        title: 'Success!',
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: "Data could not be updated, Please contact admin",
      });
    }
  });

})


//group create album
$(document).on('click', '#create_group_album', function(e){  
  var album_title = $("#album_title").val();
  var album_description = $("#album_description").val();
  var folder_id = $("#folder_id").val();
  if(album_title == ''){
    toastr.error('Please enter title');
    return false;
  }

  if(album_title.length > 100){
    toastr.error('Title length should be 100 characters.');
    return false;
  }

  if(album_description == ''){
    toastr.error('Please enter description');
    return false;
  }

  if(album_description.length > 100){
    toastr.error('Description length should be 100 characters.');
    return false;
  }

  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    create_group_album: true,
    album_title: album_title,
    folder_id: folder_id,
    album_description: album_description,
    type: $(this).data("type")
  }, function (r) {
    let res = JSON.parse(r);
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    if(res.status=="create_group_album"){
      $.alert({
        title: res.title,
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: "Something went wrong. please try again!",
      });
    }
   
  });

})
//group end create album

//delete album item
function deleteAlbumItem(id, type = "item"){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    aid: id,
    delete_album_item: true,
    type: type
  }, function (r) {
    let res = JSON.parse(r);
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    if(res.status == "delete_album_item"){
      $.alert({
        title: 'Delete',
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: res.message,
      });
    }
   
  });
}
//end delet item

//group create announcement
$(document).on('click', '#create_announcement', function(e){  
  var announcement_title = $("#announcement_title").val();
  var announcement_message = $("#announcement_message").val();
  var announcement_date = $("#announcement_date").val();
  var announcement_time = $("#announcement_time").val();
  var announcement_id = $("#announcement_id").val();

  if(announcement_title == ''){
    toastr.error('Please enter title');
    return false;
  }

  if(announcement_title.length > 100){
    toastr.error('Title length should be 100 characters.');
    return false;
  }

  if(announcement_message == ''){
    toastr.error('Please enter message');
    return false;
  }

  if(announcement_message.length > 500){
    toastr.error('Message length should be 500 characters.');
    return false;
  }

  if(announcement_date == ''){
    toastr.error('Please select date');
    return false;
  }

  if(announcement_time == ''){
    toastr.error('Please select time');
    return false;
  }

  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    grpid: $(this).data("gid"),
    create_announcement: true,
    announcement_title: announcement_title,
    announcement_message: announcement_message,
    announcement_date: announcement_date + " "+ announcement_time,
    announcement_id: announcement_id
  }, function (r) {
    let res = JSON.parse(r);
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    if(res.status == "create_announcement"){
      $.alert({
        title: res.title,
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: res.message,
      });
    }
   
  });

})
// announcement create end

//delete announcement item
function deleteAnnouncement(id){
  $("div.global_spanner").addClass("show");
  $("div.global_overlay").addClass("show");
  $.post("common/group_action.php", {
    aid: id,
    delete_announcement: true,
  }, function (r) {
    let res = JSON.parse(r);
    $("div.global_spanner").removeClass("show");
    $("div.global_overlay").removeClass("show");
    if(res.status == "delete_announcement"){
      $.alert({
        title: 'Delete',
        content: res.message,
        buttons: {          
          OK: function () {
            window.location.reload();
          }
        } 
      });
    }
    else {
      $.alert({
        title: 'Error!',
        content: res.message,
      });
    }
   
  });
}
//end announcement item
