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
	$blurb = substr(file_get_contents('cms/articles/'.$url.'/text.html',TRUE),0,450);
	if($url == null) {
		$noArticles = true;
		break;
	}
	if(($filter == $type) or ($filter == null)) {
		echo "<div class='grid_8 post'>";
			echo "<h2 class='postTitle'><a href='article.php?id=$id&amp;name=$url'>$title</a></h2>";
			echo "<span class='authorDate'> by $author on $created in <a href='/?filter=$type'>$type</a> </span>";
			echo "<a href='article.php?id=$id&amp;name=$url'><img class='postImage' src='cms/articles/$url/banner.jpeg' alt='$title Image'/></a>";
			echo $blurb."…";
			echo " <a class='readMore' href='article.php?id=$id&amp;name=$url'>read more.</a></p>";
			echo "<div class='postFooter'><a class='commentCount' href='article.php?id=$id&amp;name=$url#disqus_thread'>Link</a></div>";
		echo "</div>";
	}
	$reverseCount ++;
}

echo "<div class='feedFooter'>";

$nextPage = $page + 2;

if(isset($_GET['page'])) {
	$prevPage = $_GET['page']-1;
	echo "<a href='/?page=$prevPage'>Previous Page</a>";
}


if($noArticles == true) {
	echo "No more articles.<br>";
	echo "<a href='/?page=$prevPage'>Previous Page</a>";
}	elseif($noArticles == false) {
	echo "<a href='/?page=$nextPage'>Next Page</a>";
}
echo "</div>"; //end feedFooter


echo "</div>"; //end PostsContainer
?>