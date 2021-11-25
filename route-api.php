<?php
require_once 'libs/Router.php';
require_once("./Controller/apiCommentController.php");


// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('comments', 'GET', 'ApiCommentController', 'getComments');
$router->addRoute('comments/car/:ID', 'GET', 'ApiCommentController', 'getCommentsByCars');
$router->addRoute('comments', 'POST', 'ApiCommentController', 'insertComment');
$router->addRoute('comments/:ID', 'DELETE', 'ApiCommentController', 'deleteComment');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);


