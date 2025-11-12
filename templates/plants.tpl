		{if $FILTERS}
      
		<!-- Фільтри товарів -->
          <div class="catalog-page__content_filters">
          {foreach from=$FILTERS item=F}
            <sl-select placeholder="{$F.groupName}">
              {foreach from=$F.sub_filters item=SUBF}
              {if $CATEGORY_ID == '80' ||  $FROM_GOODS == 1}
              <sl-option value="option-1"><a href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{$SUBF.link}{$SUBF.need_slash}">{$SUBF.gfName} ({$SUBF.cnt})</a></sl-option>
              {else}
              <sl-option value="option-1"><a href="{$LANGURL}/{$URL[0]}/{$SUBF.link}{$SUBF.need_slash}">{$SUBF.gfName} ({$SUBF.cnt})</a></sl-option>
              {/if}
              {/foreach}
            </sl-select>
          {/foreach}
          </div>
          {if $ACTIVE_FILTERS_FLAG}
          <!-- Активні теги фільтрів -->
          <div class="catalog-page__content_tags">
          {foreach from=$FILTERS item=F}
            {foreach from=$F.sub_filters item=SUBF}
              {if $SUBF.act==1}
                {if $CATEGORY_ID == '80' ||  $FROM_GOODS == 1}
                <sl-tag removable><a href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{$SUBF.link}{$SUBF.need_slash}">{$SUBF.gfName}</a></sl-tag>
                {else}
                <sl-tag removable><a href="{$LANGURL}/{$URL[0]}/{$SUBF.link}{$SUBF.need_slash}">{$SUBF.gfName}</a></sl-tag>
                {/if}
              {/if}
            {/foreach}
          {/foreach}
          
            {if $CATEGORY_ID == '80' ||  $FROM_GOODS == 1}
            <button class="button button--text"><a href="{$LANGURL}/{$URL[0]}/{$URL[1]}/">{$LINGVO.deactivate_filters}</a></button>
            {else}
            <button class="button button--text"><a href="{$LANGURL}/{$URL[0]}/">{$LINGVO.deactivate_filters}</a></button>
            {/if}
          </div>
          {/if}
          
    <!-- Кінець Фільтри товарів -->
  {/if}{** IF FILTERS **}
		<!-- Info показано скільки товарів -->
          <div class="catalog-page__content_showed">
          Показано <span>1 - 25</span> з <span>1230</span>
          </div>

          <!-- Заголовок і опис категорії -->
          <h1>{$PAGE_TITLE}</h1>
            {if TOP_SEO_TEXT}
            <div class="catalog-page__content_description">
            {$TOP_SEO_TEXT}
            </div>
		    {/if}
		<!-- Сітка товарів -->
		<!--seoshield_formulas--kategorii-->
          <div class="catalog-page__content_products">
            
            <!--isset_listing_page-->
		    {foreach from=$PROMO item=P}
            <!-- Product Card Start-->
            <!--product_in_listingEX-->
			<!--dg_prod_in_lisintg_href:{$LANGURL}/product/{$P.ID}_{$P.link}/;;dg_prod_in_lisintg_anchor:{$P.name}-->
            <div class="catalog-page__content_product-card">
              <div class="product-card__wrapper">
                <div class="product-card__image">
                  <a href="{$P.product_path}">
                    <img src="{$P.img_path}" alt="Фото {$P.name}"/>
                  </a>
                </div>
                <div class="product-card__name">
                  <a href="{$P.product_path}">{$P.name}</a>
                </div>
                {if $P.not_available === 0}
                <div class="product-card__price">
                {$P.min_price} ₴
                    {if $P.min_price != $P.max_price}
                    – {$P.max_price} ₴
                    {/if}{** <del>200,99 ₴</del> **}
                
                  <!-- If in cart add this block -->
                  <div class="product-card__in-cart">
                    <span class="icon icon-basket"></span>
                  </div>
                
                </div>

                <div class="product-card__options">
                  <section>
                    <h5>{$LINGVO.varianty}:</h5>
                    <ul>
                    {foreach from=$P.forms item=F}
                      <li>{if $F.dia}&#216; {$F.dia} {/if}
    						{if $F.wdt}{$F.wdt} 
    						{if $F.depth}x {$F.depth} {/if}{/if}
    						{if $F.hgt}x {$F.hgt}{/if}
    						{if $F.measure_qt}{$F.measure_qt} {$F.unit}{/if}</li>
                    {/foreach}
                    </ul>
                  </section>
                  {if $P.colors}
                  <section>
                    <h5>{$LINGVO.colors}:</h5>
                    <div class="colors-list">
                        {foreach from=$P.colors item=FC}
                        {** <span style="background-color: #C33494;"></span>    **}
                            <span style="background: url('{$FC.image}');" title="Фото {$FC.name_ru}"></span>
                        {/foreach}

                    </div>
                  </section>
                  {/if} {** if colors **}
                </div>
                {elseif $P.preorder==1 && $P.act=='Y'}
					<div class="product-card__custom-order">{$LINGVO.good_preorder}</div>
				{else}
					<div class="product-card__custom-order">{$LINGVO.not_available}</div>
				{/if}
              </div>
            </div>
            <!-- Product Card End -->
            {/foreach}
              
            
          </div>
        {if $PAGE_MAX>1}
        {if !$FROM_GOODS}{** if from goods.php **}
          <!-- Кнопка "Показати ще" -->
          <div class="catalog-page__content_more">
            <button class="button button--primary button--pill">{$LINGVO.show_more}</button>
          </div>
        {/if}

          <!-- Pagination -->
          <div class="pagination">
            <a href="" class="pagination__link disabled">
              <img src="/img/icons/icon-arrow-left-long.svg.svg" alt="Попередня сторінка">
            </a>
            {foreach item=P from=$PAGES}
            {if $P.page>5}
                {continue}
            {else}
            {if $FROM_GOODS}
            
            <a title="{$LINGVO.pages_goto} {$P.page}" href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{if $URL[2]}{$URL[2]}/{/if}{if $P.page!=1}?p={$P.page}{/if}" class="pagination__link{if $P.active} active{/if}">{$P.page}</a>           
            {else}
            <a title="{$LINGVO.pages_goto} {$P.page}" id="p{$P.page}" rel="{if $P.prev}prev{/if}{if $P.next}next{/if}" href="{$LANGURL}/{$ALIAS}{$FILTERS_URL}{if $P.page==1}/{else}/page{$P.page}/{/if}" class="pagination__link{if $P.active} active{/if}">{$P.page}</a>
            {/if}
            {/if} {** if more than 5 pages  **}
            {/foreach}
            <a href="" class="pagination__link">
              <img src="/img/icons/icon-arrow-right-long.svg" alt="Наступна сторінка">
            </a>
          </div>
        {/if} {** if pagination **}
        
          <!-- SEO article section -->
            {if $CUR_PAGE==1}
            <article class="catalog-page__content_article">
            <div><section>
            {$CENTER_SEO_TEXT}
            </article>
            {/if}