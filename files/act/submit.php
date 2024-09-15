<?php

require_once __DIR__."/../class/PDOC.php";

$dbc = new connect();

$title = htmlspecialchars($_POST['title'], ENT_QUOTES, "utf-8");
$result = [];

$sql = sprintf("
		SELECT `name`
		FROM `theater_infos`
		WHERE `name` LIKE '%%%s%%'",
		$title
	);


$result["title"] = $dbc->select($sql);
$result["notFound"] = "0";

if( empty($result["title"]) ){
	$result["notFound"] = "1";
}

echo json_encode($result);


?>