<main class="cart-page">
    <div class="container">
      <h1 class="cart-page__title">{$PAGE_TITLE}</h1>
      <div class="cart-page__grid">
        
        <div class="cart-page__order-information">
          <section class="information__contact">
            <div class="information__grid">
              <form class="information__contact_form">
                <h2>1. {$LINGVO.contact_data}</h2>
                <div class="form-grid">
                  <div class="form-control">
                    <sl-input label="{$LINGVO.fb_name}" placeholder="{$LINGVO.fb_name}"></sl-input>
                  </div>
                  <div class="form-control">
                    <label for="phone">Ваш телефон</label>
                    <input id="phone" data-tel-input type="tel">
                  </div>
                </div>
                <div class="form-control">
                  <sl-input label="E-mail" type="email" placeholder="E-mail"></sl-input>
                </div>
                <div class="form-control form-control--checkbox">
                  <h3>{$LINGVO.rec_data}</h3>
                  <sl-checkbox>{$LINGVO.iam_rec}</sl-checkbox>
                </div>
                <div class="form-grid">
                  <div class="form-control">
                    <sl-input label="{$LINGVO.fb_name}" placeholder="{$LINGVO.fb_name}"></sl-input>
                  </div>
                  <div class="form-control">
                    <label for="phone">{$LINGVO.rec_phone}</label>
                    <input id="phone" data-tel-input type="tel">
                  </div>
                </div>
              </form>
{** **}
              <div class="information__contact_login">
                <svg class="icon icon-user"/>
                <p>{$LINGVO.if_not_registered}</p>
                <a href="#" class="button button--outline">{$LINGVO.button_enter}</a>
                <a href="#" class="underline">{$LINGVO.user_register}</a>
              </div>
{** **}
            </div>
          </section>

          <section class="information__shipping">
            <h2>2. {$LINGVO.way_to_deliver}</h2>
            <sl-radio-group name="shipping" value="1">
              <sl-radio value="1">
                <div class="radio-option">
                  <img src="/img/icons/icon-post.svg" alt="">
                  <span>{$LINGVO.kiev_addr}</span>
                  <b>{$LINGVO.free}</b>
                </div>
              </sl-radio>
              <sl-radio value="2">
                <div class="radio-option">
                  <img src="/img/icons/icon-track.svg" alt="">
                  <span>{$LINGVO.courier}</span>
                  <b>{$LINGVO.txt_vid} {$DELIVERY_OPTIONS.courier_std} <sup>грн</sup>
                  </b>
                </div>
              </sl-radio>
              <sl-radio value="3">
                <div class="radio-option">
                  <img src="/img/icons/icon-nova-poshta.svg" alt="">
                  <span>{$LINGVO.pickup_from_np}</span>
                  <b>{$LINGVO.pickup_from_np_basket}<sup>грн</sup>
                  </b>
                </div>
              </sl-radio>
            </sl-radio-group>
            <div class="form-grid">
              <div class="form-control">
                <sl-input label="{$LINGVO.pickup_date}" type="date" placeholder="Date" value="{$smarty.now|date_format:"%Y.%m.%d"}"></sl-input>
              </div>
              <div class="form-control">
                <sl-select placeholder="{$LINGVO.pickup_time}" label="{$LINGVO.pickup_time}">
                  <sl-option value="09:00 - 11:00">09:00 - 11:00</sl-option>
                  <sl-option value="11:00 - 14:00">11:00 - 14:00</sl-option>
                  <sl-option value="14:00 - 17:00">14:00 - 17:00</sl-option>
                  <sl-option value="17:00 - 19:00">17:00 - 19:00</sl-option>
                </sl-select>
              </div>
            </div>
            <div class="form-control">
              <sl-select placeholder="{$LINGVO.store_address}" label="{$LINGVO.store_address}" value="1">
                <sl-option value="1">{$LINGVO.kiev_addr}</sl-option>
              {**  <sl-option value="{$LINGVO.kiev_addr}">{$LINGVO.bsk_address_akhmatova}</sl-option>	**}
              </sl-select>
            </div>
          </section>

          <section class="information__payment">
            <h2>3. {$LINGVO.bsk_way_to_pay}</h2>
            <sl-radio-group name="payment" value="1">
              <sl-radio value="1">
                <div class="radio-option">
                  <img src="/img/icons/icon-cash.svg" alt="">
                  <span>{$LINGVO.bsk_cash}</span>
                </div>
              </sl-radio>
              <sl-radio value="2">
                <div class="radio-option">
                  <img src="/img/icons/icon-card.svg" alt="">
                  <span>{$LINGVO.bsk_pay_now}</span>
                </div>
              </sl-radio>
              <sl-radio value="3">
                <div class="radio-option">
                  <img src="/img/icons/icon-order.svg" alt="">
                  <span>{$LINGVO.bsk_beznal}</span>
                </div>
              </sl-radio>
            </sl-radio-group>
          </section>

          <section class="information__comment">
            <h2>4. {$LINGVO.bsk_comment}</h2>
            <div class="form-control">
              <sl-textarea placeholder="{$LINGVO.comment_txt}"></sl-textarea>
            </div>
            <div class="form-control">
              <sl-checkbox>{$LINGVO.additional_consulting}</sl-checkbox>
            </div>
          </section>
        </div>
        <div class="cart-page__order-list">
          <section class="cart-page__order-list_section">
            <h2>{$LINGVO.goods_in_cart}</h2>
            <ul class="cart-items-list">
              {foreach item=B from=$BASKET}
              <li class="cart-item">
                <div class="cart-item__image">
                  <a href="{$B.href}">
                    <img src="{$B.img}" alt="{$B.name}">
                  </a>
                </div>
                <div class="cart-item__details">
                  <button class="cart-item__remove">
                    <svg class="icon icon-trash" />
                  </button>
                  <h3>
                    <a href="{$B.href}">{$B.name}</a>
                  </h3>
                  <div class="cart-item__details_options">{$B.goodLegend}</div>
                  <div class="cart-item__details_controls"> {** Dimon if you need - you can use this id="{$B.formID}"  **}
                    <div class="counter-input">
                      <button>
                        <img src="/img/icons/icon-minus.svg" alt="{$LINGVO.bsk_del_one}" />
                      </button>
                      <input type="number" value="{$B.cnt}" min="1" />
                      <button>
                        <img src="/img/icons/icon-plus.svg" alt="{$LINGVO.bsk_add_one}" />
                      </button>
                    </div>
                    <div class="cart-item__details_price">{$B.price|number_format:2:'.':' '} ₴</div>
                  </div>
                </div>
              </li>
              {/foreach}
            </ul>
            {if $IS_BSK_PLANT || $IS_BSK_POT}
            <div class="form-control">
              <sl-checkbox>{$LINGVO.i_need_peresadka}</sl-checkbox>
            </div>
            {/if}
            <div class="cart-page__order-list_summary">
              <div class="summary__item">
                <div class="summary__item_label">{$LINGVO.goods_summa}:</div>
                <div class="summary__item_value">{$BSK_TTL|number_format:2:'.':' '} ₴</div>
              </div>
              <div class="summary__item">
                <div class="summary__item_label">{$LINGVO.delivery_cost}:</div>
                <div class="summary__item_value">0 ₴</div>
              </div>
              <div class="summary__item total">
                <div class="summary__item_label">{$LINGVO.total_topay}:</div>
                <div class="summary__item_value">900 ₴</div>
              </div>
            </div>
            <div class="cart-page__order-list_actions">
              <button class="button button--primary">{$LINGVO.confirm_order}</button>
              <!-- <sl-checkbox>Не передзвонюйте мені</sl-checkbox> -->
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>
  <script>
    const messages = {literal}{{/literal}
            smallOrderText: "{$LINGVO.small_order}",				{** + **}
            bigGoodsText: "{$LINGVO.notice_biggoods}",			{** + **}
            notNpWarningText: "{$LINGVO.sorry_but_not_np}",	{** + **}
            notNpText: "{$LINGVO.not_np_delivery}"					{** + **} 
            npDeliveryText: "{$LINGVO.notice_nptarif}",			{** – **}
            paymentTextNp: "{$LINGVO.nova_poshta_money}",		{** + **}
            paymentTextCash: "{$LINGVO.bsk_cash}",					{** + **}
            moneyFreezeText: "{$LINGVO.money_freeze}",			{** – **}
            lessZeroText: "{$LINGVO.less_zero}",						{** + **}
            cityDeliveryText: "{$LINGVO.city_delivery}",		{** + **}
            elevatorPriceText: "{$LINGVO.elevator_price}", 	{** – **}
            minimumOrderText: "{$LINGVO.minimumOrder}", 	{** – **}
        {literal}}{/literal};

    const defaultOptions = {literal}{{/literal}
            courierDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_std}"),							{** + **}
            fastDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_fast_delivery}"),				{** – **}
            exactTimeDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_exact_delivery}"),	{** – **}
            earlyDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_early_delivery}"),			{** – **}
            lateDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.courier_late_delivery}"),				{** – **}
            smallOrder: parseFloat("{$DELIVERY_OPTIONS.small_order}"),												{** + **}
            smallOrderDeliveryPrice: parseFloat("{$DELIVERY_OPTIONS.small_order_delivery}"),	{** + **}
            minimumOrderDelivery: parseFloat("{$DELIVERY_OPTIONS.minimum_order}"),						{** + **}
            delivery: 'magazin',																															{** + **}
            payment: 'cash',																																	{** + **}
        {literal}}{/literal};

  </script>