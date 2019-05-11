<?php
require_once __DIR__ . "/../../helpers.php";
require_auth();

if ( $_POST['_method'] === 'DELETE' ) {
    $expenseId = $_POST['expenseId'];

    if ( $expenseId ) {
        $connection = open_connection();
        $query = "DELETE FROM `transactions` WHERE `transactions`.`id`={$expenseId}";
        $delete = mysqli_query($connection, $query);

        if ( $delete ) {
            session_push('message', 'Expense deleted successfully');
            session_push('alert', 'success');
        } else {
            session_push('message', 'Whoops, something went wrong!');
            session_push('alert', 'danger');
        }
        close_connection($connection);
    }
}

redirect('/expenses/');
