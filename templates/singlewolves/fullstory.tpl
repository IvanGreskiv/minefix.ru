<article class="post">
	<div class="post-date right">
		<div class="d">{date=d}</div>
		<div class="m">{date=F}</div>
		<div class="y">{date=y}</div>
	</div>
	<h3>{title}</h3>
	<div class="maincont">
	{full-story}
	</div>
	<a href="javascript:history.go(-1)" class="button">Назад</a>
	<ul class="pdetails">
		<li><span>Просмотры:</span> <b>{views}</b></li>
		<li><span>Комментарии:</span> <b>{comments-num}</</b></li>
	</ul>
</article>
[group=5]
<div class="berrors"><div class="berrors">
	Уважаемый посетитель, Вы зашли на сайт как незарегистрированный пользователь.<br />
	Мы рекомендуем Вам <a href="/index.php?do=register">зарегистрироваться</a> либо войти на сайт под своим именем.
</div></div>
[/group]
[poll]<li><a href="#tabln2"><b>Опрос к статье</b></a></li>[/poll]
		[poll]<div class="tabcont" id="tabln2">
		{poll}
	</div>[/poll]
<h2>Комментарии</h2>
{comments}
{navigation}
{addcomments}