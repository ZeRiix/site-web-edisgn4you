<?php

include('../includes/bdd.php');

if(isset($_GET['type']) AND $_GET['type'] == 'message') {
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      print_r($supprime);
      $req = $bdd->prepare('DELETE FROM messages WHERE id = ?');
      $req->execute(array($supprime));
      print_r($req);
   }
}
$messages = $bdd->query('SELECT * FROM messages ORDER BY id DESC LIMIT 0,5');
$messagesList = $bdd->query('SELECT * FROM messages ORDER BY id');
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
                            <?php while($c = $messages->fetch()) { ?>
                                <li><?= $c['id_expediteur'] ?> : <?= $c['objet'] ?> : <?= $c['message_c'] ?>- <a href="page_admin_comments.php?type=message&supprime=<?= $c['id'] ?>">Supprimer</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="coloneAdmin" align="center">
                        <ul>
                            <?php while($c = $messagesList->fetch()) { ?>
                                <li><?= $c['id_expediteur'] ?> : <?= $c['objet'] ?> : <?= $c['message_c'] ?> - <a href="page_admin_comments.php?type=message&supprime=<?= $c['id'] ?>">Supprimer</a></li>
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