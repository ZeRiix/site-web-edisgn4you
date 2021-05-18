<?php include('includes/bdd.php')?>
<html>
    <?php $namePage = 'Annonce'; include('includes/head.php'); ?>
    <?php include('log.php'); ?>
    <body>
    <?php include('includes/headerPro.php'); ?>
    <?php include('includes/message.php');?>
        <main>
          <div class="spacer50" id="spacer50"></div>
          <div class="row">
            <div class="col-xl-12" id="container-apropos">
          <h1>E-Design4You</h1>
      </div>
        </div>
      <div class="spacer10" id="spacer10"></div>
      <div class="container-fluid" id="container-imgapropos">
          <img src="images/apropos.png" id="img-apropos">
        </div>
        <div class="spacer20" id="spacer20"></div>
        <div class="container-fluid" id="container-pres">
          <h1>A propos de nous </h1>
          <p>Ce site a été créé et réalisé par William Florentin et Mattéo Solari.
          Nous sommes deux jeunes étudiants de 19 ans en 1ère année à l'ESGI.
          Nous sommes tous les deux à la recherche d'un stage en informatique sur la période de mi-mai à août.
          Passioné d'informatique, nous espérons que notre site web vous fera bonne impression :) .</p>
        </div>
        <div class="spacer20" id="spacer20"></div>
        <div class="row" id="row-apropos">
          <div class="col-xl-3"></div>
          <div class="col-xl-3" id="portrait1">
            <img src="images/portrait1.jpg" id="imageportrait1">
            <div class="spacer20" id="spacer20"></div>
            <h1>Développeur</h1>
            <h2>Mattéo Solari</h2>
            <h2>22matteoz@gmail.com</h2>
            <h2>07 82 36 82 96</h2>
            <a href="https://www.linkedin.com/in/matt%C3%A9o-solari?originalSubdomain=fr"><img src="images/picto_linkedin.png" id="picto_linkedin"></a>
          </div>
            <div class="col-xl-3" id="portrait2">
              <img src="images/portrait2.jpeg" id="imageportrait2">
              <div class="spacer20" id="spacer20"></div>
              <h1>Développeur</h1>
              <h2>William Florentin</h2>
              <h2>willflo46@gmail.com</h2>
              <h2>01 23 45 67 89</h2>
              <a href="https://www.linkedin.com/in/william-florentin-80696b1b7/?originalSubdomain=fr"><img src="images/picto_linkedin.png" id="picto_linkedin"></a>
            </div>
            <div class="col-xl-3"></div>
          </div>
        </main>
          <div class="spacer50" id="spacer50"></div>
          <?php include('includes/footerPro.php'); ?>

    </body>
</html>
