<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>Tecuno</title>
    <link rel="stylesheet" href="cms.css">
  </head>

  <body>
    <div class="outerWrapper">
      <?php
        if(isset($_GET['a']) && $_GET['a'] == 'login' OR !isset($_GET['a']))
          loginPage(); 

        if(isset($_GET['a']) && $_GET['a'] == 'dash')
          dashboard();

        function loginPage() { ?>
          <h1 class="heading">Login</h1>
          <div class="wrapper login">
            <form id="login" action="?a=dash" method="post">
              <input type="text" name="username" placeholder="Username">
              <input type="password" name="password" placeholder="Password">
              <input type="submit" value="Log In">
            </form>
          </div>
        <?php }

        function dashboard() { ?>

          <h1 class="heading">New Post</h1>   
          <div class="wrapper">
            <form class="newPostForm" action="postarticle.php" method="POST">
              <input type="text" name="title" placeholder="Title">
              <textarea rows="8" cols="47" name="body" placeholder="Your text here" height="200px"></textarea>
              <input class="small" type="text" name="url" placeholder="URL">
              <input class="small" type="text" name="author" placeholder="Author">
              <input class="small" type="text" name="category" placeholder="Category">
              <input class="small" type="text" name="type" placeholder="Type">
              <input type="submit" value="Post">
            </form>
          </div>

          <h1 class="heading">Posts</h1>
          <div class="wrapper listArticles">
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
            if (!$statement -> execute()) { print_r($statement->errorInfo()); }
            $result = $statement -> fetchAll(PDO::FETCH_ASSOC);
            $counter = 0;

            foreach ($result as $row) {
              $articles[$counter] = $row;
              $counter += 1;
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
                echo "<div class='post'>
                  <h2 class='postTitle'><a href='article.php?id=$id&amp;name=$url'>$title</a></h2><p>$blurb …</p><div class='postFooter'>
                    <span class='authorDate'> by $author on $created in <a href='/?filter=$type'>$type</a> </span>
                    <a class='commentCount button' href='?a=edit'>Edit</a>
                  </div></div>";
              }
              $reverseCount ++;
            }}
          ?>
      </div>   <!-- end wrapper -->
      <a href="/" class="backLink">&#9664; back to site</a>
    </div> <!-- end outerWrapper -->
  </body>
</html>