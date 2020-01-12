<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    if($_COOKIE['loggedIn'] == '') {
      $page_title = 'Login';
    } else {
      $page_title = 'My Cabinet';
    }
    require 'blocks/head.php';
  ?>
</head>
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<?php require 'blocks/header.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container mt-6">
    <div class="row">
      <div class="col-md-8">
        <?php if($_COOKIE['loggedIn'] == ''): ?>
        <h4>Login</h4>
        <form>
          <label class="mt-2" for="login">Login</label>
            <input class="form-control" id='login' type="text" name="login" autofocus required>

          <label class="mt-2" for="password">Password</label>
            <input class="form-control" id='password' type="text" name="password" required>

          <button style="display:block;" class="btn btn-outline-info mt-3 mb-3" type="button" id="loginButton">Login</button>
          <span style="float:left; display:none" class="alert alert-danger mt-2 mb-2" id='errorMsg'>Error</span>
        </form>
      <?php else: ?>
        <h2>Hello, <?=$_COOKIE['loggedIn']?>!</h2>
        <button class="btn btn-outline-danger mt-2 mb-2" type="button" id="logoutButton">Log Out</button>
      <?php endif; ?>
      </div>
      <?php require 'blocks/aside.php'; ?>
    </div>
  </div>
</main>
<?php require 'blocks/footer.php'; ?>
<script>
  const loginButton = document.getElementById('loginButton')
  const errorBlock = document.getElementById('errorMsg')
  const logoutButton = document.getElementById('logoutButton')

  if (loginButton) {
    loginButton.addEventListener('click', function() {
      const login = document.getElementById('login').value
      const password = document.getElementById('password').value

      const xhr = new XMLHttpRequest()
      const method = 'POST'
      const url = 'modules/login.php'
      //const data = `name=${name}&email=${email}&login=${login}&password=${password}`

      const data = new FormData()
      data.append('login', login)
      data.append('password', password)

      xhr.open(method, url, true)
      xhr.onreadystatechange = function() {
        if (xhr.responseText != 'Passed') {
          errorBlock.innerHTML = xhr.responseText
          errorBlock.style.display = 'block'
        } else if (xhr.readyState === XMLHttpRequest.DONE
            && xhr.status === 200
            && xhr.responseText == 'Passed') {
          loginButton.innerHTML = 'You are logged in!'
          errorBlock.style.display = 'none'
          document.location.reload(true)
        }
      }

      // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.setRequestHeader("enctype", "multipart/form-data");
      xhr.send(data)
    })
  } else {
    logoutButton.addEventListener('click', function() {
      const xhr = new XMLHttpRequest()
      const method = 'POST'
      const url = 'modules/logout.php'

      const login = '<?=$_COOKIE['loggedIn']?>'

      xhr.open(method, url, true)
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE
          && xhr.status === 200
          && xhr.responseText == 'LoggedOut') {
            document.location.reload(true)
          }
        }

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(login)
      })
  }
</script>
</body>
</html>
