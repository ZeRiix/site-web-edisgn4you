<?php

include('includes/bdd.php');

if (isset($_POST['formadvertisement'])) {
    $title = htmlspecialchars($_POST['title']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $price = htmlspecialchars($_POST['priceAdver']);
    $pseudo = $_SESSION['pseudo'];
    $idcrea = $_SESSION['id'];
    $date = date("d/m/Y");
    print_r(array($title, $contenu,$price,$pseudo,$idcrea));
    // $pseudo = "patrick"; // a retirer

    if (!empty($title)) {
        $reqadver = $bdd->prepare("SELECT * FROM offres WHERE title = ?");
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
                            $path = "image_offres/"/*.$_SESSION['id'] */. $title.".".$upload;
                            $move = move_uploaded_file($_FILES['imageAdver']['tmp_name'], $path);

                            if ($move) {
                                $insertAdver = $bdd->prepare("INSERT INTO offres(title,contenu,pseudo,categorie,images,price,idcrea,date_crea) VALUES(?,?,?,?,?,?,?,?)");
                                $insertAdver->execute(array($title,$contenu,$pseudo,$categories,$path,$price,$idcrea,$date));
                                header("location : offresPerso.php?erreur=Votre offre a été crée avec succes !");

                            } else {
                                header("location : offres.php?erreur=erreur durant l'enregistrement de votre image !");
                            }
                        } else {
                            header("location : offres.php?erreur=le format de votre image doit etre au format jpeg, jpg ou png !");
                        }
                    } else {
                        header("location : offres.php?erreur=votre image est trop volumineuse, elle ne doit pas dépasser les 4Mo !");
                    }
                } else {
                    header("location : offres.php?erreur=vous avez oubliez de mettre image pour illustrer votre offres");
                }
            } else {
                header("location : offres.php?erreur=merci de choisir une categrie !");
            }
        } else {
            header("location : offres.php?erreur=le titre de cette offre exist deja, merci d'en changer");
        }
    } else {
        header("location : offres.php?erreur=merci de remplir tout les champs");
    }
}

?>


<html>

<?php $namePage = 'création offre'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/headerPro.php'); ?>
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
                                    <option value="1">choisir une categorie</option>
                                    <option value="logo">logo</option>
                                    <option value="montage">montage</option>
                                    <option value="site">site</option>
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
                        <textarea type="text" id="text-annonce" placeholder="contenue de votre annonce"
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
                </div>
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
                        <div class="col-lg-8 col-md-9"><a href="#" class="btn btn-secondary">Retour</a></div>
                        <div class="col-lg-4 col-md-3"><input type="submit" value="Créer" name="formadvertisement">
                        </div>
                        <div class="spacer50" id="spacer50"></div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>

</html>