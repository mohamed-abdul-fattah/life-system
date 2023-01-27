<?php
require_once __DIR__ . '/../vendor/autoload.php';
guest_check();
?>
<!DOCTYPE html>
<html lang="en">
<?php $title = 'Login' ?>
<?php include public_path('layouts/header.php'); ?>
<body>
<div class="login">

<!-- navbar -->
    <section>
        <?php include public_path("layouts/navbar.php") ?>
    </section>

<!-- error message -->
    <section>
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
    </section>

<!-- sign in  -->
    <section class="sign-form">
        <form class="sign-form__signin" action="<?php echo url('/loginPost.php') ?>" method="POST">        
            <h1 class="sign-form__signin--header header-1">
                sign in 
            </h1>
            
            <label for='email' class="sign-form__signin--eamil" >
                <input type="email" id="email" name="email" class="sign-form__input" placeholder="Email Address"/>
            </label>
            <label for='password' class="sign-form__signin--password">
                <input type="password" id="password" name="password" class="sign-form__input" placeholder="Password"/>
            </label>
            <a href="#"><button class="btn btn-white sign-form__signin--btn"><i class="icon icon-md-lock"></i>Log in</button></a>
        </form>
    </section>
        
<!-- footer -->
    <section class="footer">
        <?php include public_path("layouts/footer.php") ?>
    </section>

</div>

</body>
</html>
