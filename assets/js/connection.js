document.addEventListener("DOMContentLoaded", (event) => {
  //emojiFn();
});

function emojiFn() {
  var em = new EmojiPicker({
    trigger: [
      {
        selector: ".second-btn",
        insertInto: ".emojiManager",
      },
    ],
    closeButton: true,
  });
  var targetInputId;
  $(document).on("click", ".second-btn", function (event) {
    targetInputId = $(this).data("target");
  });
  $(document).on("click", ".fg-emoji-list a", function (event) {
    event.preventDefault();
    var emoji = $(this).text();
    var inputField = $("#" + targetInputId);
    if (inputField.length) {
      var currentVal = inputField.val();
      inputField.val(currentVal + emoji);
    }
  });
}

$(document).on("click", ".message", function () {
  var pid = $(this).data("pid");
  $("#receiver").val(pid);
  $("#message").val("");
  $("#messageerror").text("");
  $("#messagebox").modal("show");
});

$(document).on("click", ".groupinvite", function () {
  var pid = $(this).data("pid");
  $("#newMember").val(pid);
  $("#group-error").text("");
  $("#addToGroup").modal("show");
  callAjax(
    "Connection",
    "getGroupsList",
    {},
    0,
    $("#group-error"),
    function (success) {
      if (success != undefined && success.length > 0) {
        populateGroupDropdown(success);
      }
    }
  );
});

function populateGroupDropdown(groups) {
  var dropdown = $("#grouplist");
  dropdown.empty();
  dropdown.append(
    $("<option>", {
      value: 0,
      text: "Choose Group",
      selected: "selected",
    })
  );
  $.each(groups, function (index, group) {
    var option = $("<option>", {
      value: group.idspGroup,
      text: group.spGroupName,
    });
    dropdown.append(option);
  });
}

$(document).on("click", "#message", function () {
  $("#messageerror").text("");
});

$(document).on("click", "#addGroup", function () {
  //var addByWhom = $('#addByWhom').val();
  var newMember = $("#newMember").val();
  if (newMember) {
    var groupid = $("#grouplist").val();
    if (groupid && groupid != 0) {
      callAjax(
        "Connection",
        "addToGroup",
        { newMember: newMember, groupid: groupid },
        0,
        $("#group-error"),
        function (success) {
          $("#addToGroup").modal("hide");
          Swal.fire({
            title: "Invitation Sent Successfully",
            text: "Your group invitation has been sent.",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
          });
        }
      );
    } else {
      $("#group-error").text("Select a group");
    }
  } else {
    $("#group-error").text("Invalid Users");
  }
});

$(document).on("click", "#send", function () {
  var sender = $("#sender").val();
  var receiver = $("#receiver").val();
  if (sender && receiver) {
    var message = $("#message").val().trim();
    if (message) {
      callAjax(
        "Connection",
        "sendMessage",
        { sender: sender, receiver: receiver, message: message },
        0,
        $("#messageerror"),
        function (success) {
          $("#messagebox").modal("hide");
          Swal.fire({
            title: "Message Sent Successfully",
            text: "Your message has been sent.",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
          });
        }
      );
    } else {
      $("#messageerror").text("Message field cannot be empty");
    }
  } else {
    $("#messageerror").text("Invalid Users");
  }
});

function autofill() {
  const tags = document.querySelectorAll(".tag");
  tags.forEach((tag) => {
    tag.addEventListener("click", () => {
      const spanText = tag.querySelector("span").innerText;
      const dataId = tag.getAttribute("data-id");
      const inputText = document.getElementById(`inputtext_${dataId}`);
      if (inputText) {
        inputText.value = spanText;
      }
    });
  });
}

function showContent(event, sec, search_val = "") {
  var link = ".link";
  var active = "active-link";
  var links = document.querySelectorAll(link);
  for (var j = 0; j < links.length; j++) {
    links[j].classList.remove(active);
  }
  event.currentTarget.classList.add(active);
  getSection(sec, search_val);
}

function getPending(order, search_term = "") {
  if (order == undefined || order == "") {
    order = "recentlyAdded";
  }
  var proId = $("#profile-id").val();
  var MAINURL = window.location.origin;
  callAjax(
    "Connection",
    "getPendingRequest",
    { order: order, search_term: search_term },
    0,
    $("#content-error"),
    function (success) {
      var count = 0;
      if (success.count != undefined) {
        count = success.count;
      }
      if ((search_term = "")) {
        var html =
          '<div class="title-heading">' +
          "<span>Pending Connections (" +
          count +
          ")</span>";
        if (count > 10 && success.pending != undefined) {
          html =
            html +
            '<span id="viewAllSpan" class="view" onclick="morePending(' +
            success.pending.length +
            ", " +
            count +
            ", '" +
            order +
            "')\">View All</span>";
        }
        var value1 = 'value="recentlyAdded"';
        if (order == "recentlyAdded") {
          value1 = 'value="recentlyAdded" selected';
        }
        var value2 = 'value="oldestAdded"';
        if (order == "oldestAdded") {
          value2 = 'value="oldestAdded" selected';
        }
        var value3 = 'value="name"';
        if (order == "name") {
          value3 = 'value="name" selected';
        }
        html =
          html +
          "</div>" +
          '<div class="filter">' +
          '<div class="search-box">' +
          '<div class="search-wrapper">' +
          '<div class="icon">' +
          '<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">' +
          '<path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216" />' +
          "</svg>" +
          "</div>" +
          '<input type="text" id="search-input" placeholder="Search Profile Name, Store name, Profile Type">' +
          "</div>" +
          "<button>SEARCH</button>" +
          "</div>" +
          '<div class="sort-by">' +
          "<span>Sort By:</span>" +
          '<select id="sort-by" data-sec="pending" class="form-select" aria-label="Default select example">' +
          "<option " +
          value1 +
          ">Recently Added</option>" +
          "<option " +
          value2 +
          ">Oldest Added</option>" +
          "<option " +
          value3 +
          ">Name</option>" +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="friend-list-wrapper">';
      } else {
        html = '<div class="friend-list-wrapper">';
      }

      if (success.pending != undefined && count > 0) {
        $.each(success.pending, function (index, item) {
          var div = pendingDiv(item);
          html = html + div;
        });
      }
      html = html + "</div";
      $("#main-content").empty();
      $("#main-content").append(html);
    }
  );
}

function pendingDiv(item) {
  var proId = $("#profile-id").val();
  var MAINURL = window.location.origin;
  var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
  if (item.spProfilePic != undefined && item.spProfilePic != "") {
    profilepic = item.spProfilePic;
  }
  var html =
    '<div class="friend">' +
    '<div class="img-wrapper">' +
    '<img src="' +
    profilepic +
    '" alt="">' +
    "</div>" +
    '<div class="detail">' +
    '<a class="proname" href="' +
    MAINURL +
    "/friends/?profileid=" +
    item.idspProfiles +
    '"><div class="name">' +
    item.spProfileName +
    " <span style='font-weight:200'> (" +
    item.spProfileTypeName +
    ")</span>" +
    "</div></a>" +
    '<div class="type hidden">' +
    item.spProfileTypeName +
    "</div>" +
    /*'<div class="tag-line">Lead Product Designer - Specialized in UI Design & UX Design</div>'+*/
    '<div class="mutual">Mutual Friends (' +
    item.mutual +
    ")</div>" +
    "</div>" +
    '<div class="icons">' +
    '<div class="icon-rej" onclick="accept(' +
    item.idspProfiles +
    ", " +
    proId +
    ')">' +
    '<img src="' +
    MAINURL +
    '/assets/images/accpet.svg" alt="" class="option-icon">' +
    "<div>Accept</div>" +
    "</div>" +
    '<div class="icon-rej" onclick="reject(' +
    item.idspProfiles +
    ", " +
    proId +
    ')">' +
    '<img src="' +
    MAINURL +
    '/assets/images/reject.svg" alt="" class="option-icon">' +
    "<div>Reject</div>" +
    "</div>" +
    "</div>" +
    "</div>";
  return html;
}
function ordinal_suffix_of(i) {
  let j = i % 10,
    k = i % 100;
  if (j === 1 && k !== 11) {
    return i + "st";
  }
  if (j === 2 && k !== 12) {
    return i + "nd";
  }
  if (j === 3 && k !== 13) {
    return i + "rd";
  }
  return i + "th";
}
function getConnectionLevel(search_term = "") {
  var proId = $("#profile-id").val();
  var MAINURL = window.location.origin;
  var html = "";
  callAjax(
    "Connection",
    "getConnectionLevel",
    { search_term: search_term },
    0,
    $("#content-error"),
    function (success) {
      if (success != undefined && success.length > 0) {
        $.each(success, function (index, item) {
          html +=
            '<div class="title-heading">' +
            "<span>" +
            ordinal_suffix_of(index + 1) +
            " Level Connection</span>" +
            /*'<span class="view">View All</span>'+*/
            "</div>" +
            '<div class="friend-list-wrapper" style="margin-top: 20px;">';
          $.each(item, function (index2, item2) {
            if (item2.details != undefined) {
              var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
              if (
                item2.details.spProfilePic != undefined &&
                item2.details.spProfilePic != ""
              ) {
                profilepic = item2.details.spProfilePic;
              }
              html +=
                '<div class="friend">' +
                '<div class="img-wrapper">' +
                '<img src="' +
                profilepic +
                '" alt="">' +
                "</div>" +
                '<div class="detail">' +
                '<a class="proname" href="' +
                MAINURL +
                "/friends/?profileid=" +
                item2.details.idspProfiles +
                '"><div class="name">' +
                item2.details.spProfileName +
                "</div></a>" +
                /*'<div class="tag-line">Lead Product Designer - Specialized in UI Design & UX Design</div>' +*/
                '<div class="mutual">Mutual Friends (' +
                item2.mutual +
                ")</div>" +
                "</div>" +
                '<div class="icons">' +
                '<div class="three-dot" style="cursor: pointer;">' +
                '<img src="' +
                MAINURL +
                '/assets/images/dot-2.svg" alt="" onclick="showMenu(' +
                item2.details.idspProfiles +
                ')">' +
                '<div class="three-dot-wrapper" id="three-dot-div' +
                item2.details.idspProfiles +
                '" style="display: none;">';
              var followfn = "follow";
              var follow = "Follow";
              if (item2.follow != undefined && item2.follow == 1) {
                followfn = "unfollow";
                follow = "Unfollow";
              }
              if (index == 0) {
                html +=
                  '<div class="option" onclick="' +
                  followfn +
                  "(" +
                  proId +
                  ", " +
                  item2.details.idspProfiles +
                  ')">' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/follow.svg" alt="">' +
                  "<span>" +
                  follow +
                  "</span>" +
                  "</div>" +
                  '<div class="option groupinvite" data-pid="' +
                  item2.details.idspProfiles +
                  '" >' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/add-4.svg" alt="">' +
                  "<span>Add to Group</span>" +
                  "</div>" +
                  '<div class="option" onclick="block(' +
                  proId +
                  ", " +
                  item2.details.idspProfiles +
                  ')">' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/block.svg" alt="" >' +
                  "<span>Block</span>" +
                  "</div>" +
                  '<div class="option" onclick="unfriend(' +
                  proId +
                  ", " +
                  item2.details.idspProfiles +
                  ')">' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/unfriend.svg" alt="" >' +
                  "<span>Unfriend</span>" +
                  "</div>";
              } else {
                var connect = "Connect";
                var connectClick = "addFriend";
                if (item2.connect == 1) {
                  connect = "Unconnect";
                  connectClick = "unfriend";
                }
                html +=
                  '<div class="option" onclick="' +
                  followfn +
                  "(" +
                  proId +
                  ", " +
                  item2.details.idspProfiles +
                  ', 0)">' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/follow.svg" alt="">' +
                  "<span>" +
                  follow +
                  "</span>" +
                  "</div>" +
                  '<div class="option" onclick="' +
                  connectClick +
                  "(" +
                  proId +
                  ", " +
                  item2.details.idspProfiles +
                  ')">' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/connected.svg" alt="">' +
                  "<span>" +
                  connect +
                  "</span>" +
                  "</div>" +
                  '<div class="option">' +
                  '<img src="' +
                  MAINURL +
                  '/assets/images/block.svg" alt="">' +
                  "<span>Block</span>" +
                  "</div>";
              }
              html +=
                "</div>" +
                "</div>" +
                '<div class="message" data-pid="' +
                item2.details.idspProfiles +
                '" >' +
                '<img src="' +
                MAINURL +
                '/assets/images/message-2.svg" alt="" class="option-icon">' +
                "</div>" +
                '<div class="home">' +
                '<img src="' +
                MAINURL +
                '/assets/images/home-2.svg" alt="" class="option-icon">' +
                "</div>" +
                "</div>" +
                "</div>";
            }
          });
          html += "</div>";
        });
      }
      $("#main-content").empty();
      $("#main-content").append(html);
    }
  );
}

function morePending(skip, limit, order) {
  if (skip != undefined) {
    callAjax(
      "Connection",
      "getPendingRequest",
      { skip: skip, limit: limit, order: order },
      0,
      $("#month-error"),
      function (success) {
        if (success.pending != undefined && success.pending.length > 0) {
          var html = "";
          $.each(success.pending, function (index, item) {
            var div = pendingDiv(item);
            html = html + div;
          });
          var viewAllSpan = document.getElementById("viewAllSpan");
          viewAllSpan.style.display = "none";
          $(".friend-list-wrapper").append(html);
        }
      }
    );
  }
}

function reject(sender, receiver) {
  if (sender != undefined && receiver != undefined) {
    callAjax(
      "PublicView",
      "removeRequest",
      { sender: sender, receiver: receiver },
      0,
      $("#month-error"),
      function (success) {
        window.location.reload();
      }
    );
  }
}

function accept(sender, receiver) {
  if (sender != undefined && receiver != undefined) {
    callAjax(
      "PublicView",
      "acceptFriend",
      { sender: sender, receiver: receiver },
      0,
      $("#month-error"),
      function (success) {
        window.location.reload();
      }
    );
  }
}

function follow(follower, following) {
  if (follower != undefined && following != undefined) {
    callAjax(
      "PublicView",
      "follow",
      { follower: follower, following: following },
      0,
      $("#month-error"),
      function (success) {
        window.location.reload();
      }
    );
  }
}

function unfollow(follower, following, type) {
  if (follower != undefined && following != undefined) {
    var msg = "unfollow";
    if (type == 1) {
      msg = "remove";
    }
    Swal.fire({
      title: "Are you sure you want to " + msg + " this profile ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Yes",
      cancelButtonColor: "#FF0000",
      cancelButtonText: "No",
    }).then((result) => {
      if (result.isConfirmed) {
        var blockerror = $("#block_error");
        callAjax(
          "PublicView",
          "unfollow",
          { follower: follower, following: following },
          0,
          $("#month-error"),
          function (success) {
            window.location.reload();
          }
        );
      }
    });
  }
}

function getConnection(search_term = "") {
  var proId = $("#profile-id").val();
  var MAINURL = window.location.origin;
  callAjax(
    "Connection",
    "getFriendsList",
    { search_term: search_term },
    0,
    $("#content-error"),
    function (success) {
      var count = 0;
      if (success != undefined) {
        count = success.length;
      }
      if (search_term == "") {
        var html =
          '<div class="title-heading">My Connections (' +
          count +
          ")</div>" +
          '<div class="filter">' +
          '<div class="search-box">' +
          '<div class="search-wrapper">' +
          '<div class="icon">' +
          '<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">' +
          '<path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216" />' +
          "</svg>" +
          "</div>" +
          '<input type="text" id="search-input" placeholder="Search Profile Name, Store name, Profile Type">' +
          "</div>" +
          "<button>SEARCH</button>" +
          "</div>" +
          "</div>" +
          '<div class="friend-list-wrapper">';
      } else {
        var html = '<div class="friend-list-wrapper">';
      }

      if (count > 0) {
        $.each(success, function (index, item) {
          var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
          if (item.spProfilePic != undefined && item.spProfilePic != "") {
            profilepic = item.spProfilePic;
          }
          var follow = "Follow";
          var followfn = "follow";
          if (item.follow != undefined && item.follow == 1) {
            follow = "Unfollow";
            followfn = "unfollow";
          }
          var homeIcon = "";
          // Check if the item has products
          if (item.hasProducts) {
            homeIcon =
              '<div class="home">' +
              '<img src="' +
              MAINURL +
              '/assets/images/home-2.svg" alt="" class="option-icon">' +
              "</div>";
          }
          html +=
            '<div class="friend">' +
            '<div class="img-wrapper">' +
            '<img src="' +
            profilepic +
            '" alt="">' +
            "</div>" +
            '<div class="detail">' +
            '<a class="proname" href="' +
            MAINURL +
            "/friends/?profileid=" +
            item.idspProfiles +
            '"><div class="name">' +
            item.spProfileName +
            "<span style='font-weight:200'> (" +
            item.spProfileTypeName +
            ")</span>" +
            "</div></a>" +
            '<div class="type hidden">' +
            item.spProfileTypeName +
            "</div>" +
            '<div class="mutual">Mutual Friends (' +
            item.mutual +
            ")</div>" +
            "</div>" +
            '<div class="icons">' +
            '<div class="three-dot" style="cursor: pointer;">' +
            '<img src="' +
            MAINURL +
            '/assets/images/dot-2.svg" alt="" onclick="showMenu(' +
            item.idspProfiles +
            ')">' +
            '<div class="three-dot-wrapper" id="three-dot-div' +
            item.idspProfiles +
            '" style="display: none;">' +
            '<div class="option" onclick="' +
            followfn +
            "(" +
            proId +
            ", " +
            item.idspProfiles +
            ', 0)">' +
            '<img src="' +
            MAINURL +
            '/assets/images/follow.svg" alt="">' +
            "<span>" +
            follow +
            "</span>" +
            "</div>" +
            '<div class="option groupinvite" data-pid="' +
            item.idspProfiles +
            '">' +
            '<img src="' +
            MAINURL +
            '/assets/images/add-4.svg" alt="">' +
            "<span>Add to Group</span>" +
            "</div>" +
            '<div class="option" onclick="block(' +
            proId +
            ", " +
            item.idspProfiles +
            ')">' +
            '<img src="' +
            MAINURL +
            '/assets/images/block.svg" alt="">' +
            "<span>Block</span>" +
            "</div>" +
            '<div class="option" onclick="unfriend(' +
            proId +
            ", " +
            item.idspProfiles +
            ')">' +
            '<img src="' +
            MAINURL +
            '/assets/images/unfriend.svg" alt="">' +
            "<span>Unfriend</span>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="message" data-pid="' +
            item.idspProfiles +
            '">' +
            '<img src="' +
            MAINURL +
            '/assets/images/message-2.svg" alt="" class="option-icon">' +
            "</div>" +
            homeIcon + // Include homeIcon conditionally
            "</div>" +
            "</div>";
        });
      }
      $("#main-content").empty();
      $("#main-content").append(html);
    }
  );
}

function getConnection2() {
  var proId = $("#profile-id").val();
  var MAINURL = window.location.origin;
  callAjax(
    "Connection",
    "getFriendsList",
    {},
    0,
    $("#content-error"),
    function (success) {
      var count = 0;
      if (success != undefined) {
        count = success.length;
      }
      var html =
        '<div class="title-heading">My Connections (' +
        count +
        ")</div>" +
        '<div class="filter">' +
        '<div class="search-box">' +
        '<div class="search-wrapper">' +
        '<div class="icon">' +
        '<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">' +
        '<path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216" />' +
        "</svg>" +
        "</div>" +
        '<input type="text" id="search-input" placeholder="Search Profile Name, Store name, Profile Type">' +
        "</div>" +
        "<button>SEARCH</button>" +
        "</div>" +
        "</div>" +
        '<div class="friend-list-wrapper">';
      if (count > 0) {
        $.each(success, function (index, item) {
          var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
          if (item.spProfilePic != undefined && item.spProfilePic != "") {
            profilepic = item.spProfilePic;
          }
          var follow = "Follow";
          var followfn = "follow";
          if (item.follow != undefined && item.follow == 1) {
            follow = "Unfollow";
            followfn = "unfollow";
          }
          html =
            html +
            '<div class="friend">' +
            '<div class="img-wrapper">' +
            '<img src="' +
            profilepic +
            '" alt="">' +
            "</div>" +
            '<div class="detail">' +
            '<a class="proname" href="' +
            MAINURL +
            "/friends/?profileid=" +
            item.idspProfiles +
            '"><div class="name">' +
            item.spProfileName +
            "</div></a>" +
            '<div class="type hidden">' +
            item.spProfileTypeName +
            "</div>" +
            /*'<div class="tag-line">Lead Product Designer - Specialized in UI Design & UX Design</div>'+*/
            '<div class="mutual">Mutual Friends (' +
            item.mutual +
            ")</div>" +
            "</div>" +
            '<div class="icons">' +
            '<div class="three-dot" style="cursor: pointer;">' +
            '<img src="' +
            MAINURL +
            '/assets/images/dot-2.svg" alt="" onclick="showMenu(' +
            item.idspProfiles +
            ')">' +
            '<div class="three-dot-wrapper" id="three-dot-div' +
            item.idspProfiles +
            '" style="display: none;">' +
            '<div class="option" onclick="' +
            followfn +
            "(" +
            proId +
            ", " +
            item.idspProfiles +
            ', 0)" >' +
            '<img src="' +
            MAINURL +
            '/assets/images/follow.svg" alt="">' +
            "<span>" +
            follow +
            "</span>" +
            "</div>" +
            '<div class="option groupinvite" data-pid="' +
            item.idspProfiles +
            '" >' +
            '<img src="' +
            MAINURL +
            '/assets/images/add-4.svg" alt="">' +
            "<span>Add to Group</span>" +
            "</div>" +
            '<div class="option" onclick="block(' +
            proId +
            ", " +
            item.idspProfiles +
            ')">' +
            '<img src="' +
            MAINURL +
            '/assets/images/block.svg" alt="">' +
            "<span>Block</span>" +
            "</div>" +
            '<div class="option" onclick="unfriend(' +
            proId +
            ", " +
            item.idspProfiles +
            ')">' +
            '<img src="' +
            MAINURL +
            '/assets/images/unfriend.svg" alt="">' +
            "<span>Unfriend</span>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="message" data-pid="' +
            item.idspProfiles +
            '">' +
            '<img src="' +
            MAINURL +
            '/assets/images/message-2.svg" alt="" class="option-icon">' +
            "</div>" +
            '<div class="home">' +
            '<img src="' +
            MAINURL +
            '/assets/images/home-2.svg" alt="" class="option-icon">' +
            "</div>" +
            "</div>" +
            "</div>";
        });
      }
      $("#main-content").empty();
      $("#main-content").append(html);
    }
  );
}

function getBlockedUser(order, search_term = "") {
  if (order == undefined || order == "") {
    order = "recentlyAdded";
  }
  var value1 = 'value="recentlyAdded"';
  if (order == "recentlyAdded") {
    value1 = 'value="recentlyAdded" selected';
  }
  var value2 = 'value="oldestAdded"';
  if (order == "oldestAdded") {
    value2 = 'value="oldestAdded" selected';
  }
  var value3 = 'value="name"';
  if (order == "name") {
    value3 = 'value="name" selected';
  }

  var proId = $("#profile-id").val();

  var MAINURL = window.location.origin;
  callAjax(
    "Connection",
    "getBlockedUser",
    { order: order, search_term: search_term },
    0,
    $("#content-error"),
    function (success) {
      var count = 0;
      if (success != undefined) {
        count = success.length;
      }

      if (search_term == "") {
        var html =
          '<div class="title-heading">Blocked List (' +
          count +
          ")</div>" +
          '<div class="filter">' +
          '<div class="search-box">' +
          '<div class="search-wrapper">' +
          '<div class="icon">' +
          '<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">' +
          '<path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216" />' +
          "</svg>" +
          "</div>" +
          '<input type="text" id="search-input" placeholder="Search Profile Name, Store name, Profile Type">' +
          "</div>" +
          "<button>SEARCH</button>" +
          "</div>" +
          '<div class="sort-by">' +
          "<span>Sort By:</span>" +
          '<select id="sort-by" data-sec="blocklist" class="form-select" aria-label="Default select example">' +
          "<option " +
          value1 +
          ">Recently Added</option>" +
          "<option " +
          value2 +
          ">Oldest Added</option>" +
          "<option " +
          value3 +
          ">Name</option>" +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="friend-list-wrapper">';
      } else {
        var html = '<div class="friend-list-wrapper">';
      }

      if (count > 0) {
        $.each(success, function (index, item) {
          var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
          if (item.spProfilePic != undefined && item.spProfilePic != "") {
            profilepic = item.spProfilePic;
          }
          html =
            html +
            '<div class="friend">' +
            '<div class="img-wrapper">' +
            '<img src="' +
            profilepic +
            '" alt="">' +
            "</div>" +
            '<div class="detail">' +
            '<a class="proname" href="' +
            MAINURL +
            "/friends/?profileid=" +
            item.idspProfiles +
            '"><div class="name">' +
            item.spProfileName +
            "</div></a>" +
            '<div class="type hidden">' +
            item.spProfileTypeName +
            "</div>" +
            /*'<div class="tag-line">Lead Product Designer - Specialized in UI Design & UX Design</div>'+*/
            '<div class="mutual">Mutual Friends (' +
            item.mutual +
            ")</div>" +
            "</div>" +
            '<div class="icons">' +
            '<div class="three-dot" style="cursor: pointer;">' +
            '<img src="' +
            MAINURL +
            '/assets/images/dot-2.svg" alt="" onclick="showMenu(' +
            item.idspProfiles +
            ')">' +
            '<div class="three-dot-wrapper" id="three-dot-div' +
            item.idspProfiles +
            '" style="display: none;">' +
            '<div class="option" onclick="Unblock(' +
            proId +
            ", " +
            item.idspProfiles +
            ')" >' +
            '<img src="' +
            MAINURL +
            '/assets/images/block.svg" alt="">' +
            "<span>Unblock</span>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="message" data-pid="' +
            item.idspProfiles +
            '" >' +
            '<img src="' +
            MAINURL +
            '/assets/images/message-2.svg" alt="" class="option-icon">' +
            "</div>" +
            '<div class="home">' +
            '<img src="' +
            MAINURL +
            '/assets/images/home-2.svg" alt="" class="option-icon">' +
            "</div>" +
            "</div>" +
            "</div>";
        });
      }
      $("#main-content").empty();
      $("#main-content").append(html);
    }
  );
}

function getRecentlyAdded(order, type, search_term = "") {
  if (order == undefined || order == "") {
    order = "recentlyAdded";
  }
  var obj = { order: order, search_term: search_term };
  if (type == "getRecentlyAdded") {
    var data_sec = 'data-sec="recent"';
    var remove = "unfriend";
    var heading = "Recently Added";
  }
  if (type == "getFollowing") {
    var data_sec = 'data-sec="following"';
    var remove = "unfollow";
    var heading = "Following";
    obj["following"] = 1;
  }
  if (type == "getFollowers") {
    type = "getFollowing";
    var data_sec = 'data-sec="followers"';
    var remove = "unfollow";
    var heading = "Followers";
    obj["following"] = 0;
  }
  var value1 = 'value="recentlyAdded"';
  if (order == "recentlyAdded") {
    value1 = 'value="recentlyAdded" selected';
  }
  var value2 = 'value="oldestAdded"';
  if (order == "oldestAdded") {
    value2 = 'value="oldestAdded" selected';
  }
  var value3 = 'value="name"';
  if (order == "name") {
    value3 = 'value="name" selected';
  }
  var proId = $("#profile-id").val();
  var MAINURL = window.location.origin;
  callAjax("Connection", type, obj, 0, $("#content-error"), function (success) {
    var count = 0;
    if (success != undefined) {
      count = success.length;
    }
    if (search_term != "") {
      var html = '<div class="friend-list-wrapper">';
    } else {
      var html =
        '<div class="title-heading">' +
        heading +
        " (" +
        count +
        ")</div>" +
        '<div class="filter">' +
        '<div class="search-box">' +
        '<div class="search-wrapper">' +
        '<div class="icon">' +
        '<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">' +
        '<path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216" />' +
        "</svg>" +
        "</div>" +
        '<input type="text" id="search-input" placeholder="Search Profile Name, Store name, Profile Type">' +
        "</div>" +
        "<button>SEARCH</button>" +
        "</div>" +
        '<div class="sort-by">' +
        "<span>Sort By:</span>" +
        '<select id="sort-by" ' +
        data_sec +
        ' class="form-select" aria-label="Default select example">' +
        "<option " +
        value1 +
        ">Recently Added</option>" +
        "<option " +
        value2 +
        ">Oldest Added</option>" +
        "<option " +
        value3 +
        ">Name</option>" +
        "</select>" +
        "</div>" +
        "</div>" +
        '<div class="friend-list-wrapper">';
    }

    if (count > 0) {
      $.each(success, function (index, item) {
        var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
        if (item.spProfilePic != undefined && item.spProfilePic != "") {
          profilepic = item.spProfilePic;
        }
        html =
          html +
          '<div class="friend">' +
          '<div class="img-wrapper">' +
          '<img src="' +
          profilepic +
          '" alt="">' +
          "</div>" +
          '<div class="detail">' +
          '<a class="proname" href="' +
          MAINURL +
          "/friends/?profileid=" +
          item.idspProfiles +
          '"><div class="name">' +
          item.spProfileName +
          "</div></a>" +
          '<div class="type hidden">' +
          item.spProfileTypeName +
          "</div>" +
          /*'<div class="tag-line">Lead Product Designer - Specialized in UI Design & UX Design</div>'+*/
          '<div class="mutual">Mutual Friends (' +
          item.mutual +
          ")</div>" +
          "</div>" +
          '<div class="icons">' +
          '<div class="three-dot" style="cursor: pointer;">' +
          '<img src="' +
          MAINURL +
          '/assets/images/dot-2.svg" alt="" onclick="showMenu(' +
          item.idspProfiles +
          ')">' +
          '<div class="three-dot-wrapper" id="three-dot-div' +
          item.idspProfiles +
          '" style="display: none;">';
        var arg = proId + ", " + item.idspProfiles;
        var followfn = "follow";
        var follow = "Follow";
        if (type == "getRecentlyAdded") {
          if (item.follow != undefined && item.follow == 1) {
            followfn = "unfollow";
            follow = "Unfollow";
          }
          html =
            html +
            '<div class="option" onclick="' +
            followfn +
            "(" +
            proId +
            ", " +
            item.idspProfiles +
            ')" >' +
            '<img src="' +
            MAINURL +
            '/assets/images/follow.svg" alt="">' +
            "<span>" +
            follow +
            "</span>" +
            "</div>";
        }
        if (type == "getFollowing") {
          if (item.isFriend == 0) {
            html =
              html +
              '<div class="option" onclick="addFriend(' +
              proId +
              ", " +
              item.idspProfiles +
              ')" >' +
              '<img src="' +
              MAINURL +
              '/assets/images/connected.svg" alt="">' +
              "<span>Connect</span>" +
              "</div>";
          }
          if (item.isFriend == 1) {
            html =
              html +
              '<div class="option" onclick="unfriend(' +
              proId +
              ", " +
              item.idspProfiles +
              ')" >' +
              '<img src="' +
              MAINURL +
              '/assets/images/connected.svg" alt="">' +
              "<span>Unconnect</span>" +
              "</div>";
          }
          if (obj["following"] == 0) {
            arg = item.idspProfiles + ", " + proId + ", 1";
            if (item.follow != undefined && item.follow == 1) {
              followfn = "unfollow";
              follow = "Unfollow";
            }
            html =
              html +
              '<div class="option" onclick="' +
              followfn +
              "(" +
              proId +
              ", " +
              item.idspProfiles +
              ')" >' +
              '<img src="' +
              MAINURL +
              '/assets/images/follow.svg" alt="">' +
              "<span>" +
              follow +
              "</span>" +
              "</div>";
          }
        }
        html =
          html +
          '<div class="option" onclick="' +
          remove +
          "(" +
          arg +
          ')">' +
          '<img src="' +
          MAINURL +
          '/assets/images/remove.svg" alt="">' +
          "<span>Remove </span>" +
          "</div>" +
          '<div class="option" onclick="block(' +
          proId +
          ", " +
          item.idspProfiles +
          ')" >' +
          '<img src="' +
          MAINURL +
          '/assets/images/block.svg" alt="">' +
          "<span>Block</span>" +
          "</div>" +
          '<div class="option">' +
          '<img src="' +
          MAINURL +
          '/assets/images/flag.svg" alt="">' +
          "<span>Flag</span>" +
          "</div>" +
          "</div>" +
          "</div>" +
          '<div class="message" data-pid="' +
          item.idspProfiles +
          '" >' +
          '<img src="' +
          MAINURL +
          '/assets/images/message-2.svg" alt="" class="option-icon">' +
          "</div>" +
          '<div class="home">' +
          '<img src="' +
          MAINURL +
          '/assets/images/home-2.svg" alt="" class="option-icon">' +
          "</div>" +
          "</div>" +
          "</div>";
      });
    }
    $("#main-content").empty();
    $("#main-content").append(html);
  });
}

$(document).on("change", "#sort-by", function () {
  var selectedValue = $(this).val();
  var dataSecValue = $(this).data("sec");
  if (dataSecValue == "pending") {
    getPending(selectedValue);
  }
  if (dataSecValue == "recent") {
    getRecentlyAdded(selectedValue, "getRecentlyAdded");
  }
  if (dataSecValue == "following") {
    getRecentlyAdded(selectedValue, "getFollowing");
  }
  if (dataSecValue == "followers") {
    getRecentlyAdded(selectedValue, "getFollowers");
  }
  if (dataSecValue == "blocklist") {
    getBlockedUser(selectedValue);
  }
});

$(document).on("input", "#search-input", function () {
  var searchText = $(this).val().toLowerCase();
  $(".friend").each(function () {
    var profileName = $(this).find(".name").text().toLowerCase();
    var profileType = $(this).find(".type").text().toLowerCase();
    if (profileName.includes(searchText) || profileType.includes(searchText)) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});

function block(userby, userto) {
  Swal.fire({
    title: "Are you sure you want to block this profile ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Yes",
    cancelButtonColor: "#FF0000",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      var blockerror = $("#block_error");
      callAjax(
        "PublicView",
        "unfriend",
        { sender: userby, receiver: userto },
        0,
        blockerror,
        function (success) {
          callAjax(
            "PublicView",
            "blockUser",
            { userby: userby, userto: userto },
            0,
            blockerror,
            function (success) {
              window.location.reload();
            }
          );
        }
      );
    }
  });
}

function Unblock(userby, userto) {
  Swal.fire({
    title: "Are you sure you want to unblock this profile ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Yes",
    cancelButtonColor: "#FF0000",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      var blockerror = $("#block_error");
      callAjax(
        "PublicView",
        "unBlockUser",
        { userby: userby, userto: userto },
        0,
        blockerror,
        function (success) {
          window.location.reload();
        }
      );
    }
  });
}

function unfriend(sender, receiver) {
  Swal.fire({
    title: "Are you sure you want to unfriend this profile ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Yes",
    cancelButtonColor: "#FF0000",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      var blockerror = $("#block_error");
      callAjax(
        "PublicView",
        "unfriend",
        { sender: sender, receiver: receiver },
        0,
        blockerror,
        function (success) {
          window.location.reload();
        }
      );
    }
  });
}

function addFriend(sender, receiver) {
  if (sender && receiver) {
    var blockerror = $("#block_error");
    callAjax(
      "PublicView",
      "addFriend",
      { sender: sender, receiver: receiver },
      0,
      blockerror,
      function (success) {
        window.location.reload();
      }
    );
  }
}

function getBirthDay() {
  var MAINURL = window.location.origin;
  var html =
    '<div class="title-heading" style="margin-bottom: 20px;">' +
    "<span>Recent Birthdays</span>" +
    "</div>" +
    '<div class="birth-wrapper">';
  callAjax(
    "Connection",
    "getBirthDay",
    {},
    0,
    $("#content-error"),
    function (success) {
      if (success != undefined) {
        if (success.recent != undefined && success.recent.length > 0) {
          $.each(success.recent, function (index, item) {
            var bday = bdayDiv(item);
            html = html + bday;
          });
        }
        html =
          html +
          "</div>" +
          '<div class="title-heading" style="margin-bottom: 20px;">' +
          "<span>Upcoming Birthdays</span>" +
          "</div>" +
          '<div class="birth-wrapper">';
        if (success.upcoming != undefined && success.upcoming.length > 0) {
          $.each(success.upcoming, function (index, item) {
            var upcoming = bdayDiv(item);
            html = html + upcoming;
          });
        }
        html =
          html +
          "</div>" +
          '<div class="birth-month">' +
          '<div class="title-heading">' +
          "<span>Select Birthday Month</span>" +
          "</div>" +
          '<select class="form-select" id="birthday-month" aria-label="Default select example">' +
          '<option value="0" selected>Select Month</option>' +
          '<option value="01">January</option>' +
          '<option value="02">February</option>' +
          '<option value="03">March</option>' +
          '<option value="04">April</option>' +
          '<option value="05">May</option>' +
          '<option value="06">June</option>' +
          '<option value="07">July</option>' +
          '<option value="08">August</option>' +
          '<option value="09">September</option>' +
          '<option value="10">October</option>' +
          '<option value="11">November</option>' +
          '<option value="12">December</option>' +
          "</select>" +
          '<span style="color: red; display: none;" id="month-error"></span>' +
          '<div id="birthday-users" class="title">' +
          "</div>" +
          '<div class="id-wrapper">' +
          "</div>" +
          "</div>";
        $("#main-content").empty();
        $("#main-content").append(html);
        emojiFn();
        attachDropdownListener();
        autofill();
      }
    }
  );
}

function showMenu(id) {
  const menuDiv = document.getElementById("three-dot-div" + id);
  const otherDivs = document.querySelectorAll(".three-dot-wrapper");
  otherDivs.forEach(function (div) {
    if (div !== menuDiv) {
      div.style.display = "none";
    }
  });
  if (menuDiv.style.display == "none") {
    menuDiv.style.display = "flex";
  } else {
    menuDiv.style.display = "none";
  }
}

function bdayDiv(item) {
  var MAINURL = window.location.origin;
  var profilepic = MAINURL + "/assets/images/icon/blank-img.png";
  if (item.profile_pic != undefined && item.profile_pic != "") {
    profilepic = item.profile_pic;
  }
  var html =
    '<div class="birth">' +
    '<div class="birth-detail">' +
    '<div class="user-detail-wrapper">' +
    '<div class="img-wrapper">' +
    '<img class="propic" src="' +
    profilepic +
    '" alt="">' +
    "</div>" +
    '<div class="user-detail">' +
    '<div class="name"><a class="profilename" href="' +
    MAINURL +
    "/friends/?profileid=" +
    item.idspProfiles +
    '">' +
    item.profile_name +
    "</a></div>" +
    '<div class="dob">' +
    item.dob +
    "</div>" +
    "</div>" +
    "</div>" +
    '<div class="age">' +
    item.age +
    "  Years Old" +
    "</div>" +
    "</div>" +
    '<div class="submit-detail">' +
    '<div class="input-wrapper">' +
    '<input class="inputtext" id="inputtext_' +
    item.idspProfiles +
    '" type="text" name="spPostingNotes" placeholder="Type your comment here...">' +
    '<div class="icon">' +
    '<img src="' +
    MAINURL +
    '/assets/images/round-post-icon.svg" alt="" onclick="postWish(' +
    item.idspProfiles +
    ')">' +
    "</div>" +
    "</div>" +
    '<div class="emojy-icon" id="input-left-position" >' +
    '<img src="' +
    MAINURL +
    '/assets/images/emogy-icon.svg" alt="" class="second-btn emojy" data-target="inputtext_' +
    item.idspProfiles +
    '">' +
    "</div>" +
    "</div>" +
    '<div class="tags-wrapper">' +
    '<div class="tag" data-id="' +
    item.idspProfiles +
    '">' +
    "<span>Happy Birthday 🎈</span>" +
    "</div>" +
    '<div class="tag" data-id="' +
    item.idspProfiles +
    '">' +
    "<span>Happy Birthday 🎂</span>" +
    "</div>" +
    '<div class="tag" data-id="' +
    item.idspProfiles +
    '">' +
    "<span>Happy Birthday 🩷</span>" +
    "</div>" +
    "</div>" +
    "</div>";
  return html;
}

function postWish(pid) {
  if (pid != undefined && pid != 0) {
    var post = $("#inputtext_" + pid)
      .val()
      .trim();
    var proId = $("#profile-id").val();
    if (post != undefined && post != "") {
      var obj = {
        spPostingNotes: post,
        spCategories_idspCategory: 16,
        spPostingVisibility: -1,
        spProfiles_idspProfiles: proId,
        birtday: 1,
        bday_pid: pid,
      };
      callAjax(
        "Timeline",
        "postPost",
        obj,
        0,
        $("#month-error"),
        function (success) {
          $("#inputtext_" + pid).val("");
        }
      );
    } else {
      Swal.fire({
        title: "Error!",
        text: "Post cannot be blank",
        icon: "error",
        confirmButtonText: "OK",
      });
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const activeLink = document.querySelector(
    ".group-navigation .link.active-link"
  );
  var sec = activeLink.getAttribute("data-sec");
  if (sec != null) {
    getSection(sec);
  }
});

function getSection(sec, search_val = "") {
  if (sec == "birthday") {
    getBirthDay();
  }
  if (sec == "connection") {
    getConnection();
  }
  if (sec == "pending") {
    getPending("recentlyAdded");
  }
  if (sec == "connectionlevel") {
    getConnectionLevel();
  }
  if (sec == "recent") {
    getRecentlyAdded("recentlyAdded", "getRecentlyAdded");
  }
  if (sec == "following") {
    getRecentlyAdded("recentlyAdded", "getFollowing");
  }
  if (sec == "followers") {
    getRecentlyAdded("recentlyAdded", "getFollowers");
  }
  if (sec == "blocklist") {
    getBlockedUser("recentlyAdded");
  }
  if (sec == "publicProfile") {
    getPublicProfile("publicProfile", search_val);
  }
}

function getPublicProfile(order, search_val) {
  var myKeyVals = {
    action: order,
    class: "Connection",
    search_val: search_val,
  };
  var saveData = $.ajax({
    type: "POST",
    url: "../api.php",
    data: myKeyVals,
    dataType: "text",
    success: function (resultData) {
      console.log(resultData);
    },
  });
  saveData.fail(function () {
    alert("Something went wrong");
  });
}

function attachDropdownListener() {
  var MAINURL = window.location.origin;
  const dropdown = document.getElementById("birthday-month");
  dropdown.addEventListener("change", function () {
    $("#birthday-users").empty();
    $(".id-wrapper").empty();
    var month = this.value;
    if (month != 0) {
      callAjax(
        "Connection",
        "getBirthDayByMonth",
        { month: month },
        0,
        $("#month-error"),
        function (success) {
          if (success.error == undefined && success != "{}") {
            var mainHtml = "";
            var userNames = "";
            var nameArray = [];
            $.each(success["users"], function (index, item) {
              if (nameArray.length < 2) {
                if (item.profile_name) {
                  nameArray.push(item.profile_name);
                }
              }
              var picture = MAINURL + "/assets/images/icon/blank-img.png";
              if (item.profile_pic != undefined && item.profile_pic != "") {
                picture = item.profile_pic;
              }
              var html =
                '<div class="img-wrapper">' +
                '<a class="profilename" href="' +
                MAINURL +
                "/friends/?profileid=" +
                item.idspProfiles +
                '"><img class="propic" src="' +
                picture +
                '" alt=""></a>' +
                "</div>";
              mainHtml = mainHtml + html;
            });
            if (nameArray.length > 0) {
              var userNames = nameArray.join(", ");
              if (success.count > 2) {
                var count = success.count - 2;
                userNames = userNames + " and " + count + " others";
              }
            } else {
              userNames = "No Birthdays found";
            }
            $("#birthday-users").text(userNames);
            $(".id-wrapper").append(mainHtml);
          }
        }
      );
    }
  });
}
