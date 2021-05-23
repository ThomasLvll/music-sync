<?php

function redirect($URL) {
    header("Location: $URL");
    exit();
}

function open_page($page_name) {
    redirect("?page=$page_name");
}

function open_action($action_name) {
    redirect("?action=$action_name");
}

function read($path) {
    return file_get_contents($path);
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
$user = [
    "is_logged_in" => false,
    "first_name" => "Thomas",
    "last_name" => "Léveillé"
];
$page = (isset($_GET["page"]) && mb_strlen($_GET["page"]) > 0) ? $_GET["page"] : "home";
if (! file_exists("./res/templates/$page.php")) $page = "404";
$action = (isset($_GET["action"]) && mb_strlen($_GET["action"]) > 0) ? $_GET["action"] : null;
if ($action) include "./res/php/$action.php";

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
if (isset($_SESSION["error_msg"])) {
?>
setTimeout(function() {
    show_alert("<?= $_SESSION["error_msg"] ?>");
}, 200);
<?php
    unset($_SESSION["error_msg"]);
}
?>
        </script>
    </body>
</html>
