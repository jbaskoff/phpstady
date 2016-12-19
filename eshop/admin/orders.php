<?php
require "secure/session.inc.php";
require "../inc/lib.inc.php";
require "../inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Поступившие заказы</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Поступившие заказы:</h1>
	<?php
	$orders = getOrders();
	// print_r($orders);
	if (!$orders) {
		echo "Заказов нет";
		exit;
	}
	foreach ($orders as $order) {
		?>
		<hr>
		<h2>Заказ номер: <?=$order['orderid']?></h2>
		<p><b>Заказчик</b>: <?=$order['name']?></p>
		<p><b>Email</b>: <?=$order['email']?></p>
		<p><b>Телефон</b>: <?=$order['phone']?></p>
		<p><b>Адрес доставки</b>: <?=$order['address']?></p>
		<p><b>Дата размещения заказа</b>: <?=$order['date']?></p>

		<h3>Купленные товары:</h3>
		<table border="1" cellpadding="5" cellspacing="0" width="90%">
			<tr>
				<th>N п/п</th>
				<th>Название</th>
				<th>Автор</th>
				<th>Год издания</th>
				<th>Цена, руб.</th>
				<th>Количество</th>
			</tr>
			<?php 
			$i = 0; $sum = 0;
			foreach ($order['goods'] as $good): ?>
			<tr>
				<th><?php echo $i++ ?></th>
				<th><?php echo $good['title'] 	 ?></th>
				<th><?php echo $good['author']   ?></th>
				<th><?php echo $good['pubyear']  ?></th>
				<th><?php echo $good['price'] 	 ?></th>
				<th><?php echo $good['quantity'] ?></th>
			</tr>
			<?php 
			$sum += $good['price'];
			endforeach ?>
			
		</table>
		<p>Всего товаров в заказе на сумму: <?php echo $sum; ?>руб.</p>
		<?
} //end big foreach
?>
</body>
</html>