<?php

require_once __DIR__ . '/../../helpers.php';
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
    mysqli_query($connection, $query);
    redirect('/expenses/edit.php?id=' . $id);
}

redirect('/expenses');