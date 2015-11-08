<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Setup - Tecuno</title>
  <link rel="stylesheet" href="./cms.css">
  <link rel="icon" type="image/png" href="/favicon.ico" />
</head>

<body>
  <div class="outerWrapper">
  <div class="wrapper">
    <div class="heading">Database Details</div>
    <form id="login" action="?a=newArticle" method="post">
      <input type="text" name="host" placeholder="Hostname">
      <input type="text" name="database" placeholder="Database Name">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <br>
      <br>
      <input type="submit" class="postButton" value="Submit">
    </form>
  </div>
</body>