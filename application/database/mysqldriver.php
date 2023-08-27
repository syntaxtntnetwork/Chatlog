<?php
function checkConnection(): bool {
    require './mysql.php';
    $result = $mysql->query("/* ping */ SELECT 1");
    if ($result->num_rows > 0) {
        return true;
    }
    return false;
}

?>