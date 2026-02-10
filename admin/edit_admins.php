<?
set_magic_quotes_runtime(0);
require("auth.php");
if (isset($add) && $login) {
  $r=mysql_query("SELECT ID FROM admins WHERE login='$login'");
  if (!mysql_num_rows($r)) {
    $pass=md5($pass);
    mysql_query("INSERT INTO admins(LOGIN,PASS) values('$login','$pass')");
  }
}
if (isset($delet) && isset($del)) {
  foreach($del AS $d) mysql_query("DELETE FROM admins WHERE login='$d'");
}
?>
<html><head>
<link rel="stylesheet" type="text/css" href="style_back.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style_back.css">
</head><body>
<?
echo '<form name="f" action=edit_admins.php method=post>';
echo '<h3>Admins</h3>';

$r=mysql_query("SELECT * FROM admins");
echo '<table class="table" border>';
echo '<tr><th>Логин</th><th>Удалить</th></tr>';
while ($f=mysql_fetch_array($r)) {
  echo '<tr><td>'.$f['login'].'</td><td><input type=checkbox name=del[] value="'.$f['login'].'" class="input_check"></td></tr>';
}
echo '</table><BR>';
echo '<INPUT TYPE="submit" name=delet value="Удалить" class="button">';
?>
<H3>Новый пользователь</H3>
Логин: <INPUT TYPE="text" NAME="login"><BR>
Пароль: <INPUT TYPE="text" NAME="pass"><BR><BR>
<INPUT TYPE="submit" name=add value="Добавить" class="button">
</form>
</body>
</html>