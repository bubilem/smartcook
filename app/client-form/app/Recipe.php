<?php

class Recipe
{
    public array $data;

    public function __construct(array $data = [])
    {
        $this->data = json_decode(file_get_contents("data/recipe.json"), true);

    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? "";
    }

    public function __set(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function load_from_post()
    {
        $this->id = filter_input(INPUT_POST, 'recipe_id', FILTER_SANITIZE_NUMBER_INT);
        $this->name = filter_input(INPUT_POST, 'name');
        $this->difficulty = filter_input(INPUT_POST, 'difficulty');
        $this->duration = filter_input(INPUT_POST, 'duration');
        $this->price = filter_input(INPUT_POST, 'price');
        $this->description = filter_input(INPUT_POST, 'description');
        $this->country = filter_input(INPUT_POST, 'country');
        $this->ingredient = $_POST['ingredient'] ?? [];
        $this->dish_category = $_POST['dish_category'] ?? [];
        $this->recipe_category = $_POST['recipe_category'] ?? [];
        $this->tolerance = $_POST['tolerance'] ?? [];
        $this->author = $_POST['author_name'] ?? '';
    }

    public function load_from_array(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->difficulty = $data['difficulty'];
        $this->duration = $data['duration'];
        $this->price = $data['price'];
        $this->description = $data['description'];
        $this->country = $data['country'];
        $this->ingredient = $data['ingredient'] ?? [];
        $this->dish_category = $data['dish_category'] ?? [];
        $this->recipe_category = $data['recipe_category'] ?? [];
        $this->tolerance = $data['tolerance'] ?? [];
        $this->author = $data['author'] ?? '';
    }

    public function load_recipe(SmartCookClient $scc): array
    {
        try {
            $response = $scc
                ->setRequestData(["recipe_id" => $this->id])
                ->sendRequest('recipe')
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if (!empty($response['data'])) {
            $this->load_from_array($response['data']);
        }
        return $response;
    }

    public function remove_recipe(SmartCookClient $scc): array
    {
        try {
            $response = $scc
                ->setRequestData(["recipe_id" => $this->id])
                ->sendRequest('recipe-remove')
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }

    public function update_recipe(SmartCookClient $scc): array
    {
        try {
            $response = $scc
                ->setRequestData(["data" => $this->data])
                ->sendRequest('recipe-update')
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }

    public function validate_recipe(SmartCookClient $scc): array
    {
        try {
            $response = $scc
                ->setRequestData(["data" => $this->data])
                ->sendRequest("recipe-validate")
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $response;
    }

    public function add_new_recipe(SmartCookClient $scc): array
    {
        try {
            $response = $scc
                ->setRequestData(["data" => $this->data])
                ->sendRequest("recipe-add")
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if (!empty($response['data']['recipe_id'])) {
            $this->id = $response['data']['recipe_id'];
        }
        return $response;
    }
}