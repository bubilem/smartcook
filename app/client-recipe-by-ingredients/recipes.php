<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recipe by ingredients</title>
    <meta name="description" content="SmartCook Recipe by ingredients application" />
    <meta name="author" content="SmartCook" />
    <link rel="icon" type="image/ico" href="favicon.ico" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <h1>Recipe by ingredients</h1>
        <a class="btn" href="index.php">Back to ingredients</a>
    </header>
    <main class="recipes">
        <?php require_once 'app/recipes.php'; ?>
    </main>
</body>

</html>