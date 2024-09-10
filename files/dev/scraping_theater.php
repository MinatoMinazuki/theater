<?php

ini_set('error_reporting', E_ERROR | E_PARSE);
ini_set("max_execution_time", "");

require_once "simple_html_dom.php";
require_once __DIR__."/../class/PDOC.php";

$dbc = new connect();


// Webページのスクレイピング
// $num = "1";
// for($i=1; $i<=15; $i++){

//     if( $i === 1 ){
//         $html = file_get_html("https://www.walkerplus.com/event_list/eg0111/");
//     } else {
//         $html = file_get_html("https://www.walkerplus.com/event_list/eg0111/".$i.".html");
//     }

//     $lis = $html->find("li.m-mainlist__item");

//     foreach( $lis as $k => $li ){
//         $url = $li->find("a")[0]->href;
//         if( !empty($url) ){
//             $htmlFile = file_get_contents("https://www.walkerplus.com/".$url."data.html");

//             $fp = fopen(__DIR__."/html/theater_url_".$num.".html", "w+");
//             fwrite($fp, $htmlFile);
//             fclose($fp);

//             $num++;
//         }
//     }

//     sleep(5);

// }

// $s = "SELECT * FROM `theater_infos` WHERE `date` = ''";
// $result = $dbc->select($s);
// $res=$result[0];

// // 落としたhtmlファイルからDBにインサート
// for($i=1; $i<=149; $i++){

//         $html = file_get_html("./html/theater_url_".$i.".html");
//         $name = trim($html->find(".m-detailheader-heading__ttl")[0]->plaintext);
//         $info = $html->find("table.m-infotable__table tr.m-infotable__row");
//         $date_sub = trim($info[2]->find(".m-infotable__td")[0]->find(".m-detailmain-table__subtxt")[0]->plaintext);

//         $sql = sprintf("
//             UPDATE `theater_infos`
//             SET `date_sub` = '%s'
//             WHERE `id` = '%s'",
//             $date_sub,
//             $i);

        // var_dump($sql);

        // $dbc->Dsql($sql);
    // if( $i === $result[$i]["id"] && $result[$i]["id"] !== NULL ){
    // } else {
    // }
    // $html = file_get_html("./html/theater_url_".$i.".html");

    // $name = trim($html->find(".m-detailheader-heading__ttl")[0]->plaintext);
    // $area = trim($html->find(".m-detailheader-heading__link")[0]->plaintext);
    // $prefecture = trim($html->find(".m-detailheader-heading__link")[1]->plaintext);
    // $url = trim($html->find(".p-btn--common__btn")[0]->href);

    // $info = $html->find("table.m-infotable__table tr.m-infotable__row");

    // $place = trim($info[0]->find(".m-infotable__td")[0]->plaintext);
    // $date = trim($info[2]->find(".m-infotable__td")[0]->find(".m-detailmain-table__txtred")[0]->plaintext);
    // $date_sub = trim($info[2]->find(".m-infotable__td")[0]->find(".m-detailmain-table__subtxt")[0]->plaintext);
    // $time = trim($info[3]->find(".m-infotable__td")[0]->plaintext);
    // $tel = trim($info[4]->find(".m-infotable__td a")[0]->href);
    // $tel_address = trim($info[4]->find(".m-infotable__td span")[0]->plaintext);
    // $address = trim($info[5]->find(".m-infotable__td")[0]->plaintext);
    // $access = trim($info[6]->find(".m-infotable__td")[0]->plaintext);
    // $parking = trim(t($info[7]->find(".m-infotable__td")[0]->plaintext));

    // $sql = sprintf("
    //     INSERT INTO `theater_infos`
    //     (`name`,
    //      `area`,
    //      `perfecture`,
    //      `place`,
    //      `date`,
    //      `start_time`,
    //      `date_sub`,
    //      `tel`,
    //      `tel_address`,
    //      `address`,
    //      `access`,
    //      `parking`,
    //      `url`)
    //     VALUES
    //     ('%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s',
    //      '%s')",
    //     $name,
    //     $area,
    //     $prefecture,
    //     $place,
    //     $date,
    //     $date_sub,
    //     $time,
    //     $tel,
    //     $tel_address,
    //     $address,
    //     $access,
    //     $parking,
    //     $url);

    // $dbc->Dsql($sql);

}

function t( $text ){
    $trimed = str_replace("&nbsp;", "", $text);
    return $trimed;
}

?>