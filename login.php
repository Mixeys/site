<?php
session_start();
require 'db.php';
// Страница авторизации
if(!empty($_POST)){
// Вытаскиваем из БД запись, у которой логин равняеться введенному
    $loginEscaped = $mysqli->real_escape_string($_POST['login']);
    $result = $mysqli->query("
    	SELECT *
        FROM users
        WHERE user_login='$loginEscaped' 
		LIMIT 1
	");
    $user = $result->fetch_assoc();
    // Сравниваем пароли
    if(!empty($user) && $user['user_password'] === $_POST['password']) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    }else{
        print "Вы ввели неправильный логин/пароль";
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Авторизация</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form method="POST">
	Логин:<br>
	<input name="login" type="text" class="text_fild"><br>
	Пароль:<br>
	<input name="password" type="password" class="text_fild"><br>
	<input name="submit" type="submit" value="Войти" class="btn">
	<a href="register.php">Регистрация</a>
</form>
</body>
</html>
