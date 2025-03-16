<?php

namespace App\core;

class Router {

    private static $routes;

    public  static function  add($method, $route, $action) {
        self::$routes[] = [
            'method' => strtoupper($method),
            'route' => trim($route, '/'),
            'action' => $action
        ];
    }

    
    public static function dispatch() {
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    
        // Retirer "ESSEMLALI-Bank" de l'URI
        $requestUri = preg_replace('#^ESSEMLALI-Bank/?#', '', $requestUri);
        
        $requestMethod = $_SERVER['REQUEST_METHOD'];
    
        foreach (self::$routes as $route) {
            // Transformer les paramètres dynamiques en regex
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route['route']);
            $pattern = '#^' . $pattern . '$#';
    
            if (preg_match($pattern, $requestUri, $matches) && $route['method'] === $requestMethod) {
                array_shift($matches); // Retirer la première valeur qui est l'URL complète
                
                [$controller, $method] = explode('@', $route['action']);
                $namespace = "App\\controllers\\";
                $controllerClass = $namespace . $controller;
    
                if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
                    $controllerInstance = new $controllerClass();
                    return call_user_func_array([$controllerInstance, $method], $matches);
                } else {
                    http_response_code(404);
                    echo "404 - Page Not Found";
                    return;
                }
            }
        }
    
        http_response_code(404);
        echo "404 - Page Not Found";
    }
    
    
}