<?php
require_once __DIR__ . '/../vendor/autoload.php';
guest_check();
?>
<!DOCTYPE html>
<html lang="en">
<?php $title = 'Login' ?>
<?php include public_path('layouts/header.php'); ?>
<body>
<section class="login">
<!-- navbar -->
<div>
    <?php include public_path("layouts/navbar.php") ?>
</div>

<!-- error message -->
<div>
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
</div>

<!-- sign in  -->
<div class="form">
    <form class="form__signin" action="<?php echo url('/loginPost.php') ?>" method="POST">        
        <h1 class="form__signin--header header-1">
            sign in 
        </h1>
        
        <label for='email' class="form__signin--eamil" >
            <input type="email" id="email" name="email" class="form__input" placeholder="Email Address"/>
        </label>
        <label for='password' class="form__signin--password">
            <input type="password" id="password" name="password" class="form__input" placeholder="Password"/>
        </label>
        <a href="#"><button class="btn btn-white form__signin--btn"><i class="icon icon-md-lock"></i>Log in</button></a>
    </form>
</div>
    
<!-- footer -->
<div class="footer">
    <?php include public_path("layouts/footer.php") ?>
</div>
</section>

</body>
</html>
