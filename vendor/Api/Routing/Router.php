<?php
namespace Api\Routing;
use Api\Support\Grammar;
class Router
{
    /**
     * @var Object
     */
    public static $router;
    private $request;
    private $action; 
    /**
     * @var Array
     */
    public $routes = [
        'GET'=> [],
        'POST' => [],
    ];

    public function request($request)
    {
        $this->request = $request;
    }
    /**
     * Tambah Route Dari Route::Class
     * @param String $route
     * @param Controller $controller
     */
    public function addRoute($routeMethod, $route, $action)
    {
        $this->action = $this->registerController($action);
        if($routeMethod === 'GET')
            $this->routes[$routeMethod][$route] = $this->action;
        else if($routeMethod === 'POST')
            $this->routes[$routeMethod][$route] = $this->action;
    }
    /**
     * @var String $key
     */
    public function has($routes, $key)
    {
        $requestMethod = strtoupper($this->request->requestMethod);
        return array_key_exists($key, $routes[$requestMethod]);
    }
    public function selfHasParams()
    {
        $countParams = explode('?', $this->formattedRoute());
        // echo sizeof($countParams);
        if(sizeof($countParams) > 1):
            return true;
        endif;
        return false;  
    }
    public function selfParams()
    {
        return explode('?', $this->formattedRoute());
    }
    public function routeParams($route)
    {
        return explode('?', $route);
    }
    public function routeHasParams()
    {
        foreach($this->routes[$this->formattedRouteMethod()] as $key => $val):
                // var_dump($this->selfParams()[0]); echo '<br/>';
                // var_dump($key); echo '<br/>';
            if($this->routeParams($key)[0] === $this->selfParams()[0] && sizeof($this->routeParams($key)) === sizeof($this->selfParams())):
                if($this->paramMatchers($this->routeParams($key)[1], $this->selfParams()[1])):
                    $paramname = $this->selfParams()[0].'?'.$this->selfParams()[1];
                    $old = $this->routeParams($key)[0].'?'.$this->routeParams($key)[1];
                    $this->routes[$this->formattedRouteMethod()][$paramname] = $this->routes[$this->formattedRouteMethod()][$old];
                    unset($this->routes[$this->formattedRouteMethod()][$old]);
                    return true;
                endif;
            endif;
        endforeach;
        return false;
    }
    public function paramMatchers($route, $self)
    {
        // print_r($route);
        // echo '<br/>';
        $selfmatch = explode('&', $self);
        preg_match_all('/\{(.*?)\}/', $route, $routematch);     
        if(sizeof($selfmatch) === sizeof($routematch[0]))
            return true;
        return false;
    }
    public function formattedRoute()
    {
        return $this->request->formattedRequestUri();
    }
    public function formattedRouteMethod()
    {
        return $this->request->formattedRequestMethod();
    }
    public function registerController($action)
    {
        if(is_string($action))
        {
            
        }
        else 
        {
            $controller = BaseController::getClass();
            return $controller->__innerMethod($action);            
        }
    }
    private function defaultRequestHandler()
    {
        return "{$this->request->serverProtocol} 404 Not Found";
    }
    public function runAction()
    {
        if($this->has($this->routes, $this->formattedRoute()))
            echo call_user_func_array($this->routes[$this->formattedRouteMethod()][$this->formattedRoute()], []);
        else 
            if($this->selfHasParams() && $this->routeHasParams())
            {
                // var_dump($this->routes);
                echo call_user_func_array($this->routes[$this->formattedRouteMethod()][$this->formattedRoute()], explode('&', $this->selfParams()[1]));
            }
            else 
            {
                echo $this->defaultRequestHandler();                                
            }
    }
    /**
     * @return Router
     * 
     */
    public static function getClass()
    {
        if(self::$router === null)
            self::$router = new Router();
        return self::$router;
    }
}