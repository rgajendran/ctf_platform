<!doctype html>
<html>
<head>
<title>PHP Countdown Timer</title>
<style>
.green{color:green;}
 
h1{
font-size:3em;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
}
 
</style>
</head>
<body>
<?php
session_start();
$_SESSION['teama'] = array('hiran','hiranrajkumar','kapil','kapildev');
print_r($_SESSION['teama'])."</br>";
unset($_SESSION['teama'][array_search("hiran", $_SESSION['teama'])]);
print_r($_SESSION['teama']);


?>
</body>
</html>