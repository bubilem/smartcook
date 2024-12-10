<?php
require "parts/conf.php";
require "parts/init.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?php echo Conf::BASE; ?>" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php include "parts/description.php"; ?>" />
  <meta name="keywords" content="<?php include "parts/keywords.php"; ?>" />
  <title><?php include "parts/title.php"; ?></title>

  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
  <link rel="manifest" href="img/favicon/site.webmanifest">
  <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#ee4477">
  <link rel="shortcut icon" href="img/favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#373030">
  <meta name="msapplication-config" content="img/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" href="css/style.min.css?v=4" />
</head>

<body>
  <?php include "parts/header.php"; ?>
  <div class="container">
    <main>
      <?php include "pages/{$page["url"]}/content.php"; ?>
    </main>
    <?php include "parts/aside.php"; ?>
  </div>
  <?php include "parts/footer.php"; ?>
</body>

</html>