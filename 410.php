<?
//error_reporting(E_ALL);
error_reporting(0);
header('HTTP/1.1 410 Gone', true, '410');
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
		$db->query("SELECT alias, txt_".$lang." FROM lingvo WHERE page = 'general'");
		while($rs_lingvo=$db->fetch()){
			$lingvo[$rs_lingvo['alias']]=$rs_lingvo['txt_'.$lang];
		}
		$db->query("SELECT alias, txt_".$lang." FROM lingvo WHERE page = '".$URL[0]."'");
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
<html lang="uk-UA">
  <head>
    <meta charset="UTF-8"/>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Сторінка не існує, 404 Not Found — Флорен™</title>
    <meta name="description" content="Сторінка не існує, 404 Not Found — Флорен™" />
  	<meta name="Keywords" content="Сторінка не існує, 404 Not Found — Флорен™" />
  	<meta name="google-site-verification" content="bTCfDHCphQx6TBpRPW2kD8KCFii5CginoCuvlA30iRc" />
  	<meta name="google-site-verification" content="TbgodL-oY8WU0EzwGUsQRVHFaW0AlhMfphGCTKVUlUA" />
  	<meta name="yandex-verification" content="52b1e8e95027dfaa" />
  	<meta name="yandex-verification" content="676d8ae0b94ec83e" />
  	<meta name="msvalidate.01" content="608804491F64BA8EB3473B4D82A00BC6" />
  	<meta name="facebook-domain-verification" content="ad6un76hvxt2d8w7umcychuees0qus" />
	
  	<link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
  	<link rel="apple-touch-icon" sizes="152x152" href="/images/apple-touch-icon-ipad.png">
  	<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon-iphone-retina.png">
  	<link rel="apple-touch-icon" sizes="167x167" href="/images/apple-touch-icon-ipad-retina.png">
  
  	
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;600;900&display=swap"
      rel="stylesheet"
    /> -->
    <!-- <link rel="stylesheet" href="../styles/style.css" /> -->
                                    <script type="module" crossorigin src="/assets/js/main.js"></script>

    <link rel="stylesheet" href="/assets/css/_swipers.css" />
    <link rel="stylesheet" href="/assets/css/index.css" />
    <style>
      body {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
      }
      body.loaded {
        opacity: 1;
        visibility: visible;
      }
    </style>
    
    
    <script type="text/javascript">
    
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "t92qk5thlj");
    
    </script>
    	
    	    
    	<script type="application/ld+json">
    		{
    			"@context": "http://schema.org",
    			"@type": "WebSite",
    			"url": "https://floren.com.ua/",
    			"potentialAction": {
    				"@type": "SearchAction",
    				"target": "https://floren.com.ua/ua/search/?srch={search_term_string}",
    				"query-input": "required name=search_term_string" }
    		}
    </script>
    <script type="application/ld+json">
    		{ 
    			"@context": "http://schema.org",
    			"@type": "LocalBusiness",
    			"url": "https://floren.com.ua/",
    			"priceRange": "$$",
    			"name": "Флорен – Студія Фітодизайну",
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
    				"@id": "https://floren.com.ua/ua/contacts/",
    				"name": "Студія фітодизайну «Флорен»", 
    				"addressRegion": "Київська область",
    				"addressLocality": "Київ",     
    				"postalCode": "03113",
    				"streetAddress": "пр. Берестейський, 70",
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
    
    </script>
    
    
		 <!--[if IE]>
    <script>document.createElement('header');document.createElement('nav');document.createElement('section');document.createElement('article');document.createElement('aside');document.createElement('footer');</script>
     		<![endif]-->
    
    <script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-20410887-2');
    ga('send', 'pageview');
    </script>
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W7VHLVP');</script>
    <!-- End Google Tag Manager -->
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-736148489"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-736148489');
      gtag('get', 'G-KKVRZ8YBC3', 'client_id', (clientID) => {
           $.post('/bsk/save_to_session.php?r=3',{gaClientId:clientID}, function(data) {});
         });
    </script>
    
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
    
    
    
    
    <script>
    
    	
    
    </script>
  </head>

  <body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W7VHLVP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
    <!-- Шапка сайту -->
    <!-- prettier-ignore -->
    <!-- Overlay для каталогу -->
    <div class="catalog-overlay" id="catalog-overlay"></div>

    <!-- Header site -->
    <header class="header">
      <div class="container">
        <nav class="header__nav" aria-label="Головне меню сайту">

          <!-- Dropdown локації/магазинів -->
          <!-- Location dropdown element start -->
          <sl-tooltip id="location-tooltip" class="tooltip header__nav-location" trigger="manual" placement="bottom-start"
          style="--sl-tooltip-arrow-size: 0" distance="0">
            <div slot="content" class="header__nav-location--content">
              <img src="/img/icon-shop.svg" alt="icon-shop"/>
              <div class="description">
                <button class="icon-button header__nav-location--close" aria-label="Закрити вікно" data-event="click"
                data-callback="toggleLocation">
                  <svg class="icon icon-close"/>
                </button>
                <a href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank"
                rel="noopener noreferrer">Київ, пр. Берестейський, 70</a>
                <p>Графік роботи магазинів:</p>
                <p>пн-сб: 09:00-19:30</p>
                <p>вс: 10:00-18:00</p>
              </div>
            </div>
            <sl-button class="header__nav-location--button" data-event="click" data-callback="toggleLocation">
              <svg class="icon icon-location"/>
            Магазини у Києві
          </sl-button>
          </sl-tooltip>
          <!-- Location dropdown element end -->

          <!-- Меню навігації -->
          <!-- Navigation menu start -->
          <ul class="header__nav-list">
            <li class="header__nav-item">
              <a href="/ua/about/" class="header__nav-link">Про компанію</a>
            </li>
            <li class="header__nav-item">
              <a href="/ua/delivery/" class="header__nav-link">Оплата та Доставка</a>
            </li>
            <li class="header__nav-item">
              <a href="/ua/publications/" class="header__nav-link">Корисні матеріали</a>
            </li>
            <li class="header__nav-item">
              <a href="/ua/contacts/" class="header__nav-link">Контакти</a>
            </li>
          </ul>
          <!-- Navigation menu end -->

          <!-- Вибір мови -->
          <!-- Language dropdown element start -->
          <div class="header__nav-lang">
            <sl-dropdown class="dropdown">
              <sl-button class="header__nav-lang--button" slot="trigger" caret>
              Українською              <svg class="icon icon-down"/>
              </sl-button>
              <sl-menu>
                <sl-menu-item data-checked value="ua">
                                Українською
                              </sl-menu-item>
                <sl-divider></sl-divider>
                <sl-menu-item  value="ru">
                <a href="/ru/">                Російською
                </a>              </sl-menu-item>
              </sl-menu>
            </sl-dropdown>
          </div>
          <!-- Language dropdown element end -->
        </nav>

        <!-- Основна частина header з лого, телефонами, пошуком, кошиком -->
        <div class="header__main">
          <div class="header__main--left">
            <div class="header__mobile-buttons catalog">
              <button id="catalog-button-mobile" class="header__mobile-button catalog">
                <svg class="icon icon-menu"></svg>
              </button>
              <button id="catalog-close-mobile" class="header__mobile-button close">
                <svg class="icon icon-close"></svg>
              </button>
            </div>            
            <a href="/" class="header__main--logo">
              <img src="/img/main-logo.svg" alt="Logo"/>
            </a>
            <sl-tooltip id="phones-tooltip" class="tooltip header__main--phones-tooltip" trigger="manual"
            placement="bottom-start" style="--sl-tooltip-arrow-size: 0" distance="0">
              <div slot="content" class="header__main--phones-content">
                <button class="icon-button" aria-label="Закрити" data-event="click"
                data-callback="togglePhones">
                  <svg class="icon icon-close"/>
                </button>
                <div class="phones-tooltip--item">
                  <img src="/img/icons/icon-phone.svg" alt="Phone"/>
                  <div class="phones-tooltip--item-wrapper">
                    <p class="item-phone">(044) 344-28-95, (050) 660-52-75</p>
                    <p class="item-hours">По буднях 09:00 - 19:30</p>
                    <p class="item-messengers">
                      <a href="viber://chat?number=%2B380992382644" target="_blank" onclick="trackConv('vb','/ua/410')">
                        <svg class="icon icon-whatsapp"/>
                      </a>
                      <a href="https://t.me/studio_floren" target="_blank" onclick="trackConv('tg','/ua/410')">
                        <svg class="icon icon-telegram"/>
                      </a>
                    </p>
                  </div>
                </div>
                <div class="phones-tooltip--item">
                  <img src="/img/icons/icon-feedback.svg" alt="Feedback"/>
                  <div class="phones-tooltip--item-wrapper">
                    <a class="item-feedback" href="">Зворотній зв&#39;язок</a>
                  </div>
                </div>
              </div>
              <div class="header__main--phones">
                <img src="/img/icons/icon-phone.svg" alt="Phone"/>
                <div class="header__main--phones-wrapper">
                  <div class="header__main--phones-hidden binct-phone-number-2">
                  (044) 344..
                  <button data-event="click" data-callback="togglePhones">
                    показати
                  </button>
                  </div>
                  <div class="header__main--phones-showed">
                  (099) 238-26-44
                </div>
                  <div class="header__main--phones-hours">
                  По буднях 9:00 - 19:30
                </div>
                </div>
              </div>
            </sl-tooltip>
          </div>

          <!-- Права частина: пошук, профіль, улюблені, кошик -->
          <div class="header__main--right">
            <!-- Search form start -->
            <form id="main-search-form" action="/ua/search/" method="get" class="header__main--search">
              <div class="search-wrapper">
                <img class="search-icon" src="/img/icons/icon-search.svg" alt="Search"/>
                <input class="search-input" type="search" name="srch" placeholder="Шефлера"/>
                <button class="search-button">Пошук</button>
              </div>
              <button class="search-mobile-close" type="button" data-event="click" data-callback="toggleMobileSearch">
                <svg class="icon icon-close" />
              </button>
            </form>
            <!-- Search form end -->

            <div class="header__main--profile">
              <button class="header__main--profile-mobile icon-button">
                <svg class="icon icon-phone" />
              </button>
              <button class="header__main--profile-mobile icon-button" type="button" data-event="click" data-callback="toggleMobileSearch">
                <svg class="icon icon-search" />
              </button>
<!-- 
              <a href="#" class="icon-button" aria-label="Особистий кабінет" data-event="click" data-callback="openModal" data-modal-id="sign-in-modal">
                <svg class="icon icon-user"/>
              </a>
              <a href="#" class="icon-button" aria-label="Обране">
                <span class="badge warning">10</span>
                <svg class="icon icon-heart"/>
              </a>
-->
              <a href="/ua/basket/" class="icon-button" aria-label="Кошик" data-event="click" data-callback="openModal" data-modal-id="cart-modal">
                <svg class="icon icon-basket"/>
              </a>
            </div>

            <!-- Start Cart modal -->
            <sl-dialog id="cart-modal" label="Кошик" class="cart-modal">
              <div class="alert alert-success cart-modal__message" role="alert">
              Товар <u id="cart-modal-product-name"></u> доданий у ваш <a href="/basket/" class="underline">кошик</a>
              </div>
              <ul class="cart-items-list" id="cart-modal-items-list">
                          </ul>
              <div class="cart-modal__footer">
                <button class="cart-modal__footer_continue underline" data-event="click"
                data-callback="closeModal">Продовжити покупки</button>
                <div class="cart-modal__footer_total">Разом: <b id="cart-modal-total-ammount">0.00 ₴</b>
                </div>
                <a href="/ua/basket/" class="button button--small button--primary">Оформити замовлення</a>
              </div>
            </sl-dialog>
            <!-- End Cart modal -->

            <!-- Start Sign in modal -->
            <sl-dialog id="sign-in-modal" label="Вхід" class="login-modal">
              <form class="login-modal__form" action="/ua/login/" method="post">
                <div class="form-control">
                                  <sl-input label="e-mail" id="phone" name="email" type="text" placeholder="name@gmail.com">></sl-input>
                </div>
                <div class="form-control">
                  <sl-input label="Пароль" name="pass" type="password" placeholder="********"></sl-input>
                </div>
                <div class="form-control form-control--double">
                  <sl-checkbox>
                  Запам'ятати мене
                </sl-checkbox>
                  <a href="" class="underline">Нагадати пароль</a>
                </div>
                <div class="form-control">
                  <button class="button button--primary" type="submit">Увійти</button>
                </div>
                <div class="form-control text-center">
                  <a href="" class="underline">Зарєструватись</a>
                </div>
              </form>
            </sl-dialog>
            <!-- End Sign in modal -->

            <!-- Start Sign up modal -->
            <sl-dialog id="sign-up-modal" label="Реєстрація" class="login-modal">
              <form class="login-modal__form">
                <div class="form-control">
                  <sl-input label="ПІБ" placeholder="Прізвище Імʼя По батькові"></sl-input>
                </div>
                <div class="form-control">
                  <label for="phone">Ваш телефон</label>
                  <input id="phone" data-tel-input type="tel">
                </div>
                <div class="form-control">
                  <sl-input label="Email" type="email" placeholder="E-mail"></sl-input>
                </div>
                <div class="form-control">
                  <sl-input label="Пароль" type="password" placeholder="********"></sl-input>
                </div>
                <div class="form-control form-control--double">
                  <sl-checkbox>
                  Запам&#39;ятати мене
                </sl-checkbox>
                  <a href="" class="underline">Нагадати пароль</a>
                </div>
                <div class="form-control">
                  <button class="button button--primary" type="submit">Увійти</button>
                </div>
                <div class="form-control text-center">
                  <a href="" class="underline">Зарєструватись</a>
                </div>
              </form>
            </sl-dialog>
            <!-- End Sign up modal -->

            <!-- Start Sign up modal greeting -->
            <sl-dialog id="sign-up-modal-greeting" label="Реєстрація" class="login-modal">
              <div class="login-modal__greeting">
                <img src="/img/Illustration.png" alt="Вітаємо!">
                <p>Вітаємо! Ви успішно зареєструвались. Тепер Ви можете користуватись Вашим кабінетом і здійснювати
                замовлення</p>
                <a href="" class="button button--outline">Перейти до кабінету</a>
                <button href="" class="underline" data-event="click" data-callback="closeModal">Закрити</button>
              </div>
            </sl-dialog>
            <!-- End Sign up modal greeting -->

          </div>
        </div>
      </div>
    </header>
    <!-- Меню каталогу -->
    <!-- Меню каталогу в header -->
    <div class="header__catalog" id="catalog-menu">
      <div class="container">
        <div class="header__catalog_wrapper">
          <!-- Основна кнопка каталогу і випадаючий список -->
          <div class="header__catalog--main">
            <button id="catalog-button" class="catalog-button" aria-label="Каталог товарів">
              <svg class="icon icon-menu"/>
            Каталог товарів
          </button>
          <!-- Список категорій каталогу -->

          <!-- prettier-ignore -->

          <!-- Dropdown список категорій -->
          <div class="header__catalog_list">
            <!-- <a href="/ua" class="header__catalog_mobile-profile">
              <svg class="icon icon-user"></svg>
              Особистий кабінет
            </a> -->
            <div class="header__catalog_list-wrapper">
              <h3 class="header__catalog_list-mobile-title">Каталог товарів</h3>
              <!-- Список категорій - ліва частина -->
              <ul class="category-list">
                                  <li class="active" data-category="komnatnie-rasteniya">
                    <a href="/ua/komnatnie-rasteniya/">
                      <img src="/img/icons/icon-mmenu-komnatnie-rasteniya.svg" alt="Кімнатні рослини"/>
                      <span>Кімнатні рослини</span>
                    </a>
                  </li>
                                  <li class="active" data-category="planters">
                    <a href="/ua/planters/">
                      <img src="/img/icons/icon-mmenu-planters.svg" alt="Горщики та кашпо"/>
                      <span>Горщики та кашпо</span>
                    </a>
                  </li>
                                  <li class="active" data-category="iskusstvennie-cvety">
                    <a href="/ua/iskusstvennie-cvety/">
                      <img src="/img/icons/icon-mmenu-iskusstvennie-cvety.svg" alt="Штучні квіти"/>
                      <span>Штучні квіти</span>
                    </a>
                  </li>
                                  <li class="active" data-category="aksessuary">
                    <a href="/ua/aksessuary/">
                      <img src="/img/icons/icon-mmenu-aksessuary.svg" alt="Аксесуари для рослин"/>
                      <span>Аксесуари для рослин</span>
                    </a>
                  </li>
                              </ul>

              <h3 class="header__catalog_list-mobile-title" style="margin-top: 1rem;">Каталог послуг</h3>
              <ul class="category-list category-list--secondary-mobile">
                <li>
                  <a href="/ua/phytodesign/">
                    <b>Фітодизайн</b>
                    <span>Озеленення простору</span>
                  </a>
                </li>
                <li>
                  <a href="/ua/services/vertikalnoe-ozelenenie/">
                    <b>Вертикальне озеленення</b>
                    <span>Зелені стіни</span>
                  </a>
                </li>
                <li>
                  <a href="/ua/services/house_plant_care/">
                    <b>Догляд</b>
                    <span>за рослинами</span>
                  </a>
                </li>
                <li>
                  <a href="/ua/gallery/">
                    <b>Портфоліо</b>
                    <span>Галерея фотографій</span>
                  </a>
                </li>
              </ul>
              <!-- Контент категорій - права частина -->
              <div class="category-content">
                  <!-- prettier-ignore -->
                  <!-- Контент категорії "Кімнатні рослини" для меню каталогу -->
                                  <section class="category-content__item" data-category="komnatnie-rasteniya">
                    <button class="category-content__back-button">
                      <svg class="icon icon-arrow-angle-left"/>
                      Кімнатні рослини
                    </button>
                    <ul class="category-content__item-list">
                      <li class="category-content__item-list-all">
                        <a href="/ua/komnatnie-rasteniya/">
                          <div class="category-content__item-list-image">
                            <img src="/img/icons/icon-mmenu-komnatnie-rasteniya.svg" alt="Кімнатні рослини" />
                          </div>                          
                          <span>Всі</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/orchids/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/orchids.png?v=1" alt="Орхідеї" />
                          </div>                          
                          <span>Орхідеї</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/decorative/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/decorative.png?v=1" alt="Декоративно листяні рослини" />
                          </div>                          
                          <span>Декоративно листяні рослини</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/palms/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/palms.png?v=1" alt="Пальми" />
                          </div>                          
                          <span>Пальми</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/ficus/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/ficus.png?v=1" alt="Фікус" />
                          </div>                          
                          <span>Фікус</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/dracaena/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/dracaena.png?v=1" alt="Драцена" />
                          </div>                          
                          <span>Драцена</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/cactus/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/cactus.png?v=1" alt="Кактуси" />
                          </div>                          
                          <span>Кактуси</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/sukkulenty/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/sukkulenty.png?v=1" alt="Сукуленти" />
                          </div>                          
                          <span>Сукуленти</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/filodendron/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/filodendron.png?v=1" alt="Філодендрон" />
                          </div>                          
                          <span>Філодендрон</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/epipremnum/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/epipremnum.png?v=1" alt="Епіпремнум" />
                          </div>                          
                          <span>Епіпремнум</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/kroton/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/kroton.png?v=1" alt="Кротон" />
                          </div>                          
                          <span>Кротон</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/sansevieriya/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/sansevieriya.png?v=1" alt="Сансевієрія" />
                          </div>                          
                          <span>Сансевієрія</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/alocasia/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/alocasia.png?v=1" alt="Алоказія" />
                          </div>                          
                          <span>Алоказія</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/aglaonema/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/aglaonema.png?v=1" alt="Аглаонема" />
                          </div>                          
                          <span>Аглаонема</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/yucca/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/yucca.png?v=1" alt="Юкка" />
                          </div>                          
                          <span>Юкка</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/citrus/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/citrus.png?v=1" alt="Цитрусові рослини" />
                          </div>                          
                          <span>Цитрусові рослини</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/bloom/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/bloom.png?v=1" alt="Квіткові рослини" />
                          </div>                          
                          <span>Квіткові рослини</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/bulbs/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/bulbs.png?v=1" alt="Сезонні рослини" />
                          </div>                          
                          <span>Сезонні рослини</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/liana/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/liana.png?v=1" alt="Ліани" />
                          </div>                          
                          <span>Ліани</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/paporotnik/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/paporotnik.png?v=1" alt="Папороть" />
                          </div>                          
                          <span>Папороть</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/kalateya/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/kalateya.png?v=1" alt="Калатея" />
                          </div>                          
                          <span>Калатея</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/dieffenbachia/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/dieffenbachia.png?v=1" alt="Дифенбахія" />
                          </div>                          
                          <span>Дифенбахія</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/komnatnie-rasteniya/khvoynyye/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/khvoynyye.png?v=1" alt="Хвойні" />
                          </div>                          
                          <span>Хвойні</span>
                        </a>
                      </li>
                                          </ul>
                    <ul class="category-content__item-related">
                      <li>
                        <a class="underline" href="/ua/gift-card/">Подарункові сертифікати</a>
                      </li>
                      <li>
                        <a class="underline"
                          href="/ua/services/peregorodki-iz-rasteniy/">Перегородки з рослинами</a>
                      </li>
                    </ul>
                  </section>
                                  <section class="category-content__item" data-category="planters">
                    <button class="category-content__back-button">
                      <svg class="icon icon-arrow-angle-left"/>
                      Горщики та кашпо
                    </button>
                    <ul class="category-content__item-list">
                      <li class="category-content__item-list-all">
                        <a href="/ua/planters/">
                          <div class="category-content__item-list-image">
                            <img src="/img/icons/icon-mmenu-planters.svg" alt="Горщики та кашпо" />
                          </div>                          
                          <span>Всі</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/planters/lechuza/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/lechuza.png?v=1" alt="Горщики Lechuza (Лечуза)" />
                          </div>                          
                          <span>Горщики Lechuza (Лечуза)</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/planters/ceramic/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/ceramic.png?v=1" alt="Горщики керамічні" />
                          </div>                          
                          <span>Горщики керамічні</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/planters/lamela/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/lamela.png?v=1" alt="Горщики Lamela" />
                          </div>                          
                          <span>Горщики Lamela</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/planters/beton/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/beton.png?v=1" alt="Горщики з бетону" />
                          </div>                          
                          <span>Горщики з бетону</span>
                        </a>
                      </li>
                                          </ul>
                    <ul class="category-content__item-related">
                      <li>
                        <a class="underline" href="/ua/gift-card/">Подарункові сертифікати</a>
                      </li>
                      <li>
                        <a class="underline"
                          href="/ua/services/peregorodki-iz-rasteniy/">Перегородки з рослинами</a>
                      </li>
                    </ul>
                  </section>
                                  <section class="category-content__item" data-category="iskusstvennie-cvety">
                    <button class="category-content__back-button">
                      <svg class="icon icon-arrow-angle-left"/>
                      Штучні квіти
                    </button>
                    <ul class="category-content__item-list">
                      <li class="category-content__item-list-all">
                        <a href="/ua/iskusstvennie-cvety/">
                          <div class="category-content__item-list-image">
                            <img src="/img/icons/icon-mmenu-iskusstvennie-cvety.svg" alt="Штучні квіти" />
                          </div>                          
                          <span>Всі</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/iskusstvennie-cvety/iskusstvennie-palmy/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/iskusstvennie-palmy.png?v=1" alt="Штучні пальми" />
                          </div>                          
                          <span>Штучні пальми</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/iskusstvennie-cvety/iskusstvennie-derevya/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/iskusstvennie-derevya.png?v=1" alt="Штучні дерева" />
                          </div>                          
                          <span>Штучні дерева</span>
                        </a>
                      </li>
                                          </ul>
                    <ul class="category-content__item-related">
                      <li>
                        <a class="underline" href="/ua/gift-card/">Подарункові сертифікати</a>
                      </li>
                      <li>
                        <a class="underline"
                          href="/ua/services/peregorodki-iz-rasteniy/">Перегородки з рослинами</a>
                      </li>
                    </ul>
                  </section>
                                  <section class="category-content__item" data-category="aksessuary">
                    <button class="category-content__back-button">
                      <svg class="icon icon-arrow-angle-left"/>
                      Аксесуари для рослин
                    </button>
                    <ul class="category-content__item-list">
                      <li class="category-content__item-list-all">
                        <a href="/ua/aksessuary/">
                          <div class="category-content__item-list-image">
                            <img src="/img/icons/icon-mmenu-aksessuary.svg" alt="Аксесуари для рослин" />
                          </div>                          
                          <span>Всі</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/aksessuary/udobreniya/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/udobreniya.png?v=1" alt="Добрива для рослин" />
                          </div>                          
                          <span>Добрива для рослин</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/aksessuary/grunty/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/grunty.png?v=1" alt="Ґрунти та субстрати" />
                          </div>                          
                          <span>Ґрунти та субстрати</span>
                        </a>
                      </li>
                                              <li>
                        <a href="/ua/aksessuary/inventar/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/inventar.png?v=1" alt="Інвентар для догляду за рослинами" />
                          </div>                          
                          <span>Інвентар для догляду за рослинами</span>
                        </a>
                      </li>
                                          </ul>
                    <ul class="category-content__item-related">
                      <li>
                        <a class="underline" href="/ua/gift-card/">Подарункові сертифікати</a>
                      </li>
                      <li>
                        <a class="underline"
                          href="/ua/services/peregorodki-iz-rasteniy/">Перегородки з рослинами</a>
                      </li>
                    </ul>
                  </section>
                              </div>
            </div>
            <div class="header__catalog_list-wrapper">
              <h3 class="header__catalog_list-mobile-title">Інформація</h3>
              <ul class="category-list category-list--information-mobile">
                <li>
                  <a href="/ua/about/">Про компанію</a>
                </li>
                <li>
                  <a href="/ua/delivery/">Оплата та Доставка</a>
                </li>
                <li>
                  <a href="/ua/publications/">Корисні матеріали</a>
                </li>
                <li>
                  <a href="/ua/contacts/">Контакти</a>
                </li>
              </ul>
              <div class="category-list--item-messengers">
                <a href="viber://chat?number=%2B380992382644" target="_blank" onclick="trackConv('vb','/ua/410')">
                  <svg class="icon icon-whatsapp" />
                </a>
                <a href="https://t.me/studio_floren" target="_blank" onclick="trackConv('tg','/ua/410')">
                  <svg class="icon icon-telegram" />
                </a>
              </div>
            </div>
          </div>          
        </div>
          <!-- Додаткові категорії: фітодизайн, вертикальне озеленення, флораріуми -->
          <ul class="header__catalog--secondary">
            <li class="secondary-item">
              <a href="/ua/services/phytodesign/" class="secondary-item--button" aria-label="Фітодизайн">
                <svg class="icon icon-fitodesign"/>
                <div class="secondary-item--button-text">
                  <span>
                    <span>Фітодизайн</span>
                    <span>Озеленення простору</span>
                  </span>
                </div>
              </a>
              <section class="secondary-item--content">
                <ul class="secondary-item--content-list">
                  <li>
                    <img src="/img/sevices/apartment-phytodesign.png" alt="Озеленення квартири"/>
                    <a class="underline" href="/ua/services/phytodesign-kvartiri/">Озеленення квартири</a>
                  </li>
                  <li>
                    <img src="/img/sevices/office-phytodesign.png" alt="Озеленення офісу"/>
                    <a class="underline" href="/ua/services/phytodesign-ofisa/">Озеленення офісу</a>
                  </li>
                  <li>
                    <img src="/img/sevices/landscaping-of-summer-terraces.png" alt="Озеленення літніх терас"/>
                    <a class="underline" href="/ua/services/ozelenenie_letney_ploschadki/">Озеленення літніх терас</a>
                  </li>
                  <li>
                    <img src="/img/sevices/zoning-space-with-indoor-plants.png"
                    alt="Зонування простору"/>
                    <a class="underline" href="/ua/services/peregorodki-iz-rasteniy/">Зонування простору</a>
                  </li>
                  <li>
                    <img src="/img/sevices/plant-rental.png" alt="Зелені рішення для HoReCa"/>
                    <a class="underline" href="#">Зелені рішення для HoReCa</a>
                  </li>
                  <li>
                    <img src="/img/sevices/landscaping-artificial-plants.png" alt="Озеленення штучними рослинами"/>
                    <a class="underline" href="/ua/services/ozelenenie-iskusstvennimi-rasteniyami/">Озеленення штучними рослинами</a>
                  </li>
                </ul>
              </section>
            </li>
            <li class="secondary-item">
              <a href="/ua/services/vertikalnoe-ozelenenie/" class="secondary-item--button" aria-label="Вертикальне озеленення">
                <svg class="icon icon-vertical"/>
                <div class="secondary-item--button-text">
                  <span>
                    <span>Вертикальне озеленення</span>
                    <span>Зелені стіни</span>
                  </span>
                </div>
              </a>
              <section class="secondary-item--content">
                <ul class="secondary-item--content-list">
                  <li>
                    <img src="/img/sevices/green-walls.png" alt="Зелені стіни з рослинами"/>
                    <a class="underline" href="/ua/services/green-wall/">Зелені стіни з рослинами</a>
                  </li>
                  <li>
                    <img src="/img/sevices/landscaping-using-vertical-structures.png" alt="Озеленення за допомогою вертикальних конструкцій"/>
                    <a class="underline" href="/ua/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/">Озеленення за допомогою вертикальних конструкцій</a>
                  </li>
                  <li>
                    <img src="/img/sevices/green-moss-walls.png" alt="Зелені стіни з моху"/>
                    <a class="underline" href="/ua/services/ozelenenie-stabilizirovannim-mhom/">Зелені стіни з моху</a>
                  </li>
                </ul>
              </section>
            </li>
            <li class="secondary-item">
              <a href="/ua/services/house_plant_care/" class="secondary-item--button" aria-label="Догляд за рослинами">
                <svg class="icon icon-care"/>
                <div class="secondary-item--button-text">
                  <span>
                    <span>Догляд</span>
                    <span>за рослинами</span>
                  </span>
                </div>
              </a>
              <section class="secondary-item--content">
                <ul class="secondary-item--content-list">
                  <li>
                    <img src="/img/sevices/plant-transplantation.png" alt="Пересадка рослин"/>
                    <a class="underline" href="/ua/services/peresadka/">Пересадка рослин</a>
                  </li>
                  <li>
                    <img src="/img/sevices/plant-transportation.png" alt="Перевозка рослин"/>
                    <a class="underline" href="/ua/services/shipping/">Перевозка рослин</a>
                  </li>
                  <li>
                    <img src="/img/sevices/plant-rental.png" alt="Оренда рослин"/>
                    <a class="underline" href="/ua/services/arenda_rasteniy/">Оренда рослин</a>
                  </li>
                </ul>
              </section>
            </li>
            <li class="secondary-item">
              <a href="/ua/gallery/" class="secondary-item--button" aria-label="Галерея фотографій">
                <svg class="icon icon-photogallery"/>
                <div class="secondary-item--button-text">
                  <span>
                    <span>Портфоліо</span>
                    <span>Галерея фотографій</span>
                  </span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

            <main class="catalog-page">
      <div class="container">
        <!-- Sidebar navigation - категорії каталогу -->
        <div class="catalog-page__grid">
          <aside class="catalog-page__nav">
          <sl-drawer id="category-drawer" label="Всі категорії" placement="end" class="drawer category-drawer">
  <div class="drawer__content">
        
        
    <section>
      <h3>Кімнатні рослини</h3>
      <ul>
                <li>
          <a href="/ua/komnatnie-rasteniya/orchids/" class="underline">Орхідеї</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/decorative/" class="underline">Декоративно листяні рослини</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/palms/" class="underline">Пальми</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/ficus/" class="underline">Фікус</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/dracaena/" class="underline">Драцена</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/cactus/" class="underline">Кактуси</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/sukkulenty/" class="underline">Сукуленти</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/filodendron/" class="underline">Філодендрон</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/epipremnum/" class="underline">Епіпремнум</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/kroton/" class="underline">Кротон</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/sansevieriya/" class="underline">Сансевієрія</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/alocasia/" class="underline">Алоказія</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/aglaonema/" class="underline">Аглаонема</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/yucca/" class="underline">Юкка</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/citrus/" class="underline">Цитрусові рослини</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/bloom/" class="underline">Квіткові рослини</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/bulbs/" class="underline">Сезонні рослини</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/liana/" class="underline">Ліани</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/paporotnik/" class="underline">Папороть</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/kalateya/" class="underline">Калатея</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/dieffenbachia/" class="underline">Дифенбахія</a>
          </li>
                  <li>
          <a href="/ua/komnatnie-rasteniya/khvoynyye/" class="underline">Хвойні</a>
          </li>
                </ul>
    </section>
    
        
        
    <section>
      <h3>Горщики та кашпо</h3>
      <ul>
                <li>
          <a href="/ua/planters/lechuza/" class="underline">Горщики Lechuza (Лечуза)</a>
          </li>
                  <li>
          <a href="/ua/planters/ceramic/" class="underline">Горщики керамічні</a>
          </li>
                  <li>
          <a href="/ua/planters/lamela/" class="underline">Горщики Lamela</a>
          </li>
                  <li>
          <a href="/ua/planters/beton/" class="underline">Горщики з бетону</a>
          </li>
                </ul>
    </section>
    
        
        
    <section>
      <h3>Штучні квіти</h3>
      <ul>
                <li>
          <a href="/ua/iskusstvennie-cvety/iskusstvennie-palmy/" class="underline">Штучні пальми</a>
          </li>
                  <li>
          <a href="/ua/iskusstvennie-cvety/iskusstvennie-derevya/" class="underline">Штучні дерева</a>
          </li>
                </ul>
    </section>
    
        
        
    <section>
      <h3>Аксесуари для рослин</h3>
      <ul>
                <li>
          <a href="/ua/aksessuary/udobreniya/" class="underline">Добрива для рослин</a>
          </li>
                  <li>
          <a href="/ua/aksessuary/grunty/" class="underline">Ґрунти та субстрати</a>
          </li>
                  <li>
          <a href="/ua/aksessuary/inventar/" class="underline">Інвентар для догляду за рослинами</a>
          </li>
                </ul>
    </section>
    
      </div>
</sl-drawer>
    
   
				
			<section class="catalog-page__nav_section">
                <h3>Кімнатні рослини</h3>
				<ul>
										<li>
						<a href="/ua/komnatnie-rasteniya/orchids/" class="underline">Орхідеї</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/decorative/" class="underline">Декоративно листяні рослини</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/palms/" class="underline">Пальми</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/ficus/" class="underline">Фікус</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/dracaena/" class="underline">Драцена</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/cactus/" class="underline">Кактуси</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/sukkulenty/" class="underline">Сукуленти</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/filodendron/" class="underline">Філодендрон</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/epipremnum/" class="underline">Епіпремнум</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/kroton/" class="underline">Кротон</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/sansevieriya/" class="underline">Сансевієрія</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/alocasia/" class="underline">Алоказія</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/aglaonema/" class="underline">Аглаонема</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/yucca/" class="underline">Юкка</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/citrus/" class="underline">Цитрусові рослини</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/bloom/" class="underline">Квіткові рослини</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/bulbs/" class="underline">Сезонні рослини</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/liana/" class="underline">Ліани</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/paporotnik/" class="underline">Папороть</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/kalateya/" class="underline">Калатея</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/dieffenbachia/" class="underline">Дифенбахія</a>
					</li>
										<li>
						<a href="/ua/komnatnie-rasteniya/khvoynyye/" class="underline">Хвойні</a>
					</li>
									</ul>
			</section>
		
	
				
			<section class="catalog-page__nav_section">
                <h3>Горщики та кашпо</h3>
				<ul>
										<li>
						<a href="/ua/planters/lechuza/" class="underline">Горщики Lechuza (Лечуза)</a>
					</li>
										<li>
						<a href="/ua/planters/ceramic/" class="underline">Горщики керамічні</a>
					</li>
										<li>
						<a href="/ua/planters/lamela/" class="underline">Горщики Lamela</a>
					</li>
										<li>
						<a href="/ua/planters/beton/" class="underline">Горщики з бетону</a>
					</li>
									</ul>
			</section>
		
	
				
			<section class="catalog-page__nav_section">
                <h3>Штучні квіти</h3>
				<ul>
										<li>
						<a href="/ua/iskusstvennie-cvety/iskusstvennie-palmy/" class="underline">Штучні пальми</a>
					</li>
										<li>
						<a href="/ua/iskusstvennie-cvety/iskusstvennie-derevya/" class="underline">Штучні дерева</a>
					</li>
									</ul>
			</section>
		
	
				
			<section class="catalog-page__nav_section">
                <h3>Аксесуари для рослин</h3>
				<ul>
										<li>
						<a href="/ua/aksessuary/udobreniya/" class="underline">Добрива для рослин</a>
					</li>
										<li>
						<a href="/ua/aksessuary/grunty/" class="underline">Ґрунти та субстрати</a>
					</li>
										<li>
						<a href="/ua/aksessuary/inventar/" class="underline">Інвентар для догляду за рослинами</a>
					</li>
									</ul>
			</section>
		
	          </aside>
          <div class="catalog-page__content">
                          <!-- Breadcrumbs -->
               <div class="catalog-page__breadcrumbs">
                <div class="catalog-page__breadcrumbs-scroll">
                  <sl-breadcrumb itemscope itemtype="https://schema.org/BreadcrumbList">
                                      </sl-breadcrumb>                  
                </div>
                <button class="button catalog-page__breadcrumbs-button" data-event="click" data-callback="openModal"
                  data-modal-id="category-drawer">
                  <span class="icon icon-arrow-top-down"></span>
                </button>
               </div>
            
            <style>
.thankU {
	width:70%;margin:0 auto;
}
.thankUtxt{font-size:1.3em;}

@media (min-width: 1199px) {
  .thankU {
    width: 50% !important;
  }
 
}
</style>

<div class="thankyou-page">
  <div class="thankyou-page__grid">
    <div class="thankyou-page__image">
      <img src="/img/homepage/hero-swiper-slide-1-1.png" alt="Thank you" class="thankUimg">
    </div>
    <div class="thankyou-page__content">
      <h1>Сторінку не знайдено!</h1>
      <p>Нажаль сторінку не знайдено</p>
      <p>Спробуйте почати з <a href="/" class="underline">головної сторінки</a>.</p>
      <p>&nbsp;</p>
      <p>
        Також ви можете подивитись наші роботи в соцмережах
      </p>
      <div class="thankyou-page__socials">
        <a href="https://www.facebook.com/floren.com.ua/" target="_blank">
          <svg class="icon icon-facebook"></svg>
        </a>
        <a href="https://www.youtube.com/channel/UClfLL4epyim3T5GX0nj2zKQ" target="_blank">
          <svg class="icon icon-youtube"></svg>
        </a>
        <a href="https://www.instagram.com/studio_floren/" target="_blank">
          <svg class="icon icon-instagram"></svg>
        </a>
      </div>
    </div>
  </div>  
</div>            
          </div>
        </div>
      </div>


      </main>
  

    <!-- Підвал сайту -->
    <!-- Footer site -->
    <footer class="footer">

      <!-- Топ категорії і теги -->


      <!-- Основна частина footer з логотипом, меню, контактами -->
      <div class="footer__body">
        <div class="container">
          <img class="footer__body-bg footer__body-bg-1" src="/img/palm.svg" alt="background"/>
          <img class="footer__body-bg footer__body-bg-2" src="/img/palm.svg" alt="background"/>
          <img class="footer__body-bg footer__body-bg-3" src="/img/palm.svg" alt="background"/>
          <img class="footer__body-bg footer__body-bg-4" src="/img/leaf.svg" alt="background"/>
          <img class="footer__body-bg footer__body-bg-5" src="/img/leaf.svg" alt="background"/>
          <img class="footer__body-bg footer__body-bg-6" src="/img/leaf.svg" alt="background"/>

          <div class="footer__body-grid">
            <section>
              <a href="/" class="footer__body-logo" aria-label="Флорен – Студія Фітодизайну">
                <img src="/img/footer-logo.png" alt="Флорен – Студія Фітодизайну"/>
              </a>
            </section>
            <section>
              <h3>Інформація</h3>
              <ul class="footer__body-list">
                <li>
                  <a href="/ua/about/">Про компанію</a>
                </li>
                <li>
                  <a href="/ua/purchase-returns/">Повернення товару</a>
                </li>
                <li>
                  <a href="/ua/partnership/">Співпраця</a>
                </li>
                <li>
                  <a href="/ua/contacts/">Контакти</a>
                </li>
                <li>
                  <a href="/ua/sitemap/">Мапа сайту</a>
                </li>
              </ul>
            </section>
            <section>
              <h3>Товари та сервіси</h3>
              <ul class="footer__body-list">
                <li>
                  <a href="/ua/phytodesign/">Фітодизайн</a>
                </li>
                <li>
                  <a href="/ua/services/vertikalnoe-ozelenenie/">Вертикальне озеленення</a>
                </li>
                <li>
                  <a href="/ua/services/house_plant_care/">Догляд за рослинами</a>
                </li>
                <li>
                  <a href="/ua/komnatnie-rasteniya/">Кімнатні рослини</a>
                </li>
                <li>
                  <a href="/ua/planters/">Горщики та Кашпо</a>
                </li>
              </ul>
            </section>
            <section>
              <h3>Контакти</h3>
              <ul class="footer__body-contacts">
                <li>
                  <p class="contacts-street">
                    <svg class="icon icon-location"/>
                    <a href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank">пр. Берестейський, 70</a>
                  </p>
                  <p>03113, Київ, Україна</p>
                </li>
                <li class="contacts-phone">
                  <div class="contacts-phone--hidden">
                    <p>
                    (044) 344..
                    <button data-event="click" data-callback="toggleFooterPhones" aria-label="Показати телефон">
                      показати
                    </button>
                    </p>
                    <p>(050) 660..</p>
                  </div>
                  <div class="contacts-phone--shown">
                    <p>(044) 344-28-95</p>
                    <p>(050) 660-52-75</p>
                  </div>
                </li>
                <li class="contacts-socials">
                  <a href="https://www.facebook.com/floren.com.ua/" target="_blank">
                    <svg class="icon icon-facebook"/>
                  </a>
                  <a href="https://www.youtube.com/channel/UClfLL4epyim3T5GX0nj2zKQ" target="_blank">
                    <svg class="icon icon-youtube"/>
                  </a>
                  <a href="https://www.instagram.com/studio_floren/" target="_blank">
                    <svg class="icon icon-instagram"/>
                  </a>
                </li>
              </ul>
            </section>
          </div>
          <sl-divider class="footer__body-divider"></sl-divider>

          <!-- Copyright і платіжні системи -->
          <div class="footer__body-bottom">
            <section class="footer__body-bottom--copyright">
              <span>&copy; 2011–2026 Флорен&trade;</span>
              <a class="not-underline" href="/ua/dogovir-oferta/">Договір оферта</a>
            </section>
            <section class="footer__body-bottom--cards">
              <img src="/img/payment-visa.svg" alt="Visa"/>
              <img src="/img/payment-master.svg" alt="MasterCard"/>
              <img src="/img/payment-google.svg" alt="Google Pay"/>
              <img src="/img/payment-apple.svg" alt="Apple Pay"/>
            </section>
          </div>
        </div>
      </div>
    </footer>
    
  <!-- BEGIN BINOCHAT CODE  -->
     
  <script type="text/javascript">
  (function(d, w, s) {
      var widgetHash = 'MhQxJRjy5lGULYi5ZRqW', bch = d.createElement(s); bch.type = 'text/javascript'; bch.async = true;
      bch.src = '//widgets.binotel.com/chat/widgets/' + widgetHash + '.js';
      var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(bch, sn);
  })(document, window, 'script');
  </script>
  <!--  END BINOCHAT CODE -->


  <!--  BEGIN BINO CALLTRACKING CODE -->
  <script type="text/javascript">
    (function(d, w, s) {
  	var widgetHash = 'p4ip41nnd32lknoy3wb1', ctw = d.createElement(s); ctw.type = 'text/javascript'; ctw.async = true;
  	ctw.src = '//widgets.binotel.com/calltracking/widgets/'+ widgetHash +'.js';
  	var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(ctw, sn);
    })(document, window, 'script');
  </script> 
  <!--  END BINO CALLTRACKING CODE -->
  
  

  <!-- Головний JS файл -->
  </body>

</html>