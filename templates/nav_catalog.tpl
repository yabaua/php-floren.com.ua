<aside class="catalog-page__nav">
    {foreach item=C name=C key=I from=$CATEGORY_LEFT}

		{if $C.ID==25}
			{continue}
		{/if}
		
			<section class="catalog-page__nav_section">
                <h3>{$C.name}</h3>
				<ul>
					{foreach item=CC name=CC from=$C.category}
					<li{if $CUR_CAT==$CC.cur_alias} class="active"{/if}>
						<a href="{$LANGURL}/{$C.alias}/{$CC.cur_alias}/" class="underline">{$CC.name}</a>
					</li>
					{/foreach}
				</ul>
			</section>
		
	{/foreach}
</aside>