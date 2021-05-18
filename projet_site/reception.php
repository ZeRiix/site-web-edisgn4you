<?php

include('includes/bdd.php');

if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
$msg = $bdd->prepare('SELECT * FROM messages WHERE id_destinataire = ? ORDER BY id DESC');
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();

?>
<html>
<?php $namePage = 'Reception'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php'); ?>
    <main>
      <div class="spacer20" id="spacer20"></div>
      <div class="container-fluid">
      <h3>Votre boîte de réception:</h3>
        <?php echo '<a class="btn btn-primary" href="profil.php?id=' . $_SESSION['id'] . '">Profil</a>'; ?>
        <a class="btn btn-primary" href="envoi.php">Nouveau message</a>
        <div class="spacer20" id="spacer20"></div>
        <p style="text-align:center; font-size:1.5em; text-decoration:underline;">Messages recus:</p>
        <div class="container-fluid" id="container-messages">
        <?php
         if($msg_nbr == 0) { echo "Vous n'avez aucun message..."; }
         while($m = $msg->fetch()) {
         // print_r($m);
            $p_exp = $bdd->prepare('SELECT pseudo FROM membres WHERE id = ?');
            $p_exp->execute(array($m['id_expediteur']));
            $p_exp = $p_exp->fetch();
            $p_exp = $p_exp['pseudo'];
         ?>
         <div class="spacer10" id="spacer10"></div>
        <a href="lecture.php?id=<?php echo $m['id'] ?>"><p>Vous avez reçu un message de <b><?= $p_exp ?></b> <?php if($m['lu'] == 1) { ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Déjà lu</p>
        <?php } ?><br /></a>
            <b>Objet:</b> <?php echo $m['objet'] ?><?php if($m['lu'] == 1) { ?></p><?php } ?><br />
        ------------------------------------------------------------------------------------------------<br />
        <?php } ?>
      </div>
      </div>
      <div class="spacer50" id="spacer50"></div>
    </main>
    <?php include('includes/footer.php'); ?>
</body>

</html>
<?php } ?>
