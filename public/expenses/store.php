<?php

require __DIR__ . '/../../vendor/autoload.php';
require_auth();

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $connection = open_connection();

    $amount = mysqli_real_escape_string($connection, trim($_POST['amount']));
    $categoryId = ($_POST['category_id'])
        ? mysqli_real_escape_string($connection, trim($_POST['category_id']))
        : 'NULL';
    $comment = mysqli_real_escape_string($connection, trim($_POST['comment']));
    $date = ($_POST['created_at'])
        ? mysqli_real_escape_string($connection, trim($_POST['created_at']))
        : date('Y-m-d');

    $query = "INSERT INTO `transactions` (`category_id`, `amount`, `comment`, `created_at`)
                VALUES ({$categoryId}, {$amount}, '{$comment}', '{$date}')";

    $result = mysqli_query($connection, $query);

    if ( $result ) {
        session_push('message', 'Expense added successfully');
        session_push('alert', 'success');
    } else {
        session_push('message', 'Whoops, something went wrong!');
        session_push('alert', 'danger');
    }
    close_connection($connection);
}

redirect('/expenses');
