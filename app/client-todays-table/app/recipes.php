<?php
$scc = new SmartCookClient(API_URL, API_SENDER, API_SMARTCOOK);
try {
    $data = $scc->sendRequest("structure")->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
if (empty($data['data'])) {
    echo '<p>Structure not found</p>';
    exit;
}
$structure = $data["data"];

generate_meal($scc, $structure, "Breakfast", 1);
generate_meal($scc, $structure, "Soup", 2);
generate_meal($scc, $structure, "Main course", 3);
generate_meal($scc, $structure, "Dessert", 4);
generate_meal($scc, $structure, "Dinner", 5);


function generate_meal(SmartCookClient $scc, array $structure, string $caption, int $dish_id)
{
    echo "<div class=\"recipe\">";
    echo "<h2>$caption</h2>";
    try {
        $data = $scc->clear()->setRequestData([
            "attributes" => ["id"],
            "filter" => ["dish_category" => [$dish_id]],
        ])->sendRequest("recipes")->getResponseData();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if (empty($data['data'])) {
        echo '<p>No recipes</p>';
        exit;
    }
    $recipe_id = $data["data"][mt_rand(0, count($data["data"]) - 1)]['id'];
    try {
        $data = $scc->clear()->setRequestData(["recipe_id" => $recipe_id])->sendRequest("recipe")->getResponseData();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if (empty($data['data'])) {
        echo '<p>Recipe not found</p>';
        exit;
    }
    $r = $data['data'];
    $tolerance = [];
    foreach ($r['tolerance'] as $key) {
        $tolerance[] = $structure['tolerance'][$key];
    }
    $r['tolerance'] = implode(', ', $tolerance);

    $ingredients = [];
    foreach ($r["ingredient"] as $i) {
        $ingredients[] = [
            "name" => $i["name"],
            "quantity" => $i["quantity"] . " " . $i["unit"],
            "comment" => $i["comment"]
        ];
    }
    $r['ingredients'] = $ingredients;
    $r['name'] = ucfirst($r["name"]);
    $r["difficulty"] = $structure["difficulty"][$r["difficulty"]];
    $r["duration"] = $r["duration"] . " minutes";
    $r["price"] = $structure["price"][$r["price"]];
    $r["dttm"] = substr($r["dttm"], 0, 10);
    $r["src"] = API_URL . "image/{$r["id"]}.webp";
    echo "<h3>{$r['name']}</h3>";
    echo "<img src='{$r['src']}' alt='{$r['name']}'>";
    echo "<p>{$r['description']}</p>";
    echo "<ul class=\"ingredients\">";
    foreach ($r['ingredients'] as $i) {
        echo "<li>";
        echo "<p><srong>{$i['quantity']} {$i['name']}</strong></p>";
        if (!empty($i['comment'])) {
            echo "<p>{$i['comment']}</p>";
        }
        echo "</li>";
    }
    echo "</ul>";
    echo "</div>";
}