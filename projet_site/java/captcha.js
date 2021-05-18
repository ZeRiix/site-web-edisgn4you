function captcha() {

    var compteur = ['imageCaptcha/image1.png','imageCaptcha/image2.png','imageCaptcha/image3.png','imageCaptcha/image4.png','imageCaptcha/image5.png','imageCaptcha/image6.png','imageCaptcha/image7.png','imageCaptcha/image8.png','imageCaptcha/image9.png'];
    var images = [];

    var rands = 54;
    for (var i = 0; i < 9; i++) {
        var rand = getRandomInt();
        rands = rand;
        if (rand != rands) {
            var b = i - 1;
            images[b] = compteur[rand];
        } else {
            i--;
        }
    }

    var image;
    var div = document.getElementById('conteneur');

    for( d = 0; d < images.length; d++) {
        image = document.createElement('img');
        image.src = images[d];
        image.class = 'imagecaptcha';
        div.appendChild(image);
    }

    var input = document.createElement(input);
    input.type ='text';
    input.placeholder = 'enter numero of image valid';
    input.id = 'in';
    div.appendChild(input);

    var button = document.createElement(button);
    button.type = 'button';
    button.onclick = 'verrif()';
    div.appendChild(button);
}

function getRandomInt() {
    return Math.floor(Math.random() * 8);
}

function verrif() {

    var input = document.getElementById("in").value;
    var div = document.getElementById('conteneur');

    if (input === 6) {
        // creer le bouton connexion.
    } else {
        var text = document.write("<label>mauvaise image selectionné !!!</label>");
        div.appendChild(text);
    }
}

function captcha2() {

    var images = ['imageCaptcha/image1.png','imageCaptcha/image2.png','imageCaptcha/image3.png','imageCaptcha/image4.png','imageCaptcha/image5.png','imageCaptcha/image6.png','imageCaptcha/image7.png','imageCaptcha/image8.png','imageCaptcha/image9.png'];

    var image;
    var div = document.getElementById('conteneur');

    for( d = 0; d < images.length; d++) {

        image = document.createElement('img');
        image.src = images[d];
        image.class = 'imagecaptcha';
        div.appendChild(image);
    }
}