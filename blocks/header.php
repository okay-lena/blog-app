<header>
<!-- Fixed navbar -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="/">Blog</a>
  <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <div>
      <?php if($_COOKIE['loggedIn'] == ''): ?>
        <a class="btn btn-info my-2 my-sm-0" href="/login">Login</a>
        <a class="btn btn-success my-2 my-sm-0" href="/registration">Registration</a>
      <?php else: ?>
        <a class="btn btn-success my-2 my-sm-0" href="/new-post">New Post</a>
        <a class="btn btn-info my-2 my-sm-0" href="/login">My Cabinet</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
</header>
<script>
  const toggler = document.getElementById('navbar-toggler')
  const menu = document.getElementById('navbarCollapse');

  toggler.addEventListener('click', function() {
    if (menu.getAttribute('class').includes('show')) {
      menu.setAttribute('class', 'collapse navbar-collapse')
    } else {
      menu.setAttribute('class', 'collapse navbar-collapse show')
    }
  })
</script>
