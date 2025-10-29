<?

function strup($text) {
  $text=strtr($text, "������������������������������������abcdefghijklmnopqrstuvwxyz", "���������Ũ��������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ");
  return $text;
}

function strlow($text) {
  $text=strtr($text, "���������Ũ��������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ", "������������������������������������abcdefghijklmnopqrstuvwxyz");
  return $text;
}

function strfup($text) {
  $text=strup(substr($text,0,1)).strlow(substr($text,1));
  return $text;
}

function str_clear($text) {
  $text=trim(ereg_replace('[^a-zA-Z�-��-�0-9�*� \x20-]','',$text));
  return $text;
}

function trim_glas($word) {
  if (preg_match('/(��|��|��|��|��|��|��|��|��|��|��|��|��|��|��|��|��)$/',$word)) $word=substr($word,0,strlen($word)-2);
  if (preg_match('/(�|�|�|�|�|�|�|�|�|�|�)$/',$word)) $word=substr($word,0,strlen($word)-1);
  return $word;
}

function symbols($text) {
  $text=ereg_replace('<[^>]*>',' ',$text);
  $text=trim(ereg_replace('[[:space:]]{1,}',' ',$text));
  return strlen($text);
}

function totranslit($text) {
  $text=trim(ereg_replace('[^a-zA-Z�-��-�0-9������]',' ',$text));
  $text=ereg_replace('[[:space:]]{1,}',' ',strtolower($text));
  $text=str_replace(' ','-',$text);

  $search=array('/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/','/�/');
  $replace=array('a','a','b','b','v','v','g','g','d','d','e','e','jo','jo','zh','zh','z','z','i','i','j','j','k','k','l','l','m','m','n','n','o','o','p','p','r','r','s','s','t','t','u','u','f','f','kh','kh','ts','ts','ch','ch','sh','sh','sc','sc','_','_','y','y',"_","_",'e','e','ju','ju','ja','ja','i','i','i','i','e','e');
  $text=preg_replace($search,$replace,$text);
  return $text;
}

function translit($text) {
  $table_rus=array('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�');
  $table_en=array('a','a','b','b','v','v','g','g','d','d','e','e','jo','jo','zh','zh','z','z','i','i','j','j','k','k','l','l','m','m','n','n','o','o','p','p','r','r','s','s','t','t','u','u','f','f','kh','kh','ts','ts','ch','ch','sh','sh','sc','sc','_','_','y','y',"_","_",'e','e','ju','ju','ja','ja');
  $table_trans=array();
  for ($i=0;$i<count($table_rus);$i++) {
    $table_trans[$table_rus[$i]]=$table_en[$i];
  }
  $out='';
  for ($i=0;$i<strlen($text);$i++) {
    if (isset($table_trans[substr($text,$i,1)])) $out.=$table_trans[substr($text,$i,1)];
      else $out.=substr($text,$i,1);
  }
  return $out;
}

function transliterate($st) {
	$st_=strtolower($st);
	$st_=str_replace('�', '', str_replace('�', '', $st_));
	$st_ = strtr($st_, array( 
		"�"=>'yo',	  "�"=>'zh',  "�"=>'c',  "�"=>'ch', "�"=>'sh',
		"�"=>'sch',  "�"=>'yu', "�"=>'ya',
		
		"�"=>'yo',	  "�"=>'zh',  "�"=>'c',  "�"=>'ch', "�"=>'sh',
		"�"=>'sch',  "�"=>'yu', "�"=>'ya',
	)); 
	$st_ = strtr($st_,  
		"����������������������������������������������",
		"abvgdeziyklmnoprstufhieabvgdeziyklmnoprstufhie"
	);
	$st_=preg_replace("/[^0-9a-z _ - ]/","",$st_);
	$st_=str_replace("quot", "", $st_);
	return substr(str_replace(' ', '-',$st_), 0, 50); 
}

function parse_tag_name($name) {
  $name=translit($name);
  $name=ereg_replace('[^0-9a-zA-Z_.]+','-',$name);
  return $name;
}

function parse_img_name($name) {
  $name=translit($name);
  $name=ereg_replace('[^0-9a-zA-Z_.]','',$name);
  return $name;
}

function parse_img_name_md5($name,$id='') {
  mt_srand((double)microtime()*100000000);
  $name=($id!=''?$id:substr(md5(mt_rand(0,1000000)/1000000),0,15)).strtolower(substr($name,strrpos($name,'.')));
  return $name;
}

$months_list=array('', "������", "�������", "����", "������", "���", "����", "����", "������", "��������", "�������", "������", "�������");
$months2_list=array('', "������", "�������", "�����", "������", "���", "����", "����", "�������", "��������", "�������", "������", "�������");

function correct_CAPS($text){
    $text = strtolower($text);
	//$text=strtr($text, "���������Ũ��������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ", "������������������������������������abcdefghijklmnopqrstuvwxyz");
    //������� ���� ������
    preg_match_all('/www\..{3,40}.(com|ru|su|net|info|biz|��|)/',$text,$site);
    $site = $site[0];
    $site = $site[0];
    //�������� �������� �����, ���������� || ������ .
    $protected = str_replace('.','||',$site);
    $text = str_replace($site,$protected,$text);

    $array = explode('.',$text);
    $text = array();
    foreach ($array as $offer) $text[] = ucfirst($offer);
    $text = implode('.',$text);

    $array = explode('!',$text);
    $text = array();
    foreach ($array as $offer) $text[] = ucfirst($offer);
    $text = implode('!',$text);

    //������� ��� �����������, ��� ����� ����� ��� ��������
    preg_match_all('/\.[A-z�-�0-9]/',$text,$array);
    $array = $array[0];
    //echo '����� ������: <br>';
    //print_r($array);
    //echo '<br>';
    foreach ($array as $value){
        $sub_array = explode('.',$value);
        $sub_value = str_replace($sub_array[0],'. ',$sub_array[0]);
        $text = str_replace($value,implode('',$sub_array),$text);
    }

    //������� ��� �����������, ��� �� ����� ������� ����� �������������� ������
    preg_match_all('/\![A-z�-�0-9]/',$text,$array);
    $array = $array[0];
    //echo '����� ������: <br>';
    //print_r($array);
    //echo '<br>';
    foreach ($array as $value){
        //echo "����� � �������: $value<br>";
        $sub_array = explode('!',$value);
        //echo '��������� ����� � �������<br>';
        //echo print_r($sub_array);
        //echo "<br>";
        $sub_array[0] = '! ';
        $text = str_replace($value,implode('',$sub_array),$text);
    }

    //������������ �����, ������� �� ����� ������
    preg_match_all('/\n[A-z�-�0-9]/',$text,$array);
    $array = $array[0];
    foreach ($array as $value){
        $sub_array = explode("\n",$value);
        $sub_array[1] = ucfirst($sub_array[1]);
        $text = str_replace($value,implode('',$sub_array),$text);
    }

    //��������������� �������� �����
    $text = str_replace('||','.',$text);
    return $text;
}
function replace_quote($str){
	$str=str_replace("'", "&rsquo;", $str);
	$str=str_replace('"', '&quot;', $str);
	return $str;
}
?>