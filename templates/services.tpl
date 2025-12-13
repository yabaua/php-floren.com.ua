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

{* ======FEEDBACK + FORM BLOCK=========*}
<section class="services-page__comments">
            <h2>Відгуки наших клієнтів</h2>
            <div class="services-page__comments_wrapper">
              <div class="catalog-page__content_comments-list">
                <!-- Comment Item -->
                <div class="comments__item">
                  <div class="comments__item-date">11 квітня 2024</div>
                  <div class="comments__item-grid">
                    <div class="comments__item-title">
                      <b>Хивренко Александр</b>
                      <sl-rating size="small" value="5" readonly=""></sl-rating>
                    </div>
                    <div class="comments__item-text">
                Купувала у даному магазині онлайн гортензію в горщику, загалом 3 горщика (один замовляли додатково). Дуже ввічливі і відповідальні, весь час
                були за звʼязку. Надали фото всіх квітів зі святковою упаковкою. Організували доставку по області і вчасно доставили в чудовому вигляді. Дуже
                були задоволені! Дякую!
              </div>
                  </div>
                </div>
                <!-- Comment Item -->
                <div class="comments__item">
                  <div class="comments__item-date">12 грудня 2023</div>
                  <div class="comments__item-grid">
                    <div class="comments__item-title">
                      <b>Катерина</b>
                      <sl-rating size="small" value="5" readonly=""></sl-rating>
                    </div>
                    <div class="comments__item-text">
                У вас широкий вибір орхідей, що радує. Красиві. Видно, що ви професіонали в своїй справі, тому що рослини доглянуті й цвітуть. Значить, за ними
                доглядають правильно.
              </div>
                  </div>
                </div>
                <!-- Comment Item -->
                <div class="comments__item">
                  <div class="comments__item-date">31 липня 2023</div>
                  <div class="comments__item-grid">
                    <div class="comments__item-title">
                      <b>Олеся П.</b>
                      <sl-rating size="small" value="5" readonly=""></sl-rating>
                    </div>
                    <div class="comments__item-text">
                Квіти завжди є чудовим подарунком, вони викликають приємні емоції та піднімають настрій. Придбала рослину на подарунок, бо захопилася
                символізмом квітки кохання)) Задоволена своїм вибором і допомогою професійних консультантів.
              </div>
                  </div>
                </div>
              </div>
              <div class="catalog-page__content_comments">
                <h2>Відгук або запитання</h2>
                <div class="comments__form">
                  <sl-input placeholder="ПІБ" type="text" size="medium" form="" data-optional="" data-valid=""></sl-input>
                  <sl-input placeholder="Телефон або e-mail (не буде опубліковано)" type="text" size="medium" form="" data-optional="" data-valid=""></sl-input>
                  <sl-textarea placeholder="Комментар" rows="1" resize="auto" size="medium" form="" data-optional="" data-valid=""></sl-textarea>
                  <div class="comments__form_rating">
                    <span>Ваша оцінка:</span>
                    <sl-rating></sl-rating>
                  </div>
                  <button class="button button--primary button--pill">Відправити</button>
                </div>
              </div>
            </div>
          </section> {**.ROW FEEDBACK + FORM **}

