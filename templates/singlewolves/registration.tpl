            [registration]
				<div id='dle-content'><form  method="post" name="registration" onsubmit="if (!check_reg_daten()) {return false;};" id="registration" action="">
<style type="text/css">
table.form2.reg input[type='text'], table.form2.reg input[type='password'] { font-size: 15px; padding: 4px; width: 300px; }
table.form2.reg tr > td:first-child { width: 30%; }
</style>
<div class="pheading"><h2>Регистрация</h2></div>

<div class="steps">
	<div class="step active">
		<span class="n">1.</span>
		Регистрация
	</div>
	<div class="step ">
		<span class="n">2.</span>
		Дополнительная информация
	</div>
</div>

<div class="ui-box grey">
	<table class="form2 reg">
	
		<tr>
			<td class="label">
				Ник (логин):
			</td>
			<td>
				<input type="text" name="name" id="name" class="f_input" />
				<button class="button blue hint" title="Проверить доступность ника для регистрации" onclick="CheckLogin(); return false;" type="button">Проверить</button>
				<div id="result-registration"></div>
				<div class="grey small">Может состоят только из латинских букв, цифр и знака подчёркивания.</div>
				<div class="ui-box blue">
					В дальнейшем ник сменить будет нельзя, поэтому внимательно отнеситесь к его выбору.<br />
					<abbr title="Привязка имущества, приватов статистики и т.п. и игре осуществляется по нику. Поэтому, его смена приведёт к потере доступа к имуществу и приватам." class="whelp">Почему изменение ника невозможно?</abbr>
				</div>
			</td>
		</tr>
		<tr>
			<td class="label">
				Пароль:
			</td>
			<td>
				<input type="password" name="password1" class="f_input" />
				<div class="grey small">Придумайте хороший пароль. Это снизит вероятность взлома вагего аккаунта.</div>
			</td>
		</tr>
		<tr>
			<td class="label">
				Повторите пароль:
			</td>
			<td>
				<input type="password" name="password2" class="f_input" />
				<div class="grey small">Необходимо убедиться в правильности ввода пароля.</div>
			</td>
		</tr>
		<tr>
			<td class="label">
				Ваш E-Mail:
			</td>
			<td>
				<input type="text" name="email" class="f_input" />
				<div class="grey small">Пожалуйста, введите здесь Ваш реальный e-mail. На этот адрес будет выслано письмо со ссылкой для подтверждения регистрации.</div>
			</td>
		</tr>

		[sec_code]
		<tr>
			<td class="label">
				Введите код<br />с картинки:<span class="impot">*</span>
			</td>
			<td>
				<div>{reg_code}</div>
				<div><input type="text" name="sec_code" style="width:115px" class="f_input" /></div>
			</td>
		</tr>
		[/sec_code]
		[recaptcha]
		<tr>
			<td class="label">
				Введите два слова, показанных на изображении:<span class="impot">*</span>
			</td>
			<td>
            <div><span id=\"dle-captcha\"><input type="hidden" name="sec_code" id="sec_code" value="false" />
				{recaptcha}
                </span></div>
			</td>
		</tr>
		[/recaptcha]        
        
		<tr>
			<td></td>
			<td><i>Регистрируясь Вы подтверждаете своё согласие с <a href="/rules.html" target="_blank">правилами сервера</a>.</i></td>
		</tr>
	
	
		<tr>
			<td></td>
			<td><button name="submit" id="reg_sub" style="min-width: 90px;" class="button" type="submit"><span>Зарегистрироваться</span></button></td>
		</tr>
	</table>
</div></div>
  <script>
$(function(){
	$("#reg_sub").click(function(){
		var e = false;
		var iname = $("form input[name='name']");
		var ipwd1 = $("form input[name='password1']");
		var ipwd2 = $("form input[name='password2']");
		var imail = $("form input[name='email']");
		if(! iname.val()){
			iname.addClass("error");
			e = true;
		}
		if(! iname.val()){
			iname.addClass("error");
			e = true;
		}
		if(! ipwd1.val()){
			ipwd1.addClass("error");
			e = true;
		}
		if(! ipwd2.val()){
			ipwd2.addClass("error");
			e = true;
		}
		if(! imail.val()){
			imail.addClass("error");
			e = true;
		}
		if(e){
			displayMessage("Не все поля заполнены", "error");
			return false;
		}
		if(ipwd1.val().length < 6){
			ipwd1.addClass("error");
			displayMessage("Минимальная длина пароля - 6 символов", "error");
			return false;
		}
		if(ipwd1.val() != ipwd2.val()){
			ipwd1.addClass("error");
			ipwd2.addClass("error");
			displayMessage("Введённые пароли не совпадают", "error");
			return false;
		}
	});
	$("table.form2.reg input[type='text'], table.form2.reg input[type='password']").keydown(function(){
		$(this).change();
	}).change(function(){
		$(this).removeClass("error");
	});
})
</script>                  
[/registration]

[validation]
				<div id='dle-content'><form  method="post" name="registration" enctype="multipart/form-data" action="">
<style type="text/css">
table.form2.reg input[type='text'], table.form2.reg input[type='password'] { font-size: 15px; padding: 4px; width: 300px; }
table.form2.reg tr > td:first-child { width: 30%; }
</style>
<div class="pheading"><h2>Регистрация</h2></div>

<div class="steps">
	<div class="step ready">
		<span class="n">1.</span>
		Регистрация
	</div>
	<div class="step active">
		<span class="n">2.</span>
		Дополнительная информация
	</div>
</div>

<div class="ui-box grey">
	<table class="form2 reg">
	
	
		<tr>
			<td colspan="2">
				<div class="ui-box green" style="text-align: left;">Заполнять поля на этой странице необязательно. Чтобы пропустить - нажмите кнопку "Готово". В дальнейшем эту информацию можно будет изменить в настройках аккаунта.</div>
			</td>
		</tr>
		<tr>
			<td class="label">Имя:</td>
			<td>
				<input type="text" name="fullname" class="f_input" />
				<div class="grey small">Как Вас зовут?</div>
			</td>
		</tr>
		<tr>
			<td class="label">Место жительства:</td>
			<td>
				<input type="text" name="land" class="f_input" />
				<div class="grey small">Страна, населённый пункт.</div>
			</td>
		</tr>
		<tr>
			<td class="label">Ваш Skype:</td>
			<td>
				<input type="text" name="icq" class="f_input" />
				<div class="grey small">Логин Skype. Отображается в вашем профиле.</div>
			</td>
		</tr>
		<tr>
			<td class="label">Аватар:</td>
			<td>
				<input type="file" name="image" class="f_input" />
				<div class="grey small">Отображается в профиле и рядом с вашими комментариями.</div>
			</td>
		</tr>
		<tr>
			<td class="label" style="vertical-align: middle;">О себе:</td>
			<td>
				<textarea name="info" style="width: 300px; height: 100px;" class="f_textarea" /></textarea>
				<div class="grey small">Кто Вы?</div>
			</td>
		</tr>
		
	
		<tr>
			<td></td>
			<td><button name="submit" id="" style="min-width: 90px;" class="button" type="submit"><span>Готово</span></button></td>
		</tr>
	</table>
</div>
</div>

[/validation]
