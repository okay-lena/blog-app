<?php
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

  $errorMsg = '';

  if(strlen($login) < 3) {
    $errorMsg = 'Login should be 3 characters or more.';
  } else if (strlen($password) < 3) {
    $errorMsg = 'Password should be 3 characters or more.';
  } else {
    $errorMsg = '';
  }

  if($errorMsg != '') {
    echo $errorMsg;
    exit();
  }

  $hash = 'irtaf-3461HDIW084';
  $password = md5($password . $hash);

  require_once '../db_connect.php';

  $sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `password` = :password';
  $query = $pdo->prepare($sql);
  $query->execute(['login' => $login, 'password' => $password]);

  $user = $query->fetch(PDO::FETCH_OBJ);
  // print $user->id;
  if ($user->id == 0) {
    echo "This user or password doesn't exist.";
  } else {
    setcookie('loggedIn', $login, time() + 3600 * 24 * 30, "/");
    echo 'Passed';
  }


 ?>
