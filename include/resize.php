<?php

error_reporting(E_ALL);

/***********************************************************************************
Функция img_resize(): генерация thumbnails
Параметры:
  $src             - имя исходного файла
  $dest            - имя генерируемого файла
  $width, $height  - ширина и высота генерируемого изображения, в пикселях
Необязательные параметры:
  $rgb             - цвет фона, по умолчанию - белый
  $quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
***********************************************************************************/
function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=false) {

/*==== LETS PASS this part
  if (!file_exists($src)) die("Missing file");
*/
  $size = getimagesize($src);
  
//  echo $size[0] . 'x' . $size[1] . '<br />';

  if ($size === false) die("Missing size");

  // Определяем исходный формат по MIME-информации, предоставленной
  // функцией getimagesize, и выбираем соответствующую формату
  // imagecreatefrom-функцию.
  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (empty($icfunc) || !function_exists($icfunc)) {
    die("Missing or invalid function: $icfunc");
  }

//print_r($size);
//print_r( exif_read_data($src));

    $ort='';
    $exif = exif_read_data($src);
    if(isset($exif['Orientation']))
      $ort = $exif['Orientation'];

            
    
  $x_ratio = $width / $size[0];
  $y_ratio = $height / $size[1];
  if ($keep_origin_size){
    $src_x      = 0;
    $src_y      = 0;
    $dst_x      = 0;
    $dst_y      = 0;
    $src_width  = $size[0];
    $src_height = $size[1];
    $dst_width  = $size[0];
    $dst_height = $size[1];
    $width  = $size[0];
    $height = $size[1];
    
  }elseif ($resize_max) {

    $src_x      = 0;
    $src_y      = 0;
    $dst_x      = 0;
    $dst_y      = 0;
    $src_width  = $size[0];
    $src_height = $size[1];
    

    if ($height >= $size[1]*$x_ratio) {

      $dst_width  = $width;
      $dst_height = $size[1]*$x_ratio;
      $height     = $dst_height;

    } else {

      $dst_width  = $size[0]*$y_ratio;
      $width      = $dst_width;
      $dst_height = $height;

    }
  
  
  } elseif ($trim) {
  
    $k_src   = $size[1] / $size[0];
    $k_dst   = $height / $width;

    if ($k_src==$k_dst) {
      $src_x      = 0;
      $src_y      = 0;
      $dst_x      = 0;
      $dst_y      = 0;
      $src_width  = $size[0];
      $src_height = $size[1];
      $dst_width  = $width;
      $dst_height = $height;
    } elseif ($k_src>$k_dst) {
      $src_x      = 0;
      $src_y      = floor(($size[1]-$height/$x_ratio)/2);
      $dst_x      = 0;
      $dst_y      = 0;
      $src_width  = $size[0];
      $src_height = $height/$x_ratio;
      $dst_width  = $width;
      $dst_height = $height;
    } else {
      $src_x      = floor(($size[0]-$width/$y_ratio)/2);
      $src_y      = 0;
      $dst_x      = 0;
      $dst_y      = 0;
      $src_width  = $width/$y_ratio;
      $src_height = $size[1];
      $dst_width  = $width;
      $dst_height = $height;
    }

  } else {
  
    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);
    $src_x       = 0;
    $src_y       = 0;
    
    $src_width   = $size[0];
    $src_height  = $size[1];
    $dst_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $dst_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);

    $dst_x       = $use_x_ratio  ? 0 : floor(($width - $dst_width) / 2);
    $dst_y       = !$use_x_ratio ? 0 : floor(($height - $dst_height) / 2);

  }
//echo $size[0] . 'x' . $size[1] . ' => ' . $width . 'x' . $height .'<br />';
  $isrc = $icfunc($src);
  $idest = imagecreatetruecolor($width, $height);

  imagefill($idest, 0, 0, $rgb);
  imagecopyresampled($idest, $isrc, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
  
  
  if ($apply_mask && $dst_width>100){
    
    //mask size 400 x 400
     $mask_src_x=($dst_width*0.25)>400?400:(int)($dst_width*0.25);
     $mask_src_y=($dst_width*0.25)>400?400:(int)($dst_width*0.25);
       
        
  	$imLens=imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/img/floren_mask_big_25.png");
	imagecopyresampled($idest, $imLens, (int)(($dst_width/2+100)-($mask_src_x)), (int)($dst_height-($mask_src_y+30)), 0, 0, $mask_src_x, $mask_src_y, 400, 400);
  }
  if($ort>0){
    switch($ort)
    {
    
        case 3: // 180 rotate left
            $idest=imagerotate($idest, 180, -1);
            break;
    
    
        case 6: // 90 rotate right
            $idest=imagerotate($idest, -90, -1);
            break;
    
        case 8:    // 90 rotate left
            $idest=imagerotate($idest, 90, -1);
            break;
    }
  }//if ort
//  imagejpeg($idest, $dest, $quality);
  imagewebp($idest, $dest, $quality);

  imagedestroy($isrc);
  imagedestroy($idest);

  return true;

}

?>
