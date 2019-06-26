<?php

require __DIR__ . '/../../vendor/autoload.php';
require_auth();

$id = $_GET['id'];
if ( $_POST['_method'] === 'PUT' && ! empty($id) ) {
    $connection = open_connection();

    $amount = mysqli_real_escape_string($connection, trim($_POST['amount']));
    $comment = mysqli_real_escape_string($connection, trim($_POST['comment']));
    $date = mysqli_real_escape_string($connection, $_POST['created_at']);
    $id = mysqli_real_escape_string($connection, $id);
    $query = "UPDATE `transactions`
              SET `transactions`.`amount`={$amount},
                  `transactions`.`comment`='{$comment}',
                  `transactions`.`created_at`='{$date}'
              WHERE `transactions`.`id`={$id}";
    $update = mysqli_query($connection, $query);

    if ( $update ) {
        session_push('message', 'Expense updated successfully');
        session_push('alert', 'success');
    } else {
        session_push('message', 'Whoops, something went wrong!');
        session_push('alert', 'danger');
    }
    close_connection($connection);
}

redirect('/expenses');