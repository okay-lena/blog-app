<?php
  $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

  $hash = 'irtaf-3461HDIW084';
  $password = md5($password . $hash);

  require_once '../db_connect.php';

  $sql = 'INSERT INTO `users`(`name`, `email`, `login`, `password`)
          VALUES (:name, :email, :login, :password)';
  $query = $pdo->prepare($sql);
  $query->execute(['name' => $name, 'email' => $email, 'login' => $login, 'password' => $password]);


 ?>
