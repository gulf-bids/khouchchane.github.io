<?php

define("HOSTNAME", "156.67.73.181"); // Change this to your database Hostname. By default it should be localhost
define("USERNAME", "u222542979_emailmarketing"); // Change this to your Database Username
define("PASSWORD", "b2KXGJZRk@"); // Change this to your Database Password
define("DATABASE", "u222542979_emailmarketing"); // Change this to your Database Password

define("FROM", [
  "email" => "contact@codmorocco.com", // Change this to your From email (means from which email the email will send)
  "name" => "CodMorocco" // Change this to your From name
]);
define("SMTP_HOST", "smtp.hostinger.com"); // Change it to your SMTP Hostname
define("SMTP_USER", "contact@codmorocco.com"); // Change it to your SMTP Email
define("SMTP_PASS", "HamidAbdelmajid@@??00"); // Change it to your SMTP Password
define("SMTP_PORT", 465); // Change it to your SMTP Port

define("CONN", mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)); // Connecting to database
define("WEBSITE", "https://codmorocco.com/email-marketing/"); // Change it to your app URL
define("WEBSITE_NAME", "Email Marketing"); // Change it to your website name
define("TEMPLATE_DIR", "templates/"); // Template directory
