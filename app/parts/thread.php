<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include_once("app/database/connect.php");
  include("app/functions/comment_get.php");
  include("app/functions/thread_get.php");
?>

<?php foreach($thread_array as $thread) : ?>
<div class="threadWrapper">
    <div class="childWrapper">
        <div class="threadTitle">
            <span>【タイトル】</span>
            <h1><?php echo $thread["title"] ?></h1>
        </div>
        <?php include("commentSection.php"); ?>
        <?php include("commentForm.php"); ?>
    </div>
</div>
<?php endforeach; ?>