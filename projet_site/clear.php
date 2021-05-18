<?php

session_start();

$_SESSION['panier'] = NULL;
header('location: index.php');

//print_r($_SESSION['pannier']);
//echo '<br><a href="index.php">retour</a>';