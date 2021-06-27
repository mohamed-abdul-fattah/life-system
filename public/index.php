<?php
require __DIR__ . '/../vendor/autoload.php';
require_auth();
?>
<!DOCTYPE html>
<html lang="en">
<?php include public_path('layouts/header.php'); ?>
<?php
$month = date('Y-m-01');
$connection = open_connection();
$query = "SELECT SUM(`amount`) AS 'total' FROM `transactions` WHERE `created_at` > '{$month}'";
$sumQuery = mysqli_query($connection, $query);
$monthTotal = mysqli_fetch_object($sumQuery)->total;
?>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" 
            integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" 
            crossorigin="anonymous">
    </script>
    <script defer src="<?php echo url('dist/js/home.js') ?>"></script>
</head>
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
            <div class="card--container">
            <div class="card">
                <div class="card__chart">
                    <div class="card__chart--container">
                        <canvas id="chart" ></canvas>
                    </div>
                </div>
                <div class="card__btns">
                    <button class="btn card__btns--display" ><i class="fa fa-chevron-down"></i></button>
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
            </div>

                
        </section>
        <section class='footer'>
                    <?php include public_path("layouts/footer.php") ?>
        </section>
    </div>
</body>
</html>
