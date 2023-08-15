<?php
if(file_exists("../application/mysql.php")){
    header("Location: ../index.php");
    exit;
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
    <link rel="stylesheet" type="text/css" href="/assets/style/forms.css">
</head>
<body>
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
        }
    }
}
?>