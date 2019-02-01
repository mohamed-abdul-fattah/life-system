<!DOCTYPE html>
<html lang="en">
<?php
    include __DIR__ . "/../helpers.php";
    include public_path("layouts/header.php");
?>
<?php
    $month      = date('Y-m-00');
    $connection = mysqli_connect('localhost', 'root', '123456', 'abdul_fattah');
    $query      = "SELECT SUM(`amount`) AS 'total' FROM `transactions` WHERE `created_at` > '{$month}'";
    $sumQuery   = mysqli_query($connection, $query);
    $monthTotal = mysqli_fetch_object($sumQuery)->total;
?>
<body>
    <div id="app">
        <?php include public_path("layouts/navbar.php") ?>
        <div class="container">
            <div class="row">
              <p class="month-summary">Money spent this month</p>
              <p class="month-summary
              <?php
                if ( $monthTotal < 1500 ) {
                    echo "text-success";
                } elseif ( $monthTotal < 2000 ) {
                    echo "text-warning";
                } else {
                    echo "text-danger";
                }
              ?>"><?php echo (float) $monthTotal; ?> <i class="fa fa-money" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
    <?php include public_path("layouts/footer.php") ?>
</body>
</html>
