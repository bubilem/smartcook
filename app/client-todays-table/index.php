<?php
require_once "conf.php";
require_once "app/SmartCookClient.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo BASE ?>" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Today's Table</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.min.css?v=1" />
  </head>
  <body>
    <header>
      <div class="container">
        <div>
          <h1>Today's Table</h1>
          <p>Generator of random meals for the whole day</p>
        </div>
        <div>
          <a href="" class="btn">another day</a>
        </div>        
      </div>
    </header>
    <main>
      <div class="container">
        <div class="recipes"><?php include "app/recipes.php"; ?></div>        
      </div>
    </main>
    <footer>
      <div class="container">
        <p>&copy;<?php echo date("Y") ?> Today's Table</p>
      </div>
    </footer>
  </body>
</html>
