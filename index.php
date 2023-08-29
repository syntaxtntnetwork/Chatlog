<?php
if(file_exists("application/database/mysql.php")){
    $fileTest = fopen("application/database/mysql.php", "r");
    $filesInput = fgets($fileTest);
    if($filesInput == 0) {
        header("Location: setup/?step=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="https://cdni.syntaxtnt.de/images/9nbP138OZq4m7052NUBHMIL6pdJSWEkI.png">
    <title>Chatlog :: SyntaxTNT</title>
</head>
<body>
<?php
require "application/database/mysqldriver.php";
$name = 'TntTastisch';
$server = 'Test-1';
$imageUrl = "https://cravatar.eu/avatar/{$name}/128.png";
$message = "Es wurde kein Code eingeben...";
$code = null;
checkConnection();
if(isset($_GET["submit"])) {
    if(isset($_POST["code"]) && (!isset($_GET["code"]))) {
        ?>  <meta http-equiv="refresh" content="0; URL=?submit=1&code=<?php echo $_POST["code"]; ?>"> <?php
    }

    if(isset($_GET["code"])) {
        if(strlen($_GET["code"]) === 0) {
            $message = "Dieser Code ist ungültig!";
            die();
        }
        if(isset($_POST["code"])) {
            $code = $_POST["code"];
        } else {
            $code = $_GET["code"];
        }
    } else {
        $message = "Dieser Code wurde nicht gefunden...";
    }
}
?>
<div class="container">
    <div class="row">

        <section class="discussions">
            <div class="discussion search">
                <div class="searchbar">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <form method="post" action="?submit=1">
                        <input type="text" name="code" id="code" placeholder="Suchen..." />
                    </form>
                </div>
            </div>

            <div class="discussion message">
                <div class="desc-contact">
                    <a style="font-size:24px;" class="name" href="http://syntaxtnt.de/">Start</a>
                </div>
            </div>

            <div class="discussion message">
                <div class="desc-contact">
                    <a style="font-size:24px;" class="name" href="http://forum.syntaxtnt.de/">Forum</a>
                </div>
            </div>
        </section>
        <section class="chat">
            <?php if(isset($code)) { ?>
            <div class="header-chat">
                <p class="name">
                    <i class="icon fa fa-server" aria-hidden="true"></i> <strong>Server</strong> <?php echo $server; ?>
                </p>
                <p class="name">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i> <strong>User</strong>  <?php echo $name; ?>
                </p>
            </div>
            <div class="messages-chat">
                <div class="message">
                    <div class="photo"
                         style="background-image: url(<?php echo $imageUrl; ?>);">
                    </div>
                    <p class="text"> Ich bin Heilfroh </p>
                </div>
                <p class="time"> 27.08.2023 13:26</p>
                <div class="message">
                    <div class="photo"
                         style="background-image: url(<?php echo $imageUrl; ?>);">
                    </div>
                    <p class="text"> Reichserde & Heildünger </p>
                </div>
                <p class="time"> 27.08.2023 13:29</p>
            </div>
            <?php } else {
            ?> <div class="header-chat">
                <p class="name"><?php echo $message; ?></p><?php
            } ?>
        </section>
    </div>
</div>
</body>
</html>