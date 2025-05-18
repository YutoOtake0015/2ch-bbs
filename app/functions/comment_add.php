<?php
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
?>