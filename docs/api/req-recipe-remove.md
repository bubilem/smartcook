# Request: RECIPE-REMOVE

The system deletes the recipe according to the entered id from the database. The author of the recipe must match the author of the deletion request.

## Request:

url:

```
https://www.smartcook-project.eu/api/recipe-remove
```

post json data (before signing):

```
{
    "recipe_id": 1,
    "user": 1,
    "time": 1704293201,
    "sign": "be8b...a46f"
}
```

## Response example:

```
{
    "stat": "ok",
    "mess": "Recipe was removed",
    "data": { "recipe_id": 1 }
    "user": 0,
    "time": 1704647091,
    "sign": "e774c5cd79ea039a75aefec6e823f528a61d9466d6b5cead047930af0510581e"
}
```
