<?
require("auth.php");
include("../include/strlib.php");
require("../include/resize.php");


$slider_id = '';


if (isset($_REQUEST['select_slider'])) {

    if (isset($_REQUEST['slider'])) {

        $slider_id = intval($_REQUEST['slider']);
        header("location:edit_sliders.php?id=$slider_id&mod=slider");
        echo $db->error();
    }

}


if (isset($_REQUEST['edit_slider'])) {

        foreach($_REQUEST['edit_slider'] as $k=>$v){
            $slider_id = intval($k);
        }
    
        $edit_alias=trim($_REQUEST['edit_alias']);
        $edit_name_ru=trim($_REQUEST['edit_name_ru']);
        $edit_name_ua=trim($_REQUEST['edit_name_ua']);
        $edit_visible=intval(trim($_REQUEST['edit_visible']));
        $edit_zoom=intval(trim($_REQUEST['edit_zoom']));
        $edit_qnt_large=intval(trim($_REQUEST['edit_qnt_large']));
        $edit_qnt_medium=intval(trim($_REQUEST['edit_qnt_medium']));
        $edit_qnt_small=intval(trim($_REQUEST['edit_qnt_small']));
        $edit_qnt_min=intval(trim($_REQUEST['edit_qnt_min']));
        $edit_slider_hgt=intval(trim($_REQUEST['edit_slider_hgt']));
    
        $db->query("UPDATE sliders SET alias='".$edit_alias."', name_ru='".$edit_name_ru."', name_ua='".$edit_name_ua."', zoom='".$edit_zoom."', qnt_large='".$edit_qnt_large."', qnt_medium='".$edit_qnt_medium."', qnt_small='".$edit_qnt_small."', qnt_min='".$edit_qnt_min."', height='".$edit_slider_hgt."', visible='".$edit_visible."' WHERE slider_id = ".$k."");


        header("location:edit_sliders.php?id=$slider_id&mod=slider");
        echo $db->error();

}

if (isset($_REQUEST['edit_slides'])) {

    if (isset($_REQUEST['slider'])) {

        $slider_id = intval($_REQUEST['slider']);
        header("location:edit_sliders.php?id=$slider_id&mod=slides");
        echo $db->error();
    }
    
}

if (isset($_REQUEST['del'])) {

    $sld_id = $_REQUEST['slider_idd'];

	foreach($_REQUEST['del'] as $k=>$v){
		$db->query("DELETE FROM sliders_data WHERE ID=".$k);
	}

    header("location:edit_sliders.php?id=$sld_id&mod=slides");
    echo $db->error();

}

if (isset($_REQUEST['delpage'])){

    $slider_id = intval($_REQUEST['slider_id']);

	foreach($_REQUEST['delpage'] as $k=>$v){
		$db->query("DELETE FROM sliders_pages WHERE ID=".$k);
	}

    header("location:edit_sliders.php?id=$slider_id&mod=slider");
    echo $db->error();

}

if (isset($_REQUEST['pluspage'])){

	foreach($_REQUEST['pluspage'] as $k=>$v){
      $new_page=trim($k);
		  $db->query("INSERT INTO sliders_pages SET slider_id=".$k.", page='".$_REQUEST['page']."'");
	}

    header("location:edit_sliders.php?id=$k&mod=slider");
    echo $db->error();

}

if (isset($_REQUEST['del_slider'])) {

    foreach($_REQUEST['del_slider'] as $k=>$v){
        $db->query("DELETE FROM sliders_data WHERE slider_id=".$k);
        $db->query("DELETE FROM sliders WHERE slider_id=".$k);
    }

    header("location:edit_sliders.php");
    echo $db->error();

}



if (isset($_REQUEST['new_slider'])) {

    if ($_REQUEST['new_alias'] == '') return;

    $sl_id = rand(0, 999);
    $new_alias=trim($_REQUEST['new_alias']);
	  $new_name_ru=trim($_REQUEST['new_name_ru']);
	  $new_name_ua=trim($_REQUEST['new_name_ua']);
    $new_visible=intval(trim($_REQUEST['new_visible']));
    $new_zoom=intval(trim($_REQUEST['new_zoom']));
    $new_qnt_large=intval(trim($_REQUEST['new_qnt_large']));
    $new_qnt_medium=intval(trim($_REQUEST['new_qnt_medium']));
    $new_qnt_small=intval(trim($_REQUEST['new_qnt_small']));
    $new_qnt_min=intval(trim($_REQUEST['new_qnt_min']));
    $new_slider_hgt=intval(trim($_REQUEST['new_slider_hgt']));


    $db->query("
                INSERT INTO sliders
                SET
                slider_id=".$sl_id.",
                alias='".$new_alias."',
                name_ru='".$new_name_ru."',
                name_ua='".$new_name_ua."',
                zoom='".$new_zoom."',
                qnt_large='".$new_qnt_large."',
                qnt_medium='".$new_qnt_medium."',
                qnt_small='".$new_qnt_small."',
                qnt_min='".$new_qnt_min."',
                height='".$new_slider_hgt."',
                visible='".$new_visible."'
              ");

    header("location:edit_sliders.php");
    echo $db->error();

}


if (isset($_REQUEST['new_slide'])) {


    $s_id = '';

    foreach($_REQUEST['new_slide'] as $k=>$v){
        $s_id = $k;
    }

    $new_link=trim($_REQUEST['new_link']);
	$new_caption_ru=trim($_REQUEST['new_caption_ru']);
	$new_caption_ua=trim($_REQUEST['new_caption_ua']);
	$new_order=trim($_REQUEST['new_order']);

    $qv = "INSERT INTO sliders_data SET slider_id=".$s_id."";

    if (isset($_FILES['new_img']) && is_uploaded_file($_FILES['new_img']['tmp_name'])) {

        $db->query("SELECT * FROM sliders WHERE slider_id=".$s_id);
		    $f=$db->fetch();
        $format = explode('/', $_FILES['new_img']['type']);

        $img = $f['alias'] . '-'.time() . '.' . $format[1];

        $target_path = $_SERVER['DOCUMENT_ROOT'].'/images/content/sliders';
        move_uploaded_file($_FILES['new_img']['tmp_name'], "$target_path/$img");

        $qv = $qv . ", img='".$img."'";

        if ($new_link) {
            $qv = $qv . ", link='".$new_link."'";
        }
    
        if ($new_caption_ru) {
            $qv = $qv . ", caption_ru='".$new_caption_ru."'";
        }
    
        if ($new_caption_ua) {
            $qv = $qv . ", caption_ua='".$new_caption_ua."'";
        }
    
        if ($new_order) {
            $qv = $qv . ", slide_order=".$new_order."";
        }
    
        $db->query($qv);
    }

    header("location:edit_sliders.php?id=$s_id&mod=slides");
    echo $db->error();

}

if (isset($_REQUEST['edit_allslides'])) {

    foreach($_REQUEST['edit_allslides'] as $kk=>$vv){

        foreach($_REQUEST['idd'] as $k=>$v){

            $link = trim($_REQUEST['link'][$k]);
            $caption_ru=trim($_REQUEST['caption_ru'][$k]);
            $caption_ua=trim($_REQUEST['caption_ua'][$k]);
            $order=trim($_REQUEST['slide_order'][$k]);

            $db->query("UPDATE sliders_data SET link='".$link."', caption_ru='".$caption_ru."', caption_ua='".$caption_ua."', slide_order=".$order." WHERE ID = ".$k."");
    
        }
    }

    header("location:edit_sliders.php?id=$kk&mod=slides");
    echo $db->error();
    

}



?>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
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
                padding-right: 15px;
                padding-bottom: 20px;
                padding-top: 10px;
            }

            th {
                text-align: left;
            }

            .admin__table {
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .table__data {
                border: 1px solid #498C09;
            }

            .admin__inputs {
                padding-inline-start: 0;
            }

            .admin__input {
                display: flex;
            }

            .inputs {
                width: 500px;
            }

            .inputs .admin__input {
                justify-content: space-between;
                align-items: center;
            }

            .input {
                width: 200px;
                border: 0; 
                text-align: center;
                height: 30px;
            }

        </style>
	</head>

    <body>


            <div class="admin">
                <div class="admin__holder">
                    <div class="block">
                        <h2 class="block__headline">Выбрать слайдер</h2>

                        <div class="block__headline">
                            <form name="f1" method="post" action="edit_sliders.php">

                                <select name="slider" class="admin__select">
                                    <option>Доступные слайдеры</option>
                                    <?
                                      $db->query("SELECT * FROM sliders");
                                      for($i=0; $res=$db->fetch(); $i++){ ?>
                                            <option value="<?=$res['slider_id']?>"><?=$res['name_ru']?></option>
                                    <?}?>
                                </select>

                                <div class="admin__btns">
                                    <input type="submit" class="admin__btn admin__btn_main" name="select_slider" value="Редактировать слайдер" />
                                    <input type="submit" class="admin__btn admin__btn_accent" name="edit_slides" value="Редактировать слайды" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <? if (isset($_GET['id']) && $_GET['id'] != 0 && $_GET['mod'] == 'slides') { 
                ?>

                <div class="admin__holder">
                    <div class="block">
                        <h2 class="block__headline">Добавить новый слайд</h2>
                            <form name="f3" method="post" action="edit_sliders.php" enctype="multipart/form-data">

                                <ul class="admin__inputs inputs">
                                    <li class="admin__input"><p>Изображение слайда</p><input class="input" placeholder="new-gallery" type="file" name="new_img"></li>
                                    <li class="admin__input"><p>Ссылка (например, /planters/ceramic/)</p><input class="input" placeholder="publications" value="" type="text" name="new_link"></li>
                                    <li class="admin__input"><p>Подпись на русском</p><input class="input" placeholder="Галере фотографий" type="text" value="" name="new_caption_ru"></li>
                                    <li class="admin__input"><p>Подпись на украинском</p><input class="input" placeholder="Галерея фотографій" value="" type="text" name="new_caption_ua"></li>
                                    <li class="admin__input"><p>Порядок слайдов</p><input class="input" placeholder="1" type="text" value="" name="new_order"></li>
                                </ul>
                                <input type="submit" class="admin__btn admin__btn_main" name="new_slide[<?=$_GET['id']?>]" value="Добавить новый слайд" />
                            </form>
                    </div>
                </div>

                <?
                $db->query("SELECT s.ID, sd.ID AS slide_id, s.slider_id, sd.slider_id, sd.img, sd.link, sd.caption_ru, sd.caption_ua, sd.slide_order, sd.slider_id FROM sliders s JOIN sliders_data sd ON s.slider_id=sd.slider_id WHERE s.slider_id=".$_GET['id']); 

                if ($db->num_rows() > 0) {
                ?>

                <div class="admin__holder">
                    <div class="block">
                        <h2 class="block__headline">Редактировать слайды</h2>
                        <form name="f2" method="post" action="edit_sliders.php" cellspacing="0" cellpadding="0">
                            <table class="admin__table">
                                <tr>
                                    <th>ID</th>
                                    <th>Изображение слайда</th>
                                    <th>Ссылка</th>
                                    <th>Подпись на русском</th>
                                    <th>Подпись на украинском</th>
                                    <th>Порядок</th>
                                    <th>Удалить слайд</th>
                                </tr>

                                <? for($i=0; $res=$db->fetch(); $i++){?>
                                    <input type="hidden" name="slider_idd" value="<?=$_GET['id']?>">
                                    <tr>
                                        <td><input style="width: 40px; border: none; background: transparent" readonly type="text" name="idd[<?=$res['slide_id']?>]" value="<?=$res['slide_id']?>"></td>
                                        <td><img src="/images/content/sliders/<?=$res['img']?>" width="100"></td>
                                        <td><input class="input" type="text" name="link[<?=$res['slide_id']?>]" value="<?=$res['link']?>"></td>
                                        <td><input class="input" type="text" name="caption_ru[<?=$res['slide_id']?>]" value="<?=$res['caption_ru']?>"></td>
                                        <td><input class="input" type="text" name="caption_ua[<?=$res['slide_id']?>]" value="<?=$res['caption_ua']?>"></td>
                                        <td><input class="input" type="text" name="slide_order[<?=$res['slide_id']?>]" value="<?=$res['slide_order']?>"></td>
                                        <td align="center"><input value=" x " type="submit" name="del[<?=$res['slide_id']?>]" style="cursor: pointer"></td>
                                    </tr>
                                <?}?>
                            </table>
                            <input type="submit" class="admin__btn admin__btn_main" name="edit_allslides[<?=$_GET['id']?>]" value="Редактировать слайды" />
                        </form>
                    </div>
                </div>

                <?}}?>

                <div class="admin__holder">
                    <div class="block">
                        <h2 class="block__headline">Добавить новый слайдер</h2>
                            <form name="f4" method="post" action="edit_sliders.php">

                                <ul class="admin__inputs inputs">
                                    <li class="admin__input"><p>Алиас (латиницей, без пробелов)</p><input class="input" placeholder="new-gallery" type="text" name="new_alias"></li>
                                    <li class="admin__input"><p>Название слайдера на русском</p><input class="input" placeholder="Галерея фотографий" type="text" name="new_name_ru"></li>
                                    <li class="admin__input"><p>Название слайдера на украинском</p><input class="input" placeholder="Галерея фотографій" type="text" name="new_name_ua"></li>
                                    <li class="admin__input">
                                        <p>Видимость</p>
                                        <select class="input" name="new_visible">
                                            <option value="1">да</option>
                                            <option value="0">нет</option>
                                        </select>
                                    </li>
                                    <li class="admin__input">
                                        <p>Увеличивать изображение при клике</p>
                                        <select class="input" name="new_zoom">
                                            <option value="1">да</option>
                                            <option value="0">нет</option>
                                        </select>
                                    </li>
                                    <li class="admin__input"><p>К-во слайдов (ширина > 992 px)</p><input class="input" placeholder="4" type="number" name="new_qnt_large"></li>
                                    <li class="admin__input"><p>К-во слайдов (ширина > 600 px)</p><input class="input" placeholder="3" type="number" name="new_qnt_medium"></li>
                                    <li class="admin__input"><p>К-во слайдов (ширина > 400 px)</p><input class="input" placeholder="2" type="number" name="new_qnt_small"></li>
                                    <li class="admin__input"><p>К-во слайдов (ширина до 400 px)</p><input class="input" placeholder="1" type="number" name="new_qnt_min"></li>
                                    <li class="admin__input"><p>Высота слайдера (указывать, если <br/> больше 1 слайда на экране)</p><input class="input" placeholder="200" type="number" name="new_slider_hgt"></li>
                                </ul>
                                <input type="submit" class="admin__btn admin__btn_main" name="new_slider" value="Добавить слайдер" />
                            </form>
                    </div>
                </div>

                <? if (isset($_GET['id']) && $_GET['id'] != 0 && $_GET['mod'] == 'slider') { ?>

                <div class="admin__holder">
                    <div class="block">
                        <h2 class="block__headline">Редактировать слайдер</h2>
                        <form name="f5" method="post" action="edit_sliders.php">
                            <table class="admin__table">

                            <tr>
                                <th>Алиас (латиницей, без пробелов)</th>
                                <th>Названия слайдера (ру)</th>
                                <th>Названия слайдера (укр)</th>
                                <th>Видимость</th>
                                <th>Увеличивать при клике</th>
                            </tr>

                            <? $db->query("SELECT * from sliders WHERE slider_id=".$_GET['id']); 
                                
                                for ($i=0; $s_res=$db->fetch(); $i++){?>

                            <tr>
                                <td><input class="input" type="text" name="edit_alias" value="<?=$s_res['alias']?>"></td>
                                <td><input class="input" type="text" name="edit_name_ru" value="<?=$s_res['name_ru']?>"></td>
                                <td><input class="input" type="text" name="edit_name_ua" value="<?=$s_res['name_ua']?>"></td>

                                <td><select class="input" name="edit_visible">
                                    <option value="1">да</option>
                                    <option value="0">нет</option>
                                </select></td>

                                <td><select class="input" name="edit_zoom">
                                    <option value="1">да</option>
                                    <option value="0">нет</option>
                                </select></td>
 
                            </tr>

                            <tr>
                                <th>К-во слайдов <br>(шир > 992 px)</th>
                                <th>К-во слайдов <br>(шир > 600 px)</th>
                                <th>К-во слайдов <br>(шир > 400 px)</th>
                                <th>К-во слайдов <br>(шир до 400 px)</th>
                                <th>Высота слайдера</th>
                            </tr>

                            <tr>
                                <td><input class="input" type="number" name="edit_qnt_large" value="<?=$s_res['qnt_large']?>"></td>
                                <td><input class="input" type="number" name="edit_qnt_medium" value="<?=$s_res['qnt_medium']?>"></td>
                                <td><input class="input" type="number" name="edit_qnt_small" value="<?=$s_res['qnt_small']?>"></td>
                                <td><input class="input" type="number" name="edit_qnt_min" value="<?=$s_res['qnt_min']?>"></td>
                                <td><input class="input" type="number" name="edit_slider_hgt" value="<?=$s_res['height']?>"></td>
                            </tr>

                            <?}?>

                            </table>

                            <input type="submit" class="admin__btn admin__btn_main" name="edit_slider[<?=$_GET['id']?>]" value="Редактировать" />
                            <input type="submit" class="admin__btn admin__btn_main" name="del_slider[<?=$_GET['id']?>]" value="Удалить слайдер" />
                        </form>
                    </div>
                </div>



                <div class="admin__holder">
                    <div class="block">
                        
                    <? 
                    $db->query("SELECT s.slider_id, sp.slider_id, sp.page, sp.ID AS pageID from sliders s JOIN sliders_pages sp ON s.slider_id=sp.slider_id WHERE s.slider_id=".$_GET['id']);
                    
                    if ($db->num_rows() > 0) {

                ?>

                        <h2 class="block__headline">Страницы, на которых размещен слайдер</h2>
                        <form name="f5" method="post" action="edit_sliders.php">
                            <table class="admin__table">

                            <tr>
                                <th>Страница</th>
                                <th>Удалить</th>
                            </tr>

                            <?  
                                for ($i=0; $s_page=$db->fetch(); $i++){
                            ?>
                            <tr>
                                <input class="input" type="hidden" name="slider_id" value="<?=$s_page['slider_id']?>">
                                <td><input class="input" type="text" name="page" value="<?=$s_page['page']?>"></td>
                                <td align="center"><input value=" x " type="submit" name="delpage[<?=$s_page['pageID']?>]" style="cursor: pointer"></td>
                            </tr>

                            <?}?>

                            </table>
                        </form>

                        <?}?>

                        <h2 class="block__headline">Добавить новую страницу</h2>

                        <form name="f5" method="post" action="edit_sliders.php">
                            <table class="admin__table">

                            <tr>
                                <th>Страница</th>
                                <th>Добавить</th>
                            </tr>

                            <tr>
                                <td><input class="input" type="text" name="page" placeholder="publications"></td>
                                <td align="center"><input value=" + " type="submit" name="pluspage[<?=$_GET['id']?>]" style="cursor: pointer"></td>
                            </tr>

                            </table>
                        </form>

                    </div>
                </div>

                


                <?}?>
            </div>
    </body>
</html>