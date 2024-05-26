<?php
/*
 * Komunikuje s SmartCook API a vytvori HTML stranku s recepty
 * 
 * Tento skript je volán JS skriptem z hlavní webové stránky po jejím načtení v okně prohlížeče.
 * 
 */

require_once __DIR__ . "/../conf.php";
require_once __DIR__ . "/../app/SmartCookClient.php";
$scc = new SmartCookClient(API_URL, API_SENDER, API_SMARTCOOK);

$request_data["recipe_id"] = filter_input(INPUT_GET, "recipe_id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
try {
    $data = $scc->setRequestData($request_data)->sendRequest("recipe")->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
if (empty($data['data'])) {
    echo '<p>Recipe not found</p>';
    exit;
}
$r = $data['data'];

try {
    $data = $scc->clear()->sendRequest("structure")->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
if (empty($data['data'])) {
    echo '<p>Structure not found</p>';
    exit;
}
$structure = $data["data"];

$dish_category = [];
foreach ($r['dish_category'] as $key) {
    $dish_category[] = $structure['dish_category'][$key];
}
$dish_category = implode(', ', $dish_category);

$recipe_category = [];
foreach ($r['recipe_category'] as $key) {
    $recipe_category[] = $structure['recipe_category'][$key];
}
$recipe_category = implode(', ', $recipe_category);

$tolerance = [];
foreach ($r['tolerance'] as $key) {
    $tolerance[] = $structure['tolerance'][$key];
}
$tolerance = implode(', ', $tolerance);

require_once __DIR__ . "/../app/Template.php";

$ingredients = "";
$tmpltIngredient = new Template(__DIR__ . "/../view/recipe-ingredient.html");
foreach ($r["ingredient"] as $i) {
    $ingredients .= $tmpltIngredient->setData([
        "name" => $i["name"],
        "quantity" => $i["quantity"] . " " . $i["unit"],
        "comment" => "<p>" . $i["comment"] . "</p>",
    ])->render();
}
echo (
    new Template(
        __DIR__ . "/../view/recipe-detail.html",
        [
            "id" => $r["id"],
            "name" => ucfirst($r["name"]),
            "difficulty" => $structure["difficulty"][$r["difficulty"]],
            "duration" => $r["duration"],
            "price" => $structure["price"][$r["price"]],
            "country" => $r["country"],
            "dttm" => substr($r["dttm"], 0, 10),
            "author" => $r["author"],
            "dish_category" => $dish_category,
            "recipe_category" => $recipe_category,
            "tolerance" => $tolerance,
            "description" => $r["description"],
            "ingredients" => $ingredients,
            "data" => json_encode($r, JSON_PRETTY_PRINT),
            "href" => API_URL . "image/{$r["id"]}.webp"
        ]
    )
)->render();
