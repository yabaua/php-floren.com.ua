<?
error_reporting(E_ALL);
header('HTTP/1.1 404 Not Found', true, '404');
header("content-type: text/html;charset=utf-8 \r\n");

$parse_url=parse_url($_SERVER["REQUEST_URI"]);
$path=explode('?',$parse_url['path']);
$path=preg_replace('/[^0-9a-zA-Z\/_*%.-]/','',$path[0]);
$path=preg_replace('/\/$/','',$path);
$path=preg_replace('/^\//','',$path);
$URL=explode('/',$path);


// if 404 comes from nowhere and variebles not defined in index.php
if(!isset($lingvo)){
		require_once("database.php");
}
		//TRANSLATOR
		
		$lang='ua';
		$lang_url='/ua';
		$hreflang='uk-UA';
		$db_sufix='_ua';
		
		$lingvo_texts=array();
		$db->query("SELECT alias, txt_".$lang." FROM lingvo WHERE page='general'");
		while($rs_lingvo=$db->fetch()){
			$lingvo[$rs_lingvo['alias']]=$rs_lingvo['txt_'.$lang];
		}
		$db->query("SELECT alias, txt_".$lang." FROM lingvo WHERE page='".$URL[0]."'");
		while($rs_lingvo_page=$db->fetch()){
			$lingvo[$rs_lingvo_page['alias']]=$rs_lingvo_page['txt_'.$lang];
		}

if(!strstr(@$_SERVER['HTTP_FROM'], 'bingbot')){
/*
	$html_header = "MIME-Version: 1.0\r\n";
	$html_header .= "Content-type: text/html; charset=utf-8\r\n";
	$html_header .= "From:  Флорен <info@floren.com.ua>\r\n";
	
	
	//	echo "cxx";
	ob_start();
	echo date("d/m/Y h:i:s").'<BR>';
	echo "REQUEST_URI:&nbsp;&nbsp;".$_SERVER['REQUEST_URI'].'<BR>';
	echo "HTTP_REFERER:&nbsp;&nbsp;".$_SERVER['HTTP_REFERER'].'<BR>';
	echo "HTTP_USER_AGENT:&nbsp;&nbsp;".$_SERVER['HTTP_USER_AGENT'].'<BR>';
	echo "HTTP_FROM:&nbsp;&nbsp;".$_SERVER['HTTP_FROM'].'<BR>';
	
	echo '<FONT COLOR="#FF0000">'.mysql_error().'<BR>'.htmlspecialchars($sql).'</FONT><BR>';
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
	@mail('info@floren.com.ua', 'Ошибка 404', $text, $html_header);
	
	*/
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Сторінка не існує, 404 Not Found — Флорен™</title>
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
	<meta name="Description" content="Сторінка видалена або не існує на сайті Флорен™"/>
	<meta name="Keywords" content="Флорен – студія фітодизайну Київ"/>
	<meta name="google-site-verification" content="bTCfDHCphQx6TBpRPW2kD8KCFii5CginoCuvlA30iRc" />
	<meta name="google-site-verification" content="TbgodL-oY8WU0EzwGUsQRVHFaW0AlhMfphGCTKVUlUA" />
	<meta name="yandex-verification" content="52b1e8e95027dfaa" />
	<meta name="yandex-verification" content="676d8ae0b94ec83e" />
	<meta name="msvalidate.01" content="608804491F64BA8EB3473B4D82A00BC6" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/apple-touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="167x167" href="/images/apple-touch-icon-ipad-retina.png">
	
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="/css/style.css?v=1572815463" />
	<link rel="stylesheet" type="text/css" href="/css/nav.css?v=1572815463" />
		<!--link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css' rel='stylesheet' type='text/css'-->
		
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js" defer="defer"></script>
	<script type="text/javascript" src="/js/bootstrap.js" defer="defer"></script>
	<script type="text/javascript" src="/js/common.js?v=1572815463" defer="defer"></script>
	
	
	
		 <!--[if IE]>
<script>document.createElement('header');document.createElement('nav');document.createElement('section');document.createElement('article');document.createElement('aside');document.createElement('footer');</script>
 		<![endif]-->


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W7VHLVP');</script>
<!-- End Google Tag Manager -->

<!--CALL -->
<script type="text/javascript">
  (function(d, w, s) {
	var widgetHash = 'p4ip41nnd32lknoy3wb1', ctw = d.createElement(s); ctw.type = 'text/javascript'; ctw.async = true;
	ctw.src = '//widgets.binotel.com/calltracking/widgets/'+ widgetHash +'.js';
	var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(ctw, sn);
  })(document, window, 'script');
</script> 
<!--END CALL -->
<script type="text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-20410887-2');
ga('send', 'pageview');
//ga('send', 'timing');
</script>


<script async src="https://www.googletagmanager.com/gtag/js?id=AW-736148489"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-736148489');
</script>

<script>

	

</script>

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W7VHLVP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="container">
<header class="header">
		<div class="header__holder">
			<div class="header__block">
				<a href="<?=$lang_url?>/" class="logo">
					<img src="/img/logo25.svg" width="135" decoding="async" alt="Флорен">
				</a>

				<div class="header__contacts">
						<div class="header__flex">

						<div class="lang_mobile lang">
								<a href="/ua/" class="lang__ua<? if ($lang_url=='/ua') {?> lang__active<?}?>">UA</a>
								<a href="/" class="lang__ru<? if ($lang_url=='') {?> lang__active<?}?>">RU</a>
							</div>

							<div data-tooltip class="header__location">

								<div class="header__mobileinfo">
									<p class="header__shops" data-modal-trg="1" data-modal-wdt="768"><?=$lingvo['kiev_shops']?></p>
									<p class="header__callback header__cta" data-modal-trg="2" data-modal-wdt="600"><?=$lingvo['contact_us']?></p>
								</div>
								
								<div data-tooltip-content class="tooltip tooltip_loc tooltip_hide">
									<a class="header__addr" href="https://www.google.com/maps/place/%D0%BF%D1%80%D0%BE%D1%81%D0%BF.+%D0%9F%D0%BE%D0%B1%D0%B5%D0%B4%D1%8B,+70,+%D0%9A%D0%B8%D0%B5%D0%B2,+02000/@50.457751,30.4275192,19z/data=!4m5!3m4!1s0x40d4cc47fb4d5e67:0x60d5b7db1dcaa114!8m2!3d50.4577864!4d30.4281104" target="_blank"><span class="header__addr-shop"><?=$lingvo['address_street']?></span></a>
									<span>пн-сб: 09:00-19:00</span>
									<p><?=$lingvo['sunday']?>: 10:00-18:00</p>
								</div>

								<div data-modal="1" class="modal modal_center modal_hide">
									<button class="close-btn"></button>
									<div>
										<p class="modal__headline"><?=$lingvo['kiev_shops']?></p>
										<a class="header__addr" href="https://www.google.com/maps/place/%D0%BF%D1%80%D0%BE%D1%81%D0%BF.+%D0%9F%D0%BE%D0%B1%D0%B5%D0%B4%D1%8B,+70,+%D0%9A%D0%B8%D0%B5%D0%B2,+02000/@50.457751,30.4275192,19z/data=!4m5!3m4!1s0x40d4cc47fb4d5e67:0x60d5b7db1dcaa114!8m2!3d50.4577864!4d30.4281104" target="_blank"><span class="header__addr-shop"><?=$lingvo['address_street']?></span></a>
										<span>пн-сб: 09:00-19:00</span>
										<p><?=$lingvo['sunday']?>: 10:00-18:00</p>
								{**		<a class="header__addr" href="https://www.google.com.ua/maps/" target="_blank"><span class="header__addr-shop"><?=$lingvo['address_akhmatova']?></span></a>	**}
										<span>пн-сб: 09:00-19:00</span>
									</div>
								</div>

						</div>

							<div class="header__search">
								<div class="header__search-bar search-bar">
									<form name="f1" method="post" action="https://floren.com.ua<?=$lang_url?>/search/">
										
											<input type="text" name="srch" class="search-bar__input search-bar__input_gray" value="Шефлера" onblur="this.value = this.value.replace(/^(\s*)/, '').replace(/(\s*)$/, ''); if (this.value==''){ this.value='Шефлера';this.className='search-bar__input search-bar__input_gray'}" onfocus='if (this.value=="Шефлера"){ this.value="";this.className="search-bar__input"}' />
											
											<button type="submit" class="search-bar__btn"></button>

									</form>
								</div>
								<a title="<?=$lingvo['go_to_card']?>" href="<?=$lang_url?>/basket/" class="header__basket"></a>
							</div>
						</div>

						<div class="header__numbers">
							<div class="header__phones">
								<a class="header__phone binct-phone-number-1" href="tel:+380443337755">(044) 333-77-55</a>
								<a class="header__phone binct-phone-number-2" href="tel:+380992382644">(099) 238-26-44</a>
								<button class="header__callback topCbBut" onclick="show_fb();"><?=$lingvo['callback_general']?></button>
							</div>

							<div class="modal modal_center modal_hide" data-modal="2">
								<button class="close-btn"></button>
								<div>
									<p class="modal__headline"><?=$lingvo['contact_us']?></p>
									<div>
										<a class="header__phone binct-phone-number-1" href="tel:+380443337755">(044) 333-77-55</a>
										<a class="header__phone binct-phone-number-2" href="tel:+380992382644">(099) 238-26-44</a>
									</div>
									<button data-modal-close class="header__callback topCbBut" onclick="show_fb();"><?=$lingvo['callback_general']?></button>
								</div>		

							</div>

						</div>

				</div>
			</div>

			<div class="header__info">
      			<div class="header__top">
					<button class="header__burger" data-modal-trg="7"></button>
						<div class="header__inner modal_left modal_hide" data-modal="7">
							<button class="close-btn"></button>
							<nav>
								<ul class="header__list">
									<li class="header__item"><button data-modal-trg="8" class="header__hide-headline"><?=$lingvo['goods_services']?></button></li>
									<li class="header__item"><a href="<?=$lang_url?>/about/"><?=$lingvo['menu_about']?></a></li>
									<li class="header__item"><a href="<?=$lang_url?>/delivery/"><?=$lingvo['menu_delivery']?></a></li>
									<li class="header__item"><a href="<?=$lang_url?>/publications/"><?=$lingvo['menu_publications']?></a></li>
									<li class="header__item"><a href="<?=$lang_url?>/contacts/"><?=$lingvo['menu_contacts']?></a></li>
								</ul>
							</nav>
							<div class="header__lang lang">
								<span class="lang__caption lang__hide"><?=$lingvo['menu_contacts']?>:</span>
								<a href="/ua/" class="lang__ua<? if ($lang_url=='/ua') {?> lang__active<?}?>">UA</a>
								<a href="/" class="lang__ru<? if ($lang_url=='') {?> lang__active<?}?>">RU</a>
							</div>
						</div>
      			</div>
    		</div>
		</div>
			<nav>
			<div class="main-menu">
	<div class="mobile-menu__btns">
		<button class="mobile-menu__btn" data-modal-trg="8"><span><?=$lingvo['goods_services']?></span></button>
		<button class="mobile-menu__search" data-modal-trg="4"></button>
		<div style="position:relative">
			<a class="mobile-menu__bsk" href="<?=$lang_url?>/basket/"></a>
		</div>
	</div>
	<div class="main-menu__container modal_left modal_hide" data-modal="8">
		<button class="close-btn"></button>
		<div class="header__lang lang lang_products-btn">
            <span class="lang__caption lang__hide"><?=$lingvo['menu_contacts']?>:</span>
            <a href="/ua/" class="lang__ua<? if ($lang_url=='/ua') {?> lang__active<?}?>">UA</a>
            <a href="/" class="lang__ru<? if ($lang_url=='') {?> lang__active<?}?>">RU</a>
		</div>
		<ul class="hero-menu">
			<li class="hero-menu__item">
				<a href="<?=$lang_url?>/phytodesign/" class="hero-menu__link"><?=$lingvo['phytodesign']?>
					<span class="hero-menu__subtext"><?=$lingvo['ozelenenie_ofisov']?></span>
				</a>
			</li>

			<li class="hero-menu__item" data-menu="1">
				<a href="<?=$lang_url?>/komnatnie-rasteniya/" class="hero-menu__link nowprap"><?=$lingvo['plants']?> <span class="hero-menu__subtext"><?=$lingvo['dlya_ofisa_i_kvartiri']?></span></a>
				
				<div class="hero-menu__list" data-submenu="1">
					<ul class="hero-menu__sub-menu sub-menu">
					<li class="sub-menu__item sub-menu__item_hide"><a href="{$LANGURL}/komnatnie-rasteniya/"><?=$lingvo['all_plants']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/orchids/"><?=$lingvo['goods_orchids']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/decorative/"><?=$lingvo['goods_decorative']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/palms/"><?=$lingvo['goods_palms']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/citrus/"><?=$lingvo['goods_citrus']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/bloom/"><?=$lingvo['goods_bloom']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/sansevieriya/"><?=$lingvo['goods_sansevieriya']?></a></li>
					</ul>
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/ficus/"><?=$lingvo['goods_ficus']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/dracaena/"><?=$lingvo['goods_dracaena']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/cactus/"><?=$lingvo['goods_cactus']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/sukkulenty/"><?=$lingvo['sukkulenty']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/liana/"><?=$lingvo['goods_liana']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/product/546_fikus_microcarpa__mikrokarpa/"><?=$lingvo['goods_bonsai']?></a></li>
						
					</ul>
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/yucca/"><?=$lingvo['goods_yukka']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/bulbs/"><?=$lingvo['goods_bulbs']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/komnatnie-rasteniya/khvoynyye/"><?=$lingvo['khvoynyye']?></a></li>
					</ul>
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item"><a href="<?=$lang_url?>/compositions/"><?=$lingvo['goods_compositions']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/gift-card/"><?=$lingvo['gift_card']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/services/peregorodki-iz-rasteniy/" style="color:green"><?=$lingvo['peregorodki_iz_rasteniy']?></a></li>
					</ul>
				</div>

			</li>

			<li class="hero-menu__item hero-menu__item_relative" data-menu="2">
				<a href="<?=$lang_url?>/planters/" class="hero-menu__link"><?=$lingvo['planters']?><span class="hero-menu__subtext"><?=$lingvo['dlya_rasteniy']?></span></a>
				
				<div class="hero-menu__list" data-submenu="2">
					<ul class="hero-menu__sub-menu sub-menu">
						<li class="sub-menu__item sub-menu__item_hide"><a href="{$LANGURL}/planters/"><?=$lingvo['all_pots']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/ceramic/"><?=$lingvo['goods_ceramic']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/lechuza/"><?=$lingvo['goods_lechuza']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/lamela/"><?=$lingvo['goods_lamela']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/elho/"><?=$lingvo['planters']?> ELHO</a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/wood-planters/"><?=$lingvo['goods_wood_planters']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/metal-pots/"><?=$lingvo['goods_metall_planters']?></a></li>
						<li class="sub-menu__item"><a href="<?=$lang_url?>/planters/beton/"><?=$lingvo['goods_beton']?></a></li>
					</ul>
				</div>

			</li>

			<li class="hero-menu__item">
					<a href="<?=$lang_url?>/services/house_plant_care/" class="hero-menu__link"><?=$lingvo['care']?> <span class="hero-menu__subtext"><?=$lingvo['za_rasteniyami']?></span></a>
			</li>

			<li class="hero-menu__item">
					<a href="<?=$lang_url?>/gallery/" class="hero-menu__link"><?=$lingvo['gallery']?> <span class="hero-menu__subtext"><?=$lingvo['photo_gallery']?></span></a>
			</li>
			
			<li class="hero-menu__item" data-menu="3">
				<a href="<?=$lang_url?>/services/" class="hero-menu__link"><?=$lingvo['services']?> <span class="hero-menu__subtext"><?=$lingvo['order_service']?></span></a>
				<div class="hero-menu__list" data-submenu="3">
					
					<div class="hero-menu__column">
						<div>
							<span class="hero-menu__subheader"><?=$lingvo['phytodesign']?></span>
							<ul class="hero-menu__sub-menu sub-menu">
								<li class="sub-menu__item"><a href="<?=$lang_url?>/phytodesign/"><?=$lingvo['phytodesign']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/services/peresadka/"><?=$lingvo['peresadka_rasteniy']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/services/shipping/"><?=$lingvo['perevozka_rasteniy']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/services/arenda_rasteniy/"><?=$lingvo['arenda_rasteniy']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/services/peregorodki-iz-rasteniy/"><?=$lingvo['peregorodki_iz_rasteniy']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/services/house_plant_care/"><?=$lingvo['care']?> <?=$lingvo['za_rasteniyami']?></a></li>
							</ul>
						</div>

						<div>
							<span class="hero-menu__subheader custom"><?=$lingvo['dostavka_cvetov']?></span>
							<ul class="hero-menu__sub-menu sub-menu">
								<li class="sub-menu__item"><a href="<?=$lang_url?>/florist/"><?=$lingvo['nav_avtorskie']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/florist/v_korobke/"><?=$lingvo['shlyapnaya_korobka']?></a></li>
								<li class="sub-menu__item"><a href="<?=$lang_url?>/services/korporativnaya-floristika/"><?=$lingvo['to_corporate']?></a></li>
							</ul>
						</div>

					</div>

					<div class="hero-menu__column">
						<span class="hero-menu__subheader"><?=$lingvo['exterernie_raboti']?></span>
						<ul class="hero-menu__sub-menu sub-menu">
							<li class="sub-menu__item"><a href="<?=$lang_url?>/services/ozelenenie_letney_ploschadki/"><?=$lingvo['ozelenenie_kafe']?></a></li>
						</ul>
					</div>

					<div class="hero-menu__column">
						<span class="hero-menu__subheader"><?=$lingvo['vertikalnoe_ozelenenie']?></span>
						<ul class="hero-menu__sub-menu sub-menu">
							<li class="sub-menu__item"><a href="<?=$lang_url?>/services/green-wall/"><?=$lingvo['green_wall']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/services/vertikalnoe-ozelenenie/"><?=$lingvo['vertikalnoe_ozelenenie_kv_of']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/services/ozelenenie-stabilizirovannim-mhom/"><?=$lingvo['ozelenenie_moss']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/"><?=$lingvo['metall_ozel']?></a></li>
						</ul>
					</div>

					<div class="hero-menu__column">
						<span class="hero-menu__subheader"><?=$lingvo['landscape']?></span>
						<ul class="hero-menu__sub-menu sub-menu">
							<li class="sub-menu__item"><a href="<?=$lang_url?>/landscape/"><?=$lingvo['landscape']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/blagoustroistvo/"><?=$lingvo['ozelenenie_i_blago']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/blagoustroistvo/ozelenenie-goroda/"><?=$lingvo['ozelenenie_goroda']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/blagoustroistvo/posadka-krupnomerov/"><?=$lingvo['posadka_krupnomerov']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/blagoustroistvo/klumbi/"><?=$lingvo['klumbi']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/blagoustroistvo/alpiyskaya-gorka/"><?=$lingvo['alpiyskaya_gorka']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/blagoustroistvo/zhivaya-izgorod/"><?=$lingvo['zhivaya_izgorod']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/gazon/"><?=$lingvo['gazon']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/gazon/rulonniy-gazon/"><?=$lingvo['rulonniy_gazon']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/gazon/posevnoi-gazon/"><?=$lingvo['posevnoi_gazon']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/gazon/avtopoliv/"><?=$lingvo['avtopoliv']?></a></li>
							<li class="sub-menu__item"><a href="<?=$lang_url?>/uhod/"><?=$lingvo['uhod']?></a></li>
						</ul>
					</div>

				</div>
			</li>
		</ul>
	</div>
</div>
			</nav>
	</header>


	
<div class="content-h">





<div class="row">

			<div align="center" style="font-size:1.1em;padding:10px;">
				<h1><?=$lingvo['not_exist']?></h1>
				<br />
				<p><strong><?=$lingvo['page_not_found']?></strong>.</p>
				<p><?=$lingvo['begin_with']?> <a href="/"><?=$lingvo['home_page']?>.</a></p>
				<p><?=$lingvo['interesting_pages']?></p>
				<p>&nbsp;</p>
			</div>

</div>
<div class="row">
		<div class="show-more-list col-md-4" style="text-align:center;">
			
			<h3><a href="<?=$lang_url?>/komnatnie-rasteniya/"><?=$lingvo['plants']?></a></h3>
			<dl>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/decorative/"><?=$lingvo['goods_decorative']?></a></dt>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/ficus/"><?=$lingvo['goods_ficus']?></a></dt>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/dracaena/"><?=$lingvo['goods_dracaena']?></a></dt>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/palms/"><?=$lingvo['goods_palms']?></a></dt>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/cactus/"><?=$lingvo['goods_cactus']?></a></dt>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/citrus/"><?=$lingvo['goods_citrus']?></a></dt>
				<dt><a href="<?=$lang_url?>/komnatnie-rasteniya/bloom/"><?=$lingvo['goods_bloom']?></a></dt>
			</dl>
		</div>
		<div class="show-more-list col-md-4" style="text-align:center;">
			
			<h3><a href="<?=$lang_url?>/planters/"><?=$lingvo['planters_kashpo']?></a></h3>
			<dl>
				<dt><a href="<?=$lang_url?>/planters/ceramic/"><?=$lingvo['goods_ceramic']?></a></dt>
				<dt><a href="<?=$lang_url?>/planters/lechuza/"><?=$lingvo['goods_lechuza']?></a></dt>
				<dt><a href="<?=$lang_url?>/planters/elho/"><?=$lingvo['goods_elho']?></a></dt>
			</dl>
		</div>
		<div class="show-more-list col-md-4" style="text-align:center;">
			
			<h3><a href="<?=$lang_url?>/services/oformlenie/"><?=$lingvo['services']?></a></h3>
			<dl>
				<dt><a href="<?=$lang_url?>/phytodesign/"><?=$lingvo['ozelenenie_pomescheniy']?></a></dt>
				<dt><a href="<?=$lang_url?>/services/green-wall/"><?=$lingvo['ozelenenie_moss']?></a></dt>
				<dt><a href="<?=$lang_url?>/services/house_plant_care/"><?=$lingvo['uhod_flower']?></a></dt>
				<dt><a href="<?=$lang_url?>/gift-card/"><?=$lingvo['gift_card']?></a></dt>
				<dt><a href="<?=$lang_url?>/services/peresadka/"><?=$lingvo['peresadka_rasteniy']?></a></dt>
			</dl>
		</div>
</div>

<div class="holder" style="margin:0 auto;">
		<div align="center">
			<h3><?=$lingvo['have_a_quastion']?></h3>
			<div class="body_phone" style="text-align:left;">
				<div><a class="binct-phone-number-1" href="tel:+380443337755">(044) 333-77-55</a></div>
				<div><a class="binct-phone-number-2" href="tel:+380992382644">(099) 238-26-44</a></div>
			</div>
		</div>
</div>

<!-- =============== -->
</div>
</div>


<footer>

<div class="container">
		<div class="col-md-2 col-xs-4">
			<p>&nbsp;</p>
			<a href="<?=$lang_url?>/" style="display:block;float:left;margin:15px 10px 5px 15px;"><img src="/img/logogo-sm.png" alt="<?=$lingvo['logo_alt']?>" /></a>
		</div>
		<div class="col-md-3 col-xs-4 bottom">
				<ul>
					<li><a href="<?=$lang_url?>/about/"><?=$lingvo['menu_about']?></a></li>
					<li><a href="<?=$lang_url?>/purchase-returns/"><?=$lingvo['menu_purchaise_return']?></a></li>
					<li><a href="<?=$lang_url?>/partnership/"><?=$lingvo['menu_partnership']?></a></li>
					<li><a href="<?=$lang_url?>/contacts/"><?=$lingvo['menu_contacts']?></a></li>
					
					<li><a href="<?=$lang_url?>/sitemap/"><?=$lingvo['sitemap']?></a></li>
				</ul>
		</div>
		<div class="col-md-3 col-xs-4 bottom">
				<ul>
					<li><a href="<?=$lang_url?>/phytodesign/"><?=$lingvo['phytodesign']?></a></li>
					<li><a href="<?=$lang_url?>/services/green-wall/"><?=$lingvo['vertikalnoe_ozelenenie']?></a></li>
					<li><a href="<?=$lang_url?>/landscape/"><?=$lingvo['landscape']?></a></li>
					<li><a href="<?=$lang_url?>/komnatnie-rasteniya/"><?=$lingvo['plants']?></a></li>
					<li><a href="<?=$lang_url?>/planters/"><?=$lingvo['planters_kashpo']?></a></li>
				</ul>
		</div>
		<div class="col-md-4 col-xs-12 bottom">
			<div class="copy">
					<div>
						<p>&nbsp;</p>
							<p><nobr><a href="https://www.google.com/maps/place/%D0%BF%D1%80%D0%BE%D1%81%D0%BF.+%D0%9F%D0%BE%D0%B1%D0%B5%D0%B4%D1%8B,+70,+%D0%9A%D0%B8%D0%B5%D0%B2,+02000/@50.457751,30.4275192,19z/data=!4m5!3m4!1s0x40d4cc47fb4d5e67:0x60d5b7db1dcaa114!8m2!3d50.4577864!4d30.4281104" target="_blank"><?=$lingvo['address_street']?></a></nobr></p>
						<? /*	<p><nobr><a href="https://www.google.com.ua/maps/" target="_blank"><?=$lingvo['address_akhmatova']?></a></nobr></p>	 */	?>

						<p>
							<span>03113</span>,
				    		<span><?=$lingvo['city_kiev']?>, <?=$lingvo['ukraine']?></span>
						</p>
					</div>
					<p><span style="font-size:14px;">&#9742;</span> <span class="binct-phone-number-1">+380 44 333-77-55</span> <?=$lingvo['city_kiev']?></p>
					<p><span style="font-size:16px;">&#9990;</span> <span class="binct-phone-number-2">+380 99 238-26-44</span></p>
			</div>
		</div>		
</div>
</footer>

<div class="fb-icons">
	<a href="https://www.facebook.com/floren.com.ua/" target="_blank" rel="nofollow"><img src="/images/icon-fb.png" width="32" height="32" alt="Facebook"></a>
	<a href="https://www.youtube.com/channel/UClfLL4epyim3T5GX0nj2zKQ" target="_blank" rel="nofollow"><img src="/images/icon-youtube.png" width="32" height="32" alt="Youtube"></a>
	<a href="https://www.instagram.com/studio_floren/" target="_blank" rel="nofollow"><img src="/images/icon-instagram.png" width="32" height="32" alt="Instagram"></a>
</div>


<!-- BEGIN JIVOSITE CODE  -->
<script type='text/javascript'>
(function(){ var widget_id = 'unpZ9Kx5Y3';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!--  END JIVOSITE CODE -->

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '139311730173475');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=139311730173475&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<div data-modal="4" class="modal modal_center modal_hide">
	<button class="close-btn"></button>
	<div>
		<p class="modal__headline"><?=$lingvo['site_search']?></p>
		<form style="display: flex;" name="f1" method="post" action="https://floren.com.ua{$LANGURL}/search/">	
			
			
			<input type="text" name="srch" class="search-bar__input search-bar__input_gray" value="Шефлера" onblur="this.value = this.value.replace(/^(\s*)/, '').replace(/(\s*)$/, ''); if (this.value==''){ this.value='Шефлера';this.className='search-bar__input search-bar__input_gray'}" onfocus='if (this.value=="Шефлера"){ this.value="";this.className="search-bar__input"}' />
			<button type="submit" class="search-bar__btn"></button>
		</form>
	</div>
</div>

</body>
</html>