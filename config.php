<!-- PHP設定ファイル。エラーを出すおまじない、DBの接続情報 -->

<?php
define('DSN', 'mysql:dbname=php_lesson;host=localhost;unix_socket=/tmp/mysql.sock');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Ryuryu1835');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
set_error_handler('errorHandler');
function errorHandler($errNo, $errStr, $errFile, $errLine)
{
    if ($errNo === E_NOTICE || $errNo === E_WARNING) {
        $errTitle = $errNo === E_NOTICE ? 'Notice' : 'Warning';
        $escapedErrStr = htmlspecialchars($errStr);
        $escapedErrFile = htmlspecialchars($errFile);

        echo '<b>' . $errTitle . '</b>: ' . $escapedErrStr . ' in <b>' . $escapedErrFile . '</b> on line <b>' . $errLine . '</b>';
        exit;
    }

    return false;
}


// mysql -u root -p
// php -S localhost:9999
// localhost:9999/index.php
// cd OneDrive\デスクトップ\test_app

//Section12復習問題
//Q1：そのファイル内で呼び出したいファイルの指定
//Q2：返り値：PDOインスタンス。connectPdo()でDBで作成したphp_lessonの情報を引き出している
//Q3：例外処理。try{}で例外とする条件とそれに対する出力を示しておき、条件と合致した場合catch{}で実行する
//Q4：PDOExceptionというPDOのエラーを出力するクラスを使用しているから


//Section12復習問題
//Q1：1
//Q2：2
//Q3：3
//Q4：123
//Q5：リダイレクト先をindex.htmlに指定し、そこまでの処理が完了した際にindex.htmlに記載している内容に戻るようにしている


//Section13復習問題
//Q1：2
//Q2：2
//Q3：4
//Q4：4
//Q5：todosテーブルから取得した、削除されていないレコードを全件

//Section15復習問題
//Q1：2
//Q2：2
//Q3：3
//Q4：todo_id = 123, todo_content = 焼肉
//Q5：getRefererPath()から受け取ったURLによって$postを引数に使用する関数を分けている。
//    新規作成のURLの場合$post(キー['content'])内の文字列をcreateTodoData()の引数として使用される
//    更新のURLの場合$post内の文字列をupdateTodoData()の引数として使用される
//Q6 サーバー情報および実行時の環境情報（$_SERVER）を$urlArrayに格納し、返り値として出している。

//Section16復習問題
//Q1：1
//Q2：todosテーブルの情報を表示させる条件に、deleted_atに時間が入っているレコードは表示しないという条件をいれているから
//Q3：論理削除
//Q4：物理削除
//Q5：論理削除：表示上から消えている扱いになるため、ステータスを変更し、再表示させることも可能だが、情報が増える為、他の命令を行う際に条件複雑になったり、コードが長くなる可能性がある。
    //物理削除：DB上からも削除されるのでテーブルがきれいになったりデータ容量が多くならない事がメリットだが、データを復活させることができない
    
