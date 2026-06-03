<?php

require("auth.php");
include("../include/strlib.php");
require("../include/resize.php");

$err_dict = array(
	'square' => 'Ошибка! Фото должно быть квадратным',
	'name' => 'Ошибка! Необходимо заполнить все данные',
);

if (isset($_GET['error'])) {

	$err_name = $_GET['error'];
	echo '<p style="color:red; margin-top: 15px; margin-bottom: 15px;">'.$err_dict[$err_name].'</p>';

}

// добавть (фото/имя, должность), редактировать фото, удалить сотрудника, порядок вывода (укр/ру)

$team = mysql_query("SELECT * FROM team ORDER BY sort DESC");

if (isset($_REQUEST['del_team'])) {

    foreach($_REQUEST['del_team'] as $k=>$v){
        mysql_query("DELETE FROM team WHERE ID=".$k);
    }
    header("location:edit_team.php");
    echo mysql_error();
}

if (isset($_REQUEST['edit_team'])) {

    foreach($_REQUEST['edit_team'] as $k=>$v){

        $edit_name = trim($_REQUEST['edit_name'][$k]);
        $edit_name_ua = trim($_REQUEST['edit_name_ua'][$k]);
        $edit_job = trim($_REQUEST['edit_job'][$k]);
        $edit_job_ua = trim($_REQUEST['edit_job_ua'][$k]);
        if ($_REQUEST['edit_sort'][$k] > 0) {
            $edit_sort = trim($_REQUEST['edit_sort'][$k]);
        } else {
            $edit_sort = 0;
        }
        

        $sql_img = '';

       if (isset($_FILES['edit_img']) && is_uploaded_file($_FILES['edit_img']['tmp_name'][$k])) {
        
        $size=getimagesize($_FILES['edit_img']['tmp_name'][$k]);

            if ($size[0]!=$size[1]) {
                        
                header("location:edit_team.php?error=square");
                exit();

            } else {
                
                $format = explode('/', $_FILES['edit_img']['type'][$k]);
                $img = 'team-photo' . '-'.time() . '.' . $format[1];

                $newImgSizeX = 600;
                $newImgSizeY = 600;
                img_resize($_FILES['edit_img']['tmp_name'][$k], $_SERVER['DOCUMENT_ROOT'].'/images/faces/'.$img, $newImgSizeX,$newImgSizeY, 0xFFFFFF, 85, true, true, false);

                $sql_img = ', photo="'. $img . '"';
            }

        }
        mysql_query("UPDATE team SET name='".$edit_name."', name_ua='".$edit_name_ua."', sort='".$edit_sort."', job='".$edit_job."', job_ua='".$edit_job_ua."'".$sql_img." WHERE ID = ".$k."");
    }
    header("location:edit_team.php");
}

if (isset($_REQUEST['new_team'])) {

    if (!$_REQUEST['new_name'] || !$_REQUEST['new_name_ua'] || !$_REQUEST['new_job'] || !$_REQUEST['new_job_ua']) {       
        header("location:edit_team.php?error=name");
        exit();
    } else {
        $new_name = trim($_REQUEST['new_name']);
        $new_name_ua = trim($_REQUEST['new_name_ua']);
        $new_job = trim($_REQUEST['new_job']);
        $new_job_ua = trim($_REQUEST['new_job_ua']);

        if ($_REQUEST['new_sort'] > 0) {
            $new_sort = trim($_REQUEST['new_sort']);
        } else {
            $new_sort = 0;
        }

        $sql_img = '';

        if (isset($_FILES['new_img']) && is_uploaded_file($_FILES['new_img']['tmp_name'])) {
            
            $size=getimagesize($_FILES['new_img']['tmp_name']);

                if ($size[0]!=$size[1]) {
                            
                    header("location:edit_team.php?error=square");
                    exit();

                } else {
                    
                    $format = explode('/', $_FILES['new_img']['type']);
                    $img = 'team-photo' . '-'.time() . '.' . $format[1];

                    $newImgSizeX = 600;
                    $newImgSizeY = 600;
                    img_resize($_FILES['new_img']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/faces/'.$img, $newImgSizeX,$newImgSizeY, 0xFFFFFF, 85, true, true, false);

                    $sql_img = ', photo="'. $img . '"';
                }
            }

        mysql_query("INSERT INTO team SET name='".$new_name."', name_ua='".$new_name_ua."', sort='".$new_sort."', job='".$new_job."', job_ua='".$new_job_ua."'".$sql_img);
    }
        header("location:edit_team.php");
}

?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script src="/admin/ckeditor/ckeditor.js"></script>
  <link rel="stylesheet" type="text/css" href="style_back.css">
  <script src="js/scripts.js" type="text/javascript"></script>
  <style>
    .admin {
      margin: 50px;
      display: flex;
      flex-direction: column;
    }

    .admin__holder {
      background-color: #f5f5f5;
      padding: 40px 40px;
      border-radius: 10px;
      margin-bottom: 30px;
    }

    .admin__btn {
      border: 1px solid #498C09;
      padding: 8px 18px;
      font-size: 14px;
      border: none;
      border-radius: 1px;
      cursor: pointer;
      text-align: center;
    }

    .admin__btn_main {
      background-color: #498C09;
      color: #fff;
      padding: 8px 18px;
    }

    .admin__btn_accent {
      background-color: transparent;
      border: 1px solid #498C09;
      color: #498C09;
      padding: 7px 18px;
    }

    .admin__btns {
      margin-top: 20px;
    }

    .admin__select {
      padding: 5px;
      font-size: 14px;
      border: 1px solid #498C09;
      cursor: pointer;
    }

    td {
      border: 1px solid #e6e6e6;
    }

    td .admin__btn {
      margin-left: 10px;
    }

    th {
      text-align: left;
      background-color: #e6e6e6;
      height: 30px;
      padding-left: 10px;
      padding-right: 10px;
      border-left: 1px solid #dfdbdb;
    }

    .admin__table {
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .admin__inputs {
      padding-inline-start: 0;
    }

    .admin__input {
      display: flex;
    }

    .input {
      background-color: #f5f5f5;
      border: 0;
      padding-left: 10px;
    }
  </style>
</head>

<body>
  <div class="admin">

    <?  
        $r=mysql_query("SELECT * FROM team");
        
        if (mysql_num_rows($r)){?>

    <div class="admin__holder">
      <h2>Редактировать данные сотрудников</h2>
      <form name="f1" method="post" action="edit_team.php" enctype="multipart/form-data">
        <table class="admin__table">
          <tr>
            <th>Имя (ру)</th>
            <th>Имя (укр)</th>
            <th>Должность (ру)</th>
            <th>Должность (укр)</th>
            <th>Сортировка</th>
            <th>Текущее фото</th>
            <th>Изменить фото</th>
            <th>Сохранить изменения</th>
            <th>Удалить</th>
          </tr>
          <? for ($i=0; $t=mysql_fetch_array($team); $i++){ ?>
          <tr>
            <td><input class="input" type="text" name="edit_name[<?=$t['ID']?>]" value="<?=$t['name']?>"></td>
            <td><input class="input" type="text" name="edit_name_ua[<?=$t['ID']?>]" value="<?=$t['name_ua']?>"></td>
            <td><input class="input" type="text" name="edit_job[<?=$t['ID']?>]" value="<?=$t['job']?>"></td>
            <td><input class="input" type="text" name="edit_job_ua[<?=$t['ID']?>]" value="<?=$t['job_ua']?>"></td>
            <td><input class="input" type="text" name="edit_sort[<?=$t['ID']?>]" value="<?=$t['sort']?>"></td>
            <td>
            <? if($t['photo']) {?>
              <div style="text-align:center"><img width="80" src="../images/faces/<?=$t['photo']?>"></div>
            <? } else {?>
                <p style="text-align:center">нет</p>
            <? } ?>
            </td> 
            <td><input class="input" type="file" name="edit_img[<?=$t['ID']?>]"></td>
            <td style="text-align:center"><input type="submit" class="admin__btn admin__btn_main" name="edit_team[<?=$t['ID']?>]" value="Изменить" /></td>
            <td><input type="submit" class="admin__btn" name="del_team[<?=$t['ID']?>]" value="X" /></td>
          </tr>
          <?}?>
        </table>

      </form>
    </div>
    <?}?>
    <div class="admin__holder">
      <h2>Добавить нового сотрудника</h2>

      <form name="f2" method="post" action="edit_team.php" enctype="multipart/form-data">
        <table class="admin__table">
          <tr>
            <th>Имя (ру)</th>
            <th>Имя (укр)</th>
            <th>Должность (ру)</th>
            <th>Должность (укр)</th>
            <th>Сортировка</th>
            <th>Фото</th>
          </tr>
          <tr>
            <td><input class="input" type="text" name="new_name" placeholder="Иван"></td>
            <td><input class="input" type="text" name="new_name_ua" placeholder="Іван"></td>
            <td><input class="input" type="text" name="new_job" placeholder="Менеджер"></td>
            <td><input class="input" type="text" name="new_job_ua" placeholder="Менеджер"></td>
            <td><input class="input" type="text" name="new_sort" placeholder="0"></td>
            <td><input class="input" type="file" name="new_img"></td>
          </tr>
        </table>
        <input type="submit" class="admin__btn admin__btn_main" name="new_team" value="Добавить" />
      </form>
    </div>
  </div>
</body>

</html>