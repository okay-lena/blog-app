<?php
  if($_COOKIE['loggedIn'] == ''){
    header('Location: /registration');
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    $page_title = 'Create New Post';
    require 'blocks/head.php';
  ?>
</head>
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<?php require 'blocks/header.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container mt-6">
    <div class="row">
      <div class="col-md-8">
        <h4>New Post</h4>
        <form>
          <label class="mt-2" for="title">Title</label>
            <input class="form-control" id='title' type="text" name="title" autofocus required>

          <label class="mt-2" for="intro">Intro</label>
            <textarea class="form-control" id='intro' type="text" name="intro" required></textarea>

          <label class="mt-2" for="posttext">Full Text</label>
            <textarea class="form-control" id='posttext' type="text" name="posttext" required></textarea>

          <button style="display:block;" class="btn btn-outline-success mt-3" type="button" id="addPostBtn">Add Post</button>
          <span style="float:left; display:none" id='errorMsg' class="alert alert-danger mt-2 mb-2">Error</span>
        </form>
      </div>
      <?php require 'blocks/aside.php'; ?>
    </div>
  </div>
</main>
<?php require 'blocks/footer.php'; ?>
<script>
  document.getElementById('addPostBtn').addEventListener('click', function() {
    const title = document.getElementById('title').value
    const intro = document.getElementById('intro').value
    const posttext = document.getElementById('posttext').value

    const xhr = new XMLHttpRequest()
    const method = 'POST'
    const url = 'modules/add_post.php'

    const data = new FormData()
    data.append('title', title)
    data.append('intro', intro)
    data.append('posttext', posttext)

    let errorMsg = null;

    if(data.get('title').length < 3) {
      errorMsg = 'Title should be 3 characters or more.'
    } else if (data.get('intro').length < 10) {
        errorMsg = 'Intro should be 10 characters or more.'
    } else if (data.get('posttext').length < 50) {
        errorMsg = 'Text should be 50 characters or more.'
    } else {
      document.getElementById('errorMsg').style.display = 'none'
      errorMsg = null
    }

    xhr.open(method, url, true)
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200 && errorMsg === null) {
        document.getElementById('addPostBtn').innerHTML = "Post is created!"
        // todo clear form on success
      } else if (errorMsg) {
        document.getElementById('errorMsg').innerHTML = errorMsg
        document.getElementById('errorMsg').style.display = 'block'
      }
    }

    xhr.setRequestHeader("enctype", "multipart/form-data");
    xhr.send(data)
  })
</script>
</body>
</html>
