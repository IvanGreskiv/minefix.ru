<?php
session_start();
require_once('config.php');
if(!isset($_SESSION['dle_user_id']) || empty($_SESSION['dle_user_id']) || $_SESSION['dle_user_id']=='') { die('<center>Личный кабинет доступен только зарегистрированным пользователям!</center>'); }
$upbalancebutton = '<div class="modal-title"><span class="modal-title-text">Пополнение баланса</span></div><div class="upbalancediv"><form action="spay.php" method="post" id="upbalance"><label for="upbalance-count">Сумма (без учета комиссии)</label><input name="upbalance-count" class="modal-textbox" type="text"></div><hr><div class="modal-buttonset"><input type="submit" form="upbalance" style="width: 148px" value="Продолжить" class="button modal-button"> <input type="button" style="width: 106px" class="button modal-button" value="Отмена" onclick="modalWindow.close();"></div></form>';
$upbalancebutton = htmlspecialchars($upbalancebutton);

//Подключения к БД
$mysqli = new mysqli($db_ip, $db_user, $db_pass, $db_base); 
if (mysqli_connect_errno()) { printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); exit; } 
//Подключения к БД

//Получаем имя игрока в лк
$stmt = $mysqli->prepare('SELECT `name` FROM `'.$tbl_USERS.'` WHERE `user_id`=? LIMIT 1'); 
$stmt->bind_param('i', $_SESSION['dle_user_id']); 
$stmt->execute(); 
$stmt->bind_result($username);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
//Получаем имя игрока в лк
$stmt = $mysqli->prepare('SELECT `name` FROM `'.$tbl_USERS.'` WHERE `user_id`=? LIMIT 1'); 
$stmt->bind_param('i', $_SESSION['dle_user_id']); 
$stmt->execute(); 
$stmt->bind_result($dle_user_id);
$stmt->store_result();
$stmt->fetch();
$stmt->close();

//Вывод игровой валюты
$stmt = $mysqli->prepare('SELECT '.$tbl_iconomy_col.' FROM '.$tbl_iconomy_table.' WHERE `username`=? LIMIT 1');  
$stmt->bind_param('s', $username); 
$stmt->execute(); 
$stmt->bind_result($iconomy);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
if($iconomy == '') $iconomy = '0';
//Вывод игровой валюты

//Вывод реальной валюты
$stmt = $mysqli->prepare('SELECT '.$tbl_realmoney_col.' FROM '.$tbl_realmoney_table.' WHERE '.$tbl_realmoney_id.'=? LIMIT 1'); 
$stmt->bind_param('i', $_SESSION['dle_user_id']); 
$stmt->execute(); 
$stmt->bind_result($usercash);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
if($usercash == '') $usercash = '0';
//Вывод реальной валюты

//Вывод информации о работе
$stmt = $mysqli->prepare('SELECT `job` FROM `jobs` WHERE `username`=? LIMIT 1'); 
$stmt->bind_param('s', $username); 
$stmt->execute(); 
$stmt->bind_result($userjobs);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
if ($userjobs == "Miner") $userjobs = "Шахтер";
if ($userjobs == "Woodcooter") $$userjobs = "Лесоруб";
if ($userjobs == "Builder") $userjobs = "Строитель";
if ($userjobs == "Digger") $userjobs = "Дигер";
if ($userjobs == "Farmer") $userjobs = "Фермер";
if ($userjobs == "Hunter") $userjobs = "Охотник";
if ($userjobs == "Fisherman") $userjobs = "Рыбак";
if ($userjobs == "Weaponsmith") $userjobs = "Оружейник";
//Вывод информации о работе



//Вывод статуса игрока
$stmt = $mysqli->prepare('SELECT `parent` FROM `'.$tbl_PRMS_inheritance.'` WHERE `child`=? LIMIT 1'); 
$stmt->bind_param('s', $username); 
$stmt->execute(); 
$stmt->bind_result($userstatus);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
if($userstatus=='') $userstatus = 'Player';
//Вывод статуса игрока

//Визуализация количеств бана
$stmt = $mysqli->prepare('SELECT `count` FROM `'.$tbl_bans.'` WHERE `username`=? LIMIT 1');
						$stmt->bind_param('s', $username);
						$stmt->execute(); 
						$stmt->bind_result($user_bans_count);
						$stmt->store_result();
						$stmt->fetch();
						$stmt->close();
	switch($user_bans_count) {
		case '0':
			$unban_pricelist = 'Стоимость снятия 1 бана - <b>'.$unbancost[0].' руб.</b><br>
								Стоимость снятия 2 бана - <b>'.$unbancost[1].' руб.</b><br>
								Все последующие - <b>'.$unbancost[2].' руб.</b>';
			break;
		case '1':
			$unban_pricelist = '<span class="span-ban">Стоимость снятия 1 бана - <b>'.$unbancost[0].' руб.</b></span><br>
								Стоимость снятия 2 бана - <b>'.$unbancost[1].' руб.</b><br>
								Все последующие - <b>'.$unbancost[2].' руб.</b>';
			break;
		case '2':
			$unban_pricelist = '<span class="span-ban">Стоимость снятия 1 бана - <b>'.$unbancost[0].' руб.</b><br>
								Стоимость снятия 2 бана - <b>'.$unbancost[1].' руб.</b></span><br>
								Все последующие - <b>'.$unbancost[2].' руб.</b>';
			break;
		default:
				$unban_pricelist = 'Стоимость снятия 1 бана - <b>'.$unbancost[0].' руб.</b><br>
								Стоимость снятия 2 бана - <b>'.$unbancost[1].' руб.</b><br>
								Все последующие - <b>'.$unbancost[2].' руб.</b>';
			break;
	}

	if ($user_bans_count > 2) {
	$unban_pricelist = '<span class="span-ban">Стоимость снятия 1 бана - <b>'.$unbancost[0].' руб.</b><br>
								Стоимость снятия 2 бана - <b>'.$unbancost[1].' руб.</b></span><br>
								Все последующие - <b>'.$unbancost[2].' руб.</b>';
	}
//Визуализация количеств бана

//Дата окончания статуса	
$stmt = $mysqli->prepare('SELECT `expiration_date` FROM `'.$tbl_PRMS_duration.'` WHERE `username`=? LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute(); 
$stmt->bind_result($user_status_duration);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
//Дата окончания статуса

//Определяем групу игрока
$stmt = $mysqli->prepare('SELECT `user_group` FROM `'.$tbl_USERS.'` WHERE `user_id`=? LIMIT 1');
$stmt->bind_param('s', $_SESSION['dle_user_id']);
$stmt->execute(); 
$stmt->bind_result($usergroup);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
//Определяем групу игрока

//Информация об наличии игрока в бан листе
$stmt = $mysqli->prepare('SELECT `'.$tbl_BANLIST_col_username.'` FROM `'.$tbl_BANLIST.'` WHERE `'.$tbl_BANLIST_col_username.'` = ? LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute(); 
$stmt->bind_result($userbanned);
$stmt->store_result();
$stmt->fetch();
$stmt->close();
//Информация об наличии игрока в бан листе

//Форма сообщений
if(isset($_POST['action'])) {
	$mmesag1e = '<div class=modal-title><span class=modal-title-text>Уведомление</span></div><div class=upbalancediv><label>';
	$mmesag1e = $mysqli->real_escape_string($mmesag1e);
	$mmesag2e = '</label></div><hr><input type=button style="width: 106px; float: right;" class="button modal-button" value="Ок" onclick="modalWindow.close();"></div></form>';
	$mmesag2e = $mysqli->real_escape_string($mmesag2e);
		switch($_POST['action']) {
//Форма сообщений
			
//Активация промо-кода			
case 'promo': 
	$getkey = $mysqli->real_escape_string(htmlspecialchars($_POST['promo-key']));
	$stmt = $mysqli->prepare('SELECT `awardmoney` FROM `elc_promokeys` WHERE `key`=? LIMIT 1');
	$stmt->bind_param('s', $getkey);
	$stmt->execute(); 
	$stmt->bind_result($award);
	$stmt->store_result();
	$stmt->fetch();
	$stmt->close();
	if(!$award=='') {
		$newusercash = $usercash + $award;
		$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
		$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
		$stmt->execute();
		$stmt->close();
		$stmt = $mysqli->prepare('DELETE FROM `elc_promokeys` WHERE `key`=?');
		$stmt->bind_param('s', $getkey);
		$stmt->execute();
		$stmt->close();
		$result = 'Промо-код активирован!';
	} else {
		$result = 'Промо-код не найден';
	}
	$mmesage = $mmesag1e.$result.$mmesag2e;
	$_POST['action'] = null;
	$usercash = $newusercash;
	break;
//Активация промо-кода		

//Загрузка скина		
case 'skinfile': 
	$iwh = GetImageSize($_FILES['skinfile']['tmp_name']);
	if ($_FILES["skinfile"]["type"] != "image/png") $result = 'Недопустимый тип файла!';
	elseif(!is_uploaded_file($_FILES["skinfile"]["tmp_name"])) $result = 'Ошибка при загрузке файла!';
	elseif($iwh[0]>$skin_max_size_W || $iwh[1]>$skin_max_size_H || $iwh[0]<$skin_min_size_W || $iwh[1]<$skin_min_size_H) $result = 'Недопустимое разрешение файла!';
	elseif(move_uploaded_file($_FILES["skinfile"]["tmp_name"], 'uploads/skins/'.$username.'.png')) $result = 'Скин загружен!';
	else $result = 'Ошибка при загрузке файла!';
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
//Загрузка скина

//Загрузка плаща				
case 'cloakfile': 
	if($userstatus != 'Player') {
		$iwh = GetImageSize($_FILES['cloakfile']['tmp_name']);
		if ($_FILES["cloakfile"]["type"] != "image/png") $result = 'Недопустимый тип файла!';
		elseif(!is_uploaded_file($_FILES["cloakfile"]["tmp_name"])) $result = 'Ошибка при загрузке файла!';
	elseif($iwh[0]>$cloak_max_size_W || $iwh[1]>$cloak_max_size_H || $iwh[0]<$cloak_min_size_W || $iwh[1]<$cloak_min_size_H) $result = 'Недопустимое разрешение файла!';
		elseif(move_uploaded_file($_FILES["cloakfile"]["tmp_name"], 'uploads/cloaks/'.$username.'.png')) $result = 'Плащ загружен!';
		else $result = 'Ошибка при загрузке файла!';
	} else {
		$result = 'Для загрузки плаща нужен хотя бы VIP!';
	}
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
//Загрузка плаща

//Удаления скина				
case 'skindel':
	@unlink($skin_dir.$username.'.png');
	$result = 'Скин удален!';
	$mmesag1e = $mmesag1e.$result.$mmesag2e;
	break;
//Удаления скина

//Удаления плаща
case 'cloakdel':
	@unlink($cloak_dir.$username.'.png');
	$result = 'Плащ удален!';
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
//Удаления скина

//Покупка продления вип статуса
case 'buyvip':
	if($userstatus=='vip') {
		$vip_cost = $vip_cost - $vip_discount;
		if($usercash >= $vip_cost) {
			$newusercash = $usercash - $vip_cost;
			$expiration_date = $user_status_duration+(60*60*24*$perms_duration);
			$stmt = $mysqli->prepare('UPDATE `'.$tbl_PRMS_duration.'` SET `expiration_date` = ? WHERE `username` = ? LIMIT 1');
			$stmt->bind_param('ss', $expiration_date, $username);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$result = 'Вы продлили VIP!';
			$usercash = $newusercash;
			$user_status_duration = $expiration_date;
		} else {
			$result = 'Недостаточно денег!';
		}
	} else {
		if($usercash >= $vip_cost) {
			$newusercash = $usercash - $vip_cost;
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$start_date = date('Y-m-d H:i:s');
			$expiration_date = time()+(60*60*24*$perms_duration);
			$stmt = $mysqli->prepare('INSERT INTO `'.$tbl_PRMS_duration.'` (`username`,`start_date`,`expiration_date`) VALUES (?,?,?)');
			$stmt->bind_param('sss', $username, $start_date, $expiration_date);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('SELECT `parent` FROM `'.$tbl_PRMS_inheritance.'` WHERE `child`=? LIMIT 1');
			$stmt->bind_param('s', $username);
			$stmt->execute(); 
			$stmt->bind_result($listalready);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
			if($listalready !='') {
				$stmt = $mysqli->prepare('UPDATE `'.$tbl_PRMS_inheritance.'` SET `parent` = ?, `type` = ? WHERE `child` = ? LIMIT 1');
				$stmt->bind_param('sis', $qstatus, $qtype, $username);
				$qstatus = 'vip';
				$qtype = 1;
				$stmt->execute(); 
				$stmt->close();
			} else {
				$mysqli->query('INSERT INTO `'.$tbl_PRMS_inheritance.'` (`child`,`parent`,`type`) VALUES ("'.$username.'", "vip", 1)');
			}
			$usercash = $newusercash;
			$userstatus = 'vip';
			$stmt = $mysqli->prepare('SELECT `expiration_date` FROM `'.$tbl_PRMS_duration.'` WHERE `username`=? LIMIT 1');
			$stmt->bind_param('s', $username);
			$stmt->execute(); 
			$stmt->bind_result($user_status_duration);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
			$result = 'Вы купили VIP!';
		} else {
			$result = 'Недостаточно денег!';
		}
	}
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
//Покупка продления вип статуса

//Покупка продления премиум статуса
case 'buyprem':
	if($userstatus=='premium') {
		$prem_cost = $prem_cost - $prem_discount;
		if($usercash >= $prem_cost) {
			$newusercash = $usercash - $prem_cost;
			$expiration_date = $user_status_duration+(60*60*24*$perms_duration);
			$stmt = $mysqli->prepare('UPDATE `'.$tbl_PRMS_duration.'` SET `expiration_date` = ? WHERE `username` = ? LIMIT 1');
			$stmt->bind_param('ss', $expiration_date, $username);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$result = 'Вы продлили PREMIUM!';
			$usercash = $newusercash;
			$user_status_duration = $expiration_date;
		} else {
			$result = 'Недостаточно денег!';
		}
	} else {
		if($usercash >= $prem_cost) {
			$newusercash = $usercash - $prem_cost;
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$start_date = date('Y-m-d H:i:s');
			$expiration_date = time()+(60*60*24*$perms_duration);
			$stmt = $mysqli->prepare('INSERT INTO `'.$tbl_PRMS_duration.'` (`username`,`start_date`,`expiration_date`) VALUES (?,?,?)');
			$stmt->bind_param('sss', $username, $start_date, $expiration_date);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('SELECT `parent` FROM `'.$tbl_PRMS_inheritance.'` WHERE `child`=? LIMIT 1');
			$stmt->bind_param('s', $_SESSION['dle_user_id']);
			$stmt->execute(); 
			$stmt->bind_result($listalready);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
			if($listalready !='') {
				$stmt = $mysqli->prepare('UPDATE `'.$tbl_PRMS_inheritance.'` SET `parent` = ?, `type` = ? WHERE `child` = ? LIMIT 1');
				$stmt->bind_param('sis', $qstatus, $qtype, $username);
				$qstatus = 'premium';
				$qtype = 1;
				$stmt->execute(); 
				$stmt->close();
			} else {
				$mysqli->query('INSERT INTO `'.$tbl_PRMS_inheritance.'` (`child`,`parent`,`type`) VALUES ("'.$username.'", "premium", 1)');
			}
			$usercash = $newusercash;
			$userstatus = 'premium';
			$stmt = $mysqli->prepare('SELECT `expiration_date` FROM `'.$tbl_PRMS_duration.'` WHERE `username`=? LIMIT 1');
			$stmt->bind_param('s', $username);
			$stmt->execute(); 
			$stmt->bind_result($user_status_duration);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
			$result = 'Вы купили PREMIUM!';
		} else {
			$result = 'Недостаточно денег!';
		}
	}
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
//Покупка продления премиум статуса	

//Покупка продления делюкс статуса	
case 'buydeluxe':
	if($userstatus=='deluxe') {
		$deluxe_cost = $deluxe_cost - $deluxe_discount;
		if($usercash >= $deluxe_cost) {
			$newusercash = $usercash - $deluxe_cost;
			$expiration_date = $user_status_duration+(60*60*24*$perms_duration);
			$stmt = $mysqli->prepare('UPDATE `'.$tbl_PRMS_duration.'` SET `expiration_date` = ? WHERE `username` = ? LIMIT 1');
			$stmt->bind_param('ss', $expiration_date, $username);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$result = 'Вы продлили GOLDEN!';
			$usercash = $newusercash;
			$user_status_duration = $expiration_date;
		} else {
			$result = 'Недостаточно денег!';
		}
	} else {
		if($usercash >= $deluxe_cost) {
			$newusercash = $usercash - $deluxe_cost;
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$start_date = date('Y-m-d H:i:s');
			$expiration_date = time()+(60*60*24*$perms_duration);
			$stmt = $mysqli->prepare('INSERT INTO `'.$tbl_PRMS_duration.'` (`username`,`start_date`,`expiration_date`) VALUES (?,?,?)');
			$stmt->bind_param('sss', $username, $start_date, $expiration_date);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('SELECT `parent` FROM `'.$tbl_PRMS_inheritance.'` WHERE `child`=? LIMIT 1');
			$stmt->bind_param('s', $username);
			$stmt->execute(); 
			$stmt->bind_result($listalready);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
			if($listalready !='') {
				$stmt = $mysqli->prepare('UPDATE `'.$tbl_PRMS_inheritance.'` SET `parent` = ?, `type` = ? WHERE `child` = ? LIMIT 1');
				$stmt->bind_param('sis', $qstatus, $qtype, $username);
				$qstatus = 'deluxe';
				$qtype = 1;
				$stmt->execute(); 
				$stmt->close();
			} else {
				$mysqli->query('INSERT INTO `'.$tbl_PRMS_inheritance.'` (`child`,`parent`,`type`) VALUES ("'.$username.'", "deluxe", 1)');
			}
			$usercash = $newusercash;
			$userstatus = 'deluxe';
			$stmt = $mysqli->prepare('SELECT `expiration_date` FROM `'.$tbl_PRMS_duration.'` WHERE `username`=? LIMIT 1');
			$stmt->bind_param('s', $username);
			$stmt->execute(); 
			$stmt->bind_result($user_status_duration);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
			$result = 'Вы купили GOLDEN!';
		} else {
			$result = 'Недостаточно денег!';
		}
	}
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
//Покупка продления делюкс статуса	
				
//Префикс
	case 'setprefix':
		if($userstatus != 'Player') {
			$prefix_color = $mysqli->real_escape_string($_POST['prefix_color']);
			$prefix_text = $mysqli->real_escape_string(htmlspecialchars($_POST['prefix']));
			$nick_color = $mysqli->real_escape_string($_POST['nick_color']);
			$prefix = $prefix_color.'['.$prefix_text.'] '.$nick_color;
			$suffix = $mysqli->real_escape_string($_POST['text_color']);
			$type = '1';
			$stmt = $mysqli->query("DELETE FROM permissions_entity WHERE name='$username'");
			$stmt = $mysqli->query('INSERT INTO `'.$tbl_PRMS_entity.'` (`name`, `type`, `prefix`, `suffix`) VALUES ("'.$username.'","'.$type.'","'.$prefix.'","'.$suffix.'")');
			$result = 'Префикс сохранен!';
		} else {
			$result = 'Для смены префикса нужен хотя бы VIP!';
		}
		$mmesage = $mmesag1e.$result.$mmesag2e;
		break;
//Префикс
	
//Разбан
case 'unban':
	if($userbanned != '') {
		$stmt = $mysqli->prepare('SELECT `count` FROM `'.$tbl_bans.'` WHERE `username`=? LIMIT 1');
			$stmt->bind_param('s', $username);
			$stmt->execute(); 
			$stmt->bind_result($user_bans_count);
			$stmt->store_result();
			$stmt->fetch();
			$stmt->close();
		if($user_bans_count == '')
		{
		$unbanindex = 0;
		$mysqli->query('INSERT INTO `'.$tbl_bans.'` (`username`,`count`) VALUES ("'.$username.'", 1)'); 
		}
		else if($user_bans_count == 1){
		$unbanindex = 1;
		}
		else{
		$unbanindex = 2;
		}
		$unbanc = $unbancost[$unbanindex];
		if($usercash >= $unbanc) {
			$newusercash = $usercash - $unbancost[$unbanindex];
			$stmt = $mysqli->prepare('DELETE FROM `'.$tbl_BANLIST.'` WHERE `'.$tbl_BANLIST_col_username.'`=? LIMIT 1'); 
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$usercash = $newusercash;
			$user_bans_count = $user_bans_count+1;
			$result = 'Вы разбанены!';
			$stmt = $mysqli->prepare('UPDATE `'.$tbl_bans.'` SET `count` = ? WHERE `username` = ? LIMIT 1');
			$stmt->bind_param('is', $user_bans_count, $username);
			$stmt->execute();
			$stmt->close();
			$userbanned = '';
		} else {
			$result = 'Недостаточно денег!';
		}
	} else {
		$result = 'Вы не забанены!';
	}
	$mmesage = $mmesag1e.$result.$mmesag2e;
	break;
	}
}
//Разбан


if($userstatus=='deluxe') $userstatusout = 'golden'; else $userstatusout = $userstatus;

$fly = $set_perm[0];
$heal = $set_perm[1];
$kill = $set_perm[2];

$c_fly = $cost_perm[0];
$c_heal = $cost_perm[1];
$c_kill = $cost_perm[2];

//Право перм 1
if(isset($_POST['buyfly'])) { 	
$permis = $mysqli->query("SELECT * FROM `permissions` WHERE `name`='$username' AND `permission`='$fly'");
if ($permis->fetch_assoc()) {
	$mmesage = $mmesag1e."Вы уже купили статус".$mmesag2e;
} else {
	if ($usercash < $c_fly) {
		$mmesage = $mmesag1e."Денег не хватает!".$mmesag2e;
	} else {
		$mysqli->query("UPDATE `dle_users` SET `money`=`money`-'$c_fly' WHERE `name`='$username'");
		$mysqli->query("INSERT INTO `permissions` (`name`,`type`,`permission`) VALUES ('$username', '1', '$fly')");
		$mmesage = $mmesag1e."Вы купили статус!".$mmesag2e;
	}
}
}
//Право перм 1

//Право перм 2
if(isset($_POST['buyheal'])) { 	
$permis = $mysqli->query("SELECT * FROM `permissions` WHERE `name`='$username' AND `permission`='$heal'");
if ($permis->fetch_assoc()) {
	$mmesage = $mmesag1e."Вы уже купили статус".$mmesag2e;
} else {
	if ($usercash < $c_heal) {
		$mmesage = $mmesag1e."Денег не хватает!".$mmesag2e;
	} else {
		$mysqli->query("UPDATE `dle_users` SET `money`=`money`-'$c_heal' WHERE `name`='$username'");
		$mysqli->query("INSERT INTO `permissions` (`name`,`type`,`permission`) VALUES ('$username', '1', '$heal')");
		$mmesage = $mmesag1e."Вы купили статус!".$mmesag2e;
	}
}	
}
//Право перм 2

//Право перм 3
if(isset($_POST['buykill'])) { 
$permis = $mysqli->query("SELECT * FROM `permissions` WHERE `name`='$username' AND `permission`='$kill'");
if ($permis->fetch_assoc()) {
	$mmesage = $mmesag1e."Вы уже купили статус".$mmesag2e;
} else {
	if ($usercash < $c_kill) {
		$mmesage = $mmesag1e."Денег не хватает!".$mmesag2e;
	} else {
		$mysqli->query("UPDATE `dle_users` SET `money`=`money`-'$c_kill' WHERE `name`='$username'");
		$mysqli->query("INSERT INTO `permissions` (`name`,`type`,`permission`) VALUES ('$username', '1', '$kill')");
		$mmesage = $mmesag1e."Вы купили статус!".$mmesag2e;
	}
}	
}
//Право перм 3 

//Покупка варпа
if(isset($_POST['buywarp'])) { 

$warpname = $_POST['warpname'];

$ox = $_POST['ox'];
$oy = $_POST['oy'];
$oz = $_POST['oz'];	
$warpname1 = $mysqli->query("SELECT * FROM `warptable` WHERE `name`='$warpname'");
$warpname1 = $warpname1->fetch_assoc();
$fltt = $warpname1['name'];
if($fltt != $warpname) {
		$warp_cost = $warp_cost;
		if($usercash >= $warp_cost) {
			$newusercash = $usercash - $warp_cost;
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE '.$tbl_realmoney_id.'=? LIMIT 1');
			$stmt->bind_param('is', $newusercash, $_SESSION['dle_user_id']);
			$stmt->execute();
			$stmt->close();
			$stmt = $mysqli->query("INSERT INTO `warptable` (`name`, `creator`, `x`, `y`, `z`) VALUES ('$warpname', '$username', '$ox', '$oy', '$oz')");
			$result = 'Вы успешно создали warp '.$warpname.'!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
		} else {
			$result = 'Недостаточно денег!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			}
} else {
			$result = 'warp '.$warpname.' уже существует!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			}	
	}
//Покупка варпа


//Обмен валют
if(isset($_POST['submit1'])) { 
		  if(!preg_match("/^[0-9]+$/", $_POST['monet'])) exit ("Только положительное значения");
		  
	$monet = $_POST['monet'];
	$res = $mysqli->query("SELECT * FROM `dle_users` WHERE `name`='$username'");
	$res = $res->fetch_assoc();
	if ($res['money'] < $monet) {
	$mmesage = "не хватает денег для обмена."; 
	$mmesage = $mmesag1e.$mmesage.$mmesag2e; }
	else {
		if ($res['money'] <= 0) {
		$mmesage = "Ваш баланс отрицателен или равен нулю.";
		$mmesage = $mmesag1e.$mmesage.$mmesag2e; }
			else {
				$res_monet = $mysqli->query("SELECT * FROM `iConomy` WHERE `username`='$username'");
				$res_monet = $res_monet->fetch_assoc();
				$mysqli->query("UPDATE `dle_users` SET `money`=`money`-$monet WHERE `name`='$username'");
				
				$monet = $monet * $kurs_obmena;
				if ($res_monet['username'] == "") $mysqli->query("INSERT INTO `iConomy` (`username`, `balance`) VALUES ('$username', '$monet')");
				else $mysqli->query("UPDATE `iConomy` SET `balance`=`balance`+$monet WHERE `username`='$username'");
				$mmesage = "Вы успешно провели обмен! Обновите страницу.";
				$mmesage = $mmesag1e.$mmesage.$mmesag2e; 
			}
		}
}
//Обмен валют

//Перевод средств между игроками
if (isset($_POST['perevodb'])) {
	$money = htmlspecialchars($_POST['chislo']);
	$to = htmlspecialchars($_POST['playername']);
	if ($to == $username) {
		$mmesage = "Сам себе? Не смеши)";
		$mmesage = $mmesag1e.$mmesage.$mmesag2e;
	} else {
		if ($money <= 0) {
			$mmesage = "Перевод должен быть положительным!";
			$mmesage = $mmesag1e.$mmesage.$mmesag2e;
		} else {
			$select = $mysqli->query("SELECT * FROM `dle_users` WHERE `name`='$to'");
			if ($select->fetch_assoc()) {
				$moneyu = $mysqli->query("SELECT * FROM `dle_users` WHERE `name`='$username'");
				$moneyu = $moneyu->fetch_assoc();
				
				$moneyc = $money/100*$procent;
				$moneyc = round($moneyc);
				$moneyc = $moneyc + $money;
				if ($moneyc > $moneyu['money']) {
					$mmesage = "На Вашем счету не досточно средств!";
				} else {
					$mysqli->query("UPDATE `dle_users` SET `money`=`money`-$moneyc WHERE `name`='$username'");
					$mysqli->query("UPDATE `dle_users` SET `money`=`money`+$money WHERE `name`='$to'");
					$subj = "Ваш баланс пополнен!";
					$select = $mysqli->query("SELECT * FROM `dle_users` WHERE `name`='$to'");
					$komu = $select->fetch_assoc();
					$time = time();
					$text = "Здравствуй, $to, игрок нашего проекта с ником $username Отослал вам $money руб. Не забудьте его отблагодарить! ;)";
					$mysqli->query("INSERT INTO dle_pm (id, subj, text, user, user_from, date, pm_read, folder) VALUES (NULL, '$subj', '$text', '{$komu['user_id']}', '$username', '$time', 0, 'inbox')");
					$mmesage = "Вы успешно перевели средства!";
				}
			} else {
				$mmesage = "Данного человека не существует!";
			}	
			$mmesage = $mmesag1e.$mmesage.$mmesag2e;
		}
		
				
	}
	
}

//Перевод средств между игроками

//Завершения соединения с бд
$mysqli->close(); 
?>