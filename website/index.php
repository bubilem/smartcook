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
  <link rel="stylesheet" href="css/style.min.css" />
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