<?php
    include __DIR__. "/../../helpers.php";

    if ($_POST['_method'] === 'DELETE') {
        $expenseId = $_POST['expenseId'];

        if ($expenseId) {
            $connection = mysqli_connect('localhost', 'root', 'toor', 'abdul_fattah');
            $query      = "DELETE FROM `transactions` WHERE `id` = " . $expenseId;
            mysqli_query($connection, $query);

            // Needs error handling
        }
    }

    // TODO: Needs a session message

    redirect('/expenses/');
