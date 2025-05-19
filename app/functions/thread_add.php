<?php
  $error_message = array();

  if(isset($_POST["threadSubmitButton"])) {
    // スレッド名入力チェック
    if (empty($_POST["title"])) {
      $error_message["title"] = "タイトルを入力してください";
    } else {
      // エスケープ処理
      $escaped["title"] = htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
    }
    // ユーザ名入力チェック
    if (empty($_POST["username"])) {
      $error_message["username"] = "名前を入力してください";
    } else {
      // エスケープ処理
      $escaped["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    }
    // コメント入力チェック
    if (empty($_POST["body"])) {
      $error_message["body"] = "コメントを入力してください";
    } else {
      // エスケープ処理
      $escaped["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
    }

    if (empty($error_message)) { 
      $post_date = date("Y-m-d H:i:s");
      //スレッドを作成
      $sql = "INSERT INTO thread (title) VALUES (:title);";
      $statement = $pdo->prepare($sql);

      //値をセット
      $statement->bindParam(":title", $escaped["title"], PDO::PARAM_STR);

      $statement->execute();

      // コメント作成
      $sql = "INSERT INTO comment (username, body, post_date, thread_id) 
              VALUES (:username, :body, :post_date, (SELECT id FROM thread WHERE title = :title))";
      $statement = $pdo->prepare($sql);

      // 値をセット
      $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
      $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
      $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
      $statement->bindParam(":title", $_POST["title"], PDO::PARAM_STR);

      // 実行
      $statement->execute();
    }
    
    // 掲示板一覧に遷移
    header("Location: http://localhost:8080/2ch-bbs");
  }
?>