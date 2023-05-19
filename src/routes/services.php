<?php
$_TEMPLATE_SERVICES_PATH = './src/services/';
$radapter = new RAdapter($router, $_TEMPLATE_SERVICES_PATH, $_ENV['HTTP_DOMAIN']);

// CONFIGURATION
$radapter->getHTML('/services/configuration', 'configuration');

// INFO
$radapter->post('/services/info/select', fn (...$args) => InfoService::select(...$args));

// USER
$radapter->post('/services/user/login', fn (...$args) => UserService::login(...$args));
$radapter->post('/services/user/logout', fn () => UserService::logout());
$radapter->post('/services/user/select', fn (...$args) => UserService::select(...$args));
// need to be logged
$radapter->post('/services/user/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => UserService::insert(...$args));
$radapter->post('/services/user/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => UserService::update(...$args));
$radapter->post('/services/user/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => UserService::delete(...$args));


// CLIENT 
$radapter->post('/services/client/select_by_dni', fn (...$args) => ClientService::selectByDni(...$args));
$radapter->post('/services/client/select', fn (...$args) => ClientService::select(...$args));
// need to be logged
$radapter->post('/services/client/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => ClientService::insert(...$args));
$radapter->post('/services/client/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => ClientService::update(...$args));
$radapter->post('/services/client/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => ClientService::delete(...$args));
