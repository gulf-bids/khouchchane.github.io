<?php
include dirname(__FILE__, 2) . '/inc/config.php';

// Checking user is logged in
if (!isset($_COOKIE['USER_LOGGED'])) {
  header('Location: logout');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include dirname(__FILE__, 2) . '/components/head.php'; ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= WEBSITE ?>assets/img/logo.png" alt="">
        <span class="d-none d-lg-block"><?= WEBSITE_NAME ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">
          <?php
          $sql = "SELECT * FROM users WHERE username='{$_COOKIE["USER_LOGGED"]}'";
          $result = mysqli_query(CONN, $sql);
          if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
          }
          ?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $user['name'] ?></span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $user['name'] ?></h6>
              <span>@<?= $user['username'] ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= WEBSITE ?>logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= WEBSITE ?>index">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= WEBSITE ?>send-email">
          <i class="bi bi-send"></i>
          <span>Send Email</span>
        </a>
      </li><!-- End Send Email Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="https://beefree.io/" target="_blank">
          <i class="bi bi-app-indicator"></i>
          <span>Template Builder</span>
        </a>
      </li><!-- End Template Builder Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= WEBSITE ?>upload-template">
          <i class="bi bi-cloud-arrow-up"></i>
          <span>Upload Template</span>
        </a>
      </li><!-- End Upload Template Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= WEBSITE ?>logout">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Logout Nav -->
    </ul>

  </aside><!-- End Sidebar-->