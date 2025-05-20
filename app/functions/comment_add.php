<?php
  $error_message = array();

  if(isset($_POST["submitButton"])) {
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

      // トランザクション開始
      $pdo->beginTransaction();

      try{
        $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`, `thread_id`) 
        VALUES (:username, :body, :post_date, :thread_id);";
        $statement = $pdo->prepare($sql);
  
        //値をセット
        $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
        $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
        $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
        $statement->bindParam(":thread_id", $_POST["thread_id"], PDO::PARAM_STR);
  
        // 実行
        $statement->execute();

        // コミット
        $pdo->commit();
      } catch(Exception $e) {
        // エラーが発生した場合はロールバック
        $pdo->rollBack();
      }

    }    
  }
?>