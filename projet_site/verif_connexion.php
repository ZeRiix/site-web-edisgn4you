<?php

include 'includes/bdd.php';

if (isset($_POST['formconnexion'])) {

   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);

   if (!empty($mailconnect) AND !empty($mdpconnect)) {

      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();

      if ($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: captcha.php");
      } else {

         header("Location: connexion.php?message=Mauvais mail ou mot de passe !");
      }
   } else {
      header("Location: connexion.php?message=Tous les champs doivent être complétés !");
   }
}
?>