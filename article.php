<?php 
include 'db.php'; 

$query = ('SELECT * FROM articles WHERE id = :id');
$statement = $con -> prepare($query);
$statement -> bindValue(':id', intval($_GET['id']), PDO::PARAM_INT);
if (!$statement -> execute()) {
    print_r($statement->errorInfo());
}
$article = $statement -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title><?=$article['title'];?> - The Vestige Times</title>
<link rel="icon" type="image/png" href="/favicon.png" />
<link rel="icon" type="image/png" href="/favicon.ico" />
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/type.css">
<link rel="stylesheet" href="css/grid.css">
<link rel="stylesheet" href="css/main.css">
<?php include('analytics.php'); ?>
</head>

<body>
	<div class="container_12" style="border-right: solid 1px #666">
		<?php include("header.php"); ?>
		<div class="grid_8 postsContainer">
			<div class="grid_8 post">
				<div class="postInner">
					<h2 class="postTitle"><?=$article['title'];?></h2>
					<span class="authorDate"> by <?=$article['author'];?> on <?=$article['created']; ?> </span>
					<img class="postImage" src="cms/articles/<?=$article['url']; ?>/banner.jpeg" width="100%"> </img>
					<?php include("cms/articles/".$article['url']."/text.html"); ?>
					<br><a href="/index.html">back to news</a>
				</div>
				<div class="disqusThread">
					<div id="disqus_thread"></div>
		        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	    		</div>
   			</div>
		</div>
		<?php include("sidebar.php"); ?>
	</div>

<script type="text/javascript">
  /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
  var disqus_shortname = 'thevestigetimes'; // required: replace example with your forum shortname

  /* * * DON'T EDIT BELOW THIS LINE * * */
  (function() {
      var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
      dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  })();
</script>
</body>
</html>