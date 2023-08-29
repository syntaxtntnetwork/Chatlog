<?php
function checkConnection(): bool {
    require 'application/database/mysql.php';
    $statement = $mysql->prepare("/* ping */ SELECT 1");
    $statement->execute();
    $result = $statement->fetch();
    if($result !== false) {
        return true;
    }
    return false;
}