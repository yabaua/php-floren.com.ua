<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Головна сторінка</title>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;600;900&display=swap"
      rel="stylesheet"
    /> -->
    <!-- <link rel="stylesheet" href="../styles/style.css" /> -->
    <script type="module" crossorigin src="/assets/js/modulepreload.js"></script>
    <script type="module" crossorigin src="/assets/js/_swipers.js"></script>
    <script type="module" crossorigin src="/assets/js/_shoelace.js"></script>
    <script type="module" crossorigin src="/assets/js/_events.js"></script>
    <script type="module" crossorigin src="/assets/js/_scroll.js"></script>
    <script type="module" crossorigin src="/assets/js/_catalog.js"></script>
    <script type="module" crossorigin src="/assets/js/_clickOutside.js"></script>
    <script type="module" crossorigin src="/assets/js/_expandableText.js"></script>
    <script type="module" crossorigin src="/assets/js/main.js"></script>

    <link rel="stylesheet" href="/assets/css/_swipers.css"/>
    <link rel="stylesheet" href="/assets/css/index.css"/>
  </head>
  <body>
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
          <sl-tooltip
            id="location-tooltip"
            class="tooltip header__nav-location"
            trigger="manual"
            placement="bottom-start"
            style="--sl-tooltip-arrow-size: 0"
            distance="0"
          >
            <div slot="content" class="header__nav-location--content">
              <img src="/img/icon-shop.svg" alt="icon-shop"/>
              <div class="description">
                <button
              class="icon-button header__nav-location--close"
              aria-label="Закрити вікно"
              data-event="click"
              data-callback="toggleLocation"
            >
                  <svg class="icon icon-close"/>
                </button>
                <a
              href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7"
              target="_blank"
              rel="noopener noreferrer"
              >{$LINGVO.kiev_addr}</a
            >
                <p>{$LINGVO.opening_hours}:</p>
                <p>{$LINGVO.opening_hours_mo_st}</p>
                <p>{$LINGVO.opening_hours_sn}</p>
              </div>
            </div>
            <sl-button
          class="header__nav-location--button"
          data-event="click"
          data-callback="toggleLocation"
        >
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
              <sl-button class="header__nav-lang--button" slot="trigger" caret
            >{if $LANG=='ua'}{$LINGVO.lang_sign_ua}{elseif $LANG=='ru'}{$LINGVO.lang_sign_ru}{/if}
            <svg class="icon icon-down"/>
              </sl-button>
              <sl-menu>
                <sl-menu-item{if $LANG=='ua'} data-checked{/if} value="ua">{$LINGVO.lang_sign_ua}</sl-menu-item>
                <sl-divider></sl-divider>
                <sl-menu-item{if $LANG=='ru'} data-checked{/if} value="ru">{$LINGVO.lang_sign_ru}</sl-menu-item>
              </sl-menu>
            </sl-dropdown>
          </div>
          <!-- Language dropdown element end -->
        </nav>

        <!-- Основна частина header з лого, телефонами, пошуком, кошиком -->
        <div class="header__main">
          <div class="header__main--left">
            <a href="/" class="header__main--logo">
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
              data-callback="togglePhones"
            >
                  <svg class="icon icon-close"/>
                </button>
                <div class="phones-tooltip--item">
                  <img src="/img/icons/icon-phone.svg" alt="Phone"/>
                  <div class="phones-tooltip--item-wrapper">
                    <p class="item-phone">(044) 344-28-95, (050) 660-52-75</p>
                    <p class="item-hours">По буднях 09:00 - 19:30</p>
                    <p class="item-messengers">
                      <a href="">
                        <svg class="icon icon-whatsapp"/>
                      </a>
                      <a href="">
                        <svg class="icon icon-telegram"/>
                      </a>
                    </p>
                  </div>
                </div>
                <div class="phones-tooltip--item">
                  <img src="/img/icons/icon-feedback.svg" alt="Feedback"/>
                  <div class="phones-tooltip--item-wrapper">
                    <a class="item-feedback" href="">{$LINGVO.callback_general}</a>
                  </div>
                </div>
              </div>
              <div class="header__main--phones">
                <img src="/img/icons/icon-phone.svg" alt="Phone"/>
                <div class="header__main--phones-wrapper">
                  <div class="header__main--phones-hidden">
                (044) 344..
                <button data-event="click" data-callback="togglePhones">
                  показати
                </button>
                  </div>
                  <div class="header__main--phones-showed">
                (044) 344-28-95, (050) 660-52-75
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
            <form action="" class="header__main--search">
              <div class="search-wrapper">
                <img
              class="search-icon"
              src="/img/icons/icon-search.svg"
              alt="Search"
/>
                <input class="search-input" type="search" placeholder="{$LINGVO.search_default_txt}"/>
                <button class="search-button">{$LINGVO.search_button}</button>
              </div>
            </form>
            <!-- Search form end -->

            <div class="header__main--profile">
              <a href="#" class="icon-button" aria-label="{$LINGVO.cabinet}"  data-event="click" data-callback="openModal" data-modal-id="sign-in-modal">
                <svg class="icon icon-user"/>
              </a>
              <a href="#" class="icon-button" aria-label="{$LINGVO.cabinet_favorites}">
                <span class="badge warning">10</span>
                <svg class="icon icon-heart"/>
              </a>
              <a href="#" class="icon-button" aria-label="{$LINGVO.basket}" data-event="click" data-callback="openModal" data-modal-id="cart-modal">
                <span class="badge success">2</span>
                <svg class="icon icon-basket"/>
              </a>
            </div>

            <!-- Start Cart modal -->
            <sl-dialog id="cart-modal" label="Кошик" class="cart-modal">
              <div class="alert alert-success" role="alert">
    Товар <a href="/" class="underline">Орхідея Фаленопсис Муса</a> Пінк доданий у ваш <a href="/basket" class="underline">кошик</a>
              </div>
              <ul class="cart-items-list">
                <li class="cart-item">
                  <div class="cart-item__image">
                    <a href="">
                      <img src="/img/sevices/landscaping-artificial-plants.png" alt="">
                    </a>
                  </div>
                  <div class="cart-item__details">
                    <button class="cart-item__remove">
                      <svg class="icon icon-trash"/>
                    </button>
                    <h3>
                      <a href="">Орхідея Фаленопсис Муса Пінк</a>
                    </h3>
                    <div class="cart-item__details_options">Ø 10, висота 45 см</div>
                    <div class="cart-item__details_controls">
                      <div class="counter-input">
                        <button>
                          <img src="/img/icons/icon-minus.svg" alt="Видалити один товар"/>
                        </button>
                        <input type="number" value="1" min="1"/>
                        <button>
                          <img src="/img/icons/icon-plus.svg" alt="Додати один товар"/>
                        </button>
                      </div>
                      <div class="cart-item__details_price">450 ₴</div>
                    </div>
                  </div>
                </li>
                <li class="cart-item">
                  <div class="cart-item__image">
                    <a href="">
                      <img src="/img/sevices/plant-transplantation.png" alt="">
                    </a>
                  </div>
                  <div class="cart-item__details">
                    <button class="cart-item__remove">
                      <svg class="icon icon-trash"/>
                    </button>
                    <h3>
                      <a href="">Орхідея Фаленопсис Муса Пінк</a>
                    </h3>
                    <div class="cart-item__details_options">Ø 10, висота 45 см</div>
                    <div class="cart-item__details_controls">
                      <div class="counter-input">
                        <button>
                          <img src="/img/icons/icon-minus.svg" alt="Видалити один товар"/>
                        </button>
                        <input type="number" value="1" min="1"/>
                        <button>
                          <img src="/img/icons/icon-plus.svg" alt="Додати один товар"/>
                        </button>
                      </div>
                      <div class="cart-item__details_price">450 ₴</div>
                    </div>
                  </div>
                </li>
              </ul>
              <div class="cart-modal__footer">
                <button class="cart-modal__footer_continue underline" data-event="click" data-callback="closeModal">Продовжити покупки</button>
                <div class="cart-modal__footer_total">Разом: <b>900 ₴</b>
                </div>
                <a href="/basket" class="button button--small button--primary">Оформити замовлення</a>
              </div>
            </sl-dialog>
            <!-- End Cart modal -->

            <!-- Start Sign in modal -->
            <sl-dialog id="sign-in-modal" label="Вхід" class="login-modal">
              <form class="login-modal__form">
                <div class="form-control">

                  <label for="phone">Ваш телефон</label>
                  <input id="phone" data-tel-input type="tel">
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
                <p>Вітаємо! Ви успішно зареєструвались. Тепер Ви можете користуватись Вашим кабінетом і здійснювати замовлення</p>
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
    <div class="header__catalog container" id="catalog-menu">

      <!-- Основна кнопка каталогу і випадаючий список -->
      <div class="header__catalog--main">
        <button
      id="catalog-button"
      class="catalog-button"
      aria-label="Каталог товарів"
    >
          <svg class="icon icon-menu"/>
      {$LINGVO.catalog}
    </button>
        <!-- Список категорій каталогу -->

        <!-- prettier-ignore -->

        <!-- Dropdown список категорій -->
        <div class="header__catalog_list">
          <div class="header__catalog_list-wrapper">

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

            <!-- Контент категорій - права частина -->
            <div class="category-content">
              <!-- prettier-ignore -->
              <!-- Контент категорії "Кімнатні рослини" для меню каталогу -->
        {foreach item=C name=C key=I from=$CATEGORY_LEFT}
        <section class="category-content__item" data-category="{$C.alias}">
                <ul class="category-content__item-list">
            {foreach item=CC name=CC from=$C.category}
            <li>
                    <a href="{$LANGURL}/{$C.alias}/{$CC.cur_alias}/">
                      <img src="/img/category/{$CC.cur_alias}.png" alt="{$CC.name}"/>
                      <span>{$CC.name}</span>
                    </a>
                  </li>
            {/foreach}
          </ul>
                <ul class="category-content__item-related">
                  <li>
                    <a class="underline" href="{$LANG_URL}/gift-card/">{$LINGVO.gift_card}</a>
                  </li>
                  <li>
                    <a class="underline" href="{$LANG_URL}/services/peregorodki-iz-rasteniy/">{$LINGVO.peregorodki_iz_rasteniy}</a>
                  </li>
                </ul>
              </section>
        {/foreach}
    </div>
          </div>
        </div>
      </div>

      <!-- Додаткові категорії: фітодизайн, вертикальне озеленення, флораріуми -->
      <ul class="header__catalog--secondary">
        <li class="secondary-item">
          <button class="secondary-item--button" aria-label="Фітодизайн">
            <svg class="icon icon-fitodesign"/>
            <div class="secondary-item--button-text">
              <b>Фітодизайн</b>
              <span>Озеленення простору</span>
            </div>
          </button>
          <section class="secondary-item--content">
            <ul class="secondary-item--content-list">
              <li>
                <img
              src="/img/sevices/apartment-phytodesign.png"
              alt="Фітодизайн квартири"
/>
                <a class="underline" href="">Фітодизайн квартири</a>
              </li>
              <li>
                <img
              src="/img/sevices/office-phytodesign.png"
              alt="Фітодизайн офісу"
/>
                <a class="underline" href="">Фітодизайн офісу</a>
              </li>
              <li>
                <img
              src="/img/sevices/landscaping-of-summer-terraces.png"
              alt="Фітодизайн квартири"
/>
                <a class="underline" href="">Озеленення літніх терас</a>
              </li>
              <li>
                <img
              src="/img/sevices/zoning-space-with-indoor-plants.png"
              alt="Зонування простору кімнатними рослинами"
/>
                <a class="underline" href=""
              >Зонування простору кімнатними рослинами</a
            >
              </li>
              <li>
                <img
              src="/img/sevices/plant-rental.png"
              alt="Зелені рішення для HoReCa"
/>
                <a class="underline" href="">Зелені рішення для HoReCa</a>
              </li>
              <li>
                <img
              src="/img/sevices/landscaping-artificial-plants.png"
              alt="Озеленення штучними рослинами"
/>
                <a class="underline" href="">Озеленення штучними рослинами</a>
              </li>
            </ul>
          </section>
        </li>
        <li class="secondary-item">
          <button
        class="secondary-item--button"
        aria-label="Вертикальне озеленення"
      >
            <svg class="icon icon-vertical"/>
            <div class="secondary-item--button-text">
              <b>Вертикальне озеленення</b>
              <span>Зелені стіни</span>
            </div>
          </button>
          <section class="secondary-item--content">
            <ul class="secondary-item--content-list">
              <li>
                <img
              src="/img/sevices/green-walls.png"
              alt="Зелені стіни з рослинами"
/>
                <a class="underline" href="">Зелені стіни з рослинами</a>
              </li>
              <li>
                <img
              src="/img/sevices/landscaping-using-vertical-structures.png"
              alt="Озеленення за допомогою
вертикальних конструкцій"
/>
                <a class="underline" href=""
              >Озеленення за допомогою
вертикальних конструкцій</a
            >
              </li>
              <li>
                <img
              src="/img/sevices/green-moss-walls.png"
              alt="Зелені стіни з моху"
/>
                <a class="underline" href="">Зелені стіни з моху</a>
              </li>
            </ul>
          </section>
        </li>
        <li class="secondary-item">
          <button class="secondary-item--button" aria-label="Догляд за рослинами">
            <svg class="icon icon-care"/>
            <div class="secondary-item--button-text">
              <b>Догляд</b>
              <span>За рослинами</span>
            </div>
          </button>
          <section class="secondary-item--content">
            <ul class="secondary-item--content-list">
              <li>
                <img
              src="/img/sevices/plant-transplantation.png"
              alt="Пересадка рослин"
/>
                <a class="underline" href="">Пересадка рослин</a>
              </li>
              <li>
                <img
              src="/img/sevices/plant-transportation.png"
              alt="Перевезення рослин"
/>
                <a class="underline" href="">Перевезення рослин</a>
              </li>
              <li>
                <img src="/img/sevices/plant-rental.png" alt="Оренда рослин"/>
                <a class="underline" href="">Оренда рослин</a>
              </li>
            </ul>
          </section>
        </li>
        <li class="secondary-item">
          <button class="secondary-item--button" aria-label="Галерея фотографій">
            <svg class="icon icon-photogallery"/>
            <div class="secondary-item--button-text">
              <b>Портфоліо</b>
              <span>Галерея фотографій</span>
            </div>
          </button>
        </li>
      </ul>
    </div>

    <!-- Основний контент сторінки -->
	{if $URL[0]==''}
		{include file="$CONTENT_TPL"}
	{else}
		<main class="catalog-page">
      <div class="container">
        <!-- Sidebar navigation - категорії каталогу -->
        <div class="catalog-page__grid">
      			
      				{include file="$LEFT_TPL"}
	      			<div class="catalog-page__content">
	              {if $URL[0]!=''}
			          <!-- Breadcrumbs -->
            <sl-breadcrumb itemscope itemtype="http://schema.org/BreadcrumbList">
			            {foreach item=H name=H from=$HLEB}
			            {if $smarty.foreach.H.iteration==1}
			            <sl-breadcrumb-item href="{if $LANGURL=='/ua'}/{else}/ru/{/if}" itemprop="item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                <span itemprop="name">{$LINGVO.main_page}</span></sl-breadcrumb-item>
			            {elseif $H.link!=''}{** not last item **}
			            <sl-breadcrumb-item href="{$LANGURL}{$H.link}" itemprop="item">
                <span itemprop="name">{$H.name}</span></sl-breadcrumb-item>
              <meta itemprop="position" content="{$smarty.foreach.H.iteration}">
			            {else}{** last item without arrows **}
			            <sl-breadcrumb-item href="{$smarty.server.REQUEST_URI}" itemprop="item">
                <span itemprop="name">{$H.name}</span></sl-breadcrumb-item>
              <meta itemprop="position" content="{$smarty.foreach.H.iteration}">
			            {/if}
			            {/foreach}
			          </sl-breadcrumb>
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
        <div
      style="--swiper-navigation-color: #fff"
      class="swiper photo-viewer__main-swiper"
    >
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img
            src="https://floren.com.ua/images/gallery/b/ozelenenie-office-kiev-212.jpg"
/>
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
              <img
            src="https://floren.com.ua/images/gallery/b/ozelenenie-office-kiev-212.jpg"
/>
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
          <div class="footer__catalog-top">
            <span>ТОП Категорії</span>
            <a href="">ТОП Тегі</a>
            <a href="">Міста</a>
            <a href="">FAQ</a>
            <a href="">Пропозиції</a>
          </div>
          <ul class="footer__catalog-list">
            <li>
              <a href="">Лавровое дерево в горшке</a>
              <a href="">Комнатное растение мирт</a>
              <a href="">Пальма комнатная хамедорея</a>
              <a href="">Горшок керамический</a>
              <a href="">Драцена golden</a>
              <a href="">Пальма цветы</a>
              <a href="">Маранта вазон</a>
              <a href="">Кактусы маленькие</a>
            </li>
            <li>
              <a href="">Растение денежное дерево</a>
              <a href="">Домашний вьющийся цветок</a>
              <a href="">Кипарис декоративный</a>
              <a href="">Горшок с автополивом лечуза</a>
              <a href="">Горшки для цветов из бетона</a>
              <a href="">Орхидеи в стеклянной вазе</a>
              <a href="">Лимон декоративный</a>
              <a href="">Пальмы домашние</a>
            </li>
            <li>
              <a href="">Сансевиерия голден ханни</a>
              <a href="">Комнатные растения фикус</a>
              <a href="">Замиокулькас цветок</a>
              <a href="">Фикус наташа</a>
              <a href="">Перегородки из живых растений</a>
              <a href="">Купить аглаонемы</a>
              <a href="">Аглаонема цена</a>
              <a href="">Алоказия цена</a>
            </li>
            <li>
              <a href="">Цветущие растения</a>
              <a href="">Бокарнея нолина</a>
              <a href="">Комнатная азалия</a>
              <a href="">Горшки с автополивом</a>
              <a href="">Хвойные деревья</a>
              <a href="">Lechuza вазоны</a>
              <a href="">Банан домашний</a>
              <a href="">Лавровый лист</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Основна частина footer з логотипом, меню, контактами -->
      <div class="footer__body">
        <div class="container">
          <img
        class="footer__body-bg footer__body-bg-1"
        src="/img/palm.svg"
        alt="background"
/>
          <img
        class="footer__body-bg footer__body-bg-2"
        src="/img/palm.svg"
        alt="background"
/>
          <img
        class="footer__body-bg footer__body-bg-3"
        src="/img/palm.svg"
        alt="background"
/>
          <img
        class="footer__body-bg footer__body-bg-4"
        src="/img/leaf.svg"
        alt="background"
/>
          <img
        class="footer__body-bg footer__body-bg-5"
        src="/img/leaf.svg"
        alt="background"
/>
          <img
        class="footer__body-bg footer__body-bg-6"
        src="/img/leaf.svg"
        alt="background"
/>

          <div class="footer__body-grid">
            <section>
              <a
            href="/"
            class="footer__body-logo"
            aria-label="Флорен - студія фітодизайну"
          >
                <img src="/img/footer-logo.png" alt="Флорен - студія фітодизайну"/>
              </a>
            </section>
            <section>
              <h3>Інформація</h3>
              <ul class="footer__body-list">
                <li>
                  <a href="">Про компанію</a>
                </li>
                <li>
                  <a href="">Повернення товарів</a>
                </li>
                <li>
                  <a href="">Співпраця</a>
                </li>
                <li>
                  <a href="">Контакти </a>
                </li>
                <li>
                  <a href="">Мапа сайту</a>
                </li>
              </ul>
            </section>
            <section>
              <h3>Товари та сервіси</h3>
              <ul class="footer__body-list">
                <li>
                  <a href="">Фітодизайн</a>
                </li>
                <li>
                  <a href="">Вертикальне озеленення</a>
                </li>
                <li>
                  <a href="">Ландшафтний дизайн</a>
                </li>
                <li>
                  <a href="">Кімнатні рослини</a>
                </li>
                <li>
                  <a href="">Горщики та Кашпо</a>
                </li>
              </ul>
            </section>
            <section>
              <h3>Контакти</h3>
              <ul class="footer__body-contacts">
                <li>
                  <p class="contacts-street">
                    <svg class="icon icon-location"/>
                    <a href="https://goo.gl/maps/UPpaCBkrMd2TWfXq7" target="_blank"
                  >пр. Берестейський, 70</a
                >
                  </p>
                  <p>03113, Київ, Україна</p>
                </li>
                <li class="contacts-phone">
                  <div class="contacts-phone--hidden">
                    <p>
                  (044) 344..
                  <button
                    data-event="click"
                    data-callback="toggleFooterPhones"
                    aria-label="Показати телефон"
                  >
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
                  <a href="">
                    <svg class="icon icon-facebook"/>
                  </a>
                  <a href="">
                    <svg class="icon icon-youtube"/>
                  </a>
                  <a href="">
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
              <span>© 2025 “Флорен”</span>
              <a class="not-underline" href="">Договір оферта</a>
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
    <!-- Головний JS файл -->
  </body>
</html>