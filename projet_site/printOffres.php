<?php

include('includes/bdd.php');
//$bdd = new PDO('mysql:host=edesigwzeriix.mysql.db;dbname=edesigwzeriix', 'edesigwzeriix', 'ZeRiix75');
print_r($_SESSION);
$id = $_GET['uid'];

if (!empty($id)) {
    $reqadver = $bdd->prepare("SELECT * FROM offres WHERE id = ?");
    $reqadver->execute(array($id));
    // $adverexist = $reqadver->rowCount(); sert a rien ?
    $table = $reqadver->fetchAll(PDO::FETCH_ASSOC);
    //print_r($table);
    //echo "<br>";
    $t = $table[0];
    // print_r($t);
}
// verif commentaire
if (isset($_POST['formComment'])) {
    $pseudo = $_SESSION['pseudo'];
    // $pseudo = "michel"; // a retirer
    $title = htmlspecialchars($_POST['titleComment']);
    $contenu = htmlspecialchars($_POST['comment']);
    $date = date("d/m/Y - H:i:s");
    $idAdver = $id;

    if (!empty($_POST['titleComment']) AND $_POST['comment']) {
        $sizeTitle = strlen($title);
        if ($sizeTitle <= 255) {
            $reqComment = $bdd->prepare("INSERT INTO commentaires(title, contenu, pseudo, jour, idAdver) VALUES(?,?,?,?,?)");
            $reqComment->execute(array($title, $contenu, $pseudo, $date, $idAdver));
            $bravo = "votre commentaires a été posté ;)";
        } else {
            $erreur = "le titre de votre commentaire est trop long";
        }
    } else {
        $erreur = "merci de remplir les deux champs";
    }

}
?>
<html>
<?php $namePage = 'offre de ' . $t['pseudo']; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php');?>
    <main>
        <div class="spacer10" id="spacer10"></div>
        <div class="container-fluid" id="row-annoncereduite">
        <div class="row" id="row-annoncereduite">
            <div class="col-xl-2"></div>
            <div class="col-xl-5" id="container-annoncerdy2">
                <h1>Offre créée par <?php echo $t['pseudo']; ?></h1>
                <div class="spacer20" id="spacer20"></div>
                <?php echo '<img src="' . $t['images'] . '" class="imageannonce">'; ?>
                <br><br>
                <h2><?php echo $t['title']; ?></h2>
                <div class="container-fluid" id="divcontenu">
                    <label>Description :</label>
                    <p><?php echo $t['contenu']; ?></p>
                </div>
            </div>
            <div class="col-xl-4" id="divcom">
                <div class="container-fluid" id="divform">
                    <form method="post" enctype="multipart/form-data">
                        <h5>Rédiger un commentaire : </h5>
                        <label>Titre du commentaire</label>
                        <br>
                        <input type="text" name="titleComment">
                        <br>
                        <label>Contenu</label>
                        <br>
                        <textarea type="text" name="comment" class="contenucom" placeholder="Contenu du commentaire"></textarea>
                        <br>
                        <div class="spacer10" id="spacer10"></div>
                        <input type="submit" value="Envoyer" name="formComment" class="btn btn-secondary" id="boutoncom">
                    </form>
                </div>
                <?php
        if(isset($erreur)) {
            echo '<p align="center" style="color:red;">'.$erreur."</p>";
            echo '<p align="center" style="color:green;">'.$bravo."</p>";
         }
        ?>
                <a href="index.php" class="btn btn-secondary" id="boutonaccueil">Page d'accueil</a>
            </div>
            <div class="col-xl-1"></div>
        </div>
      </div>
      <div class="container-fluid">
        <h3>Commentaires : </h3>
        <?php

// affichage des comentaires
$reqCom = $bdd->prepare("SELECT * FROM commentaires WHERE idAdver = ?");
$reqCom->execute(array($id)); // id de l'annonce


foreach($reqCom as $c) {
    echo '<div>';
    echo '<p class="titrecom">' . $c['title'] . ' écrit par ' . $c['pseudo'] . '</p>';
    // echo '<br>';
    echo '<p class="textecom">' . $c['contenu'] . '</p>';
    echo '<br>';
    echo '<p class="datecom">' . '<label>' . $c['jour'] . '</label>'. '</p>';
    echo '</div>';
}
?>
</div>
    </main>
    <?php include('includes/footer.php'); ?>
</body>

</html>
