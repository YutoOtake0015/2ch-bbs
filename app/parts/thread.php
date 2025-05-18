<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include_once("app/database/connect.php");
  include_once("app/functions/comment_get.php");
?>

<div class="threadWrapper">
    <div class="childWrapper">
        <div class="threadTitle">
            <span>【タイトル】</span>
            <h1>作ってみる</h1>
        </div>
        <?php include("commentSection.php"); ?>
        <?php include("commentForm.php"); ?>
    </div>
</div>