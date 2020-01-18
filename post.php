<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    require_once 'db_connect.php';

    $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
    $id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id]);

    $post = $query->fetch(PDO::FETCH_OBJ);

    date_default_timezone_set('America/New_York');
    $date = date('l jS \of F Y h:i:s A', $post->date);

    $page_title = $post->title;
    require 'blocks/head.php';
  ?>
</head>
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<?php require 'blocks/header.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container mt-6">
    <div class="row">
      <div class="col-md-8">
        <div class="jumbotron">
          <?php
            echo "
              <h3>$post->title</h3>
              <p class='mb-4'>By <b>$post->author</b>, $date</p>
              <p><i>$post->intro</i></p>
              <p>$post->posttext</p>
            ";
           ?>
        </div>

        <div class="comments p-3 mb-3">
          <h3 class="mb-3">Comments</h3>
          <?php
            if ($_POST['author'] != '' && $_POST['comment'] != '') {
              $author = trim(filter_var($_POST['author'], FILTER_SANITIZE_STRING));
              $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));

              $sql_add_comment = 'INSERT INTO `comments`(`author`, `comment`, `post_id`, `date`)
                      VALUES (:author, :comment, :post_id, :date)';
              $query = $pdo->prepare($sql_add_comment);
              $query->execute([
                'author' => $author,
                'comment' => $comment,
                'post_id' => $_GET['id'],
                'date' => time()
              ]);
            }

            $sql_comments = 'SELECT * FROM `comments` WHERE `post_id` = :id ORDER BY `id` DESC';
            $query = $pdo->prepare($sql_comments);
            $query->execute(['id' => $_GET['id']]);
            $comments = $query->fetchAll(PDO::FETCH_OBJ);

            date_default_timezone_set('America/New_York');

            foreach ($comments as $comment) {
              $date = date('l jS \of F Y h:i:s A', $comment->date);
              echo "<h5>$comment->author</h5>
                    <small>$date</small>
                    <p class='mb-3'>$comment->comment</p>";
            }
           ?>
         </div>


      </div>
      <aside class="commentForm col-md-4">
        <div class="p-3 mb-3 bg-warning rounded">
          <h3>Add a comment</h3>
          <form action="/post?id=<?=$_GET['id']?>" method="post">
            <label class="mt-2" for="author">Your name</label>
              <input class="form-control" id='author' type="text" name="author" autofocus required>

            <label class="mt-2" for="comment">Comment</label>
              <textarea class="form-control" id='comment' name="comment" required></textarea>

            <button style="display:block;" class="btn btn-outline-dark mt-3 mb-3" type="submit" id="addCommentButton">Add comment</button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</main>
<?php require 'blocks/footer.php'; ?>
</body>
</html>
