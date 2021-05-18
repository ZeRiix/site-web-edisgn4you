<?php include('includes/bdd.php'); ?>

<?php

if (isset($_POST['search'])) {
    $recherche = htmlspecialchars($_POST['contenu']);
    $categories = $_POST['category'];
    $recherchelenght = strlen($recherche);
    if ($recherchelenght <= 255) {
        $reqRechercheOffre = $bdd->prepare("SELECT * FROM offres WHERE title = ? AND categorie = ?");
        $reqRechercheOffre->execute(array($recherche, $categories));
        $offreExist = $reqRechercheOffre->rowCount();

        if ($offreExist === 0) {
            header("location:index.php?erreur=cette offre n'existe pas !");
        } else {
            // si offre exist
            $offre = $reqRechercheOffre->fetch();
            header("location:printOffres.php?uid=".$offre['id']);
        }
    }
}

?>

<html>

<?php $namePage = 'Accueil'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>

    <main>

        <?php include('includes/message.php'); ?>
        <?php  if(isset($erreur)) { echo '<font color="orange">' . $erreur . "</font>"; } ?>

        <div class="container-fluid">
            <div class="card" id="card1">
                <div class="card-body">
                    <p>E-Design for you le pire site du monde</p>
                    <p>Trouvez les meilleures offres aux meilleurs prix du marché</p>
                </div>
                <div class="card" id="card2">
                    <div class="card-body">
                        <nav class="navbar navbar-light bg-light" id="navbartest">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row" id="row-navbar">
                                    <div class="col-lg-4" id="testaccueil">
                                        <select class="form-control" name="category" id="row-navbar">
                                            <option value="1">Catégories</option>
                                            <option value="montage">Montage vidéo</option>
                                            <option value="site">Siter Web</option>
                                            <option value="logo">Logo</option>
                                            <option value="appli">Application</option>
                                            <option value="depanage">depannage à distance</option>
                                        </select>

                                    </div>
                                    <div class="col-lg-8">
                                        <div class="container-fluid" id="container-navbar">
                                            <input class="form-control me-2" id="navbar" type="text" placeholder="Que recherchez-vous?" aria-label="Search" name="contenu">
                                            <input class="btn btn-secondary " id="rechercheaccueil" type="submit" name="search" value="Rechercher">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="topcat">
            <h4>Top Catégories</h4>
        </div>
        <div id="lampions">
            <div class="row" id="row-top">
                <div class="col-lg-3 col-sm-3" id="col1">
                    <a style="text-decoration:none" href="visionOffres.php?category=site">
                        <img class="lampion" src="images/website.jpg" alt="">
                        <h6>Sites Web</h6>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-3" id="col2">
                    <a style="text-decoration:none" href="visionOffres.php?category=montage">
                        <img class="lampion" src="images/montage.jpg" alt="">
                        <h6>Montage vidéo</h6>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-3" id="col3">
                    <a style="text-decoration:none" href="visionOffres.php?category=logo">
                        <img class="lampion" src="images/logo.jpg" alt="">
                        <h6>Logo</h6>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-3" id="col4">
                    <a style="text-decoration:none" ; href="visionOffres.php?category=application">
                        <img class="lampion" src="images/appli.png" alt="">
                        <h6>Application</h6>
                    </a>
                </div>
            </div>
        </div>
        </div>

        <div class="container-fluid" id="container-banner">
            <a href="inscriptionPro.php">
                <img class="banner" src="images/banner.png" alt="">
                <div class="text">
                    <h1>E4U Pro</h1>
                    </br>
                    <h1>Rejoignez E4U Pro pour des avantages incroyables</h1>
                </div>
            </a>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>

</html>
