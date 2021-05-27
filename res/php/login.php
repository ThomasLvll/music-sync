<?php

$required_values = [ "user-name-or-email", "password" ];

$valid = true;
foreach ($required_values as $k)
    if (! isset($_GET[$k]) || mb_strlen($_GET[$k]) < 1)
        $valid = false;
if ($valid) {
    $user_login = $conn->escape_string($_GET["user-name-or-email"]);
    $sql = "SELECT
        `Users`.*
    FROM
        `MusicSyncUsers` AS `Users`
    WHERE
        `Users`.`user_name` = '$user_login'
     OR `Users`.`email_address` = '$user_login'";
    $res = $conn->query($sql);
    if ($res) {
        $count = $res->num_rows;
        switch ($count) {
            case 0:
                alert("Nom d'utilisateur ou adresse e-mail incorrect", "var(--alert-error-color)");
                break;
            case 1:
                $row = $res->fetch_array();
                if (password_verify($_GET["password"], $row["password_hash"])) {
                    if ($row["is_active"]) {
                        open_action("create-user-token", [
                            "user_id" => $row["id"],
                            "user_password" => $_GET["password"],
                            "stay_logged" => $_GET["stay-logged"] ]);
                    } else {
                        open_action("confirm-email");
                    }
                } else {
                    alert("Mot de passe incorrect", "var(--alert-error-color)");
                }
                break;
            default:
                alert("Plusieurs utilisateurs correspondent aux identifiants renseignés", "var(--alert-error-color)");
        }
    } else {
        alert("La connexion au serveur a échoué", "var(--alert-error-color)");
    }
} else {
    alert("Informations manquantes pour la connexion", "var(--alert-error-color)");
}

open_page($page);

?>
