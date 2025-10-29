<?

function strup($text) {
  $text=strtr($text, "ґєіїабвгдеёжзийклмнопрстуфхцчшщьыъэюяabcdefghijklmnopqrstuvwxyz", "ҐЄІЇАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ");
  return $text;
}

function strlow($text) {
  $text=strtr($text, "ҐЄІЇАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ", "ґєіїабвгдеёжзийклмнопрстуфхцчшщьыъэюяabcdefghijklmnopqrstuvwxyz");
  return $text;
}

function strfup($text) {
  $text=strup(substr($text,0,1)).strlow(substr($text,1));
  return $text;
}

function str_clear($text) {
  $text=trim(ereg_replace('[^a-zA-Zа-яА-Я0-9®*™ \x20-]','',$text));
  return $text;
}

function trim_glas($word) {
  if (preg_match('/(ие|ия|ем|им|ию|ий|ии|ой|ов|ам|их|ый|ых|ая|ай|ае|ую)$/',$word)) $word=substr($word,0,strlen($word)-2);
  if (preg_match('/(а|е|и|й|о|у|ь|ы|э|ю|я)$/',$word)) $word=substr($word,0,strlen($word)-1);
  return $word;
}

function symbols($text) {
  $text=ereg_replace('<[^>]*>',' ',$text);
  $text=trim(ereg_replace('[[:space:]]{1,}',' ',$text));
  return strlen($text);
}

function totranslit($text) {
  $text=trim(ereg_replace('[^a-zA-Zа-яА-Я0-9іІїЇєЄ]',' ',$text));
  $text=ereg_replace('[[:space:]]{1,}',' ',strtolower($text));
  $text=str_replace(' ','-',$text);

  $search=array('/а/','/А/','/б/','/Б/','/в/','/В/','/г/','/Г/','/д/','/Д/','/е/','/Е/','/ё/','/Ё/','/ж/','/Ж/','/з/','/З/','/и/','/И/','/й/','/Й/','/к/','/К/','/л/','/Л/','/м/','/М/','/н/','/Н/','/о/','/О/','/п/','/П/','/р/','/Р/','/с/','/С/','/т/','/Т/','/у/','/У/','/ф/','/Ф/','/х/','/Х/','/ц/','/Ц/','/ч/','/Ч/','/ш/','/Ш/','/щ/','/Щ/','/ъ/','/Ъ/','/ы/','/Ы/','/ь/','/Ь/','/э/','/Э/','/ю/','/Ю/','/я/','/Я/','/і/','/І/','/ї/','/Ї/','/є/','/Є/');
  $replace=array('a','a','b','b','v','v','g','g','d','d','e','e','jo','jo','zh','zh','z','z','i','i','j','j','k','k','l','l','m','m','n','n','o','o','p','p','r','r','s','s','t','t','u','u','f','f','kh','kh','ts','ts','ch','ch','sh','sh','sc','sc','_','_','y','y',"_","_",'e','e','ju','ju','ja','ja','i','i','i','i','e','e');
  $text=preg_replace($search,$replace,$text);
  return $text;
}

function translit($text) {
  $table_rus=array('а','А','б','Б','в','В','г','Г','д','Д','е','Е','ё','Ё','ж','Ж','з','З','и','И','й','Й','к','К','л','Л','м','М','н','Н','о','О','п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','ч','Ч','ш','Ш','щ','Щ','ъ','Ъ','ы','Ы','ь','Ь','э','Э','ю','Ю','я','Я');
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
	$st_=str_replace('ь', '', str_replace('ъ', '', $st_));
	$st_ = strtr($st_, array( 
		"ё"=>'yo',	  "ж"=>'zh',  "ц"=>'c',  "ч"=>'ch', "ш"=>'sh',
		"щ"=>'sch',  "ю"=>'yu', "я"=>'ya',
		
		"Ё"=>'yo',	  "Ж"=>'zh',  "Ц"=>'c',  "Ч"=>'ch', "Ш"=>'sh',
		"Щ"=>'sch',  "Ю"=>'yu', "Я"=>'ya',
	)); 
	$st_ = strtr($st_,  
		"абвгдезийклмнопрстуфхыэАБВГДЕЗИЙКЛМНОПРСТУФХЫЭ",
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

$months_list=array('', "январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь");
$months2_list=array('', "января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");

function correct_CAPS($text){
    $text = strtolower($text);
	//$text=strtr($text, "ҐЄІЇАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ", "ґєіїабвгдеёжзийклмнопрстуфхцчшщьыъэюяabcdefghijklmnopqrstuvwxyz");
    //находим урлы сайтов
    preg_match_all('/www\..{3,40}.(com|ru|su|net|info|biz|рф|)/',$text,$site);
    $site = $site[0];
    $site = $site[0];
    //защищаем название сайта, подставляя || вместо .
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

    //находим все предложения, где точки стоят без пробелов
    preg_match_all('/\.[A-zА-я0-9]/',$text,$array);
    $array = $array[0];
    //echo 'Нашли ошибки: <br>';
    //print_r($array);
    //echo '<br>';
    foreach ($array as $value){
        $sub_array = explode('.',$value);
        $sub_value = str_replace($sub_array[0],'. ',$sub_array[0]);
        $text = str_replace($value,implode('',$sub_array),$text);
    }

    //находим все предложения, где не стоит пробела перед вопросительным знаком
    preg_match_all('/\![A-zА-я0-9]/',$text,$array);
    $array = $array[0];
    //echo 'Нашли ошибки: <br>';
    //print_r($array);
    //echo '<br>';
    foreach ($array as $value){
        //echo "Слово с ошибкой: $value<br>";
        $sub_array = explode('!',$value);
        //echo 'Разбиваем слово с ошибкой<br>';
        //echo print_r($sub_array);
        //echo "<br>";
        $sub_array[0] = '! ';
        $text = str_replace($value,implode('',$sub_array),$text);
    }

    //обрабатываем слова, стоящие на новой строкн
    preg_match_all('/\n[A-zА-я0-9]/',$text,$array);
    $array = $array[0];
    foreach ($array as $value){
        $sub_array = explode("\n",$value);
        $sub_array[1] = ucfirst($sub_array[1]);
        $text = str_replace($value,implode('',$sub_array),$text);
    }

    //восстанавливаем название сайта
    $text = str_replace('||','.',$text);
    return $text;
}
function replace_quote($str){
	$str=str_replace("'", "&rsquo;", $str);
	$str=str_replace('"', '&quot;', $str);
	return $str;
}
?>