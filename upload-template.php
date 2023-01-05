<?php include dirname(__FILE__, 1) . '/components/header.php';

$msg = "";
if (isset($_POST["upload"])) {
  $file = $_FILES['template']['name'];
  $file_tmp = $_FILES['template']['tmp_name'];
  $name = $_POST['name'];

  // Checking if template folder is exists
  if (!file_exists(TEMPLATE_DIR . $name . "/")) {
    // Creating directory if it doesn't exists
    mkdir(TEMPLATE_DIR . $name . "/");
  }

  // Getting extension from $file
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  $file = TEMPLATE_DIR . $name . "/template.zip";
  move_uploaded_file($file_tmp, $file);

  // Get the absolute path to $file
  $path = pathinfo(realpath($file), PATHINFO_DIRNAME);

  $zip = new ZipArchive;
  $res = $zip->open($file);
  if ($res === TRUE) {
    // Extract it to the path we determined above
    $zip->extractTo($path);
    $zip->close();
  }

  $msg = "<div class='alert alert-success'>Template uploaded successfully.</div>";
}

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Upload Template</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Upload Template</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Upload Template</h5>

        <?= $msg ?>

        <!-- Upload Template -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <div class="mb-3">
              <label for="name" class="form-label">Template Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="template" class="form-label">Template</label>
              <input type="file" class="form-control" id="template" name="template" required>
              <small>Upload a zip file with images/ folder and index.html</small>
            </div>
            <button class="btn btn-primary" type="submit" name="upload">Upload</button>
          </div>
        </form><!-- End General Form Elements -->
      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php include dirname(__FILE__, 1) . '/components/footer.php'; ?>