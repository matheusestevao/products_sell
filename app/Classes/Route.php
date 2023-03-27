<?php

namespace App\Classes;

class Route
{
    private static $routes = [];
    private static $middleware = null;
    private $prefix = '';

    public static function get($path, $callback) 
    {
        self::$routes[] = ['GET', $path, $callback];
    }

    public static function post($path, $callback) 
    {
        self::$routes[] = ['POST', $path, $callback];
    }

    public static function group($options, $callback)
    {
        $middleware = $options['middleware'];

        call_user_func(function () use ($middleware) {
            if (is_callable($middleware)) {
                call_user_func($middleware);
            } else {
                $middleware = new $middleware();

                if (!method_exists($middleware, 'handle')) {
                    throw new \RuntimeException('Middleware handle method not found');
                }

                call_user_func([$middleware, 'handle']);
            }
        });

        call_user_func($callback);
    }

    public function withPrefix($prefix, $callback)
    {
        $currentPrefix = $this->prefix;
        $this->prefix .= $prefix;
        
        call_user_func($callback, $this);
        
        $this->prefix = $currentPrefix;
    }

    public static function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        foreach (self::$routes as $route) {
            list($route_method, $route_path, $callback) = $route;

            if ($route_method != $method) {
                continue;
            }

            $pattern = '#^' . preg_replace('/\/:([^\/]+)/', '/(?<$1>[^/]+)', str_replace('/', '\/', $route_path)) . '$#iu';

            if (!preg_match($pattern, $uri, $matches)) {
                continue;
            }

            $params = [];

            foreach ($matches as $key => $value) {
                if (is_string($key)) {
                    $params[$key] = $value;
                }
            }

            if (is_callable($callback)) {
                if (self::$middleware) {
                    call_user_func(self::$middleware);
                }

                call_user_func_array($callback, $params);
                break;
            }

            $controller = explode('@', $callback);
            $controller_file = "app/Controllers/{$controller[0]}.php";
            $controller_class = "\\App\\Controllers\\" . $controller[0];
            $controller_method = $controller[1];

            if (!file_exists($controller_file)) {
                throw new \RuntimeException("Controller {$controller[0]} not found");
            }

            require_once $controller_file;

            $object = new $controller_class();

            if (!method_exists($object, $controller_method)) {
                throw new \RuntimeException("Method {$controller_method} not found in controller {$controller[0]}");
            }

            if (self::$middleware) {
                call_user_func(self::$middleware);
            }

            call_user_func_array([$object, $controller_method], $params);

            break;
        }
    }
}
