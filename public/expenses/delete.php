<?php
require_once __DIR__ . "/../../helpers.php";
require_auth();

if ( $_POST['_method'] === 'DELETE' ) {
    $expenseId = $_POST['expenseId'];

    if ( $expenseId ) {
        $connection = mysqli_connect('localhost', 'root', '123456', 'abdul_fattah');
        $query = "DELETE FROM `transactions` WHERE `id` = " . $expenseId;
        mysqli_query($connection, $query);

        // Needs error handling
    }
}

// TODO: Needs a session message

redirect('/expenses/');
