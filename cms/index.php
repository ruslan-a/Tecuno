<?php if(isset($_GET['a']) && $_GET['a'] == 'login' OR !isset($_GET['a'])) { ?>
<head>
	<meta charset="UTF-8" />
	<title>Tecuno Login</title>
	<link rel="stylesheet" href="./cms.css">
	<link rel="icon" type="image/png" href="/favicon.ico" />
</head>
<body>
	<div class="outerWrapper">
	<div class="wrapper">
		<?php 
			if (isset($_GET['wp']) && $_GET['wp'] == 1)
				echo '<div class="heading">Wrong Password</div>';
			else
				echo '<div class="heading">Tecuno Login</div>';
		?>
		<div class="form">
			<form action="?a=newArticle" method="post">
<input type="text" name="username" placeholder="Username">
<input type="password" name="password" placeholder="Password">
<input type="submit" class="postButton" value="Log In">
			</form>
		</div>
	</div>
</body>


<?php }
if(isset($_GET['a']) && $_GET['a'] == 'newArticle') { 
if($_POST['password'] != 'test') {  // todo: fix this password placeholder shit
?>
<head>
	<title>New Article</title>
	<link rel="stylesheet" href="./cms.css">
	<script type="text/javascript"> 
		function stopRKey(evt) { // stop enter key submitting form
		  var evt = (evt) ? evt : ((event) ? event : null); 
		  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
		  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
		} 
		document.onkeypress = stopRKey; 
	</script>
</head>
<body>
	<div class="outerWrapper">
		<div class="wrapper newArticle">
			<div class="heading">New Article</div>
			<div class="formNewArticle">
			 <form action="postarticle.php" method=POST>
			 <div class="smallFields">
			 <input type="text" name="url" placeholder="Article URL">
			 <br>
			 <input type="text" name="title" placeholder="Article Title">
			 <input type="text" name="author" placeholder="Article Author">
			 <input type="text" name="category" placeholder="Category">
			 <input type="text" name="type" placeholder="Type">
			 </div>
			 <textarea class="bodyArea" rows="8" cols="47" name="body" placeholder="Article Body" height="200px"></textarea>
			 <div class="postButtonDiv"><input type="submit" class="postButton" value="Post"></div>
			 </form>
			</div>
		</div>


<?php
	} else {
		// echo '<meta http-equiv="REFRESH" content="0;url=/cms?wa=1">';
	} 

	if(isset($_GET['a']) && $_GET['a'] == 'newArticle') {  ?>
	<div class="outerWrapper">
		<div class="wrapper listArticles">
			<div class="heading">All Articles</div>
			<?php
include 'db.php';

$filter = NULL;
$page = NULL;
$noArticles = NULL;

if(isset($_GET['filter'])) { 
	$filter = $_GET['filter'];
}

if(isset($_GET['page'])) {
	$page = $_GET['page']-1;
	if($_GET['page'] < 1) {
		$page = 0;
	}
}

$rangeStart = $page * 5;
$rangeEnd = $rangeStart + 5;


$query = ('SELECT * FROM articles ORDER BY created DESC LIMIT :rangeStart, :rangeEnd');
$statement = $con -> prepare($query);
$statement -> bindValue(':rangeStart', intval($rangeStart), PDO::PARAM_INT);
$statement -> bindValue(':rangeEnd', intval($rangeEnd), PDO::PARAM_INT);
if (!$statement -> execute()) {
    print_r($statement->errorInfo());
}
$result = $statement -> fetchAll(PDO::FETCH_ASSOC);
$counter = 0;

foreach ($result as $row) {
	$articles[$counter] = $row;
	$counter += 1;
}

echo "<div class='grid_8 postsContainer'>";
if($filter == "videos") {
	echo "<h2 class='postTitle' style='margin-top: 25px; text-align: center;'>Videos coming soon!</h2>";
}
	
$reverseCount = 0;
while($reverseCount < 5) {
	$id = $articles[$reverseCount]['id'];
	$url = $articles[$reverseCount]['url'];
	$title =  htmlspecialchars($articles[$reverseCount]['title'], ENT_QUOTES);
	$author = $articles[$reverseCount]['author'];
	$created = $articles[$reverseCount]['created'];
	$category = $articles[$reverseCount]['category'];
	$type = $articles[$reverseCount]['type'];
	$blurb = substr(file_get_contents('articles/'.$url.'/text.html',TRUE),0,200);
	if($url == null) {
		$noArticles = true;
		break;
	}
	if(($filter == $type) or ($filter == null)) {
		echo "<div class='grid_8 post'>";
			echo "<a href='article.php?id=$id&amp;name=$url'><img class='postImage' src='articles/$url/banner.jpeg' alt='$title Image' width='100' style='float: left; margin: 10px;'/></a>";
			echo "<h2 class='postTitle'><a href='article.php?id=$id&amp;name=$url'>$title</a></h2>";
			echo $blurb."…";
			echo " <a class='readMore' href='article.php?id=$id&amp;name=$url'>read more.</a></p>";
			echo "<div class='postFooter'>
				<span class='authorDate'> by $author on $created in <a href='/?filter=$type'>$type</a> </span>
				<a class='commentCount button' href='?a=edit'>Edit</a>
			</div>";
		echo "</div>";
	}
	$reverseCount ++;
}


?>
	</div></div>	 <!-- end feedFooter end PostsContainer -->

</div>
<?php }} ?>

<a href="/" class="backLink">&#9664; back to site</a></div>
</body>
