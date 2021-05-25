<?php

$user = null;
if (isset($_SESSION["user_token"])) {
    $token = $_SESSION["user_token"];
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
