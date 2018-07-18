<!DOCTYPE html>
<html lang="en">
<?php
    include __DIR__. "/../../helpers.php";
    $title = 'Add Expense';
    include public_path("layouts/header.php");
?>
<body>
<div id="app">
    <?php include public_path("layouts/navbar.php") ?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="title">Add Expense</h2>
                    <a href="<?php echo url('expenses') ?>" class="btn btn-warning btn-sm float-right">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Back
                    </a>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>
</body>
</html>
