<?php 

if($_POST['password'] == 'KeyBo@rd') {
	echo('
<head>
	<title>New Article</title>
	<link rel="stylesheet" href="./cms.css">
	<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>
</head>
<body>
<div class="wrapper">
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
</body>');
}
else {
	echo ('<head>
	<title>Tecuno - Wrong Password</title>
	<link rel="stylesheet" href="css/cms.css">
	<meta http-equiv="REFRESH" content="0;url=index.html?wp=1">
</head>
<body>
</body>');
}

?>