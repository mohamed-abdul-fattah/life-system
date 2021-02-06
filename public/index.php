<?php
require __DIR__ . '/../vendor/autoload.php';
require_auth();
?>
<!DOCTYPE html>
<html lang="en">
<?php include public_path('layouts/header.php'); ?>
<?php
$month = date('Y-m-00');
$connection = open_connection();
$query = "SELECT SUM(`amount`) AS 'total' FROM `transactions` WHERE `created_at` > '{$month}'";
$sumQuery = mysqli_query($connection, $query);
$monthTotal = mysqli_fetch_object($sumQuery)->total;
?>
<body>
    <div class="home">
    
        <section>
            <?php include public_path("layouts/navbar.php") ?>
        </section>

        <section class="home__expenses">
            <div class="home__expenses--content">
                
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
                        ?>"><?php echo (float) $monthTotal; ?> <i class="fa fa-money" aria-hidden="true"></i>
                    </p>
                
         </section>

        <section class='footer'>
                    <?php include public_path("layouts/footer.php") ?>
        </section>

    </div>
</body>
</html>
