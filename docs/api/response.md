# Response

[HOME](README.md)

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

## Attributes

| name | datatype   | example            | description   |
| ---- | ---------- | ------------------ | ------------- |
| stat | string     | "ok"               | ok or fail    |
| mess | string     | "Recipe not found" | message       |
| data | JSON       | {id:1, name:"Tea"} | data          |
| user | string     | "John Doe"         | sender name   |
| time | int        | 1704293891         | timestamp     |
| sign | string(64) | "a5b2...4f8"       | SHA256 64hexa |
