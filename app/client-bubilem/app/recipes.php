<?php
/*
 * Komunikuje s SmartCook API a vytvori HTML stranku s recepty
 * 
 * Tento skript je volán JS skriptem z hlavní webové stránky po jejím načtení v okně prohlížeče.
 * 
 */

require_once __DIR__ . "/SmartCookClient.php";

$request_data = ["attributes" => ["id", "name", "description", "author"]];
$recipeCategory = filter_input(INPUT_GET, "recipe-category", FILTER_SANITIZE_NUMBER_INT);
if ($recipeCategory) {
    $request_data["filter"]["recipe_category"] = [$recipeCategory];
}
try {
    $data = (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
if (empty($data['data'])) {
    echo '<p>No recipes</p>';
    exit;
}

$maxlen = 100;
$recipes = "";

require_once __DIR__ . "/Template.php";
$tmpltRecipe = new Template(__DIR__ . "/../view/recipe-thumb.html");
foreach ($data['data'] as $recipe) {
    if (mb_strlen($recipe["description"]) > $maxlen) {
        $desc = mb_substr($recipe["description"], 0, $maxlen) . " ...";
    }
    $recipes .= $tmpltRecipe->setData(
        [
            "id" => $recipe["id"],
            "name" => ucfirst($recipe["name"]),
            "description" => $desc,
            "author" => $recipe["author"]
        ]
    )->render();
}
echo $recipes;
