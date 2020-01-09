<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    $page_title = 'Blog';
    require 'blocks/head.php';
  ?>
</head>
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<?php require 'blocks/header.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container mt-6">
    <div class="row">
      <div class="col-md-8">
        <?php
          require_once 'db_connect.php';

          $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC';
          $query = $pdo->query($sql);
          while($row = $query->fetch(PDO::FETCH_OBJ)) {
            date_default_timezone_set('America/New_York');
            $date = date('l jS \of F Y h:i:s A', $row->date);
            echo "<h3>$row->title</h3>
                  <small><b>$row->author</b>, $date</small>
                  <p class='mb-5'>$row->intro &nbsp;&nbsp;
                    <a href='/post?id=$row->id' alt='$row->title'>...read more</a>
                  </p>";
          }
         ?>
      </div>
      <?php require 'blocks/aside.php'; ?>
    </div>
  </div>
</main>
<?php require 'blocks/footer.php'; ?>
</body>
</html>
