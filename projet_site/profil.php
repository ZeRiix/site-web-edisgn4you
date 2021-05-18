<?php

include('includes/bdd.php');

if(isset($_GET['id']) AND $_GET['id'] > 0 AND $_SESSION['id'] == $_GET['id']) {
   $getid = intval($_SESSION['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
   $_SESSION = $userinfo;
//    print_r($_SESSION);
} else {
    header('location : deconnexion.php');
}
?>
<html>
<?php $namePage = 'Profil'; include('includes/head.php'); ?>
<?php include('log.php'); ?>
<body>
    <?php include('includes/header.php'); ?>
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
                            <a type="button" class="btn btn-profil" href="profilpublic.php?name=<?php echo $userinfo['pseudo']?>" alt="boutton profil">Voir mon profil public</a>
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
                                <a style="text-decoration:none" href="edprofil.php">
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
                                <a style="text-decoration:none" href="annoncePerso.php">
                                    <div class="grid2">
                                        <img class="picto_annonces" src="images/picto_annonce.png" alt="annonces">
                                        <h1><strong>Annonces</strong></h1>
                                        <h2>Gérer mes annonces déposées</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-grid3" alt="boutton paramètres">
                                <a style="text-decoration:none" href="parametres.php">
                                    <div class="grid3">
                                        <img class="picto_para" src="images/picto_parametres.png" alt="paramètres">
                                        <h1><strong>Paramètres</strong></h1>
                                        <h2>Compléter et modifier mes informations bancaires et préférences</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-grid4" alt="boutton sécurité">
                                <a style="text-decoration:none" href="pagesecurite.php">
                                    <div class="grid4">
                                        <img class="picto_sécurité" src="images/picto_securite.png" alt="sécurité">
                                        <h1><strong>Connexion et sécurité</strong></h1>
                                        <h2>Protéger mon compte et mettre à jour mon mot de passe</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-grid5" alt="boutton pro">
                                <a style="text-decoration:none" href="prese4u.php">
                                    <div class="grid5">
                                        <img class="picto_pro" src="images/picto_pro.png" alt="pro">
                                        <h1><strong>E4uPro</strong></h1>
                                        <h2>Rejoignez-nous</h2>
                                    </div>
                                </a>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-grid6" alt="boutton aide">
                                <a style="text-decoration:none" href="aide.php">
                                    <div class="grid6">
                                        <img class="picto_aide" src="images/picto_aide.jpg" alt="aide">
                                        <h1><strong>Aide</strong></h1>
                                        <h2>Accéder au service client</h2>
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

    <?php include('includes/footer.php'); ?>

</body>

</html>
