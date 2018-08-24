<?php
    session_start();
    require_once('./web.php');
    require_once('./processes/register.process.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FieldInsights</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php Asset::loadStyles(['general', 'forms', 'index-specific', 'colors', 'links']) ?>
    </head>
    <body>
        <div class="page-wrap">
            <div>
                <div class="site-icon">
                    <?php Asset::loadImage('fi-logo.png') ?>
                </div>
                <div class="form-wrapper">
                    <h3>Create Account</h3>
                    <div class="form-msg"><?=isset($msg) ? $msg :  ''?></div>
                    <form name="fi_reg" method="post" action="">
                        <?=Security::protectForm() ?>
                        <input type="text" name="fi-name" placeholder="Full Name">
                        <input type="email" name="fi-email" placeholder="Email Address">
                        <input type="tel" name="fi-phone" placeholder="Phone Number (e.g +2348123456789)">
                        <input type="password" name="fi-passwd" placeholder="Password">
                        <input type="password" name="fi-cpasswd" placeholder="Comfirm Password">
                        <input type="submit" name="fi-signup-sub" value="Register" class="bg-cool-blue no-border">
                    </form>
                </div>
                <div>Already have an account? <a href="./index.php">Sign In</a></div>
            </div>
        </div>
    </body>
</html>