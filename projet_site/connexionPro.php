<!DOCTYPE html>
<html>
    <?php $namePage = 'Connexion'; include('includes/head.php'); ?>

	<?php // include('log/log.php');?>

		<header>
            <div class="container-fluid" id="banner-connexion">
                <div class="row">
                    <div class="col-lg-4 col-sm-3">
                        <a href="index.php"><img src="images/fleche.png" height="65%"></a>
                    </div>
                    <div class="col-lg-8 col-sm-9">
                        <img src="images/head_connexion.png">
                    </div>
                </div>
            </div>
        </header>
        <?php include('includes/message.php'); ?>
		<main>
            <?php if(isset($erreur)) { echo '<font color="orange">'.$erreur."</font>"; } ?>

            <div class="spacer50" id="spacer50"></div>
            <div class="container-fluid" id="container-connexion">
                <h1>Bonjour !</h1>
                <p>Connectez-vous pour passer en mode PRO</p>

                <form action="verif_connexionPro.php" class="container-fluid" id="container-email" method="post">
                    <div class="mb-3">
                        <label>Votre Email</label>
                        <input class="form-control" id="emailvalue" type="email" name="mailconnect" placeholder="" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Votre Mot de Passe</label>
                        <input class="form-control" type="password" id="mdpvalue" name="mdpconnect" placeholder="">
                    </div>
                    <a href="#" style="text-decoration: none;">mot de passe oublié</a>

                    <div class="spacer20" id="spacer20"></div>

                    <input class="btn btn-primary" id="connexion-button" name="formconnexion" type="submit" value="Se connecter">

                    <div class="spacer20" id="spacer20"></div>

                    <div style="text-align: center">Envie de nous rejoindre ? <a href="inscriptionPro.php" style="text-decoration: none"><strong>Créer un Compte</strong></a></div>

                    <div class="spacer20" id="spacer20"></div>
                </form>
            </div>
		</main>
	</body>
</html>
