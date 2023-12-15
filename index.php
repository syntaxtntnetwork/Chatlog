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
$name = '';
$server = '';
$message = 'Es wurde kein Code eingegeben...';
$code = null;
$error = false;
$messageInput = "";

if (checkConnection()) {
    if (isset($_GET["code"])) {
        if (strlen($_GET["code"]) === 0 || getContent($_GET["code"]) === null) {
            $message = "Dieser Code ist ungültig!";
            $error = true;
        } else {
            $code = $_GET["code"];
            $error = false;

            $content = getContent($code);
            $decodedMessages = json_decode($content["MESSAGES"], true);

            if (json_last_error() === JSON_ERROR_NONE) {
                foreach ($decodedMessages as $message) {
                    $server = $message['server'];
                    $name = $message['name'];
                    $messageInput .= "
<div class='message'>
    <div class='photo' style='background-image: url(https://cravatar.eu/avatar/" . $message['name'] . "/128.png);'>
    </div>
    <p class='text'>" . $message['message'] . "</p>
</div>
<p class='time'>" . $message['timestamp'] . " | " . $message["server"] . "</p>
";
                }
            } else {
                $message = "Dieser Code ist ungültig!";
                $error = true;
            }
        }
    } else {
        $message = "Dieser Code wurde nicht gefunden...";
        $error = true;
    }
} else {
    die("An error occurred while trying to catch connection to the database...");
}

?>

<div class="container">
    <div class="row">

        <section class="discussions">
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
            <?php if (!$error) { ?>
                <div class="header-chat">
                    <p class="name">
                        <i class="icon fa fa-user-o" aria-hidden="true"></i> <strong>User</strong> <?php echo $name; ?>
                    </p>
                </div>
                <div class="messages-chat">
                    <?php echo $messageInput; ?>
                </div>
            <?php } else { ?>
                <div class="header-chat">
                    <p class="name"><?php echo $message; ?></p>
                </div>
            <?php } ?>
        </section>
    </div>
</div>
</body>
</html>