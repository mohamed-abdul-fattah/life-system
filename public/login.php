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
        <!-- <div class='both'> -->
<!-- sign up  -->
        <!-- <div class="signup">
        <div class="signup-connect">
            
            <a href="#" class="social-btn btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
            <a href="#" class="social-btn btn-social btn-twitter"><i class="fa fa-twitter"></i> Sign in with Twitter</a>
            <a href="#" class="social-btn btn-social btn-google"><i class="fa fa-google"></i> Sign in with Google</a>
            <a href="#" class="social-btn btn-social btn-linkedin"><i class="fa fa-linkedin"></i> Sign in with Linkedin</a>
        </div>
        </div> -->
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
            <!-- <div class="small-social">
                <a href="#"><button> <i class="fa fa-facebook"> </button></i></a>
                <a href="#"><button><i class="fa fa-twitter"></button></i></a>
                <a href="#"><button><i class="fa fa-google"></button></i></a>
                <a href="#"><button><i class="fa fa-linkedin"></button></i></a>
            </div> -->
        </form>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>

</body>
</html>
