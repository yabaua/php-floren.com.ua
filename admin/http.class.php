<?
class HTTP {
  var $user_agents=array(
    0=>array('user_agent'=>'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7', 'accept_language'=>'ru-ru,ru;q=0.5', 'accept'=>'text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5', 'accept_charset'=>'windows-1251,utf-8;q=0.7,*;q=0.7'),
    1=>array('user_agent'=>'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.8.0.1) Gecko/20060111 Firefox/1.5.0.1', 'accept_language'=>'ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3', 'accept'=>'text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5', 'accept_charset'=>'windows-1251,utf-8;q=0.7,*;q=0.7'),
    2=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; ru) Opera 8.50', 'accept_language'=>'ru,en;q=0.9', 'accept'=>'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-x', 'accept_charset'=>'windows-1251, utf-8, utf-16, iso-8859-1;q=0.6, *;q=0.1'),
    3=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; ru) Opera 8.50', 'accept_language'=>'ru, en', 'accept'=>'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-x', 'accept_charset'=>'windows-1251, utf-8, utf-16, iso-8859-1;q=0.6, *;q=0.1'),
    4=>array('user_agent'=>'Mozilla/5.0 (Windows; U; Windows NT 5.0; ru; rv:1.8.0.1) Gecko/20060111 Firefox/1.5.0.1', 'accept_language'=>'ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3', 'accept'=>'text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5', 'accept_charset'=>'windows-1251,utf-8;q=0.7,*;q=0.7'),
    5=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)', 'accept_language'=>'ru', 'accept'=>'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/msword, application/vnd.ms-powerpoint, */*', 'accept_charset'=>''),
    6=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)', 'accept_language'=>'ru', 'accept'=>'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/msword, application/vnd.ms-powerpoint, */*', 'accept_charset'=>''),
    7=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)', 'accept_language'=>'ru', 'accept'=>'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/vnd.ms-excel, application/msword, application/vnd.ms-powerpoint, */*', 'accept_charset'=>''),
    8=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0) Opera 7.23 [ru]', 'accept_language'=>'ru;q=1.0,en;q=0.9,uk;q=0.8', 'accept'=>'text/html, application/xml;q=0.9, application/xhtml+xml;q=0.9, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1', 'accept_charset'=>'koi8-u, utf-8, utf-16, iso-8859-1;q=0.6, *;q=0.1'),
    9=>array('user_agent'=>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; ru) Opera 8.52', 'accept_language'=>'ru, en', 'accept'=>'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-x', 'accept_charset'=>'windows-1251, utf-8, utf-16, iso-8859-1;q=0.6, *;q=0.1')

    );
  var $session=array();
  var $content=array();
  var $start_time;
  var $end_time;

  function myrand() {
    mt_srand((double)microtime()*100000000);
    return mt_rand(0,1000000)/1000000;
  }

  function gen_id() {
    mt_srand((double)microtime()*1000000);
    return md5(uniqid(mt_rand(0,(double)microtime()*1000000)));
  }

  function timer_start() {
    $microtime=microtime();
    $microsecs=substr($microtime,2,8);
    $secs=substr($microtime,11);
    $this->start_time=$secs.'.'.$microsecs;
  }

  function timer_stop() {
    $microtime=microtime();
    $microsecs=substr($microtime,2,8);
    $secs=substr($microtime,11);
    $this->end_time=$secs.'.'.$microsecs;
    $total=$this->end_time-$this->start_time;
    return round($total,3);
  }

  function start() {
    $id=$this->gen_id();
    $uagent=$this->user_agents[floor(count($this->user_agents)*$this->myrand())];
    $this->session[$id]=array('referrer'=>'', 'user_agent'=>$uagent['user_agent'], 'accept_language'=>$uagent['accept_language'], 'accept'=>$uagent['accept'], 'accept_charset'=>$uagent['accept_charset'], 'cookies'=>array());
    return $id;
  }

  function get($session,$url,$referrer='') {
    if (isset($this->session[$session])) {
      if (!$referrer) $referrer=$this->session[$session]['referrer'];
      $text=$this->get_page($session,$url,$referrer);
      $this->session[$session]['referrer']=$url;
      return $text;
    } else {
      return '';
    }
  }

  function post($session,$url,$referrer='',$post_data) {
    if (isset($this->session[$session])) {
      if (!$referrer) $referrer=$this->session[$session]['referrer'];
      $text=$this->get_page($session,$url,$referrer,1,$post_data);
      $this->session[$session]['referrer']=$url;
      return $text;
    } else {
      return '';
    }
  }

  function get_status($session) {
    return $this->session[$session];
  }

  function end_sess($session) {
    unset($this->session[$session]);
  }

  function get_page($session,$url,$referrer,$post=0,$post_data=array()) {
    $text='';
    $this->session[$session]['headers']=array();
    if (!eregi('^http://',$url)) $url='http://'.$url;
    $h=parse_url($url);
    $host=$h['host'];
    if (isset($h['port']) && $h['port']) $port=$h['port'];
      else $port=80;
    $errno=$errstr='';

    if ($post) {
      $PostData='';
      if (is_array($post_data)) {
        $PostData=array();
        foreach ($post_data AS $key=>$val) $PostData[]=$key.'='.urlencode($val);
        $PostData=implode('&',$PostData);
      } else {
        $PostData=urlencode($post_data);
      }
      $len=strlen($PostData);
    }

    $this->timer_start();
    @$f=fsockopen($host,$port,$errno,$errstr,15);
    if ($f) {
      $nn="\r\n";
      $headers="Host: ".$host.$nn;
      if ($this->session[$session]['referrer']) $headers.="Referer: ".$this->session[$session]['referrer'].$nn;
      if ($post) {
        $headers.='Content-Type: application/x-www-form-urlencoded'.$nn;
        $headers.='Content-Length: '.$len.$nn;
      }
      // $headers.='Connection: Keep-Alive'.$nn;
      $headers.='User-Agent: '.$this->session[$session]['user_agent'].$nn;
      $headers.='Accept: '.$this->session[$session]['accept'].$nn;
      $headers.='Accept-Language: '.$this->session[$session]['accept_language'].$nn;
      if ($this->session[$session]['accept_charset']) $headers.='Accept-Charset: '.$this->session[$session]['accept_charset'].$nn;
      if (!isset($h['path']) || !$h['path']) $h['path']='/';
      if (count($this->session[$session]['cookies'])) {
        $cookie_temp=array();
        foreach ($this->session[$session]['cookies'] AS $name=>$cookie) {
          if (is_array($cookie)) {
            if (ereg('^'.$cookie['path'],$h['path']) && (!isset($cookie['expires']) || $cookie['expires']>time()) && (!isset($cookie['domain']) || ereg($cookie['domain'].'$',$host))) {
              $cookie_temp[]=$name.'='.urlencode($cookie['value']);
            }
          } else {
            $cookie_temp[]=$name.'='.urlencode($cookie);
          }
        }
        if (count($cookie_temp)) $headers.="Cookie: ".implode('; ',$cookie_temp).$nn;
      }
      if ($post) {
        $headers.=''.$nn;
        $headers.=$PostData;
      }
      $this->session[$session]['request_headers']=$headers;

      if (isset($h['query']) && $h['query']) $h['query']='?'.$h['query'];
        else $h['query']='';
      if ($post) {
        $query='POST '.$h['path'].$h['query']." HTTP/1.0\n".$headers.$nn;
      } else {
        $query='GET '.$h['path'].$h['query']." HTTP/1.0\n".$headers.$nn;
      }
      fputs($f,$query);
      while ($temp=trim(fgets($f,1000))) $this->session[$session]['headers'][]=$temp;
      $total=0;
      foreach ($this->session[$session]['headers'] AS $val) {
        if (eregi('^http/([0-1.]{3})[[:space:]]*([0-9]{3})',$val,$out)) {
          $this->session[$session]['headers']['protocol']=$out[1];
          $this->session[$session]['headers']['status']=$out[2];
        }
        if (eregi('^Set-Cookie:[[:space:]]*(.+)',$val,$out)) {
          $cookie=explode(';',$out[1]);
          if (count($cookie)==1 && ereg('[[:space:]]*([^=]+)=(.+)[[:space:]]*',$cookie[0],$o)) {
            $this->session[$session]['cookies'][$o[1]]=urldecode($o[2]);
          } else {
            $first=1;
            foreach ($cookie AS $c) {
              if (!ereg('[[:space:]]*([^=]+)=(.+)[[:space:]]*',$c,$o)) continue;
              if ($first) {
                $first=0;
                $c_name=$o[1];
                $this->session[$session]['cookies'][$o[1]]['value']=urldecode($o[2]);
              } else {
                if (eregi('expires',$o[1])) {
                  $this->session[$session]['cookies'][$c_name][$o[1]]=strtotime($o[2]);
                } else {
                  $this->session[$session]['cookies'][$c_name][$o[1]]=$o[2];
                }
              }
            }
          }
        }
        if (eregi('^Server:[[:space:]]*(.+)',$val,$out)) $this->session[$session]['headers']['server']=$out[1];
        if (eregi('^Date:[[:space:]]*(.+)',$val,$out)) $this->session[$session]['headers']['date']=strtotime($out[1]);
        if (eregi('^Content-Type:[[:space:]]*([a-z/]+)',$val,$out)) $this->session[$session]['headers']['content_type']=$out[1];
        if (eregi('^Content-Type:.*charset=([a-z0-9-]+)',$val,$out)) $this->session[$session]['headers']['charset']=strtolower($out[1]);
        if (eregi('^Expires:[[:space:]]*(.+)',$val,$out)) $this->session[$session]['headers']['expires']=strtotime($out[1]);
        if (eregi('^Last-Modified:[[:space:]]*(.+)',$val,$out)) $this->session[$session]['headers']['last_modified']=strtotime($out[1]);
        if (eregi('^Content-Length:[[:space:]]*([0-9]+)',$val,$out)) $total=$out[1];
        if (eregi('^Location:[[:space:]]*(.+)',$val,$out)) $this->session[$session]['headers']['location']=$out[1];
      }
      if ($total) {
        while (strlen($text)!=$total) {
          $text.=fread($f,10000);
        }
      } else {
        $k=1;
        while (!feof($f) && strlen($k)) {
          $k=fread($f,10000);
          $text.=$k;
        }
      }
      fclose($f);
      $this->session[$session]['time']=$this->timer_stop();
    } else {
      $this->session[$session]['errno']=$errno;
      $this->session[$session]['errstr']=$errstr;
    }
    $this->session[$session]['size']=strlen($text);
    $this->content=$text;
    return $text;  
  }
}

?>