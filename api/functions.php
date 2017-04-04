<?php

function pre($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function sess_put($key, $value)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION[$key] = $value;
}

function sess_all()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    return $_SESSION;
}

function sess_has($key)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    return isset($_SESSION[$key]);
}

function sess_destroy()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();
}
