<div>
  <h1>{$PUBLICATIONS_TTL}</h1>
  <!-- <button class="filters__mobile-btn" data-modal-trg="5">{$LINGVO.show_filters}</button> -->
  <section class="blogs_list">
{foreach item=AL from=$ART_LIST}
  <article class="blogs_list__card">
      <div class="blogs_list__card--image">
        <img src="/img/no-image.jpg" alt="">
      </div>
      <div class="blogs_list__card--content">
        <h3>
          <a href="{$LANGURL}/publications/{$AL.alias}/" class="underline">{$AL.title}</a>
        </h3>
        <p>{$AL.body|strip_tags|truncate:300:"..."}</p>
      </div>
      <div class="blogs_list__card--views">
        <img src="/img/icons/icon-eye.svg" alt="">
        <span>{$LINGVO.views_cnt}: {$AL.pub_views}</span>
      </div>
      <div class="blogs_list__card--tags">
      {foreach item=ALCAT from=$ART_LIST2CAT[$AL.ID]}
		<a href="/publications/?cat={$ALCAT.cat_alias}" class="tag">{$ALCAT.cat_name}</a>
	  {/foreach}      
    </div>
    </article>  
{/foreach}
</section>
</div>