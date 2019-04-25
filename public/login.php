<?php
require_once __DIR__ . '/../helpers.php';
guest_check();
?>
<!DOCTYPE html>
<html lang="en">
<?php $title = 'Login' ?>
<?php include public_path('layouts/header.php'); ?>
<body>
<div id="app">
    <?php include public_path("layouts/navbar.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header">Please, Login...</div>
            <div class="card-body">
                <?php if ( isset($_SESSION['errors']) ): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ( $_SESSION['errors'] as $error ): ?>
                                <li><?php echo $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php
                unset($_SESSION['errors']);
                endif;
                ?>
                <form action="<?php echo url('/loginPost.php') ?>" method="POST">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" name="email" class="form-control" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary" value="Login"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>
</body>
</html>
