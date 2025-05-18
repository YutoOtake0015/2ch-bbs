<?php
  $comment_array = array();

  $sql = "SELECT * FROM comment";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $comment_array = $statement->fetchAll(PDO::FETCH_ASSOC);
?>