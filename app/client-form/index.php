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

// form action processing
if (!empty($_POST['action'])) {
    $sender = [
        'id' => filter_input(INPUT_POST, 'author_id'),
        'name' => filter_input(INPUT_POST, 'author_name'),
        'secret' => filter_input(INPUT_POST, 'author_password'),
    ];

    $scc->setSender($sender);
    $r->load_from_post();

    switch ($_POST['action']) {
        case 'load recipe':
            $response = $r->load_recipe($scc);
            break;
        case 'update recipe':
            $response = $r->update_recipe($scc);
            break;
        case 'validate recipe':
            $response = $r->validate_recipe($scc);
            break;
        case 'add recipe':
            $response = $r->add_new_recipe($scc);
            break;
        case 'remove recipe':
            $response = $r->remove_recipe($scc);
            break;
    }

    $message = new Template('message');
    if (empty($response['stat'])) {
        $message->setData(['stat' => "fail", 'message' => "Ugh..."]);
    } else {
        $message->setData(['stat' => $response['stat'], 'message' => $response['mess'] ?? ""]);
    }
}

//form loading
$form = [
    "recipe_id" => $r->id ? $r->id : "",
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
//var_dump($form);

// ingredients list
try {
    $data = $scc->setRequestData([])->sendRequest("ingredients")->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
$ingredients_rows = "";
if (!empty($data['data'])) {
    $ing_row_tmplt = new Template("ingredients-row");
    $ing_button_tmplt = new Template("ingredients-button");
    foreach ($data['data'] as $val) {
        $ing_button_tmplt->setData(["id" => $val['id'], "name" => $val['name']]);
        $ingredients_rows .= (string) $ing_row_tmplt->setData(
            [
                "id" => $val['id'],
                "name" => (string) $ing_button_tmplt,
                "number_of_uses" => $val['number_of_uses']
            ]
        );
    }
}

// main page template
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
