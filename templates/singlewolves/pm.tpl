<a class="button right" href="/index.php?do=pm&doaction=newpm">Написать сообщение</a>
<h2>Личные сообщения</h2>
[newpm]
<div class="tabs" style="padding-right: 0;">
<div class="pm_status">
	{pm-progress-bar}{proc-pm-limit}% 
	от лимита ({pm-limit} сообщений)
</div>
	<a href="/index.php?do=pm" class="tab">Входящие</a>
	<a href="/index.php?do=pm&folder=outbox" class="tab">Отправленные</a>
	<span class="tab active">Новое сообщение</span>
</div>

<div class="baseform">
	<table class="tableform">
		<tr> 
			<td class="label">
				Кому:
			</td>
			<td><input type="text" name="name" value="{author}" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label">
				Тема:<span class="impot">*</span>
			</td>
			<td><input type="text" name="subj" value="{subj}" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label">
				Сообщение:<span class="impot">*</span>
			</td>
			<td class="comments-editor">
			{editor}<br />
			<div class="checkbox"><input type="checkbox" id="outboxcopy" name="outboxcopy" value="1" /> <label for="outboxcopy">Сохранить сообщение в папке "Отправленные"</label></div>
			</td>
		[sec_code]
		<tr>
			<td class="label">
				Код:<span class="impot">*</span>
			</td>
			<td>
				<div>{sec_code}</div>
				<div><input type="text" name="sec_code" id="sec_code" style="width:115px" class="f_input" /></div>
			</td>
		</tr>
		[/sec_code]
		[recaptcha]
		<tr>
			<td class="label">
				Введите два слова, показанных на изображении:<span class="impot">*</span>
			</td>
			<td>
				<div>{recaptcha}</div>
			</td>
		</tr>
		[/recaptcha]
		[question]
			<tr>
				<td class="label">
					Вопрос:
				</td>
				<td>
					<div>{question}</div>
				</td>
			</tr>
			<tr>
				<td class="label">
					Ответ:<span class="impot">*</span>
				</td>
				<td>
					<div><input type="text" name="question_answer" id="question_answer" class="f_input" /></div>
				</td>
			</tr>
		[/question]
	</table>
	<div class="fieldsubmit">
		<button type="submit" name="add" class="button"><span>Отправить</span></button>
		<input type="button" class="button blue" onclick="dlePMPreview()" title="Просмотр" value="Просмотр" />
	</div>	
</div>

[/newpm]

[readpm]

<div class="tabs" style="padding-right: 0;">
<div class="pm_status">
	{pm-progress-bar}{proc-pm-limit}% 
	от лимита ({pm-limit} сообщений)
</div>
	<a href="/index.php?do=pm" class="tab">Входящие</a>
	<a href="/index.php?do=pm&folder=outbox" class="tab">Отправленные</a>
	
	<span class="tab active">Просмотр сообщения</span>
</div>
<div class="bcomment">
	<div class="lcol">
		<span><img src="{foto}" alt=""/></span>
	</div>
	<div class="rcol">
		<h4>{author}</h4>
		<span>{date}</span>
		<div class="comment">
			{text}
			<ul class="actions">
				<li>[reply]<b>Ответить</b>[/reply]</li>
				<li>[complaint]Пожаловаться[/complaint]</li>
				<li>[ignore]Игнорировать[/ignore]</li>
				<li>[del]Удалить[/del]</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>

[/readpm]

[pmlist]

<div class="tabs" style="padding-right: 0;">
<div class="pm_status">
	{pm-progress-bar}{proc-pm-limit}% 
	от лимита ({pm-limit} сообщений)
</div>
	<a href="/index.php?do=pm" class="tab">Входящие</a>
	<a href="/index.php?do=pm&folder=outbox" class="tab active">Отправленные</a>
</div>
<div class="dpad">{pmlist}</div>

[/pmlist]