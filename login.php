<?php
include dirname(__FILE__, 1) . '/inc/config.php';

// Checking user is logged in
if (isset($_COOKIE['USER_LOGGED'])) {
  header('Location: index');
  exit;
}

$msg = "";
if (isset($_POST["login"])) {
  $username = mysqli_real_escape_string(CONN, $_POST['username']);
  $password = mysqli_real_escape_string(CONN, $_POST['password']);

  if ($username == "" || $password == "") {
    $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username or password is empty.</div>";
  } else {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query(CONN, $sql);
    if (mysqli_num_rows($result) > 0) {
      $userinfo = mysqli_fetch_assoc($result);
      $password = password_verify($password, $userinfo['password']);

      if ($password) {
        setcookie("USER_LOGGED", $username, time() + 345600, "/");
        header("Location: index");
      } else {
        $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username or password is incorrect.</div>";
      }
    } else {
      $msg = "<div class='alert alert-danger'><strong>Error!</strong> Username or password is incorrect.</div>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include dirname(__FILE__, 1) . '/components/head.php'; ?>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<?= WEBSITE ?>" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?= WEBSITE_NAME ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="py-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <?= $msg ?>

                  <form class="row g-3 needs-validation" action="" method="POST">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="login" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

</body>

</html>