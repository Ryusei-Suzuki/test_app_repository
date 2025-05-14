<!-- 新規作成画面や更新画面で入力した値を記録するファイル。記録した後は初期画面に戻るようになっている -->

<?php
require_once('functions.php');

savePostedData($_POST);
// var_dump($_POST);
// exit;
header('Location: ./index.php');