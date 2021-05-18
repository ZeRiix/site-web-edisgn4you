    <!--<script>
    function log() {
        $.ajax({
            url: "./functionLog.php",
            success: fucntion(msg) {
                alert(msg);
            }
        });
    }
    </script>
    <div onunload="log();"></div>
        <?php /*

            if (isset($_SESSION['id'])) {

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
                    $country = geoip_country_name_by_name($ipAddr);
                }

                $log = fopen('log_du_site.txt', 'a+');
                $line = date("Y/m/d - H:i:s") . ' - connexion à la page ' . $namePage . ' : ' .$_SESSION['pseudo'].' avec l\'id ' .$_SESSION['id'].' et le mail '. $_SESSION['mail'] . ' dans le pays : ' . $country . ' avec l\'addresse ip : ' . $ipAddr . '.' . "\n";
                fputs($log, $line);
                fclose($log);
            }
            */
        ?> -->