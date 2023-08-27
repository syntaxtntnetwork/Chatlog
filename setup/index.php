<?php
$filePath = "/var/www/chatlog/application/database/mysql.php";
$fileExists = file_exists($filePath);
if($fileExists){
    $fileTest = fopen($filePath, "r");
    $filesInput = fgets($fileTest);
    if($filesInput >= 1) {
        header("Location: ../index.php");
        exit;
    }
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup</title>
    <link rel="stylesheet" type="text/css" href="../assets/style/forms.css">
</head>
<?php
require "../application/system.php";
$mysql = null;
$parsedUrl = parse_url(getCurrentURL());
if (isset($parsedUrl['query'])) {
    parse_str($parsedUrl['query'], $queryParams);
    if (isset($queryParams['step'])) {
        $step = $queryParams['step'];

        switch($step) {
            case '1':
                $_SESSION['error'] = false;
                $_SESSION['message'] = 'Wir übernehmen die Einrichtung von allem...';
                $message = null;
                $error = false;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if(isset($_POST["submit"])){
                        $host = $_POST["host"];
                        $port = $_POST["port"];
                        $name = $_POST["dbname"];
                        $user = $_POST["dbuser"];
                        $password = $_POST["password"];
                        try {
                            $mysql = new PDO("mysql:host=$host:$port;dbname=$name", $user, $password);
                            $_SESSION["host"] = $_POST["host"];
                            $_SESSION["port"] = $_POST["port"];
                            $_SESSION["dbname"] = $_POST["dbname"];
                            $_SESSION["dbuser"] = $_POST["dbuser"];
                            $_SESSION["dbpasswd"] = $_POST["password"];
                            ?>
                            <meta http-equiv="refresh" content="1; URL=?step=2">
                            <?php
                        } catch (PDOException $e){
                            $error = true;
                            $message = $e->getMessage();
                        }
                    }
                }
                ?>
                <main>
                    <div class="message">
                        <?php if(isset($message)) { ?>
                        <h1><?php  if($error) { echo '⚠ FEHLER ⚠'; } else { echo "✔ ERFOLGREICH ✔"; } ?></h1><br />
                        <p><?php echo $message; } ?></p>
                    </div>
                    <form method="POST" action="">
                        <label for="host">Datenbank-Host:</label>
                        <input type="text" name="host" id="host" required><br><br>

                        <label for="port">Datenbank-Port:</label>
                        <input type="number" name="port" id="port" required><br><br>

                        <label for="dbname">Datenbank-Name</label>
                        <input type="text" name="dbname" id="dbname" required><br><br>

                        <label for="dbuser">Datenbank-Benutzer</label>
                        <input type="text" name="dbuser" id="dbuser" required><br><br>

                        <label for="password">Datenbank-Passwort</label>
                        <input type="password" name="password" id="password" required><br><br>

                        <input type="submit" name="submit" value="Bestätigen und weiter">
                    </form>
                </main>
                <?php
                break;
            case 2;
                $finished = false;
                if(!$finished) {
                    ?> <main><div class="message"><?php if($_SESSION['error']) {  echo '<svg  style="height:64px;width:64px;" class="simulation-result-svg fail" viewBox="0 0 125 124" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 3.8.3 (29802) - http://www.bohemiancoding.com/sketch -->
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Segment-circle-Copy-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <path d="M62.5,0 C75.5693069,0 88.3044554,4.13277174 98.8737624,11.7990942 L93.4158416,19.2924457 C84.4306931,12.7751449 73.6076733,9.26630435 62.5,9.26630435 L62.5,0 L62.5,0 Z" id="Segment-1" fill="#DD5663"></path>
        <path d="M98.8737624,11.7990942 C109.443069,19.4654167 117.314356,30.2822826 121.355198,42.6867754 L112.524752,45.5469746 C109.090347,35.0019203 102.40099,25.8097464 93.4158416,19.2924457 L98.8737624,11.7990942 L98.8737624,11.7990942 Z" id="Segment-2" fill="#DD5663"></path>
        <path d="M121.355198,42.6867754 C125.39604,55.0912681 125.39604,68.4594565 121.355198,80.8639493 L112.524752,78.00375 C115.959158,67.4586957 115.959158,56.092029 112.524752,45.5469746 L121.355198,42.6867754 L121.355198,42.6867754 Z" id="Segment-3" fill="#DD5663"></path>
        <path d="M121.355198,80.8639493 C117.314356,93.268442 109.443069,104.085308 98.8737624,111.75163 L93.4158416,104.258279 C102.40099,97.7409783 109.090347,88.5488043 112.524752,78.00375 L121.355198,80.8639493 L121.355198,80.8639493 Z" id="Segment-4" fill="#DD5663"></path>
        <path d="M98.8737624,111.75163 C88.3044554,119.417953 75.5693069,123.550725 62.5,123.550725 L62.5,114.28442 C73.6076733,114.28442 84.4306931,110.77558 93.4158416,104.258279 L98.8737624,111.75163 L98.8737624,111.75163 Z" id="Segment-5" fill="#DD5663"></path>
        <path d="M62.5,123.550725 C49.4306931,123.550725 36.6955446,119.417953 26.1262376,111.75163 L31.5841584,104.258279 C40.5693069,110.77558 51.3923267,114.28442 62.5,114.28442 L62.5,123.550725 L62.5,123.550725 Z" id="Segment-6" fill="#DD5663"></path>
        <path d="M26.1262376,111.75163 C15.5569307,104.085308 7.68564356,93.268442 3.64480198,80.8639493 L12.4752475,78.00375 C15.9096535,88.5488043 22.5990099,97.7409783 31.5841584,104.258279 L26.1262376,111.75163 L26.1262376,111.75163 Z" id="Segment-7" fill="#DD5663"></path>
        <path d="M3.64480198,80.8639493 C-0.396039604,68.4594565 -0.396039604,55.0912681 3.64480198,42.6867754 L12.4752475,45.5469746 C9.04084158,56.092029 9.04084158,67.4586957 12.4752475,78.00375 L3.64480198,80.8639493 L3.64480198,80.8639493 Z" id="Segment-8" fill="#DD5663"></path>
        <path d="M3.64480198,42.6867754 C7.68564356,30.2822826 15.5569307,19.4654167 26.1262376,11.7990942 L31.5841584,19.2924457 C22.5990099,25.8097464 15.9096535,35.0019203 12.4752475,45.5469746 L3.64480198,42.6867754 L3.64480198,42.6867754 Z" id="Segment-9" fill="#DD5663"></path>
        <path d="M26.1262376,11.7990942 C36.6955446,4.13277174 49.4306931,0 62.5,0 L62.5,9.26630435 C51.3923267,9.26630435 40.5693069,12.7751449 31.5841584,19.2924457 L26.1262376,11.7990942 L26.1262376,11.7990942 Z" id="Segment-10" fill="#DD5663"></path>
        <path d="M62.5,0 C75.5693069,0 88.3044554,4.13277174 98.8737624,11.7990942 L93.4158416,19.2924457 C84.4306931,12.7751449 73.6076733,9.26630435 62.5,9.26630435 L62.5,0 L62.5,0 Z" id="Segment-1" fill="#DD5663"></path>
        <path d="M98.8737624,11.7990942 C109.443069,19.4654167 117.314356,30.2822826 121.355198,42.6867754 L112.524752,45.5469746 C109.090347,35.0019203 102.40099,25.8097464 93.4158416,19.2924457 L98.8737624,11.7990942 L98.8737624,11.7990942 Z" id="Segment-2" fill="#DD5663"></path>
        <polygon id="Path" fill="#DD5663" points="68.3973333 61.9616667 85.8236667 44.3781667 80.3956667 39 62.9731667 56.5911667 45.3858333 39.1763333 40 44.5621667 57.6065 62.0115 40.1763333 79.6141667 45.5621667 85 63.023 67.382 80.6218333 84.8236667 86 79.3956667"></polygon>
    </g>
</svg><br>' . $_SESSION['message'];  ?> <br /><button class="login100-form-btn" onclick="window.location.href= '/'">Beenden</button></div></main> <?php

                    } else {
                        echo '<main class="setupspinner"><div style="top:50%;left:50%;" class="spinner"></div><br>'. $_SESSION['message'] .'</main>';
                        $host = $_SESSION["host"] ;
                        $port = $_SESSION["port"] ;
                        $dbname = $_SESSION["dbname"] ;
                        $dbuser = $_SESSION["dbuser"];
                        $dbpasswd = $_SESSION["dbpasswd"];

                        if(isset($host) && isset($port) && isset($dbname) && isset($dbuser) && isset($dbpasswd)) {
                            try {
                                $mysqlFile = fopen($filePath, "w");
                                fwrite($mysqlFile, '<?php
                                    $host = "' . $host . '";
                                    $port = "' . $port . '";
                                    $db = "' . $dbname . '";
                                    $user = "' . $dbuser . '";
                                    $password = "' . $dbpasswd . '";
                                    try {
                                    $mysql = new PDO("mysql:host=$host:$port;dbname=$name", $user, $password);
                                    } catch (PDOException $e){
                                    $e->getMessage();
                                    }
                                    ?>');
                                fclose($mysqlFile);
                            } catch (Exception $exception) {
                                $_SESSION['error'] = true;
                                $_SESSION['message'] = 'Ein Fehler ist bei der Einrichtung aufgetreten...';
                                $_SESSION['message'] .= '<br>'.$exception->getMessage();
                                ?> <meta http-equiv="refresh" content="0; URL=?step=2"> <?php
                            }

                            if($fileExists) {
                                $finished = true;
                                echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        var spinner = document.querySelector(".setupspinner");
        if (spinner) {
            spinner.parentNode.removeChild(spinner);
        }
    });
</script>';
                                $fileTest = fopen($filePath, "r");
                                $filesInput = fgets($fileTest);
                                if($filesInput >= 1) {
                                    ?> <main><svg style="height:64px;width:64px;" class="simulation-result-svg pass" viewBox="0 0 125 124" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <!-- Generator: Sketch 3.8.3 (29802) - http://www.bohemiancoding.com/sketch -->
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g id="Segment-circle-Copy-3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path d="M62.5,0 C75.5693069,0 88.3044554,4.13277174 98.8737624,11.7990942 L93.4158416,19.2924457 C84.4306931,12.7751449 73.6076733,9.26630435 62.5,9.26630435 L62.5,0 L62.5,0 Z" id="Segment-1" fill="#7ABB57"></path>
                                                <path d="M98.8737624,11.7990942 C109.443069,19.4654167 117.314356,30.2822826 121.355198,42.6867754 L112.524752,45.5469746 C109.090347,35.0019203 102.40099,25.8097464 93.4158416,19.2924457 L98.8737624,11.7990942 L98.8737624,11.7990942 Z" id="Segment-2" fill="#7ABB57"></path>
                                                <path d="M121.355198,42.6867754 C125.39604,55.0912681 125.39604,68.4594565 121.355198,80.8639493 L112.524752,78.00375 C115.959158,67.4586957 115.959158,56.092029 112.524752,45.5469746 L121.355198,42.6867754 L121.355198,42.6867754 Z" id="Segment-3" fill="#7ABB57"></path>
                                                <path d="M121.355198,80.8639493 C117.314356,93.268442 109.443069,104.085308 98.8737624,111.75163 L93.4158416,104.258279 C102.40099,97.7409783 109.090347,88.5488043 112.524752,78.00375 L121.355198,80.8639493 L121.355198,80.8639493 Z" id="Segment-4" fill="#7ABB57"></path>
                                                <path d="M98.8737624,111.75163 C88.3044554,119.417953 75.5693069,123.550725 62.5,123.550725 L62.5,114.28442 C73.6076733,114.28442 84.4306931,110.77558 93.4158416,104.258279 L98.8737624,111.75163 L98.8737624,111.75163 Z" id="Segment-5" fill="#7ABB57"></path>
                                                <path d="M62.5,123.550725 C49.4306931,123.550725 36.6955446,119.417953 26.1262376,111.75163 L31.5841584,104.258279 C40.5693069,110.77558 51.3923267,114.28442 62.5,114.28442 L62.5,123.550725 L62.5,123.550725 Z" id="Segment-6" fill="#7ABB57"></path>
                                                <path d="M26.1262376,111.75163 C15.5569307,104.085308 7.68564356,93.268442 3.64480198,80.8639493 L12.4752475,78.00375 C15.9096535,88.5488043 22.5990099,97.7409783 31.5841584,104.258279 L26.1262376,111.75163 L26.1262376,111.75163 Z" id="Segment-7" fill="#7ABB57"></path>
                                                <path d="M3.64480198,80.8639493 C-0.396039604,68.4594565 -0.396039604,55.0912681 3.64480198,42.6867754 L12.4752475,45.5469746 C9.04084158,56.092029 9.04084158,67.4586957 12.4752475,78.00375 L3.64480198,80.8639493 L3.64480198,80.8639493 Z" id="Segment-8" fill="#7ABB57"></path>
                                                <path d="M3.64480198,42.6867754 C7.68564356,30.2822826 15.5569307,19.4654167 26.1262376,11.7990942 L31.5841584,19.2924457 C22.5990099,25.8097464 15.9096535,35.0019203 12.4752475,45.5469746 L3.64480198,42.6867754 L3.64480198,42.6867754 Z" id="Segment-9" fill="#7ABB57"></path>
                                                <path d="M26.1262376,11.7990942 C36.6955446,4.13277174 49.4306931,0 62.5,0 L62.5,9.26630435 C51.3923267,9.26630435 40.5693069,12.7751449 31.5841584,19.2924457 L26.1262376,11.7990942 L26.1262376,11.7990942 Z" id="Segment-10" fill="#7ABB57"></path>
                                                <path d="M62.5,0 C75.5693069,0 88.3044554,4.13277174 98.8737624,11.7990942 L93.4158416,19.2924457 C84.4306931,12.7751449 73.6076733,9.26630435 62.5,9.26630435 L62.5,0 L62.5,0 Z" id="Segment-1" fill="#7ABB57"></path>
                                                <path d="M98.8737624,11.7990942 C109.443069,19.4654167 117.314356,30.2822826 121.355198,42.6867754 L112.524752,45.5469746 C109.090347,35.0019203 102.40099,25.8097464 93.4158416,19.2924457 L98.8737624,11.7990942 L98.8737624,11.7990942 Z" id="Segment-2" fill="#7ABB57"></path>
                                                <polygon id="Shape" fill="#7ABB57" points="58.75 86.4231618 37 65.4633088 43.7449167 58.4993382 58.6219167 72.7524265 88.1294167 42.5768382 95 49.4122059"></polygon>
                                            </g>
                                        </svg><br><p>Die Konfiguration wurde erfolgreich abgeschlossen.</p><br><button class="login100-form-btn" onclick="window.location.href= '/'">Beenden</button></main>   <?php
                                    session_destroy();
                                } else {
                                    $_SESSION['error'] = true;
                                    $_SESSION['message'] = 'Ein Fehler ist bei der Einrichtung aufgetreten...';
                                    $_SESSION['message'] .= '<br>'.$exception->getMessage();
                                    ?> <meta http-equiv="refresh" content="0; URL=?step=2"> <?php
                                }
                            }
                        } else {
                            ?> <meta http-equiv="refresh" content="0; URL=?step=1"> <?php
                        }
                    }
                }
                break;
            default:
                ?> <meta http-equiv="refresh" content="0; URL=?step=1"> <?php
        }
    }
}
?>