<?php

    // This handles the session start - if there's a running one it won't start a new one.
    if (session_status() == PHP_SESSION_NONE) {
        require 'includes/dbh.inc.php';
    }
    
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <!-- responsive scaling -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fonts -->
    <link href="https://bg.allfont.net/allfont.css?fonts=runic-altno" rel="stylesheet" type="text/css" />
    <link href="https://bg.allfont.net/allfont.css?fonts=ds-goose" rel="stylesheet" type="text/css" />
    <link href="https://bg.allfont.net/allfont.css?fonts=runic" rel="stylesheet" type="text/css" />
    <link href="https://bg.allfont.net/allfont.css?fonts=brushtype-normal" rel="stylesheet" type="text/css" />
    <link href="https://bg.allfont.net/allfont.css?fonts=fixsysctt" rel="stylesheet" type="text/css" />
    <link href="https://bg.allfont.net/allfont.css?fonts=roboto-condensed" rel="stylesheet" type="text/css" />


    <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="css/style-index.css">

    <title>ПловдивСкейтШоп064</title>
</head>
<body>

    <header>
        <!-- feedback message container -->
        <div class="sticky-top">
            <h1 id="feedback" class="noedit">
            </h1>
            <h1 id="feedback-failure" class="noedit">
            </h1>
        </div>

        <!-- page banner -->
        <div id="banner">
			<div class="title-right"><h1>Пловдив 064 </h1></div>
			<div id="logo"><img src="img/index/logo.png"></div>
			<div class="title-left"><h1> Скейт Магазин</h1></div>
		</div>

        <!-- page menu -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon icon-bar"><i class="fa fa fa-bars" aria-hidden="true" style="color:#e6e6ff"></i></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Начало <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="blogs.php">Статии</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="products.php">Продукти</a>
                                </li>

                                <?php
                                    if (isset($_SESSION['role_users']) and $_SESSION['role_users'] === 'admin') {
                                        echo '
                                            <li class="nav-item">
                                                <a class="nav-link" href="edit_product.php?target_id=create">Добави продукт</a>
                                            </li>
                                        ';
                                    }
                                ?>

                                <?php
                                    if (isset($_SESSION['userId'])) {
                                        echo '
                                            <li class="nav-item">
                                                <a class="nav-link" href="update_user.php">Актуализация на профила</a>
                                            </li>
                                        ';
                                    }
                                ?>

                                <?php
                                    if (isset($_SESSION['userId'])) {
                                        echo '
                                            <li class="nav-item">
                                                <a class="nav-link" href="delete_user.php" style="color:red;">Изтриване на профила</a>
                                            </li>
                                        ';
                                    }
                                ?>

                            </ul>

                            <!-- login form -->
							<?php include "includes/login.form"; ?>

                        </div>
                    </nav>	
                </div>
            </div>
        </div>

        <!-- This handles the teaser message the user gets - whether he is logged in the system or not. -->
        <section id="register-form">
            <?php
                if (!isset($_SESSION["userId"]))
                {?>
                    <p>Все още нямаш акаунт? </p>
			        <button>
				        <a href="register.php">Регистрирай се сега!</a>
			        </button>
            <?php }
                else echo "<p>Желаете да се сдобиете с най-новите дъски на пазара? </p>" . " <button> <a href='products.php'> Пазарувайте сега!</a> </button>";
            ?>
        </section>
    </header> 

    
</body>
</html>