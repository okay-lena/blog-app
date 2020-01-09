<?php
  $host = 'localhost';
  $dbname = '';
  $dbuser = '';
  $dbpassword = '';

  $dsn = 'mysql:host='.$host.';dbname='.$dbname;

  $pdo = new PDO($dsn, $dbuser, $dbpassword);
 ?>
