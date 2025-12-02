<b>Заказ #{$ORDER_ID}</b>
{if $PAYMENT_STATUS=="success"}
<b>Заказ оплачен.</b>
<b>Status Code:</b> {$PAYMENT_STATUS}
{elseif $PAYMENT_STATUS=='hold_wait'}
<b>Заказ оплачен. Требуется списание после доставки</b>
<b>Status Code:</b> {$PAYMENT_STATUS}
{else}
<b>Оплата не прошла</b>
<b>Status Code:</b> {$PAYMENT_STATUS}
{/if}