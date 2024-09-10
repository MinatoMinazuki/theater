<?php

require_once __DIR__."/../class/PDOC.php";

$dbc = new connect();

$title = htmlspecialchars($_POST['title'], ENT_QUOTES, "utf-8");

$sql = sprintf("
		SELECT `name`
		FROM `theater_infos`
		WHERE `name` LIKE '%%%s%%'",
		$title
	);


$result = $dbc->select($sql);

// var_dump($result[0]);

echo json_encode($result);


?>