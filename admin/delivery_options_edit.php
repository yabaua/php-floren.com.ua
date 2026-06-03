<?

require("auth.php");
include("../include/strlib.php");

$delivery_options=mysql_query("SELECT * FROM options_delivery");

if (isset($_REQUEST['change'])) {

    foreach($_REQUEST['option'] AS $k=>$v){

        mysql_query("UPDATE options_delivery SET
        option_value='".$_REQUEST['change_val'][$k]."'
        WHERE ID = '".$k."'");

        echo mysql_error();

        header("location:delivery_options_edit.php");
    }
}

?>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="/admin/ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" type="text/css" href="style_back.css">
        <script src="js/scripts.js" type="text/javascript"></script>
	</head>

    <body style="margin-left:20px;">
        <h2>Условия доставки</h2>
        <form name="f1" method="post" action="delivery_options_edit.php">
            <table style="margin-top:50px; width:500px">
                <tboby>
                    <tr>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Опция</th>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Значение</th>
                    </tr>
                    <?for($i=0; $res=mysql_fetch_array($delivery_options); $i++){?>
                            <tr>
                                <td><input style="width:100%; border:none" readonly name="option[<?=$res['ID']?>]" value="<?=$res['option_name']?>"></td>
                                <td><input style="width:80px" name="change_val[<?=$res['ID']?>]" class="delivery-value" value='<?=$res['option_value']?>'></td>
                            </tr>
                        <?}?>
                </tboby>
            </table>
            <input style="padding: 3px 10px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none; margin-top: 15px;" type="submit" class="admin_btn" name="change" value="Изменить" />
        </form>
    </body>

</html>

