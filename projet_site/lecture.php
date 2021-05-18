<?php

include('includes/bdd.php');

if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {

   if(isset($_GET['id']) AND !empty($_GET['id'])) {

      $id_message = intval($_GET['id']);
      $msg = $bdd->prepare('SELECT * FROM messages WHERE id = ? AND id_destinataire = ?');
      $msg->execute(array($_GET['id'],$_SESSION['id']));
      $msg_nbr = $msg->rowCount();
      $m = $msg->fetch();
      $p_exp = $bdd->prepare('SELECT pseudo FROM membres WHERE id = ?');
      $p_exp->execute(array($m['id_expediteur']));
      $p_exp = $p_exp->fetch();
      $p_exp = $p_exp['pseudo'];
?>
<!DOCTYPE html>
<html>

<?php $namePage = 'Reception'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php'); ?>
    <main>
      <div class="spacer20" id="spacer20"></div>
      <div class="container-fluid">
        <a class="btn btn-primary" href="reception.php">Boîte de réception</a>
        <div class="spacer20" id="spacer20"></div>
        <p style="text-align:center; font-size:1.5em; text-decoration:underline;">Lecture du message #<?php echo $id_message; ?></p>
        <div class="container-fluid" id="container-messages2">
            <?php if($msg_nbr == 0) { echo "Erreur"; } else { ?>
              <b>De: </b> <?php echo $p_exp; ?><br>
            <b>Objet:</b> <?php echo $m['objet']; ?>
            <br><br>
            <b>Contenu:</b><br> <?php echo nl2br($m['message_c']); ?><br />
            <?php } ?>
            <br></br>
            <a class="btn btn-primary" href="supprimer.php?id=<?php echo $m['id']; ?>">Supprimer</a>
            <a style="float:right;" class="btn btn-primary" href="envoi.php?r=<?php echo $p_exp; ?>&o=<?php echo urlencode($m['objet']); ?>">Répondre</a>
        </div>
      </div>
      <div class="spacer50" id="spacer50"></div>
    </main>
    <?php include('includes/footer.php'); ?>
</body>

</html>
<?php
      $lu = $bdd->prepare('UPDATE messages SET lu = 1 WHERE id = ?');
      $lu->execute(array($m['id']));
   }
}
?>
