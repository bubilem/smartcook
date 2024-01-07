<?php

class TestController extends MainController
{

    public function do (): void
    {
        $strc = new StructureModel;
        $data = [
            "name" => "Earl Gerey",
            "difficulty" => 1,
            "duration" => 5,
            "price" => 1,
            "description" => "We will prepare a cup for tea. Bring 250 ml of water to a boil. Place the tea bag in a cup and pour hot water over it. Leave to infuse for 3 minutes. Take out the bag and serve to drink. The tea can be sweetened with sugar or softened with milk according to taste.",
            "country" => "uk",
            "dish_category" => [1, 5],
            "recipe_category" => [9],
            "tolerance" => [1],
            "ingredient" => [
                [
                    "name" => "water",
                    "quantity" => 0.25,
                    "unit" => "l",
                    "necessary" => "1"
                ],
                [
                    "name" => "Earl Grey",
                    "quantity" => 4,
                    "unit" => "g",
                    "necessary" => "1",
                    "comment" => "4g is a regular tea bag. You can also use other brands of black tea."
                ],
                [
                    "name" => "sugar",
                    "quantity" => 5,
                    "unit" => "g",
                    "necessary" => "0",
                    "comment" => "You can also use honey, for example."
                ],
                [
                    "name" => "milk",
                    "quantity" => 0.05,
                    "unit" => "l",
                    "necessary" => "0"
                ]
            ],
            "author" => "Michal Bubílek"
        ];
        $recipe = new RecipeModel(
            data: $data,
            strc: new StructureModel,
            user: new UserModel(2)
        );
        $recipe->validate();

        var_dump($strc->get("dish_category"));
    }

}