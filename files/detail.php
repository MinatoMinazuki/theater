<?php

require_once __DIR__."/class/PDOC.php";
require_once __DIR__."/class/functions.php";

$dbc = new connect();

$id = h($_GET['id']);

$sql = sprintf("
        SELECT *
        FROM `theater_infos`
        WHERE `id` = '%s'",
        $id
    );

$result = $dbc->select($sql);

$item = $result[0];

?>