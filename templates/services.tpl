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
<div class="services-page__content">
  {* $SERVICE.body *}
  {include $BODY_FILE}
</div>

<sl-dialog id="calculate-modal" label="{$SERVICE.title}" class="calculate-modal">
  <form class="login-modal__form" action="/thankyou/" method="post">
    <input type="hidden" name="cb_topic" value="{$SERVICE.title}"></input>
    <div class="form-control">
      <sl-input name="cb_name" id="name" label="{$LINGVO.fb_name}" type="text" placeholder="{$LINGVO.fb_name}"></sl-input>
    </div>
    <div class="form-control">
      <label for="phone">{$LINGVO.fb_phone}*</label>
      <input id="phone" name="cb_phone" data-tel-input type="tel">
    </div>
    <div class="form-control">
      <sl-textarea id="message" name="cb_txt" label="{$LINGVO.fb_comment}" type="text"
        placeholder="{$LINGVO.fb_comment}"></sl-textarea>
    </div>

    <div class="form-control">
      <button class="button button--primary" type="submit">{$LINGVO.send}</button>
    </div>
  </form>
</sl-dialog>