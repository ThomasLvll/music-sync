<?php

function random_code($str_length = 8, $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz") {
    $chars_str_length = strlen($chars);
    $code = "";
    for ($i = 0; $i < $str_length; $i++) $code .= $chars[rand(0, $chars_str_length - 1)];
    return $code;
}

function redirect($URL, $auto_exit = true) {
    header("Location: $URL");
    if ($auto_exit) exit();
}

function open_page($page_name, $params = null, $auto_exit = true) {
    if ($params) $_SESSION["page_params"] = $params;
    redirect("?page=$page_name", $auto_exit);
}

function open_action($action_name, $params = null, $auto_exit = true) {
    if ($params) $_SESSION["action_params"] = $params;
    redirect("?action=$action_name", $auto_exit);
}

function read($path) {
    return file_get_contents($path);
}

function alert($msg, $color = null, $timeout = null) {
    $_SESSION["alert"] = $msg;
    if ($color) $_SESSION["alert_color"] = $color;
    if ($timeout) $_SESSION["alert_timeout"] = $timeout;
}

function curl($URL, $method = "GET", $headers = [], $data = [], $options = []) {
    $curl_obj = curl_init($URL);
    curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_obj, CURLOPT_HTTPHEADER, $headers);
    if ($method === "POST") {
        curl_setopt($curl_obj, CURLOPT_POST, 1);
        curl_setopt($curl_obj, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt_array($curl_obj, $options);
    $res = curl_exec($curl_obj);
    curl_close($curl_obj);
    return $res;
}

session_start();
$conn = mysqli_connect(read("./res/.secret/db_host"),
    read("./res/.secret/db_user"),
    read("./res/.secret/db_password"),
    read("./res/.secret/db"),
    read("./res/.secret/db_port"));
$conn->query("SET CHARACTER SET utf-8");
require "./res/php/get-user-info.php";

$page_params = (isset($_SESSION["page_params"])) ? $_SESSION["page_params"] : [];
$action_params = (isset($_SESSION["action_params"])) ? $_SESSION["action_params"] : [];
$page = (isset($_GET["page"]) && mb_strlen($_GET["page"]) > 0) ? $_GET["page"] : "home";
if (! file_exists("./res/templates/$page.php")) $page = "404";
$action = (isset($_GET["action"]) && mb_strlen($_GET["action"]) > 0) ? $_GET["action"] : null;
if ($action && file_exists("./res/php/$action.php")) include "./res/php/$action.php";

?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Music Sync</title>
        
        <!-- external CSS goes below -->
        <link rel="stylesheet" type="text/css" href="res/css/common.css?v=<?= time() ?>" />
        <link rel="stylesheet" type="text/css" href="res/css/<?= $page ?>.css?v=<?= time() ?>" />
    </head>
    <body>
        <?php include_once "./res/templates/header.php"; ?>
        
        <div id="container"><?php include "./res/templates/$page.php"; ?></div>

        <?php include_once "./res/templates/footer.php"; ?>
        <!-- external JS goes below -->
        <script type="text/javascript" src="res/js/common.js?v=<?= time() ?>"></script>
        <script type="text/javascript" src="res/js/<?= $page ?>.js?v=<?= time() ?>"></script>
        <script type="text/javascript">
<?php
if (isset($_SESSION["alert"])) {
?>
setTimeout(function() {
    show_alert("<?= $_SESSION["alert"] ?>", <?=
        (isset($_SESSION["alert_color"])) ? ("'" . $_SESSION["alert_color"] . "'") : "undefined" ?>, <?=
        (isset($_SESSION["alert_timeout"])) ? ($_SESSION["alert_timeout"]) : "undefined" ?>);
}, 200);
<?php
    unset($_SESSION["alert"]);
    if (isset($_SESSION["alert_color"])) unset($_SESSION["alert_color"]);
    if (isset($_SESSION["alert_timeout"])) unset($_SESSION["alert_timeout"]);
}
?>
        </script>
    </body>
</html>
<?php

if (isset($_SESSION["page_params"])) unset($_SESSION["page_params"]);
if (isset($_SESSION["action_params"])) unset($_SESSION["action_params"]);

?>
