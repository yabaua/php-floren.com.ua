<!DOCTYPE html>
<html lang="{if $LANG=='ua'}uk-UA{else}ru-UA{/if}">

  <head>
    <meta charset="UTF-8"/>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{$META_TITLE}</title>
    <meta name="description" content="{$META_DESCRIPTION|escape}" />
  	<meta name="Keywords" content="{$META_KEYWORDS|escape}" />
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
  	
  	{$META_REL_ALTERNATE}
  	{$META_REL_CANONICAL}
  	{$META_NOFOLLOW}
  	
{if $URL[0]=='product'}
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{$OG_TITLE}" />
		<meta property="og:url" content="{$OG_LINK}" />
		<meta property="og:description" content="Шукаєш {$OG_TITLE}? Заходь та обирай прямо зараз!" />
		<meta property="article:author" content="https://www.facebook.com/floren.com.ua/" />
		<meta property="og:image" content="{$OG_IMAGE}" />
		<meta property="og:publisher" content="https://www.facebook.com/floren.com.ua/" />
		<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
{/if}
{if $URL[0]=='wedding_bouquet'}
		<meta property="og:type" content="product" />
		<meta property="og:site_name" content="floren.com.ua" />
		<meta property="og:title" content="{$GOOD_ONE.name}" />
		<meta property="og:url" content="https://floren.com.ua{$LANGURL}/wedding_bouquet/{$GOOD_ONE.ID}/" />
		<meta property="og:image" content="https://floren.com.ua/images/ins/b/{$GOOD_ONE.image}" />
		<meta property="og:description" content="Отличный свадебный букет. Ну очень красивый." />
{/if}
{if $URL[0]=='bouquet'}
		<meta property="og:type" content="product" />
		<meta property="og:site_name" content="floren.com.ua" />
		<meta property="og:title" content="{$GOOD_ONE.name}" />
		<meta property="og:url" content="https://floren.com.ua{$LANGURL}/bouquet/{$GOOD_ONE.ID}/" />
		<meta property="og:image" content="https://floren.com.ua/images/ins/b/{$GOOD_ONE.image}" />
		<meta property="og:description" content="Отличный букет. Ну очень красивый. Подарите мне такой!" />
{/if}
{if ($URL[0]=='planters') or ($URL[0]=='komnatnie-rasteniya')}
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<!--page_title-->" />
	<meta property="og:url" content="https://floren.com.ua{$LANGURL}/{$URL[0]}{if !empty($URL[1])}/{$URL[1]}{/if}/" />
	<meta property="og:description" content="Шукаєш <!--page_title--> ? Заходь та обирай прямо зараз!" />
	<meta property="article:author" content="https://www.facebook.com/floren.com.ua/" />
	<meta property="og:image" content="https://floren.com.ua/img/category/{if !empty($URL[1])}{$URL[1]}.png{else}_default.png{/if}" />
	<meta property="og:publisher" content="https://www.facebook.com/floren.com.ua/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
{/if}
{if $URL[0] == 'publications' && !empty($URL[1])}
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{$ARTICLE.meta_title|truncate:100}" />
	<meta property="og:description" content="{$ARTICLE.meta_description}" />
	<meta property="og:url" content="https://floren.com.ua{$LANGURL}/publications/{$URL[1]}/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="{$ARTICLE.images}" />
	<meta property="og:image:width" content="{$ARTICLE_IMAGE[0]}" />
	<meta property="og:image:height" content="{$ARTICLE_IMAGE[1]}" />
	<meta property="og:image:alt" content="{$ARTICLE.title} фото 1" />
{/if}
{if $URL[0]=='services' && !empty($URL[1])}
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{$SERVICE.meta_title|truncate:100}" />
	<meta property="og:description" content="{$SERVICE.meta_description}" />
	<meta property="og:url" content="https://floren.com.ua{$LANGURL}/services/{$URL[1]}/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="{$SERVICE.schema_image}" />
	<meta property="og:image:width" content="{$SERVICE_IMAGE[0]}" />
	<meta property="og:image:height" content="{$SERVICE_IMAGE[1]}" />
	<meta property="og:image:alt" content="{$SERVICE.title} фото 1" />
{/if}
{if $URL[0]=='phytodesign'}
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{$META_TITLE|truncate:100}" />
	<meta property="og:description" content="{$META_DESCRIPTION|escape}" />
	<meta property="og:url" content="https://floren.com.ua{$LANGURL}/phytodesign/" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="https://floren.com.ua/images/content/phyto-design-office-1-s.jpg" />
	<meta property="og:image:width" content="350" />
	<meta property="og:image:height" content="150" />
	<meta property="og:image:alt" content="Фітодизайн інте&#700;єра приміщення фото 1" />
{/if}


{if isset($DEPT) && $DEPT=='landscape'}
	<meta property="og:locale" content="ru_UA" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{$META_TITLE|truncate:100}" />
	<meta property="og:description" content="{$META_DESCRIPTION|escape}" />
	<meta property="og:url" content="https://floren.com.ua{$LANGURL}/{$URL[0]}/{if $URL[1]!=''}{$URL[1]}/{/if}" />
	<meta property="og:site_name" content="Флорен – Студія Фітодизайну" />
	<meta property="og:image" content="{$SCHEMA_IMAGE_URL}" />
	<meta property="og:image:width" content="{$SCHEMA_IMAGE_SIZE[0]}" />
	<meta property="og:image:height" content="{$SCHEMA_IMAGE_SIZE[1]}" />
	<meta property="og:image:alt" content="{$TITLE} фото 1" />
{/if}
  	
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;600;900&display=swap"
      rel="stylesheet"
    /> -->
    <!-- <link rel="stylesheet" href="../styles/style.css" /> -->
    {* <script type="module" crossorigin src="/assets/js/modulepreload.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_swipers.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_shoelace.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_events.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_scroll.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_catalog.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_clickOutside.js"></script> *}
    {* <script type="module" crossorigin src="/assets/js/_expandableText.js"></script> *}
    <script type="module" crossorigin src="/assets/js/main.js?v={$smarty.now}"></script>

    <link rel="stylesheet" href="/assets/css/_swipers.css" />
    <link rel="stylesheet" href="/assets/css/index.css?v={$smarty.now}" />
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
    {literal}
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "t92qk5thlj");
    {/literal}
    </script>
    	
    	{if $URL[0]==''}
    	{literal}
    	<script type="application/ld+json">
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
    </script>
    {/literal}
    {/if}
    {literal}
    	<script type="application/ld+json">
    		{
    			"@context": "http://schema.org",
    			"@type": "WebSite",
    			"url": "https://floren.com.ua/",
    			"potentialAction": {
    				"@type": "SearchAction",
    				"target": "https://floren.com.ua{/literal}{$LANGURL}{literal}/search/?srch={search_term_string}",
    				"query-input": "required name=search_term_string" }
    		}
    </script>
    <script type="application/ld+json">
    		{ 
    			"@context": "http://schema.org",
    			"@type": "LocalBusiness",
    			"url": "https://floren.com.ua{/literal}{if $LANGURL=='/ua'}/{else}/ru/{/if}{literal}",
    			"priceRange": "$$",
    			"name": "{/literal}{$LINGVO.logo_alt}{literal}",
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
    				"@id": "https://floren.com.ua{/literal}{$LANGURL}{literal}/contacts/",
    				"name": "{/literal}{$LINGVO.studiya_fitodizayna}{literal}", 
    				"addressRegion": "{/literal}{$LINGVO.kiev_region}{literal}",
    				"addressLocality": "{/literal}{$LINGVO.city_kiev}{literal}",     
    				"postalCode": "03113",
    				"streetAddress": "{/literal}{$LINGVO.address_street}{literal}",
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
    {/literal}
{* ============ START COMMENT ================= *}
    {literal}
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
           fetch('/api/save_to_session.php?r=3',{gaClientId:clientID}, function(data) {});
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
    
    
    
    {/literal}
    <script>
    
    	{$GTAG}
    
    </script>
{*   =========== END COMMENT ========= *}
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
                rel="noopener noreferrer">{$LINGVO.kiev_addr}</a>
                <p>{$LINGVO.opening_hours}:</p>
                <p>{$LINGVO.opening_hours_mo_st}</p>
                <p>{$LINGVO.opening_hours_sn}</p>
              </div>
            </div>
            <sl-button class="header__nav-location--button" data-event="click" data-callback="toggleLocation">
              <svg class="icon icon-location"/>
            {$LINGVO.kiev_shops}
          </sl-button>
          </sl-tooltip>
          <!-- Location dropdown element end -->

          <!-- Меню навігації -->
          <!-- Navigation menu start -->
          <ul class="header__nav-list">
            <li class="header__nav-item">
              <a href="{$LANGURL}/about/" class="header__nav-link">{$LINGVO.menu_about}</a>
            </li>
            <li class="header__nav-item">
              <a href="{$LANGURL}/delivery/" class="header__nav-link">{$LINGVO.menu_delivery}</a>
            </li>
            <li class="header__nav-item">
              <a href="{$LANGURL}/publications/" class="header__nav-link">{$LINGVO.menu_publications}</a>
            </li>
            <li class="header__nav-item">
              <a href="{$LANGURL}/contacts/" class="header__nav-link">{$LINGVO.menu_contacts}</a>
            </li>
          </ul>
          <!-- Navigation menu end -->

          <!-- Вибір мови -->
          <!-- Language dropdown element start -->
          <div class="header__nav-lang">
            <sl-dropdown class="dropdown">
              <sl-button class="header__nav-lang--button" slot="trigger" caret>
              {if $LANG=='ua'}{$LINGVO.lang_sign_ua}{elseif $LANG=='ru'}{$LINGVO.lang_sign_ru}{/if}
              <svg class="icon icon-down"/>
              </sl-button>
              <sl-menu>
                <sl-menu-item {if $LANG=='ua' }data-checked{/if} value="ua">
                {if $LANG!='ua' }<a href="{$LANG_SELECTOR_UA}">{/if}
                {$LINGVO.lang_sign_ua}
                {if $LANG!='ua' }</a>{/if}
              </sl-menu-item>
                <sl-divider></sl-divider>
                <sl-menu-item {if $LANG=='ru' }data-checked{/if} value="ru">
                {if $LANG!='ru' }<a href="{$LANG_SELECTOR_RU}">{/if}
                {$LINGVO.lang_sign_ru}
                {if $LANG!='ru' }</a>{/if}
              </sl-menu-item>
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
            <a href="{if $LANGURL=='/ua'}/{else}/ru/{/if}" class="header__main--logo">
              <img src="/img/main-logo.svg" alt="Logo"/>
            </a>
            <sl-tooltip 
              id="phones-tooltip" 
              class="tooltip header__main--phones-tooltip" 
              trigger="manual"
              placement="bottom-start" 
              style="--sl-tooltip-arrow-size: 0" 
              distance="0"
            >
              <div slot="content" class="header__main--phones-content">
                <button 
                  class="icon-button" 
                  aria-label="{$LINGVO.close_button}" 
                  data-event="click"
                  data-callback="toggleTooltip"
                >
                  <svg class="icon icon-close"></svg>
                </button>
                <div class="phones-tooltip--item">
                  <img src="/img/icons/icon-phone.svg" alt="Phone" />
                  <div class="phones-tooltip--item-wrapper">
                    <p class="item-phone binct-phone-number-2">(044) 333-77-55, (099) 238-26-44</p>
                    <p class="item-hours">По буднях 09:00 - 19:30</p>
                    <p class="item-messengers">
                      <a 
                        href="viber://chat?number=%2B380992382644" 
                        target="_blank" 
                        onclick="trackConv('vb','{$LANGURL}/{$URL|@join:"/"}')"
                      >
                        <svg class="icon icon-whatsapp"></svg>
                      </a>
                      <a 
                        href="https://t.me/studio_floren" 
                        target="_blank" 
                        onclick="trackConv('tg','{$LANGURL}/{$URL|@join:"/"}')"
                      >
                        <svg class="icon icon-telegram"></svg>
                      </a>
                    </p>
                  </div>
                </div>
                <div class="phones-tooltip--item">
                  <img src="/img/icons/icon-feedback.svg" alt="Feedback" />
                  <div class="phones-tooltip--item-wrapper">
                    <a class="item-feedback" href="">{$LINGVO.callback_general}</a>
                  </div>
                </div>
              </div>
              <div class="header__main--phones">
                <img src="/img/icons/icon-phone.svg" alt="Phone" />
                <div class="header__main--phones-wrapper">
                  {* <div class="header__main--phones-hidden binct-phone-number-2"></div> *}
                  <div class="header__main--phones-hidden">
                    (044) 344..
                    <button data-event="click" data-callback="togglePhones">
                      показати
                    </button>
                  </div>
                  <div class="header__main--phones-showed">
                    <span class="binct-phone-number-1">(044) 333-77-55</span>, <span class="binct-phone-number-2">(099) 238-26-44</span>
                    <!-- <a href="tel:(044) 333-77-55">(044) 333-77-55</a>, <a href="tel:(099) 238-26-44">(099) 238-26-44</a> -->
                  </div>
                  <div class="header__main--phones-hours">
                    <span>По буднях 9:00 - 19:30</span>
                    <button class="header__main--phones-hours--button" data-event="click" data-callback="openModal" data-modal-id="header-contact-modal">
                      {$LINGVO.callback_general}
                    </button>
                  </div>
                </div>
              </div>
            </sl-tooltip>

            <!-- TODO: translate this form -->
            <sl-dialog id="header-contact-modal" label="Напішіть нам" class="calculate-modal">    
              <form class="login-modal__form" action="/thankyou/" method="post">
                <input type="hidden" name="cb_topic" value="{$LINGVO.advice_prof} – {$GOOD_ONE.name}"></input>
                <div class="form-control">
                  <sl-input name="cb_name" id="name" label="Ваше ім'я" type="text" placeholder="Ім'я"></sl-input>
                </div>
                <div class="form-control">
                  <label for="phone">Ваш контактний номер телефону*</label>
                  <input id="phone" name="cb_phone" data-tel-input type="tel">
                </div>
                <div class="form-control">
                  <sl-textarea id="message" name="cb_txt" label="Ваше повідомлення" type="text" placeholder="Повідомлення"></sl-textarea>
                </div>
            
                <div class="form-control">
                  <button class="button button--primary" type="submit">Відправити</button>
                </div>
              </form>
            </sl-dialog>
       
          </div>

          <!-- Права частина: пошук, профіль, улюблені, кошик -->
          <div class="header__main--right">
            <!-- Search form start -->
            <form id="main-search-form" action="{$LANGURL}/search/" method="get" class="header__main--search">
              <div class="search-wrapper">
                <img class="search-icon" src="/img/icons/icon-search.svg" alt="Search"/>
                <input class="search-input" type="search" name="srch" placeholder="{$LINGVO.search_default_txt}"{if $SRCH_ROW} value="{$SRCH_ROW}"{/if}/>
                <button class="search-button">{$LINGVO.search_button}</button>
              </div>
              <button class="search-mobile-close" type="button" data-event="click" data-callback="toggleMobileSearch">
                <svg class="icon icon-close" />
              </button>
            </form>
            <!-- Search form end -->

            <div class="header__main--profile">
              <button class="header__main--profile-mobile icon-button" data-event="click" data-callback="showPhonesMobile" data-modal-id="mobile-header-phones">
                <svg class="icon icon-phone" />
              </button>
              <sl-dialog id="mobile-header-phones" label="Звʼязатися з нами" class="dialog-overview">
                <div class="header__main--phones-content">
                  <div class="phones-tooltip--item">
                    <img src="/img/icons/icon-phone.svg" alt="Phone" />
                    <div class="phones-tooltip--item-wrapper">
                      <p class="item-phone">
                        <span class="binct-phone-number-1">(044) 333-77-55</span>,
                        <span class="binct-phone-number-2">(099) 238-26-44</span>
                      </p>
                      <p class="item-hours">По буднях 09:00 - 19:30</p>
                      <p class="item-messengers">
                        <a href="viber://chat?number=%2B380992382644" target="_blank" onclick="trackConv('vb','{$LANGURL}/{$URL|@join:"
                          /"}')">
                          <svg class="icon icon-whatsapp"></svg>
                        </a>
                        <a href="https://t.me/studio_floren" target="_blank" onclick="trackConv('tg','{$LANGURL}/{$URL|@join:" /"}')">
                          <svg class="icon icon-telegram"></svg>
                        </a>
                      </p>
                    </div>
                  </div>
                  <!-- <div class="phones-tooltip--item">
                    <img src="/img/icons/icon-feedback.svg" alt="Feedback" />
                    <div class="phones-tooltip--item-wrapper">
                      <a class="item-feedback" href="">{$LINGVO.callback_general}</a>
                    </div>
                  </div> -->
                </div>
              </sl-dialog>
              <button class="header__main--profile-mobile icon-button" type="button" data-event="click" data-callback="toggleMobileSearch">
                <svg class="icon icon-search" />
              </button>
<!-- 
              <a href="#" class="icon-button" aria-label="{$LINGVO.cabinet}" data-event="click" data-callback="openModal"
              data-modal-id="sign-in-modal">
                <svg class="icon icon-user"/>
              </a>
              <a href="#" class="icon-button" aria-label="{$LINGVO.cabinet_favorites}">
                <span class="badge warning">10</span>
                <svg class="icon icon-heart"/>
              </a>
-->
              <!-- <a href="{$LANG_URL}/basket/" class="icon-button" aria-label="{$LINGVO.basket}" data-event="click" data-callback="openModal"
              data-modal-id="cart-modal"> -->
              <a href="{$LANGURL}/basket/" class="icon-button" aria-label="{$LINGVO.basket}" data-modal-id="cart-modal">
              {if $BASKET|@count > 0}
              <span class="badge success" id="cart-modal-button-badge">{$BASKET|@count}</span>
              {/if}
              <svg class="icon icon-basket"/>
              </a>
            </div>

            <!-- Start Cart modal -->
            <sl-dialog id="cart-modal" label="{$LINGVO.basket}" class="cart-modal">
              <div class="alert alert-success cart-modal__message" role="alert">
              Товар <u id="cart-modal-product-name"></u> доданий у ваш <a href="/basket/" class="underline">кошик</a>
              </div>
              <ul class="cart-items-list" id="cart-modal-items-list">
              {if $BASKET|@count>0}
                {foreach item=B from=$BASKET}
                  <li class="cart-item" data-id="{$B.formID}">
                  <div class="cart-item__image">
                    <a href="{$B.href}">
                      <img src="{$B.img}" alt="{$B.name}">
                    </a>
                  </div>
                  <div class="cart-item__details">
                    <button class="cart-item__remove">
                      <svg class="icon icon-trash"/>
                    </button>
                    <h3>
                      <a href="{$B.href}">{$B.name}</a>
                    </h3>
                    <div class="cart-item__details_options">{$B.goodLegend}</div>
                    <div class="cart-item__details_controls"> {** Dimon if you need - you can use this id="{$B.formID}"  **}
                        <div class="cart-item__details_controls-grid">
                        <quantity-counter value="{$B.cnt}" min="1"></quantity-counter>
                        <span>x {$B.price|number_format:2:'.':' '} ₴</span>
                      </div>
                      <div class="cart-item__details_price">{($B.price*$B.cnt)|number_format:2:'.':' '} ₴</div>
                    </div>
                  </div>
                </li>
                {/foreach}
              {/if}
            </ul>
              <div class="cart-modal__footer">
                <button class="cart-modal__footer_continue underline" data-event="click"
                data-callback="closeModal">{$LINGVO.continue_shopping}</button>
                <div class="cart-modal__footer_total">{$LINGVO.total}: <b id="cart-modal-total-ammount">{$BSK_TTL|number_format:2:'.':' '} ₴</b>
                </div>
                <a href="{$LANGURL}/basket/" class="button button--small button--primary">{$LINGVO.checkout}</a>
              </div>
            </sl-dialog>
            <!-- End Cart modal -->

            <!-- Start Sign in modal -->
            <sl-dialog id="sign-in-modal" label="Вхід" class="login-modal">
              <form class="login-modal__form" action="{$LANGURL}/login/" method="post">
                <div class="form-control">
                {**
                  <label for="phone">Ваш телефон</label>
                  <input id="phone" data-tel-input type="tel">
                **}
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
            <!-- End Sign up modal -->

            <!-- Start Sign up modal greeting -->
            <sl-dialog id="sign-up-modal-greeting" label="Реєстрація" class="login-modal">
              <div class="login-modal__greeting">
                <img src="/img/Illustration.png" alt="Вітаємо!">
                <p>Вітаємо! Ви успішно зареєструвались. Тепер Ви можете користуватись Вашим кабінетом і здійснювати
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
            {$LINGVO.catalog}
          </button>
          <!-- Список категорій каталогу -->

          <!-- prettier-ignore -->

          <!-- Dropdown список категорій -->
          <div class="header__catalog_list">
            <!-- <a href="{$LANGURL}" class="header__catalog_mobile-profile">
              <svg class="icon icon-user"></svg>
              Особистий кабінет
            </a> -->
            <div class="header__catalog_list-wrapper">
              <h3 class="header__catalog_list-mobile-title">Каталог товарів</h3>
              <!-- Список категорій - ліва частина -->
              <ul class="category-list">
                {foreach item=C name=C key=I from=$CATEGORY_LEFT}
                  <li class="active" data-category="{$C.alias}">
                    <a href="{$LANGURL}/{$C.alias}/">
                      <img src="/img/icons/icon-mmenu-{$C.alias}.svg" alt="{$C.name}"/>
                      <span>{$C.name}</span>
                    </a>
                  </li>
                {/foreach}
              </ul>

              <h3 class="header__catalog_list-mobile-title" style="margin-top: 1rem;">Каталог послуг</h3>

              <ul class="services-list-mobile">
                <li data-category="services-phytodesign">
                  <a href="{$LANGURL}/phytodesign/">
                    <b>{$LINGVO.phytodesign}</b>
                    <span>{$LINGVO.ozelenenie_prostoru}</span>
                    <span class="summary-icon" data-event="click" data-callback="toggleDetails"></span>
                  </a>
                  <sl-details class="services-list-mobile-details">
                      <ul class="services-list-mobile-content">
                        <li>
                          <a class="underline" href="/ua/services/phytodesign-kvartiri/">
                            <div class="services-list-image">
                              <img src="/img/sevices/apartment-phytodesign.png" alt="Озеленення квартири">
                            </div>                          
                            <span>Озеленення квартири</span>
                          </a>                      
                        </li>
                        <li>
                          <a class="underline" href="/ua/services/phytodesign-ofisa/">
                            <div class="category-content__item-list-image  services-list-image">
                              <img src="/img/sevices/office-phytodesign.png" alt="Озеленення офісу">
                            </div>                          
                            <span>Озеленення офісу</span>
                          </a>                      
                        </li>
                        <li>
                          <a class="underline" href="/ua/services/ozelenenie_letney_ploschadki/">
                            <div class="category-content__item-list-image  services-list-image">
                              <img src="/img/sevices/landscaping-of-summer-terraces.png" alt="Озеленення літніх терас">
                            </div>                          
                            <span>Озеленення літніх терас</span>
                          </a>                      
                        </li>
                        <li>
                          <a class="underline" href="/ua/services/peregorodki-iz-rasteniy/">
                            <div class="category-content__item-list-image  services-list-image">
                              <img src="/img/sevices/zoning-space-with-indoor-plants.png" alt="Зонування простору">
                            </div>                          
                            <span>Зонування простору</span>
                          </a>                      
                        </li>                    
                        <li>
                          <a class="underline" href="/ua/services/ozelenenie-iskusstvennimi-rasteniyami/">
                            <div class="category-content__item-list-image  services-list-image">
                              <img src="/img/sevices/landscaping-artificial-plants.png" alt="Озеленення штучними рослинами">
                            </div>                          
                            <span>Озеленення штучними рослинами</span>
                          </a>                      
                        </li>
                      </ul>                    
                  </sl-details>
                </li>
                <li data-category="services-vertical">
                  <a href="{$LANGURL}/services/vertikalnoe-ozelenenie/">
                    <b>{$LINGVO.vertikalnoe_ozelenenie}</b>
                    <span>{$LINGVO.green_wall_short}</span>
                    <span class="summary-icon" data-event="click" data-callback="toggleDetails"></span>
                  </a>
                  <sl-details class="services-list-mobile-details">
                    <ul class="services-list-mobile-content">
                      <li>
                        <a class="underline" href="{$LANGURL}/services/green-wall/">
                          <div class="category-content__item-list-image  services-list-image">
                            <img src="/img/sevices/green-walls.png" alt="{$LINGVO.green_wall}"/>
                          </div>                          
                          <span>{$LINGVO.green_wall}</span>
                        </a>                      
                      </li>
                      <li>
                        <a class="underline" href="{$LANGURL}/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/">
                          <div class="category-content__item-list-image  services-list-image">
                            <img src="/img/sevices/landscaping-using-vertical-structures.png" alt="{$LINGVO.metall_ozel}"/>
                          </div>                          
                          <span>{$LINGVO.metall_ozel}</span>
                        </a>                      
                      </li>
                      <li>
                        <a class="underline" href="{$LANGURL}/services/ozelenenie-stabilizirovannim-mhom/">
                          <div class="category-content__item-list-image  services-list-image">
                            <img src="/img/sevices/green-moss-walls.png" alt="{$LINGVO.ozelenenie_moss}"/>
                          </div>                          
                          <span>{$LINGVO.ozelenenie_moss}</span>
                        </a>                      
                      </li>
                    </ul>
                  </sl-details>
                </li>
                <li data-category="services-care">
                  <a href="{$LANGURL}/services/house_plant_care/">
                    <b>{$LINGVO.care}</b>
                    <span>{$LINGVO.za_rasteniyami}</span>
                    <span class="summary-icon" data-event="click" data-callback="toggleDetails"></span>
                  </a>
                  <sl-details class="services-list-mobile-details">
                    <ul class="services-list-mobile-content">
                      <li>
                        <a class="underline" href="{$LANGURL}/services/peresadka/">
                          <div class="category-content__item-list-image  services-list-image">
                            <img src="/img/sevices/plant-transplantation.png" alt="{$LINGVO.peresadka_rasteniy}"/>
                          </div>                          
                          <span>{$LINGVO.peresadka_rasteniy}</span>
                        </a>                      
                      </li>
                      <li>
                        <a class="underline" href="{$LANGURL}/services/shipping/">
                          <div class="category-content__item-list-image  services-list-image">
                            <img src="/img/sevices/plant-transportation.png" alt="{$LINGVO.perevozka_rasteniy}"/>
                          </div>                          
                          <span>{$LINGVO.perevozka_rasteniy}</span>
                        </a>                      
                      </li>
                      <li>
                        <a class="underline" href="{$LANGURL}/services/arenda_rasteniy/">
                          <div class="category-content__item-list-image  services-list-image">
                            <img src="/img/sevices/plant-rental.png" alt="{$LINGVO.arenda_rasteniy}"/>
                          </div>                          
                          <span>{$LINGVO.arenda_rasteniy}</span>
                        </a>                      
                      </li>
                    </ul>
                  </sl-details>
                </li>
                <li class="single-item">
                  <a href="{$LANGURL}/gallery/">
                    <b>{$LINGVO.portfolio}</b>
                    <span>{$LINGVO.photo_gallery}</span>
                  </a>
                </li>
              </ul>
              <!-- Контент категорій - права частина -->
              <div class="category-content">
                  <!-- prettier-ignore -->
                  <!-- Контент категорії "Кімнатні рослини" для меню каталогу -->
                {foreach item=C name=C key=I from=$CATEGORY_LEFT}
                  <section class="category-content__item" data-category="{$C.alias}">
                    <button class="category-content__back-button">
                      <svg class="icon icon-arrow-angle-left"/>
                      {$C.name}
                    </button>
                    <ul class="category-content__item-list">
                      <li class="category-content__item-list-all">
                        <a href="{$LANGURL}/{$C.alias}/">
                          <div class="category-content__item-list-image">
                            <img src="/img/icons/icon-mmenu-{$C.alias}.svg" alt="{$C.name}" />
                          </div>                          
                          <span>Всі</span>
                        </a>
                      </li>
                      {foreach item=CC name=CC from=$C.category}
                      <li>
                        <a href="{$LANGURL}/{$C.alias}/{$CC.cur_alias}/">
                          <div class="category-content__item-list-image">
                            <img src="/img/category/{$CC.cur_alias}.png?v=1" alt="{$CC.name}" />
                          </div>                          
                          <span>{$CC.name}</span>
                        </a>
                      </li>
                      {/foreach}
                    </ul>
                    <ul class="category-content__item-related">
                      <li>
                        <a class="underline" href="{$LANGURL}/gift-card/">{$LINGVO.gift_card}</a>
                      </li>
                      <li>
                        <a class="underline"
                          href="{$LANGURL}/services/peregorodki-iz-rasteniy/">{$LINGVO.peregorodki_iz_rasteniy}</a>
                      </li>
                    </ul>
                  </section>
                {/foreach}
                <!-- Services category content -->
                <section class="category-content__item" data-category="services-phytodesign">
                  <button class="category-content__back-button">
                    <svg class="icon icon-arrow-angle-left"/>
                    {$LINGVO.phytodesign}
                  </button>
                  <ul class="category-content__item-list">
                    <li class="category-content__item-list-all">
                      <a href="{$LANGURL}/phytodesign/">                        
                        <span>Всі послуги з фітодизайну</span>
                      </a>
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/phytodesign-kvartiri/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/apartment-phytodesign.png" alt="{$LINGVO.phytodesign_kvartiri}"/>
                        </div>                          
                        <span>{$LINGVO.phytodesign_kvartiri}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/phytodesign-ofisa/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/office-phytodesign.png" alt="{$LINGVO.phytodesign_ofisa}"/>
                        </div>                          
                        <span>{$LINGVO.phytodesign_ofisa}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/ozelenenie_letney_ploschadki/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/landscaping-of-summer-terraces.png" alt="{$LINGVO.ozelenenie_terras}"/>
                        </div>                          
                        <span>{$LINGVO.ozelenenie_terras}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/peregorodki-iz-rasteniy/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/zoning-space-with-indoor-plants.png" alt="{$LINGVO.zonirovanie}"/>
                        </div>                          
                        <span>{$LINGVO.zonirovanie}</span>
                      </a>                      
                    </li>                    
                    <li>
                      <a class="underline" href="{$LANGURL}/services/ozelenenie-iskusstvennimi-rasteniyami/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/landscaping-artificial-plants.png" alt="{$LINGVO.ozelenenie_iskusstvennimi_rasteniyami}"/>
                        </div>                          
                        <span>{$LINGVO.ozelenenie_iskusstvennimi_rasteniyami}</span>
                      </a>                      
                    </li>
                  </ul>
                </section>
                <section class="category-content__item" data-category="services-vertical">
                  <button class="category-content__back-button">
                    <svg class="icon icon-arrow-angle-left"/>
                    {$LINGVO.vertikalnoe_ozelenenie}
                  </button>
                  <ul class="category-content__item-list">
                    <li class="category-content__item-list-all">
                      <a href="{$LANGURL}/services/vertikalnoe-ozelenenie/">                        
                        <span>Всі послуги з вертикального озеленення</span>
                      </a>
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/green-wall/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/green-walls.png" alt="{$LINGVO.green_wall}"/>
                        </div>                          
                        <span>{$LINGVO.green_wall}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/landscaping-using-vertical-structures.png" alt="{$LINGVO.metall_ozel}"/>
                        </div>                          
                        <span>{$LINGVO.metall_ozel}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/ozelenenie-stabilizirovannim-mhom/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/green-moss-walls.png" alt="{$LINGVO.ozelenenie_moss}"/>
                        </div>                          
                        <span>{$LINGVO.ozelenenie_moss}</span>
                      </a>                      
                    </li>
                  </ul>
                </section>
                <section class="category-content__item" data-category="services-care">
                  <button class="category-content__back-button">
                    <svg class="icon icon-arrow-angle-left"/>
                    {$LINGVO.care}
                  </button>
                  <ul class="category-content__item-list">
                    <li class="category-content__item-list-all">
                      <a href="{$LANGURL}/services/house_plant_care/">                        
                        <span>Всі послуги по догляду за рослинами</span>
                      </a>
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/peresadka/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/plant-transplantation.png" alt="{$LINGVO.peresadka_rasteniy}"/>
                        </div>                          
                        <span>{$LINGVO.peresadka_rasteniy}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/shipping/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/plant-transportation.png" alt="{$LINGVO.perevozka_rasteniy}"/>
                        </div>                          
                        <span>{$LINGVO.perevozka_rasteniy}</span>
                      </a>                      
                    </li>
                    <li>
                      <a class="underline" href="{$LANGURL}/services/arenda_rasteniy/">
                        <div class="category-content__item-list-image  services-list-image">
                          <img src="/img/sevices/plant-rental.png" alt="{$LINGVO.arenda_rasteniy}"/>
                        </div>                          
                        <span>{$LINGVO.arenda_rasteniy}</span>
                      </a>                      
                    </li>
                  </ul>
                </section>
              </div>
            </div>
            <div class="header__catalog_list-wrapper">
              <h3 class="header__catalog_list-mobile-title">Інформація</h3>
              <ul class="category-list category-list--information-mobile">
                <li>
                  <a href="{$LANGURL}/about/">{$LINGVO.menu_about}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/delivery/">{$LINGVO.menu_delivery}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/publications/">{$LINGVO.menu_publications}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/contacts/">{$LINGVO.menu_contacts}</a>
                </li>
              </ul>
              <div class="category-list--item-messengers">
                <a href="viber://chat?number=%2B380992382644" target="_blank" onclick="trackConv('vb','{$LANGURL}/{$URL|@join:"/"}')">
                  <svg class="icon icon-whatsapp" />
                </a>
                <a href="https://t.me/studio_floren" target="_blank" onclick="trackConv('tg','{$LANGURL}/{$URL|@join:"/"}')">
                  <svg class="icon icon-telegram" />
                </a>
              </div>
            </div>
          </div>          
        </div>
          <!-- Додаткові категорії: фітодизайн, вертикальне озеленення, флораріуми -->
          <ul class="header__catalog--secondary">
            <li class="secondary-item">
              <button class="secondary-item--button" aria-label="{$LINGVO.phytodesign}">
                <svg class="icon icon-fitodesign"/>
                <div class="secondary-item--button-text">
                  <a href="{$LANGURL}/phytodesign/">
                    <b>{$LINGVO.phytodesign}</b>
                    <span>{$LINGVO.ozelenenie_prostoru}</span>
                  </a>
                </div>
              </button>
              <section class="secondary-item--content">
                <ul class="secondary-item--content-list">
                  <li>
                    <img src="/img/sevices/apartment-phytodesign.png" alt="{$LINGVO.phytodesign_kvartiri}"/>
                    <a class="underline" href="{$LANGURL}/services/phytodesign-kvartiri/">{$LINGVO.phytodesign_kvartiri}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/office-phytodesign.png" alt="{$LINGVO.phytodesign_ofisa}"/>
                    <a class="underline" href="{$LANGURL}/services/phytodesign-ofisa/">{$LINGVO.phytodesign_ofisa}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/landscaping-of-summer-terraces.png" alt="{$LINGVO.ozelenenie_terras}"/>
                    <a class="underline" href="{$LANGURL}/services/ozelenenie_letney_ploschadki/">{$LINGVO.ozelenenie_terras}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/zoning-space-with-indoor-plants.png"
                    alt="{$LINGVO.zonirovanie}"/>
                    <a class="underline" href="{$LANGURL}/services/peregorodki-iz-rasteniy/">{$LINGVO.zonirovanie}</a>
                  </li>
                  <!--
                  <li>
                    <img src="/img/sevices/plant-rental.png" alt="Зелені рішення для HoReCa"/>
                    <a class="underline" href="#">Зелені рішення для HoReCa</a>
                  </li>
                  -->
                  <li>
                    <img src="/img/sevices/landscaping-artificial-plants.png" alt="{$LINGVO.ozelenenie_iskusstvennimi_rasteniyami}"/>
                    <a class="underline" href="{$LANGURL}/services/ozelenenie-iskusstvennimi-rasteniyami/">{$LINGVO.ozelenenie_iskusstvennimi_rasteniyami}</a>
                  </li>
                </ul>
              </section>
            </li>
            <li class="secondary-item">
              <button class="secondary-item--button" aria-label="{$LINGVO.vertikalnoe_ozelenenie}">
                <svg class="icon icon-vertical"/>
                <div class="secondary-item--button-text">
                  <a href="{$LANGURL}/services/vertikalnoe-ozelenenie/">
                    <b>{$LINGVO.vertikalnoe_ozelenenie}</b>
                    <span>{$LINGVO.green_wall_short}</span>
                  </a>
                </div>
              </button>
              <section class="secondary-item--content">
                <ul class="secondary-item--content-list">
                  <li>
                    <img src="/img/sevices/green-walls.png" alt="{$LINGVO.green_wall}"/>
                    <a class="underline" href="{$LANGURL}/services/green-wall/">{$LINGVO.green_wall}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/landscaping-using-vertical-structures.png" alt="{$LINGVO.metall_ozel}"/>
                    <a class="underline" href="{$LANGURL}/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/">{$LINGVO.metall_ozel}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/green-moss-walls.png" alt="{$LINGVO.ozelenenie_moss}"/>
                    <a class="underline" href="{$LANGURL}/services/ozelenenie-stabilizirovannim-mhom/">{$LINGVO.ozelenenie_moss}</a>
                  </li>
                </ul>
              </section>
            </li>
            <li class="secondary-item">
              <button class="secondary-item--button" aria-label="{$LINGVO.care} {$LINGVO.za_rasteniyami}">
                <svg class="icon icon-care"/>
                <div class="secondary-item--button-text">
                  <a href="{$LANGURL}/services/house_plant_care/">
                    <b>{$LINGVO.care}</b>
                    <span>{$LINGVO.za_rasteniyami}</span>
                  </a>
                </div>
              </button>
              <section class="secondary-item--content">
                <ul class="secondary-item--content-list">
                  <li>
                    <img src="/img/sevices/plant-transplantation.png" alt="{$LINGVO.peresadka_rasteniy}"/>
                    <a class="underline" href="{$LANGURL}/services/peresadka/">{$LINGVO.peresadka_rasteniy}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/plant-transportation.png" alt="{$LINGVO.perevozka_rasteniy}"/>
                    <a class="underline" href="{$LANGURL}/services/shipping/">{$LINGVO.perevozka_rasteniy}</a>
                  </li>
                  <li>
                    <img src="/img/sevices/plant-rental.png" alt="{$LINGVO.arenda_rasteniy}"/>
                    <a class="underline" href="{$LANGURL}/services/arenda_rasteniy/">{$LINGVO.arenda_rasteniy}</a>
                  </li>
                </ul>
              </section>
            </li>
            <li class="secondary-item">
              <button class="secondary-item--button" aria-label="{$LINGVO.photo_gallery}">
                <svg class="icon icon-photogallery"/>
                <div class="secondary-item--button-text">
                  <a href="{$LANGURL}/gallery/">
                    <b>{$LINGVO.portfolio}</b>
                    <span>{$LINGVO.photo_gallery}</span>
                  </a>
                </div>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>

  {* ***************************** Основний контент сторінки ***************************** *}
  {* ***************************** Якщо сторінка без лівого меню ***************************** *}
  {if $URL[0]=='' || $URL[0]=='basket' || ($URL[0]=='services' && empty($URL[1]))} 
    {include file="$CONTENT_TPL"}
  {else}
  {* ***************************** Якщо сторінка двоколоночна ***************************** *}
    <main class="catalog-page">
      <div class="container">
        <!-- Sidebar navigation - категорії каталогу -->
        <div class="catalog-page__grid">
          <aside class="catalog-page__nav">
          {include file="$LEFT_TPL"}
          </aside>
          <div class="catalog-page__content">
            {if $URL[0]!=''}
              <!-- Breadcrumbs -->
               <div class="catalog-page__breadcrumbs">
                <div class="catalog-page__breadcrumbs-scroll">
                  <sl-breadcrumb itemscope itemtype="https://schema.org/BreadcrumbList">
                    {foreach item=H name=H from=$HLEB}
	                    {if $smarty.foreach.H.iteration==1}
	                    
	                    <sl-breadcrumb-item href="{if $LANGURL=='/ua'}/{else}/ru/{/if}" itemprop="itemListElement" itemscope
	                      itemtype="https://schema.org/ListItem">
	                      <link itemprop="item" href="{if $LANGURL=='/ua'}/{else}/ru/{/if}">
	                      <span itemprop="name">{$LINGVO.main_page}</span>
	                      <meta itemprop="position" content="1">
	                    </sl-breadcrumb-item>
	                    
	                    {elseif $H.link!=''}{** not last item **}
	                    <sl-breadcrumb-item href="{$LANGURL}{$H.link}" itemprop="itemListElement" itemscope
	                      itemtype="https://schema.org/ListItem">
	                      <link itemprop="item" href="{$LANGURL}{$H.link}">
	                      <span itemprop="name">{$H.name}</span>
	                      <meta itemprop="position" content="{$smarty.foreach.H.iteration}">
	                    </sl-breadcrumb-item>
	                    
	                    {else}{** last item without arrows **}
	                    <sl-breadcrumb-item href="{$smarty.server.REQUEST_URI}" itemprop="itemListElement" itemscope
	                      itemtype="https://schema.org/ListItem">
	                      <link itemprop="item" href="{$smarty.server.REQUEST_URI}">
	                      <span itemprop="name">{$H.name}</span>
	                      <meta itemprop="position" content="{$smarty.foreach.H.iteration}">
	                    </sl-breadcrumb-item>
	                    {/if}
                    {/foreach}
                  </sl-breadcrumb>                  
                </div>
                <button class="button catalog-page__breadcrumbs-button" data-event="click" data-callback="openModal"
                  data-modal-id="category-drawer">
                  <span class="icon icon-arrow-top-down"></span>
                </button>
               </div>
            {/if}

            {include file="$CONTENT_TPL"}
            
          </div>
        </div>
      </div>

      {include file="$LAST_WORKS"}
    </main>
  {/if}



  <!-- Модальне вікно перегляду фото -->
    <div class="photo-viewer" id="main-photo-viewer">
      <div class="photo-viewer__overlay"></div>
      <div class="photo-viewer__wrapper">
        <div class="photo-viewer__pagination"></div>
        <button class="photo-viewer__close-button">
          <span class="icon icon-close"></span>
        </button>
        <div style="--swiper-navigation-color: #fff" class="swiper photo-viewer__main-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="https://floren.com.ua/images/gallery/b/ozelenenie-office-kiev-212.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-2.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-3.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-4.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-5.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-6.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-7.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-8.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-9.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-10.jpg"/>
            </div>
          </div>
          <div class="photo-viewer__button-next">
            <span class="icon icon-arrow-angle-right"></span>
          </div>
          <div class="photo-viewer__button-prev">
            <span class="icon icon-arrow-angle-left"></span>
          </div>
        </div>
        <div thumbsSlider="2" class="swiper photo-viewer__thumbs-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="https://floren.com.ua/images/gallery/b/ozelenenie-office-kiev-212.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-2.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-3.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-4.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-5.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-6.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-7.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-8.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-9.jpg"/>
            </div>
            <div class="swiper-slide">
              <img src="https://swiperjs.com/demos/images/nature-10.jpg"/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Підвал сайту -->
    <!-- Footer site -->
    <footer class="footer">

      <!-- Топ категорії і теги -->
      <div class="footer__catalog">
        <div class="container">
          <!--footers_block-->
        </div>
      </div>

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
              <a href="/" class="footer__body-logo" aria-label="{$LINGVO.logo_alt}">
                <img src="/img/footer-logo.png" alt="{$LINGVO.logo_alt}"/>
              </a>
            </section>
            <section>
              <h3>{$LINGVO.poleznaya_info}</h3>
              <ul class="footer__body-list">
                <li>
                  <a href="{$LANGURL}/about/">{$LINGVO.menu_about}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/purchase-returns/">{$LINGVO.menu_purchaise_return}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/partnership/">{$LINGVO.menu_partnership}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/contacts/">{$LINGVO.menu_contacts}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/sitemap/">{$LINGVO.sitemap}</a>
                </li>
              </ul>
            </section>
            <section>
              <h3>{$LINGVO.goods_and_services}</h3>
              <ul class="footer__body-list">
                <li>
                  <a href="{$LANGURL}/phytodesign/">{$LINGVO.phytodesign}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/services/vertikalnoe-ozelenenie/">{$LINGVO.vertikalnoe_ozelenenie}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/services/house_plant_care/">{$LINGVO.care} {$LINGVO.za_rasteniyami}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/komnatnie-rasteniya/">{$LINGVO.plants}</a>
                </li>
                <li>
                  <a href="{$LANGURL}/planters/">{$LINGVO.planters_kashpo}</a>
                </li>
              </ul>
            </section>
            <section>
              <h3>Контакти</h3>
              <ul class="footer__body-contacts">
                <li>
                  <p class="contacts-street">
                    <svg class="icon icon-location"/>
                    <a href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank">{$LINGVO.address_street}</a>
                  </p>
                  <p>03113, {$LINGVO.city_kiev}, {$LINGVO.ukraine}</p>
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
                    <p class="binct-phone-number-1">(044) 333-77-55</p>
                    <p class="binct-phone-number-2">(099) 238-26-44</p>
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
              <span>&copy; 2011–{$smarty.now|date_format:"%Y"} Флорен&trade;</span>
              <a class="not-underline" href="{$LANGURL}/dogovir-oferta/">{$LINGVO.dogovir}</a>
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
  {if $URL[0]=='product'}
    <script src="https://www.youtube.com/iframe_api"></script>
  {/if}
  
  <!-- BEGIN BINOCHAT CODE  -->
  {literal}   
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
  
  {/literal}

  <!-- Головний JS файл -->
  </body>

</html>