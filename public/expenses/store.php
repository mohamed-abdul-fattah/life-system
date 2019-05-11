<?php

require_once  __DIR__ . '/../../helpers.php';
require_auth();

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];
    $date = ($_POST['created_at']) ? $_POST['created_at'] : date('Y-m-d');

    $connection = open_connection();
    $query = "INSERT INTO `transactions` (`amount`, `comment`, `created_at`)
                VALUES ({$amount}, '{$comment}', '{$date}')";

    $result = mysqli_query($connection, $query);

}

redirect('/expenses');
