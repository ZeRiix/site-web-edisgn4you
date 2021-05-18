<?php

include('includes/bdd.php');

if(isset($_GET['id']) AND $_GET['id'] > 0 AND $_SESSION['id'] == $_GET['id']) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM membrespro WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
    $_SESSION = $userinfo;

} else {
    header('location : deconnexion.php');
}

// print_r($_SESSION);

?>
<html>
<?php $namePage = 'Profil'; include('includes/head.php'); ?>
<?php include('log.php'); ?>
<body>
    <?php include('includes/headerPro.php'); ?>
    <?php include('includes/message.php');?>
    <main>
        <div class="spacer20" id="spacer80"></div>
        <div class="container-fluid" id="container-profil">
            <div class="row" id="row-profil">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="row" id="row-profil2">
                        <div class="col-xl-1" id="profilimage">
                            <?php
                            if(isset($userinfo['avatar'])) {
                                echo '<img class="picto_profil2" src="'. $userinfo['avatar'] . '" alt="profil">';
                            } else {
                                echo '<img class="picto_profil2" src="images/picto_profil.png" alt="profil">';
                            }
                            ?>
                        </div>
                        <div class="col-xl-7" id="profil">
                            <h1><strong><?php echo $userinfo['pseudo']; ?></strong></h1>
                        </div>
                        <div class="col-xl-4">
                            <a type="button" class="btn btn-profil" href="profilpublicPro.php?name=<?php echo $userinfo['pseudo']?>" alt="boutton profil">Voir mon profil public</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2"></div>
            </div>
        </div>
        <div class="spacer30" id="spacer30"></div>
        <div class="container-fluid" id="container-grid">
            <div class="row" id="row-grid">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="grid">
                        <div>
                            <button type="button" class="btn btn-grid1" alt="boutton profil">
                                <a style="text-decoration:none" href="edprofilPro.php">
                                    <div class="grid1">
                                        <?php
                                        if(isset($userinfo['avatar'])) {
                                            echo '<img class="picto_profil" src="'. $userinfo['avatar'] . '" alt="profil">';
                                        } else {
                                            echo '<img class="picto_profil" src="images/picto_profil.png" alt="profil">';
                                        }
                                        ?>
                                        <h1><strong>Profil</strong></h1>
                                        <h2>Modifier mon profil public et accéder à mes coordonnées personelles</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-grid2" alt="boutton annonces">
                                <a style="text-decoration:none" href="offrePerso.php">
                                    <div class="grid2">
                                        <img class="picto_annonces" src="images/picto_annonce.png" alt="annonces">
                                        <h1><strong>Offres</strong></h1>
                                        <h2>Gérer mes offres déposées</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-grid4" alt="boutton sécurité">
                                <a style="text-decoration:none" href="pagesecuritePro.php">
                                    <div class="grid4">
                                        <img class="picto_sécurité" src="images/picto_securite.png" alt="sécurité">
                                        <h1><strong>Connexion et sécurité</strong></h1>
                                        <h2>Protéger mon compte et mettre à jour mon mot de passe</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <a href="deconnexion.php" class="btn btn-secondary">Deconnexion</a>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </div>
        </div>
    </main>

    <?php include('includes/footerPro.php'); ?>

</body>

</html>