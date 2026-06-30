<main class="cart-page">

  <div class="container">
    <h1 class="cart-page__title">{$PAGE_TITLE}</h1>

    <script>
      {
        $GA4_SCRIPT
      }
    </script>

{if $ERROR}
<sl-alert variant="warning" data-name="small-order">
      <span slot="icon" class="icon icon-phone"></span>
            {$LINGVO.oups_error}
          </sl-alert>
{/if}
{if $ERROR}
	{foreach item=E from=$ERROR}
		<sl-alert variant="warning" data-name="small-order">
      <span slot="icon" class="icon icon-phone"></span>
            {$E}
          </sl-alert>
	{/foreach}
{/if}

{if $BASKET}

    
    <form name="bsk_form" method="POST" id="bsk_form" action="{$LANGURL}/order/" class="basket__form">
      <div class="cart-page__grid">
        <div class="cart-page__order-information">
          <section class="information__contact">
            <div class="information__grid">
              <div class="information__contact_form" method="post" action="{$LANGURL}/order/">
                <h2>1. {$LINGVO.contact_data}</h2>
                <div class="form-grid">
                  <div class="form-control">
                    <sl-input name="fio" label="{$LINGVO.fb_name}" required placeholder="{$LINGVO.fb_name}"></sl-input>
                  </div>
                  <div class="form-control">
                    <label for="phone" required>Ваш телефон</label>
                    <input name="phone" id="phone" required data-tel-input type="tel">
                  </div>
                </div>
                <div class="form-control">
                  <sl-input name="email" label="E-mail" type="email" placeholder="E-mail"></sl-input>
                </div>
                <div class="form-control form-control--checkbox">
                  <h3>{$LINGVO.rec_data}</h3>
                  <sl-checkbox name="recipient" id="cart-recipient-checkbox">{$LINGVO.iam_rec}</sl-checkbox>
                </div>
                <div class="form-grid" id="cart-recipient-grid">
                  <div class="form-control">
                    <sl-input name="r_fio" label="{$LINGVO.fb_name}" placeholder="{$LINGVO.fb_name}"></sl-input>
                  </div>
                  <div class="form-control">
                    <label for="phone">{$LINGVO.rec_phone}</label>
                    <input name="r_phone" id="phone" data-tel-input type="tel">
                  </div>
                </div>
              </div>
{** 
              <div class="information__contact_login">
                <svg class="icon icon-user"/>
                <p>{$LINGVO.if_not_registered}</p>
                <a href="#" class="button button--outline">{$LINGVO.button_enter}</a>
                <a href="#" class="underline">{$LINGVO.user_register}</a>
              </div>
 **}
            </div>
          </section>

          <section class="information__shipping">
            <h2>2. {$LINGVO.way_to_deliver}</h2>
            <sl-alert variant="warning" data-name="small-order-for-delivery">
              <span slot="icon" class="icon icon-info-circle"></span>
              <!-- TODO: Translate -->
              {$LINGVO.minimum_bid_txt|replace:"XXXX":$DELIVERY_OPTIONS.minimum_bid}
            </sl-alert>
            <sl-radio-group name="delivery_way" value="magazin" id="delivery-methods" data-product-price="{$BSK_TTL}" data-is-plant="{$IS_BSK_PLANT}">
              <sl-radio name="delivery_way" value="magazin" checked="true">
                <div class="radio-option">
                  <img src="/img/icons/icon-post.svg" alt="">
                  <span>{$LINGVO.kiev_addr}</span>
                  <b>{$LINGVO.free}</b>
                </div>
              </sl-radio>
              <sl-radio name="delivery_way" value="courier" {if $BSK_TTL < $DELIVERY_OPTIONS.minimum_order || $BSK_TTL < $DELIVERY_OPTIONS.minimum_bid}disabled{/if}>
              <div class="radio-option">
                <img src="/img/icons/icon-track.svg" alt="">
                <span>{$LINGVO.courier}</span>
                <b>{$LINGVO.txt_vid} {$DELIVERY_OPTIONS.courier_std} <sup>грн</sup>
                </b>
              </div>
            </sl-radio>
            <sl-radio name="delivery_way" value="nova-poshta" {if $BSK_STOP_POST_DELIVERY || $BSK_TTL < $DELIVERY_OPTIONS.minimum_order || $BSK_TTL < $DELIVERY_OPTIONS.minimum_bid}disabled{/if}>
              <div class="radio-option">
                <img src="/img/icons/icon-nova-poshta.svg" alt="">
                <span>{$LINGVO.pickup_from_np}</span>
              <b>{$LINGVO.pickup_from_np_basket}
              </b>
            </div>
          </sl-radio>
        </sl-radio-group>

          {* Форма для самовивозу *}
          <div id="magazin-form" class="flex flex-column gap-24">
          <div class="form-grid">
            <div class="form-control">
              <sl-input name="picup_date" label="{$LINGVO.pickup_date}" type="date" placeholder="Date" value="{$smarty.now|date_format:"%Y.%m.%d"}"></sl-input>
            </div>
            <div class="form-control">
              <sl-select name="picup_time" placeholder="{$LINGVO.pickup_time}" label="{$LINGVO.pickup_time}">
                <sl-option value="09:00 - 11:00">09:00 - 11:00</sl-option>
                <sl-option value="11:00 - 14:00">11:00 - 14:00</sl-option>
                <sl-option value="14:00 - 17:00">14:00 - 17:00</sl-option>
                <sl-option value="17:00 - 19:00">17:00 - 19:00</sl-option>
              </sl-select>
            </div>
          </div>
          <div class="form-control">
            <sl-select name="picup_addr" placeholder="{$LINGVO.store_address}" label="{$LINGVO.store_address}" value="m1">
              <sl-option value="m1">{$LINGVO.kiev_addr}</sl-option>
              {**  <sl-option value="{$LINGVO.kiev_addr}">{$LINGVO.bsk_address_akhmatova}</sl-option>	**}
              </sl-select>
          </div>
        </div>          

          {* Форма для кур'єрської доставки *}
        <div id="courier-form" class="hidden flex flex-column gap-24">
          <div class="form-grid">
            <div class="form-control">
              <sl-input name="courier_city" label="{$LINGVO.city}" type="text" name="city" value="{$LINGVO.city_kiev}" placeholder="{$LINGVO.city}" readonly></sl-input>
            </div>
            <div class="form-control">
              <sl-checkbox id="another-city-checkbox">{$LINGVO.another_city}</sl-checkbox>
            </div>
          </div>
          <div class="form-grid">
            <div class="form-control">
              <sl-input name="courier_address" label="{$LINGVO.bsk_address}" type="text" placeholder="{$LINGVO.bsk_address}"></sl-input>
            </div>
            <div class="form-grid">
              <div class="form-control">
                <sl-input name="courier_dom" label="{$LINGVO.dom}" type="text" placeholder="{$LINGVO.dom}"></sl-input>
              </div>
              <div class="form-control">
                <sl-input name="courier_flat" label="{$LINGVO.flat}" type="text" placeholder="{$LINGVO.flat}"></sl-input>
              </div>
            </div>
          </div>
          <div class="form-grid">
            <div class="form-control">
              <sl-checkbox name="lift" id="lift-checkbox">Лифт</sl-checkbox>
            </div>
          </div>
        </div>

          {* Форма для Нова пошта *}
      <div id="nova-poshta-form" class="hidden">
          <div class="form-grid">
            <div class="form-control">
              <sl-input label="{$LINGVO.city}" type="text" name="np_city" placeholder="{$LINGVO.city}"></sl-input>
            </div>
            <div class="form-control">
              <sl-input label="{$LINGVO.np_number}" type="text" name="np_number" placeholder="{$LINGVO.np_number}"></sl-input>
            </div>
          </div>
        </div>

        <sl-alert variant="warning" data-name="small-order">
          <span slot="icon" class="icon icon-phone"></span>
            {$LINGVO.small_order}
          </sl-alert>
        <sl-alert variant="warning" data-name="not-nova-poshta">
          <span slot="icon" class="icon icon-info-circle"></span>
            {$LINGVO.sorry_but_not_np}
          </sl-alert>
        <sl-alert variant="warning" data-name="not-np-delivery" {if $BSK_STOP_POST_DELIVERY}open{/if}>
          <span slot="icon" class="icon icon-info-circle"></span>
            {$LINGVO.not_np_delivery}
          </sl-alert>

        <sl-alert variant="warning" data-name="city-delivery">
          <span slot="icon" class="icon icon-info-circle"></span>
            {$LINGVO.city_delivery}
          </sl-alert>

        <sl-alert variant="warning" data-name="delivery-biggoods">
          <span slot="icon" class="icon icon-info-circle"></span>
            {$LINGVO.notice_biggoods}
          </sl-alert>

        <sl-alert variant="warning" data-name="minimum-order" {if $BSK_TTL < $DELIVERY_OPTIONS.minimum_order}open{/if}>
            <span slot="icon" class="icon icon-info-circle"></span>
            {$LINGVO.minimumOrder} {$DELIVERY_OPTIONS.minimum_order} ₴.
            </sl-alert>

      </section>

      <section class="information__payment">
        <h2>3. {$LINGVO.bsk_way_to_pay}</h2>
        <sl-radio-group name="payment_way" value="{$LINGVO.bsk_cash}">
          <sl-radio value="{$LINGVO.bsk_cash}">
            <div class="radio-option" id="payment-cash-option">
              <img src="/img/icons/icon-cash.svg" alt="">
              <span data-text="cash">{$LINGVO.bsk_cash}</span>
              <span class="hidden" data-text="nova-poshta-money">{$LINGVO.nova_poshta_money}</span>
            </div>
          </sl-radio>
          <sl-radio value="{$LINGVO.bsk_pay_now}" {if $BSK_STOP_PRIVAT}disabled{/if}>
            <div class="radio-option">
              <img src="/img/icons/icon-card.svg" alt="">
              <span>{$LINGVO.bsk_pay_now}</span>
            </div>
          </sl-radio>
          <sl-radio value="{$LINGVO.bsk_beznal}">
            <div class="radio-option">
              <img src="/img/icons/icon-order.svg" alt="">
              <span>{$LINGVO.bsk_beznal}</span>
            </div>
          </sl-radio>
        </sl-radio-group>

        <sl-alert variant="warning" data-name="stop-privat" {if $BSK_STOP_PRIVAT}open{/if}>
          <span slot="icon" class="icon icon-info-circle"></span>
            {$LINGVO.bsk_stop_privatText}
          </sl-alert>

      </section>

      <section class="information__comment">
        <h2>4. {$LINGVO.bsk_comment}</h2>
        <div class="form-control">
          <sl-textarea name="comment" placeholder="{$LINGVO.comment_txt}"></sl-textarea>
        </div>
        <div class="form-control">
          <sl-checkbox name="additional_consulting">{$LINGVO.additional_consulting}</sl-checkbox>
        </div>
      </section>
    </div>
    <div class="cart-page__order-list">
      <section class="cart-page__order-list_section">
        <h2>{$LINGVO.goods_in_cart}</h2>
        <ul class="cart-items-list" id="basket-items-list">
              {foreach item=B from=$BASKET}
              <li class="cart-item" data-id="{$B.formID}">
            <div class="cart-item__image">
              <a href="{$B.href}">
                <img src="{$B.img}" alt="{$B.name}">
              </a>
            </div>
            <div class="cart-item__details">
              <button type="button" class="cart-item__remove">
                <svg class="icon icon-trash"/>
              </button>
              <h3>
                <a href="{$B.href}">{$B.name}</a>
              </h3>                

                {if $B.not_available}
                  <sl-tag class="cart-tag" variant="danger">{$LINGVO.bsk_preorder_good_text}</sl-tag>
                  <sl-tag class="cart-tag" variant="order">{$LINGVO.bsk_preorder_7_14_text}</sl-tag>
                {/if}
                
                <div class="cart-item__details_options">{$B.goodLegend}</div>
              <div class="cart-item__details_controls"> {** Dimon if you need - you can use this id="{$B.formID}"  **}
                  <quantity-counter value="{$B.cnt}" min="1"></quantity-counter>
                <div class="cart-item__details_price">{$B.price|number_format:2:'.':' '} ₴</div>
              </div>
            </div>
            <input type="hidden" name="price[{$B.formID}]" value="{$B.price|number_format:2:'.':' '}">
            <input type="hidden" name="cnt[{$B.formID}]" value="{$B.cnt}">
            <input type="hidden" name="sttl[{$B.formID}]" value="{($B.price * $B.cnt)|number_format:2:'.':' '}">
          </li>          
              {/foreach}
            </ul>
            {if $IS_BSK_PLANT || $IS_BSK_POT}
              <div class="form-control">
          <sl-checkbox name="peresadka" value="{$LINGVO.i_need_peresadka}">{$LINGVO.i_need_peresadka}</sl-checkbox>
        </div>
            {/if}
            <div class="cart-page__order-list_summary">
          <div class="summary__item">
            <div class="summary__item_label">{$LINGVO.goods_summa}:</div>
            <div class="summary__item_value" id="basket_totalprice">{$BSK_TTL|number_format:2:'.':' '} ₴</div>
          </div>
          <div class="summary__item">
            <div class="summary__item_label">
              <span class="summary__item_label hidden" data-text="np-cost">{$LINGVO.delivery_NP_cost}:</span>
              <span class="summary__item_label"  data-text="delivery-cost">{$LINGVO.delivery_cost}:</span>
            </div>
            <div class="summary__item_value" id="delivery-cost">0.00 ₴</div>
          </div>
          <div class="summary__item total">
            <div class="summary__item_label">                
                {$LINGVO.total_topay}:
                </div>
            <div class="summary__item_value" id="total-to-pay">{$BSK_TTL|number_format:2:'.':' '} ₴</div>
          </div>
        </div>
        <input type="hidden" name="basket_totalprice" id="input-hidden-basket_totalprice" value="{$BSK_TTL|number_format:2:'.':' '}">
        <input type="hidden" name="cost_delivery" id="input-hidden-cost_delivery" value="0.00">
        <input type="hidden" name="to_pay" id="input-hidden-to_pay" value="{$BSK_TTL|number_format:2:'.':' '}">

        <div class="cart-page__order-list_actions">
          <button class="button button--primary" name="send_bsk">{$LINGVO.confirm_order}</button>
          <!-- <sl-checkbox>Не передзвонюйте мені</sl-checkbox> -->
        </div>
      </section>
    </div>
  </div>
</form>


{elseif $ORDERED}

<p>&nbsp;</p>

<p>{$LINGVO.bsk_your_order_placed}.</p>
<p>&nbsp;</p>
<p>{$LINGVO.bsk_thank_your_for}.</p>
<p>&nbsp;</p>
<p>{$LINGVO.bsk_overloaded}</p>

{else}
<p>&nbsp;</p>

	{$LINGVO.your_basket_empty}

{/if}



</div>
</main>

{*
<ul>
  {foreach $LINGVO as $key => $val}
    <li>{$key} - {$val}</li>
  {/foreach}
</ul>
*}
<script>
const messages = {
smallOrderText: "{$LINGVO.small_order}",
bigGoodsText: "{$LINGVO.notice_biggoods}",
notNpWarningText: "{$LINGVO.sorry_but_not_np}",
notNpText: "{$LINGVO.not_np_delivery}",
npDeliveryText: "{$LINGVO.notice_nptarif}",
paymentTextNp: "{$LINGVO.nova_poshta_money}",
paymentTextCash: "{$LINGVO.bsk_cash}",
moneyFreezeText: "{$LINGVO.money_freeze}",
lessZeroText: "{$LINGVO.less_zero}",
cityDeliveryText: "{$LINGVO.city_delivery}",
elevatorPriceText: "{$LINGVO.elevator_price}",
minimumOrderText: "{$LINGVO.minimumOrder}"
};

const defaultOptions = {
courierDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_std}"),

fastDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_fast_delivery}"),

exactTimeDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_exact_delivery}"),

earlyDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_early_delivery}"),

lateDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_late_delivery}"),

smallOrder: parseFloat("{$DELIVERY_OPTIONS.small_order}"),

smallOrderDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.small_order_delivery}"),

minimumOrderDelivery: parseFloat("{$DELIVERY_OPTIONS.minimum_bid}"),

delivery: 'magazin',

payment: 'cash',

cityKiev: "{$LINGVO.city_kiev}",

novaPostaCost: 45
};

const cartState = {
productPrice: parseFloat("{$BSK_TTL}"),
isPlant: parseFloat("{$IS_BSK_PLANT}"),
stopPostDelivery: parseFloat("{$BSK_STOP_POST_DELIVERY}"),
notKiev: false,
bigGoodCourier: parseFloat("{$BSK_BIG_GOOD_COURIER}"),
stopPrivat: parseFloat("{$BSK_STOP_PRIVAT}")
}
</script>