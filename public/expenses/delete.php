<?php
require_once __DIR__ . "/../../helpers.php";
require_auth();

if ( $_POST['_method'] === 'DELETE' ) {
    $expenseId = $_POST['expenseId'];

    if ( $expenseId ) {
        $connection = open_connection();
        $query = "DELETE FROM `transactions` WHERE `transactions`.`id`={$expenseId}";
        mysqli_query($connection, $query);
        close_connection($connection);

        // Needs error handling
    }
}

// TODO: Needs a session message

redirect('/expenses/');
