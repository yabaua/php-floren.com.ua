<?php
/* Smarty version 5.5.2, created on 2025-10-30 11:50:01
  from 'file:plants.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.2',
  'unifunc' => 'content_690334c9394d35_25953574',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d26031a7d6f4e391af6a55916927f89f1a90236' => 
    array (
      0 => 'plants.tpl',
      1 => 1761817796,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690334c9394d35_25953574 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/MAMP/htdocs/php-floren.com.ua/templates';
?>		<!-- Info показано скільки товарів -->
          <div class="catalog-page__content_showed">
          Показано <span>1 - 25</span> з <span>1230</span>
          </div>

          <!-- Заголовок і опис категорії -->
          <h1><?php echo $_smarty_tpl->getValue('PAGE_TITLE');?>
</h1>
            <?php if ('TOP_SEO_TEXT') {?>
            <div class="catalog-page__content_description">
            <?php echo $_smarty_tpl->getValue('TOP_SEO_TEXT');?>

            </div>
		    <?php }?>
		<!-- Сітка товарів -->
		<!--seoshield_formulas--kategorii-->
          <div class="catalog-page__content_products">
            
            <!--isset_listing_page-->
		    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('PROMO'), 'P');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('P')->value) {
$foreach0DoElse = false;
?>
            <!-- Product Card Start-->
            <!--product_in_listingEX-->
			<!--dg_prod_in_lisintg_href:<?php echo $_smarty_tpl->getValue('LANGURL');?>
/product/<?php echo $_smarty_tpl->getValue('P')['ID'];?>
_<?php echo $_smarty_tpl->getValue('P')['link'];?>
/;;dg_prod_in_lisintg_anchor:<?php echo $_smarty_tpl->getValue('P')['name'];?>
-->
            <div class="catalog-page__content_product-card">
              <div class="product-card__wrapper">
                <div class="product-card__image">
                  <a href="<?php echo $_smarty_tpl->getValue('P')['product_path'];?>
">
                    <img src="<?php echo $_smarty_tpl->getValue('P')['img_path'];?>
" alt="Фото <?php echo $_smarty_tpl->getValue('P')['name'];?>
"/>
                  </a>
                </div>
                <div class="product-card__name">
                  <a href="<?php echo $_smarty_tpl->getValue('P')['product_path'];?>
"><?php echo $_smarty_tpl->getValue('P')['name'];?>
</a>
                </div>
                <?php if ($_smarty_tpl->getValue('P')['not_available'] === 0) {?>
                <div class="product-card__price">
                <?php echo $_smarty_tpl->getValue('P')['min_price'];?>
 ₴
                    <?php if ($_smarty_tpl->getValue('P')['min_price'] != $_smarty_tpl->getValue('P')['max_price']) {?>
                    – <?php echo $_smarty_tpl->getValue('P')['max_price'];?>
 ₴
                    <?php }?>                                </div>

                <div class="product-card__options">
                  <section>
                    <h5><?php echo $_smarty_tpl->getValue('LINGVO')['varianty'];?>
:</h5>
                    <ul>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('P')['forms'], 'F');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('F')->value) {
$foreach1DoElse = false;
?>
                      <li><?php if ($_smarty_tpl->getValue('F')['dia']) {?>&#216; <?php echo $_smarty_tpl->getValue('F')['dia'];?>
 <?php }?>
    						<?php if ($_smarty_tpl->getValue('F')['wdt']) {
echo $_smarty_tpl->getValue('F')['wdt'];?>
 
    						<?php if ($_smarty_tpl->getValue('F')['depth']) {?>x <?php echo $_smarty_tpl->getValue('F')['depth'];?>
 <?php }
}?>
    						<?php if ($_smarty_tpl->getValue('F')['hgt']) {?>x <?php echo $_smarty_tpl->getValue('F')['hgt'];
}?>
    						<?php if ($_smarty_tpl->getValue('F')['measure_qt']) {
echo $_smarty_tpl->getValue('F')['measure_qt'];?>
 <?php echo $_smarty_tpl->getValue('F')['unit'];
}?></li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </ul>
                  </section>
                  <?php if ($_smarty_tpl->getValue('P')['colors']) {?>
                  <section>
                    <h5><?php echo $_smarty_tpl->getValue('LINGVO')['colors'];?>
:</h5>
                    <div class="colors-list">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('P')['colors'], 'FC');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('FC')->value) {
$foreach2DoElse = false;
?>
                                                    <span style="background: url('<?php echo $_smarty_tpl->getValue('FC')['image'];?>
');" title="Фото <?php echo $_smarty_tpl->getValue('FC')['name_ru'];?>
"></span>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

                    </div>
                  </section>
                  <?php }?>                 </div>
                <?php } elseif ($_smarty_tpl->getValue('P')['preorder'] == 1 && $_smarty_tpl->getValue('P')['act'] == 'Y') {?>
					<div class="product-card__custom-order"><?php echo $_smarty_tpl->getValue('LINGVO')['good_preorder'];?>
</div>
				<?php } else { ?>
					<div class="product-card__custom-order"><?php echo $_smarty_tpl->getValue('LINGVO')['not_available'];?>
</div>
				<?php }?>
              </div>
            </div>
            <!-- Product Card End -->
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
              
            
          </div>

          <!-- Кнопка "Показати ще" -->
          <div class="catalog-page__content_more">
            <button class="button button--primary button--pill">Показати ще 24 товара</button>
          </div>

          <!-- Pagination -->
          <div class="pagination">
            <a href="" class="pagination__link disabled">
              <img src="/img/icons/icon-arrow-left-long.svg.svg" alt="Попередня сторінка">
            </a>
            <a href="" class="pagination__link active">1</a>
            <a href="" class="pagination__link">2</a>
            <a href="" class="pagination__link">3</a>
            <a href="" class="pagination__link">4</a>
            <a href="" class="pagination__link">5</a>
            <a href="" class="pagination__link">
              <img src="/img/icons/icon-arrow-right-long.svg" alt="Наступна сторінка">
            </a>
          </div>

          <!-- SEO article section -->
          <article class="catalog-page__content_article">
            <section class="article-section">
              <h3 class="article-section__title">Кімнатні рослини для затишку та гармонії</h3>
              <div class="article-section__content">
                <p>
                Мрієте про живий куточок у своїй квартирі чи офісі? Ви у правильному місці! У студії фітодизайну «Флорен» ми зібрали рослини голландської селекції, які прикрасять ваш дім або офіс. Кімнатні рослини — не просто зелень у горщику. Це спосіб створити затишок, підняти настрій і навіть покращити якість повітря у приміщенні. Квіти додають життя, очищають повітря та допомагають зменшити рівень стресу.                
              </p>
                <p>Для озеленення приміщення ми пропонуємо купити кімнатні рослини найдекоративніші, корисні, водночас унікальні, які здивують і колекціонерів.</p>
                <h4>Декоративні кімнатні рослини: вибір із характером</h4>
                <p>Серед наявних у нас можна вибрати квітучі види, кактуси, деревоподібні пальми, фікуси тощо. Кожна рослина має свій темперамент. Допоможемо вам вибрати ту, яка наповнить фарбами ваше життя.</p>
                <ol>
                  <li>Листяні вирізняються декоративною формою, кольорами та текстурою. Попри незвичайний, часто екзотичний вигляд, ця група рослин невибаглива. Фікус, папороті, філодендрон найчастіше використовують і новачки, й фітодизайнери для створення зелених акцентів.</li>
                  <li>Хочете барв? Вибирайте <a href="">вазони квітучі</a>! Бегонія з бархатистими квітками оживить інтер'єр. Антуріум розквітне навіть за мінімального догляду. Зауважимо: непримхлива гузманія обдарує цвітінням навіть неуважного господаря.</li>
                  <li>Любите «мінімалізм»? Чарівне алое, як і екзотична хавортія, – це сучасний декор і природний «антистрес». Вони не образяться, якщо ви забудете їх полити.</li>
                  <li>Химерна зелень тропічних рослин якісно збагачує киснем повітря і офісного, і домашнього приміщення. Уявіть, як розкішні листки монстери перетворюють куточок кімнати на маленькі джунглі – і все це без складного догляду!</li>
                  <li>Плющ, як і сланка хоя з довгими стеблами підходять для підвісних кошиків. Вічнозелені ліани для вертикального озеленення зберігають декоративність навіть у спартанських умовах.</li>
                </ol>
              </div>

            </section>
            <section class="article-section">
              <h3 class="article-section__title">Кімнатні рослини для дому і офісу</h3>
              <div class="article-section__content">
                <p>Чому варто купити кімнатні квіти у нас? Задумувалися, чому всі так люблять озеленювати будинки та офіси? Ось лише кілька причин, щоб вибрати у нас горщикові рослини й купити вазони кімнатні:</p>
                <ul>
                  <li>
                    <b>Очищення повітря.</b> Бажаєте освіжити приміщення? Варто купити кімнатну рослину сансевієрію чи хлорофітум. Вчені довели: вони знижують рівень токсинів і покращують якість життя.</li>
                  <li>
                    <b>Зниження рівня стресу.</b>Психологи переконують: кімнатні вазони мають терапевтичний ефект, оскільки зменшують тривожність і наповнюють гармонією.</li>
                  <li>
                    <b>Естетика.</b> Відчуваєте нестачу затишку? Уявіть, як монстера, королева джунглів, перетворює ваш куточок на зелено-розкішну оазу. Вазони квітучої орхідеї в сучасному дизайні – вишуканий шарм.</li>
                </ul>
                <h4>Які кімнатні квіти купити?</h4>
                <p>Не знаєте, що вибрати для вашого дизайну? Ось кілька ідей:</p>
                <ul>
                  <li>
                    <b>для спальні:</b> затишок подарують лаванда або спатифілум. Домашні вазони, живі квіти корисно тримати біля ліжка для гарного сну. Сприяють очищенню повітря та створюють спокійну атмосферу;</li>
                  <li>
                    <b>вазони кімнатні для офісу:</b> заміокулькас зробить кабінетний простір затишним. Навіть якщо у вас немає часу, сансевієрія залишиться вірним другом — її навіть поливати раз на два тижні забагато. Фінікові, пальми й благородні драцени – не тільки найдекоративніші живі вазони для офісу, а й флористичний декор;</li>
                  <li>
                    <b>для кухні:</b> хлорофітум або м’ята — функціональні та невибагливі. Хлорофітум поглинає токсини з повітря, а м’ята порадує ароматом.
                </li>
                </ul>
                <h4>Кому і на які свята можна дарувати квіти в горщиках?</h4>
                <p>Дарувати кімнатні квіти — це завжди чудова ідея! Уявіть, як подруга чи колега розпаковує подарунок і бачить вазон з квітучою бегонією або елегантною орхідеєю. Ідеально на дні народження, новосілля або навіть як вдячність. </p>
                <p>На сайті представлений каталог кімнатних рослин, де ви можете підібрати рослину для умов у вашому домі. </p>
              </div>

            </section>
            <section class="article-section">
              <h3 class="article-section__title">Як доглядати за живими вазонами?</h3>
              <div class="article-section__content">
                <div class="grid">
                  <div>
                    <p>Багато хто думає, що догляд за кімнатними рослинами – це складно. Насправді все простіше, ніж здається! Поділимося з вами <a href="">секретами успішного вирощування</a>:</p>
                    <ul>
                      <li>поливайте помірно: квіти у вазоні не люблять застою води;</li>
                      <li>
                      забезпечте освітлення: наприклад, фікусам потрібне розсіяне світло. Вазон кімнатний із сукулентом добре почувається на сонячному підвіконні;
                    </li>
                      <li>не забувайте удобрювати: навесні та влітку квітучі й декоративно-листяні потребують додаткового підживлення.</li>
                    </ul>
                    <p>Рослини – це маленькі джунглі, які ми приручили, щоб вони шепотіли нам про природу, коли за вікном шелестить бетонний ліс. Розглянемо, наскільки складно вирощувати вазони кімнатні та що потрібно для догляду.</p>
                  </div>
                  <div class="swiper article-swiper" data-swiper="delivery-swiper">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <img src="/img/delivery-1.jpg"/>
                        <span>Доставка кімнатних рослин в зимовий період</span>
                      </div>
                      <div class="swiper-slide">
                        <img src="/img/delivery-2.jpg"/>
                        <span>Магазин рослин – доставка по Києву</span>
                      </div>
                      <div class="swiper-slide">
                        <img src="/img/delivery-3.jpg"/>
                        <span>Доставка кімнатних рослин</span>
                      </div>
                    </div>
                    <div class="swiper-button swiper-button--next">
                      <img src="/img/icons/icon-arrow-angle-right.svg" alt="">
                    </div>
                    <div class="swiper-button swiper-button--prev">
                      <img src="/img/icons/icon-arrow-angle-left.svg" alt="">
                    </div>
                  </div>
                </div>
                <div class="article-section__table">
                  <div class="article-section__table-title">Таблиця догляду за кімнатними рослинами</div>
                  <table>
                    <thead>
                      <tr>
                        <th>Рослина</th>
                        <th>Рівень догляду</th>
                        <th>Освітлення</th>
                        <th>Особливості</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Монстера делікатесна</td>
                        <td>Середній</td>
                        <td>Яскраве, розсіяне</td>
                        <td>Тропічний акцент, велике листя</td>
                      </tr>
                      <tr>
                        <td>Фікус Бенджаміна</td>
                        <td>Легкий</td>
                        <td>Розсіяне, півтінь</td>
                        <td>Класика для офісів і квартир</td>
                      </tr>
                      <tr>
                        <td>Сансевієрія</td>
                        <td>Дуже легкий</td>
                        <td>Тінь або сонячне</td>
                        <td>Очищає повітря, «рослина для лінивих»</td>
                      </tr>
                      <tr>
                        <td>Алоказія Поллі</td>
                        <td>Середній</td>
                        <td>Яскраве, розсіяне</td>
                        <td>Екзотичний вигляд, потребує зволоження</td>
                      </tr>
                      <tr>
                        <td>Пеперомія</td>
                        <td>Легкий</td>
                        <td>М'яке, рівномірне</td>
                        <td>Компактна, яскраве забарвлення</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>
              <section class="article-section">
                <h3 class="article-section__title">Кімнатні рослини купити в інтернет-магазині в Києві: відкрийте для себе фітостудію «Флорен»</h3>
                <div class="article-section__content">
                  <p>Чи думали ви, як багато можна змінити, якщо вазони кімнатні купити для дому чи офісу? Хочете знайти ідеальні здорові рослини з провідних європейських теплиць? Тоді студія фітодизайну «Флорен» — саме те, що вам потрібно.</p>
                  <h4>Чому саме ми?</h4>
                  <p>А тому, що ми розуміємо ваші потреби й пропонуємо як онлайн-шопінг, так і вибір декоративних рослин у салоні квітів «Флорен» у Києві, проспект Берестейський, 70. Хоч який спосіб виберете, у нас гарантовано зможете купити кімнатні вазони й отримаєте переваги:</p>
                  <ol class="bold-numbers">
                    <li>
                      <b>Зручність.</b> Залишайтеся вдома й вибирайте рослини на нашому сайті. Або ж завітайте до магазину квітів.</li>
                    <li>
                      <b>Експертні поради.</b>  Не впевнені, яка рослина для вашого інтер'єру? Наші консультанти у салоні чи телефоном порадять, підберуть найкращі, враховуючи освітлення, вологість, стиль вашого простору.</li>
                    <li>
                      <b>Швидке отримання.</b>  Не витрачайте час на пошук транспорту. Ми дбайливо запаковуємо рослини. Одержите їх у Києві, області, по всій Україні. Гарантуємо: кожен листочок залишиться цілим і здоровим.</li>
                    <li>
                      <b>Доступні ціни без шкоди для якості.</b> У нас високоякісні декоративні культури європейського постачальника за доступною ціною. Нам важливо, щоб голландські квіти дарували радість і не порушували ваш бюджет.</li>
                    <li>
                      <b>Гарантія задоволення.</b> Ми впевнені: рослина від нас стане і декоративним елементом, і справжньою прикрасою. Якщо ви не задоволені покупкою, ми завжди знайдемо рішення!</li>
                  </ol>
                  <h4>Наша доставка – комфорт для покупця</h4>
                  <p>Ми подбали про всі деталі. Товар доставимо в спеціально обладнаній машині. Ба більше, навіть взимку не варто турбуватися за стан квітів, живі вазони захистить від холоду тепле авто.</p>
                  <ul>
                    <li>Кур'єр привезе квіти в вазоні з магазину, якщо сума замовлення перевищує 1000,00 грн.</li>
                    <li>Нова Пошта – наш логістичний партнер для безпечної доставки по всій Україні.</li>
                  </ul>
                  <p>Також ми піднімемо на поверх і розмістимо вазони в офісі, що значно полегшує життя вам і співробітникам.</p>
                  <p>
                    <b>Ваша рослина вже чекає на вас. Купити декоративні кімнатні квіти у фітостудії «Флорен» – це не тільки інвестиція в красу, а й піклування про здоров'я.</b>
                  </p>
                </div>
              </section>

            </article><?php }
}
