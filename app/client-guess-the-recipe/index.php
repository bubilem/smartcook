<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guess the Recipe</title>
  <meta name="description" content="SmartCook Guess the Recipe game" />
  <meta name="author" content="SmartCook" />
  <link rel="icon" type="image/ico" href="favicon.ico" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="bg"></div>
  <div id="gameContainer">
    <header>
      <h1>Guess the Recipe</h1>
      <div id="score">score: <span id="correctGuesses">0</span> / <span id="totalGames">0</span></div>
    </header>
    <img id="recipeImage" src="" alt="Recipe image" />
    <div class="options">
      <button class="option" onclick="makeGuess(0)"></button>
      <button class="option" onclick="makeGuess(1)"></button>
      <button class="option" onclick="makeGuess(2)"></button>
      <button class="option" onclick="makeGuess(3)"></button>
    </div>
  </div>
  <?php
  require_once "conf.php";
  require_once "SmartCookClient.php";
  $scc = new SmartCookClient(API_URL, API_SENDER, API_SMARTCOOK);
  try {
    $response = $scc
      ->setRequestData(["attributes" => ["id", "name"]])
      ->sendRequest("recipes")
      ->getResponseData();
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  $recipes = [];
  if (!empty($response['data'])) {
    $recipes = $response['data'];
    foreach ($recipes as $key => $recipe) {
      $recipes[$key]['name'] = ucfirst($recipe['name']);
    }
  }
  ?>
  <script>
    <?php echo "const recipes = " . json_encode($recipes, JSON_UNESCAPED_UNICODE); ?>
  </script>
  <script src="game.js"></script>
</body>

</html>