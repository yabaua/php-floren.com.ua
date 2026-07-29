<div>
<h1>{$LINGVO.site_search}</h1>


<form name="f3" method="post" action="">

	{if $ARTICUL_SEARCH}
		<div class="catalog-page__content_description">
			Знайдено за артикулом
		</div>
		
		<ul class="search-results__list">
			{foreach item=G name=G key=I from=$ARTICUL_SEARCH}
      <li class="search-results__item">
        <div class="search-results__item_info">
          <h3 class="search-results__item_title">
            {$G.formID} – <a href="{$G.new_link_articul}" class="underline" title="{$G.goodName}">{$G.goodName} {$G.measure}</a> – <b>{if !$G.goodPrice || $G.goodPrice==0}{$LINGVO.not_available}{else}{$G.goodPrice|number_format:2:".":" "}{/if}</b>&nbsp;грн.{if $G.barcode} <font color="#666666">Штрихкод: {$G.barcode}</font>{/if}
          </h3>
        </div>
      </li>
			{/foreach}
		</ul>
		<p>&nbsp;</p>
	{/if}
	
	
	{if $GOODS}
		<div class="catalog-page__content_description">
			Знайдено за назвою <b>«{$SRCH_ROW}»</b>
		</div>
		<ul class="search-results__list">
			{foreach item=G name=G key=I from=$GOODS}
      <li class="search-results__item">
        <div class="search-results__item_image">
          <img width="150" src="https://floren.com.ua/images/{$G.new_image}" alt="{$G.name}" />
        </div>
        <div class="search-results__item_info">
          <h3 class="search-results__item_title">
            <a href="{$G.new_link}" class="underline" title="{$G.name}">{$G.name}</a>
          </h3>
          <section class="search-results__item_options">
            {if $G.forms}	
            	<ul>
							{foreach item=GF from=$G.forms}
								<li>{$GF.measure} – {if !$GF.price || $GF.price==0}{$LINGVO.not_available}{else}{$GF.price|number_format:2:".":" "}&nbsp;грн.{/if}</li>
							{/foreach}
							</ul>
						{/if}
								{*
								<section class="search-results__item_options">
                  <div class="colors-list">
                    <span style="background-color: #c33494"></span>
                    <span style="background-color: #ffcad4"></span>
                    <span style="background-color: #f6bb05"></span>
                    <span style="background-color: #ffffff"></span>
                  </div>
                </section>
                *}
          </section>
        </div>
      </li>
			{/foreach}
		</ul>


</form>
{/if}

{if !$GOODS && !$ARTICUL_SEARCH}

	<div>
    <p>Товари за вашим запитом «Шефлера» не знайдено.</p>
    <p>Спробуйте змінити запит або повернутися на <a href="/" class="underline color-green">головну сторінку</a>.</p>
  </div>
	<p>&nbsp;</p>
  <div class="callback-button">
    <h3>Залишились питання?</h3>
    <div class="callback-button__phones">
      <a href="tel:" class="binct-phone-number-2">+380 99 238-26-44</a>
    </div>
    <button class="button button--primary button--pill">Зворотній звʼязок</button>
  </div>
{/if}

</div>