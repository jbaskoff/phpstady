<?php
/* Основные настройки */
const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = 'djuice';
const DB_NAME = 'gbook';

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die("conect error");
/* Основные настройки */

/* Сохранение записи в БД */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
	// $sql_request_str = "INSERT INTO msgs (name, email, msg) VALUES ('$name','$email', '$msg')";
	// $result = mysqli_query($link, $sql_request_str);

	$sql = "INSERT INTO msgs (name, email, msg) VALUES(?, ?, ?)";
	// Уважаемый сервер, вот запрос - разбери его
	$stmt = mysqli_prepare($link, $sql);
	// Уважаемый сервер, вот параметры для запроса
	mysqli_stmt_bind_param($stmt, "sss", $name, $email, $msg);
	// А теперь, исполни подготовленный запрос с переданными
	//	параметрами
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);



	header("Location: " . $_SERVER["PHP_SELF"] . "?id=gbook");
	exit;
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if ($_SERVER['REQUEST_METHOD'] == 'GET' and $_GET['del']) {
	$sql_delete_record = "DELETE FROM msgs WHERE id = {$_GET['del']}";
	$is_fine_delete = mysqli_query($link, $sql_delete_record);
	if( !$is_fine_delete ){
		echo 'Ошибка: '
		. mysqli_errno($link)
		. ':'
		. mysqli_error($link);
	}
	header("Location: " . $_SERVER["PHP_SELF"] . "?id=gbook");
}
/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
	Имя: <br /><input type="text" name="name" /><br />
	Email: <br /><input type="text" name="email" /><br />
	Сообщение: <br /><textarea name="msg"></textarea><br />

	<br />

	<input type="submit" value="Отправить!" />

</form>
<?php
/* Вывод записей из БД */
$res_str = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt
FROM msgs
ORDER BY id DESC";
$result = mysqli_query($link, $res_str);
//$number_of_records =  mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) as am FROM msgs"))['am'];
$number_of_records =   mysqli_num_rows(mysqli_query($link, "SELECT * FROM msgs"));
echo "<p>Всего записей в гостевой книге: {$number_of_records}</p>";
while ( $row = mysqli_fetch_assoc($result)) {
	$date = date("d-m-Y", $row['dt']);
	$time = date("H:i", $row['dt']);
	$delete_link = $_SERVER["PHP_SELF"] . "?id=gbook&del=" . $row['id'];
	echo "	<p>
	<a href='{$row['email']}'>{$row['name']}</a>
	$date в $time
	написал<br />{$row['msg']}
</p>
<p align='right'><a href='{$delete_link}'>Удалить</a></p>";
}
?>
