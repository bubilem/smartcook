<?php
require_once("fce.php");
$url = 'http://www/smartcook/app/api/recipe-add';

$data = [
    "data" => [
        "id" => "1",
        "name" => "Earl Grey",
        "difficulty" => 1,
        "duration" => "5",
        "price" => 1,
        "description" => "We will prepare a cup for tea. Bring 250 ml of water to a boil. Place the tea bag in a cup and pour hot water over it. Leave to infuse for 3 minutes. Take out the bag and serve to drink. The tea can be sweetened with sugar or softened with milk according to taste.",
        "country" => "uk",
        "dish_category" => [1, 5],
        "recipe_category" => [9],
        "tolerance" => [1],
        "ingredient" => [
            [
                "id" => "1",
                "name" => "water",
                "quantity" => 0.25,
                "unit" => "l",
                "necessary" => "1"
            ],
            [
                "id" => "2",
                "name" => "Earl Grey",
                "quantity" => 4,
                "unit" => "g",
                "necessary" => "1",
                "comment" => "4g is a regular tea bag. You can also use other brands of black tea."
            ],
            [
                "id" => "3",
                "name" => "sugar",
                "quantity" => 5,
                "unit" => "g",
                "necessary" => "0",
                "comment" => "You can also use honey, for example."
            ],
            [
                "id" => "4",
                "name" => "milk",
                "quantity" => 0.05,
                "unit" => "l",
                "necessary" => "0"
            ]
        ],
        "author" => "Michal Bubílek"
    ],
    "user" => 1,
    "time" => time()
];
$data['sign'] = create_signature($data, "cd34");

$public_secret = 'ab12';
try {
    $data = request($url, $data);
    echo "Response:\n" . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    $signature = $data["sign"] ?? '';
    unset($data["sign"]);
    echo "Verified: " . (verify_data($data, $signature, $public_secret) ? "yes" : "no");
} catch (Exception $e) {
    echo $e->getMessage();
}
