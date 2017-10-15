<?php

function GetOrDefault($name, $default){

    if(!empty($_GET[$name]))
    {
        return $_GET[$name];
    }
    else
    {
        return $default;
    }
}

$controller = GetOrDefault("controller", "Home");
$action = GetOrDefault("action", "Index");

$file = "controllers" . DIRECTORY_SEPARATOR . $controller . "Controller.php";

function return404(){
    http_response_code(404);
    include('views/404.php');
    die();
}

if(file_exists($file))
{
    require_once( $file );

    $reflectionClass = new ReflectionClass($controller . "Controller");

    $instance = $reflectionClass->newInstance();

    $reflectionMethod = $reflectionClass->getMethod($action);

    if($reflectionMethod != NULL)
    {
        $reflectionMethod->invoke($instance);
    }
    else
    {
        return404();
    }
}
else
{
    return404();
}

?>