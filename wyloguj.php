<?php
error_reporting(0);
session_start();
if($_SESSION['zalogowany']==True){
	$_SESSION['zalogowany']=False;
	echo "Zostałeś wylogowany. <a href='index.php'>Kliknij tutaj</a> lub poczekaj 2 sekundy aby przejść do strony głównej";
	header("refresh:2;URL=index.php");
}
elseif ($_SESSION['zalogowany']==False) {
	header("location:index.php");
}
?>