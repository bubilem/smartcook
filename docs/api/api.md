# SmartCook API

## Responses

SmartCook API always responds in **JSON** form:

```
{
    stat: "fail",
    mess: "Recipe not found",
    data: {...}
    user: 0,
    time: 1704293891,
    sign: "SHA256 hash"
}
```

**Stat** is a status and takes the values "ok" or "fail". There is usually **mess** (message) when stat=fail. There is usually **data** when stat=ok. However, each response always has **stat**, **user**, **time** and **sign**. User is a user id. The response from the API has user 0, which has a public secret, so the response can be easily verified. Time is unixtime and sign is a signature so that the client can always check for each response whether it is really sent by SmartCook and also whether the content has not been changed along the way.

## Signature

Each API response is signed with a public key. See [class Signature](../../app/api/app/utils/Signature.php) for how to create signature and verify data.

## Requests

The system expects that if any data is part of the request, the user id must be specified and also the all data must be signed with his secret key. Data can be easily verified.

### Ping

A simple http request without data to the API root.

_request_:

```
smart_cook_url/api/
```

_response_ example:

```
{
    "stat": "ok",
    "mess": "No or not supported operation.",
    "docu": "https://github.com/bubilem/smartcook/tree/main/docs/api",
    "user": "0",
    "time": "1704293894",
    "sign": "be8b02e75e37cfc7aeddc4d0efcdc2310f5bfe4e288bc4bfb98070104776a46f"
}
```

### Echo

It is possible to send data to the server, the server verifies the request with the data and sends it back signed. The client can thus try sending and verifying data.

_request_:

```
url:
smart_cook_url/api/echo

post data:
{
    "mess": "Hello there",
    "user": 1,
    "time": 1704293201,
    "sign": "be8b02e75e37cfc7aeddc4d0efcdc2310f5bfe4e288bc4bfb98070104776a46f"
}
```

_response_ example:

```
{
    "data": {
        "mess": "Hello there",
        "user": 1,
        "time": 1704293201
        },
    "user": 0,
    "time": 1704293201,
    "sign": "46497ededd552de63f0f860ebbffb19c0cfa2d7c70188066904a23cfdec3a0e0"
}
```

### Data Structure

_request_:

```
smart_cook_url/api/structure
```

_response_:

```
{
    "stat": "ok",
    "data": {
        "dish_category": {
            "1": "breakfast",
            "2": "soup",
            "3": "main course",
            "4": "dessert",
            "5": "dinner"
        },
        "recipe_category": {
            "1": "soup",
            "2": "meat",
            "3": "meat free",
            "4": "dessert",
            "5": "sauce",
            "6": "pasta",
            "7": "salad",
            "8": "sweet food",
            "9": "drink"
        },
        "difficulty": {
            "1": "simple",
            "2": "medium",
            "3": "difficult"
        },
        "price": {
            "1": "cheap",
            "2": "medium",
            "3": "expensive"
        },
        "unit": {
            "l": "liter",
            "g": "gram",
            "pc": "piece"
        },
        "tolerance": {
            "1": "vegetarian",
            "2": "vegan",
            "3": "nuts",
            "4": "gluten",
            "5": "lactose",
            "6": "spicy",
            "7": "alcohol",
            "8": "sea food",
            "9": "mushrooms "
        }
    },
    "user": 0,
    "time": 1704308174,
    "sign": "fa895788fca2d1ca69325f36f94e18ec0fd0efd7b6a633401d1561283a50e914"
}
```

### Recipes WIP

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

### Recipe WIP

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

### Insert New Recipe WIP

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
