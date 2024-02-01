# Request: RECIPES

Endpoint _recipe_ is used to obtain complete information about one selected recipe.

**Important**: Filters, attributes are WIP now.

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
