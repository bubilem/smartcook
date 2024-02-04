# Signature

[HOME](README.md)

Each API response is signed with a public key. See [class Signature](../../app/api/app/utils/Signature.php) for how to create signature and validate data.

## SmartCook user

API responses are signed with this user account:

```
"id": 0
"name": "SmartCook"
"secret": "smrtck"
```

This user account is not allowed for API queries.

## Method

We have a data to send:

```
[
    mess: "Hello",
    user: "1"
    time: "1704645238"
]
```

For example user 1 has a secret "1234". We use data a secret to create a signature:

```
signature = SHA256(data_to_json(data), secret)
```
