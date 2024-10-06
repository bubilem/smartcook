<?php
require_once "conf.php";
require_once "SmartCookClient.php";
$scc = new SmartCookClient(API_URL, API_SENDER, API_SMARTCOOK);
$request_data = [
    "attributes" => ["id", "name"],
    "filter" => [
        "ingredient" => array_map('intval', explode(",", filter_input(INPUT_GET, "ingredients")))
    ]
];
//var_dump($request_data);
try {
    $response = $scc
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
if (!empty($response['data'])) {

    try {
        $response_str = $scc
            ->sendRequest("structure")
            ->getResponseData();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $strucure = $response_str['data'];

    foreach ($response['data'] as $recipe) {
        try {
            $response_recipe = $scc
                ->setRequestData(["recipe_id" => $recipe['id']])
                ->sendRequest("recipe")
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if (empty($response_recipe['data'])) {
            continue;
        }
        $r = $response_recipe['data'];
        echo '<div class="recipe">';
        echo '<h2>' . $r['name'] . '</h2>';
        echo '<img src="https://www.smartcook-project.eu/api/image/' . $r['id'] . '.webp"/>';
        echo '<table class="recipe-details">';
        echo '<tr><td>Author</td><td>' . $r['author'] . '</td></tr>';
        echo '<tr><td>Difficulty</td><td>' . $r['difficulty'] . '</td></tr>';
        echo '<tr><td>Duration</td><td>' . $r['duration'] . ' minutes</td></tr>';
        echo '<tr><td>Price</td><td>' . $r['price'] . '</td></tr>';
        echo '<tr><td>Description</td><td>' . $r['description'] . '</td></tr>';
        echo '<tr><td>Ingredients</td><td>';
        foreach ($r['ingredient'] as $ingredient) {
            echo '<p>' . $ingredient['quantity'] . ' ' . $ingredient['unit'] . ' of ' . $ingredient['name'] . '</p>';
        }
        echo '</td></tr>';
        echo '</table>';
        echo '</div>';
    }
} else {
    echo "<p>no recipes found</p>";
}

