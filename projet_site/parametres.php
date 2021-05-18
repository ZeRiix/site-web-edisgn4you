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

include('includes/bdd.php');

$id = $_SESSION['id'];

if (isset($_POST['submit'])) {
  if (isset($_POST['numcarte']) AND isset($_POST['dateexp']) AND isset($_POST['crypto']) AND isset($_POST['titulaire'])) {
    print_r(array($_POST['numcarte'], $_POST['dateexp'], $_POST['crypto'], $_POST['titulaire']));
    $num = sha1($_POST['numcarte']);
    $date = htmlspecialchars($_POST['dateexp']);
    $crypto = sha1($_POST['crypto']);
    $titulaire = htmlspecialchars($_POST['titulaire']);

    if (verif_num($_POST['numcarte']) == true) {
      if (verif_num($_POST['crypto']) == true) {
        if (verif_alpha($_POST['titulaire']) == true) {
          $sizecrypto = strlen($_POST['crypto']);
          if ($sizecrypto == 3) {
            $sizenum = strlen($_POST['numcarte']);
            if ($sizenum == 16) {
              $insertpa = $bdd->prepare('INSERT INTO carte(numcarte,crypto,date_exp,titu,id_user)');
              $insertpa->execute(array($num, $crypto, $date, $titulaire,$_SESSION['id']));
              header("location:profil.php?id=$id&erreur=vos information bancaire on été modifié");
            } else {
              if ($sizenum > 16) {
                header("location:parametres.php?erreur=numero de la carte trop long");
              }
              elseif ($sizenum < 16) {
                header("location:parametres.php?erreur=numero de la carte trop court");
              }
            }
          } else {
            if ($sizenum > 3) {
              header("location:parametres.php?erreur=le cryptogramme est trop long");
            }
            elseif ($sizenum < 3) {
              header("location:parametres.php?erreur=le cryptogramme est trop court");
            }
          }

        } else {
          header("location:parametres.php?erreur=le nom du titulaire ne peux etre composé uniquement de lettre");
        }
      } else {
        header("location:parametres.php?erreur=le cryptogramme ne peux etre composé que de nombre");
      }
    } else {
      header("location:parametres.php?erreur=les numéros de la carte ne peuvent être uniquement composés de nombres");
    }
  } else {
    header("location:parametres.php?erreur=Merci de remplir tout les champs");
  }
}

?>
<html>
<?php $namePage = 'Paramètres'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php');?>
    <main>
        <div class="spacer50" id="spacer50"></div>
        <div class="container-fluid" id="container-para">
            <h1>Mes informations bancaires</h1>
            <div class="container-fluid" id="container-gestion">
                <div class="container-fluid" id="container-gestion5">
                    <form method="post" enctype="multipart/form-data">
                        <input type="text" class="form-parametres" name="numcarte" placeholder="Numéro de carte *">
                        <br><label style="font-size: 13px; color: grey;">Entrez le numéro de la carte</label>
                        <div class="spacer10" id="spacer10"></div>
                        <input type="text" class="form-parametres" name="dateexp" placeholder="Date d'expiration *">
                        <br><label style="font-size: 13px; color: grey;">Date d'expiration</label>
                        <div class="spacer10" id="spacer10"></div>
                        <input type="password" class="form-parametres" name="crypto" placeholder="Cryptogramme *">
                        <br><label style="font-size: 13px; color: grey;">Cryptogramme au dos de la carte</label>
                        <div class="spacer10" id="spacer10"></div>
                        <input type="text" class="form-parametres" name="titulaire" placeholder="Titulaire *">
                        <br><label style="font-size: 13px; color: grey;">Nom complet du titulaire</label>
                        <div class="spacer10" id="spacer10"></div>
                        <input type="submit" class="submitparametres" name="submit" value="Valider">
                    </form>
                </div>
            </div>
        </div>
        <div class="spacer20" id="spacer20"></div>
        <div class="container" id="cont-para">
            <?php
    echo '<a href="profil.php?id=' . $_SESSION['id'] . '" class="btn btn-primary">Retour profil</a>';
    ?>
        </div>
    </main>
    <div class="spacer50" id="spacer50"></div>
    <?php include('includes/footer.php'); ?>

</body>

</html>
