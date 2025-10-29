<?php
/* Smarty version 5.5.2, created on 2025-09-23 12:27:29
  from 'file:main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_68d26801c96492_59849725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16ce5634773fc64347c928ca3fcb32930b4b182d' => 
    array (
      0 => 'main.tpl',
      1 => 1758619644,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:nav_landscape.tpl' => 1,
    'file:nav_florist.tpl' => 1,
    'file:nav_phytodesign.tpl' => 1,
  ),
))) {
function content_68d26801c96492_59849725 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/floren.com.ua/templates';
?><!DOCTYPE html>
<html lang="<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>uk-UA<?php } else { ?>ru-UA<?php }?>">
<head>
	<title><?php echo $_smarty_tpl->getValue('META_TITLE');?>
</title>
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<meta charset="windows-1251">
	<meta name="description" content="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('META_DESCRIPTION'), ENT_QUOTES, 'UTF-8', true);?>
" />
	<meta name="Keywords" content="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('META_KEYWORDS'), ENT_QUOTES, 'UTF-8', true);?>
" />
	<meta name="google-site-verification" content="bTCfDHCphQx6TBpRPW2kD8KCFii5CginoCuvlA30iRc" />
	<meta name="google-site-verification" content="TbgodL-oY8WU0EzwGUsQRVHFaW0AlhMfphGCTKVUlUA" />
	<meta name="yandex-verification" content="52b1e8e95027dfaa" />
	<meta name="yandex-verification" content="676d8ae0b94ec83e" />
	<meta name="msvalidate.01" content="608804491F64BA8EB3473B4D82A00BC6" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="facebook-domain-verification" content="ad6un76hvxt2d8w7umcychuees0qus" />
	
	<link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/apple-touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="167x167" href="/images/apple-touch-icon-ipad-retina.png">

	
	
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<?php if ((true && ($_smarty_tpl->hasVariable('DEPT') && null !== ($_smarty_tpl->getValue('DEPT') ?? null))) && $_smarty_tpl->getValue('DEPT') == 'landscape') {?>
	<link rel="stylesheet" type="text/css" href="/css/style_ls.css?v=<?php echo time();?>
" />
	<link rel="stylesheet" type="text/css" href="/css/nav_ls.css?v=<?php echo time();?>
" />
	<?php } else { ?>
	<link rel="stylesheet" type="text/css" href="/css/style.css?v=<?php echo time();?>
" />
	<link rel="stylesheet" type="text/css" href="/css/nav.css?v=<?php echo time();?>
" />
	<?php }?>
	
	<?php echo $_smarty_tpl->getValue('META_REL_ALTERNATE');?>

	<?php echo $_smarty_tpl->getValue('META_REL_CANONICAL');?>

	<?php echo $_smarty_tpl->getValue('META_NOFOLLOW');?>

	
	<?php if ($_smarty_tpl->getValue('URL')[0] == 'product') {?>
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php echo $_smarty_tpl->getValue('OG_TITLE');?>
" />
		<meta property="og:url" content="<?php echo $_smarty_tpl->getValue('OG_LINK');?>
" />
		<meta property="og:description" content="Шукаєш <?php echo $_smarty_tpl->getValue('OG_TITLE');?>
? Заходь та обирай прямо зараз!" />
		<meta property="article:author" content="https://www.facebook.com/floren.com.ua/" />
		<meta property="og:image" content="<?php echo $_smarty_tpl->getValue('OG_IMAGE');?>
" />
		<meta property="og:publisher" content="https://www.facebook.com/floren.com.ua/" />
		<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
<?php }
if ($_smarty_tpl->getValue('URL')[0] == 'wedding_bouquet') {?>
		<meta property="og:type" content="product" />
		<meta property="og:site_name" content="floren.com.ua" />
		<meta property="og:title" content="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
" />
		<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/wedding_bouquet/<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
/" />
		<meta property="og:image" content="https://floren.com.ua/images/ins/b/<?php echo $_smarty_tpl->getValue('GOOD_ONE')['image'];?>
" />
		<meta property="og:description" content="Отличный свадебный букет. Ну очень красивый." />
<?php }
if ($_smarty_tpl->getValue('URL')[0] == 'bouquet') {?>
		<meta property="og:type" content="product" />
		<meta property="og:site_name" content="floren.com.ua" />
		<meta property="og:title" content="<?php echo $_smarty_tpl->getValue('GOOD_ONE')['name'];?>
" />
		<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/bouquet/<?php echo $_smarty_tpl->getValue('GOOD_ONE')['ID'];?>
/" />
		<meta property="og:image" content="https://floren.com.ua/images/ins/b/<?php echo $_smarty_tpl->getValue('GOOD_ONE')['image'];?>
" />
		<meta property="og:description" content="Отличный букет. Ну очень красивый. Подарите мне такой!" />
<?php }
if (($_smarty_tpl->getValue('URL')[0] == 'lechuza') && $_smarty_tpl->getValue('URL')[1] == '' || ($_smarty_tpl->getValue('URL')[0] == 'planters') || ($_smarty_tpl->getValue('URL')[0] == 'komnatnie-rasteniya')) {?>
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<!--page_title-->" />
	<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('URL')[0];?>
/<?php echo $_smarty_tpl->getValue('URL')[1];?>
/" />
	<meta property="og:description" content="Шукаєш <!--page_title--> ? Заходь та обирай прямо зараз!" />
	<meta property="article:author" content="https://www.facebook.com/floren.com.ua/" />
	<meta property="og:image" content="https://floren.com.ua/images/lechuza/big_<?php echo $_smarty_tpl->getValue('URL')[1];?>
_<?php echo $_smarty_tpl->getValue('G_FIRST_COLOR_INPUT');?>
.jpg" />
	<meta property="og:publisher" content="https://www.facebook.com/floren.com.ua/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
<?php }
if (($_smarty_tpl->getValue('URL')[0] == 'publications') && $_smarty_tpl->getValue('URL')[1] != '') {?>
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('ARTICLE')['meta_title'],100);?>
" />
	<meta property="og:description" content="<?php echo $_smarty_tpl->getValue('ARTICLE')['meta_description'];?>
" />
	<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/publications/<?php echo $_smarty_tpl->getValue('URL')[1];?>
/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="<?php echo $_smarty_tpl->getValue('ARTICLE')['images'];?>
" />
	<meta property="og:image:width" content="<?php echo $_smarty_tpl->getValue('ARTICLE_IMAGE')[0];?>
" />
	<meta property="og:image:height" content="<?php echo $_smarty_tpl->getValue('ARTICLE_IMAGE')[1];?>
" />
	<meta property="og:image:alt" content="<?php echo $_smarty_tpl->getValue('ARTICLE')['title'];?>
 фото 1" />
<?php }
if (($_smarty_tpl->getValue('URL')[0] == 'services') && $_smarty_tpl->getValue('URL')[1] != '') {?>
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('SERVICE')['meta_title'],100);?>
" />
	<meta property="og:description" content="<?php echo $_smarty_tpl->getValue('SERVICE')['meta_description'];?>
" />
	<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/<?php echo $_smarty_tpl->getValue('URL')[1];?>
/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="<?php echo $_smarty_tpl->getValue('SERVICE')['schema_image'];?>
" />
	<meta property="og:image:width" content="<?php echo $_smarty_tpl->getValue('SERVICE_IMAGE')[0];?>
" />
	<meta property="og:image:height" content="<?php echo $_smarty_tpl->getValue('SERVICE_IMAGE')[1];?>
" />
	<meta property="og:image:alt" content="<?php echo $_smarty_tpl->getValue('SERVICE')['title'];?>
 фото 1" />
<?php }
if ($_smarty_tpl->getValue('URL')[0] == 'phytodesign') {?>
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('META_TITLE'),100);?>
" />
	<meta property="og:description" content="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('META_DESCRIPTION'), ENT_QUOTES, 'UTF-8', true);?>
" />
	<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/phytodesign/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="https://floren.com.ua/images/content/phyto-design-office-1-s.jpg" />
	<meta property="og:image:width" content="350" />
	<meta property="og:image:height" content="150" />
	<meta property="og:image:alt" content="Фітодизайн інте&#700;єра приміщення фото 1" />
<?php }?>


<?php if ((true && ($_smarty_tpl->hasVariable('DEPT') && null !== ($_smarty_tpl->getValue('DEPT') ?? null))) && $_smarty_tpl->getValue('DEPT') == 'landscape') {?>
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('META_TITLE'),100);?>
" />
	<meta property="og:description" content="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('META_DESCRIPTION'), ENT_QUOTES, 'UTF-8', true);?>
" />
	<meta property="og:url" content="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/<?php echo $_smarty_tpl->getValue('URL')[0];?>
/<?php if ($_smarty_tpl->getValue('URL')[1] != '') {
echo $_smarty_tpl->getValue('URL')[1];?>
/<?php }?>" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="<?php echo $_smarty_tpl->getValue('SCHEMA_IMAGE_URL');?>
" />
	<meta property="og:image:width" content="<?php echo $_smarty_tpl->getValue('SCHEMA_IMAGE_SIZE')[0];?>
" />
	<meta property="og:image:height" content="<?php echo $_smarty_tpl->getValue('SCHEMA_IMAGE_SIZE')[1];?>
" />
	<meta property="og:image:alt" content="<?php echo $_smarty_tpl->getValue('TITLE');?>
 фото 1" />
<?php }?>


	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.12.4.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"><?php echo '</script'; ?>
>





	<?php echo '<script'; ?>
 type="text/javascript" src="/js/common.js?v=<?php echo time();?>
" defer="defer"><?php echo '</script'; ?>
>

	<link rel="stylesheet" href="/js/intl-tel-input-17.0.0/build/css/intlTelInput.min.css">
	<link rel="stylesheet" href="/js/owl-carousel/dist/assets/owl.carousel.min.css?v=3">
	<link rel="stylesheet" href="/js/owl-carousel/dist/assets/owl.theme.default.min.css">


<?php echo '<script'; ?>
 type="text/javascript">

    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "t92qk5thlj");

<?php echo '</script'; ?>
>
	
	<?php if ($_smarty_tpl->getValue('URL')[0] == '') {?>
	
	<?php echo '<script'; ?>
 type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "BreadcrumbList",
 			"itemListElement":
 				[
  					{
  						"@type": "ListItem",
						"position": 1,
						"item":
								{
									"@id": "https://floren.com.ua/",
									"name": "Флорен"
    							}
  					},
  					{
						"@type": "ListItem",
						"position": 2,
						"item":
							{
								"@id": "https://floren.com.ua/#cityPhones",
								"name": "Озеление помещений &#127795; — Флорен"
							}
					}
			]
		}
<?php echo '</script'; ?>
>

<?php }?>

	<?php echo '<script'; ?>
 type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "WebSite",
			"url": "https://floren.com.ua/",
			"potentialAction": {
				"@type": "SearchAction",
				"target": "https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/search/?srch={search_term_string}",
				"query-input": "required name=search_term_string" }
		}
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="application/ld+json">
		{ 
			"@context": "http://schema.org",
			"@type": "LocalBusiness",
			"url": "https://floren.com.ua<?php if ($_smarty_tpl->getValue('LANGURL') == '/ua') {?>/<?php } else { ?>/ru/<?php }?>",
			"priceRange": "$$",
			"name": "<?php echo $_smarty_tpl->getValue('LINGVO')['logo_alt'];?>
",
			"logo": "https://floren.com.ua/img/logo45.png",
			"image": [
				"https://floren.com.ua/images/content/c-ea30e396-8f84-47bf-bcef-758ef0610025-1528372794.jpg",
				"https://floren.com.ua/images/gallery/b/vertikalnoe-ozelenenie-3.jpg",
				"https://floren.com.ua/images/moss/b/moh-montazh-1.jpg"
			],
			"sameAs": [
				"https://www.facebook.com/floren.com.ua/", 
				"https://www.youtube.com/channel/UClfLL4epyim3T5GX0nj2zKQ",
				"https://www.instagram.com/studio_floren/"
			],
			"currenciesAccepted": "UAH",
			"paymentAccepted": "cash, credit card",
			"hasMap": "https://goo.gl/maps/UPpaCBkrMd2TWfXq7",
			"address": {
				"@type": "PostalAddress",
				"@id": "https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/contacts/",
				"name": "<?php echo $_smarty_tpl->getValue('LINGVO')['studiya_fitodizayna'];?>
", 
				"addressRegion": "<?php echo $_smarty_tpl->getValue('LINGVO')['kiev_region'];?>
",
				"addressLocality": "<?php echo $_smarty_tpl->getValue('LINGVO')['city_kiev'];?>
",     
				"postalCode": "03113",
				"streetAddress": "<?php echo $_smarty_tpl->getValue('LINGVO')['address_street'];?>
",
				"telephone": "+38 (044) 333-77-55",
				"email": "info@floren.com.ua",
				"addressCountry": "UA"
			},
			"contactPoint": [
			{
				"@type": "ContactPoint",
				"telephone": "+38 (099) 238-26-44",
				"contactType": "customer support"
			}],
			"openingHoursSpecification": [
			{
				"@type": "OpeningHoursSpecification",
				"dayOfWeek": [
				"Monday",
				"Tuesday",
				"Wednesday",
				"Thursday",
				"Friday",
				"Saturday"
				],
				"opens": "09:00",
				"closes": "19:30"
			},
			{
				"@type": "OpeningHoursSpecification",
				"dayOfWeek": "Sunday",
				"opens": "10:00",
				"closes": "18:00"
			}
		]
	}

<?php echo '</script'; ?>
>



		 <!--[if IE]>
<?php echo '<script'; ?>
>document.createElement('header');document.createElement('nav');document.createElement('section');document.createElement('article');document.createElement('aside');document.createElement('footer');<?php echo '</script'; ?>
>
 		<![endif]-->


<!-- Google Tag Manager -->
<?php echo '<script'; ?>
>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W7VHLVP');<?php echo '</script'; ?>
>
<!-- End Google Tag Manager -->


<?php echo '<script'; ?>
 type="text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-20410887-2');
ga('send', 'pageview');
<?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 async src="https://www.googletagmanager.com/gtag/js?id=AW-736148489"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-736148489');
  gtag('get', 'G-KKVRZ8YBC3', 'client_id', (clientID) => {
       $.post('/bsk/save_to_session.php?r=3',{gaClientId:clientID}, function(data) {});
     });
<?php echo '</script'; ?>
>




<?php echo '<script'; ?>
>

	<?php echo $_smarty_tpl->getValue('GTAG');?>


<?php echo '</script'; ?>
>

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W7VHLVP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="container">
	<header class="header">
		<div class="header__holder">
			<div class="header__block">

				<a href="<?php if ($_smarty_tpl->getValue('LANGURL') == '/ua') {?>/<?php } else { ?>/ru/<?php }?>" class="logo">
					<img src="/img/logo25.svg" width="135" decoding="async" alt="Флорен">
				</a>

				<div class="header__contacts">
						<div class="header__flex">

							<div class="lang_mobile lang">
								<<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>span<?php } else { ?>a href="<?php echo $_smarty_tpl->getValue('LANG_SELECTOR_UA');?>
" hreflang="uk-UA"<?php }?> class="lang__ua<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?> lang__active<?php }?>">UA</<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>span<?php } else { ?>a<?php }?>>
								|
								<<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?>span<?php } else { ?>a href="<?php echo $_smarty_tpl->getValue('LANG_SELECTOR_RU');?>
" hreflang="ru-UA"<?php }?> class="lang__ru<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?> lang__active<?php }?>">RU</<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?>span<?php } else { ?>a<?php }?>>
							</div>

							<div data-tooltip class="header__location">

								<div class="header__mobileinfo">
									<p class="header__shops" data-modal-trg="1" data-modal-wdt="768"><?php echo $_smarty_tpl->getValue('LINGVO')['kiev_shops'];?>
</p>
									<p class="header__callback header__cta" data-modal-trg="2" data-modal-wdt="600"><?php echo $_smarty_tpl->getValue('LINGVO')['contact_us'];?>
</p>
								</div>
								
								<div data-tooltip-content class="tooltip tooltip_loc tooltip_hide">
									<a class="header__addr" href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank"><span class="header__addr-shop"><?php echo $_smarty_tpl->getValue('LINGVO')['address_street'];?>
</span></a>
																	<p class="header__opening-hours"><?php echo $_smarty_tpl->getValue('LINGVO')['opening_hours'];?>
:</p>
									<span>пн-сб: 09:00-19:30</span>
									<p><?php echo $_smarty_tpl->getValue('LINGVO')['sunday'];?>
: 10:00-18:00</p>
								</div>

								<div data-modal="1" class="modal modal_center modal_hide">
									<button class="close-btn"></button>
									<div>
										<p class="modal__headline"><?php echo $_smarty_tpl->getValue('LINGVO')['kiev_shops'];?>
</p>
										<a class="header__addr" href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank"><span class="header__addr-shop"><?php echo $_smarty_tpl->getValue('LINGVO')['address_street'];?>
</span></a>
																			<p class="header__opening-hours"><?php echo $_smarty_tpl->getValue('LINGVO')['opening_hours'];?>
:</p>
										<span>пн-сб: 09:00-19:30</span>
										<p><?php echo $_smarty_tpl->getValue('LINGVO')['sunday'];?>
: 10:00-18:00</p>
									</div>
									<div>
										<a class="header__phone binct-phone-number-1" href="tel:+380443337755">(044) 333-77-55</a>
										<a class="header__phone binct-phone-number-2" href="tel:+380992382644">(099) 238-26-44</a>
									</div>
								</div>

							</div>


						</div>

						<div class="header__numbers">
							<div class="header__phones">
								<a class="header__phone binct-phone-number-1" href="tel:+380443337755">(044) 333-77-55</a>
								<a class="header__phone binct-phone-number-2" href="tel:+380992382644">(099) 238-26-44</a>
														<div class="phone_svg_holder">
								<a href="https://t.me/studio_floren" class="phone_svg" target="_blank" onclick="trackConv('tg')">
								
<svg width="25" height="25" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30 0C13.4297 0 0 13.4297 0 30C0 46.5703 13.4297 60 30 60C46.5703 60 60 46.5703 60 30C60 13.4297 46.5703 0 30 0Z" fill="#29B6F6"/><path d="M44.7583 16.4907L39.098 45C39.098 45 38.856 46.3044 37.2211 46.3044C36.3475 46.3044 35.8989 45.8967 35.8989 45.8967L23.6399 35.8579L17.6431 32.8766L9.94062 30.856C9.94062 30.856 8.57129 30.4658 8.57129 29.3478C8.57129 28.4162 9.98194 27.9736 9.98194 27.9736L42.1908 15.3494C42.1849 15.3494 43.1706 15 43.8907 15C44.3333 15 44.835 15.1863 44.835 15.7453C44.835 16.118 44.7583 16.4907 44.7583 16.4907Z" fill="white"/><path d="M28.352 39.6868L23.2599 44.816C23.2599 44.816 23.0392 44.9882 22.7431 45.0001C22.6386 45.0001 22.5283 44.9823 22.418 44.9348L23.8521 35.8696L28.352 39.6868Z" fill="#B0BEC5"/><path d="M38.7485 21.1641C38.4894 20.8333 38.0185 20.7742 37.6888 21.0223L17.8018 32.9669C17.8018 32.9669 20.975 41.8751 21.4577 43.4169C21.9464 44.9646 22.3349 45.0001 22.3349 45.0001L23.7891 35.9796L38.6072 22.2215C38.9369 21.9734 38.9957 21.4949 38.7485 21.1641Z" fill="#CFD8DC"/><circle cx="30" cy="30" r="30" fill="white"/><path d="M30 0C13.4297 0 0 13.4297 0 30C0 46.5703 13.4297 60 30 60C46.5703 60 60 46.5703 60 30C60 13.4297 46.5703 0 30 0Z" fill="#29B6F6"/><path d="M44.7583 16.4907L39.098 45C39.098 45 38.856 46.3044 37.2211 46.3044C36.3475 46.3044 35.8989 45.8967 35.8989 45.8967L23.6399 35.8579L17.6431 32.8766L9.94062 30.856C9.94062 30.856 8.57129 30.4658 8.57129 29.3478C8.57129 28.4162 9.98194 27.9736 9.98194 27.9736L42.1908 15.3494C42.1849 15.3494 43.1706 15 43.8907 15C44.3333 15 44.835 15.1863 44.835 15.7453C44.835 16.118 44.7583 16.4907 44.7583 16.4907Z" fill="white"/><path d="M28.3511 39.6868L23.2589 44.816C23.2589 44.816 23.0383 44.9882 22.7421 45.0001C22.6376 45.0001 22.5273 44.9823 22.417 44.9348L23.8512 35.8696L28.3511 39.6868Z" fill="#B0BEC5"/><path d="M38.7494 21.1641C38.4904 20.8333 38.0194 20.7742 37.6897 21.0223L17.8027 32.9669C17.8027 32.9669 20.9759 41.8751 21.4587 43.4169C21.9473 44.9646 22.3359 45.0001 22.3359 45.0001L23.79 35.9796L38.6082 22.2215C38.9378 21.9734 38.9967 21.4949 38.7494 21.1641Z" fill="#CFD8DC"/></svg>
								</a>
								
								<a href="viber://chat?number=%2B380992382644" class="phone_svg" target="_blank" onclick="trackConv('vb','<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('implode')('/',$_smarty_tpl->getValue('URL'));?>
')">
								

<svg width="25" height="25" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 30C0 46.5685 13.4315 60 30 60C46.5685 60 60 46.5685 60 30C60 13.4315 46.5685 0 30 0C13.4315 0 0 13.4315 0 30Z" fill="#7D3DAF"/><path d="M48.9758 19.3405L48.9639 19.2931C48.0055 15.4185 43.6845 11.2608 39.7164 10.3958L39.6716 10.3866C33.2533 9.16216 26.7455 9.16216 20.3286 10.3866L20.2825 10.3958C16.3157 11.2608 11.9947 15.4185 11.035 19.2931L11.0244 19.3405C9.83951 24.7516 9.83951 30.2391 11.0244 35.6502L11.035 35.6975C11.9538 39.4068 15.953 43.3735 19.773 44.4644V48.7896C19.773 50.355 21.6807 51.1239 22.7656 49.9943L27.1478 45.4391C28.0982 45.4923 29.0491 45.5219 30.0001 45.5219C33.2309 45.5219 36.4631 45.2165 39.6716 44.6043L39.7164 44.595C43.6845 43.73 48.0055 39.5723 48.9639 35.6977L48.9758 35.6503C50.1607 30.2391 50.1607 24.7516 48.9758 19.3405ZM45.5079 34.8655C44.8681 37.3933 41.5872 40.5359 38.9804 41.1165C35.5677 41.7655 32.1281 42.0429 28.6918 41.9477C28.6235 41.9458 28.5578 41.9723 28.5101 42.0213C28.0225 42.5218 25.3105 45.3059 25.3105 45.3059L21.9072 48.7987C21.6583 49.0581 21.2212 48.8816 21.2212 48.5235V41.3585C21.2212 41.2402 21.1367 41.1396 21.0205 41.1168C21.0198 41.1167 21.0191 41.1165 21.0185 41.1164C18.4117 40.5358 15.1321 37.3932 14.4909 34.8653C13.4245 29.9743 13.4245 25.0161 14.4909 20.1251C15.1321 17.5973 18.4117 14.4546 21.0185 13.874C26.9786 12.7405 33.0216 12.7405 38.9804 13.874C41.5885 14.4546 44.8681 17.5973 45.5079 20.1251C46.5755 25.0162 46.5755 29.9744 45.5079 34.8655Z" fill="white"/><path d="M35.671 38.1728C35.2702 38.0511 34.8883 37.9694 34.5336 37.8222C30.8583 36.2973 27.4757 34.3301 24.7964 31.3145C23.2727 29.5997 22.0802 27.6637 21.0721 25.6149C20.594 24.6432 20.1912 23.6336 19.7805 22.6305C19.4061 21.7157 19.9576 20.7707 20.5384 20.0815C21.0833 19.4346 21.7845 18.9396 22.5439 18.5748C23.1366 18.29 23.7213 18.4542 24.1542 18.9566C25.09 20.0428 25.9496 21.1845 26.6457 22.4435C27.0737 23.2179 26.9562 24.1645 26.1805 24.6915C25.992 24.8196 25.8202 24.97 25.6445 25.1147C25.4905 25.2415 25.3455 25.3696 25.24 25.5413C25.0469 25.8554 25.0377 26.2259 25.162 26.5674C26.1186 29.1963 27.731 31.2405 30.3771 32.3416C30.8005 32.5177 31.2257 32.7229 31.7135 32.666C32.5304 32.5705 32.7949 31.6745 33.3674 31.2063C33.9269 30.7488 34.642 30.7427 35.2447 31.1242C35.8475 31.5057 36.432 31.9153 37.0128 32.3292C37.583 32.7355 38.1507 33.133 38.6767 33.5961C39.1824 34.0415 39.3566 34.6258 39.0718 35.2303C38.5505 36.3372 37.7918 37.2582 36.6975 37.846C36.3885 38.0118 36.0195 38.0655 35.671 38.1728C35.2702 38.051 36.0195 38.0655 35.671 38.1728Z" fill="white"/><path d="M30.0103 17.3091C34.8177 17.4438 38.7662 20.6342 39.6124 25.3871C39.7566 26.1969 39.8079 27.0249 39.872 27.8468C39.899 28.1925 39.7032 28.521 39.3301 28.5255C38.9448 28.5301 38.7714 28.2077 38.7464 27.8621C38.6969 27.178 38.6625 26.4909 38.5682 25.8124C38.0706 22.2312 35.2149 19.2684 31.6503 18.6327C31.114 18.537 30.565 18.5118 30.0216 18.4548C29.6781 18.4187 29.2282 18.3979 29.1521 17.971C29.0883 17.613 29.3904 17.328 29.7313 17.3097C29.824 17.3045 29.9172 17.3087 30.0103 17.3091C34.8177 17.4438 29.9172 17.3087 30.0103 17.3091Z" fill="white"/><path d="M37.316 26.78C37.3081 26.84 37.3039 26.9811 37.2687 27.1141C37.1411 27.5968 36.4094 27.6572 36.2409 27.1701C36.191 27.0255 36.1835 26.8611 36.1832 26.7054C36.1815 25.6872 35.9602 24.67 35.4467 23.7841C34.9189 22.8736 34.1125 22.1081 33.1667 21.645C32.5948 21.3649 31.9762 21.1909 31.3494 21.0871C31.0755 21.0418 30.7986 21.0143 30.5233 20.976C30.1897 20.9297 30.0115 20.717 30.0273 20.3883C30.0421 20.0802 30.2672 19.8586 30.6029 19.8776C31.7062 19.9403 32.7718 20.1787 33.7527 20.6981C35.7473 21.7544 36.8866 23.4217 37.2192 25.648C37.2342 25.7488 37.2584 25.8487 37.2661 25.95C37.2849 26.2 37.2968 26.4503 37.316 26.78C37.3081 26.84 37.2968 26.4503 37.316 26.78Z" fill="white"/><path d="M34.326 26.6632C33.9237 26.6704 33.7085 26.4478 33.667 26.079C33.6382 25.8219 33.6154 25.5614 33.5541 25.3112C33.4332 24.8186 33.1713 24.362 32.7569 24.0601C32.5612 23.9175 32.3395 23.8136 32.1073 23.7466C31.8122 23.6614 31.5059 23.6849 31.2115 23.6127C30.8918 23.5344 30.715 23.2755 30.7653 22.9756C30.811 22.7027 31.0765 22.4897 31.3747 22.5113C33.2386 22.6458 34.5707 23.6094 34.7608 25.8036C34.7743 25.9584 34.7901 26.1221 34.7557 26.2702C34.6968 26.5238 34.5091 26.6508 34.326 26.6632C33.9237 26.6704 34.5091 26.6508 34.326 26.6632Z" fill="white"/><circle cx="30" cy="30" r="30" fill="white"/><path d="M0 30C0 46.5685 13.4315 60 30 60C46.5685 60 60 46.5685 60 30C60 13.4315 46.5685 0 30 0C13.4315 0 0 13.4315 0 30Z" fill="#7D3DAF"/><path d="M48.9748 19.3405L48.9629 19.2931C48.0045 15.4185 43.6835 11.2608 39.7154 10.3958L39.6706 10.3866C33.2524 9.16216 26.7446 9.16216 20.3276 10.3866L20.2815 10.3958C16.3147 11.2608 11.9938 15.4185 11.034 19.2931L11.0234 19.3405C9.83854 24.7516 9.83854 30.2391 11.0234 35.6502L11.034 35.6975C11.9528 39.4068 15.952 43.3735 19.772 44.4644V48.7896C19.772 50.355 21.6797 51.1239 22.7646 49.9943L27.1468 45.4391C28.0972 45.4923 29.0482 45.5219 29.9991 45.5219C33.23 45.5219 36.4621 45.2165 39.6706 44.6043L39.7154 44.595C43.6835 43.73 48.0045 39.5723 48.9629 35.6977L48.9748 35.6503C50.1597 30.2391 50.1597 24.7516 48.9748 19.3405ZM45.507 34.8655C44.8671 37.3933 41.5862 40.5359 38.9794 41.1165C35.5667 41.7655 32.1271 42.0429 28.6908 41.9477C28.6225 41.9458 28.5568 41.9723 28.5092 42.0213C28.0215 42.5218 25.3095 45.3059 25.3095 45.3059L21.9062 48.7987C21.6574 49.0581 21.2203 48.8816 21.2203 48.5235V41.3585C21.2203 41.2402 21.1357 41.1396 21.0195 41.1168C21.0188 41.1167 21.0182 41.1165 21.0175 41.1164C18.4107 40.5358 15.1311 37.3932 14.49 34.8653C13.4235 29.9743 13.4235 25.0161 14.49 20.1251C15.1311 17.5973 18.4107 14.4546 21.0175 13.874C26.9776 12.7405 33.0206 12.7405 38.9794 13.874C41.5875 14.4546 44.8671 17.5973 45.507 20.1251C46.5746 25.0162 46.5746 29.9744 45.507 34.8655Z" fill="white"/><path d="M35.67 38.1728C35.2692 38.0511 34.8873 37.9694 34.5326 37.8222C30.8573 36.2973 27.4748 34.3301 24.7954 31.3145C23.2718 29.5997 22.0792 27.6637 21.0711 25.6149C20.5931 24.6432 20.1902 23.6336 19.7796 22.6305C19.4051 21.7157 19.9566 20.7707 20.5374 20.0815C21.0823 19.4346 21.7835 18.9396 22.5429 18.5748C23.1356 18.29 23.7203 18.4542 24.1532 18.9566C25.089 20.0428 25.9486 21.1845 26.6447 22.4435C27.0727 23.2179 26.9553 24.1645 26.1795 24.6915C25.991 24.8196 25.8192 24.97 25.6436 25.1147C25.4895 25.2415 25.3446 25.3696 25.239 25.5413C25.046 25.8554 25.0368 26.2259 25.161 26.5674C26.1177 29.1963 27.7301 31.2405 30.3761 32.3416C30.7995 32.5177 31.2248 32.7229 31.7125 32.666C32.5295 32.5705 32.794 31.6745 33.3664 31.2063C33.926 30.7488 34.641 30.7427 35.2437 31.1242C35.8466 31.5057 36.431 31.9153 37.0119 32.3292C37.5821 32.7355 38.1498 33.133 38.6757 33.5961C39.1814 34.0415 39.3556 34.6258 39.0708 35.2303C38.5495 36.3372 37.7909 37.2582 36.6965 37.846C36.3875 38.0118 36.0185 38.0655 35.67 38.1728C35.2692 38.051 36.0185 38.0655 35.67 38.1728Z" fill="white"/><path d="M30.0093 17.3091C34.8168 17.4438 38.7653 20.6342 39.6114 25.3871C39.7556 26.1969 39.8069 27.0249 39.8711 27.8468C39.898 28.1925 39.7023 28.521 39.3292 28.5255C38.9438 28.5301 38.7704 28.2077 38.7454 27.8621C38.6959 27.178 38.6615 26.4909 38.5673 25.8124C38.0696 22.2312 35.214 19.2684 31.6494 18.6327C31.113 18.537 30.564 18.5118 30.0206 18.4548C29.6771 18.4187 29.2273 18.3979 29.1512 17.971C29.0873 17.613 29.3895 17.328 29.7303 17.3097C29.823 17.3045 29.9162 17.3087 30.0093 17.3091C34.8168 17.4438 29.9162 17.3087 30.0093 17.3091Z" fill="white"/><path d="M37.315 26.78C37.3071 26.84 37.3029 26.9811 37.2677 27.1141C37.1402 27.5968 36.4084 27.6572 36.2399 27.1701C36.19 27.0255 36.1825 26.8611 36.1822 26.7054C36.1805 25.6872 35.9592 24.67 35.4457 23.7841C34.9179 22.8736 34.1115 22.1081 33.1657 21.645C32.5938 21.3649 31.9753 21.1909 31.3485 21.0871C31.0745 21.0418 30.7976 21.0143 30.5223 20.976C30.1887 20.9297 30.0106 20.717 30.0264 20.3883C30.0411 20.0802 30.2662 19.8586 30.602 19.8776C31.7052 19.9403 32.7709 20.1787 33.7517 20.6981C35.7463 21.7544 36.8857 23.4217 37.2182 25.648C37.2332 25.7488 37.2575 25.8487 37.2651 25.95C37.2839 26.2 37.2958 26.4503 37.315 26.78C37.3071 26.84 37.2958 26.4503 37.315 26.78Z" fill="white"/><path d="M34.325 26.6637C33.9228 26.6709 33.7075 26.4483 33.666 26.0795C33.6372 25.8224 33.6144 25.5619 33.5531 25.3117C33.4322 24.819 33.1704 24.3625 32.7559 24.0606C32.5603 23.918 32.3385 23.8141 32.1063 23.7471C31.8113 23.6619 31.5049 23.6853 31.2105 23.6132C30.8909 23.5349 30.714 23.276 30.7643 22.9761C30.81 22.7032 31.0756 22.4902 31.3738 22.5118C33.2376 22.6463 34.5697 23.6099 34.7598 25.8041C34.7733 25.9589 34.7891 26.1226 34.7547 26.2707C34.6959 26.5243 34.5081 26.6513 34.325 26.6637C33.9228 26.6709 34.5081 26.6513 34.325 26.6637Z" fill="white"/></svg>
								</a>
								
								<span class="phone_svg" onclick="show_fb();">
								
<svg width="25" height="25" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30 0C13.4297 0 0 13.4297 0 30C0 46.5703 13.4297 60 30 60C46.5703 60 60 46.5703 60 30C60 13.4297 46.5703 0 30 0Z" fill="white"/><circle cx="30" cy="30" r="30" fill="#4CAF50"/><path fill-rule="evenodd" clip-rule="evenodd" d="M28.151 33.5238C24.0627 30.6497 20.0342 27.2 21.3482 25.3285C23.2303 22.6486 24.9723 20.8967 20.0548 16.5727C15.1349 12.2492 13.1155 16.5818 11.2894 19.1764C9.18552 22.1718 13.2561 31.2553 24.2903 39.0125C35.324 46.7675 45.2501 47.5277 47.3563 44.532C49.1824 41.9375 52.5736 38.5711 46.8377 35.4055C41.1063 32.2393 40.0474 34.4713 38.1631 37.1516C36.8488 39.021 32.2392 36.398 28.151 33.5238Z" fill="white" stroke="white"/></svg>
								<span>
								
								
								</div>
							</div>

							<div class="modal modal_center modal_hide" data-modal="2">
								<button class="close-btn"></button>
								<div>
									<p class="modal__headline"><?php echo $_smarty_tpl->getValue('LINGVO')['contact_us'];?>
</p>
									<div>
										<a class="header__phone binct-phone-number-1" href="tel:+380443337755">(044) 333-77-55</a>
										<a class="header__phone binct-phone-number-2" href="tel:+380992382644">(099) 238-26-44</a>
									</div>
																	<div class="phone_svg_holder" style="margin-top:10px;">
								<a href="https://t.me/studio_floren" class="phone_svg" target="_blank">
								
<svg width="25" height="25" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30 0C13.4297 0 0 13.4297 0 30C0 46.5703 13.4297 60 30 60C46.5703 60 60 46.5703 60 30C60 13.4297 46.5703 0 30 0Z" fill="#29B6F6"/><path d="M44.7583 16.4907L39.098 45C39.098 45 38.856 46.3044 37.2211 46.3044C36.3475 46.3044 35.8989 45.8967 35.8989 45.8967L23.6399 35.8579L17.6431 32.8766L9.94062 30.856C9.94062 30.856 8.57129 30.4658 8.57129 29.3478C8.57129 28.4162 9.98194 27.9736 9.98194 27.9736L42.1908 15.3494C42.1849 15.3494 43.1706 15 43.8907 15C44.3333 15 44.835 15.1863 44.835 15.7453C44.835 16.118 44.7583 16.4907 44.7583 16.4907Z" fill="white"/><path d="M28.352 39.6868L23.2599 44.816C23.2599 44.816 23.0392 44.9882 22.7431 45.0001C22.6386 45.0001 22.5283 44.9823 22.418 44.9348L23.8521 35.8696L28.352 39.6868Z" fill="#B0BEC5"/><path d="M38.7485 21.1641C38.4894 20.8333 38.0185 20.7742 37.6888 21.0223L17.8018 32.9669C17.8018 32.9669 20.975 41.8751 21.4577 43.4169C21.9464 44.9646 22.3349 45.0001 22.3349 45.0001L23.7891 35.9796L38.6072 22.2215C38.9369 21.9734 38.9957 21.4949 38.7485 21.1641Z" fill="#CFD8DC"/><circle cx="30" cy="30" r="30" fill="white"/><path d="M30 0C13.4297 0 0 13.4297 0 30C0 46.5703 13.4297 60 30 60C46.5703 60 60 46.5703 60 30C60 13.4297 46.5703 0 30 0Z" fill="#29B6F6"/><path d="M44.7583 16.4907L39.098 45C39.098 45 38.856 46.3044 37.2211 46.3044C36.3475 46.3044 35.8989 45.8967 35.8989 45.8967L23.6399 35.8579L17.6431 32.8766L9.94062 30.856C9.94062 30.856 8.57129 30.4658 8.57129 29.3478C8.57129 28.4162 9.98194 27.9736 9.98194 27.9736L42.1908 15.3494C42.1849 15.3494 43.1706 15 43.8907 15C44.3333 15 44.835 15.1863 44.835 15.7453C44.835 16.118 44.7583 16.4907 44.7583 16.4907Z" fill="white"/><path d="M28.3511 39.6868L23.2589 44.816C23.2589 44.816 23.0383 44.9882 22.7421 45.0001C22.6376 45.0001 22.5273 44.9823 22.417 44.9348L23.8512 35.8696L28.3511 39.6868Z" fill="#B0BEC5"/><path d="M38.7494 21.1641C38.4904 20.8333 38.0194 20.7742 37.6897 21.0223L17.8027 32.9669C17.8027 32.9669 20.9759 41.8751 21.4587 43.4169C21.9473 44.9646 22.3359 45.0001 22.3359 45.0001L23.79 35.9796L38.6082 22.2215C38.9378 21.9734 38.9967 21.4949 38.7494 21.1641Z" fill="#CFD8DC"/></svg>
								</a>
								
								<a href="viber://chat?number=%2B380992382644" class="phone_svg" target="_blank">
								

<svg width="25" height="25" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 30C0 46.5685 13.4315 60 30 60C46.5685 60 60 46.5685 60 30C60 13.4315 46.5685 0 30 0C13.4315 0 0 13.4315 0 30Z" fill="#7D3DAF"/><path d="M48.9758 19.3405L48.9639 19.2931C48.0055 15.4185 43.6845 11.2608 39.7164 10.3958L39.6716 10.3866C33.2533 9.16216 26.7455 9.16216 20.3286 10.3866L20.2825 10.3958C16.3157 11.2608 11.9947 15.4185 11.035 19.2931L11.0244 19.3405C9.83951 24.7516 9.83951 30.2391 11.0244 35.6502L11.035 35.6975C11.9538 39.4068 15.953 43.3735 19.773 44.4644V48.7896C19.773 50.355 21.6807 51.1239 22.7656 49.9943L27.1478 45.4391C28.0982 45.4923 29.0491 45.5219 30.0001 45.5219C33.2309 45.5219 36.4631 45.2165 39.6716 44.6043L39.7164 44.595C43.6845 43.73 48.0055 39.5723 48.9639 35.6977L48.9758 35.6503C50.1607 30.2391 50.1607 24.7516 48.9758 19.3405ZM45.5079 34.8655C44.8681 37.3933 41.5872 40.5359 38.9804 41.1165C35.5677 41.7655 32.1281 42.0429 28.6918 41.9477C28.6235 41.9458 28.5578 41.9723 28.5101 42.0213C28.0225 42.5218 25.3105 45.3059 25.3105 45.3059L21.9072 48.7987C21.6583 49.0581 21.2212 48.8816 21.2212 48.5235V41.3585C21.2212 41.2402 21.1367 41.1396 21.0205 41.1168C21.0198 41.1167 21.0191 41.1165 21.0185 41.1164C18.4117 40.5358 15.1321 37.3932 14.4909 34.8653C13.4245 29.9743 13.4245 25.0161 14.4909 20.1251C15.1321 17.5973 18.4117 14.4546 21.0185 13.874C26.9786 12.7405 33.0216 12.7405 38.9804 13.874C41.5885 14.4546 44.8681 17.5973 45.5079 20.1251C46.5755 25.0162 46.5755 29.9744 45.5079 34.8655Z" fill="white"/><path d="M35.671 38.1728C35.2702 38.0511 34.8883 37.9694 34.5336 37.8222C30.8583 36.2973 27.4757 34.3301 24.7964 31.3145C23.2727 29.5997 22.0802 27.6637 21.0721 25.6149C20.594 24.6432 20.1912 23.6336 19.7805 22.6305C19.4061 21.7157 19.9576 20.7707 20.5384 20.0815C21.0833 19.4346 21.7845 18.9396 22.5439 18.5748C23.1366 18.29 23.7213 18.4542 24.1542 18.9566C25.09 20.0428 25.9496 21.1845 26.6457 22.4435C27.0737 23.2179 26.9562 24.1645 26.1805 24.6915C25.992 24.8196 25.8202 24.97 25.6445 25.1147C25.4905 25.2415 25.3455 25.3696 25.24 25.5413C25.0469 25.8554 25.0377 26.2259 25.162 26.5674C26.1186 29.1963 27.731 31.2405 30.3771 32.3416C30.8005 32.5177 31.2257 32.7229 31.7135 32.666C32.5304 32.5705 32.7949 31.6745 33.3674 31.2063C33.9269 30.7488 34.642 30.7427 35.2447 31.1242C35.8475 31.5057 36.432 31.9153 37.0128 32.3292C37.583 32.7355 38.1507 33.133 38.6767 33.5961C39.1824 34.0415 39.3566 34.6258 39.0718 35.2303C38.5505 36.3372 37.7918 37.2582 36.6975 37.846C36.3885 38.0118 36.0195 38.0655 35.671 38.1728C35.2702 38.051 36.0195 38.0655 35.671 38.1728Z" fill="white"/><path d="M30.0103 17.3091C34.8177 17.4438 38.7662 20.6342 39.6124 25.3871C39.7566 26.1969 39.8079 27.0249 39.872 27.8468C39.899 28.1925 39.7032 28.521 39.3301 28.5255C38.9448 28.5301 38.7714 28.2077 38.7464 27.8621C38.6969 27.178 38.6625 26.4909 38.5682 25.8124C38.0706 22.2312 35.2149 19.2684 31.6503 18.6327C31.114 18.537 30.565 18.5118 30.0216 18.4548C29.6781 18.4187 29.2282 18.3979 29.1521 17.971C29.0883 17.613 29.3904 17.328 29.7313 17.3097C29.824 17.3045 29.9172 17.3087 30.0103 17.3091C34.8177 17.4438 29.9172 17.3087 30.0103 17.3091Z" fill="white"/><path d="M37.316 26.78C37.3081 26.84 37.3039 26.9811 37.2687 27.1141C37.1411 27.5968 36.4094 27.6572 36.2409 27.1701C36.191 27.0255 36.1835 26.8611 36.1832 26.7054C36.1815 25.6872 35.9602 24.67 35.4467 23.7841C34.9189 22.8736 34.1125 22.1081 33.1667 21.645C32.5948 21.3649 31.9762 21.1909 31.3494 21.0871C31.0755 21.0418 30.7986 21.0143 30.5233 20.976C30.1897 20.9297 30.0115 20.717 30.0273 20.3883C30.0421 20.0802 30.2672 19.8586 30.6029 19.8776C31.7062 19.9403 32.7718 20.1787 33.7527 20.6981C35.7473 21.7544 36.8866 23.4217 37.2192 25.648C37.2342 25.7488 37.2584 25.8487 37.2661 25.95C37.2849 26.2 37.2968 26.4503 37.316 26.78C37.3081 26.84 37.2968 26.4503 37.316 26.78Z" fill="white"/><path d="M34.326 26.6632C33.9237 26.6704 33.7085 26.4478 33.667 26.079C33.6382 25.8219 33.6154 25.5614 33.5541 25.3112C33.4332 24.8186 33.1713 24.362 32.7569 24.0601C32.5612 23.9175 32.3395 23.8136 32.1073 23.7466C31.8122 23.6614 31.5059 23.6849 31.2115 23.6127C30.8918 23.5344 30.715 23.2755 30.7653 22.9756C30.811 22.7027 31.0765 22.4897 31.3747 22.5113C33.2386 22.6458 34.5707 23.6094 34.7608 25.8036C34.7743 25.9584 34.7901 26.1221 34.7557 26.2702C34.6968 26.5238 34.5091 26.6508 34.326 26.6632C33.9237 26.6704 34.5091 26.6508 34.326 26.6632Z" fill="white"/><circle cx="30" cy="30" r="30" fill="white"/><path d="M0 30C0 46.5685 13.4315 60 30 60C46.5685 60 60 46.5685 60 30C60 13.4315 46.5685 0 30 0C13.4315 0 0 13.4315 0 30Z" fill="#7D3DAF"/><path d="M48.9748 19.3405L48.9629 19.2931C48.0045 15.4185 43.6835 11.2608 39.7154 10.3958L39.6706 10.3866C33.2524 9.16216 26.7446 9.16216 20.3276 10.3866L20.2815 10.3958C16.3147 11.2608 11.9938 15.4185 11.034 19.2931L11.0234 19.3405C9.83854 24.7516 9.83854 30.2391 11.0234 35.6502L11.034 35.6975C11.9528 39.4068 15.952 43.3735 19.772 44.4644V48.7896C19.772 50.355 21.6797 51.1239 22.7646 49.9943L27.1468 45.4391C28.0972 45.4923 29.0482 45.5219 29.9991 45.5219C33.23 45.5219 36.4621 45.2165 39.6706 44.6043L39.7154 44.595C43.6835 43.73 48.0045 39.5723 48.9629 35.6977L48.9748 35.6503C50.1597 30.2391 50.1597 24.7516 48.9748 19.3405ZM45.507 34.8655C44.8671 37.3933 41.5862 40.5359 38.9794 41.1165C35.5667 41.7655 32.1271 42.0429 28.6908 41.9477C28.6225 41.9458 28.5568 41.9723 28.5092 42.0213C28.0215 42.5218 25.3095 45.3059 25.3095 45.3059L21.9062 48.7987C21.6574 49.0581 21.2203 48.8816 21.2203 48.5235V41.3585C21.2203 41.2402 21.1357 41.1396 21.0195 41.1168C21.0188 41.1167 21.0182 41.1165 21.0175 41.1164C18.4107 40.5358 15.1311 37.3932 14.49 34.8653C13.4235 29.9743 13.4235 25.0161 14.49 20.1251C15.1311 17.5973 18.4107 14.4546 21.0175 13.874C26.9776 12.7405 33.0206 12.7405 38.9794 13.874C41.5875 14.4546 44.8671 17.5973 45.507 20.1251C46.5746 25.0162 46.5746 29.9744 45.507 34.8655Z" fill="white"/><path d="M35.67 38.1728C35.2692 38.0511 34.8873 37.9694 34.5326 37.8222C30.8573 36.2973 27.4748 34.3301 24.7954 31.3145C23.2718 29.5997 22.0792 27.6637 21.0711 25.6149C20.5931 24.6432 20.1902 23.6336 19.7796 22.6305C19.4051 21.7157 19.9566 20.7707 20.5374 20.0815C21.0823 19.4346 21.7835 18.9396 22.5429 18.5748C23.1356 18.29 23.7203 18.4542 24.1532 18.9566C25.089 20.0428 25.9486 21.1845 26.6447 22.4435C27.0727 23.2179 26.9553 24.1645 26.1795 24.6915C25.991 24.8196 25.8192 24.97 25.6436 25.1147C25.4895 25.2415 25.3446 25.3696 25.239 25.5413C25.046 25.8554 25.0368 26.2259 25.161 26.5674C26.1177 29.1963 27.7301 31.2405 30.3761 32.3416C30.7995 32.5177 31.2248 32.7229 31.7125 32.666C32.5295 32.5705 32.794 31.6745 33.3664 31.2063C33.926 30.7488 34.641 30.7427 35.2437 31.1242C35.8466 31.5057 36.431 31.9153 37.0119 32.3292C37.5821 32.7355 38.1498 33.133 38.6757 33.5961C39.1814 34.0415 39.3556 34.6258 39.0708 35.2303C38.5495 36.3372 37.7909 37.2582 36.6965 37.846C36.3875 38.0118 36.0185 38.0655 35.67 38.1728C35.2692 38.051 36.0185 38.0655 35.67 38.1728Z" fill="white"/><path d="M30.0093 17.3091C34.8168 17.4438 38.7653 20.6342 39.6114 25.3871C39.7556 26.1969 39.8069 27.0249 39.8711 27.8468C39.898 28.1925 39.7023 28.521 39.3292 28.5255C38.9438 28.5301 38.7704 28.2077 38.7454 27.8621C38.6959 27.178 38.6615 26.4909 38.5673 25.8124C38.0696 22.2312 35.214 19.2684 31.6494 18.6327C31.113 18.537 30.564 18.5118 30.0206 18.4548C29.6771 18.4187 29.2273 18.3979 29.1512 17.971C29.0873 17.613 29.3895 17.328 29.7303 17.3097C29.823 17.3045 29.9162 17.3087 30.0093 17.3091C34.8168 17.4438 29.9162 17.3087 30.0093 17.3091Z" fill="white"/><path d="M37.315 26.78C37.3071 26.84 37.3029 26.9811 37.2677 27.1141C37.1402 27.5968 36.4084 27.6572 36.2399 27.1701C36.19 27.0255 36.1825 26.8611 36.1822 26.7054C36.1805 25.6872 35.9592 24.67 35.4457 23.7841C34.9179 22.8736 34.1115 22.1081 33.1657 21.645C32.5938 21.3649 31.9753 21.1909 31.3485 21.0871C31.0745 21.0418 30.7976 21.0143 30.5223 20.976C30.1887 20.9297 30.0106 20.717 30.0264 20.3883C30.0411 20.0802 30.2662 19.8586 30.602 19.8776C31.7052 19.9403 32.7709 20.1787 33.7517 20.6981C35.7463 21.7544 36.8857 23.4217 37.2182 25.648C37.2332 25.7488 37.2575 25.8487 37.2651 25.95C37.2839 26.2 37.2958 26.4503 37.315 26.78C37.3071 26.84 37.2958 26.4503 37.315 26.78Z" fill="white"/><path d="M34.325 26.6637C33.9228 26.6709 33.7075 26.4483 33.666 26.0795C33.6372 25.8224 33.6144 25.5619 33.5531 25.3117C33.4322 24.819 33.1704 24.3625 32.7559 24.0606C32.5603 23.918 32.3385 23.8141 32.1063 23.7471C31.8113 23.6619 31.5049 23.6853 31.2105 23.6132C30.8909 23.5349 30.714 23.276 30.7643 22.9761C30.81 22.7032 31.0756 22.4902 31.3738 22.5118C33.2376 22.6463 34.5697 23.6099 34.7598 25.8041C34.7733 25.9589 34.7891 26.1226 34.7547 26.2707C34.6959 26.5243 34.5081 26.6513 34.325 26.6637C33.9228 26.6709 34.5081 26.6513 34.325 26.6637Z" fill="white"/></svg>
								</a>
								
								<span class="phone_svg" onclick="show_fb();">
								
<svg width="25" height="25" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30 0C13.4297 0 0 13.4297 0 30C0 46.5703 13.4297 60 30 60C46.5703 60 60 46.5703 60 30C60 13.4297 46.5703 0 30 0Z" fill="white"/><circle cx="30" cy="30" r="30" fill="#4CAF50"/><path fill-rule="evenodd" clip-rule="evenodd" d="M28.151 33.5238C24.0627 30.6497 20.0342 27.2 21.3482 25.3285C23.2303 22.6486 24.9723 20.8967 20.0548 16.5727C15.1349 12.2492 13.1155 16.5818 11.2894 19.1764C9.18552 22.1718 13.2561 31.2553 24.2903 39.0125C35.324 46.7675 45.2501 47.5277 47.3563 44.532C49.1824 41.9375 52.5736 38.5711 46.8377 35.4055C41.1063 32.2393 40.0474 34.4713 38.1631 37.1516C36.8488 39.021 32.2392 36.398 28.151 33.5238Z" fill="white" stroke="white"/></svg>
								<span>
								
								
								</div> 								</div>		

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
									<li class="header__item"><button data-modal-trg="8" class="header__hide-headline"><?php echo $_smarty_tpl->getValue('LINGVO')['goods_services'];?>
</button></li>
									<li class="header__item header__item_hide"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/gallery/"><?php echo $_smarty_tpl->getValue('LINGVO')['gallery'];?>
</a></li>
									<li class="header__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/about/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_about'];?>
</a></li>
									<li class="header__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/delivery/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_delivery'];?>
</a></li>
									<li class="header__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/publications/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_publications'];?>
</a></li>
									<li class="header__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/contacts/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_contacts'];?>
</a></li>
								</ul>
							</nav>
							<div class="header__lang lang">
								<span class="lang__caption lang__hide"><?php echo $_smarty_tpl->getValue('LINGVO')['lang'];?>
:</span>
								<<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>span<?php } else { ?>a href="<?php echo $_smarty_tpl->getValue('LANG_SELECTOR_UA');?>
" hreflang="uk-UA"<?php }?> class="lang__ua<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?> lang__active<?php }?>">UA</<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?>span<?php } else { ?>a<?php }?>>
								|
								<<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?>span<?php } else { ?>a href="<?php echo $_smarty_tpl->getValue('LANG_SELECTOR_RU');?>
" hreflang="ru-UA"<?php }?> class="lang__ru<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?> lang__active<?php }?>">RU</<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?>span<?php } else { ?>a<?php }?>>
							</div>
						</div>
      			</div>
											<div class="header__search">
								<div class="header__search-bar search-bar">
									<form name="f1" method="get" action="https://floren.com.ua<?php echo $_smarty_tpl->getValue('LANGURL');?>
/search/">
											
											<input type="text" name="srch" class="search-bar__input<?php if (!$_smarty_tpl->getValue('SRCH_ROW') || $_smarty_tpl->getValue('SRCH_ROW') == '') {?> search-bar__input_gray<?php }?>" value="<?php if ($_smarty_tpl->getValue('SRCH_ROW')) {
echo $_smarty_tpl->getValue('SRCH_ROW');
} else {
echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];
}?>" onblur="this.value = this.value.replace(/^(\s*)/, '').replace(/(\s*)$/, ''); if (this.value==''){ this.value='<?php echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];?>
';this.className='search-bar__input search-bar__input_gray'}" onfocus='if (this.value=="<?php echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];?>
"){ this.value="";this.className="search-bar__input"}' />
											
											<button type="submit" class="search-bar__btn"></button>

									</form>
								</div>
								<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('BASKET')) > 0) {?>
								<a title="<?php echo $_smarty_tpl->getValue('LINGVO')['go_to_card'];?>
" href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/basket/" class="header__basket"></a>
								<a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/basket/" class="header__counter"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('BASKET'));?>
</a>
								<?php } else { ?>
								<span title="<?php echo $_smarty_tpl->getValue('LINGVO')['go_to_card'];?>
" class="header__basket"></span>
								<?php }?>
							</div>
    		</div>
		</div>
			<nav>
				<?php if ($_smarty_tpl->getValue('DEPT') == 'landscape') {?>
					<?php $_smarty_tpl->renderSubTemplate('file:nav_landscape.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
				<?php } elseif ($_smarty_tpl->getValue('DEPT') == 'florist') {?>
					<?php $_smarty_tpl->renderSubTemplate('file:nav_florist.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
				<?php } else { ?>
					<?php $_smarty_tpl->renderSubTemplate('file:nav_phytodesign.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
				<?php }?>
			</nav>
	</header>

		

	<?php if ($_smarty_tpl->getValue('URL')[0] != '') {?>
	<ul class="hleb" itemscope itemtype="http://schema.org/BreadcrumbList">
		<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('HLEB'), 'H', false, NULL, 'H', array (
  'iteration' => true,
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('H')->value) {
$foreach0DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_H']->value['iteration']++;
?>
		<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
			<?php if (($_smarty_tpl->getValue('__smarty_foreach_H')['iteration'] ?? null) == 1) {?>
				<a href="<?php if ($_smarty_tpl->getValue('LANGURL') == '/ua') {?>/<?php } else { ?>/ru/<?php }?>" itemprop="item"><span itemprop="name"><?php echo $_smarty_tpl->getValue('LINGVO')['main_page'];?>
</span></a>&nbsp;&nbsp;<span>&rarr;</span>
				<meta itemprop="position" content="<?php echo ($_smarty_tpl->getValue('__smarty_foreach_H')['iteration'] ?? null);?>
">
			<?php } elseif ($_smarty_tpl->getValue('H')['link'] != '') {?>				<!--dg_crumb_name:<?php echo $_smarty_tpl->getValue('H')['name'];?>
--><!--dg_crumb_link:<?php echo $_smarty_tpl->getValue('H')['link'];?>
-->
				<!--dg_crumb_url:<?php echo $_smarty_tpl->getValue('H')['link'];?>
;;dg_crumb_name:<?php echo $_smarty_tpl->getValue('H')['name'];?>
-->
				<a href="<?php echo $_smarty_tpl->getValue('LANGURL');
echo $_smarty_tpl->getValue('H')['link'];?>
" itemprop="item"><span itemprop="name"><?php echo $_smarty_tpl->getValue('H')['name'];?>
</span></a>&nbsp;&nbsp;<span>&rarr;</span>
				<meta itemprop="position" content="<?php echo ($_smarty_tpl->getValue('__smarty_foreach_H')['iteration'] ?? null);?>
">
			<?php } else { ?>				<a href="<?php echo $_SERVER['REQUEST_URI'];?>
" itemprop="item"><span itemprop="name"><?php echo $_smarty_tpl->getValue('H')['name'];?>
</span></a> <span>&nbsp;</span>
				<meta itemprop="position" content="<?php echo ($_smarty_tpl->getValue('__smarty_foreach_H')['iteration'] ?? null);?>
">
			<?php }?>
			
		</li>
		<?php
}
if ($foreach0DoElse) {
?>
		<li>&nbsp;</li>
		<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	</ul>
	<?php }?>

<?php if ($_smarty_tpl->getValue('URL')[0] == '' || ($_smarty_tpl->getValue('URL')[0] == 'services' && $_smarty_tpl->getValue('URL')[1] == '') || $_smarty_tpl->getValue('URL')[0] == 'thankyou' || $_smarty_tpl->getValue('URL')[0] == 'contacts' || $_smarty_tpl->getValue('URL')[0] == 'pricelist' || $_smarty_tpl->getValue('URL')[0] == 'sitemap' || $_smarty_tpl->getValue('URL')[0] == 'vertikalnoe-ozelenenie' || $_smarty_tpl->getValue('URL')[0] == 'basket' || $_smarty_tpl->getValue('URL')[0] == 'buket') {?>

<div class="layout">
	<?php $_smarty_tpl->renderSubTemplate(((string)$_smarty_tpl->getValue('CONTENT_TPL')), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</div>

<?php } else { ?>

<div class="layout">

	<div class="layot__holder">
		<aside class="layout__aside modal_left modal_hide" data-modal="5">
			<?php $_smarty_tpl->renderSubTemplate(((string)$_smarty_tpl->getValue('LEFT_TPL')), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
		</aside>

		<main class="layout__main">
			<?php $_smarty_tpl->renderSubTemplate(((string)$_smarty_tpl->getValue('CONTENT_TPL')), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
		</main>
	</div>

</div>

<?php }?>


</div>

<!--footers_block-->
<footer class="footer">
	<div class="container">
		<div class="footer__wrapper">
			<div class="footer__logo">
				<a href="<?php if ($_smarty_tpl->getValue('LANGURL') == '/ua') {?>/<?php } else { ?>/ru/<?php }?>" style="display:block;float:left;margin:0px 10px 5px 10px;"><img src="/img/logo25.svg" width="100" alt="<?php echo $_smarty_tpl->getValue('LINGVO')['logo_alt'];?>
" /></a>
				
			</div>
			<div class="footer__links">
				<ul class="footer__list">
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/about/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_about'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/purchase-returns/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_purchaise_return'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/partnership/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_partnership'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/contacts/"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_contacts'];?>
</a> <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/dogovir-oferta/"><?php echo $_smarty_tpl->getValue('LINGVO')['dogovir'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/sitemap/"><?php echo $_smarty_tpl->getValue('LINGVO')['sitemap'];?>
</a></li>
				</ul>
				<ul class="footer__list">
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/phytodesign/"><?php echo $_smarty_tpl->getValue('LINGVO')['phytodesign'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/services/green-wall/"><?php echo $_smarty_tpl->getValue('LINGVO')['vertikalnoe_ozelenenie'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/landscape/"><?php echo $_smarty_tpl->getValue('LINGVO')['landscape'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/komnatnie-rasteniya/"><?php echo $_smarty_tpl->getValue('LINGVO')['plants'];?>
</a></li>
					<li class="footer__item"><a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/planters/"><?php echo $_smarty_tpl->getValue('LINGVO')['planters_kashpo'];?>
</a></li>
				</ul>
				
			</div>
			<div class="footer__info">
				<p><nobr><a href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank"><?php echo $_smarty_tpl->getValue('LINGVO')['address_street'];?>
</a></nobr></p>
							<p>
					<span>03113</span>,
					<span><?php echo $_smarty_tpl->getValue('LINGVO')['city_kiev'];?>
, <?php echo $_smarty_tpl->getValue('LINGVO')['ukraine'];?>
</span>
				</p>
				<p><span style="font-size:14px;">&#9742;</span> <span class="binct-phone-number-1">+380 44 333-77-55</span> <?php echo $_smarty_tpl->getValue('LINGVO')['city_kiev'];?>
</p>
				<p><span style="font-size:16px;">&#9990;</span> <span class="binct-phone-number-2">+380 99 238-26-44</span></p>
			</div>
		</div>
		<div>
					<div style="display:block;float:left;margin-right: 10px;">
						<svg width="60" height="32" viewBox="0 0 60 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
								<path d="M28.8104 15.5492V20.679H27.1855V8.01062H31.495C32.0094 7.99986 32.5209 8.09123 32.9998 8.27946C33.4788 8.4677 33.9158 8.74907 34.2856 9.10734C34.6591 9.44385 34.9564 9.85655 35.1575 10.3177C35.3585 10.7789 35.4587 11.2778 35.4513 11.7809C35.462 12.2867 35.3633 12.7889 35.1621 13.253C34.9609 13.7171 34.6619 14.1321 34.2856 14.4696C33.532 15.1893 32.6018 15.5488 31.495 15.5482H28.8104V15.5492ZM28.8104 9.57028V13.9925H31.5354C31.8341 14.0014 32.1314 13.9477 32.4083 13.8349C32.6851 13.7222 32.9354 13.5527 33.1431 13.3375C33.3498 13.1363 33.514 12.8957 33.6262 12.6298C33.7383 12.3639 33.7961 12.0781 33.7961 11.7895C33.7961 11.5008 33.7383 11.2151 33.6262 10.9492C33.514 10.6833 33.3498 10.4427 33.1431 10.2415C32.938 10.0217 32.6886 9.84815 32.4114 9.73226C32.1342 9.61638 31.8356 9.56082 31.5354 9.56927H28.8104V9.57028Z" fill="gray"/>
								<path d="M39.1961 11.7285C40.3971 11.7285 41.3451 12.05 42.0401 12.6928C42.7352 13.3357 43.0823 14.2171 43.0817 15.3371V20.6792H41.5274V19.4763H41.4568C40.784 20.4669 39.8891 20.9622 38.7722 20.9622C37.8188 20.9622 37.0212 20.6792 36.3793 20.1131C36.0712 19.8533 35.825 19.5279 35.6584 19.1607C35.4918 18.7935 35.4092 18.3937 35.4165 17.9904C35.4165 17.0935 35.7549 16.3802 36.4318 15.8506C37.1086 15.3209 38.0122 15.0554 39.1426 15.0541C40.1074 15.0541 40.902 15.2309 41.5264 15.5847V15.2127C41.5283 14.9378 41.469 14.6659 41.3529 14.4168C41.2368 14.1677 41.0668 13.9475 40.8553 13.7724C40.4256 13.3841 39.8656 13.1722 39.2869 13.179C38.3793 13.179 37.661 13.5624 37.1322 14.3293L35.7011 13.4267C36.4883 12.2946 37.6533 11.7285 39.1961 11.7285ZM37.0938 18.0258C37.0927 18.2329 37.1411 18.4373 37.2348 18.6219C37.3286 18.8065 37.465 18.966 37.6328 19.0871C37.9921 19.3703 38.4382 19.5203 38.8953 19.5117C39.581 19.5105 40.2383 19.2372 40.7231 18.7516C41.2613 18.2441 41.5305 17.6488 41.5305 16.9655C41.0238 16.5612 40.3173 16.359 39.411 16.359C38.751 16.359 38.2006 16.5184 37.7599 16.8371C37.3148 17.1606 37.0938 17.5538 37.0938 18.0258Z" fill="gray"/>
								<path d="M52.003 12.0117L46.5773 24.5002H44.8999L46.9134 20.1305L43.3457 12.0117H45.1119L47.6905 18.2383H47.7258L50.2338 12.0117H52.003Z" fill="gray"/>
								<path d="M22.2435 14.4427C22.2441 13.9468 22.2023 13.4517 22.1184 12.9629H15.2656V15.7658H19.1906C19.1103 16.2135 18.9403 16.6403 18.6908 17.0204C18.4414 17.4005 18.1177 17.726 17.7393 17.9775V19.7969H20.0817C21.4533 18.5304 22.2435 16.6574 22.2435 14.4427Z" fill="gray"/>
								<path d="M15.2659 21.5548C17.2269 21.5548 18.878 20.9099 20.082 19.798L17.7396 17.9786C17.0876 18.4213 16.2479 18.674 15.2659 18.674C13.3705 18.674 11.7618 17.3943 11.1865 15.6699H8.77344V17.545C9.37824 18.7503 10.3056 19.7636 11.4521 20.4717C12.5986 21.1797 13.919 21.5547 15.2659 21.5548Z" fill="gray"/>
								<path d="M11.1869 15.6706C10.8827 14.767 10.8827 13.7884 11.1869 12.8848V11.0098H8.77376C8.26497 12.0238 8 13.1429 8 14.2777C8 15.4125 8.26497 16.5316 8.77376 17.5456L11.1869 15.6706Z" fill="gray"/>
								<path d="M15.2659 9.88126C16.3022 9.86431 17.3035 10.2564 18.0534 10.9729L20.1274 8.89573C18.8123 7.65859 17.07 6.97937 15.2659 7.00048C13.919 7.00054 12.5986 7.37554 11.4521 8.08361C10.3056 8.79169 9.37824 9.80497 8.77344 11.0103L11.1865 12.8854C11.7618 11.1609 13.3705 9.88126 15.2659 9.88126Z" fill="gray"/>
								</g>
								<defs>
								<clipPath id="clip0">
								<rect width="44" height="17.5" fill="gray" transform="translate(8 7)"/>
								</clipPath>
								</defs>
							</svg>
						</div>
						<div style="display:block;float:left;margin-right: 10px;">

							<svg width="60" height="32" viewBox="0 0 60 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0)">
							<path d="M16.0446 9.32065C15.5289 9.92864 14.7039 10.4082 13.8789 10.3397C13.7758 9.5176 14.1797 8.64415 14.6524 8.10466C15.168 7.47954 16.0703 7.03425 16.8008 7C16.8868 7.85633 16.5516 8.69553 16.0446 9.32065ZM16.7922 10.5024C15.5977 10.4339 14.575 11.1789 14.0078 11.1789C13.4321 11.1789 12.5641 10.5366 11.6188 10.5538C10.3899 10.5709 9.24691 11.2645 8.61957 12.3692C7.33051 14.5785 8.28441 17.8497 9.53051 19.648C10.1407 20.5385 10.8711 21.5147 11.8336 21.4805C12.7446 21.4462 13.1055 20.8896 14.2055 20.8896C15.3141 20.8896 15.6321 21.4805 16.5946 21.4634C17.5914 21.4462 18.2188 20.5728 18.8289 19.6822C19.525 18.6717 19.8086 17.687 19.8258 17.6356C19.8086 17.6185 17.9008 16.8906 17.8836 14.6984C17.8664 12.8658 19.3875 11.9924 19.4563 11.941C18.5969 10.6736 17.2563 10.5366 16.7922 10.5024ZM23.693 8.01903V21.3692H25.7727V16.8049H28.6516C31.2813 16.8049 33.1289 15.0067 33.1289 12.4034C33.1289 9.80019 31.3157 8.01903 28.7203 8.01903H23.693ZM25.7727 9.76594H28.1703C29.975 9.76594 31.0063 10.725 31.0063 12.412C31.0063 14.099 29.975 15.0666 28.1618 15.0666H25.7727V9.76594ZM36.9274 21.4719C38.2336 21.4719 39.4453 20.8126 39.9953 19.7678H40.0383V21.3692H41.9633V14.7241C41.9633 12.7973 40.4164 11.5557 38.036 11.5557C35.8274 11.5557 34.1946 12.8145 34.1344 14.5442H36.0078C36.1625 13.7222 36.9274 13.1827 37.9758 13.1827C39.2477 13.1827 39.961 13.7735 39.961 14.8611V15.5975L37.3657 15.7517C34.9508 15.8972 33.6446 16.882 33.6446 18.5947C33.6446 20.3245 34.9938 21.4719 36.9274 21.4719ZM37.486 19.8877C36.3774 19.8877 35.6727 19.3568 35.6727 18.5433C35.6727 17.7041 36.3516 17.216 37.6493 17.1389L39.961 16.9933V17.7469C39.961 18.9971 38.8953 19.8877 37.486 19.8877ZM44.5328 25C46.561 25 47.5149 24.2293 48.3485 21.8915L52.0008 11.6841H49.8868L47.4375 19.5709H47.3946L44.9453 11.6841H42.7711L46.2946 21.4034L46.1055 21.9943C45.7875 22.9962 45.2719 23.3815 44.3524 23.3815C44.1891 23.3815 43.8711 23.3644 43.7422 23.3473V24.9486C43.8625 24.9829 44.3782 25 44.5328 25Z" fill="gray"/>
							</g>
							<defs>
							<clipPath id="clip0">
							<rect width="44" height="18" fill="white" transform="translate(8 7)"/>
							</clipPath>
							</defs>
							</svg>
						</div>
						<div style="display:block;float:left;margin-right: 10px;">

								<svg width="61" height="32" viewBox="0 0 61 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M26.1867 18.6096L23.9339 24.2536L23.7142 23.0841C23.1647 21.6604 21.9559 20.1858 20.5273 19.6265L22.6153 26.8977H25.0328L28.6592 18.6096H26.1867ZM28.1098 26.8977L29.5383 18.6096H31.846L30.4175 26.8977H28.1098ZM41.846 23.9486C42.0109 23.4909 42.7801 21.6096 42.7801 21.6096C42.7801 21.6096 42.9449 21.1519 43.1098 20.796L43.2746 21.5079L43.824 23.8977H41.846V23.9486ZM44.6482 18.6096H42.89C42.3405 18.6096 41.901 18.7621 41.6812 19.3214L38.2746 26.8977H40.6922C40.6922 26.8977 41.0768 25.8808 41.1867 25.6265C41.4614 25.6265 43.824 25.6265 44.1537 25.6265C44.2087 25.9316 44.4284 26.8469 44.4284 26.8469H46.5713C46.5164 26.8977 44.6482 18.6096 44.6482 18.6096ZM38.7691 18.813C38.3295 18.6604 37.6153 18.457 36.6812 18.457C34.4284 18.457 32.7801 19.5757 32.7801 21.2028C32.7801 22.3723 33.9339 23.0841 34.8131 23.4401C35.6922 23.8469 36.0218 24.1011 36.0218 24.457C36.0218 25.0164 35.3076 25.2706 34.6482 25.2706C33.7142 25.2706 33.2197 25.1689 32.5054 24.813L32.1757 24.7113L31.846 26.5418C32.3955 26.796 33.3845 26.9486 34.4284 26.9994C36.846 26.9994 38.4394 25.8808 38.4394 24.1519C38.4394 23.1858 37.835 22.474 36.5164 21.9147C35.6922 21.5079 35.1977 21.2536 35.2526 20.8977C35.2526 20.5418 35.6922 20.1858 36.5713 20.1858C37.1757 20.1858 37.7801 20.2875 38.2746 20.4909L38.4944 20.5926C38.4394 20.5926 38.7691 18.813 38.7691 18.813Z" fill="gray"/>
								<path d="M21.8456 18.6094H18.1094V18.7619C21.0215 19.4738 22.8896 21.1517 23.7138 23.1348L22.8896 19.3212C22.7248 18.7619 22.3401 18.6094 21.8456 18.6094Z" fill="gray"/>
								<path d="M11.1868 16.6271H9.7033L8 9.50847L9.64835 9.25424L10.8022 14.7966L13.7692 9.30508H15.3077L11.1868 16.6271ZM50.7473 16.7797C50.1978 17.7458 49.7033 18 48.9341 18C48.7692 18 48.6593 18 48.5494 17.9492V17.1864C48.6593 17.2373 48.8242 17.2373 49.044 17.2373C49.3187 17.2373 49.5934 17.0847 49.7582 16.8305L49.8681 16.5763L48.989 12.8136L50.0879 12.661L50.5824 15.4068L51.956 12.7627H53L50.7473 16.7797ZM46.6813 13.5254C46.3516 13.5254 46.022 13.7288 45.6923 14.0339L45.3626 15.7627C45.5824 15.8136 45.6923 15.8644 46.022 15.8644C46.6813 15.8644 47.1209 15.5085 47.2857 14.6441C47.3956 13.8814 47.1209 13.5254 46.6813 13.5254ZM45.9121 16.6271C45.3626 16.6271 44.8132 16.5254 44.2637 16.3729L45.1429 10.9831L46.1868 10.8305L45.8022 13.1695C46.1319 12.9153 46.5165 12.661 47.0659 12.661C47.9451 12.661 48.5494 13.2712 48.3297 14.5424C48.0549 15.9661 47.1209 16.6271 45.9121 16.6271ZM41.022 12.661C40.6923 12.5085 40.4725 12.4576 39.978 12.4576C39.2637 12.4576 38.6593 13.0169 38.4945 14.0847C38.3297 15.0508 38.7143 15.5085 39.3187 15.5085C39.8132 15.5085 40.2527 15.2542 40.6923 14.7966L41.022 12.661ZM40.5824 16.5763V15.8644C40.1429 16.2712 39.5385 16.678 38.7692 16.678C37.6154 16.678 36.8462 15.9153 37.1209 14.1864C37.4505 12.3051 38.7143 11.4407 39.978 11.4407C40.4725 11.4407 40.9121 11.5424 41.1868 11.6441L41.5714 9.20339L43 9L41.7363 16.5763H40.5824ZM34.5385 12.2542C33.989 12.2542 33.4945 12.661 33.2747 13.4746H35.4176C35.4176 12.7119 35.1429 12.2542 34.5385 12.2542ZM36.5714 14.2881H33.0549C32.9451 15.2542 33.4396 15.7119 34.2637 15.7119C34.978 15.7119 35.5824 15.4576 36.2418 15.1017V16.0678C35.5824 16.4237 34.8132 16.678 33.9341 16.678C32.3956 16.678 31.4066 15.8644 31.6813 14.0339C31.956 12.4068 33.1648 11.3898 34.5934 11.3898C36.2418 11.3898 36.7912 12.5593 36.5165 13.983C36.6264 14.0847 36.5714 14.2373 36.5714 14.2881ZM30.8022 10.678C30.3626 10.678 30.033 10.3729 30.0879 9.9661C30.1429 9.55932 30.5824 9.25424 31.022 9.25424C31.4615 9.25424 31.7912 9.55932 31.6813 9.9661C31.6264 10.3729 31.2418 10.678 30.8022 10.678ZM29.0989 16.5763L29.9231 11.4915H31.2967L30.4725 16.5763H29.0989ZM29.0989 10.1186C28.6593 10.1186 28.3297 10.322 28.2747 10.7797L28.1648 11.5424H29.2088V12.5593H28L27.3407 16.5763H26.022L26.6813 12.5593H25.9121L26.0769 11.5424H26.8462L27.011 10.678C27.1758 9.55932 28.0549 9.15254 29.1538 9.15254C29.3736 9.15254 29.5934 9.15254 29.7033 9.20339V10.2203C29.4835 10.1186 29.3187 10.1186 29.0989 10.1186ZM24.8132 10.678C24.3736 10.678 24.044 10.3729 24.0989 9.9661C24.1538 9.55932 24.5934 9.25424 25.033 9.25424C25.4725 9.25424 25.8022 9.55932 25.6923 9.9661C25.6923 10.3729 25.2527 10.678 24.8132 10.678ZM23.1648 16.5763L23.989 11.4915H25.3626L24.5385 16.5763H23.1648ZM21.0769 13.678L20.5824 16.5763H19.2088L20.033 11.4915H21.1868V12.5085C21.6264 11.8983 22.2857 11.4407 23.1099 11.3898V12.661C22.3407 12.7119 21.5714 13.1186 21.0769 13.678ZM16.7363 12.2542C16.1868 12.2542 15.6923 12.661 15.4725 13.4746H17.6154C17.6703 12.7119 17.3956 12.2542 16.7363 12.2542ZM18.8242 14.2881H15.3077C15.1978 15.2542 15.6923 15.7119 16.5165 15.7119C17.2308 15.7119 17.8352 15.4576 18.4945 15.1017V16.0678C17.8352 16.4237 17.1209 16.678 16.1868 16.678C14.6484 16.678 13.6593 15.8644 13.9341 14.0339C14.2088 12.4068 15.4176 11.3898 16.8462 11.3898C18.4945 11.3898 19.044 12.5593 18.7692 13.983C18.8242 14.0847 18.8242 14.2373 18.8242 14.2881Z" fill="gray"/>
								</svg>
						</div>
						<div style="display:block;float:left;margin-right: 10px;">

<svg width="73" height="32" viewBox="0 0 73 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M28.8636 22.6285C28.8636 22.8378 28.8636 23.0471 28.7955 23.2564C28.6591 23.5355 28.4545 23.8146 28.1818 23.8843C27.8409 23.9541 27.5682 23.9541 27.2273 23.8843C27.0909 23.8146 26.9545 23.7448 26.8182 23.675C26.6818 23.5355 26.6136 23.396 26.5455 23.2564C26.4773 23.0471 26.4773 22.8378 26.4773 22.6285V19.8378H25.3864V22.6983C25.3864 23.0471 25.4545 23.396 25.5909 23.7448C25.7273 24.0239 25.8636 24.2332 26.0682 24.4425C26.2727 24.6518 26.5455 24.7913 26.8182 24.8611C27.3636 25.0006 27.9773 25.0006 28.5227 24.8611C28.7955 24.7913 29.0682 24.6518 29.2727 24.4425C29.4773 24.2332 29.6818 24.0239 29.75 23.7448C29.8864 23.396 29.9545 23.0471 29.9545 22.6983V19.8378H28.8636V22.6285ZM33.8409 19.6983C33.5682 19.6983 33.2955 19.768 33.0227 19.8378C32.75 19.9773 32.5455 20.1169 32.4091 20.3959V19.8378H31.3182V24.7913H32.4091V22.0704C32.4091 21.8611 32.4091 21.7215 32.4773 21.5122C32.5455 21.3727 32.6136 21.2332 32.6818 21.0936C32.8182 20.9541 32.8864 20.8843 33.0227 20.8145C33.1591 20.7448 33.3636 20.7448 33.5 20.7448C33.6364 20.7448 33.7727 20.7448 33.9091 20.8145C34.0455 20.8145 34.1818 20.8843 34.3182 20.9541L34.5909 19.9076C34.4545 19.8378 34.3182 19.8378 34.1818 19.768C34.1136 19.6983 33.9773 19.6983 33.8409 19.6983ZM36.0909 21.8611C36.0909 21.7215 36.1591 21.5122 36.2273 21.3727C36.2955 21.2332 36.3636 21.0936 36.5 20.9541C36.6364 20.8146 36.7727 20.7448 36.9091 20.675C37.0455 20.6052 37.25 20.6052 37.3864 20.6052C37.7273 20.6052 38 20.675 38.2045 20.9541C38.4091 21.2332 38.5455 21.5122 38.6136 21.8611H36.0909ZM39.0909 20.3959C38.8864 20.1866 38.6136 19.9773 38.3409 19.8378C38.0682 19.6983 37.7273 19.6285 37.3864 19.6285C37.0455 19.6285 36.7045 19.6983 36.4318 19.8378C36.1591 19.9773 35.8864 20.1169 35.6818 20.3959C35.4773 20.6052 35.2727 20.8843 35.2045 21.2332C35.0682 21.582 35 21.9308 35 22.2797C35 22.6285 35.0682 22.9773 35.2045 23.3262C35.4091 23.9541 35.8864 24.4425 36.5 24.6518C36.8409 24.7913 37.1818 24.8611 37.5227 24.8611C37.8636 24.8611 38.2727 24.7913 38.6136 24.7215C38.9545 24.582 39.2955 24.4425 39.5682 24.1634L39.0227 23.396C38.8182 23.5355 38.6136 23.675 38.3409 23.8146C38.1364 23.8843 37.8636 23.9541 37.5909 23.9541C37.4545 23.9541 37.25 23.9541 37.1136 23.8843C36.9773 23.8146 36.8409 23.7448 36.7045 23.675C36.5682 23.5355 36.4318 23.396 36.3636 23.2564C36.2955 23.0471 36.2273 22.9076 36.1591 22.6983H39.8409V22.2797C39.8409 21.9308 39.7727 21.582 39.6364 21.2332C39.5 20.9541 39.2955 20.675 39.0909 20.3959ZM13.0455 21.1634C12.8409 21.0239 12.5682 20.8843 12.2955 20.8145C12.0227 20.7448 11.75 20.675 11.4773 20.6052L11 20.5355C10.7955 20.5355 10.5909 20.4657 10.3864 20.3959C10.25 20.3262 10.0455 20.3262 9.90909 20.1866C9.77273 20.1169 9.70455 20.0471 9.63636 19.9076C9.56818 19.768 9.5 19.6285 9.5 19.489C9.5 19.3494 9.56818 19.1401 9.63636 19.0704C9.70455 18.9308 9.84091 18.7913 9.97727 18.7215C10.1136 18.6518 10.3182 18.5122 10.4545 18.5122C10.6591 18.4425 10.8636 18.4425 11.1364 18.4425C11.4773 18.4425 11.8182 18.5122 12.1591 18.582C12.5 18.7215 12.8409 18.8611 13.1136 19.0704L13.6591 18.1634C13.3182 17.9541 12.9091 17.7448 12.5 17.6052C12.0227 17.4657 11.5455 17.3959 11.0682 17.3959C10.7273 17.3959 10.3182 17.4657 9.97727 17.5355C9.63636 17.6052 9.36364 17.7448 9.09091 17.9541C8.81818 18.1634 8.61364 18.3727 8.47727 18.6518C8.34091 18.9308 8.27273 19.2797 8.27273 19.6285C8.27273 19.9076 8.34091 20.2564 8.47727 20.4657C8.54545 20.7448 8.68182 20.9541 8.88636 21.0936C9.09091 21.2332 9.29545 21.3727 9.56818 21.4425C9.84091 21.582 10.1136 21.6518 10.3864 21.6518L10.9318 21.7215C11.3409 21.7913 11.75 21.8611 12.1591 22.0704C12.4318 22.2099 12.5682 22.4192 12.5682 22.6983C12.5682 22.8378 12.5 23.0471 12.4318 23.1866C12.3636 23.3262 12.2273 23.4657 12.0909 23.5355C11.9545 23.6053 11.75 23.675 11.5455 23.7448C11.3409 23.8146 11.1364 23.8146 10.8636 23.8146C10.6591 23.8146 10.4545 23.8146 10.25 23.7448C9.84091 23.675 9.43182 23.5355 9.09091 23.3262C8.95455 23.2564 8.75 23.1169 8.68182 22.9773L8 23.9541C8.20455 24.0936 8.40909 24.2332 8.61364 24.3727C8.81818 24.5122 9.09091 24.582 9.29545 24.6518C9.56818 24.7215 9.84091 24.7913 10.1136 24.8611C10.3864 24.9308 10.5909 24.9308 10.8636 24.9308C11.2045 24.9308 11.6136 24.8611 11.9545 24.7913C12.2955 24.7215 12.5682 24.582 12.8409 24.3727C13.1136 24.1634 13.3182 23.9541 13.4545 23.675C13.5909 23.396 13.6591 23.0471 13.6591 22.6983C13.6591 22.4192 13.5909 22.1401 13.4545 21.8611C13.3864 21.5122 13.25 21.3727 13.0455 21.1634ZM15.6364 21.8611C15.6364 21.7215 15.7045 21.5122 15.7727 21.3727C15.8409 21.2332 15.9091 21.0936 16.0455 20.9541C16.1818 20.8146 16.3182 20.7448 16.4545 20.675C16.5909 20.6052 16.7955 20.6052 16.9318 20.6052C17.2727 20.6052 17.5455 20.7448 17.75 20.9541C17.9545 21.2332 18.0909 21.5122 18.1591 21.8611H15.6364ZM18.6364 20.3959C18.4318 20.1866 18.1591 19.9773 17.8864 19.8378C17.6136 19.6983 17.2727 19.6285 16.9318 19.6285C16.5909 19.6285 16.25 19.6983 15.9773 19.8378C15.7045 19.9773 15.4318 20.1169 15.2273 20.3959C15.0227 20.6052 14.8182 20.8843 14.75 21.2332C14.6136 21.582 14.5455 21.9308 14.5455 22.2797C14.5455 22.6285 14.6136 22.9773 14.75 23.3262C14.9545 23.9541 15.4318 24.4425 16.0455 24.6518C16.3864 24.7913 16.7273 24.8611 17.0682 24.8611C17.4091 24.8611 17.8182 24.7913 18.1591 24.7215C18.5 24.582 18.8409 24.4425 19.1136 24.1634L18.5682 23.396C18.3636 23.5355 18.1591 23.675 17.8864 23.8146C17.6818 23.8843 17.4091 23.9541 17.1364 23.9541C17 23.9541 16.7955 23.9541 16.6591 23.8843C16.5227 23.8146 16.3864 23.7448 16.25 23.675C16.1136 23.5355 15.9773 23.396 15.9091 23.2564C15.8409 23.0471 15.7727 22.9076 15.7045 22.6983H19.3182V22.2797C19.3182 21.9308 19.25 21.582 19.1136 21.2332C18.9773 20.9541 18.8409 20.675 18.6364 20.3959ZM23.2727 23.7448C22.8636 23.9541 22.4545 23.9541 22.0455 23.8146C21.8409 23.7448 21.7045 23.6053 21.5682 23.4657C21.4318 23.3262 21.3636 23.1169 21.2955 22.9773C21.1591 22.5587 21.1591 22.0704 21.2955 21.6518C21.3636 21.4425 21.5 21.3029 21.5682 21.1634C21.7045 21.0239 21.8409 20.8843 22.0455 20.8145C22.25 20.7448 22.3864 20.675 22.5909 20.675C22.7955 20.675 23 20.7448 23.2045 20.8145C23.4091 20.8843 23.6136 21.0239 23.75 21.2332L24.4318 20.4657C24.2273 20.1866 23.9545 19.9773 23.6818 19.9076C23.3409 19.768 23 19.6983 22.6591 19.6983C22.3182 19.6983 21.9091 19.768 21.5682 19.9076C20.9545 20.1866 20.4773 20.675 20.2727 21.3029C20 22.0006 20 22.6983 20.2727 23.396C20.4773 24.0239 21.0227 24.5122 21.6364 24.7913C21.9773 24.9308 22.3182 25.0006 22.7273 25.0006C23.0682 25.0006 23.4091 24.9308 23.75 24.7913C24.0909 24.6518 24.3636 24.4425 24.5682 24.1634L23.8864 23.396C23.6136 23.5355 23.4773 23.675 23.2727 23.7448ZM57.9773 22.9076C57.9091 23.1169 57.7727 23.2564 57.7045 23.396C57.5682 23.5355 57.4318 23.675 57.2273 23.7448C56.8182 23.8843 56.4091 23.8843 56 23.7448C55.6591 23.6053 55.3864 23.2564 55.25 22.9076C55.1136 22.489 55.1136 22.0704 55.25 21.6518C55.3864 21.3029 55.6591 20.9541 56 20.8145C56.2045 20.7448 56.4091 20.675 56.6136 20.675C56.8182 20.675 57.0227 20.7448 57.2273 20.8145C57.4318 20.8843 57.5682 21.0239 57.7045 21.1634C57.8409 21.3029 57.9091 21.5122 57.9773 21.6518C58.1136 22.0704 58.1136 22.5587 57.9773 22.9076ZM58.0455 20.3959C57.7045 19.9076 57.0909 19.6285 56.4773 19.6983C55.4545 19.6983 54.5682 20.3262 54.2273 21.2332C53.9545 21.9308 53.9545 22.6285 54.2273 23.3262C54.3636 23.6053 54.5 23.9541 54.7727 24.1634C55.25 24.6518 55.8636 24.9308 56.4773 24.9308C56.8182 24.9308 57.0909 24.8611 57.3636 24.7215C57.6364 24.582 57.8409 24.4425 57.9773 24.1634V24.7913H59.1364V17.3262H58.0455V20.3959ZM61.3182 21.8611C61.3182 21.7215 61.3864 21.5122 61.4545 21.3727C61.5227 21.2332 61.5909 21.0936 61.7273 20.9541C61.8636 20.8146 62 20.7448 62.1364 20.675C62.2727 20.6052 62.4773 20.6052 62.6136 20.6052C62.9545 20.6052 63.2273 20.675 63.4318 20.8843C63.6364 21.1634 63.7727 21.4425 63.8409 21.7913H61.3182V21.8611ZM64.3182 20.3959C64.1136 20.1866 63.8409 19.9773 63.5682 19.8378C63.2955 19.6983 62.9545 19.6285 62.6136 19.6285C62.2727 19.6285 62 19.6983 61.6591 19.8378C61.3864 19.9773 61.1136 20.1169 60.9091 20.3959C60.7045 20.6052 60.5 20.8843 60.4318 21.2332C60.2955 21.582 60.2273 21.9308 60.2273 22.2797C60.2273 22.6285 60.2955 22.9773 60.4318 23.3262C60.5682 23.6053 60.7045 23.8843 60.9773 24.1634C61.1818 24.3727 61.4545 24.582 61.7273 24.7215C62.0682 24.8611 62.4091 24.9308 62.75 24.9308C63.0909 24.9308 63.5 24.8611 63.8409 24.7913C64.1818 24.6518 64.5227 24.5122 64.7955 24.2332L64.25 23.4657C64.0455 23.6053 63.8409 23.7448 63.5682 23.8843C63.3636 23.9541 63.0909 24.0239 62.8182 24.0239C62.6818 24.0239 62.4773 24.0239 62.3409 23.9541C62.2045 23.8843 62.0682 23.8146 61.9318 23.7448C61.7955 23.6053 61.6591 23.4657 61.5909 23.3262C61.5227 23.1169 61.4545 22.9773 61.3864 22.768H65V22.3494C65 22.0006 64.9318 21.6518 64.7955 21.3029C64.7273 20.8843 64.5227 20.6052 64.3182 20.3959ZM52.0455 22.9076C51.9091 23.2564 51.5682 23.6053 51.2273 23.7448C50.8182 23.8843 50.4091 23.8843 50 23.7448C49.6591 23.6053 49.3182 23.3262 49.1818 22.9076C49.0455 22.489 49.0455 22.0006 49.1818 21.582C49.25 21.3727 49.3864 21.2332 49.5227 21.0936C49.6591 20.9541 49.7955 20.8146 50 20.7448C50.2045 20.675 50.4091 20.6052 50.6136 20.6052C50.8182 20.6052 51.0227 20.675 51.2273 20.7448C51.4318 20.8146 51.5682 20.9541 51.7045 21.0936C51.8409 21.2332 51.9773 21.4425 52.0455 21.582C52.25 22.0704 52.25 22.489 52.0455 22.9076ZM52.5227 20.3959C52.25 20.1866 51.9773 19.9773 51.7045 19.8378C51.3636 19.6983 51.0227 19.6285 50.6818 19.6285C50.3409 19.6285 49.9318 19.6983 49.5909 19.8378C49.25 19.9773 48.9773 20.1169 48.7727 20.3959C48.5682 20.6052 48.3636 20.8843 48.2273 21.2332C47.9545 21.9308 47.9545 22.6285 48.2273 23.3262C48.3636 23.6053 48.5682 23.8843 48.7727 24.1634C49.0455 24.3727 49.3182 24.582 49.5909 24.7215C50.2727 25.0006 51.0227 25.0006 51.7045 24.7215C52.0455 24.582 52.3182 24.4425 52.5227 24.1634C52.7273 23.9541 52.9318 23.675 53.0682 23.3262C53.3409 22.6285 53.3409 21.9308 53.0682 21.2332C52.9318 20.9541 52.7955 20.675 52.5227 20.3959ZM42.5 19.2099C42.7045 19.0006 42.9773 18.7913 43.3182 18.6518C43.6591 18.5122 44 18.4425 44.3409 18.4425C44.75 18.4425 45.1591 18.5122 45.5 18.7215C45.8409 18.9308 46.1136 19.1401 46.3182 19.489L47.2727 18.8611C47.1364 18.6518 46.9318 18.4425 46.7273 18.2332C46.5227 18.0238 46.3182 17.8843 46.0455 17.7448C45.7727 17.6052 45.5 17.5355 45.2273 17.4657C44.9545 17.3959 44.6136 17.3959 44.2727 17.3959C43.7273 17.3959 43.25 17.4657 42.7727 17.675C41.8864 18.0238 41.1364 18.7215 40.7955 19.6983C40.4545 20.675 40.4545 21.7215 40.7955 22.6983C41.1364 23.6053 41.8864 24.3029 42.7727 24.7215C43.5227 25.0006 44.4091 25.0704 45.1591 24.9308C45.4318 24.8611 45.7045 24.7913 45.9773 24.6518C46.25 24.5122 46.4545 24.3727 46.6591 24.1634C46.8636 23.9541 47.0682 23.7448 47.2045 23.5355L46.25 22.8378C45.7727 23.5355 45.0227 23.8843 44.2727 23.8843C43.9318 23.8843 43.5909 23.8146 43.25 23.675C42.9773 23.5355 42.7045 23.396 42.4318 23.1169C42.2273 22.9076 42.0227 22.5587 41.8864 22.2797C41.6136 21.582 41.6136 20.8145 41.8864 20.1169C42.0909 19.768 42.2955 19.489 42.5 19.2099Z" fill="gray"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M38.3406 10C38.136 9.7907 37.8633 9.5814 37.5906 9.44187C37.3178 9.30233 36.9769 9.23256 36.636 9.23256C36.2951 9.23256 35.9542 9.30233 35.6133 9.44187C35.2724 9.5814 34.9996 9.7907 34.7951 10C34.5906 10.2791 34.386 10.5581 34.2496 10.8372C34.1133 11.1861 34.0451 11.5349 34.0451 11.9535C34.0451 12.3023 34.1133 12.7209 34.2496 13.0698C34.386 13.4186 34.5224 13.6977 34.7951 13.907C34.9996 14.1163 35.3406 14.3256 35.6133 14.4651C35.9542 14.6047 36.2951 14.6744 36.7042 14.6744C37.0451 14.6744 37.4542 14.6047 37.7951 14.5349C38.136 14.3954 38.4769 14.2558 38.7496 13.9768L38.2042 13.2093C38.1019 13.2791 37.9826 13.3488 37.8633 13.4186C37.744 13.4884 37.6246 13.5582 37.5224 13.6279C37.2496 13.6977 36.9769 13.7675 36.7724 13.7675C36.5678 13.7675 36.4315 13.7675 36.2269 13.6977C36.1866 13.6667 36.1448 13.6358 36.1024 13.6044C35.8579 13.4235 35.5931 13.2275 35.4769 12.9302C35.3406 12.7907 35.2724 12.5814 35.2724 12.3721H39.0224V11.9535C39.0224 11.6047 38.9542 11.1861 38.8178 10.8372C38.7496 10.5581 38.6133 10.2093 38.3406 10ZM35.2724 11.5349C35.2724 11.3256 35.3406 11.1861 35.4087 11.0465C35.4769 10.907 35.5451 10.7674 35.6815 10.6279C35.8178 10.4884 35.9542 10.4186 36.0906 10.3488C36.2269 10.2791 36.4315 10.2791 36.636 10.2791C36.9769 10.2791 37.2496 10.4186 37.5224 10.6279C37.7269 10.907 37.9315 11.1861 37.9315 11.5349H35.2724Z" fill="gray"/>
<path d="M32.6133 13.4884C32.4769 13.5582 32.2724 13.5582 32.0678 13.5582C31.9315 13.5582 31.8633 13.5582 31.7269 13.4884C31.6928 13.4535 31.6417 13.4361 31.5906 13.4186C31.5394 13.4012 31.4883 13.3837 31.4542 13.3488C31.4201 13.314 31.386 13.2616 31.3519 13.2093C31.3178 13.157 31.2837 13.1047 31.2496 13.0698C31.1815 12.9302 31.1815 12.7907 31.1815 12.6512V10.4186H33.2269V9.3721H31.2496V7.83721H30.1587V9.3721H29.136V10.4186H30.1587V12.6512C30.0906 13.2093 30.2951 13.7675 30.636 14.1861C30.9769 14.5349 31.4542 14.6744 31.9996 14.6744C32.2724 14.6744 32.6133 14.6047 32.886 14.5349C33.1587 14.4651 33.3633 14.3256 33.5678 14.1861L33.0906 13.2791C32.9542 13.3488 32.8178 13.4186 32.6133 13.4884Z" fill="gray"/>
<path d="M45.5678 10.7674C45.7042 10.6279 45.8406 10.4884 46.0451 10.4186C46.2496 10.3488 46.4542 10.2791 46.6587 10.2791C46.8633 10.2791 47.136 10.3488 47.3406 10.4186C47.5451 10.4884 47.7496 10.6279 47.886 10.8372L48.5678 10.0698C48.3633 9.7907 48.0906 9.5814 47.7496 9.44187C47.4087 9.30233 47.0678 9.23256 46.6587 9.23256C46.3178 9.23256 45.9087 9.30233 45.5678 9.44187C44.9542 9.72094 44.4087 10.2093 44.2042 10.8372C43.9315 11.5349 43.9315 12.3023 44.2042 13C44.4769 13.6279 44.9542 14.1861 45.5678 14.3954C45.9087 14.5349 46.3178 14.6047 46.6587 14.6047C46.9996 14.6047 47.4087 14.5349 47.7496 14.3954C48.0906 14.2558 48.3633 14.0465 48.5678 13.7675L47.886 13C47.7496 13.1395 47.5451 13.2791 47.3406 13.4186C47.136 13.4884 46.8633 13.5582 46.6587 13.5582C46.4542 13.5582 46.2496 13.4884 46.0451 13.4186C45.8406 13.3488 45.7042 13.2093 45.5678 13.0698C45.4315 12.9302 45.2951 12.7209 45.2269 12.5814C45.0906 12.1628 45.0906 11.6744 45.2269 11.2558C45.2635 11.1997 45.2951 11.1487 45.3245 11.1013C45.4047 10.9717 45.468 10.8696 45.5678 10.7674Z" fill="gray"/>
<path d="M14.7496 7L12.5678 12.3721L10.4542 7H8.61328V14.5349H9.84055V8.39535L12.0224 13.7675H13.3178L15.4996 8.32558V14.5349H16.7269V7H14.7496Z" fill="gray"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M21.7724 10C21.5678 9.7907 21.3633 9.5814 21.0906 9.44187C20.8178 9.30233 20.4769 9.23256 20.136 9.23256C19.1133 9.23256 18.1587 9.86047 17.8178 10.8372C17.5451 11.5349 17.5451 12.3023 17.8178 13C17.9542 13.3488 18.0906 13.6279 18.3633 13.8372C18.8406 14.3256 19.5224 14.6047 20.136 14.6047C20.4769 14.6047 20.7496 14.5349 21.0906 14.3954C21.3633 14.2558 21.5678 14.0465 21.7724 13.8372V14.4651H22.8633V9.3721H21.7724V10ZM21.7724 12.5814C21.636 13 21.2951 13.2791 20.9542 13.4884C20.5451 13.6279 20.0678 13.6279 19.6587 13.4884C19.4542 13.4186 19.3178 13.2791 19.1815 13.1395C19.0451 13 18.9769 12.7907 18.9087 12.5814C18.7724 12.1628 18.7724 11.7442 18.9087 11.3256C19.0451 10.907 19.3178 10.6279 19.6587 10.4186C19.8633 10.3488 20.0678 10.2791 20.2724 10.2791C20.886 10.2791 21.4996 10.6279 21.7042 11.2558C21.9087 11.7442 21.9087 12.1628 21.7724 12.5814Z" fill="gray"/>
<path d="M28.1133 11.9535C27.7042 11.6744 27.2951 11.5349 26.8178 11.4651C26.771 11.4591 26.7074 11.454 26.633 11.4479C26.1964 11.4123 25.386 11.3463 25.386 10.907C25.386 9.93963 27.4404 10.358 27.9087 10.8372L28.4542 9.7907C27.2953 8.90129 24.2269 8.87926 24.2269 10.907C24.2269 11.3256 24.3633 11.6744 24.636 11.8837C24.9769 12.1628 25.4542 12.3721 25.9315 12.3721L26.4769 12.4419C26.6815 12.4419 26.9542 12.5116 27.1587 12.6512C27.2951 12.7209 27.3633 12.8605 27.3633 13C27.3633 13.2093 27.2269 13.3488 27.0906 13.4884C26.4184 13.8323 25.1211 13.6359 24.5678 13.0698L24.0906 13.9768C24.1516 14.0184 24.2066 14.06 24.2591 14.0998C24.3826 14.1934 24.4925 14.2766 24.636 14.3256C24.9769 14.4651 25.386 14.6047 25.7951 14.6047H26.2724C26.6133 14.6047 26.9542 14.5349 27.2269 14.4651C27.4292 14.4134 27.594 14.3233 27.7768 14.2232C27.8406 14.1884 27.9065 14.1523 27.9769 14.1163C28.1815 13.9768 28.3178 13.8372 28.4542 13.6279C28.5906 13.4186 28.5906 13.2093 28.5906 12.9302C28.5906 12.5814 28.386 12.1628 28.1133 11.9535Z" fill="gray"/>
<path d="M41.4087 9.93024V9.3721H40.3178V14.5349H41.4087V11.6744C41.4087 11.4651 41.4087 11.2558 41.4769 11.1163C41.8703 10.3112 42.7075 10.1761 43.4542 10.5581L43.7269 9.44187C43.0229 9.08169 41.7987 9.13209 41.4087 9.93024Z" fill="gray"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M53.3406 10C53.136 9.7907 52.9315 9.5814 52.6587 9.44187C52.386 9.30233 52.0451 9.23256 51.7042 9.23256C50.6815 9.23256 49.7269 9.86047 49.386 10.8372C49.1133 11.5349 49.1133 12.3023 49.386 13C49.5224 13.3488 49.7269 13.6279 49.9315 13.8372C50.4087 14.3256 51.0905 14.6047 51.7042 14.6047C52.0451 14.6047 52.3178 14.5349 52.6587 14.3954C52.9315 14.2558 53.136 14.0465 53.3406 13.8372V14.4651H54.4315V9.3721H53.3406V10ZM53.3406 12.5814C53.2042 13 52.9315 13.2791 52.5224 13.4186C52.1133 13.5582 51.636 13.5582 51.2269 13.4186C51.0224 13.3488 50.886 13.2093 50.7496 13.0698C50.6133 12.9302 50.5451 12.7209 50.4769 12.5116C50.3405 12.093 50.3405 11.6744 50.4769 11.2558C50.6133 10.8372 50.886 10.5581 51.2269 10.3488C51.4315 10.2791 51.636 10.2093 51.8406 10.2093C52.4542 10.2093 53.0678 10.5581 53.2724 11.1861C53.4769 11.7442 53.4769 12.1628 53.3406 12.5814Z" fill="gray"/>
<path d="M58.3176 9.21492C58.0448 9.21492 57.7039 9.28469 57.4312 9.35445C57.1585 9.49399 56.9539 9.63352 56.8176 9.9126V9.35445H55.7266V14.5173H56.8176V11.6568C56.8176 11.4475 56.8176 11.2382 56.8857 11.0986C56.9539 10.9591 57.0221 10.8196 57.1585 10.68C57.2948 10.5405 57.4312 10.4707 57.5676 10.401C57.7039 10.3312 57.9085 10.3312 58.0448 10.3312C58.1812 10.3312 58.3176 10.3312 58.4539 10.401C58.5903 10.401 58.7266 10.4707 58.863 10.5405L59.1357 9.42422C59.0676 9.38934 58.9994 9.3719 58.9312 9.35445C58.863 9.33701 58.7948 9.31957 58.7266 9.28469C58.5903 9.21492 58.4539 9.21492 58.3176 9.21492Z" fill="gray"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M62.2721 9.3721C62.8858 9.30233 63.4994 9.5814 63.8403 10.0698V7H64.9312V14.4651H63.7721V13.8372C63.6358 14.1163 63.4312 14.2558 63.1585 14.3954C62.8858 14.5349 62.613 14.6047 62.2721 14.6047C61.6585 14.6047 61.0448 14.3256 60.5676 13.8372C60.333 13.6572 60.1994 13.3741 60.0798 13.1208C60.0603 13.0796 60.0412 13.0391 60.0221 13C59.7494 12.3023 59.7494 11.6047 60.0221 10.907C60.363 10 61.2494 9.3721 62.2721 9.3721ZM63.5969 12.9103C63.6597 12.8167 63.7293 12.7128 63.7721 12.5814C63.9085 12.2326 63.9085 11.7442 63.7721 11.3256C63.756 11.2926 63.7399 11.2558 63.7229 11.2169C63.6679 11.0911 63.6036 10.9438 63.4994 10.8372C63.363 10.6977 63.2267 10.5581 63.0221 10.4884C62.8176 10.4186 62.613 10.3488 62.4085 10.3488C62.2039 10.3488 61.9994 10.4186 61.7948 10.4884C61.4539 10.6279 61.1812 10.9768 61.0448 11.3256C60.9085 11.7442 60.9085 12.1628 61.0448 12.5814C61.1812 12.9302 61.4539 13.2791 61.7948 13.4186C62.2039 13.5582 62.613 13.5582 63.0221 13.4186C63.2267 13.3488 63.363 13.2093 63.4994 13.0698C63.5248 13.0178 63.5596 12.9659 63.5969 12.9103Z" fill="gray"/>
</svg>


						</div>
				</div>
	</div>
</footer>

<div class="fb-icons">
	<a href="https://www.facebook.com/floren.com.ua/" target="_blank" rel="nofollow"><img src="/images/icon-fb.png" width="32" height="32" alt="Facebook"></a>
	<a href="https://www.youtube.com/channel/UClfLL4epyim3T5GX0nj2zKQ" target="_blank" rel="nofollow"><img src="/images/icon-youtube.png" width="32" height="32" alt="Youtube"></a>
	<a href="https://www.instagram.com/studio_floren/" target="_blank" rel="nofollow"><img src="/images/icon-instagram.png" width="32" height="32" alt="Instagram"></a>
</div>


<?php if ($_smarty_tpl->getValue('CLIENT_COUNTRY') != 'RU') {?>

<!-- BEGIN BINOCHAT CODE  -->
<?php echo '<script'; ?>
 type="text/javascript">
(function(d, w, s) {
    var widgetHash = 'MhQxJRjy5lGULYi5ZRqW', bch = d.createElement(s); bch.type = 'text/javascript'; bch.async = true;
    bch.src = '//widgets.binotel.com/chat/widgets/' + widgetHash + '.js';
    var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(bch, sn);
})(document, window, 'script');
<?php echo '</script'; ?>
>
<!--  END BINOCHAT CODE -->

<!--  BEGIN BINO CALLTRACKING CODE -->
<?php echo '<script'; ?>
 type="text/javascript">
  (function(d, w, s) {
	var widgetHash = 'p4ip41nnd32lknoy3wb1', ctw = d.createElement(s); ctw.type = 'text/javascript'; ctw.async = true;
	ctw.src = '//widgets.binotel.com/calltracking/widgets/'+ widgetHash +'.js';
	var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(ctw, sn);
  })(document, window, 'script');
<?php echo '</script'; ?>
> 
<!--  END BINO CALLTRACKING CODE -->

<?php }?>




<!-- Facebook Pixel Code -->
<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=139311730173475&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->




	


<?php if ((true && ($_smarty_tpl->hasVariable('GOOGLE_FEEDBACK') && null !== ($_smarty_tpl->getValue('GOOGLE_FEEDBACK') ?? null)))) {
echo $_smarty_tpl->getValue('GOOGLE_FEEDBACK');
}?>

<?php echo '<script'; ?>
 class="iti-load-utils" async src="/js/intl-tel-input-17.0.0/build/js/utils.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	const slidersOptions = <?php echo $_smarty_tpl->getValue('SLIDERS_OPTIONS_JSON');?>
;
<?php echo '</script'; ?>
>

<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('SLIDERS_OPTIONS'), 'SO', false, NULL, 'SO', array (
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('SO')->value) {
$foreach1DoElse = false;
?>

	<?php if ($_smarty_tpl->getValue('SO')['visible'] != 0) {?>

	<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('SO')['pages'], 'SI', false, NULL, 'SI', array (
));
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('SI')->value) {
$foreach2DoElse = false;
?>

		<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('SI'),$_smarty_tpl->getValue('URL'))) {?>

			<div class="i-slider i-slider_hide" data-slider="<?php echo $_smarty_tpl->getValue('SO')['slider'];?>
">
				<div class="i-slider__wrapper">
					<ul class="i-slider__holder <?php echo $_smarty_tpl->getValue('SO')['slider'];?>
 owl-carousel owl-theme" <?php if ($_smarty_tpl->getValue('SO')['width'] != 0) {?>style="width:<?php echo $_smarty_tpl->getValue('SO')['width'];?>
px; margin: 0 auto;"<?php }?>>
						<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('SO')['slides'], 'SL', false, 'SK', 'SL', array (
));
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('SK')->value => $_smarty_tpl->getVariable('SL')->value) {
$foreach3DoElse = false;
?>
							<li class="i-slider__slide" >
								<?php if ($_smarty_tpl->getValue('SL')['link']) {?>
									<a href="<?php echo $_smarty_tpl->getValue('SL')['link'];?>
" target="_blank">
								<?php }?>

								<?php if ($_smarty_tpl->getValue('SL')['img']) {?>
									<div class="i-slider__img" <?php if ($_smarty_tpl->getValue('SO')['zoom'] != 0) {?>data-fancybox="<?php echo $_smarty_tpl->getValue('SO')['slider'];?>
"<?php }?> href="/images/content/sliders/<?php echo $_smarty_tpl->getValue('SL')['img'];?>
" <?php if ($_smarty_tpl->getValue('SO')['height'] != 0) {?>style="height:<?php echo $_smarty_tpl->getValue('SO')['height'];?>
px"<?php }?>>
										<img src="/images/content/sliders/<?php echo $_smarty_tpl->getValue('SL')['img'];?>
" alt="<?php echo $_smarty_tpl->getValue('SO')['name_ru'];?>
. Фото <?php echo $_smarty_tpl->getValue('SK');?>
"> 
									</div>
								<?php }?>

								<?php if ($_smarty_tpl->getValue('SL')['link']) {?>
									</a>
								<?php }?>
								<?php if ($_smarty_tpl->getValue('SL')['caption_ru']) {?>
									<p><?php if ($_smarty_tpl->getValue('LANG') != '') {
echo $_smarty_tpl->getValue('SL')['caption_ru'];
} else {
echo $_smarty_tpl->getValue('SL')['caption_ua'];
}?></p>
								<?php }?>

							</li>
						<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
					</ul>
				</div>
			</div>
		<?php }?>

	<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

	<?php }
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

	<?php echo '<script'; ?>
 src="/js/intl-tel-input-17.0.0/build/js/intlTelInput.js" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/js/owl-carousel/dist/owl.carousel.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
