<?php

$required_values = [ "first-name", "last-name",
    "user-name", "email-address", "password" ];

$valid = true;
foreach ($required_values as $k)
    if (! isset($_GET[$k]) || mb_strlen($_GET[$k]) < 1)
        $valid = false;
if ($valid) {
    
}

?>
