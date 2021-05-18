<?php

include('includes/bdd.php');

if (isset($_GET['idp'])) {
    var_dump($_GET);
    $req = $bdd->prepare('SELECT * FROM offres WHERE id=?');
    $req->execute(array($_GET['idp']));
    $printreq = $req->fetchAll(PDO::FETCH_ASSOC);
    $exist = $req->rowCount();
    if (($exist === 1)){
        echo 'bravo<br><br>';
        // print_r($printreq);
        print_r($printreq[0]);
        print_r($_SESSION['panier']);
        echo '<br><br>';
        if ($_SESSION['panier'][1]) {
            $nb = count($_SESSION['panier']) + 1;
            print_r($nb);
            $_SESSION['panier'][$nb] = $printreq[0];
        } else {
            $_SESSION['panier'][1] = $printreq[0];
            print_r($_SESSION['panier']);
        }

        header("location:index.php?erreur=article ajouté au panier");

    } else {
        header("location:index.php?erreur=erreur=article n'existe plus");
    }
} else {
    header("location:index.php?erreur=erreur=article n'existe plus");
}