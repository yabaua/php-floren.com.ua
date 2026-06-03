
{if $ERROR}
<p style="color:red">
	<b>{$LINGVO.oups_error}</b>
	<br />
<p>
{/if}
{if $ERROR}
	<ul class="errors">
	{foreach item=E from=$ERROR}
		<li>{$E}</li>
	{/foreach}
	</ul>
{/if}

{if !$URL[1]}
<h1 style="margin:0 auto">{$LINGVO.user_login}</h1>
<form name="login" action="{$LANGURL}/login/" method="POST">
<input type="hidden" name="action_type" value="login">
<div class='basket__data' style="margin: 0 auto">
	<ul class="basket__contacts">
		<li class="basket__field">
			<input type="email" name="email" id="email" autocomplete="off" tabindex="1">
			<label for="email">e-mail</label>
		</li>
		<li class="basket__field">
			<input type="password" name="pass" id="pass" autocomplete="off" tabindex="2" required>
			<label for="pass">{$LINGVO.user_password}</label>
		</li>
		<li style="padding-left:23%"><a href="#" style="color:#777777;font-size:0.9em">Забули пароль?</a></li>		
	</ul>
	<input type="submit" id="basket_submit" class="button_accent" tabindex="3" name="send_bsk" value="{$LINGVO.user_login}" align="center"> <a href="{$LANGURL}/login/registration/" style="margin-left:5%">{$LINGVO.user_register}</a>
</div>
</form>
{/if}
{**	================================================= **}
{if $URL[1]=='registration'}
<h1 style="margin:0 auto">{$LINGVO.user_register}</h1>
<form name="register" action="{$LANGURL}/login/" method="POST">
<input type="hidden" name="action_type" value="registration">
<div class='basket__data' style="margin: 0 auto">
	<ul class="basket__contacts">
		<li class="basket__field">
			<input type="text" name="fio" id="fio" autocomplete="off" tabindex="1" value="{$fio}" required>
			<label for="user_name">{$LINGVO.fb_name} <span class="red-star">*</span></label>
		</li>
		<li class="basket__field">
			<input type="email" name="email" id="email" autocomplete="off" tabindex="2" value="{$email}" required>
			<label for="email">e-mail <span class="red-star">*</span></label>
		</li>
		<li class="basket__field">
			<input type="password" name="pass" id="pass" autocomplete="off" tabindex="3" required>
			<label for="pass">{$LINGVO.user_password} <span class="red-star">*</span></label>
		</li>
		<li class="basket__field">
			<input type="password" name="pass2" id="pass2" autocomplete="off" tabindex="4" required>
			<label for="pass2">{$LINGVO.user_password2} <span class="red-star">*</span></label>
		</li>
		<li class="basket__field">
        {literal}
            <input type="hidden" name="phone" data-field>
            <input type="tel" class="inp-wdt" id="phone" autocomplete="off" tabindex="5" data-valid>
            <label for="phone">Телефон</label>
        {/literal}
        </li>
	</ul>
	<input type="submit" id="basket_submit" class="button_accent" tabindex="6" name="send_bsk" value="{$LINGVO.user_register}" align="center"><a href="{$LANGURL}/login/" style="margin-left:5%">{$LINGVO.user_login}</a>
</div>
</form>
{/if}
{**	================================================= **}
{if $URL[1]=='forget'}
zzzz
{/if}