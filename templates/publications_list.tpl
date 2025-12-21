<div>
<h1>{$PUBLICATIONS_TTL}</h1>
<button class="filters__mobile-btn" data-modal-trg="5">{$LINGVO.show_filters}</button>
{foreach item=AL from=$ART_LIST}
<article>
<div class="artlist-h">
	<h2 class="art_ttl" style="font-size:1.4em"><a href="{$LANGURL}/publications/{$AL.alias}/">{$AL.title}</a></h2>
	<div class="art_dsc">{$AL.body|strip_tags|truncate:300:"..."}</div>
	<div class="holder">
	{foreach item=ALCAT from=$ART_LIST2CAT[$AL.ID]}
		<a href="/publications/?cat={$ALCAT.cat_alias}" style="font-size:11px;background:#ECF3E2;padding:1px 5px;display:block;float:left;text-decoration:none;margin:4px 10px 4px 0px;color:#588829;">{$ALCAT.cat_name}</a>
	{/foreach}
		<span style="font-size:11px;color:#555555;">{$LINGVO.views_cnt}: {$AL.pub_views}</span>
	</div>
</div>
</article>
{/foreach}

</div>