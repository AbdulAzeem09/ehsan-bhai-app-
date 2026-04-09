function fbsignin(){
    FB.login(function(e){
        console.log(e),
        "connected" === e.status && signinAPI(e)
    },
    {
        scope:"user_managed_groups,  manage_pages, pages_messaging, publish_actions, manage_pages, publish_pages, email, public_profile, publish_actions, pages_manage_cta, read_page_mailboxes, pages_show_list, pages_manage_instant_articles, read_audience_network_insights, read_insights"
    })}
//"user_managed_groups,  manage_pages, pages_messaging, publish_actions, manage_pages, publish_pages, email, user_likes, public_profile, user_about_me, user_posts, publish_actions, ads_management, pages_manage_cta, read_page_mailboxes, pages_show_list, rsvp_event, user_events, pages_manage_instant_articles, user_actions.books, user_actions.fitness, user_actions.music, user_actions.news, user_actions.video, read_audience_network_insights, read_custom_friendlists, read_insights, user_status, user_religion_politics, user_hometown, user_location, user_photos, user_relationship_details, user_relationships"
function statusChangeCallback(e){
    console.log("statusChangeCallback"), 
            console.log(e), 
            "connected" === e.status?signinAPI(e):"not_authorized" === e.status || 
            FB.login(function(e){}, {
                 scope:"user_managed_groups,  manage_pages, pages_messaging, publish_actions, manage_pages, publish_pages, email, public_profile, publish_actions, pages_manage_cta, read_page_mailboxes, pages_show_list, pages_manage_instant_articles, read_audience_network_insights, read_insights"})}

function checkLoginState(){
    FB.getLoginStatus(function(e){statusChangeCallback(e)})}

function signinAPI(e){
    $('#fbToken').val(e.authResponse.accessToken);
    if($('#fbToken').val()!=""){
        $('#fbSettingSave').click();
    }
    /*
    console.log("/"+e.authResponse.accessToken+"/accounts"), 
            FB.api("/"+e.authResponse.userID+"/accounts",
    function (response) {
      if (response && !response.error) {
        console.log(response);
      }
    }
);*/}

window.fbAsyncInit=function(){FB.init({appId:"100425770534010",cookie:!0,xfbml:!0,version:"v2.2"})},function(e,n,o){var i,t=e.getElementsByTagName(n)[0];e.getElementById(o)||(i=e.createElement(n),i.id=o,i.src="//connect.facebook.net/en_US/sdk.js",t.parentNode.insertBefore(i,t))}(document,"script","facebook-jssdk");

