
<!-- HTML内のデータの受け取り・受け渡しを行い、DBへの処理を依頼するファイル -->

<?php
require_once('connection.php');

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

function getRefererPath()
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    return $urlArray['path'];
}