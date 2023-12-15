<?php
function checkConnection(): bool {
    require 'mysql.php';
    try {
    $statement = $mysql->prepare("/* ping */ SELECT 1");
    $statement->execute();
    $result = $statement->fetch();
    if($result !== false) {
        return true;
    }
    return false;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function getContent($code) {
    require 'mysql.php';
    try {
        $statement = $mysql->prepare("SELECT * FROM `player_chatreview` WHERE `CODE` = :code");
        $statement->bindParam(":code", $code);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        //print_r($result);
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }
}

