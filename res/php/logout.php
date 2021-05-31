<?php

if (isset($_SESSION["user_token"])) {
    $conn->query("DELETE FROM
        `MusicSyncUserTokens`
    WHERE
        `MusicSyncUserTokens`.`token` = '" . $_SESSION["user_token"] . "'");
    unset($_SESSION["user_token"]);
}
open_page($page);

?>
