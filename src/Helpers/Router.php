<?php

namespace August\Helpers;


class Router
{
  private $routes = [];

  public function addRoute($pattern, $controller, $action)
  {
    $this->routes[] = [
      'pattern' => $pattern,
      'controller' => $controller,
      'action' => $action
    ];
  }

  public function matchRoute($url)
  {
    $url = parse_url($url)['path'];
    foreach ($this->routes as $route) {
      $pattern = $this->convertPatternToRegex($route['pattern']);
      if (preg_match($pattern, $url, $matches)) {

        array_shift($matches);

        // Créez un tableau associatif des noms de paramètres et de leurs valeurs
        $namedParams = [];
        foreach ($matches as $key => $value) {
          $paramName = array_keys($matches, $value)[0];
          $namedParams[$paramName] = $value;
        }

        return [
          'controller' => $route['controller'],
          'action' => $route['action'],
          'params' => $namedParams
        ];
      }
    }
    return null; // No matching route
  }

  private function convertPatternToRegex($pattern)
  {
    $regex = preg_replace('/\//', '\\/', $pattern);
    $regex = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[a-zA-Z0-9-]+)', $regex);
    return '/^' . $regex . '$/';
  }

  public function route()
  {
    $url = $_SERVER['REQUEST_URI'];
    $route = $this->matchRoute($url);
    if ($route) {
      $controllerName = $route['controller'];
      $action = $route['action'];
      $params = $route['params'];
      $queryParams = [];
      parse_str($_SERVER["QUERY_STRING"] ?? '', $queryParams);

      // Include and instantiate the controller
      $newArray = array_merge($params, $queryParams);

      $controller = new $controllerName();


      // Call the action method with parameters
      call_user_func_array([$controller, $action], $newArray);
    } else {
      // Handle 404
      header("HTTP/1.0 404 Not Found");
      echo "404 Not Found";
    }
  }
}
