<?php

include('includes/bdd.php');

if (isset($_POST['form-secu'])) {
  if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM membrespro WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membrespro SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: pagesecurite.php?yes=yes');
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
  }
}
?>
<html>
<?php $namePage = 'Connexion & Sécurité'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/headerPro.php'); ?>
    <?php include('includes/message.php');?>
    <main>
        <div class="spacer50" id="spacer50"></div>
        <div class="container-fluid" id="container-secu">
            <h1><strong> Connexion et sécurité</strong></h1>
            <div class="spacer20" id="spacer20"></div>
            <form method="post" action="">
                <div class="row">
                    <div class="col-lg-12" id="row-newmdp">
                        <label>Nouveau mot de passe<h1>champ requis</h1></label>
                        <input class="form-control" type="password" name="newmdp1" placeholder="Nouveau mot de passe">
                    </div>
                </div>
                <div class="spacer20" id="spacer20"></div>
                <div class="row">
                    <div class="col-xl-12" id="row-oldmdp">
                        <label>Mot de passe actuel<h1>champ requis</h1></label>
                        <input class="form-control" type="password" name="newmdp2" placeholder=" Confirmer nouveau mot de passe">
                    </div>
                </div>
                <div class="spacer20" id="spacer20"></div>
                <input type="submit" class="btn btn-outline-success" name="form-secu" value="Modifier mon mot de passe">
            </form>
            <?php
            if (isset($_GET['yes'])) {
              echo '<a href="profil.php?id=' . $_SESSION['id'] . '" class="btn btn-primary">retour profil</a>';
            }
            ?>
        </div>
    </main>
    <div class="spacer50" id="spacer50"></div>
    <?php include('includes/footer.php'); ?>

</body>

</html>