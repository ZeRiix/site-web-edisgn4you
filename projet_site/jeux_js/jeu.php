<?php include('../includes/bdd.php') ?>
<html>
    <head>
        <title>jeu secret</title>
        <meta charset="utf-8">
        <style>
            * { padding: 0; margin: 0; }
            canvas { background: #eee url(test.png); display: block; margin: 0 auto; }
        </style>
    </head>
    <body>
        <canvas id="myCanvas" width="920" height="680"></canvas>
        <div align="center">
            <button class="btn btn-secondary" onclick="jeux()">lancer le jeu</button>
            <script src="jeux.js" charset="utf-8"></script>
        </div>
        <!--<?php
        function resol() {
            $resol='<script type="text/javascript">document.write(""+screen.width+"*"+screen.height+"");</script>';
            return $resol;
        }
        $resolution=resol();
        // utiliser la variable resoltion pour afficher la bonne taille pour le jeu.
        ?> -->
    </body>
</html>