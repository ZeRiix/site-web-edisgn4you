<?php
include('includes/bdd.php');

$h=0;

$log = fopen('log_du_site.txt', 'a+');

for($i=0;$i<=9000000;$i++){
    $h++;
    if($h%10 === 0) {
        $line = date("Y/m/d - H:i:s") . ' - le temps passé sur la page ' . $namePage . ' pour l\'instant est de : ' . $h . 's' . ' pour l\'utilisteur : ' . $_SESSION['pseudo'] . ' avec l\'id : ' . $_SESSION['id'] . ' et le mail : ' . $_SESSION['mail'] . "\n";
        fseek($log, 0);
        fputs($log, $line);
    }
}
fclose($log);
?>