<div>
<h1>Галерея</h1>

<div>
{if $LANG=='ua'}
	<p>Озеленення офісного простору дуже цікаве заняття. Необхідно підібрати рослини залежно від умов приміщення. Врахувати побажання власників офісу, а також співробітників, біля яких будуть стояти квіти. Рослини повинні бути стійкими і витримувати різного роду напруги. Необхідно передбачити, як буде вести себе рослина з часом без професійного догляду.</p>
{else}
	<p>Озеленение офисного пространства интересное занятие. Необходимо подобрать растения в зависимости от условий помещения. Учесть пожелания собственников офиса, а также сотрудников, возле которых будут стоять цветы. Растения должны быть стойкими и выдерживать разного рода напряжения. Необходимо предусмотреть, как будет вести себя растение со временем без профессионального ухода.</p>
{/if}
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>	
	
<ul class="portfolio-page__list">
	{foreach from=$GALLERY1 item=G name=G}
            <li>
      {**   <li class="new"> **}
              <a href="{$LANGURL}/gallery/{$G.alias}/">
                <div class="portfolio-page__list-image">
                  <img src="https://floren.com.ua/images/gallery/start_objects/{$G.alias}.jpg" alt="{$G.galleryName}">
                </div>
                <h3>{$G.galleryName}</h3>
          {**   <time>09 липня 2025</time>	**}
              </a>
            </li>
	{/foreach}
</ul>


<p>&nbsp;</p>
<div>
{if $LANG=='ua'}
	<h2>Озеленення приватних квартир та будинків – наші роботи</h2>
	<p>Рослини – це найпростіший спосіб зробити будь-який інтер'єр більш зручним і комфортним. Рослини створюють сприятливий мікроклімат в приміщенні і роблять його бездоганним. Професійно підібрані кашпо з кімнатними рослинами, вази з квітами, композиції з живих квітів, озеленення мохом – всі ці елементи зможуть до невпізнанності змінити інтер'єр будь-якої квартири, будинку, офісу, готелю, ресторану чи магазину.</p>
{else}
	<h2>Частное озеленение – наши работы</h2>
	<p>Растения – это самый простой способ сделать любой интерьер более удобным и комфортным. Растения создают благоприятный микроклимат помещения и делают его безупречным.  Профессионально подобранные кашпо с комнатными растениями, вазы с цветами, композиции из живых цветов, озеленение мхом - все эти элементы смогут до неузнаваемости изменить интерьер любой квартиры, дома, офиса, гостиницы, ресторана или магазина.</p>
{/if}
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<ul class="portfolio-page__list">
	{foreach from=$GALLERY2 item=G name=G}
            <li>
      {**   <li class="new"> **}
              <a href="{$LANGURL}/gallery/{$G.alias}/">
                <div class="portfolio-page__list-image">
                  <img src="https://floren.com.ua/images/gallery/start_objects/{$G.alias}.jpg" alt="{$G.galleryName}">
                </div>
                <h3>{$G.galleryName}</h3>
          {**   <time>09 липня 2025</time>	**}
              </a>
            </li>
	{/foreach}
</ul>

{**
<ul class="category_list gallery-page row">
	<li class="col-sm-66 col-md-4">
		<a href="{$LANGURL}/gallery/terrace/" style="background:url('/images/gallery/start_objects/terrace.jpg') no-repeat 0 0">
			<img src="/images/gallery/start_objects/shadow_n.png" />
			<b>{$LINGVO.terrasi_i_balcony}</b>
		</a>
	</li>
	<li class="col-sm-66 col-md-4">
		<a href="{$LANGURL}/gallery/kvartira/" style="background:url('/images/gallery/start_objects/kvartira.jpg') no-repeat 0 0">
			<img src="/images/gallery/start_objects/shadow_n.png" />
			<b>{$LINGVO.chastnie_kvartiri}</b>
		</a>
	</li>
	<li class="col-sm-66 col-md-4">
		<a href="{$LANGURL}/gallery/fitodesign/" style="background:url('/images/gallery/start_objects/fitodesign.jpg') no-repeat 0 0">
			<img src="/images/gallery/start_objects/shadow_n.png" />
			<b>{$LINGVO.ozelenenie_pomescheniy}</b>
		</a>
	</li>
</ul>
**}
<p>&nbsp;</p>
<div class="row" style="margin:20px auto">
<div class="col-md-1">&nbsp;</div>

<div class="col-md-5" style="padding-top:40px;">
{if $LANG=='ua'}
<p>Вам сподобалися наші роботи? Можливо у вас виникли питання – тоді сміливо тисніть кнопку зворотного зв'язку або телефонуйте. Попросіть фитодизайнера проконсультувати вас. Також працюємо в регіонах: Одеса, Дніпро, Харків та інших.</p>
{else}
<p>Вам понравились наши работы? Возможно у вас возникли вопросы – тогда смело жмите кнопку обратной связи или звоните по телефону. Попросите фитодизайнера проконсультировать вас. Также работаем в регионах: Одесса, Днепр, Харьков и других.</p>
{/if}
</div>

<div class="col-md-6"><a class="ozel_but" href="{$LANGURL}/contacts/" onclick="show_popup('call_back_general', 'Фотогалерея', 'Button Btn');return false;">{$LINGVO.order_consultation}!</a>

<p style="maring-top:5px;font-size:14px;clear:both;">{$LINGVO.also_call}:<br>
(044) 599-25-33<br>
(099) 238-26-44</p>
</div>
</div>
<p>&nbsp;</p>

</div>