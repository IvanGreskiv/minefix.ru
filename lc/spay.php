<?
if($_POST['upbalance-count']!='' && $_POST['upbalance-count']!=0) {
?>
<script>
window.open("payment.php?count=<?=$_POST['upbalance-count'] ?>", "_blank")
</script>
<?php
}
?>