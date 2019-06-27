<?php
session_start();

//1.外部ファイル読み込み＆DB接続
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sessChk();

//２．データ登録SQL作成
$pdo = db_con();
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE name LIKE :s");
$stmt ->bindValue(":s", '%'.$s.'%', PDO::PARAM_STR);
$status = $stmt->execute();



//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    $view .= '<table border=1>';
    $view .= '<tbody>';
    $view .= '<tr>';
    $view .= '<td>';
    $view .= '名前';
    $view .= '</td>';
    $view .= '<td>';
    $view .= 'ID';
    $view .= '</td>';
    $view .= '<td>';
    $view .= '住所';
    $view .= '</td>';
    $view .= '<td>';
    $view .= 'Eメール';
    $view .= '</td>';
    $view .= '<td>';
    $view .= '削除ボタン';
    $view .= '</td>';
    $view .= '</tr>';
   

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view .= '<tr>';
        $view .='<td>';
        $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        $view .= $result["name"];
        $view .= '</a>';
        $view .='</td>';
        $view .='<td>';
        $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        $view .= $result["lid"];
        $view .= '</a>';
        $view .='</td>';
        $view .='<td>';
        $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        $view .= $result["adress"];
        $view .= '</a>';
        $view .='</td>';
        $view .='<td>';
        $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        $view .= $result["email"];
        $view .= '</a>';
        $view .='</td>';
        $view .='<td>';
        $view .= '<a href="user_delete.php?id='.$result["id"].'">';
        $view .= '[ 削除 ]';
        $view .='</td>';
        $view .= '</a>';
        $view .= '</tr>';
        // $view .= '<br>';
        
        // $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        // $view .= $result["name"] . "," . $result["lid"]. "," . $result["adress"]. "," .$result["email"];
        // $view .= '</a>';
        // $view .= '　';
        // $view .= '<a href="user_delete.php?id='.$result["id"].'">';
        // $view .= '[ 削除 ]';
        // $view .= '</a>';
        // $view .= '</tr>';
        // $view .= '<br>';
    }

    $view .= '</tbody>';
    $view .= '</table>';
    

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>USER表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <h1>ユーザー一覧</h1>
    <input type="text" id="s" name="s" value="">
    <button id="btn" type="submit">検索</button>
    <div class="container jumbotron"><?php echo $view; ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
