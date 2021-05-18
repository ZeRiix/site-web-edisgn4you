<header>
    <div class="container-fluid " id="container-1">
        <div class="row">
            <div class="col col-lg-7" "col-md-auto" "col-sm-7" id="">
                <a class="btn btn-customlogo " href="index.php" ><img src="images/logo.png" alt="boutton logo"></a>
                <a class="btn btn-custom" href="annonce.php"><img src="images/carre.png" alt="picto croix"> Déposer une annonce</a>
                <a class="btn btn-custom5" href="recherche.php"><img src="images/rechercher.PNG" alt="boutton rechercher" ></a>
            </div>
            <div class="col col-lg-5" "col-md-auto" "col-sm-5">
                <?php
                // $_SESSION['id']
                if(isset($_SESSION['id'])) {

                    echo '<a href="profil.php?id=' . $_SESSION['id'] . '" class="btn btn-custom3"><img src="images/image_profil.png" width="90%" height="100%" alt="boutton pro"></a>';
                    echo '<a href="reception.php" class="btn btn-custom3"><img src="images/messages.PNG"></a>';
                    echo '<a href="panier.php" class="btn btn-custom3"><img src="images/image_panier.png" width="100%" height="100%"></a>';
                }   else {
                    echo '<a href="connexionPro.php" class="btn btn-custom4" id="bouttonpro"><img src="images/pro_e4u.PNG" alt="boutton pro"></a>';
                    echo '<a href="connexion.php" class="btn btn-custom3"><img src="images/se_connecter.PNG" alt="boutton messages"></a>';
                }
                ?>
            </div>
        </div>
    </div>
</header>
