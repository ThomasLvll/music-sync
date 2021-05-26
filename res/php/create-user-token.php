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
        $check_sql = "SELECT `MusicSyncUsers`.`first_name`, `MusicSyncUsers`.`password_hash` FROM `MusicSyncUsers` WHERE `MusicSyncUsers`.`id` = '$user_id'";
        $check_res = $conn->query($check_sql);
        if ($check_res) {
            $check_row = $check_res->fetch_array();
            if (password_verify($user_password, $check_row["password_hash"])) {
                $token = $conn->escape_string($token);
                $sql = "INSERT INTO `MusicSyncUserTokens` (`user_id`, `token`) VALUES ('$user_id', '$token')";
                $res = $conn->query($sql);
                if ($res) {
                    $_SESSION["user_token"] = $token;
                    alert("Bienvenue, " . $check_row["first_name"] . " !", "var(--alert-success-color)");
                } else {
                    alert("La création du jeton personnel a échoué", "var(--alert-error-color)");
                }
            } else {
                alert("Mot de passe incorrect", "var(--alert-error-color)");
            }
        } else {
            alert("La connexion au serveur a échoué", "var((--alert-error-color)");
        }
    } else {
        alert("Erreur lors de la création du jeton personnel", "var(--alert-error-color)");
    }
} else {
    alert("Informations manquantes pour la création du jeton personnel", "var(--alert-error-color)");
}

open_page($page);

?>
