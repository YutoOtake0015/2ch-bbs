<?php

// DB接続情報
  include_once "./app/database/connect.php";

  if (isset($_POST["submitButton"])){
    // 送信されたデータを取得
    $usrname = $_POST["username"];
    $body = $_POST["body"];
    var_dump($usrname);
    var_dump($body);
  }

  $comment_array = array();

  // コメントデータをテーブルから取得してくる
  $sql = "SELECT * FROM comments";
  $statement = $pdo -> prepare($sql);
  $comment_array =  execute();
  $comment_array = $statement;

  // var_dump($comment_array->fetchAll());

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>2ちゃんねる掲示板</title>
  </head>
  <body>
    <header>
      <h1 class="title">2ちゃんねる掲示板</h1>
      <hr />
    </header>
    
    <div class="threadWrapper">
      <div class="childWrapper">
        <div class="threadTitle">
          <span>【タイトル】</span>
          <h1>作ってみる</h1>
        </div>
        <section>
          <?php foreach ($comment_array as $comment): ?>
          <article>
            <div class="wrapper">
              <div class="nameArea">
                <span>名前: </span>
                <p class="username">わたし</p>
                <time>: 2025/05/13 22:44 </time>
              </div>
              <p class="comment"><?php echo $comment["body"]; ?></p>
            </div>
          </article>
          <?php endforeach ?>
        </section>
        <form class="formWrapper" method="POST">
          <div>
            <input type="submit" value="書き込む" name="submitButton" />
            <label>名前:</label>
            <input type="text" name='username' />
          </div>
          <div>
            <textarea class="commentsTextArea" name="body"></textarea>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
