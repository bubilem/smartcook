# Request: Echo

It is possible to send data to the server, the server verifies the request with the data and sends it back signed. The client can thus try sending and validateing data.

## Request:

url:

```
https://www.smartcook-project.eu/api/echo
```

post json data:

```
{
    "mess": "Hello there",
    "user": 1,
    "time": 1704293201,
    "sign": "be8b02e75e37cfc7aeddc4d0efcdc2310f5bfe4e288bc4bfb98070104776a46f"
}
```

## Response example:

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
