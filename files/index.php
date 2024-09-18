<?php


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>小劇場公演検索</title>
    <link rel="stylesheet" href="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#formTheater").on("submit", function(e){

                e.preventDefault();

                var title = $("#title").val();

                $.ajax({
                    url: "/act/submit.php",
                    type: "POST",
                    data: { title: title},
                    success: function(res){

                        if( $(".theaterTitle").length > 0 ){
                            $(".theaterTitle").remove();
                        }

                        var res = JSON.parse(res);

                        var data = res["data"];

                        if( res["notFound"] === "0" ){

                            for(var i = 0; i < data.length; i++){
                                var id = data[i]["id"],
                                    title = data[i]["name"];

                                $("#response").append("<li class='theaterTitle'>"+title+"<a href='detail.php?="+id+"' class='detailLink'>詳細</a></li>");
                            }

                        } else {
                            $("#response").append("<li class='theaterTitle notFound'>公演が見つかりませんでした。</li>");
                        }


                    },
                    error: function(xhr, status, error){
                        $("#response").text("エラー："+ error);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>小劇場公演検索サイト</h1>
    <div class="wrapper">
        <form id="formTheater">
            <label for="title">公演名:</label>
            <input type="text" id="title" name="title">
            <button type="submit">送信</button>
        </form>

        <p id="response"></p>
    </div>
    <div class="footer">
        <p>
            <a href="regiInfo.php">公演情報の登録</a>
        </p>
    </div>
</body>
</html>