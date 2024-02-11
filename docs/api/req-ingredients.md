# Request: INGREDIENTS

[HOME](README.md)

Endpoint _ingredients_ is used to obtain list of all ingredients sorted alphabetically with information on frequency of use in recipes.

## Request:

url:

```
https://www.smartcook-project.eu/api/ingredients
```

## Response example:

```
{
    "stat": "ok",
    "data": [
        {
            "id": 36,
            "name": "baking powder",
            "number_of_uses": 1
        },
        {
            "id": 26,
            "name": "basil",
            "number_of_uses": 1
        },
        {
            "id": 15,
            "name": "breadcrumbs",
            "number_of_uses": 2
        },
        {
            "id": 28,
            "name": "butter",
            "number_of_uses": 3
        },
        ...
    ],
    "user": 0,
    "time": 1707644898,
    "sign": "8f46...743d"
}
```
