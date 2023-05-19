<?php
//show errors
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
ob_start();
session_start();
// definimos la zona horaria
date_default_timezone_set('America/Guayaquil');
// cargamos el autoload de composer
require_once __DIR__ . '/vendor/autoload.php';

// cargamos las funciones
require_once(__DIR__ . '/src/functions/RouterAdapter.php');
require_once(__DIR__ . '/src/functions/utils.php');
require_once(__DIR__ . '/src/dao/MysqlAdapter.php');
require_once(__DIR__ . '/src/api/ApiAdapter.php');
require_once(__DIR__ . '/src/functions/middlewares.php');


// cargamos los objetos de acceso a datos
require_once('./src/dao/InfoDao.php');
require_once('./src/dao/UserDao.php');
require_once('./src/dao/ClientDao.php');

// cargamos los objetos de acceso a API
require_once('./src/api/ClientApi.php');

// cargamos los servicios para el web service (WEB SERVICE)
require_once('./src/services/info.service.php');
require_once('./src/services/user.service.php');
require_once('./src/services/client.service.php');

// cargamos las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// creamos el router
$router = new \Bramus\Router\Router();

// declaramos las rutas
require __DIR__ . '/src/routes/services.php';
require __DIR__ . '/src/routes/public.php';
require __DIR__ . '/src/routes/panel.php';

// iniciamos el router xd
$router->run();
