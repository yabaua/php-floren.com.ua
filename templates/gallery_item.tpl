<div class="portfolio-page__content">
	<h1>{$GALLERY.galleryName}</h1>
	
	<div>
		{$GALLERY.galleryDescription}
	</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<ul class="portfolio-page__list gallery">
		{foreach from=$GALLERY_IMG item=G name=G}
	            <li>
	            	<a href="https://floren.com.ua/images/gallery/b/{$G.imgURL}">
	                <div class="portfolio-page__list-image">
	                  <img src="https://floren.com.ua/images/gallery/b/{$G.imgURL}" alt="{$LINGVO.ozelenenie_obekta}: {$GALLERY.galleryName} – фото {$smarty.foreach.G.iteration}">
	                </div>
	               </a
	            </li>
		{/foreach}
	</ul>
	
	
	<div class="portfolio-page__next">
	  <span>{$LINGVO.next_object}:</span>
	  <a href="{$LANGURL}/gallery/{$GALLERYNEXT.alias}/" class="underline">{$GALLERYNEXT.galleryName}</a>
	  <img src="/img/icons/icon-arrow-right-long.svg" alt="{$LINGVO.next_object}">
	</div>
</div>