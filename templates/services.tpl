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

<sl-dialog id="calculate-modal" label="{$SERVICE.title}" class="calculate-modal">
{*  <form class="login-modal__form" action="/thankyou/" method="post" onsubmit="submitForm(event)"> *}
  <form class="login-modal__form" action="/thankyou/" method="post">
    <input type="hidden" name="cb_topic" value="{$SERVICE.title}"></input>
    <div class="form-control">
      <sl-input name="cb_name" id="name" label="Ваше ім'я" type="text" placeholder="Ім'я"></sl-input>
    </div>
    <div class="form-control">
      <label for="phone">Ваш контактний номер телефону*</label>
      <input id="phone" name="cb_phone" data-tel-input type="tel">
    </div>
    <div class="form-control">
      <sl-textarea id="message" name="cb_txt" label="Ваше повідомлення" type="text" placeholder="Повідомлення"></sl-textarea>
    </div>

    <div class="form-control">
      <button class="button button--primary" type="submit">Відправити</button>
    </div>
  </form>
</sl-dialog>
