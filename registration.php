<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    $page_title = 'Registration';
    require 'blocks/head.php';
  ?>
</head>
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<?php require 'blocks/header.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container mt-6">
    <div class="row">
      <div class="col-md-8">
        <h4>Registration</h4>
        <form>
          <label class="mt-2" for="name">Full name</label>
            <input class="form-control" id='name' type="text" name="name" autofocus required>

          <label class="mt-2" for="email">Email</label>
            <input class="form-control" id='email' type="text" name="email" required>

          <label class="mt-2" for="login">Login</label>
            <input class="form-control" id='login' type="text" name="login" required>

          <label class="mt-2" for="password">Password</label>
            <input class="form-control" id='password' type="text" name="password" required>

          <button style="display:block;" class="btn btn-outline-success mt-3 mb-3" type="button" id="regButton">Register</button>
          <span style="float:left; display:none" id='errorMsg' class="alert alert-danger mt-2 mb-2">Error</span>
        </form>
      </div>
      <?php require 'blocks/aside.php'; ?>
    </div>
  </div>
</main>
<?php require 'blocks/footer.php'; ?>
<script>
  document.getElementById('regButton').addEventListener('click', function() {
    const name = document.getElementById('name').value
    const email = document.getElementById('email').value
    const login = document.getElementById('login').value
    const password = document.getElementById('password').value

    const xhr = new XMLHttpRequest()
    const method = 'POST'
    const url = 'modules/register.php'
    //const data = `name=${name}&email=${email}&login=${login}&password=${password}`

    const data = new FormData()
    data.append('name', name)
    data.append('email', email)
    data.append('login', login)
    data.append('password', password)

    let errorMsg = null;

    if(data.get('name').length < 3) {
      errorMsg = 'Name should be 3 characters or more.'
    } else if (data.get('email').length < 6) {
        errorMsg = 'Email should be 6 characters or more.'
    } else if (data.get('login').length < 3) {
        errorMsg = 'Login should be 3 characters or more.'
    } else if (data.get('password').length < 3) {
        errorMsg = 'Password should be 3 characters or more.'
    } else {
      document.getElementById('errorMsg').style.display = 'none'
      errorMsg = null
    }

    xhr.open(method, url, true)
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200 && errorMsg === null) {
        document.getElementById('regButton').innerHTML = "You've been registered!"
        // todo clear form on success
      } else if (errorMsg) {
        document.getElementById('errorMsg').innerHTML = errorMsg
        document.getElementById('errorMsg').style.display = 'block'
      }
    }
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("enctype", "multipart/form-data");
    xhr.send(data)
  })
</script>
</body>
</html>
