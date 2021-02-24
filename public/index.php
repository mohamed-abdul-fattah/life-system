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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" 
        integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" 
        crossorigin="anonymous">
</script>

<script defer src="<?php echo url('assets/js/chart.js') ?>"></script>
<script defer src="<?php echo url('assets/js/globalFunctions.js') ?>"></script>

<body>
    <div class="home">
        <section>
            <?php include public_path("layouts/navbar.php") ?>
        </section>
        <section>
                <a href="<?php echo url('expenses/create.php') ?>" class="btn btn__fixed">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
        </section>
        <section class="home__expenses">
            <div class="card">
                <div class="card__chart">
                    <div class="card__chart--container">
                        <canvas id="chart" ></canvas>
                    </div>
                </div>
                <div class="card__btns">
                    <button class="btn card__btns--display" ><img class="card__btns--icon" src="https://img.icons8.com/fluent/48/000000/expand-arrow.png"/></button>
                    <button class="btn card__btns--line"    ><img class="card__btns--icon" src="https://img.icons8.com/officel/80/000000/area-chart.png"/></button>
                    <button class="btn card__btns--bar"     ><img class="card__btns--icon" src="https://img.icons8.com/offices/30/000000/bar-chart.png"/></button>
                    <button class="btn card__btns--doughnut"><img class="card__btns--icon" src="https://img.icons8.com/officel/80/000000/doughnut-chart.png"/></button>
                    <button class="btn card__btns--polar"   ><img class="card__btns--icon" src="https://img.icons8.com/ultraviolet/40/000000/rebalance-portfolio.png"/></button>
                    <button class="btn card__btns--legends" ><img class="card__btns--icon" src="https://img.icons8.com/fluent/48/000000/arrow.png"/></button>
                </div>
                <div class="card__data">
                    <p class="month-summary">Money spent monthly</p>
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
                </div>
            </div>
            <div class="legend"></div>
                
        </section>
        <section class='footer'>
                    <?php include public_path("layouts/footer.php") ?>
        </section>
    </div>
</body>
</html>
