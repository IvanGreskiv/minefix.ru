[not-group=5]
<h2>{login}</h2>
		<div class="pavatar">
			<a href="{profile-link}"><img src="{foto}" alt="{login}" /></a>
		</div>
		<div class="plinks">
		[admin-link]<a href="{admin-link}" target="_blank">Админпанель</a>[/admin-link]
			[admin-link]<a href="/addnews.html">Добавить новость</a>[/admin-link]
            [admin-link]<a href="http://drr.sytes.net/panel/admin/index.php" target="_blank">Панель.упр</a>[/admin-link]
			<a href="{pm-link}">ЛС <span class="pmCounter"> {new-pm}</span></a>
			<a href="/shop.html">Магазин</a>
            <a href="/banlist.html">БанЛист</a>
		</div>
		<div class="clear"></div>
		<div align="center" style="min-width: 10px;">
			<a href="/cabinet.html" class="buttons">Личный кабинет</a>
			<a href="{logout-link}" style="min-width: 10px;" class="buttons blue">Выход</a>
		</div>

[/not-group]
[group=5]
	<h2>Авторизация</h2>
	<div class="loginInputs">
		<form action="" method="post">
			<input type="text" class="input" placeholder="{login-method}" name="login_name" id="login_name" /><br />
			<input type="password" class="input" placeholder="Пароль" name="login_password" id="login_password" />
			<input name="login" type="hidden" id="login" value="submit" />
			<div class="controls">
				<button class="greenbtn"onclick="submit();" type="submit">Войти</button>
				<div class="links">
					<a href="{registration-link}">Регистрация</a> :: 
					<a href="{lostpassword-link}">Забыл пароль</a>
				</div>
			</div>
		</form>
	</div>
[/group]