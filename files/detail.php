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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $item["name"] ?>の詳細ページ</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1><?= $item["name"] ?></h1>
    <div>
        <table>
            <tr>
                <th>公演名</th>
                <th>開催県</th>
                <th>開催地</th>
                <th>開催日</th>
                <th>公演名</th>
                <th>公演名</th>
                <th>公演名</th>
                <th>公演名</th>
            </tr>
        </table>
    </div>
</body>
</html>