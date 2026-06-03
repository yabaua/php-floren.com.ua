<h1>{$PAGE_TITLE}</h1>

<div class="sitemap-html">

<div class="col-md-6">
<ul class="pricelist_tbl">
	{foreach item=C name=C key=I from=$SITEMAP}
		{if $C.ID==25}
			{continue}
		{/if}
			<li><h3><a href="{$LANGURL}/{if $C.alias=='plants'}komnatnie-rasteniya{else}{$C.alias}{/if}/">{$C.name}</a></h3>
		    <ul>
		    {foreach item=CC name=CC from=$C.category}
				{if $C.alias=='plants'}
				<li><a href="{$LANGURL}/komnatnie-rasteniya/{$CC.cur_alias}/">{$CC.name}</a>
				{else}
				<li><a href="{$LANGURL}/{$C.alias}/{$CC.cur_alias}/">{$CC.name}</a>
				{/if}
					 <ul>
					{foreach item=CCC name=CCC from=$CC.goods}

						<li><a href="{$LANGURL}/product/{$CCC.ID}_{$CCC.link}/">{$CCC.name}</a></li>
					{/foreach}
					</ul>
					</li>
		    {/foreach}
		    </ul>
			</li>
	{/foreach}
	</ul>
</div>
<div class="col-md-6">
<ul>
	<li><h3><a href="{$LANGURL}/services/">{$LINGVO.services}</a></h3>
		<ul>
			<li><a href="{$LANGURL}/phytodesign/">{$LINGVO.phytodesign}</a></li>
			{foreach item=SS name=SS from=$S_SERVICES}
			<li><a href="{$LANGURL}/services/{$SS.alias}/">{$SS.title}</a></li>
			{/foreach}
		</ul>
		</li>
</ul>
<ul>
	<li><h3>{$LINGVO.landscape}</h3>
		<ul>
			{foreach item=SL name=SL from=$S_LANDSCAPE}
			{if $SL.category==$SL.alias}
			<li><a href="{$LANGURL}/{$SL.category}/">{$SL.title}</a></li>
			{else}
			<li><a href="{$LANGURL}/{$SL.category}/{$SL.alias}/">{$SL.title}</a></li>
			{/if}
			{/foreach}
		</ul>
		</li>
</ul>
<ul>
	<li><h3><a href="{$LANGURL}/gallery/">{$LINGVO.galereya_rabot}</a></h3>
		<ul>
			{foreach item=SG name=SG from=$S_GALLERY}
			<li><a href="{$LANGURL}/gallery/{$SG.alias}/">{$SG.galleryName}</a></li>
			{/foreach}
		</ul>
		</li>
</ul>
<ul>
	<li><h3><a href="{$LANGURL}/publications/">{$LINGVO.menu_publications}</a></h3>
		<ul>
			{foreach item=SP name=SP from=$S_PUBLICATIONS}
			<li><a href="{$LANGURL}/publications/{$SP.alias}/">{$SP.title}</a></li>
			{/foreach}
		</ul>
		</li>
</ul>
<ul>
	<li><h3><a href="{$LANGURL}/about/">{$LINGVO.menu_about}</a></h3></li>
	<li><h3><a href="{$LANGURL}/clients/">{$LINGVO.our_clients}</a></h3></li>
	<li><h3><a href="{$LANGURL}/contacts/">{$LINGVO.menu_contacts}</a></h3></li>
	<li><h3><a href="{$LANGURL}/delivery/">{$LINGVO.menu_delivery}</a></h3></li>
	<li><h3><a href="{$LANGURL}/partnership/">{$LINGVO.menu_partnership}</a></h3></li>

</div>


</div> <!-- /.sitemap-html -->