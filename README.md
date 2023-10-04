# SLC Backend

### This backend uses Laravel - Voyager


For the credentials you may want to check into the discord server

### Setting Up Locally


If you have the new newest version of PHP you may want to isntall isntead from the following zip.


```
backup-brooklyslcadmin
```

If there is some null deprecated error try replacing with:


```php

protected static function formatPrefix($new, $old, $prependExistingPrefix = true)
{
    $old = $old['prefix'] ?? null;

    if ($old !== null) {
        $old = trim($old, '/');
    }

    if ($prependExistingPrefix) {
        return isset($new['prefix']) ? $old.'/'.trim($new['prefix'], '/') : $old;
    } else {
        return isset($new['prefix']) ? trim($new['prefix'], '/').'/'.$old : $old;
    }
}
```

### Updating Packages

```
composer update tcg/voyager
```


### Credentials

```
brooklynslcouncil@gmail.com
Slcadmin2021
```


### Deployment

1. To restart from zero
2. Install Laravel from the admin
3. Uncompress the following zip

