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
// cd OneDrive\デスクトップ\BW\BW-practice\test_app_repository

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

//Section18復習問題
//Q1：ユーザーのアクセス時に表示内容が生成される「動的Webページ」の脆弱性、もしくはその脆弱性を利用した攻撃方法。cookie情報を盗む事ができる
//Q2：htmlspecialchars()を好きな箇所で宣言しやすくなる
//Q3：スクリプト言語等で文字列を扱う際に、その言語にとって特殊な意味を持つ文字や記号を、別の文字列に置き換えることでスクリプトタグがただの文字列として扱われるようになるため。

//Section19復習問題
//Q1：不特定多数の人に対して意図しないリクエスト送信をさせる攻撃。掲示板サイトに脅迫文を投稿をさせることができたり、身に覚えのない買い物をさせることも出来る。
//Q2：Session = データを一時的に保存する"サーバ側"の領域のこと Cookie = データを一時的に保存する"ブラウザ側"の領域のこと
//Q3：openssl_~関数でランダムな16文字を生成し、bin2hex関数でその文字を16進数に変換し、その結果を$_SESSION['token']に格納している
//Q4：不正なアクセスかどうかの判別を行っている。$_SESSIONが空orトークンが生成したものと一致しない場合、エラー文を格納させる
//Q5：サーバとブラウザ間で合言葉を用いりながらやり取りする事で偽サイトからの送信かを見分け、はじく事ができる

//Section20復習問題
//Q1：攻撃側がアプリケーションのセキュリティ上の不備を意図的に利用し、アプリケーションが想定しないSQL文を実行させることで、データベースシステムを不正に操作する攻撃方法
    //DBに格納されているデータが漏洩させたり、勝手に削除したりできる
//Q2：返り値は$sql。DBへの命令文を実行する準備をしている
//Q3：対象となる文字列に保存したい値と保存したい値のデータ型を指定する事でSQL文が入った場合等の判別を行うことができる
//Q4：DBのコードでユーザーが入力した内容が入る箇所の型を指定する事で、悪意のあるコードが打ち込まれてもそれが実行される事がなくなる

//Section20復習問題
//Q1：入力された値が、制限通りの内容になっているかどうかを確認する処理
//Q2：POSTされた情報のキーがcontentになっているバリューの内容がNULL以外かつ空白だった場合、$_SESSION['err'] に'入力がありません'という文字列を代入する
//Q3：POSTされた情報についての判別を行う必要があるから。
//   validate()はstore.phpに遷移する前のページがどこだったかによってDBへの処理を変更するsavePostedData()の中に入れているためまず$_POSTの中にキーがcontentの連想配列が宣言されているかを確認する必要がある
//   もし宣言されていなかった場合、削除処理を行う際、$_POSTにはキーがidの連想配列が宣言されているので、キーcontentが空白かの確認を行う際に警告文が表示される
//Q4：unsetError()では、ホーム画面や新規作成画面に遷移した際、$_SESSION['err']の情報を空白にする処理をしているので、
//    実行しなかった場合、もしエラー文が表示された場合、ホーム画面や新規作成画面にそのエラー文が表示されるようになってしまう。


// セッション（SESSION）はデータを一時的に保存するサーバ側の領域のことです。
// クッキー（COOKIE）は、データを一時的に保存するブラウザ側の領域のことです。