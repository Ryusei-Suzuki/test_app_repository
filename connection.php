<!-- DBへの操作、DBから読み込んだものが指定したものでは無かった場合の例外処理をまとめたファイル -->


<?php
require_once('config.php');//config.phpで記載したものをこのファイル内で使用できるようにする。（DBへの接続に必要な定数が入っているため）
// var_dump($_POST);
// exit;

function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {  //PDOのエラーを出力する専用クラス
        echo $e->getMessage();
        exit();
    }
}


function createTodoData($todoText)//DBのcontentカラムにHTMLで入力した内容をレコードとして追加する関数
{
    $dbh = connectPdo(); //DB内のphp_practiceを呼び出し
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")'; //DBのcontentカラムにHTMLで入力した内容をレコードとして追加　※DBのコード
    $dbh->query($sql); //ここで上のINSERT文を実行するイメージ
}

function getAllRecords()//todosテーブルから、削除されていないレコードを全件取得する関数
{
    $dbh = connectPdo();//DB内のphp_practiceを呼び出し
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL'; //todosテーブルから、削除されていないレコードを全件取得する
    return $dbh->query($sql)->fetchAll(); //上のSELECT文実行
}

function updateTodoData($post)//該当箇所のレコードの内容を更新する為の関数
{
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id']; //todoテーブルの$post['id']番目の列にあるcontentカラムの情報を$post['content']に更新します
    $dbh->query($sql);
}

function getTodoTextById($id)//現在保存されているTODOの内容を返す
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = ("' . $id . '")';
    $data = $dbh->query($sql)->fetch();
    return $data['content'];
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = ' . $id;
    // var_dump($sql);
    // exit;
    $dbh -> query($sql);

}

