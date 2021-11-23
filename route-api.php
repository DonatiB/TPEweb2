<?php
require_once 'libs/Router.php';
require_once("./Controller/apiCarsController.php");


// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('comentarios', 'POST', 'ApiCarsController', 'insertComment');
$router->addRoute('comentario/:ID', 'DELETE', 'ApiCarsController', 'deleteComment');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);


