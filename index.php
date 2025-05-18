<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include_once("./app/database/connect.php");

  $error_message = array();

  if(isset($_POST["submitButton"])) {
    // 入力チェック
    if (empty($_POST["username"])) {
      $error_message["username"] = "名前を入力してください";
    } else {
      // エスケープ処理
      $escped_message["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    }
    if (empty($_POST["body"])) {
      $error_message["body"] = "コメントを入力してください";
    } else {
      // エスケープ処理
      $escped_message["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
    }

    if (empty($error_message)) {      
      $post_date = date("Y-m-d H:i:s");
      $sql = "INSERT INTO comment (username, body, post_date) VALUES (:username, :body, :post_date)";
      $statement = $pdo->prepare($sql);
      
      $statement->bindParam(":username", $escped_message["username"], PDO::PARAM_STR);
      $statement->bindParam(":body", $escped_message["body"], PDO::PARAM_STR);
      $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
      
      $statement->execute();
    }
  }

  $comment_array = array();

  $sql = "SELECT * FROM comment";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $comment_array = $statement->fetchAll(PDO::FETCH_ASSOC);

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
      <!-- バリデーションチェックメッセージ -->
       <?php if(isset($error_message)) : ?>
        <ul class="errorMessage">
          <?php foreach($error_message as $error) : ?>
            <li><?php echo $error ?></li>
          <?php endforeach; ?>
  
        </ul>
      <?php endif; ?>
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
                <p class="username"><?php echo $comment["username"]; ?></p>
                <time>: <?php echo $comment["post_date"]; ?> </time>
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
