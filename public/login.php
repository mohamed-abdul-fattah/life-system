<?php
require_once __DIR__ . '/../vendor/autoload.php';
guest_check();
?>
<!DOCTYPE html>
<html lang="en">
<?php $title = 'Login' ?>
<?php include public_path('layouts/header.php'); ?>
<body id="login">
<div id="app">
<!-- navbar -->
    <?php include public_path("layouts/navbar.php") ?>
    <div class="card-container">
<!-- error message -->
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
<!-- sign in  -->
        <form class="sign-in-form" action="<?php echo url('/loginPost.php') ?>" method="POST">        
            <div class="segment">
                <h1 style="color:#bfbfbf">Sign in</h1>
            </div>
            
            <label for='email'>
                <input type="email" id="email" name="email"  placeholder="Email Address"/>
            </label>
            <label for='password' >
                <input type="password" id="password" name="password" placeholder="Password"/>
            </label>
            <a href="#"><button class="red"><i class="icon ion-md-lock"></i>Log in</button></a>
        </form>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>

</body>
</html>
