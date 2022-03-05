<?php
session_start();

// 変数
$nickname = '';
$mail = '';
$item = '';
$consult = '';

// 入力値を取得
if(isset($_SESSION['nickname'])){
    $nickname = $_SESSION['nickname'];
    unset($_SESSION['nickname']);
}
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];
    unset($_SESSION['mail']);
}
if(isset($_SESSION['item'])){
    $item = $_SESSION['item'];
    unset($_SESSION['item']);
}
if(isset($_SESSION['consult'])){
    $consult = $_SESSION['consult'];
    unset($_SESSION['consult']);
}

// データベース処理

// 接続
$db = new PDO('mysql:host=localhost;dbname=consultation','root','');

try{
    // トランザクション開始
    $db->beginTransaction();

    // SQL文実行
    $sql = 'INSERT INTO consult ( nickname, mail, item, consult ) VALUES( :nickname, :mail, :item, :consult );';

    // 事前にSQL登録
    $sth = $db->prepare($sql);

    // 変数名にパラメーターをバインド
    $sth->bindParam(':nickname', $nickname);
    $sth->bindParam(':mail', $mail);
    $sth->bindParam(':item', $item);
    $sth->bindParam(':consult', $consult);

    // 実行
    $sth->execute();

    // コミット
    $db->commit();

}catch(Exception $e){
    //ロールバック
    $db->rollback();

    header('location:error.html');
    exit;
}



// htmlファイルを読み込む
$html = file_get_contents("input_complete.html");

print($html);