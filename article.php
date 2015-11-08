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
<title><?=$article['title'];?> - Example Site</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/type.css">
<link rel="stylesheet" href="css/grid.css">
<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<div class="container_12">
		<?php include("header.php"); ?>
		<div class="grid_12 postsContainer">
			<div class="grid_12 post">
				<div class="postInner">
					<h2 class="postTitle"><?=$article['title'];?></h2>
					<span class="authorDate"> by <?=$article['author'];?> on <?=$article['created']; ?> </span>
					<img class="postImage" src="cms/articles/<?=$article['url']; ?>/banner.jpeg" width="100%"> </img>
					<?php include("cms/articles/".$article['url']."/text.html"); ?>
					<br>
          <a class="button" href="/">back to news</a>
				</div>
		</div>

	</div>
</body>
</html>