<?php
  session_start();

  include 'config/app.php';

  // Check Log In
  if (isset($_POST['login'])) {
    // ambil input user dan pass
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // check username
    $result = mysqli_query($db, "SELECT * FROM pelanggan WHERE email = '$email'");

    // check password 
    if (mysqli_num_rows($result) == 1) {
      $hasil = mysqli_fetch_assoc($result);

      if (password_verify($password, $hasil['password'])){
        // set session
        $_SESSION['login'] = true;
        $_SESSION['id_pelanggan'] = $hasil['id_pelanggan'];
        $_SESSION['nama'] = $hasil['nama'];
        $_SESSION['email'] = $hasil['email'];
        
        // jika benar
        header("Location: index.php");
        exit;
      }
    }
    // jika tidak ada user / salah
    $error = true;
  }
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/login.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
    <main class="form-signin">
    <form action="" method="post">
        <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="LOGO" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

        <?php if (isset($error)) : ?>
          <div class="alert alert-danger text-center">
            <b>USERNAME / PASSWORD SALAH</b>
          </div>
        <?php endif; ?>

        <div class="form-floating">
        <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Username..." required>
        <label for="floatingInput">Username...</label>
        </div>
        <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password..." required>
        <label for="floatingPassword">Password...</label>
        </div>

        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Log in</button>
        <p class="mt-5 mb-3 text-muted">Copyright &copy; JMK48 <?= date('Y')?></p>
    </form>
    </main>


        
    </body>
</html>
