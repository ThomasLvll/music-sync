<?php

function is_token_available($token) {
    global $conn;
    $sql = "SELECT COUNT(*) FROM `MusicSyncUserTokens` WHERE `MusicSyncUserTokens`.`token` = '$token'";
    $res = $conn->query($sql);
    return ($res && $res->fetch_array()[0] == 0);
}

function new_token() {
    return random_code(512);
}

$required_values = [ "user_id", "user_password" ];

$valid = true;
foreach ($required_values as $k)
    if (! isset($action_params[$k]) || mb_strlen($action_params[$k]) < 1)
        $valid = false;
if ($valid) {
    $token = null;
    $max_tries = 3;
    $is_token_valid = false;
    $i = 0;
    while (! $is_token_valid && $i <= $max_tries) {
        $token = new_token();
        if (is_token_available($token)) $is_token_valid = true;
        $i ++;
    }
    if ($is_token_valid) {
        $user_id = $conn->escape_string($action_params["user_id"]);
        $user_password = $action_params["user_password"];
        $check_sql = "SELECT
            `Users`.`first_name`,
            `Users`.`password_hash`
        FROM
            `MusicSyncUsers` As `Users`
        WHERE
            `Users`.`id` = '$user_id'";
        $check_res = $conn->query($check_sql);
        if ($check_res) {
            $check_row = $check_res->fetch_array();
            if (password_verify($user_password, $check_row["password_hash"])) {
                $token = $conn->escape_string($token);
                $conn->query("DELETE FROM
                    `MusicSyncUserTokens`
                WHERE
                    `MusicSyncUserTokens`.`user_id` = '$user_id'");
                
                $sql = "INSERT INTO
                    `MusicSyncUserTokens`
                    (`user_id`, `token`)
                VALUES
                    ('$user_id', '$token')";
                $res = $conn->query($sql);
                if ($res) {
                    if (isset($action_params["stay_logged"]) && $action_params["stay_logged"])
                        $is_cookie_set = setcookie("user_token", $token, time() + 10 * 365.25 * 24 * 60 * 60, $httponly = true);
                    $_SESSION["user_token"] = $token;
                    alert("Bienvenue, " . $check_row["first_name"] . " !", "var(--alert-success-color)", 5);
                } else {
                    alert("La cr??ation du jeton personnel a ??chou??", "var(--alert-error-color)");
                }
            } else {
                alert("Mot de passe incorrect", "var(--alert-error-color)");
            }
        } else {
            alert("La connexion au serveur a ??chou??", "var((--alert-error-color)");
        }
    } else {
        alert("Erreur lors de la cr??ation du jeton personnel", "var(--alert-error-color)");
    }
} else {
    alert("Informations manquantes pour la cr??ation du jeton personnel", "var(--alert-error-color)");
}

open_page($page);

?>
