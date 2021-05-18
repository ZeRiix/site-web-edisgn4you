<?php include('includes/bdd.php'); ?>
<html>
<?php $namePage = 'Paiement'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php');?>
    <main>
        <div class="spacer50" id="spacer50"></div>

        <?php

// fucntion alpha
function verif_alpha($str){
  preg_match("/([^A-Za-z\s])/",$str,$result);
  if(!empty($result)){
    return false;
  }
  return true;
};
// function num
function verif_num($ntr){
  preg_match("/([^0-9\s])/",$ntr,$results);
  if(!empty($results)){
    return false;
  }
  return true;
};

print_r($_SESSION);

if (isset($_SESSION['panier'])) {
  $reqcarte = $bdd->prepare('SELECT * FROM carte WHERE id_user = ?');
  $reqcarte->execute(array($_SESSION['id']));
  $carteexist = $reqcarte->rowCount();
  $price = urlencode($_GET['price']);

  if ($carteexist == 1) {

    echo '<div align="center><a href="supprimer.php">merci d\'avoir effectuer un achat sur notre site</a></div>';

  } else {
    if (isset($_POST['pa'])) {
      if (isset($_POST['num']) AND isset($_POST['date']) AND isset($_POST['cry']) AND isset($_POST['titu'])) {
        $num = htmlspecialchars($_POST['num']);
        $date = htmlspecialchars($_POST['date']);
        $titu = htmlspecialchars($_POST['titu']);
        $cry = sha1($_POST['cry']);
        if (verif_num($num) == true) {
          $sizenum = strlen($num);
          if ($sizenum == 10) {
            $sizedate = strlen($date);
            if ($sizedate == 5) {
              if (verif_num($_POST['cry']) == true) {
                $sizecry = strlen($_POST['cry']);
                if ($sizecry == 3) {
                  if (verif_alpha($titu) == true) {
                    $header = 'MINE-Version: 1.0\r\n';
									   $header .= 'From:"[e-design4you]"<e-design4you@gmail.com>' . '\n';
									   $header .= 'Content-Type:text/html; charset="utf-8"' . '\n';
									   $header.='Content-Transfer-Encoding: 8bit';
										  $mailpaiement='
										   <html>
												  <body>
													 <div align="center">
														<p>Merci d\'avoir effectuer un achat sur notre site</p>
														<p>le montant de vôtre achat s\'élève a : .$price. </p>
													 </div>
												  </body>
										   </html>
										  ';
									   mail($_SESSION['mail'], "Confirmation de compte", $mailpaiement, $header);
                  } else {
                    header('location:paiement.php?erreur=le nom du titulaire est incorrect');
                  }
                } else {
                  header('location:paiement.php?erreur=la taille du cryptogramme est incorrect');
                }
              } else {
                header('location:paiement.php?erreur=le cryptogramme est incorrect');
              }
            } else {
              header('location:paiement.php?erreur=la date est incorrect');
            }
          } else {
            header('location:paiement.php?erreur= le nombre de chiffres est incorrect');
          }
        } else {
          header('location:paiement.php?erreur=les numéros sont incorrects');
        }
      } else {
        header('location:paiement.php?erreur=merci de remplir tous les champs !');
      }
    }
    //

?>
        <div class="container-fluid" id="valide-achat">
            <div class="container-fluid" id="container-paiement">
                <div class="row">
                    <div class="col-xl-9" id="col-cb">
                        <h1>Votre carte bancaire</h1>
                    </div>
                    <div class="col-xl-3" id="col-cb-img">
                        <img src="images/picto_cb.png">
                    </div>
                </div>
                <div class="spacer5" id="spacer5"></div>
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="text" class="form-profil" name="num" placeholder="Numéro de carte *">
                    <div class="spacer20" id="spacer20"></div>
                    <input type="text" class="form-profil" name="date" placeholder="Date d'expiration *">
                    <div class="spacer20" id="spacer20"></div>
                    <input type="password" class="form-profil" name="cry" placeholder="Cryptogramme *">
                    <div class="spacer20" id="spacer20"></div>
                    <input type="text" class="form-profil" name="titu" placeholder="Titulaire *">
                    <div class="spacer20" id="spacer20"></div>
            </div>
            <div class="spacer20" id="spacer20"></div>
            <h2>En validant ma commande, je déclare avoir pris connaissance et accepté sans réserve la politique de
                données personelles du site e-design4you.com</h2>
            <div class="spacer20" id="spacer20"></div>
            <?php echo '<div align="center"><p><strong>total à payer : ' . $_GET['price'] . '€</strong></p></div>';?>
            <input type="submit" class="submitprofil" name="pa" value="Payer" id="boutton-payer">
            </form>
<?php }} ?>
            <?php
    echo '<br>';
    echo '<a href="panier.php" class="btn btn-primary">retour panier</a>';
    ?>
        </div>
    </main>
    <div class="spacer50" id="spacer50"></div>
    <?php include('includes/footer.php'); ?>

</body>

</html>