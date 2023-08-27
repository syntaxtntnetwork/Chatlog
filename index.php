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
$name = 'TntTastisch';
$server = 'Test-1';
$imageUrl = "https://cravatar.eu/avatar/{$name}/128.png";
?>
<div class="container">
    <div class="row">

        <section class="discussions">
            <div class="photo" style="background-image:url(https://cdni.syntaxtnt.de/images/9nbP138OZq4m7052NUBHMIL6pdJSWEkI.png);"></div>
            <div class="discussion search">
                <div class="searchbar">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <form method="post" action="">
                        <input type="text" placeholder="Search..." />
                    </form>
                </div>
            </div>

            <div class="discussion message">
                <div class="desc-contact">
                    <a style="font-size:18px;" class="name" href="http://syntaxtnt.de/"><p>Start</p></a>
                </div>
            </div>
        </section>
        <section class="chat">
            <?php if(isset($_SESSION['code'])) { ?>
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
                <p class="name">Es wurde kein Code eingeben...</p><?php
            } ?>
        </section>
    </div>
</div>
</body>
</html>