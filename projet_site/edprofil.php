<?php

include('includes/bdd.php');

if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    // print_r($user);
    if (isset($_POST['submitprofil'])) {

        if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
            $newpseudo = htmlspecialchars($_POST['newpseudo']);
            $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        }
        if(isset($_POST['mail']) AND !empty($_POST['mail']) AND $_POST['mail'] != $user['mail']) {
            $newmail = htmlspecialchars($_POST['mail']);
            $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
        }
        if(isset($_POST['name']) AND !empty($_POST['names']) AND $_POST['names'] != $user['prenom']) {
            $newnames = htmlspecialchars($_POST['names']);
            $insertnames = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ?");
            $insertnames->execute(array($newnames, $_SESSION['id']));
        }
        if(isset($_POST['surname']) AND !empty($_POST['surname']) AND $_POST['surname'] != $user['nom']) {
            $newsurname = htmlspecialchars($_POST['surname']);
            $insertsurname = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
            $insertsurname->execute(array($newsurname, $_SESSION['id']));
        }
        if(isset($_POST['num']) AND !empty($_POST['num']) AND $_POST['num'] != $user['num']) {
            $newnum = htmlspecialchars($_POST['num']);
            $insertnum = $bdd->prepare("UPDATE membres SET num = ? WHERE id = ?");
            $insertnum->execute(array($newnum, $_SESSION['id']));
        }
        if(isset($_POST['description']) AND !empty($_POST['description']) AND $_POST['description'] != $user['descriptions']) {
            $newdescription = htmlspecialchars($_POST['description']);
            $insertdescription = $bdd->prepare("UPDATE membres SET descriptions = ? WHERE id = ?");
            $insertdescription->execute(array($newdescription, $_SESSION['id']));
        }
        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
            $tailleMax = 2097152; // 2Mo
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['avatar']['size'] <= $tailleMax) {
               $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

               if(in_array($extensionUpload, $extensionsValides)) {
                  $chemin = "membres/avatars/".$_SESSION['id'] . $_SESSION['pseudo'].".".$extensionUpload;
                  $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

                  if($resultat) {
                     $updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
                     $updateavatar->execute(array(
                        'avatar' => $chemin,
                        'id' => $_SESSION['id']
                        ));
                  } else {
                     $erreur = "Erreur durant l'importation de votre photo de profil";
                  }
               } else {
                  $erreur = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
               }
            } else {
               $erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
            }
         }
    }
}

?>
<html>
<?php $namePage = 'Edition du profil'; include('includes/head.php'); ?>
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
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row" id="row-formprofil">
                        <form method="post" action="">
                            <label>Pseudo</label><br>
                            <input type="text" class="form-profil" name="newpseudo" id="nom">
                            <div class="spacer20" id="spacer20"></div>
                            <label>Nom</label><br>
                            <input type="text" class="form-profil" name="names" id="nom">
                            <div class="spacer20" id="spacer20"></div>
                            <label>Prénom</label><br>
                            <input type="text" class="form-profil" name="surname" id="prénom">
                            <div class="spacer20" id="spacer20"></div>
                            <label>Email</label><br>
                            <input type="email" class="form-profil" name="mail" id="email">
                            <div class="spacer20" id="spacer20"></div>
                            <label>Téléphone</label><br>
                            <input type="number" class="form-profil" name="num" id="tel">
                            <div class="spacer20" id="spacer20"></div>
                            <label>Description</label><br>
                            <textarea type="text" class="form-profil" name="description" id="" placeholder="entrer une description" style="width:80%"></textarea>
                            <div class="spacer20" id="spacer20"></div>
                            <label>Avatar</label><br>
                            <input type="file" name="avatar">
                            <div class="spacer20" id="spacer20"></div>
                            <input type="submit" class="submitprofil" name="submitprofil" value="Valider">
                        </form>
                        <div class="spacer20" id="spacer20"></div>
                        <?php
                        echo '<a href="profil.php?id=' . $_SESSION['id'] . '" class="btn btn-primary">retour profil</a>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="spacer50" id="spacer50"></div>
    <?php include('includes/footer.php'); ?>

</body>

</html>
