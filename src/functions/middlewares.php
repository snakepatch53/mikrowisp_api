<?php
function middlewareSessionLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . $_ENV['HTTP_DOMAIN'] . 'panel/login');
        exit();
    }
}

function middlewareSessionLogout()
{
    if (isset($_SESSION['user_id'])) {
        header('Location: ' . $_ENV['HTTP_DOMAIN'] . 'panel');
        exit();
    }
}

function middlewareSessionTipoUser_login()
{
    middlewareSessionLogin();
    if ($_SESSION['user_tipo'] != 'user') {
        header('Location: ' . $_ENV['HTTP_DOMAIN'] . 'panel');
        exit();
    }
}


function middlewareSessionServicesLogin()
{
    if (!isset($_SESSION['user_id'])) {
        return [
            'autorized' => false,
        ];
    }
    return [
        'autorized' => true,
    ];
}
