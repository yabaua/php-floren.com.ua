<?php

//set_magic_quotes_runtime(0);
require("auth.php");
require("dir_list.php");
include("../include/strlib.php");


	if (!isset($_REQUEST['lang'])){
		$lang='ua';
		$db_sufix='_ua';
		$btn_lang = 'lang_ua';
		$lang_param="&lang=ua";
	}else{		
		$lang=$_REQUEST['lang'];
		$db_sufix=	$_REQUEST['lang']=='ru'?'':('_'.$_REQUEST['lang']);
		$btn_lang = 'lang_'.$_REQUEST['lang'];
		$lang_param="&lang=".$_REQUEST['lang'];
	}
	
	if (!isset($lang)) $lang='ua';
	
	if (!isset($_REQUEST['ID']) || !$_REQUEST['ID']) {
		header("location: edit_catalog.php");
		exit();
	}
	else $ID=$_REQUEST['ID'];
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style_back.css">
	<script src="/admin/ckeditor/ckeditor.js"></script>
</head>
<body>
<?php

$path='';
$PATH=array();
function get_path($id) {
	global $path,$PATH,$ID, $db, $db_sufix;
	$db->query("SELECT * FROM tree".$db_sufix." WHERE ID='".$ID."'");
	if ($db->num_rows()) {
		$f=$db->fetch();
		$PATH[]=$f['alias'];
		if ($ID!=$id) $path='<a href="edit_catalog.php?ID='.$f['ID'].'">'.$f['name'].'</a> <span class="root">»»</span> '.$path;
			else $path=$f['name'].'<BR><BR>';
		if ($f['motherID']) get_path($f['motherID']);
			else $path='<a href="edit_catalog.php?ID=0">root</a> <span class="root">»»</span> '.$path;
	}
}
get_path($ID);
$PATH=array_reverse($PATH);

echo '<form action="edit_catalog1.php?ID='.$ID.'&lang='.$lang.'" method="post">';



if (isset($_REQUEST['edit']) && $_REQUEST['new_name'] && $_REQUEST['alias']) {

	if (!isset($_REQUEST['new_show'])) $new_show='';
	else $new_show=$_REQUEST['new_show'];

	if (!isset($_REQUEST['new_intop'])) $new_intop='';
	$new_intop=$_REQUEST['new_intop'];
	
//	$content=stripslashes($_REQUEST['content']);

	
	
	$db->query("UPDATE tree25".$db_sufix." SET
			alias='".$_REQUEST['alias']."',
			name='".$_REQUEST['new_name']."',
			meta_title='".$_REQUEST['new_title']."',
			meta_description='".$_REQUEST['new_description']."',
			meta_keywords='".$_REQUEST['new_keywords']."',
			script='".$_REQUEST['script']."',
			act='".$new_show."',
			content='".addslashes($_REQUEST['content'])."',
			top_menu='".$new_intop."'
		WHERE ID=$ID");

		
	

}



$db->query("SELECT * FROM tree25".$db_sufix." WHERE ID='".$ID."'");
$f=$db->fetch();
?>
<div class="holder" style="margin:10px 0;padding:10px 0;">
	<a href="?lang=ru&ID=<?=$ID?>" class="adm-btn adm-btn_max<?=$lang=='ru'?' btn_active':''?>">RU</a>
	<a href="?lang=ua&ID=<?=$ID?>" class="adm-btn adm-btn_max<?=$lang=='ua'?' btn_active':''?>">UA</a>
</div>
<h3>Редактирование узла "<?=$f['name'] ?>":</h3>
<?=$path; ?>
<table  class="table" border>
	<tr><td colspan="2" align="center">Название раздела:</td></tr>
	<tr><td><input type="text" name="new_name" class="input_text" value="<?=$f['name'] ?>" size="40"></td></tr>
	<tr><td colspan="2" align="center">Alias: <INPUT TYPE="text" NAME="alias" class="input_text" value="<?=$f['alias'] ?>" size=30></td></tr>
	<tr><td colspan="2" align="center">Мета тэг TITLE:</td></tr>
	<tr><td><input type="text" name="new_title" class="input_text" value="<?=$f['meta_title'] ?>" size="40"></td></tr>
	<tr><td colspan="2" align="center">Мета тэг DESCRIPTION:</td></tr>
	<tr><td><TEXTAREA NAME="new_description" ROWS="5" COLS="40"><?=$f['meta_description'] ?></TEXTAREA></td></tr>
	<tr><td colspan="2" align="center">Мета тэг KEYWORDS:</td></tr>
	<tr><td><TEXTAREA NAME="new_keywords" ROWS="5" COLS="40"><?=$f['meta_keywords'] ?></TEXTAREA></td></tr>
	<tr><td colspan="2" align="center">Script: <select name="script"><?=dir_list('exec',$f['script']) ?></select></td></tr>
</table>
<input type="checkbox" name="new_intop" value="Y" <?=($f['top_menu']?'checked':'') ?> class="input_check"> Показывать в верхнем меню<br>
<input type="checkbox" name="new_show" value="Y" <?=($f['act']?'checked':'') ?> class="input_check"> Показать подраздел<br>

Содержание:<br>
<textarea id="content" name="content" style="width:600px;height:400px;" rows="20" cols="50">
                <?=$f['content']?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'content', {
					allowedContent: true,
					width: '70%',
					height: 500
				} );
            </script>



<input type="submit" name="edit" value="Изменить" class="button">

</form>

</body>

</html>

