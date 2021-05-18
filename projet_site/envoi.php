<?php

include('includes/bdd.php');

if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {

   if(isset($_POST['envoi_message'])) {

      if(isset($_POST['destinataire'],$_POST['message'],$_POST['objet']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['objet'])) {

         $destinataire = htmlspecialchars($_POST['destinataire']);
         $message = htmlspecialchars($_POST['message']);
         $objet = htmlspecialchars($_POST['objet']);

         $id_destinataire = $bdd->prepare('SELECT id FROM membres WHERE pseudo = ?');
         $id_destinataire->execute(array($destinataire));
         $dest_exist = $id_destinataire->rowCount();

         if($dest_exist == 1) {

            $id_destinataire = $id_destinataire->fetch();
            $id_destinataire = $id_destinataire['id'];
            $ins = $bdd->prepare('INSERT INTO messages(id_expediteur,id_destinataire,message_c,objet) VALUES (?,?,?,?)');
            $ins->execute(array($_SESSION['id'],$id_destinataire,$message,$objet));

            $error = "Votre message a bien été envoyé !";

         } else {
            $error = "Cet utilisateur n'existe pas...";
         }
      } else {
         $error = "Veuillez compléter tous les champs";
      }
   }
   $destinataires = $bdd->query('SELECT pseudo FROM membres ORDER BY pseudo');
   if(isset($_GET['r']) AND !empty($_GET['r'])) {
      $r = htmlspecialchars($_GET['r']);
   }
   if(isset($_GET['o']) AND !empty($_GET['o'])) {
      $o = urldecode($_GET['o']);
      $o = htmlspecialchars($_GET['o']);
      if(substr($o,0,3) != 'RE:') {
         $o = "RE:".$o;
      }
   }
   ?>
<html>

<?php $namePage = 'Reception'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php'); ?>
    <main>
      <div class="spacer20" id="spacer20"></div>
      <a class="btn btn-primary" href="reception.php">Boîte de réception</a>
      <div class="container-fluid" id="container-messages3">
        <form method="post">
            <!-- <select name="destinataire">
            <?php while($d = $destinataires->fetch()) { ?>
            <option><?= $d['pseudo'] ?></option>
            <?php } ?>
         </select> system de selection des utilisateur via une balise select avec une boucle qui créer des balise
         option dans le select pour afficher tt la colonne pseudo de la table membres possible ajout de lien entre
         utilisateur pour ajouter cette fonctionnalité -->
         <div class="spacer20" id="spacer20"></div>
            <label>Destinataire:</label>
            <input type="text" name="destinataire" <?php if(isset($r)) { echo 'value="'.$r.'"'; } ?> />
            <br><br>
            <label>Objet:</label>
            <input type="text" name="objet" <?php if(isset($o)) { echo 'value="'.$o.'"'; } ?> />
            <br><br>
            <textarea class="texte-message" placeholder="Votre message" name="message"></textarea>
            <br><br>
            <input type="submit" value="Envoyer" name="envoi_message">
            <br><br>
            <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } ?>
        </form>
      </div>
        <div class="spacer50" id="spacer50"></div>
    </main>
    <?php include('includes/footer.php'); ?>
</body>

</html>
<?php
}
?>
