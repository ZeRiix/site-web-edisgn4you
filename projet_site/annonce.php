<?php

include('includes/bdd.php');

if (isset($_POST['formadvertisement'])) {
    $title = htmlspecialchars($_POST['title']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $price = htmlspecialchars($_POST['priceAdver']);
    $pseudo = $_SESSION['pseudo'];
    $idcrea = $_SESSION['id'];
    print_r(array($title, $contenu,$price,$pseudo,$idcrea));
    // $pseudo = "patrick"; // a retirer

    if (!empty($title)) {
        $reqadver = $bdd->prepare("SELECT * FROM annonces WHERE title = ?");
        $reqadver->execute(array($title));
        $adverexist = $reqadver->rowCount();
        if($adverexist == 0) {

            if (isset($_POST['category']) AND $_POST['category'] != "1") {
                $categories = $_POST['category'];

                if(isset($_FILES['imageAdver']) AND !empty($_FILES['imageAdver']['name'])) {
                    $maxSize = 4194304;
                    $extensions = array('jpg', 'jpeg', 'png');

                    if ($_FILES['imageAdver']['size'] <= $maxSize) {
                        $upload = strtolower(substr(strrchr($_FILES['imageAdver']['name'], '.'), 1));

                        if(in_array($upload, $extensions)) {
                            $path = "image_annonce/"/*.$_SESSION['id'] */. $title.".".$upload;
                            $move = move_uploaded_file($_FILES['imageAdver']['tmp_name'], $path);

                            if ($move) {
                                $insertAdver = $bdd->prepare("INSERT INTO annonces(title,contenu,pseudo,categorie,images,price,idcrea) VALUES(?,?,?,?,?,?,?)");
                                $insertAdver->execute(array($title,$contenu,$pseudo,$categories,$path,$price,$idcrea));
                                $erreur = "Votre annonce a été crée avec succes !<a href=\"index.php\">retour page d'acceuil</a>";

                            } else {
                                $erreur = "erreur durant l'enregistrement de votre image !";
                            }
                        } else {
                            $erreur = "le format de votre image doit etre au format jpeg, jpg ou png !";
                        }
                    } else {
                        $erreur = "votre image est trop volumineuse, elle ne doit pas dépasser les 4Mo !";
                    }
                } else {
                    $erreur = "vous avez oubliez de mettre image pour illustrer votre annonce";
                }
            } else {
            $erreur = "merci de choisir une categrie !";
            }
        } else {
            $erreur = "le titre de cette annonce exist deja, merci d'en changer";
        }
    } else {
        $erreur = "merci de remplir tout les champs";
    }
}

?>


<html>

<?php $namePage = 'Annonce'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/message.php');?>

    <main>
        <div class="spacer10" id="spacer10"></div>
        <div class="container-fluid">
            <form method="post" enctype="multipart/form-data">
                <div class="container" id="container-annonce">
                    <h1><strong>Déposer une annonce</strong></h1>
                    <div class="spacer30" id="spacer30"></div>
                    <h2><strong>Commençons par l'essentiel !</strong></h2>
                    <div class="spacer20" id="spacer20"></div>
                    <div class="row">
                        <div class="col-lg-12" id="row-titre">
                            <label>Quel est le titre de l'annonce ?<h1>champ requis</h1></label>
                            <input class="form-control" type="text" name="title" placeholder="Titre">
                        </div>
                    </div>
                    <div class="spacer20" id="spacer20"></div>
                    <div class="row">
                        <div class="col-lg-6 col-xl-5" id="row-label">
                            <label>Catégorie</label>
                            <nav id="dropdown-annonce">
                                <select name="category" class="list">
                                    <option value="1">Choisir une catégorie</option>
                                    <option value="logo">Logos</option>
                                    <option value="montage">Montages vidéos</option>
                                    <option value="site">Sites</option>
                                    <option value="appli">Applications</option>
                                </select>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-xl-7" id="col-offres">
                            <!-- rien -->
                        </div>
                    </div>
                    <div class="spacer30" id="spacer30"></div>
                    <div class="row">
                        <div class="col-lg-7 col-md-7">Description de l'annonce</div>
                        <div class="col-lg-2 col-md-2" id="champ">
                            <h1>Champ requis</h1>
                        </div>
                        <div class="col-lg-3 col-md-3" </div>
                        </div>
                        <div class="spacer5" id="spacer5"></div>
                        <textarea type="text" id="text-annonce" placeholder="Contenu de votre annonce"
                            name="contenu"></textarea>
                        <div class="spacer5" id="spacer5"></div>
                        <div class="row">
                            <div class="col-lg-7 col-md-7"></div>
                            <div class="col-lg-5 col-md-5" id="cara">
                                <h1>0 / 4000 caractères</h1>
                            </div> <!-- remplacer par un compteur de mot en js -->
                        </div>
                    </div>
                    <div class="prix" id="prix">
                        <h2><strong>Quel est votre prix?</strong></h2>
                    </div>
                    <div class="spacer10" id="spacer10"></div>
                    <label>Indiquez votre prix</label>
                    <input type="text" class="form-control" name="priceAdver">
                <div class="spacer30" id="spacer30"></div>
                <div class="image" id="image-annonce">
                    <h1><strong>Ajouter des photos</strong></h1>
                    <div class="input-file-container">
                        <input class="input-file" id="my-file" type="file" name="imageAdver">
                    </div>
                </div>
                <div class="spacer10" id="spacer10"></div>
                <div>
                    <div class="spacer50" id="spacer50"></div>
                    <div class="row">
                        <div class="col-lg-8 col-md-9"><a href="index.php" class="btn btn-secondary">Retour</a></div>
                        <div class="col-lg-4 col-md-3"><input type="submit" value="Créer" name="formadvertisement">
                        </div>
                        <div class="spacer50" id="spacer50"></div>
                    </div>
                </div>
            </form>
        <?php
        if(isset($erreur)) {
            echo '<p align="center" style="color:red;">'.  $erreur ."</p>";
        }
        ?>
        </div>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>

</html>
