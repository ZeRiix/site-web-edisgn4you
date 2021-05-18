<?php
// Afficher le parametre GET message si il existe et qu'il n'est pas vide
if(isset($_GET['erreur']) && !empty($_GET['erreur'])){

	echo '<p class="alert alert-danger" >' . htmlspecialchars($_GET['erreur']) . '</p>';
}
elseif (isset($_GET['message']) && !empty($_GET['message'])){

    echo '<p class="alert alert-danger" >' . htmlspecialchars($_GET['message']) . '</p>';
}
?>