<?php
include dirname(__FILE__, 1) . '/components/header.php';
require_once dirname(__FILE__, 1) . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
  $subject = mysqli_real_escape_string(CONN, $_POST["subject"]);
  $emails = mysqli_real_escape_string(CONN, $_POST["emails"]);
  $csv = $_FILES['csv']['name'];
  $csv_type = $_FILES['csv']['type'];
  $csv_tmp = $_FILES['csv']['tmp_name'];
  $templates = mysqli_real_escape_string(CONN, $_POST["templates"]);

  if (empty($emails)) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($csv) && in_array($csv_type, $file_mimes)) {

      $arr_file = explode('.', $csv);
      $extension = end($arr_file);

      if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
      } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      }

      $spreadsheet = $reader->load($csv_tmp);

      $sheetData = $spreadsheet->getActiveSheet()->toArray();

      if (!empty($sheetData)) {
        $emails = [];
        $emailArray = $sheetData;
        foreach ($emailArray as $email) {
          $emails[] = $email[0];
        }
      }
    }
  } else {
    $emails = explode('\r\n', $emails);
  }

  foreach ($emails as $key => $email) {
    $date = date('M d, Y h:i:s');
    // Sending Email
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug  = 0;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = SMTP_USER;                     //SMTP username
      $mail->Password   = SMTP_PASS;                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom(FROM["email"], FROM["name"]);
      $mail->addAddress($email);     //Add a recipient

      //Content
      // Getting content from selected template
      $template = TEMPLATE_DIR . $templates . '/template/index.html';
      $template = file_get_contents($template);
      $template = str_replace('src="', 'src="' . WEBSITE . $template, $template);
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $template;

      $mail->send();
      $logs[] = "Email sent to $email at $date";
      $sent = 1;
    } catch (Exception $e) {
      $logs[] = "Couldn't send email to $email at $date";
      $sent = 0;
    }
    // Adding email to database
    mysqli_query(CONN, "INSERT INTO emails (email, sent, at) VALUES ('{$email}', '{$sent}', '{$date}')");
  }
}

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Send Email</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Send Email</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php if (isset($logs)) : ?>
    <section class="section">
      <div style="height: 300px; border: 1px solid #ddd; background: #eee; margin-bottom: 1rem; border-radius: 0.3rem; padding: 0.5rem 0.7rem; overflow: auto">
        <?php
        foreach ($logs as $log) echo "<div>{$log}</div>";
        ?>
      </div>
    </section>
  <?php endif; ?>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Send Email</h5>

        <!-- Send Email -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="subject" name="subject" placeholder="Sign Up" required>
              <label for="subject">Email Subject</label>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" placeholder="Emails" id="emails" name="emails" style="height: 100px;"></textarea>
              <label for="emails">Emails</label>
            </div>
            <p>or</p>
            <div class="mb-3">
              <label for="csv" class="form-label">CSV</label>
              <input type="file" class="form-control" id="csv" name="csv">
            </div>
            <div class="form-floating mb-3">
              <select class="form-select" name="templates" id="templates" required>
                <option selected hidden value="">Select a Email Template</option>
                <?php
                $files = scandir(TEMPLATE_DIR);
                unset($files[0]);
                unset($files[1]);
                foreach ($files as $file) :
                ?>
                  <option value="<?= $file ?>"><?= $file ?></option>
                <?php endforeach; ?>
              </select>
              <label for="templates">Email Template</label>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Send Emails</button>
          </div>
        </form><!-- End General Form Elements -->
      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php include dirname(__FILE__, 1) . '/components/footer.php'; ?>