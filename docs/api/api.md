# SmartCook API

## Responses

SmartCook API always responds in json form.

```
{
    state:"fail",
    message:"Recipe not found",
    data:{...}
}
```

## Requests

### Data Structure

_request_:

```
smart_cook_url/api/structure
```

_response_:

```
{
    state:"ok",
    data:{...}
}
```

### Recipes

_request_:

```
url:
smart_cook_url/api/recipes

post: WIP
```

_response_:

```
{
    state:"ok",
    data:[
        { "id": 1, "name": "Black Tea" },
        { "id": 2, "name": "Pizza Margherita" }
    ]
}

```

## Recipe

_request_:

```

smart_cook_url/api/recipe/1

```

_response_:

```

{
state:"ok",
data:{...}
}

```

## Insert New Recipe

_request_:

```

url:
smart_cook_url/api/new_recipe

post:
{
data:{...},
author:"Michal Bubílek",
dttm:"2023-12-18 08:56:00",
signature:"...hexa_code...",
}

```

_response_:

```

{
state: "ok",
message: "Recipe was inserted."
}

```
