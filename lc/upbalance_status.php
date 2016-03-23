<?
require_once('config.php');
switch($_GET['mode']) {
	case '0':
		// регистрационная информация (пароль #2)
		// registration info (password #2)
		$mrh_pass2 = $rk_second_pass;
		$tm=getdate(time()+9*3600);
		$date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";
		$out_summ = $_REQUEST["OutSum"];
		$inv_id = $_REQUEST["InvId"];
		$shp_item = $_REQUEST["Shp_item"];
		$crc = $_REQUEST["SignatureValue"];
		$crc = strtoupper($crc);
		$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));
		if ($my_crc !=$crc)
		{
			echo "bad sign\n";
			exit();
		}
		// признак успешно проведенной операции
		// success
		echo "OK$inv_id\n";
		$mysqli = new mysqli($db_ip, $db_user, $db_pass, $db_base); 
		if (mysqli_connect_errno()) { printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); exit; } 
		$stmt = $mysqli->prepare('INSERT INTO `elc_uphistory` (`pid`, `id`, `date`, `cash`) VALUES (?, ?, ?, ?'); 
		$stmt->bind_param('iisi', $inv_id, $_SESSION['dle_user_id'], $date, $out_summ); 
		$stmt->execute();
		break;
		
	case '1':
	$mrh_pass1 = $rk_first_pass;
	$out_summ = $_REQUEST["OutSum"];
	$inv_id = $_REQUEST["InvId"];
	$shp_item = $_REQUEST["Shp_item"];
	$crc = $_REQUEST["SignatureValue"];
	$crc = strtoupper($crc);
	$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item"));
	if ($my_crc != $crc)
	{
		echo "bad sign\n";
		exit();
	}
	$mysqli = new mysqli($db_ip, $db_user, $db_pass, $db_base); 
	if (mysqli_connect_errno()) { printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); exit; } 
	$stmt = $mysqli->prepare('SELECT `cash` FROM `elc_uphistory` WHERE `pid`=? AND `id`=? AND `cash`=? LIMIT 1'); 
	$stmt->bind_param('iii', $inv_id, $_SESSION['dle_user_id'], $out_summ); 
	$stmt->execute();
	$stmt->bind_result($resultcash);
	$stmt->store_result();
	$stmt->fetch();
	$stmt->close();
	if(!$resultcash=='') {
	$stmt = $mysqli->prepare('UPDATE `elc_realmoney` SET `cash`=? WHERE `id`=? LIMIT 1'); 
	$stmt->bind_param('is', $resultcash, $_SESSION['dle_user_id']);
	$stmt->execute();
	$stmt->close();
	echo 'Заказ выполнен успешно, сумма зачислена на ваш счет! Заказ# $inv_id\n';
	echo "Через 5 секунд вас вернут на главную страницу";
	}
	break;
	
	case '2':
	$inv_id = $_REQUEST["InvId"];
	echo "Вы отказались от оплаты. Заказ# $inv_id\n";
	echo "Через 5 секунд вас вернут на главную страницу";
	break;
}
sleep(5);
?>
<script type="text/javascript">
window.location = "index.php"
</script>