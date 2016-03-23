[profile]
<div class="pheading">
    <h2 class="lcol"><span>{usertitle}</span></h2>
</div>
<div class="basecont"><div class="dpad">
	<div class="userinfo">
		<div class="lcol">
			<div class="avatar"><img style="width: 100%; height: 100%;" src="{foto}" alt=""/></div>
			<ul class="reset">
				<li>{email}</li>
[not-group=5]
				<li>{pm}</li>
				[/not-group]
			</ul>
		</div>
		<div class="rcol">
			<ul>
				<li><span class="grey">Полное имя:</span> <b>{fullname}</b></li>
				<li><span class="grey">Группа:</span> {status} [time_limit]&nbsp;В группе до: {time_limit}[/time_limit]</li>
				<li><span class="grey">Skype:</span> <b>{icq}</b></li>
			</ul>
			<ul class="ussep">
				<li><span class="grey">Количество публикаций:</span> <b>{news-num}</b> [ {news} ][rss]<img src="{THEME}/images/rss.png" alt="rss" style="vertical-align: middle; margin-left: 5px;" />[/rss]</li>
				<li><span class="grey">Количество комментариев:</span> <b>{comm-num}</b> [ {comments} ]</li>
				<li><span class="grey">Дата регистрации:</span> <b>{registration}</b></li>
				<li><span class="grey">Последнее посещение:</span> <b>{lastdate}</b></li>
                <li><span class="grey">Статус: [online]</span><span class="badge green">Online</span>[online]</li> <li><span class="grey"> [offline][/online]</span><span class="badge">Offline</span>[/offline]</li>
			</ul>
			<ul class="ussep">
				<li><span class="grey">Место жительства:</span> {land}</li>
				<li><span class="grey">Немного о себе:</span> {info}</li>
			</ul>
			[not-logged]			<br /><a class="button blue" href="settings/">Редактировать профиль</a>[/not-logged]
		</div>
		<div class="clr"></div>
	</div>
</div></div>
[not-logged]
	<br /><br />
	<div class="baseform">
		<div class="fieldsubmit">
		</div>
</div>
[/not-logged]
[/profile]

[settings]
<div class="pheading">
	<h2 class="lcol"><span>Настройки</span></h2>
</div>
<center><div class="ui-box green">Это страница настроек вашего <b>аккаунта.</b></div></center>

<div class="basecont"><div class="dpad">
	<div class="userinfo">
		<div class="lcol">
		</div>
		<div class="clr"></div>
	</div>
</div></div>
[not-logged]
	<div class="baseform">
		<tr class="h"><td colspan="2"><h4>Информация о Вас</h4></td></tr>
		<table class="form2 setting">
			<tr>
				<td class="label"> Имя:</td>
				<td><input type="text" name="fullname" value="{fullname}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Место жительства:</td>
				<td><input type="text" name="land" value="{land}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Аватар:</td>
				<td>Загрузить с компьютера: <input type="file" name="image" class="f_input" /><br />
				<input type="hidden" name="gravatar" value="{gravatar}" class="f_input" />
				<div class="checkbox"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">Удалить аватар</label></div>
				</td>
			</tr>
			<tr>
			<td class="label">О себе:</td>
				<td><textarea name="info" rows="5" class="f_textarea">{editinfo}</textarea></td>
			</tr>
		</table>
		<tr class="h"><td colspan="2"><h4>Контакты</h4></td></tr>
		<table class="form2 setting">
			<tr>
				<td class="label"><br>Ваш E-Mail:</td>
				<td><input type="text" name="email" value="{editmail}" class="f_input" /><br />
				<div class="checkbox">{hidemail}</div>
				<div class="checkbox"><input type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">Отписаться от подписанных новостей</label></div></td>
			</tr>
			<tr>
				<td class="label">Skype:</td>
              <td><input type="text" name="icq" value="{icq}" class="f_input" /></td>
			</tr>
		</table>
		<tr class="h"><td colspan="2"><h4>Безопасность</h4></td></tr>
		<table class="form2 setting">
			<tr>
				<td class="label">Старый пароль:</td>
				<td><input type="password" name="altpass" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Новый пароль:</td>
				<td><input type="password" name="password1" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Повторите:</td>
				<td><input type="password" name="password2" class="f_input" /></td>
			</tr>
		</table>
		<tr class="h"><td colspan="2"><h4>Дополнительно</h4></td></tr>
		<table class="form2 setting">
			<tr>
				<td class="label">Подпись:</td>
				<td><textarea name="signature" rows="5" class="f_textarea">{editsignature}</textarea></td>
			</tr>
			{xfields}
		</table>
		<tr>
			<td></td>
			<td><center><input class="button" type="submit" name="submit" value="Сохранить" /></center></td>
		</tr>
</div>
[/not-logged]
[/settings]