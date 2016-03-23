<?php


require_once('functions.php');
?>
<link rel="stylesheet" href="images/styles.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="images/scripts.js"></script>
<link rel="stylesheet" href="images/tabs.css">
<script type="text/javascript" src="images/tabs.js"></script>
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
function Ftest (obj)
{
if (this.ST) return; var ov = obj.value;
var ovrl = ov.replace (/\-?\d*\.?\d*/, '').length; this.ST = true;
if (ovrl > 0) {obj.value = obj.lang; Fshowerror (obj); return}
obj.lang = obj.value; this.ST = null;
}
 
function Fshowerror (obj)
{
if (!this.OBJ)
   {this.OBJ = obj; obj.style.backgroundColor = 'pink'; this.TIM = setTimeout (Fshowerror, 50)}
else
   {this.OBJ.style.backgroundColor = ''; clearTimeout (this.TIM); this.ST = null; Ftest (this.OBJ); this.OBJ = null}
}
			</script>

	<table cellspacing="5" cellpadding="0" class="table">
	<tr>
		<td class="table-first-panel">
			<h2>Управление скином и плащем</h2>
				<ul>
					<li>
						<div class="bg-skin-cloak">
							<img class="skin-front" src="/lc/skin.php?mode=1&fx=80">
							<img class="skin-back" src="/lc/skin.php?mode=2&fx=80">
						</div>
					</li>
					<li>
						<h3>Скин</h3>
						<span>Файл .png размером</span>
						<input class="button dlb upb" type="submit" form="sld" value="Удалить">
						<form action="index.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="skinfile">
							<input type="file" name="skinfile" accept="image/png" id="file">
							<input class="button fileload upb" type="submit" name="submit" value=" Загрузить скин ">
						</form>
					</li>
					<form id="sld" style="height: 0px; width: 0px;" action="index.php" method="post"><input type="hidden" name="action" value="skindel"></form>
					<li>
						<h3>Плащ</h3>
						<span>Файл .png размером</span>
						<input class="button dlb upb" type="submit" form="cld" value="Удалить">
						<form action="index.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="cloakfile">
							<input type="file" name="cloakfile" accept="image/png" id="file">
							<input class="button fileload upb" type="submit" name="submit" value=" Загрузить плащ ">
						</form>
					</li>

					<li>
					
					<h3>Приставка</h3>
					<form action="index.php" method="post" id="prefixform">
						<input type="hidden" name="action" value="setprefix">
						<label class="prefixform">
						цвет<br>приставки:
						<br>
						<select id="prefix_color" name="prefix_color">
										<option style="background:#ffffff;" value="&f" <?php if($prefix_color=='&f' || $prefix_color=='' || count($get_prefix_query)==0) echo 'selected'; ?>>#f</option>
										<option style="background:#000000;" value="&0" <?php if($prefix_color=='&0') echo 'selected'; ?>>#0</option>
										<option style="background:#0000bf;" value="&1" <?php if($prefix_color=='&1') echo 'selected'; ?>>#1</option>
										<option style="background:#00bf00;" value="&2" <?php if($prefix_color=='&2') echo 'selected'; ?>>#2</option>
										<option style="background:#00bfbf;" value="&3" <?php if($prefix_color=='&3') echo 'selected'; ?>>#3</option>
										<option style="background:#bf0000;" value="&4" <?php if($prefix_color=='&4') echo 'selected'; ?>>#4</option>
										<option style="background:#bf00bf;" value="&5" <?php if($prefix_color=='&5') echo 'selected'; ?>>#5</option>
										<option style="background:#bfbf00;" value="&6" <?php if($prefix_color=='&6') echo 'selected'; ?>>#6</option>
										<option style="background:#bfbfbf;" value="&7" <?php if($prefix_color=='&7') echo 'selected'; ?>>#7</option>
										<option style="background:#404040;" value="&8" <?php if($prefix_color=='&8') echo 'selected'; ?>>#8</option>
										<option style="background:#4040ff;" value="&9" <?php if($prefix_color=='&9') echo 'selected'; ?>>#9</option>
										<option style="background:#40ff40;" value="&a" <?php if($prefix_color=='&a') echo 'selected'; ?>>#a</option>
										<option style="background:#40ffff;" value="&b" <?php if($prefix_color=='&b') echo 'selected'; ?>>#b</option>
										<option style="background:#ff4040;" value="&c" <?php if($prefix_color=='&c') echo 'selected'; ?>>#c</option>
										<option style="background:#ff40ff;" value="&d" <?php if($prefix_color=='&d') echo 'selected'; ?>>#d</option>
										<option style="background:#ffff40;" value="&e" <?php if($prefix_color=='&e') echo 'selected'; ?>>#e</option>
						</select>
						</label>
						<label class="prefixform">
						<br>
						приставка:
						<br>
						<input type="text" id="prefix" name="prefix" <?php if(!$prefix=='') echo $prefix; ?>>
						</label>
						<label class="prefixform">
						цвет<br>ника:
						<br>
						<select id="nick_color" name="nick_color">
										<option style="background:#ffffff;" value="&f" <?php if($nick_color=='&f' || $nick_color=='' || count($get_prefix_query)==0) echo 'selected'; ?>>#f</option>
										<option style="background:#000000;" value="&0" <?php if($nick_color=='&0') echo 'selected'; ?>>#0</option>
										<option style="background:#0000bf;" value="&1" <?php if($nick_color=='&1') echo 'selected'; ?>>#1</option>
										<option style="background:#00bf00;" value="&2" <?php if($nick_color=='&2') echo 'selected'; ?>>#2</option>
										<option style="background:#00bfbf;" value="&3" <?php if($nick_color=='&3') echo 'selected'; ?>>#3</option>
										<option style="background:#bf0000;" value="&4" <?php if($nick_color=='&4') echo 'selected'; ?>>#4</option>
										<option style="background:#bf00bf;" value="&5" <?php if($nick_color=='&5') echo 'selected'; ?>>#5</option>
										<option style="background:#bfbf00;" value="&6" <?php if($nick_color=='&6') echo 'selected'; ?>>#6</option>
										<option style="background:#bfbfbf;" value="&7" <?php if($nick_color=='&7') echo 'selected'; ?>>#7</option>
										<option style="background:#404040;" value="&8" <?php if($nick_color=='&8') echo 'selected'; ?>>#8</option>
										<option style="background:#4040ff;" value="&9" <?php if($nick_color=='&9') echo 'selected'; ?>>#9</option>
										<option style="background:#40ff40;" value="&a" <?php if($nick_color=='&a') echo 'selected'; ?>>#a</option>
										<option style="background:#40ffff;" value="&b" <?php if($nick_color=='&b') echo 'selected'; ?>>#b</option>
										<option style="background:#ff4040;" value="&c" <?php if($nick_color=='&c') echo 'selected'; ?>>#c</option>
										<option style="background:#ff40ff;" value="&d" <?php if($nick_color=='&d') echo 'selected'; ?>>#d</option>
										<option style="background:#ffff40;" value="&e" <?php if($nick_color=='&e') echo 'selected'; ?>>#e</option>
						</select>
						</label>
						<label class="prefixform">
						цвет<br>текста:
						<br>
						<select id="text_color" name="text_color">
										<option style="background:#ffffff;" value="&f" <?php if($text_color=='&f' || $text_color=='' || count($get_prefix_query)==0) echo 'selected'; ?>>#f</option>
										<option style="background:#000000;" value="&0" <?php if($text_color=='&0') echo 'selected'; ?>>#0</option>
										<option style="background:#0000bf;" value="&1" <?php if($text_color=='&1') echo 'selected'; ?>>#1</option>
										<option style="background:#00bf00;" value="&2" <?php if($text_color=='&2') echo 'selected'; ?>>#2</option>
										<option style="background:#00bfbf;" value="&3" <?php if($text_color=='&3') echo 'selected'; ?>>#3</option>
										<option style="background:#bf0000;" value="&4" <?php if($text_color=='&4') echo 'selected'; ?>>#4</option>
										<option style="background:#bf00bf;" value="&5" <?php if($text_color=='&5') echo 'selected'; ?>>#5</option>
										<option style="background:#bfbf00;" value="&6" <?php if($text_color=='&6') echo 'selected'; ?>>#6</option>
										<option style="background:#bfbfbf;" value="&7" <?php if($text_color=='&7') echo 'selected'; ?>>#7</option>
										<option style="background:#404040;" value="&8" <?php if($text_color=='&8') echo 'selected'; ?>>#8</option>
										<option style="background:#4040ff;" value="&9" <?php if($text_color=='&9') echo 'selected'; ?>>#9</option>
										<option style="background:#40ff40;" value="&a" <?php if($text_color=='&a') echo 'selected'; ?>>#a</option>
										<option style="background:#40ffff;" value="&b" <?php if($text_color=='&b') echo 'selected'; ?>>#b</option>
										<option style="background:#ff4040;" value="&c" <?php if($text_color=='&c') echo 'selected'; ?>>#c</option>
										<option style="background:#ff40ff;" value="&d" <?php if($text_color=='&d') echo 'selected'; ?>>#d</option>
										<option style="background:#ffff40;" value="&e" <?php if($text_color=='&e') echo 'selected'; ?>>#e</option>
						</select>
						</label>
						<input class="button upb fileload setprefix" type="submit" value="Выбрать">
						<span style="padding: 0px; margin-top: 10px;">Предосмотр: </span><br>
						<b>
						<span style="padding: 0px;" id="prefix_view" style="background: <?=$userprefixcolor ?>" ><?=$userprefix ?></span>
						<span style="padding: 0px;" id="nick_view"><?=$username ?>:</span>
						<span style="padding: 0px;" id="text_view">Текст сообщения</span>
						</b>
					</form>
				</li>
			<li>
					<h3>Разбан</h3>
					<?php if($userbanned != '') { ?>
					<span>Статус: ЗАБАНЕН!</span>
					<? } ?>
					<button form="unban-form" type="submit" class="button upb unban-button"> Разбаниться </button>
					<span style="padding: 10px 0px 0px 0px"><?=$unban_pricelist ?></span>
					<form id="unban-form" action="index.php" method="post"><input type="hidden" name="action" value="unban"></form>
				</li>
					<li>
					<h2>Покупка варпа</h2>
					<span>- Покупка одной точки варпа 100 рублей.</span><br>
					<form style="margin-top: 10px;" action="" method="post">
						<input type="hidden" name="action" >
 <input type="text" class="promo-textbox" value="Названия" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="warpname">
<input class="promo-textbox" value="X" oninput="Ftest (this)"
 onpropertychange="if ('v' == '\v' && parseFloat (navigator.userAgent.split ('MSIE ') [1].split (';') [0]) <= 9) Ftest (this)"
 onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="ox">
<input type="text" class="promo-textbox" value="Y" oninput="Ftest (this)"
 onpropertychange="if ('v' == '\v' && parseFloat (navigator.userAgent.split ('MSIE ') [1].split (';') [0]) <= 9) Ftest (this)"
onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="oy">
<input type="text" class="promo-textbox" value="Z" oninput="Ftest (this)"
 onpropertychange="if ('v' == '\v' && parseFloat (navigator.userAgent.split ('MSIE ') [1].split (';') [0]) <= 9) Ftest (this)"
onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}" name="oz">
			
						<div align = "right"><input name="buywarp" type="submit" class="promo-activate-button button" value="      Купить      "></div>
					</form>
					
				</li>
					<form id="cld" style="height: 0px; width: 0px;" action="index.php" method="post"><input type="hidden" name="action" value="cloakdel"></form>
				<br>
				</ul>
		</td>

		<td class="table-second-panel">
			<h2>Управление донат счетом</h2>
			<ul>
				<li>
					<span>На вашем <b>донат</b> счету <?=$usercash ?> руб.</span>
				<span>На вашем <b>игровом</b> счету <?=$iconomy ?> монет.</span>
				<?php if ( $userjobs == '' ) echo "<span>Вы еще не устроены на работу</span>"; else echo "<span>Вы устроены на работу:&nbsp;". $userjobs. "</span>"; ?>
				 
				<h2>Пополнение счета</h2>
				<br>
				

<?php

session_start();
if(isset($_SESSION['cashed']) && $_SESSION['cashed']!="")
{
  echo "<script>alert('Пополнение произведено успешно!');</script>";
  $_SESSION['cashed']="";
}
?>
<form method="post" action="/lc/payment.php" target="_top">
    <select style="height: 33px;" name="payment">
        <option value="interkassa">InterKassa</option>
        <option value="UnitPay">UnitPay</option>
    </select>
    <input class="promo-textbox1" type="number" value="100" name="amount">
  <button class="button buyperms" type="submit">Пополнить</button>
</form>
				</li>
				<li>
					<span style="padding: 0px"><b>Статус:</b> <?php echo strtoupper($userstatusout); ?></span>
				</li>
				<li>
					<h3>Полномочия</h3>
					<?php if(count($user_status_duration)>0) echo '<span style="float:right; margin-top:-22px;">до '.date('Y.m.d H:i',$user_status_duration).'</span><br>'; ?>
					<center>
					<button form="buyvip" type="submit" class="button buyperms">VIP<br>(150руб.<?php if($userstatus == 'vip') echo ' <b>-'.$vip_discount.'</b>'; ?>)</button>
					<button form="buyprem" type="submit" class="button buyperms">Premium<br>(300руб.<?php if($userstatus == 'premium') echo ' <b>-'.$prem_discount.'</b>'; ?>)</button>
					<button form="buydeluxe" type="submit" class="button buyperms">Golden<br>(450руб.<?php if($userstatus == 'deluxe') echo ' <b>-'.$deluxe_discount.'</b>'; ?>)</button>
					</center>
					<span>- Покупка полномочий осуществляется на 30 дней.<br>
					- Продление полномочий дешевле на 10 руб. для VIP, 20 руб. для Premium и 30 руб для Golden.<br>
					- Остальные преимущества полномочий можно прочитать <a style="text-decoration: underline; color: #333333;" href=<?=$desclink ?> ><b>здесь</b></a>.</span>
				<form id="buyvip" method="post" action="index.php"><input type="hidden" name="action" value="buyvip"></form>
				<form id="buyprem" method="post" action="index.php"><input type="hidden" name="action" value="buyprem"></form>
				<form id="buydeluxe" method="post" action="index.php"><input type="hidden" name="action" value="buydeluxe"></form>
				</li>
				<li>
				<h2>Покупка прав Permissions</h2>

				
				<form style="margin-top: 10px;" action="" method="post">
						<input type="hidden" name="action" >
						
					<center>	
					<input name="buyfly" type="submit" class="button buyperms" value= 'Fly &#10;(100руб.)' >
					<input name="buyheal" type="submit" class="button buyperms" value= 'Heal &#10;(200руб.)' >
					<input name="buykill" type="submit" class="button buyperms" value= 'Kill &#10;(300руб.)' >
					</center>
					</form>

				</li>
				
				<li>
				
				<h2>Перевод средств</h2>
					<form style="margin-top: 10px;" action="index.php" method="post">
						<input type="hidden" name="action" >
						<span style="margin-right: 52px;">Имя получателя:</span>
						<input type="text" class="promo-textbox" name="playername"><br>
						<span style="margin-right: 61px;">Сума перевода:</span>
						<input type="number" class="promo-textbox" min=0 value=0 name="chislo">
						<div align = "right"><input name="perevodb" type="submit" class="promo-activate-button button" value="   Перевести   "></div>
					</form>
				
				</li>
				
					<h2>Обмен валют</h2>
					<form style="margin-top: 10px;" action="" method="post">
						<input type="hidden" name="action" >
						<span style="margin-right: 69px;">Сума обмена:</span>
						<input type="number" class="promo-textbox" min=0 value=0 name="monet">
						<div align = "right"><input name="submit1" type="submit" class="promo-activate-button button" value="   Обменять   "></div>
					</form>
				
				
				
				
			
	<tr>
		<td class="table-first-panel">
		
			<h2>Голосование за сервер</h2>
			<center>
				<span>Считаешь, что наш сервер - лучший? <br>Проголосуй за сервер и поддержи его!</span><br>
				<?php include('banners_code.txt'); ?>
			</center>
		</td>
		<td class="table-second-panel">
			<h2>Введите промо-код</h2>
				<center>
					<br>
					<span>У вас есть промо-код? Введите его в поле ниже и получите приз!<b>*</b></span>
					<br>
					<form action="index.php" method="post">
						<input type="hidden" name="action" value="promo">
						<input class="promo-textbox" type="text" name="promo-key">
						<br>
						<input class="promo-activate-button button" type="submit" name="activate" value=" Активировать ">
					</form>
					<div class="desc">Промо-код является одноразовым, при его активации он удаляется из базы данных.<br> Призы за различные промо-коды назначаются
					администрацией и не подлежат обсуждению
					</div>
				</center>
		</td>
	</tr>
</table>
