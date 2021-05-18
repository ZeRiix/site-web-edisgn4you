<?php

include('includes/bdd.php');

if(isset($_GET['name'])) {
    $requser = $bdd->prepare("SELECT * FROM membrespro WHERE pseudo = ?");
    $requser->execute(array($_GET['name']));
    $user1 = $requser->fetchAll(PDO::FETCH_ASSOC);
    $user = $user1[0];
    // print_r($user);
}

// verrif avis
if (isset($_POST['formComment'])) {
    $pseudo = $_SESSION['pseudo'];
    // $pseudo = "michel"; // a retirer
    $title = htmlspecialchars($_POST['titleComment']);
    $contenu = htmlspecialchars($_POST['comment']);
    $date = date("d/m/Y - H:i:s");
    $idAdver = $user['id'];

    if (!empty($_POST['titleComment']) AND $_POST['comment']) {
        $sizeTitle = strlen($title);
        if ($sizeTitle <= 255) {
            $reqComment = $bdd->prepare("INSERT INTO avis(title, contenu, pseudo, jour, idOff) VALUES(?,?,?,?,?)");
            $reqComment->execute(array($title, $contenu, $pseudo, $date, $idAdver));
            $bravo = "Vôtre avis a été posté ;)";
        } else {
            $erreur = "le titre de votre avis est trop long";
        }
    } else {
        $erreur = "merci de remplir les deux champs";
    }

}

?>

<html>

<?php $namePage = 'Profil public'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>

    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php');?>

    <main>
        <div class="spacer50" id="spacer50"></div>
        <div class="container-fluid" id="container-pageprofil">
            <div class="row" id="row-pageprofil">
                <div class="col-xl-4">
                    <div class="profil-card">
                        <?php
                          if(isset($user['avatar'])) {
                              echo '<img class="pictopageprofil" src="'. $user['avatar'] . '" alt="profil">';
                          } else {
                              echo '<img class="pictopageprofil" src="images/picto_profil.png" alt="profil">';
                          }
                          ?>
                        <h1><?php echo $user['pseudo']?></h1>
                        <img class="lineprofil" src="images/line.png" alt="ligne">
                        <div class="spacer5" id="spacer5"></div>
                        <div class="row">
                            <div class="col-xl-1" id="row-localisation">
                                <img class="localisation" src="images/pictolocalisation.png" alt="localisation">
                            </div>
                            <div class="col-xl-8" id="row-localisation">
                                <h2>Habite en </h2>
                            </div>
                            <div class="col-xl-3" id="row-localisation">
                                <?php echo $user['pays']?>
                            </div>
                        </div>
                        <div class="spacer5" id="spacer5"></div>
                        <div class="row">
                            <div class="col-xl-1" id="row-date">
                                <img class="date" src="images/pictomembres.png" alt="date">
                            </div>
                            <div class="col-xl-7" id="row-date">
                                <h2>Membre depuis</h2>
                            </div>
                            <div class="col-xl-4" id="row-date">
                                <?php echo $user['date_crea']?>
                            </div>
                        </div>
                    </div>
                    <div class="spacer30" id="spacer30"></div>
                    <div class="description-card">
                        <h1><strong>Description</strong></h1>
                        <h2><?php echo $user['descriptions']?></h2>
                        <img class="lineprofil" src="images/line.png" alt="ligne">
                        <div class="spacer5" id="spacer5"></div>
                        <h3>Pour me contacter: </h3>
                        <div class="spacer10" id="spacer10"></div>
                        <div class="row">
                            <div class="col-xl-4" id="email1">
                                <p>Mon email: </p>
                            </div>
                            <div class="col-xl-8">
                                <p><?php echo $user['mail']?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-5" id="tel1">
                                <p>Mon téléphone: </p>
                            </div>
                            <div class="col-xl-7">
                                <p><?php echo $user['num']?></p>
                            </div>
                            <?php
            if ($_SESSION['id'] == $user['id']) {
                echo '<div align="center"><a href="edprofilPro.php" class="btn btn-secondary">modifier profil</a></div>';
            }
        ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row" id="row-formprofil">
                        <strong>
                            <p class="creation">Création de <?php echo $user['prenom'] . '  ' . $user['nom'];?></p>
                        </strong>
                        <div>

                        </div>
                        <div class="spacer20" id="spacer20"></div>
                        <!-- print annonce -->
                    </div>
                </div>
            </div>
            <div class="spacer50" id="spacer50"></div>
            <div class="spacer50" id="spacer50"></div>
            <div class="spacer50" id="spacer50"></div>
            <div class="col-xl-4" id="divcom">
                <?php if (isset($_SESSION['id'])) { if ($user['id'] != $_SESSION['id']) {?>
                <div class="container-fluid">
                    <form method="post" enctype="multipart/form-data">
                        <h5>Rédiger un avis : </h5>
                        <label>Titre de vôtre avis : </label>
                        <br>
                        <input type="text" name="titleComment">
                        <br>
                        <label>Contenu</label>
                        <br>
                        <textarea type="text" name="comment" placeholder="Contenu de vôtre avis"></textarea>
                        <br>
                        <div class="spacer10" id="spacer10"></div>
                        <input type="submit" value="Envoyer" name="formComment" class="btn btn-secondary" id="boutoncom">
                    </form>
                </div>
                <?php
                    if(isset($erreur)) {
                        echo '<p align="center" style="color:red;">'.$erreur."</p>";
                        echo '<p align="center" style="color:green;">'.$bravo."</p>";
                    }
                ?>
                <?php }} ?>
            </div>
            <div class="col-xl-1"></div>
        </div>
        </div>
        <div class="container-fluid">
            <h3>Avis : </h3>
            <?php

            // affichage des avis
            $reqCom = $bdd->prepare("SELECT * FROM avis WHERE idOff = ?");
            $reqCom->execute(array($user['id']));


            foreach($reqCom as $c) {
                echo '<div>';
                    echo '<p>' . $c['title'] . ' écrit par ' . $c['pseudo'] . '</p>';
                    // echo '<br>';
                    echo '<p>' . $c['contenu'] . '</p>';
                    echo '<br>';
                    echo '<p>' . '<label>' . $c['jour'] . '</label>'. '</p>';
                echo '</div>';
            }
            ?>
        </div>

    </main>
    <div class="spacer50" id="spacer50"></div>
    <?php // include('includes/footer.php'); ?>

</body>

</html>