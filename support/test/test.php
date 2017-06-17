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
require '../../class/Validator.php';

$string = "<h1>Hello World _ !23!$%^'\"|</h1>";
echo $string;

echo "PregAlphaNumericUnderScoreSpace : ".Validator::PregAlphaNumericUnderScoreSpace($string)."<br/>";
echo "PregAlphaNumericSpace : ".Validator::PregAlphaNumericSpace($string)."<br/>";
echo "PregOnlyAlphaSpace : ".Validator::PregOnlyAlphaSpace($string)."<br/>";
echo "PregOnlyNumericSpace : ".Validator::PregOnlyNumericSpace($string)."<br/>";
echo "PregOnlyAlpha : ".Validator::PregOnlyAlpha($string)."<br/>";
echo "PregOnlyNumeric : ".Validator::PregOnlyNumeric($string)."<br/>";
echo "N : ".Validator::PregAlphaNumericUnderScore($string);
?>
</body>
</html>