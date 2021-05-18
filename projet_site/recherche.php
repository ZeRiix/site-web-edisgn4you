<?php
include('includes/bdd.php');

if (isset($_POST['formrecherche'])) {
    $recherche = htmlspecialchars($_POST['recherche']);
    $recherchelenght = strlen($recherche);
    if ($recherchelenght <= 255) {
        $reqRechercheMembre = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
        $reqRechercheMembre->execute(array($recherche));
        $membreExist = $reqRechercheMembre->rowCount();

        if($membreExist === 0) {
            $reqRechercheMembrepro = $bdd->prepare("SELECT * FROM membrespro WHERE pseudo = ?");
            $reqRechercheMembrepro->execute(array($recherche));
            $membreproExist = $reqRechercheMembrepro->rowCount();

            if ($membreproExist === 0) {
                $reqRechercheOffre = $bdd->prepare("SELECT * FROM offres WHERE title = ?");
                $reqRechercheOffre->execute(array($recherche));
                $offreExist = $reqRechercheOffre->rowCount();

                if ($offreExist === 0) {
                    header("location:recherchePro.php?erreur=cette recherche n'existe pas !");

                } else {
                    // si offre exist
                    $offre = $reqRechercheOffre->fetch();
                    header("location:printOffres.php?uid=".$offre['id']);
                }

            } else {
                // si membrepro exist
                $membrepro = $reqRechercheMembrepro->fetch();
                header("location:profilpublicPro.php?name=".$membrepro['pseudo']);
            }
        } else {
            // si membre exist
            $membre = $reqRechercheMembre->fetch();
            header("location:profilpublic.php?name=".$membre['pseudo']);
        }
    } else {
        header('location:recherche.php?erreur=erreur de rechereche !');
    }
}
?>

<html>
<?php $namePage = 'Recherche'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <main>
    <a type="button" class="btn btn-secret" href="jeux_js/jeu.php" alt="boutton secret"></a>
        <br><br><br><br>
        <div class="container-fluid" id="container-recherche">
        <form method="post" action="" enctype="multipart/form-data">
            <div align="center"id="container-recherche2">
                <h2>Faites votre recherche</h2>
                <input type="text" name="recherche" placeholder="Entrez votre recherche">
                <input class="btn btn-primary" type="submit" name="formrecherche" value="rechercher">
            </div>
        </form>
      </div>

    </main>
</body>

</html>
