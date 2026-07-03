<?
require("auth.php");
require("../include/strlib.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!isset($_REQUEST['ID'])){
	header("location: goods_filters.php");
	exit();
}else
	$ID=$_REQUEST['ID'];
	
	
if (isset($_REQUEST['edit_seo'])) {
		$db->query("UPDATE goods_filters_meta SET
		name='".trim($_REQUEST['name'])."',
		page_title='".trim($_REQUEST['page_title'])."',
		meta_title='".$_REQUEST['meta_title']."',
		meta_description='".$_REQUEST['meta_description']."',
		meta_keywords='".$_REQUEST['meta_keywords']."',
		leftSEOtext='".addslashes($_REQUEST['leftSEOtext'])."',
		topSEOtext='".addslashes($_REQUEST['topSEOtext'])."',
		centerSEOtext='".addslashes($_REQUEST['centerSEOtext'])."',
		name_ua='".trim($_REQUEST['name_ua'])."',
		page_title_ua='".trim($_REQUEST['page_title_ua'])."',
		meta_title_ua='".$_REQUEST['meta_title_ua']."',
		meta_description_ua='".$_REQUEST['meta_description_ua']."',
		meta_keywords_ua='".$_REQUEST['meta_keywords_ua']."',
		leftSEOtext_ua='".addslashes($_REQUEST['leftSEOtext_ua'])."',
		topSEOtext_ua='".addslashes($_REQUEST['topSEOtext_ua'])."',
		centerSEOtext_ua='".addslashes($_REQUEST['centerSEOtext_ua'])."'
		 WHERE ID=".$ID);
		header("location: goods_filters_seo.php?ID=".$ID);
}	
	
?>
<html><head>
<link rel="stylesheet" type="text/css" href="style_back.css?v=2">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="/admin/ckeditor/ckeditor.js"></script>
</head>
<body style="margin-left:20px;">

<?
//============================

include("top_menu.php");

//============================
?>

<h3>SEO для фильтров товаров</h3>
<form action="goods_filters_seo.php?ID=<?=$ID?>" method="post">
<br /><br />

<?
	$db->query("SELECT * FROM goods_filters_meta WHERE ID='".$ID."'");
	$rs=$db->fetch();
?>
<h1><?=$rs['alias']?></h1>
<br /><br />
<input type="submit" name="edit_seo" value="Обновить" class="button">
<table class="tbl_no_border" cellpadding="2" cellspacing="0">
	<tr>
		<td>
			<b>Название:</b><br />
			<input type="text" name="name" class="input_type" style="width:550px;" value="<?=$rs['name']?>" />
		</td>
		<td>
			<b>Название УА:</b><br />
			<input type="text" name="name_ua" class="input_type" style="width:550px;" value="<?=$rs['name_ua']?>" />
		</td>
	</tr>
	<tr>
		<td>
			<b>Page Title:</b><br />
			<input type="text" name="page_title" class="input_type" style="width:550px;" value="<?=$rs['page_title']?>" />
		</td>
		<td>
			<b>Page Title УА:</b><br />
			<input type="text" name="page_title_ua" class="input_type" style="width:550px;" value="<?=$rs['page_title_ua']?>" />
		</td>
	</tr>
	<tr>
		<td>
			<h3>META Title:</h3>
			<textarea name="meta_title" style="width:550px;height:50px;"><?=$rs['meta_title']?></textarea>
		</td>
		<td>
			<h3>META Title UA:</h3>
			<textarea name="meta_title_ua" style="width:550px;height:50px;"><?=$rs['meta_title_ua']?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<h3>META Description:</h3>
			<textarea name="meta_description" style="width:550px;height:50px;"><?=$rs['meta_description']?></textarea>
		</td>
		<td>
			<h3>META Description UA:</h3>
			<textarea name="meta_description_ua" style="width:550px;height:50px;"><?=$rs['meta_description_ua']?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<h3>META Keywords:</h3>
			<textarea name="meta_keywords" style="width:550px;height:50px;"><?=$rs['meta_keywords']?></textarea>
		</td>
		<td>
			<h3>META Keywords:</h3>
			<textarea name="meta_keywords_ua" style="width:550px;height:50px;"><?=$rs['meta_keywords_ua']?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<h3>leftSEOtext:</h3>
			<textarea name="leftSEOtext" style="width:550px;height:50px;"><?echo $rs['leftSEOtext']?></textarea>
          </td>
           <td>
			<h3>leftSEOtext УА:</h3>
			<textarea name="leftSEOtext_ua" style="width:550px;height:50px;"><?echo $rs['leftSEOtext_ua']?></textarea>
          </td>
	</tr>
	<tr>
		<td>
			<h3>Текст под заголовком:</h3>
			<textarea id="topSEOtext" name="topSEOtext" style="width:550px;height:200px;" rows="20" cols="50">
                <?echo $rs['topSEOtext']?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'topSEOtext', {
					allowedContent: true,
					width: '550px',
					height: 200
				} );
            </script>
		</td>
		<td>
			<h3>Текст под заголовком:</h3>
			<textarea id="topSEOtext_ua" name="topSEOtext_ua" style="width:550px;height:200px;" rows="20" cols="50">
                <?echo $rs['topSEOtext_ua']?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'topSEOtext_ua', {
					allowedContent: true,
					width: '550px',
					height: 200
				} );
            </script>
		</td>
	</tr>
	<tr>
		<td>
			<h3>Текст в центр:</h3>
			<textarea id="centerSEOtext" name="centerSEOtext" style="width:550px;height:200px;" rows="20" cols="50">
                <?echo $rs['centerSEOtext']?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'centerSEOtext', {
					allowedContent: true,
					width: '550px',
					height: 200
				} );
            </script>
		</td>
		<td>
			<h3>Текст в центр УА:</h3>
			<textarea id="centerSEOtext_ua" name="centerSEOtext_ua" style="width:550px;height:200px;" rows="20" cols="50">
                <?echo $rs['centerSEOtext_ua']?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'centerSEOtext_ua', {
					allowedContent: true,
					width: '550px',
					height: 200
				} );
            </script>
		</td>		
	</tr>
</table>
<input type="submit" name="edit_seo" value="Обновить" class="button">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>