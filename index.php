<?php include dirname(__FILE__, 1) . '/components/header.php'; ?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <?php
    $total = mysqli_num_rows(mysqli_query(CONN, "SELECT * FROM emails"));
    $sent = mysqli_num_rows(mysqli_query(CONN, "SELECT * FROM emails WHERE sent='1'"));
    $failed = mysqli_num_rows(mysqli_query(CONN, "SELECT * FROM emails WHERE sent='0'"));
    ?>
    <div class="row">
      <!-- Card -->
      <div class="col-md-4">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Total Email</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="ps-3">
                <h6><?= $total ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Card -->
      <!-- Card -->
      <div class="col-md-4">
        <div class="card info-card revenue-card">
          <div class="card-body">
            <h5 class="card-title">Total Email Sent</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="ps-3">
                <h6><?= $sent ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Card -->
      <!-- Card -->
      <div class="col-md-4">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Total Email Failed</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="ps-3">
                <h6><?= $failed ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Card -->
    </div>
  </section>
</main>
<?php include dirname(__FILE__, 1) . '/components/footer.php'; ?>