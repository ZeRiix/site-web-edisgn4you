<?php

include('../includes/bdd.php');

// var_dump($_SESSION);

if (isset($_SESSION['id']) == 1) {


 $countMembre = $bdd->query('SELECT * FROM membres');
 $countMembres = $countMembre->rowCount();
 // $countMembresSuppr = $bdd -> query('SELECT count(*) FROM membresSuppr'); // a faire
 $countMembresSuppr = 4;
 $countComment = $bdd->query('SELECT * FROM commentaires');
 $countComments = $countComment->rowCount();
 // $countCommentsSuppr = $bdd -> query('SELECT count(*) FROM commentaireSuppr'); // a faire
 $countCommentsSuppr = 7;
 $countAdvertisement = $bdd->query('SELECT * FROM annonces');
 $countAdvertisements = $countAdvertisement->rowCount();
 // $countAdvertisementsSuppr = $bdd -> query('SELECT count(*) FROM annoncesSuppr'); // a faire
 $countAdvertisementsSuppr = 146;
 $countMessage = $bdd->query('SELECT * FROM messages');
 $countMessages = $countMessage->rowCount();
 // $countAdvertisementsSuppr = $bdd -> query('SELECT count(*) FROM annoncesSuppr'); // a faire
 $countMessagesSuppr = 1460;
 $countOffre = $bdd->query('SELECT * FROM offres');
 $countOffres = $countOffre->rowCount();
 // $countAdvertisementsSuppr = $bdd -> query('SELECT count(*) FROM annoncesSuppr'); // a faire
 $countOffresSuppr = 6;
 $countAvi = $bdd->query('SELECT * FROM avis');
 $countAvis = $countAvi->rowCount();
 // $countAdvertisementsSuppr = $bdd -> query('SELECT count(*) FROM annoncesSuppr'); // a faire
 $countAvisSuppr = 10;
 $countMembrepro = $bdd->query('SELECT * FROM membrespro');
 $countMembrespro = $countMembrepro->rowCount();
 // $countMembresSuppr = $bdd -> query('SELECT count(*) FROM membresSuppr'); // a faire
 $countMembresproSuppr = 1;

} else {
    header("location:../deconnexion.php");
}
?>

<html>
    <?php
        $namePage = 'Espace Administration';
        include 'includes_admin/headAdmin.php';
    ?>
    <header>
        <div class="container-fluid" style="border: solid 1px black; height: 90px" id=header>
            <div class="row">
                <div class="col-lg-4">
                    <a href="../deconnexion.php"><img src="../images/fleche.png" height="25%" width="20%" alt></a>
                </div>
                <div class="col-lg-4">
                    <div align="center" class="logoAdmin">
                        <img src="../images/logo.png" width="25%" height="25%">
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- -->
                </div>
            </div>
        </div>
    </header>
    <body>
        <div class="container">
            <!-- // faire le code css de ces bouttons avec des couleurs -->
            <div class="spacer30"></div>
            <div class="button-listes" align="center">
                <div class="row">
                    <div class="col-md-4">
                        <div style="background: red; box-shadow: 10px 10px 10px #a01b16; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_membres.php">
                                <h1 align="left" class="compteur"><img src="../images/#" class="imageCount"><?php echo $countMembres ;?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countMembresSuppr; ?> membres supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: blue; box-shadow: 10px 10px 10px #1a2389; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_comments.php">
                                <h1 align="left" class="compteur" style="text-decoration: none;"><img src="../images/#" class="imageCount"><?php echo $countComments?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countCommentsSuppr?> commentaires supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: green; box-shadow: 10px 10px 10px #10591d; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_advertisements.php">
                                <h1 align="left" class="compteur"><img src="../images/#" class="imageCount"><?php echo $countAdvertisements?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countAdvertisementsSuppr?> annonces supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="spacer30"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div style="background: #f7a40a; box-shadow: 10px 10px 10px #906e17; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_message.php">
                                <h1 align="left" class="compteur"><img src="../images/#" class="imageCount"><?php echo $countMessages ;?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countMessagesSuppr; ?> messages supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: #502c84; box-shadow: 10px 10px 10px #251329; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_offres.php">
                                <h1 align="left" class="compteur"><img src="../images/#" class="imageCount"><?php echo $countOffres ;?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countOffresSuppr; ?> offres supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="background: #fe6700; box-shadow: 10px 10px 10px #b75534; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_offres.php">
                                <h1 align="left" class="compteur"><img src="../images/#" class="imageCount"><?php echo $countAvis ;?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countAvisSuppr; ?> avis supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="spacer30"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div style="background: #ff94b8; box-shadow: 10px 10px 10px #b01841; border-radius: 5px;">
                            <a class="buttonAdmin" href="page_admin_membrespro.php">
                                <h1 align="left" class="compteur"><img src="../images/#" class="imageCount"><?php echo $countMembrespro ;?></h1>
                                <label class="textLabelButtonAdmin">Il y a <?php echo $countMembresproSuppr; ?> membres pro supprimés sur votre site</label>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer30"></div>
            <div class="graph">
                <!-- // emplacement du graph en java -->
            </div>
        </div>
    </body>

    <?php include 'includes_admin/footerAdmin.php'; ?>

</html>