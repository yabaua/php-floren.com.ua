{$SCHEMA_SCRIPT}
<div class="product-page__content_grid">
  <!-- Галерея фото продукту -->
  <!-- Product gallery -->
  <div class="product-page__gallery">
    <div class="hover-photo-viewer" data-photo-viewer="project-photo-viewer">
      <div class="hover-photo-viewer__main">
        <img src="{$MAIN_IMAGE}" alt="{$GOOD_ONE.name_alter} {$GOOD_ONE.name}" title="{$GOOD_ONE.name_alter} {$GOOD_ONE.name}"/>
      </div>
      {if $GOOD_IMAGES}
      <ul class="hover-photo-viewer__thumbs">
        {foreach item=GI name=GI from=$GOOD_IMAGES}
        <li class="active">
          <img src="/images/goods/s/{$GI}" alt="{$GOOD_ONE.name} фото {$smarty.foreach.GI.iteration}"/>
        </li>
        {/foreach}
        {if $G_SIZES|@count > 0}
				  {foreach from=$G_SIZES item=v_size key=v_k}
					{if $v_size.formID==$G_CUR_gfsID && $v_size.video!=''}
        <li>
          <button class="hover-photo-viewer__thumbs_video" data-video-src="https://www.youtube.com/embed/{$v_size.video}">
            <span class="icon icon-video-button"></span>
            <span>{$LINGVO.video}</span>
          </button>
        </li>
          {/if}{** if video exists on this size **}
				  {/foreach}
			  {/if}{** if video exists v principe **}
      </ul>
    {/if}
    </div>
    <a href="" class="product-page__gallery_link">
      <span class="icon icon-photogallery"></span> {$GOOD_H1} – {$LINGVO.interior_photo}</a>
  </div>

  <!-- Деталі продукту: артикул, назва, опції, ціна, кнопки -->
  <!-- Product details -->
  <div class="product-page__details">
    <div class="product-page__details_artikul">{$LINGVO.artikul}: {$CUR_GFSID}</div>
    <h1>{$GOOD_H1}</h1>

    <!-- Опції: розмір і колір -->
    <section class="product-page__options">
      <h3>{$LINGVO.varianty}:</h3>
      <div class="product-page__options_size">
      {if $G_SIZES|@count > 0}
        <sl-radio-group name="size" value="1">
        {foreach from=$G_SIZES item=size key=k}
          <sl-radio value="1"{if $size.price==0} disabled{/if}>
            <label>
              <div class="size__name">{$size.measure}</div>
              <div class="size__price">{$size.price}<sup>грн</sup>
              </div>
              {if $PLANT_GOOD}
                {if $size.db_1c_availability>0}
                <sl-tag variant="success">Є в наявності</sl-tag>
                {elseif $size.visibility==0}
                <sl-tag variant="success">Немає в наявності</sl-tag>
                {elseif $GOOD_ONE.preorder==1}
                <sl-tag variant="success">Під замовлення</sl-tag>
                {else}
                <sl-tag variant="success">Немає в наявності</sl-tag>
                {/if}
              {/if}
              <button href="" class="size__video-link" aria-label="{$LINGVO.show_video} {$GOOD_H1} {$size.measure}">
                <img src="/img/icons/icon-video-button.svg" alt="{$LINGVO.show_video}"/>
              </button>
            </label>
          </sl-radio>
        {/foreach}
        </sl-radio-group>
      {/if}
          
        
      </div>
      <div class="product-page__options_color">
        <sl-radio-group label="Оберіть колір" name="color" value="blue">
          <sl-radio-button value="blue">
            <img src="/img/product/product-color-blue.png" alt=""/>
          </sl-radio-button>
          <sl-radio-button value="green">
            <img src="/img/product/product-color-green.png" alt=""/>
          </sl-radio-button>
          <sl-radio-button value="pink">
            <img src="/img/product/product-color-pink.png" alt=""/>
          </sl-radio-button>
          <sl-radio-button value="red">
            <img src="/img/product/product-color-red.png" alt=""/>
          </sl-radio-button>
          <sl-radio-button value="yellow">
            <img src="/img/product/product-color-yellow.png" alt=""/>
          </sl-radio-button>
        </sl-radio-group>
      </div>
    </section>

    <!-- Ціна і кнопки дій -->
    <section class="product-page__actions">
      <div class="product-page__price">
        1965
        <sup>грн</sup>
      </div>
      <div class="product-page__actions_buttons">
        <button href="" class="button button--primary">До кошика</button>
        <button href="#" class="button button--outline button--icon button--small" aria-label="Додати до улюблених">
          <span class="icon icon-heart"/>
        </button>
        <button href="#" class="button button--outline button--small consult" aria-label="Порадитись з фахівцем">
          <img src="/img/icons/icon-question.svg" alt=""/>
          <b>Порадитись</b>
        </button>
      </div>
    </section>

    <!-- Табси: інформація, доставка, оплата -->
    <section class="product-page__delivery">
      <sl-tab-group>
        <sl-tab slot="nav" panel="info">Інформація</sl-tab>
        <sl-tab slot="nav" panel="delivery">Доставка</sl-tab>
        <sl-tab slot="nav" panel="payment">Оплата</sl-tab>

        <sl-tab-panel name="info" class="product-page__delivery_info">
          <ul>
            <li>Висота від підлоги вказана разом із горщиком</li>
            <li>Рослина поставляється в пластиковому горщику для транспортування</li>
            <li>100% оригінальний товар, сертифікат</li>
            <li>Надсилаємо фото реальної рослини після оформлення замовлення</li>
            <li>Доставляємо в упаковці та теплій машині</li>
          </ul>
        </sl-tab-panel>
        <sl-tab-panel name="delivery">
          <div class="product-page__delivery_list">
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-post.svg" alt=""/>
              <div class="delivery__item_info">
                <p>Самовивіз із магазинів у Києві:</p>
                <ul>
                  <li>пр. Берестейський, 70</li>
                </ul>
              </div>
              <div class="delivery__item_price">безкоштовно</div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-track.svg" alt=""/>
              <div class="delivery__item_info">
                <p>Кур'єром по Києву:</p>
                <p>
                  <a href="">Детальніше</a>
                </p>
              </div>
              <div class="delivery__item_price">от 200 <sup>грн</sup>
              </div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-nova-poshta.svg" alt=""/>
              <div class="delivery__item_info">
                <p>Доставка у відділення Нової Пошти:</p>
                <p>
                  <a href="">Детальніше</a>
                </p>
              </div>
              <div class="delivery__item_price">от 80 <sup>грн</sup>
              </div>
            </div>
          </div>
        </sl-tab-panel>
        <sl-tab-panel name="payment">
          <div class="product-page__delivery_list">
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-cash.svg" alt=""/>
              <div class="delivery__item_info">Готівкою при отриманні</div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-card.svg" alt=""/>
              <div class="delivery__item_info">Картою на сайті VISA / Mastercard</div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-order.svg" alt=""/>
              <div class="delivery__item_info">Безготівковий розрахунок для юридичних осіб</div>
            </div>
          </div>
        </sl-tab-panel>
      </sl-tab-group>
    </section>
  </div>
</div>

<!-- Додаткові послуги -->
<!-- Services -->
<div class="product-page__services">
  <section class="services__item">
    <div class="services__item_icon">
      <img src="/img/icons/icon-fitodesign.svg" alt=""/>
    </div>
    <div class="services__item_link">
      <a class="underline" href="/">Озеленення інтер'єру</a>
    </div>
  </section>
  <section class="services__item">
    <div class="services__item_icon">
      <img src="/img/icons/icon-transplantation.svg" alt=""/>
    </div>
    <div class="services__item_link">
      <a class="underline" href="/">Послуги з пересадки рослин</a>
    </div>
  </section>
  <section class="services__item">
    <div class="services__item_icon">
      <img src="/img/icons/icon-care.svg" alt=""/>
    </div>
    <div class="services__item_link">
      <a class="underline" href="/">Професійний догляд за рослинами</a>
    </div>
  </section>
</div>

<!-- Табси з описом продукту, аксесуарами, доглядом, відгуками -->
<div class="product-page__description">
  <sl-tab-group>
    <sl-tab slot="nav" panel="description">Опис</sl-tab>
    <sl-tab slot="nav" panel="accessories">Аксесуари для рослин</sl-tab>
    <sl-tab slot="nav" panel="care">Особливості догляду</sl-tab>
    <sl-tab slot="nav" panel="reviews">Відгуки</sl-tab>

    <!-- Опис -->
    <sl-tab-panel name="description">
      <div class="product-page__description_info">
        <section>
          <h3>Освітлення</h3>
          <p>
            Для довгого цвітіння орхідеям потрібно багато світла. Ідеальні умови для них в місцях куди сонце потрапляє на декілька годин в день (зранку чи
            ввечері). Якщо ж орхідею поставити біля північного вікна (пряме сонце не потрапляє), то бажано тримати її якомога ближче до скла та не притіняти
            вікна шторами. Тоді вона зможе рости та розвиватись, але буде менша ймовірність цвітіння. Якщо розмістити орхідею біля південного вікна (пряме сонце
            цілий день), то на листках будуть з’являтись білі сухі плями (опіки), вони жовтітимуть та з часом орхідея може загинути.
          </p>
        </section>

        <section>
          <h3>Температура повітря</h3>
          <p>
            Навесні та влітку температура бажана вище 18 °C , ідеально — 20-25°C. Взимку і восени (після цвітіння) температура може бути прохолодна — 15-18°C, в
            цей час полив проводять через декілька днів після висихання коренів.
          </p>
        </section>
        <section>
          <h3>Полив</h3>
          <p>
            Поливаючи орхідеї, варто орієнтуватись на рівень просихання їх коренів. Якщо рослина знаходиться у прозорому пластиковому горщику та вставлена в
            кашпо — просто 1 раз на тиждень оглядайте корені. Якщо за тиждень корені не змінили колір — залиште орхідею без поливу ще на декілька днів. Для них
            нормапьно просихати між поливами 2-3 тижні. Коли корені в горщику змінюють свій колір з зеленого на сріблястий, то замочіть орхідею у воді будь-яким
            зручним способом:
          </p>
          <p>— налийте теплої води повне кашпо та залишіть на 1-2 години (можна на ніч);</p>
          <p>
            — поставте в ванну/душ та пролийте з душу теплою водою, змочуючи листя (але не потрапляючи на квіти), залишіть в вологій ванні на декілька годин;
          </p>
          <p>— якщо рослина в теплому та сонячному місці, то після відстоювання у воді залиште 1-2 см води на дні кашпо.</p>
        </section>
      </div>
    </sl-tab-panel>

    <sl-tab-panel name="accessories">
      <div class="product-page__description_accessories">
        <section>
          <h3>Грунт та добрива</h3>
          <div class="accessories__list">
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-1.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Заміокулькас</b>
                </a>
                <span>129,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-2.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-3.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Розумний вазон Lechuza Delta</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-4.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-5.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
          </div>
        </section>

        <section>
          <h3>Інші товари у категорії: Орхідеї</h3>
          <div class="accessories__list">
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-1.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Заміокулькас</b>
                </a>
                <span>129,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-2.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-3.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Розумний вазон Lechuza Delta</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-4.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-5.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
          </div>
        </section>

        <section>
          <h3>Дивіться також</h3>
          <div class="accessories__list">
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-1.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Заміокулькас</b>
                </a>
                <span>129,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-2.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-3.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Розумний вазон Lechuza Delta</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-4.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
            <div class="accessories__list_item">
              <a href="" class="accessories__list_item-image">
                <img src="/img/homepage/product-5.png" alt=""/>
              </a>
              <div class="accessories__list_item-info">
                <a href="">
                  <b>Антуріум</b>
                </a>
                <span>114,99 ₴</span>
                <sl-rating value="5" readonly></sl-rating>
              </div>
            </div>
          </div>
        </section>
      </div>
    </sl-tab-panel>
    <sl-tab-panel name="care">
      <div class="product-page__description_care">
        <table>
          <tbody>
            <tr>
              <td>
                <b>Температура</b>
              </td>
              <td>комфортна — 18-25ºC Мінімум: 12 ºC Максимум: 40 ºC</td>
              <td>
                <b>Освітлення</b>
              </td>
              <td>Яскраве, розсіяне.</td>
            </tr>
            <tr>
              <td>
                <b>Полив</b>
              </td>
              <td>Вологолюбна рослина. Рекомендуємо періодично опускати у воду або наливати її в піддон.</td>
              <td>
                <b>Вологість повітря</b>
              </td>
              <td>бажана підвищена вологість повітря.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </sl-tab-panel>
    <sl-tab-panel name="reviews">
      <!-- Секція відгуків: форма і список -->

      <!-- Форма відгуків -->
      <!-- Comments Form Section -->
      <div class="reviews-section">
        <h2>Відгук або запитання</h2>
        <div class="reviews-section__form">
          <sl-input placeholder="ПІБ"></sl-input>
          <sl-input placeholder="Телефон або e-mail (не буде опубліковано)"></sl-input>
          <sl-textarea placeholder="Комментар" rows="1" resize="auto"></sl-textarea>
          <div class="reviews-section__form_rating">
            <span>Ваша оцінка:</span>
            <sl-rating></sl-rating>
          </div>
          <button class="button button--primary button--pill">Відправити</button>
        </div>
      </div>

      <!-- Список відгуків -->
      <!-- Comments List Section -->
      <div class="reviews-section__comments">
        <!-- Comment Item -->
        <div class="comments__item">
          <div class="comments__item-date">11 квітня 2024</div>
          <div class="comments__item-grid">
            <div class="comments__item-title">
              <b>Хивренко Александр</b>
              <sl-rating size="small" value="5" readonly></sl-rating>
            </div>
            <div class="comments__item-text">
              Купувала у даному магазині онлайн гортензію в горщику, загалом 3 горщика (один замовляли додатково). Дуже ввічливі і відповідальні, весь час були
              за звʼязку. Надали фото всіх квітів зі святковою упаковкою. Організували доставку по області і вчасно доставили в чудовому вигляді. Дуже були
              задоволені! Дякую!
            </div>
          </div>
        </div>
        <!-- Comment Item -->
        <div class="comments__item">
          <div class="comments__item-date">12 грудня 2023</div>
          <div class="comments__item-grid">
            <div class="comments__item-title">
              <b>Катерина</b>
              <sl-rating size="small" value="5" readonly></sl-rating>
            </div>
            <div class="comments__item-text">
              У вас широкий вибір орхідей, що радує. Красиві. Видно, що ви професіонали в своїй справі, тому що рослини доглянуті й цвітуть. Значить, за ними
              доглядають правильно.
            </div>
          </div>
        </div>
        <!-- Comment Item -->
        <div class="comments__item">
          <div class="comments__item-date">31 липня 2023</div>
          <div class="comments__item-grid">
            <div class="comments__item-title">
              <b>Олеся П.</b>
              <sl-rating size="small" value="5" readonly></sl-rating>
            </div>
            <div class="comments__item-text">
              Квіти завжди є чудовим подарунком, вони викликають приємні емоції та піднімають настрій. Придбала рослину на подарунок, бо захопилася символізмом
              квітки кохання)) Задоволена своїм вибором і допомогою професійних консультантів.
            </div>
          </div>
        </div>
      </div>
    </sl-tab-panel>
  </sl-tab-group>
</div>