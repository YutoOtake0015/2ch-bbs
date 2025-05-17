<?php
$user = "root";
$pass = "";


try {
    $pdo = new PDO('mysql:host=localhost;dbname=2ch-bbs;charset=utf8', $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続に失敗しました: " . $e->getMessage());
}

