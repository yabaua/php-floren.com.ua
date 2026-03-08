{if $FILTERS}
<!-- Фільтри товарів -->
<div class="catalog-page__content_filters">
  {foreach from=$FILTERS item=F}
  <sl-select placeholder="{$F.groupName}" value="{$F.active_alias}">
    {foreach from=$F.sub_filters key=K item=SUBF} {if $SUBF.cnt==0 ||
    $SUBF.disable==1 && $SUBF.act!=1}
    <sl-option value="{$K}" disabled>{$SUBF.gfName} ({$SUBF.cnt})</sl-option>
    {else} {if $CATEGORY_ID == '80' || $FROM_GOODS == 1}
    <sl-option value="{$K}">
      <a href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{$SUBF.link}{$SUBF.need_slash}"
        >{$SUBF.gfName}{if $SUBF.act} ({$SUBF.cnt}){/if}</a
      >
    </sl-option>
    {else}
    <sl-option value="{$K}">
      <a href="{$LANGURL}/{$URL[0]}/{$SUBF.link}{$SUBF.need_slash}"
        >{$SUBF.gfName}{if !$SUBF.act} ({$SUBF.cnt}){/if}</a
      >
    </sl-option>
    {/if} {/if} {/foreach}
  </sl-select>
  {/foreach}
</div>
{if $ACTIVE_FILTERS_FLAG}
<!-- Активні теги фільтрів -->
<div class="catalog-page__content_tags">
  {foreach from=$FILTERS item=F} {foreach from=$F.sub_filters item=SUBF} {if
  $SUBF.act==1} {if $CATEGORY_ID == '80' || $FROM_GOODS == 1}
  <sl-tag removable>
    <a href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{$SUBF.link}{$SUBF.need_slash}"
      >{$SUBF.gfName}</a
    >
  </sl-tag>
  {else}
  <sl-tag removable>
    <a href="{$LANGURL}/{$URL[0]}/{$SUBF.link}{$SUBF.need_slash}"
      >{$SUBF.gfName}</a
    >
  </sl-tag>
  {/if} {/if} {/foreach} {/foreach} {if $CATEGORY_ID == '80' || $FROM_GOODS ==
  1}
  <button class="button button--text">
    <a href="{$LANGURL}/{$URL[0]}/{$URL[1]}/">{$LINGVO.deactivate_filters}</a>
  </button>
  {else}
  <button class="button button--text">
    <a href="{$LANGURL}/{$URL[0]}/">{$LINGVO.deactivate_filters}</a>
  </button>
  {/if}
</div>
{/if}

<!-- Кінець Фільтри товарів -->
{/if}{** IF FILTERS **}
<!-- Info показано скільки товарів -->
<div class="catalog-page__content_showed">
  Показано <span>{$SHOW_GOODS_FROM} - {$SHOW_GOODS_TO}</span> з <span>{$GOODS_CNT}</span>
</div>

<!-- Заголовок і опис категорії -->
<h1>{$PAGE_TITLE}</h1>
{if TOP_SEO_TEXT}
<div class="catalog-page__content_description">{$TOP_SEO_TEXT}</div>
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
      {if $P.good_status == 'in_stock'}
      <div class="product-card__price">
        {$P.price} {** <del>200,99 ₴</del> **}
        <!-- If in cart add this block -->
        <a href="{$P.product_path}">
        <button
          class="product-card__in-cart" title="{$LINGVO.buy}"
          {*
          data-event="click"
          data-callback="addToCart"
          data-id="{$P.formID}"
          *}
        >
          <span class="icon icon-basket">1</span>
        </button></a>
         </div>

      <div class="product-card__options">
        <section>
          <h5>{$LINGVO.varianty}:</h5>
          <ul>
            {foreach from=$P.forms item=F}
            <li>{$F.form_measure}</li>
            {/foreach}
          </ul>
        </section>
        {if $P.colors}
        <section>
          <h5>{$LINGVO.colors}</h5>
          <div class="colors-list">
            {foreach from=$P.colors item=FC}
            <span
              style="background: url('{$FC.image}')"
              title="Фото {$FC.name}"
            ></span>
            {/foreach}
          </div>
        </section>
        {/if} {** if colors **}
      </div>
      {elseif $P.good_status =='preorder'}
      <div class="product-card__custom-order">{$LINGVO.good_preorder}</div>
      {else}
      <div class="product-card__custom-order">{$LINGVO.not_available}</div>
      {/if}
    </div>
  </div>
  <!-- Product Card End -->
  {/foreach}
</div>
{if $PAGE_MAX>1} {** if !$FROM_GOODS **}{** if from goods.php **}
<!-- Кнопка "Показати ще" -->
<div class="catalog-page__content_more">
  <button
    class="button button--primary button--pill"
    data-event="click"
    data-callback="showMoreGoods"
  >
    {$LINGVO.show_more}
  </button>
</div>
{** /if **}

<!-- Pagination -->
{** MUI algorithm: siblingCount=1, boundaryCount=1 → max 7 visible page items **}
{assign var="N" value=$LASTPAGE}
{assign var="C" value=$CUR_PAGE}
{math assign="Nm2" equation="N - 2" N=$N}
{math assign="Nm1" equation="N - 1" N=$N}

{** siblingsStart = max(min(C-1, N-4), 3) **}
{math assign="Cm1" equation="C - 1" C=$C}
{math assign="Nm4" equation="N - 4" N=$N}
{if $Cm1 < $Nm4}
  {assign var="ss" value=$Cm1}
{else}
  {assign var="ss" value=$Nm4}
{/if}
{if $ss < 3}{assign var="ss" value=3}{/if}

{** siblingsEnd = min(max(C+1, 5), N-2) **}
{math assign="Cp1" equation="C + 1" C=$C}
{if $Cp1 > 5}
  {assign var="se" value=$Cp1}
{else}
  {assign var="se" value=5}
{/if}
{if $se > $Nm2}{assign var="se" value=$Nm2}{/if}

<div class="pagination">

  {** Prev button: disabled on first page **}
  {if $C <= 1}
  <a class="pagination__link disabled" aria-disabled="true">
    <img src="/img/icons/icon-arrow-left-long.svg" alt="Попередня сторінка" />
  </a>
  {else}
  <a class="pagination__link" title="{$LINGVO.pages_goto} {$Cm1}"
    href="{if $FROM_GOODS}{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}{if $Cm1!=1}?p={$Cm1}{/if}{else}{$LANGURL}/{$ALIAS}{$FILTERS_URL}{if $Cm1==1}/{else}/page{$Cm1}/{/if}{/if}">
    <img src="/img/icons/icon-arrow-left-long.svg" alt="Попередня сторінка" />
  </a>
  {/if}

  {** Page 1 (always visible) **}
  {if $FROM_GOODS}
  <a title="{$LINGVO.pages_goto} 1"
    href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}"
    class="pagination__link{if $C==1} active{/if}">1</a>
  {else}
  <a title="{$LINGVO.pages_goto} 1" id="p1"
    {if $C==2}rel="prev"{/if}
    href="{$LANGURL}/{$ALIAS}{$FILTERS_URL}/"
    class="pagination__link{if $C==1} active{/if}">1</a>
  {/if}

  {** Left section: ellipsis or page 2 when gap is exactly 1 **}
  {if $ss > 3}
    <span class="pagination__ellipsis">...</span>
  {elseif $ss == 3 && $N > 2}
    {if $FROM_GOODS}
    <a title="{$LINGVO.pages_goto} 2"
      href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}?p=2"
      class="pagination__link{if $C==2} active{/if}">2</a>
    {else}
    <a title="{$LINGVO.pages_goto} 2" id="p2"
      {if $C==3}rel="prev"{elseif $C==1}rel="next"{/if}
      href="{$LANGURL}/{$ALIAS}{$FILTERS_URL}/page2/"
      class="pagination__link{if $C==2} active{/if}">2</a>
    {/if}
  {/if}

  {** Sibling pages ss..se (never overlaps with pages 1, 2, N-1, N) **}
  {foreach item=P from=$PAGES}
    {assign var="pn" value=$P.page}
    {if $pn >= $ss && $pn <= $se}
      {if $FROM_GOODS}
      <a title="{$LINGVO.pages_goto} {$pn}"
        href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}?p={$pn}"
        class="pagination__link{if $P.active} active{/if}">{$pn}</a>
      {else}
      <a title="{$LINGVO.pages_goto} {$pn}" id="p{$pn}"
        rel="{if $P.prev}prev{/if}{if $P.next}next{/if}"
        href="{$LANGURL}/{$ALIAS}{$FILTERS_URL}/page{$pn}/"
        class="pagination__link{if $P.active} active{/if}">{$pn}</a>
      {/if}
    {/if}
  {/foreach}

  {** Right section: ellipsis or page N-1 when gap is exactly 1 **}
  {if $se < $Nm2}
    <span class="pagination__ellipsis">...</span>
  {elseif $se == $Nm2 && $N > 3}
    {if $FROM_GOODS}
    <a title="{$LINGVO.pages_goto} {$Nm1}"
      href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}?p={$Nm1}"
      class="pagination__link{if $C==$Nm1} active{/if}">{$Nm1}</a>
    {else}
    <a title="{$LINGVO.pages_goto} {$Nm1}" id="p{$Nm1}"
      {if $C==$N}rel="prev"{elseif $C==$Nm2}rel="next"{/if}
      href="{$LANGURL}/{$ALIAS}{$FILTERS_URL}/page{$Nm1}/"
      class="pagination__link{if $C==$Nm1} active{/if}">{$Nm1}</a>
    {/if}
  {/if}
  {** Last page (always visible) **}
  {if $FROM_GOODS}
  <a title="{$LINGVO.pages_goto} {$N}"
    href="{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}?p={$N}"
    class="pagination__link{if $C==$N} active{/if}">{$N}</a>
  {else}
  <a title="{$LINGVO.pages_goto} {$N}" id="p{$N}"
    {if $C==$Nm1}rel="next"{/if}
    href="{$LANGURL}/{$ALIAS}{$FILTERS_URL}/page{$N}/"
    class="pagination__link{if $C==$N} active{/if}">{$N}</a>
  {/if}

  {** Next button: disabled on last page **}
  {if $C >= $N}
  <a class="pagination__link disabled" aria-disabled="true">
    <img src="/img/icons/icon-arrow-right-long.svg" alt="Наступна сторінка" />
  </a>
  {else}
  <a class="pagination__link" title="{$LINGVO.pages_goto} {$Cp1}"
    href="{if $FROM_GOODS}{$LANGURL}/{$URL[0]}/{$URL[1]}/{if isset($URL[2])}{$URL[2]}/{/if}?p={$Cp1}{else}{$LANGURL}/{$ALIAS}{$FILTERS_URL}/page{$Cp1}/{/if}">
    <img src="/img/icons/icon-arrow-right-long.svg" alt="Наступна сторінка" />
  </a>
  {/if}


</div>
{/if} {** if pagination **}

<!-- SEO article section -->
{if $CUR_PAGE==1}
<article class="catalog-page__content_article">{$CENTER_SEO_TEXT}</article>
{/if}
