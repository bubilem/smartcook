# Request: RECIPES

[HOME](README.md)

Endpoint _recipes_ is used to obtain list of recipes. For the recipe list, you can select and determine the order of attributes, as well as select recipes according to the filter settings.

## Request:

url:

```
https://www.smartcook-project.eu/api/recipes
```

post json data:

```
{
    "attributes":["id","name","author"],
    "filter": {
        "author": ["Test User"],
        "dish_category": [2,5],
        "recipe_category": [1],
        "difficulty": [1,2],
        "price": [2,3],
        "tolerance": [8,9],
        "ingredient":[1,5,4]
    },
    "user": 1,
    "time": 1704293201,
    "sign": "be8b...a46f"
}
```

Supported **attributes**: `id` (default), `name` (default), `difficulty`, `duration`, `price`, `description`, `country`, `author`

Supported **filters**: `author`, `dish_category`, `recipe_category`, `difficulty`, `price`, `price`, `ingredient`

## Response example:

```
{
    "stat": "ok",
    "data": [
        {
            "id": 1,
            "name": "Red Soup",
            "author": "Test User"
        },
        {
            "id": 1,
            "name": "Blue Soup",
            "author": "Test User"
        }
    ],
    "user": 0,
    "time": 1704647091,
    "sign": "e774...581e"
}
```
