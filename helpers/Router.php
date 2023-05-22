<?php

class Router
{

    private $configuration;
    private $defaultController;
    private $defaultMethod;
    private $basePath;

    /*  public function __construct($configuration, $defaultController, $defaultMethod)
      {
          $this->configuration = $configuration;
          $this->defaultController = $defaultController;
          $this->defaultMethod = $defaultMethod;
      } */

    public function __construct($configuration, $defaultController, $defaultMethod, $basePath)
    {
        $this->configuration = $configuration;
        $this->defaultController = $defaultController;
        $this->defaultMethod = $defaultMethod;
        $this->basePath = $basePath;
    }

    public function route($module, $method)
    {
        $controller = $this->getControllerFrom($module);
        $this->executeMethodFromController($controller, $method);
    }

    private function getControllerFrom($module)
    {
        $controllerName = 'get' . ucfirst($module) . 'Controller';
        $validController = method_exists($this->configuration, $controllerName) ? $controllerName : $this->defaultController;
        return call_user_func(array($this->configuration, $validController));
    }


    private function executeMethodFromController($controller, $method)
    {
        $validMethod = method_exists($controller, $method) ? $method : $this->defaultMethod;
        call_user_func(array($controller, $validMethod));
    }

    private function getRequestURI()
    {
        $requestURI = $_SERVER['REQUEST_URI'];

        // Remove the base path from the request URI
        if ($this->basePath !== '') {
            $requestURI = str_replace($this->basePath, '', $requestURI);
        }

        return $requestURI;
    }

    private function getCleanURL($url)
    {
        $urlParts = explode('?', $url);
        return rtrim($urlParts[0], '/');
    }

    private function getModuleAndMethodFromURL($url)
    {
        $url = $this->getCleanURL($url);
        $urlParts = explode('/', $url);

        // Assuming the URL format is "/module/action"
        $module = $urlParts[1] ?? '';
        $method = $urlParts[2] ?? '';

        return array($module, $method);
    }


}