Add Core to namespace to composer.json, replace ``` $APP_NAME ``` variable for you namespace

```json
{
    "autoload": {
      "psr-4": {
        "{$APP_NAME}\\": "Core/"
      }
    }
}
```
