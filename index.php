<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>The Vestige Times</title>
	<meta name="description" content="Tech, media and culture news all in one place." />
	<meta name="keywords" content="tech,technology,computers,news,latest,iphone,ipad,icloud,icloudnews,ios6,windows,mac,review,movies,tvshows" />
	<meta name="author" content="Inexplicable &amp; Certify" />
	<meta charset="UTF-8" />
	<link rel="icon" type="image/png" href="favicon.ico" />
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/type.css" />
	<link rel="stylesheet" href="css/grid.css" />
	<link rel="stylesheet" href="css/main.css" />
	<?php include('analytics.php'); ?>
</head>

<body>
	
<div class="container_12">
		<?php include("header.php"); ?>
		<div class="grid_12 adContainer">
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-9711785518404937"; 
				/* topBanner */ 
				google_ad_slot = "2632758791"; 
				google_ad_width = 728; 
				google_ad_height = 90; 
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> </script>
		</div>
		<?php include("feed.php"); ?>
		<?php include("sidebar.php"); ?>
	</div>

	
	<script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'thevestigetimes'; // required: replace example with your forum shortname
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
   </script>
        
</body>