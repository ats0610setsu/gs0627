<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="https://keiyaku.php">契約を作る</a>　
    
      
      <?php if($_SESSION["kanri_flg"]=="1"){ ?>
          <a class="navbar-brand" href="user.php">ユーザー登録</a>　
          <a class="navbar-brand" href="user_select.php">マイページ</a>　
      <?php } ?>

      <?php if($_SESSION["kanri_flg"]=="2"){ ?>
        <a class="navbar-brand" href="select.php">ユーザー一覧</a>　
      <?php } ?>

      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>