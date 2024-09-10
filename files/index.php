<?php


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>小劇場公演まとめ</title>
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

                        var title = JSON.parse(res);

                        for(var i = 0; i < title.length; i++){
                            console.log(title[i]["name"]);
                            $("#response").append(title[i]["name"]+"<br>");
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
    <h1>小劇場公演まとめサイト</h1>
    <div class="wrapper">
        <form id="formTheater">
            <label for="title">公演名:</label>
            <input type="text" id="title" name="title">
            <button type="submit">送信</button>
        </form>

        <p id="response"></p>
    </div>
</body>
</html>