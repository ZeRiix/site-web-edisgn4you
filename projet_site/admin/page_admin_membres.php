<?php

include('../includes/bdd.php');

if(isset($_GET['type']) AND $_GET['type'] == 'membre') {

   if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {

      $confirme = (int) $_GET['confirme'];
      $req = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE id = ?');
      $req->execute(array($confirme));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {

      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
      $req->execute(array($supprime));
   }
}
// modifier cette section du code pour la liste des membres ou des commentire et en rajouter une pour les annonces.
$membres = $bdd->query('SELECT * FROM membres ORDER BY id DESC LIMIT 0,5');
$membresList = $bdd->query('SELECT * FROM membres ORDER BY id');
?>
<!DOCTYPE html>
<html>
<?php
    $namePage = 'Admin Membres';
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
                            <?php while($m = $membres->fetch()) { ?>
                                <li><?= $m['id'] ?> : <?php echo $m['pseudo'] ?><?php if($m['confirme'] == 0) { ?> - <a href="page_admin_membres.php?type=membre&confirme=<?= $m['id'] ?>">Valider</a><?php } ?> - <a href="page_admin_membres.php?type=membre&supprime=<?= $m['id'] ?>">Supprimer</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="coloneAdmin" align="center">
                        <ul>
                            <?php while($m = $membresList->fetch()) { ?>
                                <li><?php echo $m['id'] ?> : <?php echo $m['pseudo'] ?><?php if($m['confirme'] == 0) { ?> - <a href="page_admin_membres.php?type=membre&confirme=<?= $m['id'] ?>">Valider</a><?php } ?> - <a href="page_admin_membres.php?type=membre&supprime=<?= $m['id'] ?>">Supprimer</a></li>
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