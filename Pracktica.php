<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RUS2</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php
  $dbc = mysqli_connect('localhost', 'id_227_3', 'id_227_3', 'id_227_3')
  or die('Error connecting to MySQL server.');

$login = $_POST['login'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$admin = $_POST['admin'];

$query = "INSERT INTO `users` ( `login`, `password`, `first_name`, `last_name`, `admin`) VALUES ('$login', '$password', '$first_name', '$last_name', '$admin')";
mysqli_query($dbc, $query)
or die('Error querying database.');

echo 'Customer added.';

mysqli_close($dbc);
?>
</body>
</html>