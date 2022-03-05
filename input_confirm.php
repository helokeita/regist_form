<?php
session_start();

// 変数
$nickname = $_GET['nickname'];
$mail = $_GET['mail'];
$item = $_GET['item'];
$value = '';
$consult = $_GET['consult'];

// 取得した値をセッションに登録
$_SESSION['nickname'] =$nickname;
$_SESSION['mail'] =$mail;
$_SESSION['item'] =$item;
$_SESSION['consult'] =$consult;

// 入力値エラー
if(empty($nickname) || empty($mail) ||empty($consult)){
    header('location:input.php');
    exit;
}


// ご相談項目の表示用値変換
if($item == '1'){
    $value = "学校や職場環境に関して";
}elseif($item == '2'){
    $value = "家族に関して";
}elseif($item == '3'){
    $value = "生きることに関して";
}elseif($item == '4'){
    $value = "その他";
}

// htmlファイルを読み込む
$html = file_get_contents("input_confirm.html");

// 入力値を代入する
$html = str_replace("#nickname#",htmlspecialchars($nickname),$html);
$html = str_replace("#mail#",htmlspecialchars($mail),$html);
$html = str_replace("#item#",htmlspecialchars($value),$html);
$html = str_replace("#consult#",htmlspecialchars($consult),$html);

print($html);
