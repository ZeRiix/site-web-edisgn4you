<?php

include('includes/bdd.php');

$Adver = $bdd->query("SELECT * FROM annonces");
$printAdver = $Adver->fetchAll(PDO::FETCH_ASSOC);
// print_r($printAdver);

?>
<html>
<?php $namePage = 'Liste Annonces'; include('includes/head.php'); ?>
<?php include('log.php'); ?>

<body>
    <?php include('includes/headerPro.php'); ?>
    <?php include('includes/message.php');?>
    <main>
    <?php
        foreach ($printAdver as $advertisement) {
            if ($advertisement['categorie'] == $_GET['category']) {
                $id = $advertisement['id'];
                echo '<div class="offrestyle">';
                echo '<a href="printAnnonce.php?uid=' . $id . '">';
                echo '</a><br>';
                echo '<div class="row">';
                echo '<div class="col-xl-6">';
                echo '<p class="text-vision"> Annonce créé par ' . $advertisement['pseudo'] . '</p>';
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
        ?>
    </main>
    <?php include('includes/footerPro.php'); ?>
</body>

</html>
