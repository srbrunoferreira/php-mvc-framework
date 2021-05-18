# PHP MVC Framework

This is **my own MVC framework** and I make it available here for everyone who wants to use.

## Folder structure
```
|   .htaccess
|   composer.json
|   composer.lock
|   README.md
|
+---app
|   |   config.php
|   |
|   +---controller
|   |       Error404Controller.php
|   |       SiteController.php
|   |
|   +---core
|   |       Controller.php
|   |       Model.php
|   |       Router.php
|   |
|   +---helper
|   |       autoload.php
|   |
|   \---view
|       |   layout.php
|       |
|       +---about
|       |       main.php
|       |
|       +---contact
|       |       main.php
|       |
|       +---error-404
|       |       main.php
|       |
|       +---home
|       |       main.php
|       |
|       \---template
|               head.php
|               header.php
|               nav.php
|
\---public
    |   .htaccess
    |   index.php
    |
    +---css
    |       default.css
    |
    \---img
        \---system
```

So, the folder and filenames are self descriptive and you can modify it according to you need.

## How can I make my own routes?
### This framework comes with a build-in example of routes inside the index.php file:
```php
Router::addRoute('/', 'SiteController/home'); // Match: https://www.mysite.com

Router::addRoute('/contact/', 'SiteController/contact'); // Match: https://www.mysite.com/contact/

Router::addRoute('/about/', 'SiteController/about'); // Match: https://www.mysite.com/about/

Router::addRoute('/user/delete/{id}/', 'SiteController/delete', [2], ['int']); // Match: https://www.mysite.com/user/delete/42/

Router::addRoute('/{string}/settings/{id}/create/', 'SiteController/delete', [0, 2], ['str', 'int']); // Match: https://www.mysite.com/astring/settings/42/create/
```

Here, it calls the static method addRoute() of the Router class, passing four possible parameters:
```php
addRoute(string $route, string $target, array $paramsPos = [], array $convertParamsTo = []): void { ... }
```
1. **$route** - it is what you want to appear in the browser search bar.
2. **$target** - it is the Controller/method that must be called when the user accesses that route.
3. **$paramPos** - if you want to pass parameters across the route, you must specify their positions in the route (wait, I will explair more about my the shortcodes).
4. **$convertParamsTo** - it is an array containing the types (int, string, float) that the parameters must be converted to. Remember that I used type hints, so classes will only accept a variable with a certain type.

### Shortcodes
The shortcodes are stored in the $shortcode property of the Router class.
```php
private static array $shortcode = [
  '{id}' => '[0-9]{0,10}',
  '{string}' => '(?!.*\ {2})[a-z][a-z ]{3,255}'
];
```
You can add more shortocdes following the structure above according to your need.

## The config.php file
The config.php is located in app/config.php and it stores important data such as the database credentials.
So, you can insert you database credentials to make the models connect with the database.
Also here, you can modify the default HTML meta tag: description, robots, keywords and more.

## Tip for understanding the application flow
I advide you to open the following files in you code editor and read each code line:
<img src='vs-code-tabs.jpg'>
They are located in:

1. **index.php** - /public/index.php
2. **Router.php** - /app/core/Router.php
3. **SiteController.php** - /app/controller/SiteController.php
4. **Controller.php** - /app/core/Controller.php
