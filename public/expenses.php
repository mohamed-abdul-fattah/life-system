<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Expenses';
    include "layouts/header.php";

    $connection = mysqli_connect('localhost', 'root', 'toor', 'abdul_fattah');
    $expenses   = mysqli_query($connection, 'SELECT * FROM transactions;');
?>
<body>
<div id="app">
    <?php include "layouts/navbar.php" ?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Expenses</h2>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php while ($expense = mysqli_fetch_object($expenses)): ?>
                                <tr>
                                    <td><?php echo $expense->amount ?></td>
                                    <td><?php echo $expense->comment ?></td>
                                    <td><?php echo $expense->created_at ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "layouts/footer.php" ?>
</body>
</html>
