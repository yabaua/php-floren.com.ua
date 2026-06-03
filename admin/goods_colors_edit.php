<?php 
require("auth.php");
include("../include/strlib.php");
require("../include/resize.php");


$is_exists = 0;

$colors=array();

$db->query("SELECT * FROM goods_colors ORDER BY name_ua");
while($r=$db->fetch()) {
    $colors[]=$r['alias'];
};

if (isset($_REQUEST['change-color'])) {
    $images = array();

    foreach($_REQUEST['color_alias'] AS $k=>$v) {
        $changed_alias = str_replace(' ', '_', trim($_REQUEST['color_alias'][$k]));
        $is_exists = in_array($changed_alias, $colors);

        if ($_FILES['edit_prev-'.$k] && !empty($_FILES['edit_prev-'.$k]['name'])) {
            $img_name = 'prev-'.$changed_alias.'-'.time();
            $size=getimagesize($_FILES['edit_prev-'.$k]['tmp_name']);

            if ($size[0]!=$size[1]) {
                echo '<b><FONT COLOR="#FF0000">Ошибка! Изображение должно быть квадратным</FONT></b><br />';
            } else {
                if (!$is_exists) {
                    $image = $img_name.".jpg";
                    $prevImgSizeX=40;
                    $prevImgSizeY=40;
                    img_resize($_FILES['edit_prev-'.$k]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/ins/preview/'.$image, $prevImgSizeX, $prevImgSizeY, 0xFFFFFF, 90, true, true, false);
                    chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/preview/'.$image, 0777);

                    $db->query("UPDATE goods_colors SET preview='".$image."' WHERE ID = '".$k."'");
                }
            }
        }

        if (!$is_exists) {

            $db->query("UPDATE goods_colors SET alias='".$changed_alias."', name_ru='".$_REQUEST['color_ru'][$k]."', name_ua='".$_REQUEST['color_ua'][$k]."' WHERE ID = '".$k."'");
            header("location:goods_colors_edit.php");
        }
    }
};

if (isset($_REQUEST['add-color'])) {
    $alias = str_replace(' ', '_', trim($_REQUEST['new_color_alias']));
    $is_exists = in_array($alias, $colors);
    
    if ($_FILES['new_prev']['tmp_name']) {
        $img_name = 'prev-'.$alias.'-'.time();
	    $size=getimagesize($_FILES['new_prev']['tmp_name']);

        if ($size[0]!=$size[1]) {
            echo '<b><FONT COLOR="#FF0000">Ошибка! Изображение должно быть квадратным</FONT></b><br />';
        } else {

            $image = $img_name.".jpg";
            $prevImgSizeX=40;
            $prevImgSizeY=40;
            img_resize($_FILES['new_prev']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/ins/preview/'.$image, $prevImgSizeX, $prevImgSizeY, 0xFFFFFF, 90, true, true, false);
            chmod($_SERVER['DOCUMENT_ROOT'].'/images/ins/preview/'.$image, 0777);

            if (!$is_exists) {
                $db->query("INSERT INTO goods_colors SET alias='".$alias."', preview='".$image."', name_ru='".$_REQUEST['new_color_ru']."', name_ua='".$_REQUEST['new_color_ua']."'");
                header("location:goods_colors_edit.php");
            }
        }
    } else {
        echo '<b><FONT COLOR="#FF0000">Загрузите изображение для цвета!</FONT></b><br />';
    }

};

?>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="/admin/ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" type="text/css" href="style_back.css?v=1w">
        <script src="js/colors-script.js" type="text/javascript"></script>
	</head>

<body style="margin-left:20px;">
<?php 
//============================

include("top_menu.php");

//============================
?>
        <div style="margin-top: 30px">

        <h1>Добавить цвет</h1>

        <?php if ($is_exists) echo '<p style="color:red; margin-top: 10px">Алиас уже существует. Введите уникальное значение</p>' ?>

        <form name="f2" method="post" action="goods_colors_edit.php" enctype="multipart/form-data">
            <table style="margin-top:50px; width:500px">
                <tboby>

                    <tr>
                        <td><input style="width:100px;" name="new_color_alias" placeholder="Введите алиас"></td>
                        <td><input style="width:300px" name="new_color_ru" placeholder="Введите название на русском"></td>
                        <td><input style="width:300px" name="new_color_ua" placeholder="Введите название на украинском"></td>
                        <td><input name="new_prev" type="file"></td>
                    </tr>

                </tboby>
            </table>
            <input style="padding: 3px 10px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none; margin-top: 15px;" type="submit" class="admin_btn" name="add-color" value="Добавить" />
        </form>
        </div>

        <h2 style="margin-top:70px">Редактировать цвета</h2>
        <form name="f1" method="post" action="goods_colors_edit.php" enctype="multipart/form-data">
            <table style="margin-top:50px; width:500px">
                <tboby>
                    <tr>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Алиас</th>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Название на русском</th>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Название на украинском</th>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Цвет</th>
                        <th style="text-align:left; padding-bottom:8px; font-size:16px">Загрузить новое изображение</th>
                    </tr>
                    <?php
                    $db->query("SELECT * FROM goods_colors ORDER BY name_ua");
                    for($i=0; $res=$db->fetch(); $i++){?>
                            <tr>
                                <td><input style="width:100px;" name="color_alias[<?=$res['ID']?>]" class="color-value" value="<?=$res['alias']?>"></td>
                                <td><input style="width:300px" name="color_ru[<?=$res['ID']?>]" class="color-value" value='<?=$res['name_ru']?>'></td>
                                <td><input style="width:300px" name="color_ua[<?=$res['ID']?>]" class="color-value" value='<?=$res['name_ua']?>'></td>
                                <td><img src="/images/ins/preview/<?=$res['preview']?>"></td>
                                <td><input name="edit_prev-<?=$res['ID']?>" type="file"></td>
                            </tr>
                        <?php }?>

                </tboby>
            </table>
            <input style="padding: 3px 10px; color: #FFFFFF; background: #5F1C13; text-decoration: none; border:none; margin-top: 15px;" type="submit" class="admin_btn" name="change-color" value="Изменить" />
        </form>

    </body>

</html>

