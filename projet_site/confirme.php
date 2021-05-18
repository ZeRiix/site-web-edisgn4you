<?php

$bdd = new PDO('mysql:host=edesigwzeriix.mysql.db;dbname=edesigwzeriix', 'edesigwzeriix', 'ZeRiix75');

if (isset($_GET['mail']) AND isset($_GET['key'])) {

    $mail = htmlspecialchars(urlencode($_GET['mail']));
    $key = htmlspecialchars($_GET['key']);

    $reqconfirm = $bdd->prepare('SELECT * FROM membres WHERE mail = ? AND confirmkey = ?');
    $reqconfirm->execute(array($mail, $key));
    $confirmexist = $reqconfirm->rowCount();
    $confirmtable = $reqconfirm->fetch();

    if ($confirmexist == 1) {

        if ($confirmtable['confirme'] == 0) {

            $id = $confirmtable['id'];
            $req = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE id = ?');
            $req->execute(array($id));

        } else {
            echo '<p>votre compte est déja confirmé</p>';
        }
    } else {
        echo '<p>votre compte n\'existe pas</p>';
    }
} else {
    echo '<p>erreur de confirmation</p>';
}

?>