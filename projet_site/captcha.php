<?php

$namePage = 'Captcha';

session_start();

$rand = rand(0,8);
$table = array("image_captcha/1.jpg", "image_captcha/2.jpg", "image_captcha/3.jpg", "image_captcha/4.jpg", "image_captcha/5.jpg", "image_captcha/6.jpg", "image_captcha/7.jpg", "image_captcha/8.jpg", "image_captcha/9.jpeg");
$tableCo = array("connexion.php", "connexion.php", "connexion.php", "connexion.php", "connexion.php", "connexion.php", "connexion.php", "connexion.php", "connexion.php");
// print_r($table);
$intru = "image_captcha/intru.jpg";
$intruCo = "profil.php?id=" . $_SESSION['id'];
$table[$rand] = $intru;
$tableCo[$rand]= $intruCo;

?>


<html>

<head>
    <title><?=$namePage?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
    <link rel="stylesheet" href="style/styleCaptcha.css">
</head>

<header>
    <div class="container-fluid" id="banner-connexion">
        <div align="center">
            <img src="images/head_connexion.png">
        </div>
    </div>
</header>

<body align="center">
    <div align="center"><h2>Trouvez l'intrus :</h2></div>
    <div class="row">
        <div class="col-xl-2"></div>
        <div id="id" class="col-xl-8">
            <div class="grid" style="margin-left: 300px">
                <div class="grid1">
                    <a href="<?php echo $tableCo[0]?>"><img src="<?php echo $table[0]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[1]?>"><img src="<?php echo $table[1]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[2]?>"><img src="<?php echo $table[2]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[3]?>"><img src="<?php echo $table[3]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[4]?>"><img src="<?php echo $table[4]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[5]?>"><img src="<?php echo $table[5]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[6]?>"><img src="<?php echo $table[6]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[7]?>"><img src="<?php echo $table[7]?>" width="100%" height="100%"></a>
                </div>
                <div class="grid1">
                    <a href="<?php echo $tableCo[8]?>"><img src="<?php echo $table[8]?>" width="100%" height="100%"></a>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </div>
    </div>
</body>
