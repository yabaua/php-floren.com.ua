<h1>{$PAGE_TITLE}</h1>
{foreach item=P from=$PRICE.ei}

<ul class="pricelist_tbl">
<li>
{if $P.ID=='51'}
	{continue}
{elseif $P.ID==49}
	{continue}
{elseif $P.ID==25}
	{continue}
{else}
<h3><a href="{$LANGURL}/{$P.mCatAlias}/{$P.alias}/" title="{$P.name}">{$P.name}</a></h3>
{/if}
<ul>
	{foreach item=PG from=$P.goods}
	<li>
		{if $PG.catID==51}
		{continue}
		{elseif $PG.catID==25}
		{continue}
		{elseif $PG.catID==49}
		{continue}
		{elseif $PG.catID==68}
		{continue}
		{else}
		<a href="{$LANGURL}/product/{$PG.ID}_{$PG.link}/" title="{$PG.name}">{$PG.name}</a>
		{/if}
	</li>
	{/foreach}
</ul>
</li>
</ul>
{/foreach}

</div>