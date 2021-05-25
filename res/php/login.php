<?php

$required_values = [ "user-name-or-email", "password" ];

$valid = true;
foreach ($required_values as $k)
    if (! isset($_GET[$k]) || mb_strlen($_GET[$k]) < 1)
        $valid = false;
if ($valid) {
    alert("Bienvenue, quelqu'un !", "hsl(var(--primary-900))", 3);
} else {
    alert("Connexion échouée", "var(--error-color)");
}

?>
