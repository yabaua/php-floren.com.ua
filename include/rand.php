<?

function myrand() {
  //mt_srand((double)microtime()*100000000);
  return mt_rand(0,1000000)/1000000;
}

function gen_pass($mode,$num) {
  // mode 1 - with specialchars
  // mode 2 - without specialchars
  // num - num chars
  $pass='';
  if ($mode==1) {
    for ($i=0;$i<$num;$i++) {
      $pass.=chr(myrand()*91+35);
    }
  } else {
    $sim=array('A','B','C','D','E','F','a','b','c','d','e','f','g','M','N','O','P','Q','R','S','h','i','j','k','l','m','1','2','3','4','5','6','7','8','9','n','o','p','q','r','s','t','u','v','w','x','y','z','G','H','I','J','K','L','T','U','V','W','X','Y','Z');
    for ($i=0;$i<$num;$i++) {
      $n=floor(myrand()*61);
      $pass.=$sim[$n];
    }
  }
  return $pass;
}

function make_seed() {
  list($usec,$sec)=explode(' ',microtime());
  return (float)$sec+((float)$usec*100000);
}
mt_srand(make_seed());

?>