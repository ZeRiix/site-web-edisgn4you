<?php

include('../includes/bdd.php');

if(isset($_GET['type']) AND $_GET['type'] == 'commentaire') {
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      print_r($supprime);
      $req = $bdd->prepare('DELETE FROM avis WHERE id = ?');
      $req->execute(array($supprime));
      print_r($req);
   }
}
$commentaires = $bdd->query('SELECT * FROM avis ORDER BY id DESC LIMIT 0,5');
$commentairesList = $bdd->query('SELECT * FROM avis ORDER BY id');
?>

<!DOCTYPE html>
<html>
<?php
    $namePage = 'Admin Comments';
    include 'includes_admin/headAdmin.php';
    // faire le code du headerAdmin.php
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
                            <?php while($c = $commentaires->fetch()) { ?>
                                <li><?= $c['pseudo'] ?> : <?= $c['title'] ?> : <?= $c['contenu'] ?>- <a href="page_admin_avis.php?type=commentaire&supprime=<?= $c['id'] ?>">Supprimer</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="coloneAdmin" align="center">
                        <ul>
                            <?php while($c = $commentairesList->fetch()) { ?>
                                <li><?= $c['pseudo'] ?> : <?= $c['title'] ?> : <?= $c['contenu'] ?> - <a href="page_admin_avis.php?type=commentaire&supprime=<?= $c['id'] ?>">Supprimer</a></li>
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
<?php include 'includes_admin/footerAdmin.php'; ?>
</html>