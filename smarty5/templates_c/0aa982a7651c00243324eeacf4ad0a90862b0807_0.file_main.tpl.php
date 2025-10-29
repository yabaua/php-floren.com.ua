<?php
/* Smarty version 5.5.2, created on 2025-10-29 12:20:49
  from 'file:main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_6901ea813cdaf8_71771073',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0aa982a7651c00243324eeacf4ad0a90862b0807' => 
    array (
      0 => 'main.tpl',
      1 => 1761733241,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6901ea813cdaf8_71771073 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/php-floren.com.ua/templates';
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Головна сторінка</title>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;600;900&display=swap"
      rel="stylesheet"
    /> -->
    <!-- <link rel="stylesheet" href="../styles/style.css" /> -->
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/modulepreload-polyfill-COaX8i6R.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_swipers-W78pJMEt.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_shoelace-93ZMtKYV.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_events-B9TtzH4c.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_scroll-qwBtBhbR.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_catalog-64HryAnt.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_clickOutside-BYa46nKa.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/_expandableText-Bi2QDYtX.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" crossorigin src="/assets/js/main-DDObV7Ms.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" crossorigin href="/assets/css/main-8pNQGu6Z.css">
    <link rel="stylesheet" crossorigin href="/assets/css/index-DOaU0IMu.css">
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
              ><?php echo $_smarty_tpl->getValue('LINGVO')['kiev_addr'];?>
</a
            >
            <p><?php echo $_smarty_tpl->getValue('LINGVO')['opening_hours'];?>
:</p>
            <p><?php echo $_smarty_tpl->getValue('LINGVO')['opening_hours_mo_st'];?>
</p>
            <p><?php echo $_smarty_tpl->getValue('LINGVO')['opening_hours_sn'];?>
</p>
          </div>
        </div>
        <sl-button
          class="header__nav-location--button"
          data-event="click"
          data-callback="toggleLocation"
        >
          <svg class="icon icon-location"/>
          <?php echo $_smarty_tpl->getValue('LINGVO')['kiev_shops'];?>

        </sl-button>
      </sl-tooltip>
      <!-- Location dropdown element end -->

      <!-- Меню навігації -->
      <!-- Navigation menu start -->
      <ul class="header__nav-list">
        <li class="header__nav-item">
          <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/about/" class="header__nav-link"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_about'];?>
</a>
        </li>
        <li class="header__nav-item">
          <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/delivery/" class="header__nav-link"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_delivery'];?>
</a>
        </li>
        <li class="header__nav-item">
          <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/publications/" class="header__nav-link"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_publications'];?>
</a>
        </li>
        <li class="header__nav-item">
          <a href="<?php echo $_smarty_tpl->getValue('LANGURL');?>
/contacts/" class="header__nav-link"><?php echo $_smarty_tpl->getValue('LINGVO')['menu_contacts'];?>
</a>
        </li>
      </ul>
      <!-- Navigation menu end -->

      <!-- Вибір мови -->
      <!-- Language dropdown element start -->
      <div class="header__nav-lang">
        <sl-dropdown class="dropdown">
          <sl-button class="header__nav-lang--button" slot="trigger" caret
            ><?php if ($_smarty_tpl->getValue('LANG') == 'ua') {
echo $_smarty_tpl->getValue('LINGVO')['lang_sign_ua'];
} elseif ($_smarty_tpl->getValue('LANG') == 'ru') {
echo $_smarty_tpl->getValue('LINGVO')['lang_sign_ru'];
}?>
            <svg class="icon icon-down"/>
          </sl-button>
          <sl-menu>
            <sl-menu-item<?php if ($_smarty_tpl->getValue('LANG') == 'ua') {?> data-checked<?php }?> value="ua"><?php echo $_smarty_tpl->getValue('LINGVO')['lang_sign_ua'];?>
</sl-menu-item>
            <sl-divider></sl-divider>
            <sl-menu-item<?php if ($_smarty_tpl->getValue('LANG') == 'ru') {?> data-checked<?php }?> value="ru"><?php echo $_smarty_tpl->getValue('LINGVO')['lang_sign_ru'];?>
</sl-menu-item>
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
              aria-label="<?php echo $_smarty_tpl->getValue('LINGVO')['close_button'];?>
"
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
                <a class="item-feedback" href=""><?php echo $_smarty_tpl->getValue('LINGVO')['callback_general'];?>
</a>
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
            <input class="search-input" type="search" placeholder="<?php echo $_smarty_tpl->getValue('LINGVO')['search_default_txt'];?>
"/>
            <button class="search-button"><?php echo $_smarty_tpl->getValue('LINGVO')['search_button'];?>
</button>
          </div>
        </form>
        <!-- Search form end -->

        <div class="header__main--profile">
          <a href="#" class="icon-button" aria-label="<?php echo $_smarty_tpl->getValue('LINGVO')['cabinet'];?>
">
            <svg class="icon icon-user"/>
          </a>
          <a href="#" class="icon-button" aria-label="<?php echo $_smarty_tpl->getValue('LINGVO')['cabinet_favorites'];?>
">
            <span class="badge warning">10</span>
            <svg class="icon icon-heart"/>
          </a>
          <a href="#" class="icon-button" aria-label="<?php echo $_smarty_tpl->getValue('LINGVO')['korzina'];?>
">
            <span class="badge success">2</span>
            <svg class="icon icon-basket"/>
          </a>
        </div>
      </div>
    </div>

    <!-- Меню каталогу -->
    <!-- Меню каталогу в header -->
<div class="header__catalog">

  <!-- Основна кнопка каталогу і випадаючий список -->
  <div class="header__catalog--main">
    <button
      id="catalog-button"
      class="catalog-button"
      aria-label="Каталог товарів"
    >
      <svg class="icon icon-menu"/>
      Каталог товарів
    </button>
    <!-- Список категорій каталогу -->

<!-- prettier-ignore -->


<!-- Dropdown список категорій -->
<div class="header__catalog_list">
  <div class="header__catalog_list-wrapper">

    <!-- Список категорій - ліва частина -->
    <ul class="category-list">
      <li class="active" data-category="room-plants">
        <a href="">
          <img src="/img/icons/icon-plants-home.svg" alt="Кімнатні рослини"/>
          <span>Кімнатні рослини</span>
        </a>
      </li>
      <li data-category="plant-pots">
        <a href="">
          <img src="/img/icons/icon-pot.svg" alt="Горщики для рослин"/>
          <span>Горщики для рослин</span>
        </a>
      </li>
      <li data-category="accessories">
        <a href="">
          <img
            src="/img/icons/icon-accessories.svg"
            alt="Аксесуари для рослин"
/>
          <span>Аксесуари для рослин</span>
        </a>
      </li>
      <li data-category="exterior-works">
        <a href="">
          <img
            src="/img/icons/icon-exteriror-works.svg"
            alt="Екстер'єрні роботи"
/>
          <span>Екстер'єрні роботи</span>
        </a>
      </li>
      <li data-category="lawn-autowater">
        <a href="">
          <img
            src="/img/icons/icon-lawn-autowater.svg"
            alt="Створення газону і автополив"
/>
          <span>
            Створення газону<br/>
            і автополив</span
          >
        </a>
      </li>
      <li data-category="care-services">
        <a href="">
          <img
            src="/img/icons/icon-care-services.svg"
            alt="Послуги з догляду за ділянкою"
/>
          <span>
            Послуги з догляду<br/>
            за ділянкою</span
          >
        </a>
      </li>
      <li data-category="landscape-design">
        <a href="">
          <img
            src="/img/icons/icon-landschaft-design.svg"
            alt="Ландшафтний дизайн"
/>
          <span>Ландшафтний дизайн</span>
        </a>
      </li>
    </ul>

    <!-- Контент категорій - права частина -->
    <div class="category-content">
      <!-- prettier-ignore -->
      <!-- Контент категорії "Кімнатні рослини" для меню каталогу -->
<section class="category-content__item" data-category="room-plants">
  <ul class="category-content__item-list">
    <li>
      <a href="">
        <img src="/img/category/red-orchid.png" alt="Орхідеї"/>
        <span>Орхідеї</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/zamioculcas.png" alt="Декоративно листяні"/>
        <span>Декоративно листяні</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/palm.png" alt="Пальми"/>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/lemon.png" alt="Цитрусові"/>
        <span>Цитрусові</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/blue-hydrangea.png" alt="Кімнатні рослини"/>
        <span>Квітучі рослини</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/sansevieria.png" alt="Сансевієрія"/>
        <span>Сансевієрія</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/ficus.png" alt="Фікуси"/>
        <span>Фікуси</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/dracena.png" alt="Драцени"/>
        <span>Драцени</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/cactus.png" alt="Кактуси"/>
        <span>Кактуси</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/ivy.png" alt="Виткі та ампельні рослини"/>
        <span>Виткі та ампельні рослини</span>
      </a>
    </li>
    <li>
      <a href="">
        <img src="/img/category/bonsai-tree.png" alt="Бонсай"/>
        <span>Бонсай</span>
      </a>
    </li>

    <li>
      <a href="">
        <img src="/img/category/part-of-the-suculent.png" alt="Сукуленти"/>
        <span>Сукуленти</span>
      </a>
    </li>

    <li>
      <a href="">
        <img src="/img/category/small-ukka.png" alt="Кімнатні рослини"/>
        <span>Юкка</span>
      </a>
    </li>

    <li>
      <a href="">
        <img src="/img/category/surfinia-flower.png" alt="Сезонні рослини"/>
        <span>Сезонні рослини</span>
      </a>
    </li>

    <li>
      <a href="">
        <img src="/img/category/christmas-tree.png" alt="Хвойні"/>
        <span>Хвойні</span>
      </a>
    </li>
  </ul>
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="">Подарункові сертифікати</a>
    </li>
    <li>
      <a class="underline" href="">Розумний сад Click & Grow</a>
    </li>
    <li>
      <a class="underline" href="">Штучні квіти</a>
    </li>
    <li>
      <a class="underline" href="">Перегородки з рослинами</a>
    </li>
    <li>
      <a class="underline" href="">Аксесуари для рослин</a>
    </li>
  </ul>
</section>
      <!-- Контент категорії "Горщики для рослин" для меню каталогу -->
<section class="category-content__item" data-category="plant-pots">
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="/ua/planters/">Усі горщики</a>
    </li>
    <li>
      <a class="underline" href="/ua/planters/ceramic/">Керамічні горщики</a>
    </li>
    <li>
      <a class="underline" href="/ua/planters/lechuza/">Горщики Lechuza</a>
    </li>
    <li>
      <a class="underline" href="/ua/planters/lamela/">Горщики "Lamela"</a>
    </li>
    <li>
      <a class="underline" href="/ua/planters/elho/">Горщики ELHO</a>
    </li>
    <li>
      <a class="underline" href="/ua/planters/wood-planters/"
        >Горщики з дерева</a
      >
    </li>
    <li>
      <a class="underline" href="/ua/planters/metal-pots/">Металеві кашпо</a>
    </li>
    <li>
      <a class="underline" href="/ua/planters/beton/">Горщики з бетону</a>
    </li>
    <li>
      <a class="underline" href="/ua/aksessuary/">Аксесуари для рослин</a>
    </li>
  </ul>
</section>
      
        
        <!-- Універсальний контент категорії для меню каталогу -->
<section class="category-content__item" data-category="accessories">
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="">Lorem ipsum item - Аксесуари для рослин 1</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Аксесуари для рослин 2</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Аксесуари для рослин 3</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Аксесуари для рослин 4</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Аксесуари для рослин 5</a>
    </li>
  </ul>
</section>
      
        
        <!-- Універсальний контент категорії для меню каталогу -->
<section class="category-content__item" data-category="exterior-works">
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="">Lorem ipsum item - Екстер&#39;єрні роботи 1</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Екстер&#39;єрні роботи 2</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Екстер&#39;єрні роботи 3</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Екстер&#39;єрні роботи 4</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Екстер&#39;єрні роботи 5</a>
    </li>
  </ul>
</section>
      
        
        <!-- Універсальний контент категорії для меню каталогу -->
<section class="category-content__item" data-category="lawn-autowater">
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="">Lorem ipsum item - Створення газону і автополив 1</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Створення газону і автополив 2</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Створення газону і автополив 3</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Створення газону і автополив 4</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Створення газону і автополив 5</a>
    </li>
  </ul>
</section>
      
        
        <!-- Універсальний контент категорії для меню каталогу -->
<section class="category-content__item" data-category="care-services">
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="">Lorem ipsum item - Послуги з догляду за ділянкою 1</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Послуги з догляду за ділянкою 2</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Послуги з догляду за ділянкою 3</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Послуги з догляду за ділянкою 4</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Послуги з догляду за ділянкою 5</a>
    </li>
  </ul>
</section>
      
        
        <!-- Універсальний контент категорії для меню каталогу -->
<section class="category-content__item" data-category="landscape-design">
  <ul class="category-content__item-related">
    <li>
      <a class="underline" href="">Lorem ipsum item - Ландшафтний дизайн 1</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Ландшафтний дизайн 2</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Ландшафтний дизайн 3</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Ландшафтний дизайн 4</a>
    </li>
    <li>
      <a class="underline" href="">Lorem ipsum item - Ландшафтний дизайн 5</a>
    </li>
  </ul>
</section>
      
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
  </div>
</header>
    
    <!-- Основний контент сторінки -->
    

  <main class="homepage">
    <!-- Головний слайдер -->
    <div class="container"><!-- Hero swiper на головній сторінці -->
<!-- Slider main container -->
<div class="swiper hero-swiper homepage__hero-swiper" data-swiper="hero-swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide homepage__hero-slide-1">
      <div class="slide-1__content">
        <div class="slide-1__image">
          <img
            src="/img/homepage/hero-swiper-slide-1-1.png"
            alt="Озеленення офісу від студії фітодизайну Флорен"
/>
        </div>
        <div class="slide-1__text">
          <h2>Озеленення офісу від студії фітодизайну Флорен</h2>
          <p>
            Студія фітодизайну "Флорен" представляє повний комплекс послуг із
            озеленення офісів у Києві. У своїй роботі з озеленення інтер'єру
            житлових та комерційних приміщень ми використовуємо різні
            <a class="underline" href="#">кімнатні рослини</a>
            та елементи декору. Робимо безкоштовний виїзд дизайнера, готуємо
            проект озеленення під ключ у найкоротші терміни.
          </p>
          <div class="slide-1__actions">
            <section class="slide-1__action">
              <div class="slide-1__action_link">
                <a href="">
                  <img
                    src="/img/homepage/hero-swiper-slide-1-2.png"
                    alt="Каталог рослин та горщиків"
/>
                </a>
                <a class="underline" href="">Каталог рослин та горщиків</a>
              </div>
              <div class="slide-1__action_description">
                Підберіть рослини та кашпо для озеленення приміщення, а
                фіто-дизайнер проконсультує з питань догляду.
              </div>
            </section>
            <section class="slide-1__action">
              <div class="slide-1__action_link">
                <a href="">
                  <img
                    src="/img/homepage/hero-swiper-slide-1-3.png"
                    alt="Догляд за рослинами"
/>
                </a>
                <a class="underline" href="">Догляд за рослинами</a>
              </div>
              <div class="slide-1__action_description">
                Складно доглядати за рослинами, – ми візьмемо квіти у вашому
                офісі на обслуговування, і вони знову оживуть.
              </div>
            </section>
            <section class="slide-1__action">
              <div class="slide-1__action_link">
                <a href="">
                  <img
                    src="/img/homepage/hero-swiper-slide-1-4.png"
                    alt="Доставка букетів"
/>
                </a>
                <a class="underline" href="">Доставка букетів</a>
              </div>
              <div class="slide-1__action_description">
                Авторські букети та композиції, створені професійними
                флористами, з доставкою по Києву.
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>

    <div class="swiper-slide homepage__hero-slide-2">
      <div class="slide-2__content">
        <h2>Догляд за кімнатними рослинами</h2>

        <p>
          З досвіду нашої компанії, 4 з 10 рослин гинуть протягом місяця після
          покупки.
          <br/>
          Виною усьому:
        </p>
        <ul>
          <li>
            неправильний догляд, який не враховує індивідуальних особливостей;
          </li>
          <li>невчасна діагностика захворювань рослин та лікування;</li>
          <li>недостатній полив чи перелив.</li>
        </ul>
        <p>
          Не варто перекладати відповідальність за догляд за вазонами на
          офіс-менеджера, секретаря чи клінера. Довіртеся професіоналам, щоб
          вкладений в озеленення бюджет не пропав даремно, а рослини тішили вас
          максимально довго.
        </p>
        <a
          class="slide-2__action button button--secondary button--arrow"
          href=""
          >Розрахувати вартість догляду за рослинами</a
        >
      </div>
    </div>

    <div class="swiper-slide homepage__hero-slide-3">
      <div class="slide-2__content">
        <h2>Благоустрій та озеленення території</h2>

        <p>
          Доглянута, гарна присадибна ділянка в Україні вважається ознакою
          благополуччя мешканців будинку. Котедж в оточенні квітів або шелестких
          кронами дерев незмінно привертає увагу, справляє гарне враження.
          Потрібні глибокі пізнання в галузі ландшафтного дизайну, що охоплюють
          правила розміщення, висадки рослин з урахуванням їх сполучуваності, а
          також здатності витримувати мінливі погодні умови Києва. У студії
          ландшафтного дизайну «Флорен» працюють фахівці, що заслужили відмінну
          репутацію за період багаторічного проектування та озеленення міських
          територій.
        </p>

        <a
          class="slide-2__action button button--secondary button--arrow"
          href=""
          >Розрахувати вартість догляду за рослинами</a
        >
      </div>
    </div>
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <button class="swiper-button swiper-button--prev">
    <img src="/img/icons/icon-arrow-angle-left.svg" alt=""/>
  </button>
  <button class="swiper-button swiper-button--next">
    <img src="/img/icons/icon-arrow-angle-right.svg" alt=""/>
  </button>
</div></div>
    
    <!-- Секція озеленення інтер'єру -->
    <!-- prettier-ignore -->
    <!-- Секція "Озеленення інтер'єру" -->
<div class="container homepage__landscaping">
  <img
    class="homepage__landscaping__leaf"
    src="/img/leaf-2.png"
    alt="Озеленення інтер'єру"
/>
  <section class="homepage__landscaping__content">
    <h2>Озеленення інтер'єру</h2>
    <div class="homepage__landscaping__content-text">
      <p>
        Озеленення інтер'єру офісу - це те, що наші фахівці вміють робити "на
        відмінно"! Викличте фітодизайнера професіонала до офісу для
        консультації. Це безкоштовно, а ви заощадите купу часу підбираючи
        продукцію для озеленення офісного інтер'єру квітами.
      </p>
      <p>
        В інтер'єрному озелененні немає поняття "дорого" чи "дешево" щодо
        грошей. Вони є щодо смаку та якості. Коли до вас приходять у гості і
        думають "негарне озеленення офісу" або "як круто тут стало, хоча
        додалися маленькі акценти, вазони".
      </p>
      <p>
        Кожна рослина має ряд корисних властивостей та естетичних якостей. З
        іншого боку, у них є свої недоліки. Наш досвід дозволяє запропонувати
        вам гарні композиції із рослин у горщиках, які зможуть прожити більше
        місяця. У цьому зберегти свою естетичність.
      </p>
    </div>
  </section>
  <section class="services-swiper">
    <div class="swiper" data-swiper="services-swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide services-slide">
          <div class="services-slide__image">
            <img src="/img/homepage/interior-landscaping-1.png" alt=""/>
          </div>

          <div class="services-slide__content">
            <h3>
              <a class="underline" href="">Вертикальне озеленення</a>
            </h3>
            <p>
              Вертикальне озеленення за допомогою зелених стін із рослин або
              стабілізованого моху.
            </p>
          </div>
        </div>
        <div class="swiper-slide services-slide">
          <div class="services-slide__image">
            <img src="/img/homepage/interior-landscaping-2.png" alt=""/>
          </div>

          <div class="services-slide__content">
            <h3>
              <a class="underline" href="">Озеленення літньої тераси</a>
            </h3>
            <p>
              Озеленення літніх майданчиків кафе та відкритих терас сезонними
              яскравими квітами
            </p>
          </div>
        </div>
        <div class="swiper-slide services-slide">
          <div class="services-slide__image">
            <img src="/img/homepage/interior-landscaping-3.png" alt=""/>
          </div>

          <div class="services-slide__content">
            <h3>
              <a class="underline" href="">Оренда рослин</a>
            </h3>
            <p>
              Оренда рослин та декорування виставкових стендів та знімальних
              майданчиків
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- If we need navigation buttons -->
    <button class="swiper-button swiper-button--prev">
      <img src="/img/icons/icon-arrow-angle-left.svg" alt=""/>
    </button>
    <button class="swiper-button swiper-button--next">
      <img src="/img/icons/icon-arrow-angle-right.svg" alt=""/>
    </button>
  </section>
</div>
    
    <!-- Секція проектів озеленення -->
    <!-- Swiper з прикладами проектів озеленення -->
<div class="homepage__projects">
  <div class="container">
    <div class="projects-swiper">
      <h2>Приклади проектів по озелененню</h2>
      <div class="swiper" data-swiper="projects-swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <!-- Slide 1 -->
          <div class="swiper-slide projects-slide">
            <div
              class="hover-photo-viewer"
              data-photo-viewer="project-photo-viewer"
            >
              <div class="hover-photo-viewer__main">
                <img src="/img/homepage/ozelenenie-restorana-7.jpg" alt=""/>
              </div>
              <ul class="hover-photo-viewer__thumbs">
                <li class="active">
                  <img src="/img/homepage/ozelenenie-restorana-7.jpg" alt=""/>
                </li>
                <li>
                  <img src="/img/homepage/ozelenenie-restorana-6.jpg" alt=""/>
                </li>
                <li>
                  <img src="/img/homepage/ozelenenie-restorana-5.jpg" alt=""/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-4.jpg"
                    alt=""
/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-3.jpg"
                    alt=""
/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-2.jpg"
                    alt=""
/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-1.jpg"
                    alt=""
/>
                </li>
              </ul>
            </div>
            <div class="projects-slide__info">
              <h3 class="projects-slide__info_title">
                Озеленення інтер'єру офіса Типографії
              </h3>
              <div class="projects-slide__info_text">
                <p>
                  Спільно з архітектурним бюро ми розробили і реалізували проект
                  по озелененню офіса друкарні в центрі Києва. Завдяки
                  нестандартному підходу дизайнерів, сміливості Замовника і
                  професійній доставці, посадці і догляду вийшла дуже цікава та
                  сучасна композиція – вертикальний підвісний сад.
                </p>
                <p>
                  Надзвичайне поєднання тропічного бамбука і металевих підвісних
                  горщиків стало ідеальним доповненням стилю лофт, в якому
                  виконаний інтер'єр друкарні.
                </p>
              </div>
              <div class="projects-slide__info_action">
                <a href="#" class="button button--primary button--pill button--arrow"
                  >Більше прикладів</a
                >
              </div>
            </div>
          </div>
          <!-- /Slide 1 -->

          <!-- Slide 2 -->
          <div class="swiper-slide projects-slide">
            <div
              class="hover-photo-viewer"
              data-photo-viewer="project-photo-viewer"
            >
              <div class="hover-photo-viewer__main">
                <img src="/img/homepage/ozelenenie-restorana-7.jpg" alt=""/>
              </div>
              <ul class="hover-photo-viewer__thumbs">
                <li class="active">
                  <img src="/img/homepage/ozelenenie-restorana-7.jpg" alt=""/>
                </li>
                <li>
                  <img src="/img/homepage/ozelenenie-restorana-6.jpg" alt=""/>
                </li>
                <li>
                  <img src="/img/homepage/ozelenenie-restorana-5.jpg" alt=""/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-4.jpg"
                    alt=""
/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-3.jpg"
                    alt=""
/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-2.jpg"
                    alt=""
/>
                </li>
                <li>
                  <img
                    src="/img/homepage/ozelenenie-office-kiev-1.jpg"
                    alt=""
/>
                </li>
              </ul>
            </div>
            <div class="projects-slide__info">
              <h3 class="projects-slide__info_title">
                Озеленення ресторану у Києві
              </h3>
              <div class="projects-slide__info_text">
                <p>
                  Спільно з архітектурним бюро ми розробили і реалізували проект
                  по озелененню офіса друкарні в центрі Києва. Завдяки
                  нестандартному підходу дизайнерів, сміливості Замовника і
                  професійній доставці, посадці і догляду вийшла дуже цікава та
                  сучасна композиція – вертикальний підвісний сад.
                </p>
                <p>
                  Надзвичайне поєднання тропічного бамбука і металевих підвісних
                  горщиків стало ідеальним доповненням стилю лофт, в якому
                  виконаний інтер'єр друкарні.
                </p>
              </div>
              <div class="projects-slide__info_action">
                <a href="#" class="button button--primary button--pill button--arrow"
                  >Більше прикладів</a
                >
              </div>
            </div>
          </div>
          <!-- /Slide 2 -->
        </div>
      </div>
      <button class="swiper-button swiper-button--prev">
        <img src="/img/icons/icon-arrow-angle-left.svg" alt=""/>
      </button>
      <button class="swiper-button swiper-button--next">
        <img src="/img/icons/icon-arrow-angle-right.svg" alt=""/>
      </button>
    </div>
  </div>
</div>
    
    <!-- Секція останніх робіт -->
    <!-- Swiper з останніми роботами -->
<div class="container last-works">
  <img class="homepage__last-works-leaf-1" src="/img/leaf-3.png" alt="leaf"/>
  <img class="homepage__last-works-leaf-2" src="/img/leaf-4.png" alt="leaf"/>

  <div class="works-swiper">
    <h2>Останні роботи</h2>
    <div class="swiper" data-swiper="works-swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img
              src="/img/homepage/last-work-1.png"
              alt="Озеленення одного з офісів компанії Synexus"
/>
          </div>
          <div class="works-slide__content">
            <a
              class="not-underline"
              href="Озеленення одного з офісів компанії Synexus"
              >Озеленення одного з офісів компанії Synexus</a
            >
            <time> 09 липня 2025 </time>
          </div>
        </div>

        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img src="/img/homepage/last-work-2.png" alt="DV Bank"/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href="">DV Bank</a>
            <time>09 липня 2025</time>
          </div>
        </div>

        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img
              src="/img/homepage/last-work-3.png"
              alt="Озеленення автосалону AWT Баварія"
/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href=""
              >Озеленення автосалону AWT Баварія</a
            >
            <time>09 липня 2025</time>
          </div>
        </div>

        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img
              src="/img/homepage/last-work-4.png"
              alt="ЖК Оболонь Residences"
/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href="">ЖК Оболонь Residences</a>
            <time>09 липня 2025</time>
          </div>
        </div>

        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img src="/img/homepage/last-work-5.png" alt="БЦ Днепр плаза"/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href="">БЦ Днепр плаза</a>
            <time>09 липня 2025</time>
          </div>
        </div>

        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img src="/img/homepage/last-work-5.png" alt="БЦ Днепр плаза"/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href="">БЦ Днепр плаза</a>
            <time>09 липня 2025</time>
          </div>
        </div>
        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img src="/img/homepage/last-work-5.png" alt="БЦ Днепр плаза"/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href="">БЦ Днепр плаза</a>
            <time>09 липня 2025</time>
          </div>
        </div>
        <div class="swiper-slide works-slide">
          <div class="works-slide__image">
            <img src="/img/homepage/last-work-5.png" alt="БЦ Днепр плаза"/>
          </div>
          <div class="works-slide__content">
            <a class="not-underline" href="">БЦ Днепр плаза</a>
            <time>09 липня 2025</time>
          </div>
        </div>
      </div>
    </div>
    <!-- If we need navigation buttons -->
    <button class="swiper-button swiper-button--prev">
      <img src="/img/icons/icon-arrow-angle-left.svg" alt=""/>
    </button>
    <button class="swiper-button swiper-button--next">
      <img src="/img/icons/icon-arrow-angle-right.svg" alt=""/>
    </button>
  </div>
  <div class="last-works_more">
    <button class="button button--primary button--pill">Подивитись ще</button>
  </div>
</div>
    
    <!-- Секція у цифрах -->
    <!-- Секція "Ми в цифрах" - статистика компанії -->
<div class="homepage__numbers">
  <div class="container">
    <h2>Ми в цифрах</h2>
    <ul class="homepage__numbers_list">
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-fitodesign.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>
            <a class="underline" href="">Озеленення інтер'єру</a>
          </h3>
          <p>
            Інтер'єрне озеленення приміщень площею від <b>30м2</b> до зонування
            опенспейсу в <b>1600м2.</b>
          </p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-direction.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>Озеленення інтер'єру</h3>
          <p>
            Більше <b>1.000</b> видів квітів та горщиків в асортименті для
            швидкого озеленення офісу у Києві.
          </p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-stars.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>Ексклюзивні рослини</h3>
          <p>
            Привеземо на замовлення продукцію для озеленення від
            <b>20 см.</b> до <b>5 метрів.</b>
          </p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-indicator.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>Оперативне озеленення</h3>
          <p>
            Озеленюємо офіс у найкоротші терміни від постачання день у день до
            <b>14 днів</b> на замовлення з Голландії
          </p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-track.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>Надійна доставка</h3>
          <p>
            Доставка на спеціально оснащених машинах у будь-яку погоду -
            <b>від -30°C до +30°C.</b>
          </p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-transplantation.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>
            <a class="underline" href="">Пересадка рослин</a>
          </h3>
          <p>Пересаджуємо від <b>300 кімнатних квітів</b> щомісяця.</p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-pot.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>
            <a class="underline" href="">Горщики для рослин</a>
          </h3>
          <p>
            Великий вибір горщиків для рослин, більше <b>300 моделей</b> під
            будь-який інтер'єр.
          </p>
        </div>
      </li>
      <li class="numbers__item">
        <div class="numbers__item_icon">
          <img src="/img/icons/icon-care.svg" alt=""/>
        </div>
        <div class="numbers__item_text">
          <h3>
            <a class="underline" href="">Обслуговування рослин</a>
          </h3>
          <p>
            Доглядаємо більш ніж за <b>1.000 рослинами</b> в різних офісах та
            квартирах, надаючи гарантію
          </p>
        </div>
      </li>
    </ul>
  </div>
</div>
    
    <!-- Слайдер клієнтів -->
    <!-- Swiper з логотипами клієнтів -->
<div class="container">
  <div class="clients-swiper homepage__clients">
    <h2>Наші клієнти</h2>
    <div class="swiper" data-swiper="clients-swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-1.png" alt="client"/>
        </div>
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-2.png" alt="client"/>
        </div>
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-3.png" alt="client"/>
        </div>
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-4.png" alt="client"/>
        </div>
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-5.png" alt="client"/>
        </div>
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-6.png" alt="client"/>
        </div>
        <div class="swiper-slide clients-slide">
          <img src="/img/homepage/client-7.png" alt="client"/>
        </div>
      </div>
    </div>
    <button class="swiper-button swiper-button--prev">
      <img src="/img/icons/icon-arrow-angle-left.svg" alt=""/>
    </button>
    <button class="swiper-button swiper-button--next">
      <img src="/img/icons/icon-arrow-angle-right.svg" alt=""/>
    </button>
  </div>
</div>
    
    <!-- Секція популярних товарів -->
    <!-- Секція популярних товарів зі swiper'ом -->
<div class="container homepage__popular">
  <div class="popular-swiper">
    <h2>Популярні товари</h2>
    <div class="swiper" data-swiper="popular-swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-1.png"
                alt="Озеленення одного з офісів компанії Synexus"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Орхідея Фаленопсис Муса Пінк</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="3"></sl-rating>
        </div>

        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-2.png"
                alt="Озеленення одного з офісів компанії Synexus"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Антуріум</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="5"></sl-rating>
        </div>

        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-3.png"
                alt="Розумний вазон Lechuza Delta"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Розумний вазон Lechuza Delta</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="4"></sl-rating>
        </div>

        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-4.png"
                alt="Розумний вазон Lechuza Delta"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Антуріум</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="4"></sl-rating>
        </div>

        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-5.png"
                alt="Розумний вазон Lechuza Delta"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Заміокулькас</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="4"></sl-rating>
        </div>

        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-4.png"
                alt="Розумний вазон Lechuza Delta"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Антуріум</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="4"></sl-rating>
        </div>

        <div class="swiper-slide popular-slide">
          <div class="popular-slide__image">
            <a href="">
              <img
                src="/img/homepage/product-5.png"
                alt="Розумний вазон Lechuza Delta"
/>
            </a>
          </div>
          <div class="popular-slide__title">
            <a href="">Заміокулькас</a>
          </div>
          <div class="popular-slide__price">114,99 ₴</div>
          <sl-rating label="Rating" readonly value="4"></sl-rating>
        </div>
      </div>
    </div>
    <button class="swiper-button swiper-button--prev">
      <img src="/img/icons/icon-arrow-angle-left.svg" alt=""/>
    </button>
    <button class="swiper-button swiper-button--next">
      <img src="/img/icons/icon-arrow-angle-right.svg" alt=""/>
    </button>
    <div class="homepage__popular_more">
      <button class="button button--primary button--pill button--arrow">До каталогу</button>
    </div>
  </div>
</div>
    
    <!-- Секція порад -->
    <!-- Форма консультації щодо озеленення -->
<div class="homepage__advices">
  <div class="container">
    <div class="homepage__advices_wrapper">
      <div class="homepage__advices_content">
        <h2>Консультація щодо озеленення приміщення</h2>
        <div class="homepage__advices_content--description">
          Озеленення інтер'єру у Києві довірте професіоналам. Залишіть заявку на
          безкоштовний виїзд фітодизайнера або консультацію щодо підбору рослин.
        </div>
        <form>
          <div class="homepage__advices_content--form">
            <sl-input placeholder="Ваше імʼя"></sl-input>
            <sl-input placeholder="Ваш телефон"></sl-input>
            <button class="button button--primary button--pill">Надіслати</button>
          </div>
        </form>
        <div class="homepage__advices_content--call">
          Також звертайтесь за телефонами:
        </div>
        <div class="homepage__advices_content--phones">
          <div class="phones--hidden">
            (044) 344..<button
              data-event="click"
              data-callback="toggleAdvicesPhones"
            >
              показати номери
            </button>
          </div>
          <div class="phones--visible">
            <p>(044) 344-28-95</p>
            <p>(050) 660-52-75</p>
          </div>
          <div class="phones--hours">По буднях з 9:00 до 19:30</div>
        </div>
      </div>
      <div class="homepage__advices_photos">
        <div class="homepage__advices_photos--top">
          <div class="image">
            <img
              src="/img/homepage/consultation-1.png"
              alt="Консультація 1"
/>
          </div>
          <div class="image">
            <img
              src="/img/homepage/consultation-2.png"
              alt="Консультація 2"
/>
          </div>
        </div>
        <div class="homepage__advices_photos--bottom">
          <div class="image">
            <img
              src="/img/homepage/consultation-3.png"
              alt="Консультація 3"
/>
          </div>
          <div class="image">
            <img
              src="/img/homepage/consultation-4.png"
              alt="Консультація 4"
/>
          </div>
          <div class="image">
            <img
              src="/img/homepage/consultation-5.png"
              alt="Консультація 5"
/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
    <!-- Секція інформації -->
    <!-- Секція інформаційних блоків -->
<div class="homepage__information">
  <div class="container">
    <ul class="homepage__information_list">
      <li class="information__item">
        <h3>Інтер'єр офісу - важлива складова іміджу компанії</h3>
        <section class="expandable-text" data-max-chars="300">
          <div class="expandable-text__content">
            <p>
              Приміщення, наповнене різними живими рослинами буквально оживає.
              Правильно підібрані кімнатні квіти підтримують певний стиль
              інтер'єру, формують імідж компанії та створюють сприятливі умови
              для роботи. А крім цього, таке “живе” оформлення інтер'єру залишає
              лише позитивні емоції у відвідувачів та бізнес-партнерів.
            </p>
            <p>
              Озеленення різноманітних приміщень сьогодні перетворилося на
              особливий напрямок мистецтва - фітодизайн. Для того, щоб його
              правильно виконати, необхідно мати великий запас знань про
              кімнатні дерева, чагарники, квіти, знати їх види та особливості
              кожного. В іншому випадку, навіть найкрасивіша зелена композиція
              може незабаром перетворитися на пожухлий ряд зів'ялого листя.
              Розробку проектів озеленення в офісі, послуги фітодизайну
              пропонують різні компанії Києва, але важливо звернутися дійсно до
              команди професіоналів, таких як фітостудія “Флорен”, яка надає
              подібні послуги вже понад 7 років.
            </p>
          </div>
          <button class="btn expandable-text__button">Читати повністю</button>
        </section>
      </li>
      <li class="information__item">
        <h3>Проект благоустрою офісних приміщень живими квітами</h3>
        <section class="expandable-text" data-max-chars="300">
          <div class="expandable-text__content">
            <p>
              Замовити комплексну послугу озеленення рослинами для горщиків
              офісів, території торгових центрів, дахів, а також ландшафтний
              дизайн дачних ділянок можна в Києві у фітостудії “Флорен”, ми
              пропонуємо готове комплексне рішення, ціна якого визначається
              індивідуально, але в будь-якому випадку вона буде доступною для
              вас. Слід розуміти, що сучасний фітодизайн – це не те саме, що
              просто розставити вазони з квітами. Фахівці використовують різні
              прийоми, напрацьовані роками:
            </p>
            <ul>
              <li>
                декоративні композиції, створені з листяних та квітучих рослин у
                вазонах та кашпо;
              </li>
              <li>конструкції, що оснащені спеціальними модулями, кишенями;</li>
              <li>фітокартини, створені за допомогою мохових видів рослин;</li>
              <li>
                використання живих та штучних рослин, які закріплюються на
                вертикальних поверхнях.
              </li>
            </ul>
            <p>
              Як і все живе, озеленення вимагає постійного догляду та створення
              прийнятних умов утримання. Навіть найневибагливіші рослини
              необхідно вчасно поливати, обприскувати і проводити підживлення.
            </p>
            <p>
              Для того, щоб зберегти привабливий вигляд фітомодулів, необхідно
              регулярно обприскувати квіти та видаляти пил із листя.
            </p>
          </div>
          <button class="btn expandable-text__button">Читати повністю</button>
        </section>
      </li>
      <li class="information__item">
        <h3>
          Студія фітодизайну "Флорен" (Київ) - компанія з озеленення, що
          пропонує готові рішення для будь-якого виду приміщень
        </h3>
        <section>
          <p>
            Якщо ви вирішили, що хочете озеленити своє робоче чи домашнє
            приміщення, спеціалісти студії фітодизайну "Флорен" у Києві
            підберуть для вас такі сорти рослин, які ідеально підійдуть саме для
            ваших умов. При цьому обов'язково враховується розмір приміщення,
            його освітленість, температурний режим у різні пори року.
          </p>
          <p>
            Не варто забувати, що навіть невеликий острівець живої зелені
            здатний створити масу переваг – значно покращується стан повітря у
            приміщенні, що позитивно впливає на працездатність та здоров'я
            співробітників. У кожному офісному приміщенні обов'язково є велика
            кількість оргтехніки, що створює несприятливий ефект, який
            нейтралізують живі рослини.
          </p>
          <p>
            У нашій фітостудії ви можете замовити вертикальне озеленення
            приміщення, офісу, квартири, благоустрій дачної ділянки та її
            ландшафтний дизайн, всі ціни лояльні та залежать від обраних сортів
            рослин та готового проекту. Ми пропонуємо європейський рівень
            обслуговування всім клієнтам. Можемо запропонувати готові рішення
            або виконати замовлення відповідно до ваших уподобань.
          </p>
          <p>
            Зв'язатися з нами можна будь-яким зручним для вас способом. Номери
            зв'язку вказані на сайті floren.com.ua. Ми гарантуємо максимально
            ефективний результат у найкоротші терміни.
          </p>
        </section>
      </li>
    </ul>
  </div>
</div>
    
    <!-- Секція рейтингу -->
    <!-- Секція відгуків з Google -->
<div class="homepage__rating">
  <div class="container">
    <div class="homepage__rating_grid">
      <div class="homepage__rating_title">
        <h2>Відгуки про нас</h2>
        <div class="google-logo">
          <img src="/img/google-rating.png" alt="Google"/>
        </div>
      </div>
      <ul class="homepage__rating_list">
        <li class="rating__item">
          <div class="rating__item_text">
            Купувала у даному магазині онлайн гортензію в горщику, загалом 3
            горщика (один замовляли додатково). Дуже ввічливі і відповідальні,
            весь час були за звʼязку. Надали фото всіх квітів зі святковою
            упаковкою. Організували доставку по області і вчасно доставили в
            чудовому вигляді. Дуже були задоволені! Дякую!
          </div>
          <div class="rating__item_author">Ірина</div>
          <sl-rating label="Rating" readonly value="5"></sl-rating>
        </li>
        <li class="rating__item">
          <div class="rating__item_text">
            Купували онлайн у цієї компанії дерево - велику кімнатну рослину.
            Дуже відповідальний продавець. Надали фото різних дерев. Обрали
            рослину за дуже реальну ціну. Продавець організував доставку нашої
            великої рослини у повній безпеці без затримок. Надали інструкцію по
            догляду. Дуже задоволені обслуговуванням та якістю рослини. Дякуємо.
          </div>
          <div class="rating__item_author">Марія Вершініна</div>
          <sl-rating label="Rating" readonly value="5"></sl-rating>
        </li>
        <li class="rating__item">
          <div class="rating__item_text">
            <p>
              Відмінний сервіс і чудова якість рослин! Замовляла фікус лірату –
              і залишилася дуже задоволена! Рослина прийшла швидко, добре
              запакована. Тут же був підібраний горщик і зроблена посадка)) за
              що окрема подяка 🫶🏻
            </p>
            <p>Обов’язково замовлятиму ще, рекомендую магазин</p>
          </div>
          <div class="rating__item_author">Роман Мазурець</div>
          <sl-rating label="Rating" readonly value="5"></sl-rating>
        </li>
      </ul>
    </div>
  </div>
</div>
  </main>

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
          <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
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
          <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
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
    
    <!-- Головний JS файл -->
  </body>
</html>
<?php }
}
