<?php

ini_set('display_errors',1);
ini_set('display_startup_error',1);
error_reporting(E_ALL);

require_once('../vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
session_start();
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'intro_php',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('index', '/fundamentos_php2018/', [
    'controller' => 'app\Controller\indexController',
    'action' => 'indexAction'
]);
$map->get('addJob', '/fundamentos_php2018/jobs/add', [
    'controller' => 'app\Controller\jobController',
    'action' => 'jobAction',
    'authentication' => true
]);
$map->post('saveJob', '/fundamentos_php2018/jobs/add', [
    'controller' => 'app\Controller\jobController',
    'action' => 'jobAction',
    'authentication' => true
]);

$map->get('addProjecView', '/fundamentos_php2018/projects/add', [
    'controller' => 'app\Controller\projectController',
    'action' => 'projectAddAction'
]);
$map->post('saveProject', '/fundamentos_php2018/projects/add', [
    'controller' => 'app\Controller\projectController',
    'action' => 'projectAddAction'
]);
$map->get('addUser', '/fundamentos_php2018/user/add', [
    'controller' => 'app\controller\userController',
    'action' => 'userAddAction'
]);
$map->post('saveUser','/fundamentos_php2018/user/add',[
    'controller' => 'app\controller\userController',
    'action' => 'userAddAction'
]);
$map ->get('logIndex','/fundamentos_php2018/login', [
    'controller' => 'app\Controller\logController',
    'action' => 'getLogIn'
]);
$map ->get('logOut','/fundamentos_php2018/logout', [
    'controller' => 'app\Controller\logController',
    'action' => 'getLogOut'
]);
$map->post('authenticationPost', '/fundamentos_php2018/authentication',[
    'controller' => 'app\Controller\logController',
    'action' => 'postLogIn'
]);
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);
if(!$route){
    echo "no route";
}else{
    $handlerData = $route->handler;
    $auth = $handlerData['authentication'] ?? false;
    $sessionUserId = $_SESSION['UserId'] ?? null;
    if($auth == true && !$sessionUserId){
        $controllerName = 'app\Controller\logController';
        $actionName = 'getLogOut';
    }else {
        $controllerName = $handlerData['controller'];
        $actionName = $handlerData['action'];
    }
    $controller = new $controllerName;
    $response = $controller->$actionName($request);
    foreach($response->getHeaders() as $name => $values){
         foreach($values as $value){
             header(sprintf('%s: %s',$name, $value),false);
         }
    }
    echo $response->getBody();
}
http_response_code($response->getStatusCode());
var_dump($route->handler);
