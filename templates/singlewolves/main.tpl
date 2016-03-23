<!DOCTYPE html>
<html>
<head>
{headers}
	<link rel="stylesheet" media="all" href="{THEME}/css/reset.css" />
	<link rel="stylesheet" media="all" href="{THEME}/css/styles.css" />
	<link media="screen" href="{THEME}/css/bbcodes.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" media="all" href="{THEME}/css/slider.css" />
    <link rel="shortcut icon" href="http://minefix.ru/favicon.ico" type="image/x-icon">
</head>
<body>
{AJAX}
	<div class="wrapper mainWrapper">
		<header>
			<a href="/" class="logo" title="На главную"></a>
		</header>
		
		<nav>
			<ul class="mainmenu">
                <li><a class="active" href="/">Главная</a></li>
				<li>
					<a class="dropdown nolink " href="#">Описание серверов</a>
					<div>
						<a href="/hitech1.html">HiTech</a>
						<a href="/sandbox.html">SandBox</a>
						<a href="/magic.html">MiniGames</a>
					</div>
				</li>
				<li><a class="dropdown nolink" href="#">Помощь</a>
					<div>
						
						<a href="/commands.html">Команды сервера</a>
						
					</div>
				</li>
                <li><a class="" href="/cabinet.html">Услуги</a></li>
                <li><a class="" href="/rules.html">Правила</a></li>
                <li><a class="" href="/contact.html">Контакты</a></li>
			</ul>
		</nav>
		
		<div class="mainBox">
			<div class="sidebar">
				<div class="startGame">
	[group=5]<a href="/index.php?do=register" class="btns">Начать игру</a>[/group]
    [not-group=5]<a href="start.html" class="btns">Играть на MineFix</a>[/not-group]                      
</div>              
                
<script> var unreadPMs = 0; </script>
<div class="blackBox margin loginForm">
{login}
</div>
               
                
                
<!-- Группа ВК -->
<div style="overflow: hidden; max-height: 370px;">
	<div id="vk_groups" style="background: #fff;" class="margin"></div>
    
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 2, width: "230", height: "350"}, 89054466);
</script>
</div>    
                {include file="/indes_mon.php"}
                  <iframe src="http://skins.full-mod.ru/monitoring/1/mons.php?s=5.255.82.173:25565:MineFix&l=300&m=180&t=1" frameborder="no" scrolling="no"></iframe>
  
    </div> 
            
<!-- Группа ВК -->
            

                       
			<div class="content">    
                         
<!-- Слайдер -->
                
                [aviable=main]
				<div class="slider">
					<ul>
						<li><img src="{THEME}/images/slide.jpg" /></li>
						<li><a href="http://vk.com/mine__fix"><img src="{THEME}/images/slide1.jpg" /></a></li>
						<li><a href="#"><img src="{THEME}/images/slide2.jpg" /></a></li>
						<li><a href="#"><img src="{THEME}/images/slide3.jpg" /></a></li>
						<li><a href="#"><img src="{THEME}/images/slide4.jpg" /></a></li>
					</ul>
				</div>
                [/aviable]
<!-- Слайдер -->
                
				{info}
				[aviable=main|cat|showfull|allnews]<h2>Новости</h2><div class="hr"></div>[/aviable]
				{content}
			</div>
			<div class="clear"></div>
		</div>
		
		<center><div class="foot-links">
			<a href="/">Главная</a>
            <a href="#">Форум</a>
            <a href="/start.html">Начать игру</a>
            <a href="/donat.html">Услуги</a>
			<a href="#">Топ игроков</a>
            </div></center>
		<div class="footerHeight"></div>
	</div>
	<footer>
		<div class="wrapper footerIn">
			<div class="right fbans">
				
			</div>
            <b class="white">MineFix - Комплекс Игровых Серверов (с)</b><br>
			<b class="white"><br>
            <b class="white">         
			<div class="clear">
		</div>
        </footer>
            
	<script src="{THEME}/js/jquery.bxslider.min.js"></script>
	<script src="{THEME}/js/tooltip.js"></script>
	<script src="{THEME}/js/jquery.cookie.js"></script>
	<script src="{THEME}/js/selectbox.js"></script>
	<script src="{THEME}/js/singlewolves.js?1"></script>
</body>	
</html>
