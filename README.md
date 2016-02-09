PPP (3P) PHP PreProcessor
=========================

> Current status: prototyping

Remove unneeded code for production builds

```
/**
 * @dev
 */
if ($env == Application::ENV_PRODUCTION) {
    // Code....
}
```

```
function getMyRouterConfigs() {
    return [
        'cache' => ($env == Application::ENV_PRODUCTION) // @production(true)
    ]
}
```
