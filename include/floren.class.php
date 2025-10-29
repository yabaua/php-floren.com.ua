<?php
class florenClass {
	var $db_filepath='include/db_mysql.php';
	var $db;
	var $from_e_mail='Флорен <info@floren.com.ua>';
	var $project_hosts=array('floren.com.ua','www.floren.com.ua');
	
	var $profile=array();
	var $is_login=0;
	var $cookie_name='floren';
		var $tpl;
		var $templater_name='smarty/Smarty.class.php';
		var $templater_base_path='smarty/';
		var $templates_path='templates';
		var $templates_mail_path='mail/';
		var $template_confirm='user_confirm.htm';
		var $template_send_pass='user_send_pass.htm';
	

	
	function send_email($e_mail,$subject,$body, $megaplan_cc='', $megaplan_from='') {
		global $_SERVER;
		
	//	if($_SERVER["SERVER_NAME"]=="www.floren.com.ua"){
			//$e_mail='Dmitriy.Zhinzhikov@gmail.com';
			
			
			
			$nn="\n";

			if($megaplan_from!=''){
				$from=$megaplan_from;
			}else{
				$from=$this->from_e_mail;
			}
			if($megaplan_cc!=''){
				$cc='Cc: '.$megaplan_cc.$nn;
			}else{
				$cc='';
			}

		    $subject='=?windows-1251?B?'.base64_encode($subject).'?=';
		    $result=mail($e_mail,$subject,$body,
		        'Date: '.date('r').$nn.
		        'From: '.$from.$nn.
				$cc.
		        'Reply-To: '.$from.$nn.
		        'X-Priority: 3 (Normal)'.$nn.
		        //'To: '.$e_mail.$nn.
		        'MIME-Version: 1.0'.$nn.
		        'Content-Type: text/html; charset="windows-1251"'.$nn.
		        'Content-Transfer-Encoding: 8bit'
		     );
		     return $result;
	//	}
	}
	function send_format_email($e_mails,$subject,$template,$params=array()) {
	
		foreach ($params AS $var=>$val) $this->tpl->assign($var, $val);
		
		$letter=$this->tpl->fetch($this->templates_mail_path.$template);
		
		if (!is_array($e_mails)) $e_mails=explode(',',$e_mails);
		foreach ($e_mails AS $e_mail) if ($this->check_e_mail($e_mail)) $result=$this->send_email($e_mail,$subject,$letter);
		
		return $result;
	}
	function confirm_one_by_email($e_mail) {
		/*
		global $_SERVER;
		
		if (!$this->check_e_mail($e_mail)) return -1;
		$this->db->query("SELECT ID,e_mail,login,fio,password,md5_confirm FROM users WHERE e_mail='$e_mail'");
		if (!$this->db->num_rows()) return -2;
		$f=$this->db->fetch();
		
		$this->tpl->assign('ID', $f['ID']);
		$this->tpl->assign('FIO', $f['fio']);
		$this->tpl->assign('LOGIN', $f['login']);
		$this->tpl->assign('E_MAIL', $f['e_mail']);
		$this->tpl->assign('PASSWORD', $f['password']);
		$this->tpl->assign('CODE', $f['md5_confirm']);
		$this->tpl->assign('HOST', $_SERVER['SERVER_NAME']);
		
		$letter=$this->tpl->fetch($this->templates_mail_path.'user_confirm.htm');
		
		$this->send_email('info@floren.com.ua','[floren] Активация учётной записи на сайте floren.com.ua',$letter);
		
		return $this->send_email($f['e_mail'],'[floren] Активация учётной записи на сайте floren.com.ua',$letter);
		*/
		RETURN TRUE;
	}
	function send_pass($login='',$e_mail='') {
		if (!$this->check_e_mail($e_mail)) return 0;
		$this->db->query("SELECT e_mail,fio,password FROM users WHERE e_mail='$e_mail'");
		
		if (!($f=$this->db->fetch())) return -1;
		
		$this->tpl->assign(array('NAME'=>$f['fio'], 'E_MAIL'=>$f['e_mail'], 'PASSWORD'=>$f['password'], 'HOST'=>$_SERVER['SERVER_NAME']));
		$letter=$this->tpl->fetch($this->templates_mail_path.'user_send_pass.htm');
		$this->send_email('Dmitriy.Zhinzhikov@gmail.com','floren.com.ua Напоминание пароля для сайта',$letter);
		$result1=$this->send_email($f['e_mail'],'floren.com.ua Напоминание пароля для сайта',$letter);
		
		return ($result1);
	}
	function show_common_goods(){
		$goods=array(1=>array('name'=>'xxx', 'price'=>'eee'), 2=>array('name'=>'xxx2', 'price'=>'eee2'));
		$this->tpl->assign("COMMON_GOODS_FUNC", $goods);
		$lett=$this->tpl->fetch('mail/show_common_goods.htm');
		
		return $lett;
	}
	function check_userbyemail($e_mail) {
		if (!$this->check_e_mail($e_mail)) return 0;
		$this->db->query("SELECT ID FROM users WHERE e_mail='".$e_mail."'");
		return $this->db->num_rows();
	}
	function check_e_mail($e_mail) {
		$e_mail=strtolower($e_mail);
		$email_host=substr($e_mail,strpos($e_mail,'@')+1);
		return (preg_match('/^[a-z0-9\._-]{1,20}@[a-z0-9\._-]{1,}\.[a-z]{2,4}$/',$e_mail) && $this->checkdns($email_host,'MX'));
		//return ereg('^[a-z0-9\._-]{1,20}@[a-z0-9\._-]{1,}\.[a-z]{2,4}$',$e_mail);
	}
	function checkdns($host, $type='MX') {
		return true;
	}
	function check_pass($password) {
		$cp=$this->clear_pass($password);
		return ($cp==$password && strlen($password)>4);
	}
	function status() {
		return $this->is_login;
	}
	function profile($ID=0, $refresh=0) {
		if ($refresh) {
			if (!($ID=(int)$ID)) $ID=$this->profile['ID'];
			$this->db->query("SELECT * FROM users WHERE ID=$ID");
			$f=$this->db->fetch();
			$this->profile=$f;
		}
		return $this->profile;
	}
	function clear_pass($password) {
		$password=substr(preg_replace('/[^0-9a-zа-я~!@#%^*()_+=;:\[\]|,.>\/?-]/i','',$password),0,32);
		return $password;
	}
	function gen_id() {
		mt_srand((double)microtime()*1000000);
		$ID=md5(uniqid(mt_rand(0,(double)microtime()*1000000)));
		return $ID;
	}
	function gen_code() {
		//$ID=mt_srand((double)microtime()*1000000);
		$ID=mt_rand(100000,999999);
		return $ID;
	}
	function login_by_email($e_mail,$password) {
		global $_SERVER,$_SESSION;
		
		$password=$this->clear_pass($password);
		if (!$this->check_e_mail($e_mail)) return -1;
		if (!$password) return -2;
		
		$e_mail=strtolower($e_mail);
			
		$this->db->query("SELECT ID, e_mail, fio, address, phone, no_counter FROM users WHERE e_mail='".$e_mail."' AND password='".$password."'");
		if (!$this->db->num_rows()) return -3;
		$ff=$this->db->fetch();
		$_SESSION['user']=$ff;
		$this->profile=$ff;
		$this->is_login=1;
		
		return 1;
	}
	function logout() {
		$this->is_login=0;
		$this->profile=array();
		unset($_SESSION['user']);
	}
}
?>