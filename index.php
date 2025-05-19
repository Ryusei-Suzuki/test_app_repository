<!-- 大元。初期画面 -->

<?php 
require_once('functions.php'); 
setToken(); //追記
?>


<!DOCTYPE html>
 <html lang="ja"><!--言語日本語 -->

 <head><!--ページの設定（ブラウザには表示はされない）を書く。 -->
  <meta charset="UTF-8">
   <title>Home</title><!--ブラウザ上のタブに表示される -->
</head>

 <body><!--ページの内容 -->

 <?php if (!empty($_SESSION['err'])): ?> <!-- // 追記 -->
    <p><?= $_SESSION['err']; ?></p> <!-- // 追記 -->
  <?php endif; ?> <!-- // 追記 -->

  welcome hello world
  <div>
      <a href="new.php"> <!--a = anchorの略、href = hypertext referenceの略。aタグを使ってhrefに指定しているリンク（今回ファイル）に移動できる -->
        <p>新規作成</p> <!--paragraph（段落）の略。文章を表すタグ。 -->
     </a>
  </div>
  <div> 
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>

       <?php foreach (getTodoList() as $todo): ?><!--$todoをバリューとし、getTodoList()からよびだしたTODOリストのid,contentと更新,削除の項目を表示可能な分繰り返し表示させる -->
        <tr>
          <td><?= e($todo['id']); ?></td>
          <td><?= e($todo['content']); ?></td>
          <td>
             <a href="edit.php?id=<?= e($todo['id']); ?>">更新</a> <!--?以下をクエリパラメータというid = キー、$todo['id'] = バリューの連想配列になる -->
          </td>
          <td>
             <form action="store.php" method="post"> <!--get = 情報を取得  post = 情報を更新 -->
              <input type="hidden" name="id" value="<?= e($todo['id']); ?>"> <!--store.phpにPOSTされる-->
              <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>"> <!--追記 -->
              <button type="submit">削除</button><!-- 削除ボタンを押したidの内容を非表示にする（deleted_atに時間を追加） -->
            </form>
          </td>
        </tr>
      <?php endforeach; ?>

    </table>
  </div>
   <?php unsetError(); ?> <!-- 追記 -->
</body>
</html>