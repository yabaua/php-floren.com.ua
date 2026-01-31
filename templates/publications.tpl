{literal}
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Article",
    "headline": "{/literal}{$ARTICLE.meta_title|truncate:100}{literal}",
    "image": "{/literal}{$ARTICLE.images}{literal}",
    "alternativeHeadline": "{/literal}{$ARTICLE.title|truncate:100}{literal}",
    "description": "{/literal}{$ARTICLE.meta_description}{literal}",
    "datePublished": "{/literal}{$ARTICLE.date_add|date_format:" % Y - %m - %d "}{literal}",
    "dateCreated": "{/literal}{$ARTICLE.date_add|date_format:" % Y - %m - %d "}{literal}",
    "dateModified": "{/literal}{$ARTICLE.date_add|date_format:" % Y - %m - %d "}{literal}",
    "articleBody": "{/literal}{$ARTICLE.body_top|strip_tags:false} {$ARTICLE.body|strip_tags:false}{literal}",
    "wordcount": "{/literal}{$ARTICLE.body|count_words}{literal}",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "https://floren.com.ua{/literal}{$LANGURL}{literal}/publications/{/literal}{$URL[1]}/{literal}"
    },
    "publisher": {
      "@type": "Organization",
      "name": "Студия фитодизайна Флорен",
      "logo": {
        "@type": "ImageObject",
        "url": "https://floren.com.ua/img/logo4.png"
      }
    },
    "author": {
      "@type": "Person",
      "name": "admin"
    }
  }
</script>
{/literal}
<div>
  <article class="blog-article">
    <h1>{$ARTICLE.title}</h1>
    <div class="article_body">{$ARTICLE.body_top}</div>



{** =========== catalog =================== **}
{if $PROMO_PLANTS}
<div style="margin:1.5em 0;">
      <div class="h2">Товары из магазина</div>
      <div class="promo-h row">
			{foreach item=P name=P from=$PROMO_PLANTS}
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="one-promo indx-promo">
            <a href="{$LANGURL}/product/{$P.ID}_{$P.link}/" class="imglink" title="Купить {$P.name|replace:'"':''}"><img src="/images/ins/s/{$P.image}" alt="{$P.name|replace:'"':''}"/></a>
          <a href="{$LANGURL}/product/{$P.ID}_{$P.link}/" class="imgname" title="Купить {$P.name|replace:'"':''}">{$P.name}</a>
					<div class="promo-price">{if $P.min_price==$P.max_price}{$P.min_price}{else}{$P.min_price}&nbsp;&ndash;&nbsp;{$P.max_price}{/if}&nbsp;<em>грн.</em></div>
				</div>
			</div>
			{/foreach}
		</div>
</div>
{/if}
{** =========== catalog =================== **}



	<div class="article_body">{$ARTICLE.body}</div>
	<p>&nbsp;</p>

	<p>{$LINGVO.author} <br />{$LINGVO.fitopatolog}</p>
	<p>&nbsp;</p>
</article>



	<div class="online-consult">
		<div class="online-consult__photo">
			<div style="position:absolute;top:250px;left:20px;background:#FFFFFF;padding:5px 10px;">
				<span style="font-size:13px;"><b>{$LINGVO.fb_name_manager}</b></span>
				<br />
				<span style="font-size:11px;">{$LINGVO.plants_specialist}</span>
			</div>
		</div>
		<div class="online-consult__content">
			<span class="headline">{$LINGVO.do_you_need_help}</span>
			<p class="online-consult__text">{$LINGVO.consult_text}</p>
			<p class="online-consult__info">{$LINGVO.consult_info}</p>
			<span>{$LINGVO.consult_call}</span>
			<span class="online-consult__price">{$LINGVO.consult_price}</span>
			<div class="online-consult__form" id="send_cb_ok">
				<form action="/thankyou/" method="post" name="cb" onsubmit="return check_call_back_ajax(this)">
					<input id="cb_topic" name="cb_topic" type="Hidden" value="Статья: {$ARTICLE.title}">
					<input id="cb_topic" name="cb_ga_event_category" type="Hidden" value="Статья">
					<input id="cb_topic" name="cb_ga_event_action" type="Hidden" value="{$ARTICLE.title}">
					<input id="cb_topic" name="cb_ga_event_label" type="Hidden" value="Александра">
					<div class="online-consult__container">
						<div class="online-consult__field">
							<span class="error_block" id="error_cb_name"><strong>&nbsp;!!!&nbsp;</strong></span>{$LINGVO.fb_name} <b class="redstar">*</b>:<br>
							<input class="call_back_inText" id="cb_name" name="cb_name" type="text">
						</div>
						<div>
							<span class="error_block" id="error_cb_phone"><strong>&nbsp;!!!&nbsp;</strong></span>Телефон <b class="redstar">*</b>:<br>
							<input class="call_back_inText" id="cb_phone" name="cb_phone" type="text">
						</div>
					</div>
					<div>
						<input class="pop-up-order-button" name="xxx" type="submit" value="{$LINGVO.send}">
					</div>
				</form>
			</div>
		</div>
	</div>





<div class="blog-more services-page__left-title">
  <h2>Ещё материалы</h2>
  <div>
    <div class="holder">
		{foreach item=PL from=$PUB_LINKS}
			<div class="col-md-4">
			{**	<img src="{$PL.images|replace:'content/b-':'content/s-'}" height="150" /> **}
				<p><a href="{$LANGURL}/publications/{$PL.alias}/">{$PL.title}</a></p>
			</div>
		{/foreach}
	</div>    
  </div>
</div>
	
	



