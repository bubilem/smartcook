<?php
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
require_once "conf.php";
spl_autoload_register(function (string $className) {
    $path = "app/$className.php";
    if (file_exists($path)) {
        require_once $path;
    } else {
        exit("Class $className not found!");
    }
});

$r = new Recipe();
$scc = new SmartCookClient(API_URL, [], API_SMARTCOOK);

if ($_POST['action'] == 'validate recipe' || $_POST['action'] == 'add recipe to the database') {
    $r->name = filter_input(INPUT_POST, 'name');
    $r->difficulty = filter_input(INPUT_POST, 'difficulty');
    $r->duration = filter_input(INPUT_POST, 'duration');
    $r->price = filter_input(INPUT_POST, 'price');
    $r->description = filter_input(INPUT_POST, 'description');
    $r->country = filter_input(INPUT_POST, 'country');
    $r->ingredient = $_POST['ingredient'] ?? [];
    $r->dish_category = $_POST['dish_category'] ?? [];
    $r->recipe_category = $_POST['recipe_category'] ?? [];
    $r->tolerance = $_POST['tolerance'] ?? [];
    $r->author = $_POST['author_name'] ?? '';

    try {
        $response = $scc
            ->setSender([
                'id' => filter_input(INPUT_POST, 'author_id'),
                'name' => filter_input(INPUT_POST, 'author_name'),
                'secret' => filter_input(INPUT_POST, 'author_password'),
            ])
            ->setRequestData(["data" => $r->data])
            ->sendRequest($_POST['action'] == 'add recipe to the database' ? "recipe-add" : "recipe-validate")
            ->getResponseData();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $message = new Template('message');
    if (empty($response['stat'])) {
        $message->setData(['stat' => "fail", 'message' => "Ugh..."]);
    } else {
        $message->setData(['stat' => $response['stat'], 'message' => $response['mess'] ?? ""]);
    }

}


//var_dump($r->data);
$form = [
    "name" => $r->name,
    "duration" => $r->duration,
    "description" => $r->description,
    "country" => $r->country,
    "author_id" => $_POST['author_id'] ?? '',
    "author_name" => filter_input(INPUT_POST, 'author_name'),
    "password" => "",
];
for ($i = 1; $i <= 9; $i++) {
    if ($i <= 3) {
        $form["difficulty_$i"] = $r->difficulty == $i ? "selected" : "";
        $form["price_$i"] = $r->price == $i ? "selected" : "";
    }
    if ($i <= 5) {
        $form["dish_category_$i"] = in_array($i, $r->dish_category) ? "checked" : "";
    }
    $form["recipe_category_$i"] = in_array($i, $r->recipe_category) ? "checked" : "";
    $form["tolerance_$i"] = in_array($i, $r->tolerance) ? "checked" : "";
}
$ing_tmplt = new Template("form-ingredient");
$form["ingredients"] = "";
foreach ($r->ingredient as $key => $value) {
    $form["ingredients"] .= (string) $ing_tmplt->setData(
        [
            "key" => $key + 1,
            "id" => $value["id"] ?? "",
            "name" => $value["name"] ?? "",
            "quantity" => $value["quantity"] ?? "",
            "unit_l" => $value["unit"] == "l" ? "selected" : "",
            "unit_g" => $value["unit"] == "g" ? "selected" : "",
            "unit_pc" => $value["unit"] == "pc" ? "selected" : "",
            "necessary" => !empty($value["necessary"]) ? "checked" : "",
            "comment" => $value["comment"] ?? "",
        ]
    );
}


try {
    $data = $scc->setRequestData([])->sendRequest("ingredients")->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
$ingredients_rows = "";
if (!empty($data['data'])) {
    $ing_row_tmplt = new Template("ingredients-row");
    foreach ($data['data'] as $val) {
        $ingredients_rows .= (string) $ing_row_tmplt->setData(
            [
                "id" => $val['id'],
                "name" => $val['name'],
                "number_of_uses" => $val['number_of_uses']
            ]
        );
    }
}

echo new Template(
    "page",
    [
        'message' => $message ?? '',
        'main' => new Template("form", $form),
        "aside" => new Template("ingredients-table", [
            "rows" => $ingredients_rows
        ]),
    ]
);
