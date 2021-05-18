<?php

include('includes/bdd.php');

$Adver = $bdd->query("SELECT * FROM offres");
$printAdver = $Adver->fetchAll(PDO::FETCH_ASSOC);
// print_r($printAdver);
$adversize = $Adver->rowCount();

?>

<html>
<?php $namePage = 'Offres Perso'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/headerPro.php'); ?>
    <?php include('includes/message.php');?>
    <main>
        <div class="spacer20" id="spacer20"></div>
        <div class="mes">
        <h1> Mes offres </h1>
      </div>
        <?php
        foreach ($printAdver as $advertisement) {
            if ($advertisement['idcrea'] == $_SESSION['id']) {
                $id = $advertisement['id'];
                echo '<div class="offrestyle">';
                echo '<a href="printAnnonce.php?uid=' . $id . '">';
                echo '</a><br>';
                echo '<div class="row">';
                echo '<div class="col-xl-6">';
                echo '<p class="text-vision"> Offre créé par ' . $advertisement['pseudo'] . '</p>';
                echo '<img src="' . $advertisement['images'] . '" width="250px" height="185px">';
                echo '</div>';
                echo '<div class="col-xl-6">';
                echo '<div><p class="titreoffres" name="title">' . $advertisement['title'] . '</p></div>';
                echo '<p> ' . $advertisement['price'] . '€</p>';
                echo '<div class="contenu-offr">';
                echo '<p> Description: ' . $advertisement['contenu'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="spacer20" id="spacer20"></div>';
            }
        }
        if ($adversize == 0) {
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div align="center"><h1>Vous n\'avez crée aucune offre</h1></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
            echo '<div class="spacer50" id="spacer50"></div>';
        }
        ?>
    </main>
    <div class="spacer50" id="spacer50"></div>'
    <?php include('includes/footerPro.php'); ?>
</body>
</html>
