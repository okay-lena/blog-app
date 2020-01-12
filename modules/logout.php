<?php
  setcookie('loggedIn', $login, time() - 3600 * 24 * 30, "/");
  //unset($_COOKIE['loggedIn']);
  echo 'LoggedOut';
 ?>
