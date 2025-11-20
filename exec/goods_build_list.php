<?php
// this is include code for pages goods.php, plants.php, showMoreGoods.php
// Please Do not add too much
//query is provided in goods.php, plants.php, showMoreGoods.php
		$db->query($main_query);
		$promo=array();
		while ($f=$db->fetch()){
			
			$colors[$f['ID']] = array();
			$is_action=0;
			$price='';
			$zero_price = 0;

			if ($is_plant || $is_aksessuary || $is_pot) {
				$product_path = $lang_url . '/product/' . $f['ID'] . '_' . $f['link'] . '/';
			//	$img_path = 'https://floren.com.ua/images/ins/b/gmcxml-' . $f['image'];
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/goods/s/' . str_replace('jpg', 'webp', $f['image']))){
					$img_path = '/images/goods/s/' . str_replace('jpg', 'webp', $f['image']);
			}else{
					/*
					$input 	= 'https://floren.com.ua/images/ins/b/gmcxml-' . $f['image'];
					$output = $_SERVER['DOCUMENT_ROOT'] . '/images/goods/b/' .str_replace('jpg', 'webp', $f['image']);
					$image = imagecreatefromjpeg($input);
					$quality = 85;
					imagewebp($image, $output, $quality);
					imagedestroy($image);
					$img_path = '/images/goods/b/' . str_replace('jpg', 'webp', $f['image']);
					*/
					
					$src= 'https://floren.com.ua/images/ins/b/gmcxml-' . $f['image'];
				
					$dest_s		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/s/' .str_replace('jpg', 'webp', $f['image']);
					$dest_m		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/m/' .str_replace('jpg', 'webp', $f['image']);
					$dest_b		=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/b/' .str_replace('jpg', 'webp', $f['image']);
					$dest_gmcxml	=	$_SERVER['DOCUMENT_ROOT'] . '/images/goods/gmcxml/' .str_replace('.jpg', '-gmcxml.webp', $f['image']);
					
										
					img_resize($src, $dest_s, 200, 200, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=false);
				//	img_resize($src, $dest_m, 600, 600, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=false, $trim=false, $resize_max=false, $apply_mask=true);
				//	img_resize($src, $dest_b, 1600, 1200, $rgb=0xFFFFFF, $quality=100, $keep_origin_size=true, $trim=false, $resize_max=true, $apply_mask=true);
				//	img_resize($src, $dest_gmcxml, 1600, 1200, $rgb=0xFFFFFF, $quality=90, $keep_origin_size=true, $trim=false, $resize_max=true, $apply_mask=false);
					
			}
				
			} elseif ($is_bouquet) {
				$product_path = $lang_url . '/buket/' . $f['ID'] . '/';
				$img_path = 'https://floren.com.ua/images/ins/s/'. $f['image'];
			}

			if (intval($f['min_price']) == 0 && intval($f['max_price']) == 0) {
				$zero_price = 1;
			}
			if ($f['act'] === "0" || $zero_price === 1 || ($f['availability']==0 && $f['preorder']==0) ){
				$good_status = 'not_available';
			}elseif ($f['preorder']==1 && $f['availability']==0){
				$good_status = 'preorder';
			}else{
				$good_status = 'in_stock';
			}	

						
			$price = $f['min_price'];
			if ($f['min_price'] != $f['max_price'])
				$price .= ' – ' . $f['max_price'];
				
			if($f['min_old_price']>0 || $f['max_old_price']>0){
						$is_action=1;
			}
			
			$promo[] = array(
				'ID'						=>	$f['ID'],
				'name'					=>	$f['name'],
				'product_path'	=>	$product_path,
				'img_path'			=>	$img_path,
				'image'					=> 	$f['image'],
				'act'						=>	$f['act'],
				'good_status'		=>	$good_status,
				'price'					=>	$price,
				'min_price'					=>	$f['min_price'],
				'max_price'					=>	$f['max_price'],
				'colors'				=>	$colors[$f['ID']]
			);
			
			
			
			$db->query("SELECT gf.*, gf.old_price, gf.visibility, gf.measure_qt, gf.color, gmg.unit, gmg.name_ru AS mg_name_ru, gmg.name_ua AS mg_name_ua FROM goods_forms gf LEFT JOIN goods_measures gmg ON gf.measure_id=gmg.ID WHERE goodID='".$f['ID']."' AND gf.visibility=1 AND gf.price > 0 GROUP BY dia, hgt, wdt, depth", 1);

			while ($ff=$db->fetch(1)) {
				$form_measure = '';
	
					if ($ff['dia']) {
						$form_measure = $form_measure . '&#216;' . $ff['dia'];
					}
					if ($ff['wdt']) {
						$form_measure = $form_measure . $ff['wdt'];
					}
					if ($ff['depth']) {
						$form_measure = $ff['depth'] ? $form_measure . 'x' . $ff['depth'] : $form_measure . $ff['depth'];
					}
					if ($ff['hgt']) {
						$form_measure = $ff['dia'] ? $form_measure . ', ' . $lingvo['hgt'] . ' ' . $ff['hgt'] : $form_measure . 'см, ' . $lingvo['hgt'] . ' ' . $ff['hgt'];
					}
					if ($ff['measure_qt']) {
						if ($ff['dia'] || $ff['wdt'] || $ff['hgt']) {
							$form_measure = $form_measure . ', ' . $ff['measure_qt'];
						} else {
							$form_measure = $form_measure . $ff['measure_qt'];
						}
					}
				
				$form_measure = $form_measure . '' .$ff['unit'];
		
				$promo[count($promo)-1]['forms'][] = array(
					/*
					'dia' => $ff['dia'],
					'hgt' => $ff['hgt'],
					'wdt' => $ff['wdt'],
					'depth' => $ff['depth'],
					*/
					'form_measure' => $form_measure
				);

					
				if ($ff['color'] != '0') {
					$db->query("SELECT gf.color, gc.name_ru, gc.name_ua, gc.preview FROM goods_forms gf LEFT JOIN goods_colors gc ON gf.color=gc.alias WHERE gf.goodID='".$f['ID']."' AND visibility=1 AND price > 0 ", 2);

					while ($fc = $db->fetch(2)) {	
						if ($fc['color'] != '0') {
							$colors[$f['ID']][] = array(
								'name' => $fc['name_'.$lang],
								'image' => $fc['preview'],
							);
						}					
					}
				}
			};
	
			
			$promo[count($promo)-1]['colors'] = array_unique($colors[$f['ID']], SORT_REGULAR);
		//	array_unique($promo[count($promo)-1]['forms']);
		}
?>