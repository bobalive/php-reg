<?
$host = '127.0.0.1'; // хост базы данных
$login = "root"; // логин
$password = 'root'; // пароль
$dbName = "connect"; // название базы данных

$link = mysqli_connect($host, $login, $password, $dbName );

if($link == false){
    die("failed to connect " .mysqli_connect_error());
}

