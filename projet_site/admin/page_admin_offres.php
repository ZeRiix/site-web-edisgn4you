<?php

include('../includes/bdd.php');

if(isset($_GET['type']) AND $_GET['type'] == 'annonces') {
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {

      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM offres WHERE id = ?');
      $req->execute(array($supprime));
   }
}
$annonces = $bdd->query('SELECT * FROM offres ORDER BY id DESC LIMIT 0,5');
$annoncesList = $bdd->query('SELECT * FROM offres ORDER BY id');
?>

<!DOCTYPE html>
<html>
<?php
    $namePage = 'Admin Advertisements';
    include 'includes_admin/headAdmin.php';
    include 'includes_admin/headerAdmin.php';
?>
<body>
    <div class="container">
        <div>
            <!-- modifier les valider et supprimer en image propre -->
            <div class="row">
                <div class="col-md-6">
                    <div class="coloneAdmin" align="center">
                        <ul>
                            <?php while($c = $annonces->fetch()) { ?>
                                <li><?= $c['pseudo'] ?> : <?= $c['categorie'] ?> : <?= $c['title'] ?>- <a href="page_admin_advertisements.php?type=annonces&supprime=<?= $c['id'] ?>">Supprimer</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="coloneAdmin" align="center">
                        <ul>
                            <?php while($c = $annoncesList->fetch()) { ?>
                                <li><?= $c['pseudo'] ?> : <?= $c['categorie'] ?> : <?= $c['title'] ?>- <a href="page_admin_advertisements.php?type=annonces&supprime=<?= $c['id'] ?>">Supprimer</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(window).scroll(function () {
        var scroll = $(window).scrollTop(),
            dh = $(document).height(),
            wh = $(window).height();
        scrollPercent = (scroll / (dh - wh)) * 100;
        $('#progressbar').css('height', scrollPercent + '%');
    })

    window.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    })

    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
    </script>
</body>
 <!-- // faire le code du footerAdmin.php -->
<?php include 'includes_admin/footerAdmin.php'; ?>
</html>