<?php
	$con = mysql_connect("localhost","root","evenstar");
	if (!$con) {
		die('Could not connect to SQL: ' . mysql_error());
	}
	mysql_select_db("techunion", $con);
	
	$testMode = $_GET['test'];

	$url = $_POST['url'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$category = $_POST['category'];
	$type = $_POST['type'];
	$body = $_POST['body'];

	echo 
	'<head>
		<title>Posted</title>
		<link rel="stylesheet" href="./cms.css">
	</head>
	<body>
	<div class="wrapper">
	<div class="heading">Posted Article!</div>
	<div class="formNewArticle">';
		
		
	if($testMode != 1) {
		if($url != '') {
			echo "Article URL: ".$url;
			echo "<br> Title: ".$title;
			echo "<br> Author: ".$author;
			echo "<br> Body: ".$body; 
			echo "<br> Category: ".$category;
			echo "<br> Type: ".$type; 
			$old = umask(0);
			mkdir('articles/'.$url, 0777);
			umask($old);
			mysql_query("INSERT INTO articles (url, title, author, category, type) VALUES ('$url', '$title', '$author','$category','$type')");
			$filename = "articles/".$url."/text.html";
			$handle = fopen($filename, 'w');
			fwrite($handle, $body);
			fclose($handle);
			echo "<br><br>Done";
		} else {
			echo "<meta http-equiv='REFRESH' content='0;url=/cms/?a=newArticle&invalid=1'>";
		}
	}	else {
			echo "Article URL: ".$url;
			echo "<br> Title: ".$title;
			echo "<br> Author: ".$author;
			echo "<br> Body: ".$body; 
			echo "<br> Category: ".$category;
			echo "<br> Type: ".$type; 
	}
	
	echo '<div class="postButtonDiv">
				<INPUT class="postButton" TYPE="submit" VALUE="View Article">
			</div> 
			</div> 
			</div> 
			</body>';

	mysql_close($con);
?>