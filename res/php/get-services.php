<?php

$services = array();
$sql = "SELECT
    `Services`.*
FROM
    `MusicSyncServices` AS `Services`
WHERE
    `Services`.`is_available` = '1'";
$res = $conn->query($sql);
if ($res)
    while ($row = $res->fetch_array())
        array_push($services, $row);

?>
