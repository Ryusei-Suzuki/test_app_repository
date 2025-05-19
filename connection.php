<!-- DBへの操作、DBから読み込んだものが指定したものでは無かった場合の例外処理をまとめたファイル -->


<?php
require_once('config.php');//config.phpで記載したものをこのファイル内で使用できるようにする。（DBへの接続に必要な定数が入っているため）
// var_dump($_POST);
// exit;

function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);//tryの中は例外が発生する可能性のある分岐点を記載している
    } catch (PDOException $e) {  //PDOのエラーを出力する専用クラス
        echo $e->getMessage();//クラスの中で宣言されている関数はメゾットということ！
        exit();
    }
}


function createTodoData($todoText)//DBのcontentカラムにHTMLで入力した内容をレコードとして追加する関数
{
    $dbh = connectPdo(); //DB内のphp_practiceを呼び出し
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)'; //DBのcontentカラムにHTMLで入力した内容をレコードとして追加　※DBのコード section20にて編集済み
    $stmt = $dbh->prepare($sql); //追記
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR); //追記
    $stmt->execute(); //追記
    
    
    //$dbh->query($sql); //ここで上のINSERT文を実行するイメージ
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
    $sql = 'UPDATE todos SET content = :todoText WHERE id = :id'; //todoテーブルの$post['id']番目の列にあるcontentカラムの情報を$post['content']に更新します section20にて編集済み
    $stmt = $dbh->prepare($sql); //編集
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR); //編集
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT); //編集
    $stmt->execute(); //編集

    //$dbh->query($sql);
}

function getTodoTextById($id)//現在保存されているTODOの内容を返す
{
    $dbh = connectPdo();//PDOステートメントオブジェクト（ここに指定しているDB）
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();//実行
    $view = $stmt->fetch();
    return $view['content'];
    // $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id =  '. $id .' ';
    // $data = $dbh->query($sql)->fetch();
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // var_dump($sql);
    // exit;
    // $dbh -> query($sql);

}


//PDO クラス：PHP とデータベースサーバーの間の接続を表します。
//PDOStatement クラス:DBへ命令するためのメゾットをまとめたクラス。
//↑インスタンス化したら～インスタンスというように！
