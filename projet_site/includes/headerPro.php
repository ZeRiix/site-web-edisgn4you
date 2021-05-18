<header>
    <div class="container-fluid " id="container-1">
        <div class="row">
            <div class="col col-lg-7" "col-md-auto" "col-sm-7" id="">
                <a class="btn btn-customlogo " href="#" ><img src="images/logo.png" alt="boutton logo"></a>
                <a class="btn btn-custom" href="offres.php"><img src="images/carre.png" alt="picto croix"> Déposer une offres</a>
                <a class="btn btn-custom5" href="recherchePro.php"><img src="images/rechercher.PNG" alt="boutton rechercher" ></a>
            </div>
            <div class="col col-lg-5" "col-md-auto" "col-sm-5">
                <?php
                if(isset($_SESSION['pseudo'])){

                    echo '<a href="profilPro.php?id=' . $_SESSION['id'] . '" class="btn btn-custom4" id="btn-"><img src="images/image_profil.png" width="90%" height="100%" alt="boutton pro"></a>';
                    echo '<a href="#" class="btn btn-custom3"><img src="images/messages.PNG"></a>';
                }
                ?>
            </div>
        </div>
    </div>