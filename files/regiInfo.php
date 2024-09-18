<?php

require_once __DIR__."/class/PDOC.php";
require_once __DIR__."/class/functions.php";

$imgPath = __DIR__."/img/ad/";

$dbc = new connect();

$stage = "0";

if( !empty($_POST) ){

    $stage = h($_POST['stage']);

    $name = h($_POST['name']);
    $prefecture = h($_POST['prefecture']);
    $place = h($_POST['place']);
    $date = h($_POST['date']);
    $date_sub = h($_POST['date_sub']);
    $start_time = h($_POST['start_time']);
    $tel = h($_POST['tel']);
    $tel_address = h($_POST['tel_address']);
    $address = h($_POST['address']);
    $access = h($_POST['access']);
    $parking = h($_POST['parking']);
    $url = h($_POST['url']);

}


if( $stage === "1" ){

    if( empty($name)
        || empty($place)
        || empty($date)
        || empty($tel)
        || empty($address) ){

        $message["error"] = "登録内容に不備があります。最初からやり直してください。";

    } else {

        $name_hide = empty($name) ? "hide" : "";
        $prefecture_hide = empty($prefecture) ? "hide" : "";
        $place_hide = empty($place) ? "hide" : "";
        $date_hide = empty($date) ? "hide" : "";
        $date_sub_hide = empty($date_sub) ? "hide" : "";
        $start_time_hide = empty($start_time) ? "hide" : "";
        $tel_hide = empty($tel) ? "hide" : "";
        $tel_address_hide = empty($tel_address) ? "hide" : "";
        $address_hide = empty($address) ? "hide" : "";
        $access_hide = empty($access) ? "hide" : "";
        $parking_hide = empty($parking) ? "hide" : "";
        $url_hide = empty($url) ? "hide" : "";

        $fileType = "";
        $img = "";
        $fileType_2 = "";
        $img_2 = "";

        if( !empty($_FILES['image']['name']) ){
            $fileType = $_FILES['image']['type'];
            $img = imageSample($_FILES['image']);
        }

        if( !empty($_FILES['image_2']['name']) ){
            $fileType_2 = $_FILES['image_2']['type'];
            $img_2 = imageSample($_FILES['image_2']);
        }
    }

} elseif( $stage === "2" ){

    $fileName = "";
    $fileName_2 = "";

    $area = areaPrefecture( $prefecture );

    if( !empty($_POST['image']) ){
        $data = base64Decode( $_POST['image'] );

        $fileName = randomString().".".$data["type"];
        file_put_contents($imgPath.$fileName, $data["data"]);
    }

    if( !empty($_POST['image_2']) ){
        $data_2 = base64Decode( $_POST['image_2'] );

        $fileName_2 = randomString().".".$data["type"];
        file_put_contents($imgPath.$fileName_2, $data_2["data"]);
    }

    $sql = sprintf("
         INSERT INTO `theater_infos`
            ( `name`,
              `area`,
              `perfecture`,
              `place`,
              `date`,
              `date_sub`,
              `start_time`,
              `tel`,
              `tel_address`,
              `address`,
              `access`,
              `parking`,
              `url`,
              `img`,
              `img_2` )
         VALUES
            ( '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s',
              '%s')",
            $name,
            $area,
            $prefecture,
            $place,
            $date,
            $date_sub,
            $start_time,
            $tel,
            $tel_address,
            $address,
            $access,
            $parking,
            $url,
            $fileName,
            $fileName_2 );

    $res = $dbc->Dsql($sql);

    if( $res ){
        $message["comp"] = "公演情報の登録ができました。";
    } else {
        $message["error"] = "公演情報の登録に失敗しました。最初からやり直してください。";
    }

}

function imageSample($data){

    $imageData = file_get_contents($data['tmp_name']);
    $base64Image = base64_encode($imageData);

    return $base64Image;
}

function base64Decode($value){

        $result = [];

        // Base64データを解析して、ヘッダー部分と画像データ部分を分離
        $parts = explode(';', $value);
        $mimeType = $parts[0];

        if (preg_match('/^data:image\/([a-zA-Z]*)/', $mimeType, $matches)) {
            $extension = $matches[1];  // 取得された拡張子
        }

        $data = explode(',', $parts[1])[1];

        // Base64データをデコードして画像に変換
        $decodedData = base64_decode($data);

        $result["data"] = $decodedData;
        $result["type"] = $extension;

        return $result;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>公演情報登録</title>
    <style type="text/css">
        p:has(.hide){
            display: none;
        }
    </style>
</head>
<body>
    <h1>公演情報の登録</h1>
    <div class="wrapper">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="formTheaterInfo">
            <?php if( !empty($message["error"]) ) : ?>
            <div class="message">
                <p class="error">
                    <?= $message["error"]; ?>
                </p>
                <a href="<?= $_SERVER['PHP_SELF']; ?>">戻る</a>
            <?php elseif( !empty($message["comp"]) ) : ?>
                <p class="comp">
                    <?= $message["comp"]; ?>
                </p>
                <a href="index.php">戻る</a>
            </div>
            <?php elseif( $stage === "0" ) : ?>
            <div class="inputInfo">
                <p class="theaterInfo theaterName">
                    <input type="text" name="name" value="" placeholder="公演名">
                </p>
                <p class="theaterInfo theaterPrefecture">
                    <input type="text" name="prefecture" value="" placeholder="開催県">
                </p>
                <p class="theaterInfo theaterPlace">
                    <input type="text" name="place" value="" placeholder="場所・施設名">
                </p>
                <p class="theaterInfo theaterDate">
                    <input type="date" name="date" value="" placeholder="開催日">
                </p>
                <p class="theaterInfo theaterDateSub">
                    <textarea name="date_sub" value="" placeholder="開催日時の注意書き"></textarea>
                </p>
                <p class="theaterInfo theaterStartTime">
                    <input type="text" name="start_time" value="" placeholder="開演時間">
                </p>
                <p class="theaterInfo theaterTel">
                    <input type="tel" name="tel" value="" placeholder="電話番号">
                </p>
                <p class="theaterInfo thaterTelAddress">
                    <input type="text" name="tel_address" value="" placeholder="登録電話番号の宛先">
                </p>
                <p class="theaterInfo theaterAddress">
                    <input type="text" name="address" value="" placeholder="開催地住所">
                </p>
                <p class="theaterInfo theaterAccess">
                    <input type="text" name="access" value="" placeholder="アクセス">
                </p>
                <p class="theaterInfo theaterParking">
                    <textarea name="parking" value="" placeholder="駐車場について"></textarea>
                </p>
                <p class="theaterInfo theaterUrl">
                    <input type="url" name="url" value="" placeholder="URL">
                </p>
                <p class="theaterInfo theaterImage">
                    <input type="file" name="image" value="">
                </p>
                <p class="theaterInfo theaterImage_2">
                    <input type="file" name="image_2" value="">
                </p>
                <button class="submitBtn checkBtn" type="submit">確認</button>
                <input type="hidden" name="stage" value="1">
            </div>
            <?php elseif( $stage === "1" ): ?>
            <div class="cheachInfo">
                <p class="theaterInfo theaterName">
                    <span class="name <?= $name_hide ?>"><?= $name ?></span>
                    <input type="hidden" name="name" value="<?= $name ?>" placeholder="公演名">
                </p>
                <p class="theaterInfo theaterPrefecture">
                    <span class="prefecture <?= $prefecture_hide ?>"><?= $prefecture ?></span>
                    <input type="hidden" name="prefecture" value="<?= $prefecture ?>" placeholder="開催県">
                </p>
                <p class="theaterInfo theaterPlace">
                    <span class="place <?= $place_hide ?>"><?= $place ?></span>
                    <input type="hidden" name="place" value="<?= $place ?>" placeholder="開催地">
                </p>
                <p class="theaterInfo theaterDate">
                    <span class="date <?= $date_hide ?>"><?= $date ?></span>
                    <input type="hidden" name="date" value="<?= $date ?>" placeholder="開催日">
                </p>
                <p class="theaterInfo theaterDateSub">
                    <span class="date_sub <?= $date_sub_hide ?>"><?= $date_sub ?></span>
                    <input type="hidden" name="date_sub" value="<?= $date_sub ?>" placeholder="開催日時の注意書き">
                </p>
                <p class="theaterInfo theaterStartTime">
                    <span class="start_time <?= $start_time_hide ?>"><?= $start_time ?></span>
                    <input type="hidden" name="start_time" value="<?= $start_time ?>" placeholder="開演時間">
                </p>
                <p class="theaterInfo theaterTel">
                    <span class="tel <?= $tel_hide ?>"><?= $tel ?></span>
                    <input type="hidden" name="tel" value="<?= $tel ?>" placeholder="電話番号">
                </p>
                <p class="theaterInfo thaterTelAddress">
                    <span class="tel_address <?= $tel_address_hide ?>"><?= $tel_address ?></span>
                    <input type="hidden" name="tel_address" value="<?= $tel_address ?>" placeholder="登録電話番号の宛先">
                </p>
                <p class="theaterInfo theaterAddress">
                    <span class="address <?= $address_hide ?>"><?= $address ?></span>
                    <input type="hidden" name="address" value="<?= $address ?>" placeholder="開催地住所">
                </p>
                <p class="theaterInfo theaterAccess">
                    <span class="access <?= $access_hide ?>"><?= $access ?></span>
                    <input type="hidden" name="access" value="<?= $access ?>" placeholder="アクセス">
                </p>
                <p class="theaterInfo theaterParking">
                    <span class="parking <?= $parking_hide ?>"><?= $parking ?></span>
                    <input type="hidden" name="parking" value="<?= $parking ?>" placeholder="駐車場について">
                </p>
                <p class="theaterInfo theaterUrl">
                    <span class="url <?= $url_hide ?>"><?= $url ?></span>
                    <input type="hidden" name="url" value="" placeholder="URL">
                </p>
                <?php if(!empty($img)) : ?>
                <div class="theaterInfo theaterImage">
                    <img src="data:<?= $fileType; ?>;base64,<?= $img; ?>" alt="１枚目の画像です。" style="width: 300px;">
                    <input type="hidden" name="image" value="data:<?= $fileType; ?>;base64,<?= $img; ?>">
                </div>
                <?php endif; ?>
                <?php if(!empty($img_2)) : ?>
                <div class="theaterInfo theaterImage_2">
                    <img src="data:<?= $fileType_2; ?>;base64,<?= $img_2; ?>" alt="２枚目の画像です。" style="width: 300px;">
                    <input type="hidden" name="image_2" value="data:<?= $fileType_2; ?>;base64,<?= $img_2; ?>">
                </div>
                <?php endif; ?>
                <input type="hidden" name="stage" value="2">
                <button class="submitBtn regiBtn" type="submit">登録する</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){

            $("#formTheaterInfo").submit(function(e){

                var emptyValue = [];

                var name = $(".theaterName").find("input").val(),
                    place = $(".theaterPlace").find("input").val(),
                    eventDate = $(".theaterDate").find("input").val(),
                    tel = $(".theaterTel").find("input").val(),
                    address = $(".theaterAddress").find("input").val();

                if( name === "" ){
                    emptyValue.push("公演名");
                }

                if( place === "" ){
                    emptyValue.push("開催場所");
                }

                if( eventDate === "" ){
                    emptyValue.push("開催日時");
                }

                if( tel === "" ){
                    emptyValue.push("電話番号");
                }

                if( address === "" ){
                    emptyValue.push("開催地の住所");
                }

                if( emptyValue.length > 0 ){

                    var emptyString = emptyValue.join(",");
                    alert("入力内容に不備があります。次の項目を入力してください。"+ emptyString);
                    return false;

                } else {

                    $(this).submit();

                }

            });

        });
    </script>
</body>
</html>