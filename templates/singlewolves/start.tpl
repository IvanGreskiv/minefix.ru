<div id='dle-content'><style type="text/css">
.content { margin-right: 0; }
.sidebar { display: none; }
.mainBox { background-image: none; }
.label1 { text-align: center; font-size: 30px; line-height: 100%; }
.label2 { text-align: center; font-size: 18px; }
.boxes { color: #666; padding: 15px 0; }
.boxes > div { float: left; width: 32%; }
.boxes > div.middle { width: 36%; }
.boxes .box { 
	font-size: 13px; 
	padding: 0 10px;
}
.boxes > div.middle .box {
	border: 2px solid #E5E5E5;
	border-width: 0 1px 0 1px;
}
.boxes h3 { font-size: 22px; color: #444; }
</style>

<div class="label1">Всего 3 простых шага</div>
<div class="label2">чтобы начать играть на наших серверах.</div>

<div class="hr"></div>

<div class="boxes">
	<div>
		<div class="box">
			<div align="center">
				<img src="/templates/singlewolves/images/register_icon.png" alt="Иконка" />
				<h3><span>1.</span> Регистрация</h3>
			</div>			
			На всех наших серверах используется собственная система авторизации, поэтому Вам
			необходимо сначала создать аккаунт.
			<br /><br />
			
			
			<ol>[group=5]
				<li>Ознакомьтесь с <a href="/rules.html">правилами сервера</a>.</li>
				<li>Пройдите <a href="/?do=reg">регистрацию</a>.</li>
				<li>При желании Вы можете установить скин. Для этого авторизуйтесь на сайте, затем перейдите в <a href="/lk/">личный кабинет</a>.</li>
			</ol>[/group]
           [not-group=5]<div class="ui-box blue">Вы уже выполнили этот шаг.</div>[/not-group]
			
		</div>
	</div>
	<div class="middle">
		<div class="box">
			<div align="center">
				<img src="/templates/singlewolves/images/download_icon.png" alt="Иконка" />
				<h3><span>2.</span> Загрузка лаунчера</h3>
			</div>
			Для игры на наших серверах потребуется специальный клиент, настроенный под наши сервера.
			Лаунчер поможет Вам его загрузить и запустить. Никаких модификаций на клиент устанавливать самостоятельно не нужно.
			<div style="margin: 5px auto; width: 250px;">
                <a href="/templates/sw.exe" class="dlButton">
					<span>Загрузить лаунчер (*.exe)</span>Только Windows
					</a>
				<a href="/server/files/program/sw.jar" class="dlButton">
					<span>Загрузить лаунчер (*.jar)</span>Кроссплатформенный
				</a>
			</div>
			
			<div class="ui-box green">Загрузите лаунчер, введите свой логин и пароль (указанные при регистрации) и запустите игру.</div>
			<br />
			
			<ul class="dots">
				<li>Для запуска игры Вам необходимо иметь установленную <abbr class="whelp" data-src-obj="#helpjava">Java (JRE)</abbr> на компьютере. Самую последнюю версию можно загрузить с <a href="http://java.com/ru/download/manual.jsp" target="_blank">официального сайта</a>.</li>
				<li>Ваш антивирус может ругаться на лаунчер из-за обфуксации кода (защита от взлома лаунчера). Не беспокойтесь, вирусов в лаунчере нет.</li>
			</ul>
			
			<div id="helpjava" style="display:none;">Требуется Java 7-й и выше версии. Для Windows x64 рекомендуется устанавливать Java обоих разрядностей (32-bit и 64-bit).</div>
			
		</div>
	</div>
	<div>
		<div class="box">
			<div align="center">
				<img src="/templates/singlewolves/images/computer_icon.png" alt="Иконка" />
				<h3><span>3.</span> Играть</h3>
			</div>
			Когда все предыдущие этапы пройдены, Вы можете начать играть на наших серверах. В выборе сервера 
			для игры вам поможет ссылка "Описание серверов".
			<br /><br />
			<div class="ui-box green">
				<ul class="dots">
					<li><a href="/bonus.html">Голосуйте за Single Wolves</a> и получайте бонусы. А ещё у Вас есть шанс получить платны
					е услуги совершенно бесплатно!</li>
					<li>А ещё приглашайте своих друзей. Вместе играть будет интереснее :)</li>
				</ul>
			</div>
			<br />
			<b>Полезные ссылки</b>
			<ul class="dots">
				<li><a href="/security.html"><b>Правила безопасности</b></a></li>
				<li><a href="/faq.html">Ответы на частые вопросы / решение частых проблем</a></li>
				<li><a href="/forum/topic/724-/">Как запустить лаунчер на Linux?</a></li>
				<li><a href="/forum/forum/3-/">Гайды &amp; инструкции</a></li>
				<li><a href="/forum/forum/17-/">Техподдержка (форум)</a></li>
				<li><a href="/service.html">Услуги</a></li>
			</ul>
			
		</div>
	</div>
</div>
<div class="clear"></div>

<script>
$(function(){
	$(".dlButton").click(function(){
		displayMessage("Загрузка началась...", "info");
	});
});
</script></div>