# Request: RECIPE-ADD

[HOME](README.md)

System checks if the input recipe is valid and adds it to the database.

## Request:

url:

```
https://www.smartcook-project.eu/api/recipe-add
```

post json data:

```
{
    "data": {
        "name": "Earl Grey",
        "difficulty": 1,
        "duration": "5",
        "price": 1,
        "description": "We will prepare a cup for tea. Bring 250 ml of water to a boil. Place the tea bag in a cup and pour hot water over it. Leave to infuse for 3 minutes. Take out the bag and serve to drink. The tea can be sweetened with sugar or softened with milk according to taste.",
        "country": "uk",
        "dish_category": [1, 5],
        "recipe_category": [9],
        "tolerance": [1],
        "ingredient": [
            {
                "name": "water",
                "quantity": 0.25,
                "unit": "l",
                "necessary": "1"
            },
            {
                "name": "Earl Grey",
                "quantity": 4,
                "unit": "g",
                "necessary": "1",
                "comment": "4g is a regular tea bag. You can also use other brands of black tea."
            },
            {
                "name": "sugar",
                "quantity": 5,
                "unit": "g",
                "necessary": "0",
                "comment": "You can also use honey, for example."
            },
            {
                "name": "milk",
                "quantity": 0.05,
                "unit": "l",
                "necessary": "0"
            }
        ],
        "author": "Test User"
    },
    "user": 1,
    "time": 1704293201,
    "sign": "be8b...a46f"
}
```

## Response example:

```
{
    "stat": "ok",
    "mess": "Recipe has been added",
    "data": { "recipe_id": 1 }
    "user": 0,
    "time": 1704647091,
    "sign": "e774c5cd79ea039a75aefec6e823f528a61d9466d6b5cead047930af0510581e"
}
```

## Errors

The system can detect many errors in the recipe. For example:

- Recipe: author is missing
- Recipe: author of the recipe does not match the sender of the request
- Recipe: name is missing or empty
- Recipe: such a name already exists in the database
- Recipe: difficulty is missing or empty
- Recipe: difficulty has incorrect value
- Recipe: duration is missing or empty
- Recipe: duration has incorrect value
- Recipe: price is missing or empty
- Recipe: price has incorrect value
- Recipe: description is missing or empty
- Recipe: country is missing or empty
- Recipe: country format is not ISO 3166 alpha-2
- Recipe: dish_category is missing/empty or is not array/list
- Recipe: dish_category has incorrect value
- Recipe: recipe_category is missing/empty or is not array/list
- Recipe: recipe_category has incorrect value
- Recipe: tolerance is missing or is not array/list
- Recipe: tolerance has incorrect value
- Recipe: ingredient is missing/empty or is not array/list
- ...
