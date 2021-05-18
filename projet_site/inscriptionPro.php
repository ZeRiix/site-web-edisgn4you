<?php

include('includes/bdd.php');
// pays
function getIp() {
   	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

       	$ip = $_SERVER['HTTP_CLIENT_IP'];

   	}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

      	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

   	} else {

       	$ip = $_SERVER['REMOTE_ADDR'];
   	}
return $ip;
};
$ipAddr = getIp();
if ($ipAddr) {
   	$country = $ipAddr;
}
// fucntion alpha
function verif_alpha($str){
   	preg_match("/([^A-Za-z\s])/",$str,$result);
   	if(!empty($result)){
     	return false;
   	}
   	return true;
};
// function num
function verif_num($ntr){
   	preg_match("/([^0-9\s])/",$ntr,$results);
   	if(!empty($results)){
     	return false;
   	}
   	return true;
};

if(isset($_POST['forminscription'])) {

   	$name = htmlspecialchars($_POST['prenom']);
   	$surname = htmlspecialchars($_POST['surname']);
   	$num = htmlspecialchars($_POST['num']);
   	$pseudo = htmlspecialchars($_POST['pseudo']);
   	$mail = htmlspecialchars($_POST['mail']);
   	$mdp = sha1($_POST['mdp']);
   	$mdp2 = sha1($_POST['mdp2']);
   	$date = date("d/m/Y");
	$description = "none";

   	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {

      	$pseudolength = strlen($pseudo);

      	if($pseudolength <= 60 && $pseudolength > 7) {

         	$namelenght = strlen($name);
         	if ($namelenght <= 60 && $namelenght > 7 && verif_alpha($name) == true) {

            	$surnamelenght = strlen($surname);
            	if ($surnamelenght <= 60 && $surnamelenght > 7 && verif_alpha($surname) == true) {

               		$numlenght = strlen($num);
               		if ($numlenght == 10 && verif_num($num) == true) {

                  		if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                     		$reqmail = $bdd->prepare("SELECT * FROM membrespro WHERE mail = ?");
                     		$reqmail->execute(array($mail));
                     		$mailexist = $reqmail->rowCount();

                     		if($mailexist === 0) {

                        		if($mdp == $mdp2) {

									$sizeKey = 10;
									$key = "";

									for ($i = 1; $i < $sizeKey; $i++) {
										$key .= mt_rand(0,9);
									}

                           			$insertMember = $bdd->prepare("INSERT INTO membrespro(pseudo,mail,motdepasse,prenom,nom,date_crea,pays,num, descriptions) VALUES(?,?,?,?,?,?,?,?,?)");
                           			$insertMember->execute(array($pseudo, $mail, $mdp, $name, $surname, $date, $country, $num, $description));

									   $header = 'MINE-Version: 1.0\r\n';
									   $header .= 'From:"[e-design4you]"<e-design4you@gmail.com>' . '\n';
									   $header .= 'Content-Type:text/html; charset="utf-8"' . '\n';
									   $header.='Content-Transfer-Encoding: 8bit';
										  $mailconfirm='
										   <html>
												  <body>
													 <div align="center">
														<p>Merci de cliquer sur le lien pour confirmer votre compte</p>
														<a href="https://e-design4you.com/confirmePro.php?mail=.urlencode($mail).?key=.$key</a>
													 </div>
												  </body>
										   </html>
										  ';
									   mail($mail, "Confirmation de compte", $mailconfirm, $header);

                           			header('location: connexionPro.php?erreur=Votre compte a bien été créé !');
                           			// var_dump(http_response_code(200));

                        		} else {
                           			header('location: inscriptionPro.php?erreur=Vos mots de passes ne correspondent pas !');
                        		}
                     		} else {
                        		header('location: inscriptionPro.php?erreur=Adresse mail déjà utilisée !');
                     		}
                  		} else {
                     		header('location: inscriptionPro.php?erreur=Votre adresse mail n\'est pas valide !');
                  		}
               		} else {
                  		header('location: inscriptionPro.php?erreur=erreur dans la structuture du num tel');
               		}
            	} else {
               		header('location: inscriptionPro.php?erreur=erreur dans la structuture de votre nom');
            	}
        	} else {
        		header('location: inscriptionPro.php?erreur=erreur dans la structuture du prénom');
        	}
    	} else {
        	if ($namelenght > 60) {
            	header('location: inscriptionPro.php?erreur=votre pseudo est trop long');
        	}
        	if ($namelenght < 7) {
            	header('location: inscriptionPro.php?erreur=votre pseudo est trop court');
        	}
    		}
   	} else {
      	header('location: inscriptionPro.php?erreur=Tous les champs doivent être complétés !');
   	}
}
?>
<html>

	<?php $namePage = 'Inscription Pro'; include('includes/head.php'); ?>

	<body>
	<?php // include('log/log.php'); ?>

		<?php include('includes/header.php'); ?>

		<main>
			<?php include('includes/message.php'); ?>
			<?php  if(isset($erreur)) { echo '<font color="orange">' . $erreur . "</font>"; } ?>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="spacer50" id="spacer50"></div>
          <div class="container-fluid">
            <div class="container" id="container-inscription">
              <h1>Créer un compte</h1>
              <h2>Vous êtes un acheteur ? <a href="inscription.php">Créer un compte normal<a></h2>
              <div class="spacer30" id="spacer30"></div>
              <div class="row" id="row-prenom">
                <div class="col-xl-6">
      				<input type="text" name="prenom" placeholder="Prénom">
      				<br>
              </div>
              <div class="col-xl-6">
      				<input type="text" name="surname" placeholder="Nom">
      				<br>
              </div>
            </div>
            <div class="spacer20" id="spacer20"></div>
            <div class="row" id="row-pseudo">
              <div class="col-xl-6">
            <input type="text" name="pseudo" placeholder="Pseudo">
            <br>
            </div>
            <div class="col-xl-6">
              <input type="text" name="num" placeholder="Téléphone">
            <br>
            </div>
          </div>
          <div class="spacer20" id="spacer20"></div>
      				<input type="email" name="mail" placeholder="Adresse email" class="email-inscrip">
      				<br>
              <div class="spacer20" id="spacer20"></div>
              <div class="row" id="row-prenom">
                <div class="col-xl-6">
      				<input type="password" name="mdp" placeholder="Mot de passe">
      				<br>
              </div>
              <div class="col-xl-6">
      			 <input type="password" name="mdp2" placeholder="Mot de passe">
      				<br>
              </div>
            </div>
            <div class="spacer30" id="spacer30"></div>
      				<input style="margin-left: 75%;"class="btn btn-primary" type="submit"  name="forminscription" value="S'inscrire">
      				<br>
          <div class="spacer30" id="spacer30"></div>
        </div>
      </div>
      </form>
        <div class="spacer100" id="spacer100"></div>
      </main>

		<?php include('includes/footer.php'); ?>

	</body>
</html>
