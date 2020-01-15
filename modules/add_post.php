<?php
  $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
  $intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
  $posttext = trim(filter_var($_POST['posttext'], FILTER_SANITIZE_STRING));

  require_once '../db_connect.php';

  $sql = 'INSERT INTO `articles`(`title`, `intro`, `posttext`, `date`, `author`)
          VALUES (:title, :intro, :posttext, :date, :author)';
  $query = $pdo->prepare($sql);
  $query->execute([
    'title' => $title,
    'intro' => $intro,
    'posttext' => $posttext,
    'date' => time(),
    'author' => $_COOKIE['loggedIn']
  ]);


 ?>
