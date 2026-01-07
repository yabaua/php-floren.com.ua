<div class="filters">

	<div class="filters__wrapper">
	<button class="close-btn"></button>

{if $CUR_CAT=='publications'}
	<div class="filters__info">
		<p class="filters__name">{$LINGVO.nav}</p>
		<ul class="filters__list">

			<li class="filters__item"><a class="filters__link" href="{$LANGURL}/publications/">Все</a></li>

			{foreach item=PC name=PC from=$PUB_CATEGORIES}
				<li class="filters__item"><a href="{$LANGURL}/publications/?cat={$PC.alias}" class="filters__link {if $PC.act=='1'}filters__link_active{/if}">{$PC.name}</a></li>
			{/foreach}

		</ul>
	</div>

{elseif $CUR_CAT=='777' || $CUR_CAT=='phytodesign' || $URL[0]=='phytodesign'}
<!-- Sidebar navigation - категорії каталогу -->

          <section class="double-column-page__nav_section">
            <h3{if $URL[0]=='phytodesign'} class="active"{/if}>
              <a href="{$LANGURL}/phytodesign/">{$LINGVO.phytodesign}</a>
            </h3>
            <ul>
              <li{if $URL[1]=='phytodesign-kvartiri'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/phytodesign-kvartiri/">{$LINGVO.phytodesign_kvartiri}</a>
              </li>
              <!-- li{if $URL[1]=='phytodesign-ofisa'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/phytodesign-ofisa/">{$LINGVO.phytodesign_ofisa}</a>
              </li -->
              <li{if $URL[1]=='peregorodki-iz-rasteniy'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/peregorodki-iz-rasteniy/">{$LINGVO.zonirovanie}</a>
              </li>
              <li{if $URL[1]=='ozelenenie-iskusstvennimi-rasteniyami'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/ozelenenie-iskusstvennimi-rasteniyami/">{$LINGVO.ozelenenie_iskusstvennimi_rasteniyami}</a>
              </li>
              <li{if $URL[1]=='ozelenenie_letney_ploschadki'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/ozelenenie_letney_ploschadki/">{$LINGVO.ozelenenie_terras}</a>
              </li>
            </ul>
          </section>
          <section class="double-column-page__nav_section">
            <h3{if $URL[1]=='vertikalnoe-ozelenenie'} class="active"{/if}>
              <a href="{$LANGURL}/services/vertikalnoe-ozelenenie/">{$LINGVO.vertikalnoe_ozelenenie}</a>
            </h3>
            <ul>
              <li{if $URL[1]=='green-wall'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/green-wall/">{$LINGVO.green_wall}</a>
              </li>
              <li{if $URL[1]=='vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/vertikalnoe-ozelenenie-metallicheskimi-konstruktsiyami/">{$LINGVO.metall_ozel}</a>
              </li>
              <li{if $URL[1]=='ozelenenie-stabilizirovannim-mhom'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/ozelenenie-stabilizirovannim-mhom/">{$LINGVO.ozelenenie_moss}</a>
              </li>
            </ul>
          </section>
          <section class="double-column-page__nav_section">
            <h3{if $URL[1]=='ozelenenie_letney_ploschadki'} class="active"{/if}>
              <a href="{$LANGURL}/services/house_plant_care/">{$LINGVO.care} {$LINGVO.za_rasteniyami}</a>
            </h3>
            <ul>
              <li{if $URL[1]=='peresadka'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/peresadka/">{$LINGVO.peresadka_rasteniy}</a>
              </li>
              <li{if $URL[1]=='shipping'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/shipping/">{$LINGVO.perevozka_rasteniy}</a>
              </li>
              <li{if $URL[1]=='arenda_rasteniy'} class="active"{/if}>
                <a class="underline" href="{$LANGURL}/services/arenda_rasteniy/">{$LINGVO.arenda_rasteniy}</a>
              </li>
            </ul>
          </section>




<!--  ====  -->
{elseif in_array($URL[0], ['contacts', 'about', 'delivery', 'dogovir-oferta', 'purchase-returns', 'partnership'])}

<section class="double-column-page__nav_section">
          <h3{if $URL[0]=='about'} class="active"{/if}>
            <a href="{$LANGURL}/about/">{$LINGVO.menu_about}</a>
          </h3>
        </section>
        <section class="double-column-page__nav_section">
          <h3{if $URL[0]=='delivery'} class="active"{/if}>
            <a href="{$LANGURL}/delivery/">{$LINGVO.menu_delivery}</a>
          </h3>
        </section>
        <section class="double-column-page__nav_section">
          <h3{if $URL[0]=='contacts'} class="active"{/if}>
            <a href="{$LANGURL}/contacts/">{$LINGVO.menu_contacts}</a>
          </h3>
        </section>
        <section class="double-column-page__nav_section">
          <h3{if $URL[0]=='dogovir-oferta'} class="active"{/if}>
            <a href="{$LANGURL}/dogovir-oferta/">{$LINGVO.dogovir}</a>
          </h3>
        </section>
        <section class="double-column-page__nav_section">
          <h3{if $URL[0]=='purchase-returns'} class="active"{/if}>
            <a href="{$LANGURL}/purchase-returns/">{$LINGVO.menu_purchaise_return}</a>
          </h3>
        </section>
        <section class="double-column-page__nav_section">
          <h3{if $URL[0]=='partnership'} class="active"{/if}>
            <a href="{$LANGURL}/partnership/">{$LINGVO.menu_partnership}</a>
          </h3>
        </section>


{/if}


	<!-- links_block -->


	</div>
</div>



{if $SEO_TEXT!=''}
	<div class="left_text">
		{$SEO_TEXT|nl2br}
	</div>
{/if}