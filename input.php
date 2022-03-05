<?php
session_start();

// 変数
$nickname = '';
$mail = '';
$item = '';
$consult = '';

$set = '';
$value = 'selected';

$error_message = '';


if (isset($_SESSION['nickname'])){
    
    // エラー判定
    if(empty($_SESSION['nickname']) || empty($_SESSION['mail']) ||  empty($_SESSION['consult'])){
        $error_message = "入力されていない項目があります";
    }

    // セッションから値を取得
    $nickname = $_SESSION['nickname'];
    $mail = $_SESSION['mail'];
    $consult = $_SESSION['consult'];

    // 利用したセッションを削除
    unset($_SESSION['nickname']);
    unset($_SESSION['mail']);
    unset($_SESSION['consult']);


    //セレクトの戻った時の値保持処理
    if ($_SESSION['item'] == '1'){
        $set = "#a";
    }elseif($_SESSION['item'] == '2'){
        $set = "#b";
    }elseif($_SESSION['item'] == '3'){
        $set = "#c";
    }elseif($_SESSION['item'] == '4'){
        $set = "#d";
    }

    $item = $_SESSION['item'];

    unset($_SESSION['item']);
}
// htmlファイルを読み込む
$html = file_get_contents("input.html");

// 入力値を代入する
$html = str_replace("#error_message#",htmlspecialchars($error_message),$html);
$html = str_replace("#nickname#",htmlspecialchars($nickname),$html);
$html = str_replace("#mail#",htmlspecialchars($mail),$html);
$html = str_replace($set,htmlspecialchars($value),$html);
$html = str_replace("#consult#",htmlspecialchars($consult),$html);

print($html);
