<?php

require_once __DIR__ . '/../helpers.php';
guest_check();

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    redirect('/');
}

$username = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (
    $username === 'csmohamed8@gmail.com'
    && $password === 'secret'
) {
    $_SESSION['isLoggedIn'] = true;
    session_regenerate_id(true);
    redirect('/');
}

$_SESSION['errors'] = ['You username or password is incorrect',];
redirect('/login.php');