<?php
$_TEMPLATE_SERVICES_PATH = './src/services/';
$radapter = new RAdapter($router, $_TEMPLATE_SERVICES_PATH, $_ENV['HTTP_DOMAIN']);

// CONFIGURATION
$radapter->getHTML('/services/configuration', 'configuration');

// INFO
$radapter->post('/services/info/select', fn (...$args) => InfoService::select(...$args));
$radapter->post('/services/info/update', fn (...$args) => InfoService::update(...$args));

// USER
$radapter->post('/services/user/login', fn (...$args) => UserService::login(...$args));
$radapter->post('/services/user/logout', fn () => UserService::logout());
$radapter->post('/services/user/select', fn (...$args) => UserService::select(...$args));
// need to be logged
$radapter->post('/services/user/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => UserService::insert(...$args));
$radapter->post('/services/user/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => UserService::update(...$args));
$radapter->post('/services/user/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => UserService::delete(...$args));

// CLIENTES
$radapter->post('/services/cliente/select', fn (...$args) => ClienteService::select(...$args));
$radapter->post('/services/cliente/insert', fn (...$args) => ClienteService::insert(...$args));
$radapter->post('/services/cliente/update', fn (...$args) => ClienteService::update(...$args));
// need to be logged
$radapter->post('/services/cliente/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => ClienteService::delete(...$args));

// SERVICIOS
$radapter->post('/services/servicio/select', fn (...$args) => ServicioService::select(...$args));
// need to be logged
$radapter->post('/services/servicio/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => ServicioService::insert(...$args));
$radapter->post('/services/servicio/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => ServicioService::update(...$args));
$radapter->post('/services/servicio/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => ServicioService::delete(...$args));


// HORAS
$radapter->post('/services/hora/select', fn (...$args) => HoraService::select(...$args));
// need to be logged
$radapter->post('/services/hora/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => HoraService::insert(...$args));
$radapter->post('/services/hora/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => HoraService::update(...$args));
$radapter->post('/services/hora/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => HoraService::delete(...$args));


// SLIDER
$radapter->post('/services/slider/select', fn (...$args) => SliderService::select(...$args));
// need to be logged
$radapter->post('/services/slider/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => SliderService::insert(...$args));
$radapter->post('/services/slider/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => SliderService::update(...$args));
$radapter->post('/services/slider/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => SliderService::delete(...$args));

// SOCIAL
$radapter->post('/services/social/select', fn (...$args) => SocialService::select(...$args));
// need to be logged
$radapter->post('/services/social/insert', fn () => middlewareSessionServicesLogin(), fn (...$args) => SocialService::insert(...$args));
$radapter->post('/services/social/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => SocialService::update(...$args));
$radapter->post('/services/social/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => SocialService::delete(...$args));

// MENSAJES
$radapter->post('/services/mensaje/select', fn (...$args) => MensajeService::select(...$args));
$radapter->post('/services/mensaje/insert', fn (...$args) => MensajeService::insert(...$args));
// need to be logged
// $radapter->post('/services/mensaje/update', fn (...$args) => MensajeService::update(...$args));
$radapter->post('/services/mensaje/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => MensajeService::delete(...$args));

// CITAS
$radapter->post('/services/cita/select', fn (...$args) => CitaService::select(...$args));
$radapter->post('/services/cita/insert', fn (...$args) => CitaService::insert(...$args));
// need to be logged
$radapter->post('/services/cita/update', fn () => middlewareSessionServicesLogin(), fn (...$args) => CitaService::update(...$args));
$radapter->post('/services/cita/delete', fn () => middlewareSessionServicesLogin(), fn (...$args) => CitaService::delete(...$args));
