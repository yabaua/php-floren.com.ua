<div class="main__last-works">
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
</div>