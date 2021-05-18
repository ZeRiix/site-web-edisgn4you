function jeux() { // cette function est un casse briques
    var canvas = document.getElementById("myCanvas"); // recuperation de la balise canvas par son id var
    system2d = canvas.getContext("2d"); // espace 2d (canvas)
var dimball = 10; // dimension de la ball en pixel;
var x = canvas.width/2; // place l'axe des x dans le canvas au milieu
var y = canvas.height-30; // place l'axe des y dans le canvas a -30px du bas de la fenetre canvas soit(=650 px en partant du haut du canvas)
var dx = 2;
var dy = -2;
// systeme de paddle
var barreHeight = 15; // hauteur du paddle
var barreWidth = 100; // largeur duy paddle
var paddleX = (canvas.width-barreWidth)/2;
var rightPressed = false; // definie la variable qui definie la touche droite comme desactivé soit false en boolean
var leftPressed = false; // definie la variable qui definie la touche gauche comme desactivé soit false en boolean
// systeme de brique
var brickRowCount = 10; // nb de colonnes de briques
var brickColumnCount = 4; // nb rangées de briques
var brickWidth = 75; // largeur de la brique
var brickHeight = 20; // hauteur de la brique
var brickPadding = 10; // distance entre chaque brique
var brickOffsetTop = 60; // distance minimum entre la bande superieur du canvas
var brickOffsetLeft = 30; // distance minimum entre la bande gauche du canvas (sert a centrer les briques dans le canvas)
var score = 0; // variable de score
var lives = 3; // nb de vie

var bricks = []; // systeme pour placer les briques dans le canvas
for(var c=0; c<brickColumnCount; c++) {
    bricks[c] = [];
    for(var r=0; r<brickRowCount; r++) {
        bricks[c][r] = { x: 0, y: 0, status: 1 };
    }
}

document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);
document.addEventListener("mousemove", mouseMoveHandler, false);

function keyDownHandler(e) { // fonction pour controler le paddle avec les touches left et right du clavier
    if(e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = true;
    }
    else if(e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = true;
    }
}

function keyUpHandler(e) { // fonction pour controler le paddle avec la souris (a voir)
    if(e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = false;
    }
    else if(e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = false;
    }
}

function mouseMoveHandler(e) { // fonction pour controler le paddle avec la souris (a voir)
    var relativeX = e.clientX - canvas.offsetLeft;
    if(relativeX > 0 && relativeX < canvas.width) {
        paddleX = relativeX - barreWidth/2;
    }
}
function collisionDetection() { // funtion qui verrifie les colisions et active la victoire en cas de destruction de toutes les briques
    for(var c=0; c<brickColumnCount; c++) {
        for(var r=0; r<brickRowCount; r++) {
            var b = bricks[c][r]; // cette ligne recupere le tableau contenant les briques et les stocke dans b
            if(b.status == 1) {
                if(x > b.x && x < b.x+brickWidth && y > b.y && y < b.y+brickHeight) { // verrifie le nombres de briques detreuites
                    dy = -dy;
                    b.status = 0;
                    score++; // incremente le score a chaque fois que le joueur detruit une brique
                    if(score == brickRowCount*brickColumnCount - 1) { // conditions qui verrifie le score et affichage le congratulaztions et remet le jeu a 0
                        // window.location.hostname='http://www.w3docs.com/'; // des que la victoire est prononcer cette ligne permet de rediriger sur une autre page
                        document.location.reload(); // remet le jeu a 0 // mettre un return une variable pour incrementer une variable en php pour changer de niveau (nivf supplementaire a faire si besoin)
                    }
                }
            }
        }
    }
}

function drawBall() { // fucntion pour afficher la balle
    system2d.beginPath();
    system2d.arc(x, y, dimball, 0, Math.PI*2); // ligne pour generer la ball
    system2d.fillStyle = "#aa00ff"; // ligne popur changer la couleur de la balle
    system2d.fill();
    system2d.closePath();
}
function drawPaddle() { // function pour afficher le paddle
    system2d.beginPath();
    system2d.rect(paddleX, canvas.height-barreHeight, barreWidth, barreHeight); // ligne pour generer le paddle
    system2d.fillStyle = "purple"; // ligne pour changer la couleur du paddle
    system2d.fill();
    system2d.closePath();
}
function drawBricks() {
    for(var c=0; c<brickColumnCount; c++) { // systeme de double boucle pour placer les briques
        for(var r=0; r<brickRowCount; r++) {
            if(bricks[c][r].status == 1) {
                var brickX = (r*(brickWidth+brickPadding))+brickOffsetLeft; // ligne qui definira la position en x de la 1er brique dans le canvas
                var brickY = (c*(brickHeight+brickPadding))+brickOffsetTop; // ligne qui definira la position en y de la 2eme brique dans le canvas
                bricks[c][r].x = brickX; // ligne qui definira la position en x de la brique dans le canvas
                bricks[c][r].y = brickY; // ligne qui definira la position en y de la brique dans le canvas
                system2d.beginPath();
                system2d.rect(brickX, brickY, brickWidth, brickHeight); // ligne qui definie les dimensions de la brique
                system2d.fillStyle = "blue"; // ligne pour changer la couleur des briques
                system2d.fill();
                system2d.closePath();
            }
        }
    }
}
function drawScore() {
    system2d.font = "16px Segoe UI Black"; // ligne qui definie la police d'ecriture du score.
    system2d.fillStyle = "purple"; // ligne qui donne la couleur du texte du score
    system2d.fillText("Score: "+score, 15, 30); // texte du score + position du texte
}
function drawLives() {
    system2d.font = "16px Segoe UI Black"; // ligne qui definie la police d'ecriture du compteur de vie
    system2d.fillStyle = "purple"; // ligne qui donne la couleur du texte du compteur de vie
    system2d.fillText("Lives: "+lives, canvas.width-80, 30); // texte du compteur de vie + position du texte
}
function drawTitle() {
    system2d.beginPath();
    system2d.rect(canvas.width/2-85, 0,150,55); // ligne pour generer le paddle
    system2d.fillStyle = "purple"; // ligne pour changer la couleur du paddle
    system2d.fill();
    system2d.closePath();
    system2d.font = "16px Segoe UI Black"; // ligne qui definie la police d'ecriture du compteur de vie
    system2d.fillStyle = "white"; // ligne qui donne la couleur du texte du compteur de vie
    system2d.fillText("BRICK-BREACK", canvas.width/2-70, 30); // texte du compteur de vie + position du texte
}
function draw() { // fucntion qui s'occupe de l'affichage dans le canvas
    system2d.clearRect(0, 0, canvas.width, canvas.height); // ligne qui supprime tout ce qui pourrais rester dans le canvas
    drawBricks(); // fucntion precedente deja expliqué
    drawBall(); // fucntion precedente deja expliqué
    drawPaddle(); // fucntion precedente deja expliqué
    drawScore(); // fucntion precedente deja expliqué
    drawLives(); // fucntion precedente deja expliqué
    collisionDetection(); // fucntion precedente deja expliqué
    drawTitle(); // fucntion precedente deja expliqué

    if(x + dx > canvas.width-dimball || x + dx < dimball) {
        dx = -dx;
    }
    if(y + dy < dimball) {
        dy = -dy;
    }
    else if(y + dy > canvas.height-dimball) { // verrifie que la balle ne sort pas de de l'ecran en bas
        if(x > paddleX && x < paddleX + barreWidth) {
            dy = -dy;
        }
        else {
            lives--; // decremente de niombres de vie en cas de perte
            if(!lives) { // si lives est NULL
                alert("GAME OVER"); // affiche le message en cas de defaite du jeoeur dans un pop-up
                document.location.reload(); // remet le jeu a 0
            }
            else {
                x = canvas.width/2;
                y = canvas.height-30;
                dx = 3;
                dy = -3;
                paddleX = (canvas.width-barreWidth)/2;
            }
        }
    }

    if(rightPressed && paddleX < canvas.width-barreWidth) { // si la souris va dans le meme sans que la touche la vitesse du paddle augmente
        paddleX += 7;
    }
    else if(leftPressed && paddleX > 0) { // si la souris va dans le sans contraire à la touche la vitesse du paddle diminue
        paddleX -= 7;
    }
    x += dx;
    y += dy;
    requestAnimationFrame(draw); // cette ligne envoie l'info a la function d'affichage
}

draw(); // cette ligne enclenche l'affichage du jeux.
}

// fin du jeu

function forms() {
    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");
    // carre
    ctx.beginPath();
    ctx.rect(20, 40, 50, 50);
    ctx.fillStyle = "#FF0000";
    ctx.fill();
    ctx.closePath();
    // rond
    ctx.beginPath();
    ctx.arc(240, 160, 20, 0, Math.PI*2, false);
    ctx.fillStyle = "green";
    ctx.fill();
    ctx.closePath();
    // rectangle
    ctx.beginPath();
    ctx.rect(160, 10, 100, 40);
    ctx.strokeStyle = "rgba(0, 0, 255, 0.5)";
    ctx.stroke();
    ctx.closePath();
}