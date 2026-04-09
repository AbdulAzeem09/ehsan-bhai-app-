<!DOCTYPE html>
<html lang="en">
<head>
	<title>SharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../css/font-awesome.min.css"> 
	<link rel="stylesheet" href="../css/home.css">
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/jquery-1.11.4-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/home.js"></script> 
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.js" type="text/javascript"></script>
		<script type="text/javascript">
			function load() 
			{
				var feed ="http://feeds.bbci.co.uk/news/world/rss.xml";
				new GFdynamicFeedControl(feed, "feedControl");
				var feed1 ="http://feeds.bbci.co.uk/news/world/rss.xml";
				new GFdynamicFeedControl(feed1, "feedControl1");

			}
			google.load("feeds", "1");
			google.setOnLoadCallback(load);
		</script>
 </head>
 <body style="background-color:white;">
	<div class="container">
		<div class="row">
			<div class="col-md-6"><!--News Type1-->
				<div class="body">
					<div id="feedControl">Loading...</div>
				</div>
			</div>
			
			<div class="col-md-6"><!--News Type2-->
				<div class="body">
					<div id="feedControl1">Loading...</div>
				</div>
			</div>
		</div>
		
		<!--<div class="row">
			<div class="col-md-6">
				<div id="body">
					<div id="feedControl">Loading...</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div id="body">
					<div id="feedControl">Loading...</div>
				</div>
			</div>
		</div>-->
	</div>
 </body>
</html>