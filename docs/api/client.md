# Client side

[HOME](README.md)

For simplified work, we have prepared for you the [SmartCookClient](../../app/client/SmartCookClient.php) work class, which is very easy to use:

```
try {
    (new SmartCookClient)
        ->setRequestData(["mess" => "Hello there"])
        ->sendRequest("echo")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}
```

In this class, just adjust the appropriate constants for your communication:

```
private const URL = "API_URL";

private const SENDER = [
    "id" => YOUR_ID,
    "name" => "YOUR_NAME",
    "secret" => "YOUR_SECRET"
];

private const SMARTCOOK = [
    "id" => 0,
    "name" => "SmartCook",
    "secret" => "smrtck"
];
```
