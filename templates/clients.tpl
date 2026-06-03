<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
<h1>{$LINGVO.clients_rewies}</h1>
<div class="row">
<dl class="clients-page">
	{foreach item=CLI from=$CLIENTS}
	{if $CLI.link}
		<dt class="col-sm-3 col-md-2">
			<a href="{$CLI.link}"><img src="https://floren.com.ua/images/clients/{$CLI.img}" alt="{$CLI.name}" title="{$CLI.name}" /></a>
		</dt>
	{else}
		<dt class="col-sm-3 col-md-2">
			<img src="https://floren.com.ua/images/clients/{$CLI.img}" alt="{$CLI.name}" title="{$CLI.name}" />
		</dt>
	{/if}
{/foreach}
</dl>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h2>{$LINGVO.reviews_recomendations}</h2>
<br>
<div class="gallery-h row">
	<div class="col-sm-6 col-md-3">
		<span href="https://floren.com.ua/images/clients/recommend-designevolution-big.jpg" data-fancybox="clients"><img src="https://floren.com.ua/images/clients/recommend-designevolution-sm.jpg" width="175" height="250" alt="" style="border:1px solid #DADADA;padding:2px;"></span>
	</div>
	<div class="col-sm-6 col-md-3">
		<span href="https://floren.com.ua/images/clients/recommend-chls-big.jpg" data-fancybox="clients"><img src="https://floren.com.ua/images/clients/recommend-chls-sm.jpg" width="175" height="250" alt="" style="border:1px solid #DADADA;padding:2px;"></span>
	</div>
	<div class="col-sm-6 col-md-3">
		<span href="https://floren.com.ua/images/clients/recommend-okko-big.jpg" data-fancybox="clients"><img src="https://floren.com.ua/images/clients/recommend-okko-small.jpg" width="175" height="250" alt="" style="border:1px solid #DADADA;padding:2px;"></span>
	</div>
	<div class="col-sm-6 col-md-3">
		<span href="https://floren.com.ua/images/clients/recommend-hsg-big.jpg" data-fancybox="clients"><img src="https://floren.com.ua/images/clients/recommend-hsg-sm.jpg" width="175" height="250" alt="" style="border:1px solid #DADADA;padding:2px;"></span>
	</div>
</div>
</div>