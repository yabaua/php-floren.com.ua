<?php
function dir_list_rec($dir) {
  global $dirs;
  $dr=array();
  $d=dir($_SERVER['DOCUMENT_ROOT'].'/'.$dir);
  while (false!==($S=$d->read())) {
    $file=$_SERVER['DOCUMENT_ROOT'].'/'.$dir.'/'.$S;
    if ($S!='.' && $S!='..' && !preg_match('/[.]svn/',$S)) {
      if (is_file($file)) {
        $dirs[]=$dir.'/'.$S;
      }
      if (is_dir($file)) $dr[]=$dir.'/'.$S;
    }
  }
  $d->close();
  foreach ($dr AS $d) dir_list_rec($d);
}
function dir_list($dir,$active) {
  global $dirs;
  $out='<option value="">&nbsp;</option>';
  $dirs=array();
  dir_list_rec($dir);
  asort($dirs);
  foreach ($dirs AS $d) {
    $out.='<option'.($d==$active?' selected':'').'>'.$d.'</option>';
  }
  return $out;
}
?>