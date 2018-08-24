<?php
    require_once('./processes/check-login-status.process.php');
    require_once('./web.php');
    require_once('./processes/load-user-info.process.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FieldInsights</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            Asset::loadStyles(['general', 'forms', 'home-specific', 'colors', 'links']);
            Asset::loadScripts(['system.js','fi-hobby.js'])
        ?>
    </head>
    <body>
        <div class="page-wrap">
           <section class="left-sec">
                <header>
                    <div class="site-icon">
                        <?php Asset::loadImage('fi-logo.png');?>
                    </div>
                </header>
                <div>
                    <div class="card">
                        <div id="form-message"></div>
                        <form name="add_hobby" action="" method="post">
                            <?= Security::protectForm() ?>
                            <input type="text" name="hobby_name" id="hobby" placeholder="Enter a Hobby" class="curved-border">
                            <input type="button" name="hobby-sub" id="add-hobby-btn" value="Add Hobby" class="right short-btn bg-cool-blue curved-border">
                        </form>
                    </div>
                    <div class=" card hobby-list-wrap">
                        <h3>Your Hobbies:</h3>
                        <div id="hobby-list">
                            <?php
                                foreach($hobbies as $hobby)
                                {
                                    echo "<span>".$hobby."</span>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
           </section>
           <section class="right-sec">
                <div class="veil">
                    <header>
                        <button id="logout">log Out</button>
                    </header>
                    <div class="about-wrapper">
                        <div>
                            <h1>ABOUT</h1>
                            <h3>App:</h3>
                            <p></p>
                            <p></p>
                            <h3>Developer:</h3>
                            <p></p>
                            <p></p>
                        </div>
                    </div>
                </div>
           </section>
        </div>
    </body>
</html>