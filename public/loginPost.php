<?php

require_once __DIR__ . '/../helpers.php';
guest_check();

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    redirect('/');
}

$username = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (
    $username === getConfig('ADMIN')
    && $password === getConfig('PASSWORD')
) {
    $_SESSION['isLoggedIn'] = true;
    session_regenerate_id(true);
    redirect('/');
}

$_SESSION['errors'] = ['Your username or password is incorrect',];
redirect('/login.php');