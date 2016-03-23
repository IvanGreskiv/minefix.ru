<?php
define( '_DLE', 1 );
require_once('../functions.php');
require_once('functions.php');
if($usergroup == '1') {
?>

<link rel="stylesheet" href="../images/styles.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="images/scripts.js"></script>
<script>
			var modalWindow = {
				_block: null,
				_win: null,
		
				initBlock: function() {
					_block = document.getElementById('blockscreen'); 

					
					if (!_block) {
						var parent = document.getElementsByTagName('body')[0]; 
						var obj = parent.firstChild; 
						_block = document.createElement('div'); 
						_block.id = 'blockscreen';
						parent.insertBefore(_block, obj); 
						_block.onclick = function() { modalWindow.close(); } 
					}
					_block.style.display = 'inline';     
				},

				initWin: function(width, html) {
					_win = document.getElementById('modalwindow'); 
					
					if (!_win) {
						var parent = document.getElementsByTagName('body')[0];
						var obj = parent.firstChild;
						_win = document.createElement('div');
						_win.id = 'modalwindow';
						parent.insertBefore(_win, obj);
					}
					_win.style.width = width + 'px'; 
					_win.style.display = 'inline'; 
				
					_win.innerHTML = html; 
				
					

					_win.style.left = '50%';
					_win.style.top = '50%'; 

					
					_win.style.marginTop = -(_win.offsetHeight / 2) + 'px'; 
					_win.style.marginLeft = -(width / 2) + 'px';
				},

				close: function() {
					document.getElementById('blockscreen').style.display = 'none';
					document.getElementById('modalwindow').style.display = 'none';        
				},

				show: function(width, html) {
					modalWindow.initBlock();
					modalWindow.initWin(width, html);
				}
			}
			<?php if(isset($mmesage)) { ?>
			window.onload = function(){
			modalWindow.show(300, '<?=$mmesage ?>');
			}
			<?php } ?>
</script>


Добро пожаловать в админпанель! <a style="float: right;" href="../index.php">Перейти в личный кабинет</a>
<table cellspacing="5" cellpadding="0" class="table">
	<tr>
		<td class="table-first-panel">
			<h2>Управление скином и плащем</h2>
			<ul>
				<li>
					<?php  //ИСПРАВИТЬ БАГ: ПРОДЛЕНИЕ ПРАВ! ДОДЕЛАТЬ РАЗБАН
					if($_POST['action'] == 'showmember') { ?>
					<div class="bg-skin-cloak">
							<img class="skin-front" src="skin.php?mode=1&fx=80&username=<?=$_POST['username'] ?>">
							<img class="skin-back" src="skin.php?mode=2&fx=80&username=<?=$_POST['username'] ?>">
						</div>
					<?php } ?>
					<form action="index.php" method="post">
						<input type="hidden" name="action" value="showmember">
						<span style="margin-right: 16px;">Имя пользователя:</span>
						<input type="text" class="promo-textbox" name="username"><br>
						<center><input type="submit" class="promo-activate-button button" value=" Показать скин и плащ "></center>
					</form>
				</li>
				<li>
					<h3>Скин</h3>
					<span style="margin-right: 16px;">Имя пользователя:</span>
					<input type="text" class="promo-textbox" name="fusername"><br>
					<span>Файл .png размером</span>
					<form action="index.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="action" value="adminskinfile">
						<input type="file" name="skinfile" accept="image/png" id="file">
						<input class="button fileload upb" type="submit" name="submit" value=" Загрузить скин ">
					</form>
				</li>
				<li>
					<h3>Плащ</h3>
					<span style="margin-right: 16px;">Имя пользователя:</span>
					<input type="text" class="promo-textbox" name="fusername"><br>
					<span>Файл .png размером</span>
					<form action="index.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="action" value="admincloakfile">
						<input type="file" name="cloakfile" accept="image/png" id="file">
						<input class="button fileload upb" type="submit" name="submit" value=" Загрузить плащ ">
					</form>
				</li>
			</ul>
		</td>
		<td class="table-second-panel">
			<h2>Управление донат счетом пользователей</h2>
			<ul>
				<li>
					<h3>Изменение баланса</h3>
					<form style="margin-top: 10px;" action="index.php" method="post">
						<input type="hidden" name="action" value="updusercash">
						<span style="margin-right: 16px;">Имя пользователя:</span>
						<input type="text" class="promo-textbox" name="fusername"><br>
						<span style="margin-right: 59px;">Новый счет:</span>
						<input type="number" class="promo-textbox" min=0 value=0 name="fusercash">
						<center><input type="submit" class="promo-activate-button button" value=" Обновить счет "></center>
					</form>
					<h3>Изменение баланса ic</h3>
					<form style="margin-top: 10px;" action="index.php" method="post">
						<input type="hidden" name="action" value="iconomy">
						<span style="margin-right: 16px;">Имя пользователя:</span>
						<input type="text" class="promo-textbox" name="fusername"><br>
						<span style="margin-right: 59px;">Новый счет:</span>
						<input type="number" class="promo-textbox" min=0 value=0 name="fusericonomy">
						<center><input type="submit" class="promo-activate-button button" value=" Обновить счет "></center>
					</form>
				</li>
				
				<h3>Заблокировать игрока:</h3>
					<form style="margin-top: 10px;" action="index.php" method="post">
						<input type="hidden" name="action" value="add_ban">
						<span style="margin-right: 16px;">Имя пользователя:</span>
						<input type="text" class="promo-textbox" name="ban_name"><br>
						<span style="margin-right: 77px;">Причина:</span>
						<input type="text" class="promo-textbox" value="Причина" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="ban_reason">
						<span style="margin-right: 91px;">Сутки: </span>
						<input type="text" class="promo-textbox" value="Сутки" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="sutk">
						<span style="margin-right: 96px;">Часы:</span>
						<input type="text" class="promo-textbox" value="Часы" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="hour">
						<span style="margin-right: 80px;">Минуты:</span>
						<input type="text" class="promo-textbox" value="Минуты" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="min">
						<br><input type="checkbox" id="checkperm" name="perm" OnClick="perml()" value="ban_perm">Пермамент<Br>
						<center><input type="submit" class="promo-activate-button button" value=" Заблокировать "></center>
					</form>
				</li>
				
				
				
				
					<form style="margin-top: 10px;" action="index.php" method="post">
						<h3>Разбан</h3>
						<input type="hidden" name="action" value="unban">
						<span style="margin-right: 16px;">Имя пользователя:</span>
						<input type="text" class="promo-textbox" name="fusername"><br>
						<center><input type="submit" class="promo-activate-button button" value=" Разбанить "></center>
					</form>
				<li>
			</ul>
		</td>
	</tr>
	<tr>
		<td class="table-first-panel">
			<h2>Изменение код баннеров</h2>
			<form  action="index.php" method="post">
				<center>
					<input type="hidden" name="action" value="updbannerscode">
					<textarea class="textarea" type="textaera" name="code"></textarea><br>
					<input type="submit" class="promo-activate-button button" value=" Изменить код баннеров ">
				</center>
			</form>
		</td>
		<td class="table-second-panel">
			<h2>Добавить промо-код</h2>
			<form style="margin-top: 10px;" action="index.php" method="post">
					<input type="hidden" name="action" value="addpromokey">
					<span style="margin-right: 70px;">Промо-код:</span>
					<input type="text" class="promo-textbox" name="promokey"><br>
					<span style="margin-right: 9px;">Номинал промо-кода:</span>
					<input type="number" class="promo-textbox" min=0 value=0 name="promomoney"><br>
					<center><input type="submit" class="promo-activate-button button" style="margin-top: 17%;" value=" Добавить промо-код "></center>
				
			</form>
		</td>
	</tr>
</table>
<?php } else { ?>
<br><br><br>
У вас нет доступа в этот раздел!
<?php } ?>