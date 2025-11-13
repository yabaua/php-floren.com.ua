{$SCHEMA_SCRIPT}
<div class="product-page__content_grid">
  <!-- Галерея фото продукту -->
  <!-- Product gallery -->
  <div class="product-page__gallery">
    <div class="hover-photo-viewer" data-photo-viewer="project-photo-viewer">
      <div class="hover-photo-viewer__main">
        <img src="{$MAIN_IMAGE}?v=2" alt="{$GOOD_ONE.name_alter} {$GOOD_ONE.name}" title="{$GOOD_ONE.name_alter} {$GOOD_ONE.name}"/>
      </div>
      {if $GOOD_IMAGES}
      <ul class="hover-photo-viewer__thumbs">
        {foreach item=GI name=GI from=$GOOD_IMAGES}
        {if $GI@iteration>5}{continue}{/if}
        <li{if $GI@iteration==1} class="active"{/if}>
          <img src="{$GI}" alt="{$GOOD_ONE.name} фото {$smarty.foreach.GI.iteration}"/>
        </li>
        {/foreach}
        {if $G_SIZES|@count > 0}
				  {foreach from=$G_SIZES item=v_size key=v_k}
					{if $v_size.formID==$CUR_GFSID && $v_size.video!=''}
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
      {if $G_SIZES|@count > 0}
      <h3>{$LINGVO.varianty}:</h3>
      <div class="product-page__options_size">
        <sl-radio-group name="size" label="{$LINGVO.choose_size}" value="{$CUR_GFSID}">
        {foreach from=$G_SIZES item=size key=k}
          <sl-radio value="{$size.fID}"{if $size.price==0 || $size.visibility==0} disabled{/if}>
            <a href="{$size.hrefID}">
              <div class="size__name">{$size.measure}</div>
              <div class="size__price">{$size.price}<sup>грн</sup>
              </div>
              {if $PLANT_GOOD}
                {if $size.db_1c_availability>0}
                <sl-tag variant="success">Є в наявності</sl-tag>
                {elseif $size.visibility==0}
                <sl-tag variant="danger">Немає в наявності</sl-tag>
                {elseif $GOOD_ONE.preorder==1}
                <sl-tag variant="order">Під замовлення</sl-tag>
                {else}
                <sl-tag variant="success">Немає в наявності</sl-tag>
                {/if}
              {/if}
              <button href="" class="size__video-link" aria-label="{$LINGVO.show_video} {$GOOD_H1} {$size.measure}">
                <img src="/img/icons/icon-video-button.svg" alt="{$LINGVO.show_video}"/>
              </button>
            </a>
          </sl-radio>
        {/foreach}
        </sl-radio-group>
      </div>
      {/if}
      {if $G_COLOR|@count > 0}
      <div class="product-page__options_color">
        <sl-radio-group label="{$LINGVO.choose_color}" name="color" value="{$CUR_COLOR_TTL}">
        {foreach from=$G_COLOR item=C key=k}
          <sl-radio-button value="{$C.colorTitle}">
            <a href="{$C.hrefID}"><img src="{$C.previewImg}" alt="{$C.colorTitle}"/></a>
          </sl-radio-button>
        {/foreach}
        </sl-radio-group>
      </div>
      {/if}
    </section>

    <!-- Ціна і кнопки дій -->
    <section class="product-page__actions">
      <div class="product-page__price">
        {$CUR_PRICE}
        <sup>грн</sup>
      </div>
      <div class="product-page__actions_buttons">
        <button href="" class="button button--primary">{$LINGVO.add_prod}</button>
        <button href="#" class="button button--outline button--icon button--small" aria-label="{$LINGVO.add_to_fav}">
          <span class="icon icon-heart"/>
        </button>
        <button href="#" class="button button--outline button--small consult" aria-label="{$LINGVO.advice_prof}">
          <img src="/img/icons/icon-question.svg" alt=""/>
          <b>{$LINGVO.advice}</b>
        </button>
      </div>
    </section>

    <!-- Табси: інформація, доставка, оплата -->
    <section class="product-page__delivery">
      <sl-tab-group>
        <sl-tab slot="nav" panel="info">{$LINGVO.poleznaya_info}</sl-tab>
        <sl-tab slot="nav" panel="delivery">{$LINGVO.delivery}</sl-tab>
        <sl-tab slot="nav" panel="payment">{$LINGVO.payment}</sl-tab>

        <sl-tab-panel name="info" class="product-page__delivery_info">
          <ul>
            {if $PLANT_GOOD}
    					<li>{$LINGVO.info_height}</li>
            <li>{$LINGVO.info_planters}</li>
            <li>{$LINGVO.info_original_quality}</li>
            <li>{$LINGVO.send_photo}</li>
            <li>{$LINGVO.info_good_delivery}</li>
    				{/if}
    
    				{if $SPECIAL_CERAMIC_GOOD}
    					<li>{$LINGVO.handmade}</li>
            <li>{$LINGVO.also_we_have_sizes}</li>
            <li>{$LINGVO.also_we_have_colors}</li>
    				{/if}
    
    				{if $CERAMIC_GOOD}
    					<li>{$LINGVO.made_ua}</li>
            <li>{$LINGVO.quality_ceramics}</li>
            <li>{$LINGVO.many_colors}</li>
            <li>{$LINGVO.perfect_forms}</li>
    				{/if}
    
    				{if $LECHUZA_GOOD}
    					<li>{$LINGVO.info_original_quality}</li>
            <li>{$LINGVO.made_de}</li>
            <li>{$LINGVO.quality_plastik}</li>
            <li>{$LINGVO.autopoliv}</li>
            <li>{$LINGVO.water_level}</li>
            <li>{$LINGVO.good_design}</li>
            <li>{$LINGVO.uf_rays}</li>
    				{/if}
    
    				{if $LAMELA_GOOD}
    
    					<li>{$LINGVO.made_pl}</li>
            <li>{$LINGVO.hight_quality_plastik}</li>
            <li>{$LINGVO.kashpo_type}</li>
            <li>{$LINGVO.inner_kashpo}</li>
    
    				{/if}
          </ul>
        </sl-tab-panel>
        <sl-tab-panel name="delivery">
          <div class="product-page__delivery_list">
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-post.svg" alt=""/>
              <div class="delivery__item_info">
                <p>{$LINGVO.pickup_kiev}:</p>
                <ul>
                  <li>{$LINGVO.address_street}</li>
                </ul>
              </div>
              <div class="delivery__item_price">{$LINGVO.free}</div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-track.svg" alt=""/>
              <div class="delivery__item_info">
                <p>{$LINGVO.currier_50}:</p>
                <p>
                  <a href="{$LANGURL}/delivery/">{$LINGVO.more}</a>
                </p>
              </div>
              <div class="delivery__item_price">{$LINGVO.txt_vid} {$DELIVERY_OPTIONS.courier_std} <sup>грн</sup>
              </div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-nova-poshta.svg" alt=""/>
              <div class="delivery__item_info">
                <p>{$LINGVO.pickup_from_np}:</p>
                <p>
                  <a href="{$LANGURL}/novaposhta/">{$LINGVO.more}</a>
                </p>
              </div>
              <div class="delivery__item_price">{$LINGVO.txt_vid} 80 <sup>грн</sup>
              </div>
            </div>
          </div>
        </sl-tab-panel>
        <sl-tab-panel name="payment">
          <div class="product-page__delivery_list">
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-cash.svg" alt=""/>
              <div class="delivery__item_info">{$LINGVO.bsk_cash}</div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-card.svg" alt=""/>
              <div class="delivery__item_info">{$LINGVO.bsk_pay_now}</div>
            </div>
            <div class="delivery__item">
              <img class="delivery__item_icon" src="/img/icons/icon-order.svg" alt=""/>
              <div class="delivery__item_info">{$LINGVO.bsk_beznal}</div>
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
      <a class="underline" href="{$LANGURL}/phytodesign/">{$LINGVO.ozelenenie_interera}</a>
    </div>
  </section>
  <section class="services__item">
    <div class="services__item_icon">
      <img src="/img/icons/icon-transplantation.svg" alt=""/>
    </div>
    <div class="services__item_link">
      <a class="underline" href="{$LANGURL}/services/peresadka/">{$LINGVO.service_peresedka}</a>
    </div>
  </section>
  <section class="services__item">
    <div class="services__item_icon">
      <img src="/img/icons/icon-care.svg" alt=""/>
    </div>
    <div class="services__item_link">
      <a class="underline" href="{$LANGURL}/services/house_plant_care/">{$LINGVO.uhod_flower}</a>
    </div>
  </section>
</div>

<!-- Табси з описом продукту, аксесуарами, доглядом, відгуками -->
<div class="product-page__description">
  <sl-tab-group>
    {if $GOOD_ONE.body}
    <sl-tab slot="nav" panel="description">{$LINGVO.descr}</sl-tab>
    {/if}
    <sl-tab slot="nav" panel="accessories">{$LINGVO.accessory}</sl-tab>
    {if $GOOD_TECH}
    <sl-tab slot="nav" panel="care">{$LINGVO.plant_care}</sl-tab>
    {/if}
    <sl-tab slot="nav" panel="reviews">{$LINGVO.rewies}</sl-tab>

    <!-- Опис -->
    {if $GOOD_ONE.body}
    <sl-tab-panel name="description">
      <div class="product-page__description_info">
        <article class="catalog-page__content_article">
            {$GOOD_ONE_BODY}
        </article>
      </div>
    </sl-tab-panel>
    {/if}

    <sl-tab-panel name="accessories">
      <div class="product-page__description_accessories">
      {if $GOODS_BOARD_ACCESSORIES && !$ACCESSORY_GOOD}
        <section>
          <h3>{$LINGVO.accessory}</h3>
          <div class="accessories__list">
            {foreach item=GB name=GB from=$GOODS_BOARD_ACCESSORIES}
            <div class="accessories__list_item">
              <a href="{$LANGURL}/product/{$GB.ID}_{$GB.link}/" class="accessories__list_item-image" title="{$GB.name|replace:'"':''}">
                <img src="/images/goods/s/{$GB.image|replace:'.jpg':'.webp'}" alt="{$GB.name|replace:'"':''}"/>
            </a>
            <div class="accessories__list_item-info">
              <a href="{$LANGURL}/product/{$GB.ID}_{$GB.link}/">
                <b>{$GB.name}</b>
              </a>
              <span>{if $GB.min_price==$GB.max_price}{$GB.min_price}{else}{$GB.min_price}&nbsp;&ndash;&nbsp;{$GB.max_price}{/if}&nbsp;₴</span>
              <sl-rating value="{$GB.vote}" readonly></sl-rating>
            </div>
          </div>
            {/foreach}
          </div>
      </section>
      {/if}  

        <section>
        <h3>{$LINGVO.other_in_cat}: {$GOOD_ONE.className}</h3>
        <div class="accessories__list">
          {foreach item=GB name=GB from=$GOODS_BOARD}
            <div class="accessories__list_item">
            <a href="{$GB.new_link}" class="accessories__list_item-image" title="{$GB.name|replace:'"':''}">
                <img src="/images/goods/s/{$GB.image|replace:'.jpg':'.webp'}" alt="{$GB.name|replace:'"':''}"/>
          </a>
          <div class="accessories__list_item-info">
            <a href="{$GB.new_link}" title="{$LINGVO.button_buy} {$GB.name|replace:'"':''}">
                  <b>{$GB.name|replace:'"':''}</b>
                </a>
                <span>{if $GB.min_price==$GB.max_price}{$GB.min_price}{else}{$GB.min_price}&nbsp;&ndash;&nbsp;{$GB.max_price}{/if}&nbsp;₴</span>
                <sl-rating value="{$GB.vote}" readonly title="{$GB.vote}"></sl-rating>
          </div>
        </div>
          {/foreach}  
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
    {if $GOOD_TECH}
    <sl-tab-panel name="care">
  <div class="product-page__description_care">
    <table>
      <tbody>
        <tr>
              {foreach $GOOD_TECH as $GT}
              <td>
            <b>{$GT.name}</b>
          </td>
          <td>{$GT.val} {$GT.measure}</td>
              {if $GT@iteration % 3 == 2}</tr>
        <tr>{/if}
              {/foreach}
            </tr>
      </tbody>
    </table>
  </div>
</sl-tab-panel>
    {/if}
    <sl-tab-panel name="reviews">
  <!-- Секція відгуків: форма і список -->

  <!-- Форма відгуків -->
  <!-- Comments Form Section -->
  <div class="reviews-section">
    <h2>Відгук або запитання</h2>
    <form method="post" action="" onsubmit="return check_form_blog_comment_add(this);">
      <input type="hidden" name="pageID" value="{$GOOD_ONE.ID}">
      <input type="hidden" name="pageType" value="good">
      <div class="reviews-section__form">

        <sl-input placeholder="{$LINGVO.fb_name}"></sl-input>
        <sl-input placeholder="{$LINGVO.fb_phone}"></sl-input>
        <sl-textarea placeholder="{$LINGVO.fb_comment}" rows="1" resize="auto"></sl-textarea>
        <div class="reviews-section__form_rating">
          <span>{$LINGVO.fb_stars}:</span>
          <sl-rating></sl-rating>
        </div>
        <button class="button button--primary button--pill">{$LINGVO.send}</button>
      </div>
    </div>
  </form>
  <!-- Список відгуків -->
  <!-- Comments List Section -->

  <div class="reviews-section__comments">
    <!-- Comment Item -->
        {if $GOOD_FEEDBACK}
        {foreach item=COMM from=$GOOD_FEEDBACK}
        <div class="comments__item">
      <div class="comments__item-date">{$COMM.date_add|date_format:"%d %B %Y"|capitalize:true}</div>
      <div class="comments__item-grid">
        <div class="comments__item-title">
          <b>{$COMM.u_name|escape}</b>
          <sl-rating size="small" value="{$COMM.vote|escape}" readonly title="{$COMM.vote|escape}"></sl-rating>
        </div>
        <div class="comments__item-text">
              {$COMM.message|nl2br}
            </div>
      </div>
    </div>
      {/foreach}
      {else}
      <div class="comments__item">
      <div class="comments__item-date">{$smarty.now|date_format:"%d %B %Y"|capitalize:true}</div>
      <div class="comments__item-grid">
        <div class="comments__item-title">
          <b>Флорен</b>
          <sl-rating size="small" value="5" readonly></sl-rating>
        </div>
        <div class="comments__item-text">
              {$LINGVO.no_rewies_yet}
            </div>
      </div>
    </div>
      
      {/if}
      </div>

</sl-tab-panel>
</sl-tab-group>
</div>