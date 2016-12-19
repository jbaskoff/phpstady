<?

session_start();
if(!isset($_SESSION['admin'])){
	header("Location: {$_SERVER['REQUEST_URI']}secure/login.php?ref={$_SERVER['REQUEST_URI']}");
	exit;
}

function logOut(){
	session_destroy();
	header('Location: secure/login.php');
	exit;
}