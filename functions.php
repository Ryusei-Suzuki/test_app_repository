
<!-- HTML内のデータの受け取り・受け渡しを行い、DBへの処理を依頼するファイル -->

<?php
require_once('connection.php');
session_start(); // 追記：役割調べる

// エスケープ処理
function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}


// SESSIONにtokenを格納する
function setToken()
{
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));//openssl_~関数でランダムな16文字を生成し、bin2hex関数でその文字を16進数に変換し、その結果を$_SESSION['token']に格納している

}


// SESSIONに格納されたtokenのチェックを行い、SESSIONにエラー文を格納する
function checkToken($token)
{
    var_dump($_SESSION);
    exit;

    if (empty($_SESSION['token']) || ($_SESSION['token'] !== $token)) {//$_SESSIONが空orトークンが生成したものと一致しない場合。empty():変数が空であるかどうかを検査する
        $_SESSION['err'] = '不正な操作です';
        redirectToPostedPage();
    }
}

function unsetError()
{
    $_SESSION['err'] = '';
}

function redirectToPostedPage()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}



function getTodoList()
{
    return getAllRecords(); //TODOデータ呼び出し
}

function getSelectedTodo($id)
{
    return getTodoTextById($id); 
}

function savePostedData($post)
{
    checkToken($post['token']); // 追記
    validate($post); 
    $path = getRefererPath();
    switch ($path) {
        case '/new.php':
            createTodoData($post['content']); //new.phpで指定している'content'
            break;
        case '/edit.php':
            updateTodoData($post);
            break;
        case '/index.php': //削除ボタンを押したタイミングでidが送られるのでindex.phpを使用できる
            deleteTodoData($post['id']);
            break;
        default:
            break;
    }
}


function validate($post)
{
    if (isset($post['content']) && $post['content'] === '') {//contentキーに"空白"というバリューが入っている状態の場合。isset():変数が宣言されていること、そして null とは異なることを検査する
        $_SESSION['err'] = '入力がありません';
       redirectToPostedPage();
    }
}



function getRefererPath()//URL下だけほしい
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    //$_SERVER['HTTP_REFERER'] => $_SERVERがサーバー情報を代入できるスーパーグローバル変数。HTTP_REFERERで今いるページに来る前のページを参照できる
    //parse_url => URLが要素ごとに連想配列として表示してくれている
    // var_dump($urlArray);
    // exit;
    return $urlArray['path'];
    //$urlArrayに格納したサーバー情報の連想配列の中でpathがキーになっているバリューの内容を返している
}



