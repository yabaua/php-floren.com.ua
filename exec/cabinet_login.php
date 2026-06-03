<?php
$alowed_urls=array('', 'registration', 'forgot');
if((isset($URL[1]) && !in_array($URL[1], $alowed_urls)) OR isset($URL[2])){
	header("location:".$lang_url."/login/");
	exit();
}


// ====================== login form ========================
if (isset($_REQUEST['action_type']) && $_REQUEST['action_type']=="login") {
	if(isset($_REQUEST['email']) && isset($_REQUEST['pass'])){
		$email=preg_replace('/[^0-9a-zA-Z_@.]/','',$_REQUEST['email']);
		$pass=md5($_REQUEST['pass']);
		$db->query("INSERT INTO users_login_attempt SET type='login', email='".$email."', IP='".$_SESSION['IP']."', lastvisit='".time()."'");
		if ($email) {
			$db->query("SELECT * FROM users WHERE email='".$email."' AND pass='".$pass."'");
	    	if ($db->num_rows()) {
				$rs=$db->fetch();
				$_SESSION['userID']=$rs['ID'];
					$db->query("INSERT INTO users_log SET email='".$rs['ID']."', lastvisit='".time()."'");	
					$db->query("DELETE FROM users_login_attempt WHERE type='login' AND email='".$email."'");	
	        		header("location:".$lang_url."/cabinet/");
	    	}
		}	//email > ''
	}	// action_type
}


// ====================== register form ========================
if (isset($_REQUEST['action_type']) && $_REQUEST['action_type']=="registration") {
	if (isset($_REQUEST['email']) && isset($_REQUEST['pass'])) {
		$email	=preg_replace('/[^0-9a-zA-Z_@.]/','',$_REQUEST['email']);
		$pass	=md5($_REQUEST['pass']);
		$pass2	=md5($_REQUEST['pass2']);
		
		$fio=str_replace("'", "&#700;", $_POST['fio']);
		
		$tmp_phone=preg_replace('/[^0-9]/','',$_REQUEST['phone']);
		$phone=substr($tmp_phone, -9);
		
		if($pass!=$pass2){
			header("location:".$lang_url."/login/registration/?email=".$email."&e18");
			exit();
		}
		$db->query("SELECT * FROM users WHERE email='".$email."'");
		if($db->num_rows()){
				header("location:".$lang_url."/login/registration/?email=".$email."&e31");
				exit();
		}
		
		
		$db->query("INSERT INTO users_login_attempt SET type='register', email='".$email."', IP='".$_SESSION['IP']."', lastvisit='".time()."'");
		if ($email && $pass==$pass2) {
			$db->query("INSERT INTO users SET email='".$email."', pass='".$pass."', phone='".$phone."', fio='".$fio."'");
			
			
			$db->query("SELECT * FROM users WHERE email='".$email."' AND pass='".$pass."'");
	    	if ($db->num_rows()) {
				$rs=$db->fetch();
				$_SESSION['userID']=$rs['ID'];
					$db->query("DELETE FROM users_login_attempt WHERE type='register' AND email='".$email."'");
					$db->query("INSERT INTO users_log SET email='".$rs['ID']."', lastvisit='".time()."'");	
	        		header("location:/cabinet/");
	    	}
		}
	}
}

//come back data
if(isset($_REQUEST['email'])) $smarty->assign('email',$_REQUEST['email']);
if(isset($_REQUEST['fio'])) $smarty->assign('fio',$_REQUEST['fio']);

$smarty->assign("META_NOFOLLOW",'<meta name="robots" content="noindex, nofollow">');
$smarty->assign("CONTENT_TPL",'cabinet_login.tpl');

?>