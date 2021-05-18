<?php

declare(strict_types=1);

final class Router
{
    /**
     * @var array
     */
    private static array $routes = [];
    /**
     * @var array
     */
    private static array $shortcode = [
        '{id}' => '[0-9]{0,10}',
        '{string}' => '(?!.*\ {2})[a-z][a-z ]{3,255}'
    ];
    /**
     * @var string
     */
    private static string $requestUrl;
    /**
     * @var string
     */
    private static string $controller;
    /**
     * @var string
     */
    private static string $method;
    /**
     * @var array
     */
    private static array $params;

    /**
     * dispatch
     * 
     * Responsible for identifying which route the URL matches.
     * Responsible for identifying the controller, the method and the parameters.
     *
     * @return void
     */
    public static function dispatch(): void
    {
        $url = $_SERVER['REQUEST_URI'] === 'index.php' ? '/' : $_SERVER['REQUEST_URI'];

        foreach (self::$routes as $pattern => $route) {
            if (preg_match($pattern, $url)) {
                self::$requestUrl = $url;

                $target = explode('/', $route['target']);

                self::$controller = $target[0];
                self::$method = $target[1];
                self::$params = isset($route['params']) ? self::getParams($route['params']['index'], $route['params']['convertTo']) : [];

                self::execute();
            }
        }

        // Show page not found, if any matches were found.
        require_once APP . '/controller/Error404Controller.php';
        call_user_func([new Error404Controller(), 'Error404']);
    }

    /**
     * execute
     * 
     * Import and calls the controller and method.
     *
     */
    private static function execute(): void
    {
        require_once APP . '/controller/' . self::$controller . '.php';
        call_user_func_array([new self::$controller(), self::$method], self::$params);
    }

    /**
     * addRoute
     * 
     * Responsible for converting the route and shortcodes to the regex standard.
     *
     * @param  string $route - e.g. /courses/{string}, this target would be:
     * @param  string $target - CoursesController/getCourse
     * @param  array $paramsPos - 
     */
    public static function addRoute(string $route, string $target, array $paramsPos = [], array $convertParamsTo = []): void
    {
        $route = str_replace('/', '\/', $route);
        $route = '/^' . $route . '$/';

        foreach (self::$shortcode as $code => $regex) {
            $route = str_replace($code, $regex, $route);
        }

        self::$routes[$route]['target'] = $target;

        if ($paramsPos !== []) {
            self::$routes[$route]['params']['index'] = $paramsPos;
            self::$routes[$route]['params']['convertTo'] = $convertParamsTo;
        }
    }

    /**
     * getParams
     * 
     * Responsible for getting the URL parameters, if any.
     *
     * @param array $convertParamsTo
     * @param  array $paramsPos
     * @return array
     */
    private static function getParams(array $paramsPos, array $convertParamsTo): array
    {
        $params = [];

        // The URL that is in the browser is divided according to the slashes (/).
        $urlExplode = explode('/', trim(self::$requestUrl, '/'));

        // Knowing the positions of the arguments, just go through the array that contains this information.
        $nParam = count($paramsPos);

        for ($i = 0; $i < $nParam; $i++) {
            $param = $urlExplode[$paramsPos[$i]];
            $param = call_user_func($convertParamsTo[$i] . 'val', $param);

            $params[] = $param;
        }

        return $params;
    }
}
