<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Форма передавала информацию
	$name = strip_tags($_POST["name"]);
	$age = $_POST["age"] * 1;
	
	// Сохранение в cookie на сутки
	setcookie("userName", $name);
	setcookie("userAge", $age);
	
	// Обработка формы
	// ... 
	
	// перезапрос формы методом GET
	//header("Location: " . $_SERVER["PHP_SELF"]);
	//exit;
}
else {
	// Чтение куки
	$name = strip_tags($_COOKIE["userName"]);
	$age = $_COOKIE["userAge"] * 1;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<meta charset="utf-8" />
	<title>Очистка буфера POST</title>
</head>

<body>
<h1>Очистка буфера POST</h1>
<form action="<?=$_SERVER["PHP_SELF"]?>" 
		method="post">
	Ваше имя:
	<input type="text" name="name" value="<?=$name?>"><br>
	Ваш возраст:
	<input type="text" name="age" value="<?=$age?>"><br>
	<input type="submit" value="Передать">
</form>
<?
if ($name and $age) {	
	if ($name and $age) {
		echo "<h1>Привет, $name</h1>";
		echo "<h3>Тебе $age лет</h3>";
	}
	else {
		print "<h3>Заполните все поля!</h3>";
	}
}
?>
</body>
</html>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.