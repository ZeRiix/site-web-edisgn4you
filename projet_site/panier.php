<?php include('includes/bdd.php'); ?>
<html>
<?php $namePage = 'Pannier'; include('includes/head.php'); ?>
<?php include('log.php'); ?>
<body>

    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php');?>
    <main>
<?php
// var_dump($_SESSION);
//echo '<br><br>';
//var_dump($_SESSION['panier']);
//echo '<br><br>';
$table = $_SESSION['panier'];
// print_r($table);
//echo '<br><br>';
//echo count($table);
$total = 0;
if ($table > 1) {
if (isset($table)) {
echo '<br>';
echo '<div  align="right" style="padding-right: 30px;"><a class="btn btn-primary" href="clear.php">vider le panier</a></div>';
}
for ($i = 1; $i <= count($table); $i++) {
    $total += $table[$i]['price'];
    echo '<div class="offrestyle">';
    echo '<div class="row">';
    echo '<div class="col-xl-6">';
    echo '<p class="text-vision"> offres créé par ' . $table[$i]['pseudo'] . ' - ' . $table[$i]['categorie'] . '</p>';
    echo '<img src="' . $table[$i]['images'] . '" width="250px" height="185px">';
    echo '</div>';
    echo '<div class="col-xl-6">';
    echo '<div><p class="titreoffres" name="title">' . $table[$i]['title'] . '</p></div>';
    echo '<p>' . $table[$i]['price'] . '€</p>';
    echo '<div class="contenu-offr">';
    echo '<p> Description: ' . $table[$i]['contenu'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="spacer20" id="spacer20"></div>';
}
echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Nombres d\'articles: '. count($table) . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp prix total: ' . $total . '€</b></p>';
if (isset($table)) {
    echo '<div  align="right" style="padding-right: 30px;"><a class="btn btn-primary" href="paiement.php?price=' . urlencode($total) . '">payer</a></div>';
}
} else {
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div align="center"><h1>Le panier est vide</h1></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
    echo '<div class="spacer50" id="spacer50"></div>';
}
?>
    </main>
    <div class="spacer50" id="spacer50"></div>
    <?php include('includes/footer.php'); ?>
</body>
</html>