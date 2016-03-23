<?php
defined('_DLE') or die('Ай-яй-яй, сюда нельзя!');
require_once('../config.php');
if(isset($_POST['action'])) {
	$mysqli = new mysqli($db_ip, $db_user, $db_pass, $db_base); 
	if (mysqli_connect_errno()) { printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); exit; } 
	$username = $_POST['fusername'];
	$mmesag1e = '<div class=modal-title><span class=modal-title-text>Уведомление</span></div><div class=upbalancediv><label>';
	$mmesag1e = $mysqli->real_escape_string($mmesag1e);
	$mmesag2e = '</label></div><hr><input type=button style="width: 106px; float: right;" class="button modal-button" value="Ок" onclick="modalWindow.close();"></div></form>';
	$mmesag2e = $mysqli->real_escape_string($mmesag2e);
	
	
	switch($_POST['action']) {
		case 'adminskinfile':
			$iwh = GetImageSize($_FILES['skinfile']['tmp_name']);
			if ($_FILES["skinfile"]["type"] != "image/png") $result = 'Недопустимый тип файла!';
			elseif(!is_uploaded_file($_FILES["skinfile"]["tmp_name"])) $result = 'Ошибка при загрузке файла!';
			elseif($iwh[0]>$skin_max_size_W || $iwh[1]>$skin_max_size_H || $iwh[0]<$skin_min_size_W || $iwh[1]<$skin_min_size_H) $result = 'Недопустимое разрешение файла!';
			elseif(move_uploaded_file($_FILES["skinfile"]["tmp_name"], '../uploads/skins/'.$username.'.png')) $result = 'Скин загружен!';
			else $result = 'Ошибка при загрузке файла!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
		case 'admincloakfile':
			$iwh = GetImageSize($_FILES['cloakfile']['tmp_name']);
			if ($_FILES["cloakfile"]["type"] != "image/png") $result = 'Недопустимый тип файла!';
			elseif(!is_uploaded_file($_FILES["cloakfile"]["tmp_name"])) $result = 'Ошибка при загрузке файла!';
			elseif($iwh[0]>$$cloak_max_size_W || $iwh[1]>$cloak_max_size_H || $iwh[0]<$cloak_min_size_W || $iwh[1]<$cloak_min_size_H) $result = 'Недопустимое разрешение файла!';
			elseif(move_uploaded_file($_FILES["cloakfile"]["tmp_name"], '../uploads/cloaks/'.$username.'.png')) $result = 'Плащ загружен!';
			else $result = 'Ошибка при загрузке файла!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
		case 'updusercash':
			$newusercash = $_POST['fusercash'];
			$stmt = $mysqli->prepare('UPDATE '.$tbl_realmoney_table.' SET '.$tbl_realmoney_col.'=? WHERE `name`=? LIMIT 1'); 
			$stmt->bind_param('is', $newusercash, $username);
			$stmt->execute();
			$stmt->close();
			$result = 'Готово!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;	
		case 'add_ban':	
			$ban_name = $_POST['ban_name'];
			$ban_reason = $_POST['ban_reason'];
			$ban_perm = $_POST['perm'];
			$time = time();
			if($ban_perm = $_POST['perm']) {
			$ban_time = '0';
			}else{
			$ban_time = time();
			$sutk = $_POST['sutk'];
			$sutk = $sutk * 24 * 60 * 60;
			$hour = $_POST['hour'];
			$hour = $hour * 60 * 60;
			$min = $_POST['min'];
			$min = $min * 60;
			$ban_time = $ban_time + $sutk + $hour + $min;
			};
			$stmt = $mysqli->prepare("INSERT INTO banlist (name, reason, admin, time, temptime) VALUES ('$ban_name', '$ban_reason', 'Server', '$time', '$ban_time')");
			$stmt->execute();
			$stmt->close();
			$result = 'Готово!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
		case 'iconomy':
			$newusercash = $_POST['fusericonomy'];
			$stmt = $mysqli->prepare('UPDATE '.$tbl_iconomy_table.' SET '.$tbl_iconomy_col.'=? WHERE `username`=? LIMIT 1'); 
			$stmt->bind_param('is', $newusercash, $username);
			$stmt->execute();
			$stmt->close();
			$result = 'Готово!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
		case 'unban':
			$stmt = $mysqli->prepare('DELETE FROM `'.$tbl_BANLIST.'` WHERE `'.$tbl_BANLIST_col_username.'`=? LIMIT 1'); 
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$stmt->close();
			$result = 'Готово!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
		case 'addpromokey':
			$key = $_POST['promokey'];
			$award = $_POST['promomoney'];
			$stmt = $mysqli->prepare('INSERT INTO `elc_promokeys` (`key`, `awardmoney`) VALUES (?, ?)'); 
			$stmt->bind_param('ss', $key, $award);
			$stmt->execute();
			$stmt->close();
			$result = 'Готово!';
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
		case 'updbannerscode':
			$bcode=fopen('../banners_code.txt', 'w');
			$code = $_POST['code'];
			$resultc = fwrite($bcode, $code);
			if ($resultc) $result = 'Данные в файл успешно занесены.';
			else $result = 'Ошибка при записи в файл.';
			fclose($bcode);
			$mmesage = $mmesag1e.$result.$mmesag2e;
			break;
	}
}

?>