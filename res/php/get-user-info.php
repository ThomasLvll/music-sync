<?php

$user = null;
$token = (isset($_COOKIE["user_token"])) ? $_COOKIE["user_token"] : ((isset($_SESSION["user_token"])) ? $_SESSION["user_token"] : null);

if ($token) {
    $sql = "SELECT
        `Users`.*
    FROM
        `MusicSyncUserTokens` AS `Tokens`
    JOIN
        `MusicSyncUsers` AS `Users`
    ON
        `Tokens`.`user_id` = `Users`.`id`
    WHERE
        `Tokens`.`token` = '$token'";
    unset($token);

    $res = $conn->query($sql);
    if ($res) {
        $user = $res->fetch_array();
    }
}

?>
