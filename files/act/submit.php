<?php

require_once __DIR__."/../class/PDOC.php";

$dbc = new connect();

$result = [];
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, "utf-8");

$sql = sprintf("
        SELECT `id`,
               `name`
        FROM `theater_infos`
        WHERE `name` LIKE '%%%s%%'",
        $title
    );


$selResult = $dbc->select($sql);

$result["data"] = $selResult;
$result["notFound"] = "0";

if( empty($result["data"]) ){
    $result["notFound"] = "1";
}

echo json_encode($result);


?>