<?

/*====== JUST COMMENTED BECAUSE too mmany files use this code
	$html_header = "MIME-Version: 1.0\r\n";
	$html_header .= "Content-type: text/html; charset=utf-8\r\n";
	$html_header .= "From:  Флорен <info@floren.com.ua>\r\n";
	
	if (isset($_REQUEST['ref'])) $ref=$_REQUEST['ref'];
	//	echo "cxx";
	ob_start();
	echo date("d/m/Y h:i:s").'<BR>';
	echo "REQUEST_URI:&nbsp;&nbsp;".$_SERVER['REQUEST_URI'].'<BR>';
	echo "HTTP_REFERER:&nbsp;&nbsp;".$_SERVER['HTTP_REFERER'].'<BR>';
	echo "HTTP_USER_AGENT:&nbsp;&nbsp;".$_SERVER['HTTP_USER_AGENT'].'<BR>';
	echo "HTTP_FROM:&nbsp;&nbsp;".$_SERVER['HTTP_FROM'].'<BR>';
	echo "REF:&nbsp;&nbsp;".$ref;
	
	echo '<FONT COLOR="#FF0000">'.$db->error().'<BR>'.htmlspecialchars($sql).'</FONT><BR>';
	echo '<BR><BR>=======<BR><BR>';
	echo 'GET<PRE>';
		print_r($_GET);
	echo '</PRE>';
	
	echo '<BR><BR>=======<BR><BR>';
	echo 'POST<PRE>';
	print_r($_POST);
	echo '</PRE>';
	
	echo '<BR><BR>=======<BR><BR>';
	echo 'COOKIE<PRE>';
	print_r($_COOKIE);
	echo '</PRE>';
	
	echo '<BR><BR>=======<BR><BR>';
	echo 'SERVER<PRE>';
	print_r($_SERVER);
	echo '</PRE>';
	echo '<BR><BR>=======<BR><BR>';
	
	//phpinfo();
	$text=ob_get_contents();
	ob_end_clean();
	@mail('info@floren.com.ua', 'Редирект 301', $text, $html_header);
	*/

?>