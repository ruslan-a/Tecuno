<?php 
include 'cms/db.php'; 

$query = ('SELECT * FROM articles WHERE id = :id');
$statement = $con -> prepare($query);
$statement -> bindValue(':id', intval($_GET['id']), PDO::PARAM_INT);
if (!$statement -> execute()) {
    print_r($statement->errorInfo());
}
$post = $statement -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title><?=$post['title'];?> - Example Site</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/type.css">
<link rel="stylesheet" href="css/grid.css">
<link rel="stylesheet" href="css/main.css">
</head>

<body class="article">
	<div class="container_12">
		<?php include("header.php"); ?>
		<div class="grid_12 postsContainer">
			<div class="grid_12 post">
				<h2 class="postTitle"><?=$post['title'];?></h2>
				<span class="byline"> by <?=$post['author'];?> on <?=$post['created']; ?> </span>
				<img class="postImage" src="cms/articles/<?=$post['url']; ?>/banner.jpeg" width="100%"> </img>
				<div class="postInner">
					<?php include("cms/articles/".$post['url']."/text.html"); ?>
          <a class="button" href="/">back to news</a>
				</div>
		</div>

	</div>
</body>
</html>