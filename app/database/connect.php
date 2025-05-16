<?php
$user = "root";
$pass = "";

// DBと接続
try {
    // PDOオブジェクトを作成
    $pdo = new PDO('mysql:host=localhost;dbname=2ch-bbs', $user, $pass);
    // echo "DBとの接続に成功しました";
} catch (PDOException $e) {
    // 接続失敗時のエラーメッセージ
    echo $e->getMessage();  
}
