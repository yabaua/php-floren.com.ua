<?
require("auth.php");
require("rand.php");
echo '<head><link rel="stylesheet" type="text/css" href="style_back.css"><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"></head>';
if (isset($_REQUEST['u_login']) && isset($_REQUEST['change']) && $_REQUEST['u_login']) {
  if ($_SESSION['admin_name']==$_REQUEST['u_login']) {
    $r=mysql_query("SELECT pass FROM admins WHERE login='".$_REQUEST['u_login']."'");
    if (mysql_num_rows($r)) {
      $f=mysql_fetch_array($r);
      if ($f['pass']==md5($_REQUEST['old_pass'])) {
        if ($_REQUEST['pass']==$_REQUEST['con_pass']) {
          
			mysql_query("UPDATE admins SET pass='".md5($_REQUEST['pass'])."' WHERE login='".$_REQUEST['u_login']."'");
			echo "Пароль изменен.<BR>";
        } else {
			echo "Новый пароль неправильный.<BR>";
        }
      } else {
        echo "Старый пароль неправильный.<BR>";
      }
    } else {
      echo "Неправильный логин.<BR>";
    }
  } else {
    echo_denial();
    exit();
  }
}
?>
<H3>Изменение пароля:</H3>
<form action="edit_pass.php" method=post>
<table class="table" border>
<tr><td>Login:</td><td><input type=text name=u_login size=30 class="input_text"></td></tr>
<tr><td>Старый пароль:</td><td><input type=password name=old_pass size=30 class="input_text"></td></tr>
<tr><td>Новый пароль:</td><td><input type=password name=pass size=30 class="input_text"></td></tr>
<tr><td>Подтверждение:</td><td><input type=password name=con_pass size=30 class="input_text"></td></tr>
</table><BR>
<input type=submit name="change" value="Изменить" class="button"><BR>
</form>
