<?php
$_TEMPLATE_PUBLIC_PATH = './src/templates/public.pages/';
$radapter = new RAdapter($router, $_TEMPLATE_PUBLIC_PATH, $_ENV['HTTP_DOMAIN']);


/**
 * ? El error a quedado solucionado
 */
// HOME
$radapter->getHTML('/index.php', 'home', function ($DATA) {
    return [
        'info' => (new InfoDao($DATA['mysqlAdapter']))->select()
    ];
});

$radapter->getHTML('/', 'home', function ($DATA) {
    return [
        'info' => (new InfoDao($DATA['mysqlAdapter']))->select()
    ];
});

// 404
$radapter->set404('404', function ($DATA) {
    return [
        'info' => (new InfoDao($DATA['mysqlAdapter']))->select(),
    ];
});
