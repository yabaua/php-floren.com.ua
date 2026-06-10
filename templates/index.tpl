<main class="homepage">
  <!-- Головний слайдер -->
  {$CONTENT}

  <!-- Секція останніх робіт -->
  <!-- Swiper з останніми роботами -->
  <div class="container last-works">
    <img class="homepage__last-works-leaf-1" src="/img/leaf-3.png" alt="leaf"/>
    <img class="homepage__last-works-leaf-2" src="/img/leaf-4.png" alt="leaf"/>

    <div class="works-swiper">
      <h2>{$LINGVO.last_photos}</h2>
      <div class="swiper" data-swiper="works-swiper" data-lastwork-viewer="product-lastwork-viewer">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          {foreach item=LPH name=LPH from=$LASTPHOTOS}
          <div class="swiper-slide works-slide">
              <div class="works-slide__image">
                <img src="https://floren.com.ua/images/lastphotos/b/{$LPH.photo_url}" alt="{$LPH.photo_name}"/>
              </div>
              <div class="works-slide__content">
              {if $LPH.photo_dsc!=''}
              <a class="not-underline" href="{$LPH.photo_dsc}">{$LPH.photo_dsc}</a>
              {/if}
              <time> {$LPH.date_add|date_format:"%d %B %Y"|capitalize:true} </time>
              </div>
            </div>
          {/foreach}
          <!-- / Slides -->
        </div>
      </div>
      <!-- If we need navigation buttons -->
      <button class="swiper-button swiper-button--prev">
        <img src="/img/icons/icon-arrow-angle-left.svg" alt="<"/>
      </button>
      <button class="swiper-button swiper-button--next">
        <img src="/img/icons/icon-arrow-angle-right.svg" alt=">"/>
      </button>
    </div>
    <div class="last-works_more">
      <button class="button button--primary button--pill">{$LINGVO.show_more}</button>
    </div>
  </div>

{$CONTENT2}

  <!-- Слайдер клієнтів -->
  <!-- Swiper з логотипами клієнтів -->
  <div class="container">
    <div class="clients-swiper homepage__clients">
      <h2>{$LINGVO.our_clients}</h2>
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
        <img src="/img/icons/icon-arrow-angle-left.svg" alt="<"/>
      </button>
      <button class="swiper-button swiper-button--next">
        <img src="/img/icons/icon-arrow-angle-right.svg" alt=">"/>
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
        {foreach from=$PROMO_PLANTS item=PP}
        <div class="swiper-slide popular-slide">
            <div class="popular-slide__image">
              <a href="{$PP.product_path}">
                <img src="{$PP.img_path}" alt="{$LINGVO.buy} {$PP.name}" />
              </a>
            </div>
            <div class="popular-slide__title">
              <a href="{$PP.product_path}">{$PP.name}</a>
            </div>
            <div class="popular-slide__price">{$PP.price}</div>
            <sl-rating label="Rating" readonly value="{$PP.stars}"></sl-rating>
          </div>
        {/foreach}
      </div>
      </div>
      <button class="swiper-button swiper-button--prev">
        <img src="/img/icons/icon-arrow-angle-left.svg" alt="<"/>
      </button>
      <button class="swiper-button swiper-button--next">
        <img src="/img/icons/icon-arrow-angle-right.svg" alt=">"/>
      </button>
      <div class="homepage__popular_more">
        <button class="button button--primary button--pill button--arrow">{$LINGVO.do_catalog}</button>
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
          <form name="cb" method="POST" action="{$LANG_URL}/thankyou/">
            <input type="hidden" name="cb_topic" value="Головна сторінка">
            <div class="homepage__advices_content--form">
              <sl-input type="phone" placeholder="{$LINGVO.fb_name}" name="cb_name"></sl-input>
              <sl-input type="phone" placeholder="{$LINGVO.fb_phone}" name="cb_phone"></sl-input>
              <button class="button button--primary button--pill">Надіслати</button>
            </div>
          </form>
          <div class="homepage__advices_content--call">
          Також звертайтесь за телефонами:
        </div>
          <div class="homepage__advices_content--phones binct-phone-number-2">
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

 {$CONTENT3}

  <!-- Секція рейтингу -->
  <!-- Секція відгуків з Google -->
  <div class="homepage__rating">
    <div class="container">
      <div class="homepage__rating_grid">
        <div class="homepage__rating_title">
          <h2>{$LINGVO.title_care_feedback}</h2>
          <div class="google-logo">
            <img class="google-logo__img" src="/img/google-logo.svg" alt="Google"/>
            <div class="google-logo__info">
              <h5>Рейтинг Google</h5>
              <div class="google-logo__rating">
                <span>4.9</span>
                <sl-rating size="small" value="4.9" readonly></sl-rating>
              </div>              
            </div>
          </div>
        </div>
        <ul class="homepage__rating_list">
        {foreach from=$GOOGLE_RATING item=GM}
        <li class="rating__item">
            <div class="rating__item_text">
            {$GM.review_text}
          </div>
            <div class="rating__item_author">{$GM.user_name}</div>
            <sl-rating label="Rating" readonly value="{$GM.stars}"></sl-rating>
          </li>
        {/foreach}
      </ul>
      </div>
    </div>
  </div>
</main>