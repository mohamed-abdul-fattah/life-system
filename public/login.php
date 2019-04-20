<?php require_once __DIR__ . '/../helpers.php' ?>
<!DOCTYPE html>
<html lang="en">
    <?php include public_path('layouts/header.php'); ?>
    <body>
        <div id="app">
            <?php include public_path("layouts/navbar.php") ?>
            <div class="container">
                <div class="card">
                    <div class="card-header">Please, Login...</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" id="email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" id="password" class="form-control">
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
