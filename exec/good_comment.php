<?php
// добавление комментария
if (isset($_POST['n_comment_add']) && isset($POST['n_good_message'])) {
	
	$good_comment_name=addslashes($POST['n_good_comment_name']);
	$good_comment_email=addslashes($POST['n_good_comment_email']);
	$vote=$POST['vote'];
	$pageID=(int)@$POST['pageID'];
	$pageType=$POST['pageType'];
	
	$message=addslashes($POST['n_good_message']);
	if(strlen($message)<1 || substr_count($message, 'http')>0){
		header('location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	
	if (isset($POST['subscribe'])) $subscribe='Y';
		else $subscribe='';
	$IP2=@$_SERVER['HTTP_X_FORWARDED_FOR'];
	$md5_del=md5(time());
    
	$db->query("INSERT INTO goods_voting SET
		pageID='".$pageID."',
		pageType='".$pageType."',
		vote='".$vote."',
		message='".$message."',
		u_name='".$good_comment_name."',
		u_email='".$good_comment_email."',
		IP='".$_SERVER['REMOTE_ADDR']."',
		IP2='".$IP2."',
		subscribe='".$subscribe."',
		md5_del='".$md5_del."',
		date_add=UNIX_TIMESTAMP()");
	$mess_id=$db->insert_id();
	
		if($pageType=="good"){
			$q="SELECT * FROM goods WHERE ID='".$pageID."'";
			$messHeader='Товар';
		}
		elseif($pageType=="goodCAT"){
			$q="SELECT * FROM goods_class WHERE ID='".$pageID."'";
			$messHeader='Категорія';
		}
		elseif($pageType=="service"){
			$q="SELECT * FROM services WHERE ID='".$pageID."'";
			$messHeader='Послуга';
		}
		else{}
		
		$db->query($q);
		$f_good=$db->fetch();
		$params=array(
			'ID'=>$mess_id,
			'GOOD'=>$messHeader.' '.($pageType=='service'?$f_good['title']:$f_good['name']),
			'LINK'=>$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
			'POST'=>$POST,
			'MD5_DEL'=>$md5_del
		);
		$floren->send_format_email('info@floren.com.ua','Відгук на '.$messHeader,'user_comment.htm',$params);
		$floren->send_format_email('shishko.irene@gmail.com','Відгук на '.$messHeader,'user_comment.htm',$params);
	$_SESSION['good_comment']=$pageType.$pageID;
	header('location: '.$_SERVER['REQUEST_URI'].'#comments');
	exit();
}
?>