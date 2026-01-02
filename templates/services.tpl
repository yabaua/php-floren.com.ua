{literal}
<script type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "Offer",
"availability": "http://schema.org/InStock",
"itemOffered": "Service",
"name": "{/literal}{$SERVICE.meta_title}{literal}",
"description": "{/literal}{$SERVICE.meta_description}{literal}",
"url": "https://floren.com.ua{/literal}{$LANGURL}{literal}/services/{/literal}{$URL[1]}{literal}/", 
"price": "{/literal}{$SERVICE.schema_price}{literal}",
"priceCurrency": "UAH"
}
</script>

{/literal}

{if isset($URL[2]) && $URL[2]=='cb'}
	<script>show_popup('call_back_general', 'Обратная связь', 'hotlink')</script>
{/if}

<!--seoshield_formulas--uslugi-->
<h1>{$SERVICE.title}</h1>
{$SERVICE.body}
