<?php
session_start();
if($_SESSION["zalogowany"]!=True){
	header("location:zaloguj.php");
}
$pol=new mysqli("localhost","root","","czat");
echo $_SESSION['login'];


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Czat</title>
	<style type="text/css">
		input[type="text"],input[type="submit"]{
			width: 150px;
			height: 30px;
			font-size: 18pt;
		}

	</style>
</head>
<body>
	<body>
<div class="nav">
<ul>
	<a href="index.php"><li>Strona główna</li></a>
	<a href="czat.php" style="color: lightgrey;"><li>Czat</li></a>
	<a href="wyloguj.php"><li>Wyloguj się</li></a>
</ul>
</div>
<form method="POST">
	<input type="text" name="wiadomosc" placeholder="twoja wiadomosc">
	<input type="submit" name="submitwiad">
</form>
<?php
$res=mysqli_query($pol,"SELECT * FROM uzytkownik WHERE login='$_SESSION[login]'");
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
}
if (!empty($_POST['wiadomosc']) and isset($_POST['submitwiad'])) {
	$wiadok=mysqli_query($pol,"INSERT INTO realczat(nick_nadawcy,wiadomosc) VALUES('$row[login]','$_POST[wiadomosc]')");
}
#wyswietlanie wiad.
?>
<div id="chat">
<?php
$res2=mysqli_query($pol,"SELECT * FROM `realczat` ORDER BY `id_wiadomosci` DESC");
if(mysqli_num_rows($res)>0){
	while ($wiersz=mysqli_fetch_assoc($res2)) {
		echo "<br>$row[login]: <br>-$wiersz[wiadomosc]";

	}
}
else{
	echo "Brak wiadomosci";
}

?>


</div>
</body>
</html>
