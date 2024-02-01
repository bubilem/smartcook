# Request: RECIPE

Endpoint _recipe_ is used to obtain complete information about one selected recipe.

## Request:

url:

```
https://www.smartcook-project.eu/api/recipe
```

post json data:

```
{
    "recipe_id": 1
    "user": 1,
    "time": 1704293201,
    "sign": "be8b...a46f"
}
```

## Response example:

```
{
    "stat": "ok",
    "data": {recipe JSON object},
    "user": 0,
    "time": 1704647091,
    "sign": "e774...581e"
}
```
