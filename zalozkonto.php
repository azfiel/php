<?php
error_reporting(0);
session_start();
if($_SESSION['zalogowany']==True){
	header("location:bank.php");
}
$imie=$_POST["imie"];
$nazwisko=$_POST["nazwisko"];
$telefon=$_POST["telefon"];
$login=$_POST["loginrej"];
$haslo=$_POST["haslorej"];
$_SESSION['ok']=True;
$zajetylogin=False;
$krotkilogin=False;
$krotkiehaslo=False;
#imie  git nazwisko git, telefon nwm, login czy jest taki sam i wsm tyle
$pol=new mysqli("localhost","root","","bank");
if (isset($_POST['submitrej'])) {

$res=mysqli_query($pol,"SELECT * FROM uzytkownik WHERE login='$login'");
if (mysqli_num_rows($res)>0) {
	#taki login jest zajety
	$_SESSION['ok']=False;
	$zajetylogin=True;
}
elseif (strlen($login)<3 or strlen($login)>16) {
	#za krotki lub za dlugi login
	$_SESSION['ok']=False;
	$krotkilogin=True;
}
elseif(strlen($haslo)<3 or strlen($haslo)>16){
	#za krotkie/za dlugie haslo
	$krotkiehaslo=True;
	$_SESSION['ok']=False;
}
if ($_SESSION['ok']==True) {
	$res=mysqli_query($pol,"INSERT INTO `uzytkownik`(`Imie`, `Nazwisko`, `Telefon`, `login`, `haslo`) VALUES ('$imie','$nazwisko','$telefon','$login','$haslo')");
	header('location:zaloguj.php');
	unset($_SESSION['ok']);

}
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Bank</title>
</head>
<body>
<div class="nav">
<ul>
	<a href="index.php"><li>Strona główna</li></a>
	<a href="zaloguj.php"><li>Zaloguj się</li></a>
	<a href="zalozkonto.php" style="color: lightgrey;"><li>Załóż konto</li></a>
</ul>
</div>
<div class="logowanieform">
<form method="POST">
	<br>
	<input type="text" name="imie" placeholder="Imie" value="<?php if(isset($imie)){echo $imie;} ?>" required><br><br>
	<input type="text" name="nazwisko" placeholder="Nazwisko" value="<?php if(isset($nazwisko)){echo $nazwisko;} ?>" required><br><br>
	<input type="text" name="telefon" placeholder="Nr. telefonu" value="<?php if(isset($telefon)){echo $telefon;} ?>" required><br><br>
	<input type="text" name="loginrej" placeholder="login" value="<?php if(isset($login)){echo $login;} ?>" required><br><br>
	<?php
	if ($zajetylogin==True) {
		echo "<span style='font-size: 22pt; color: red; font-family: sans-serif;'>
			Taki login już istnieje. Wybierz inny.</span><br>";
		unset($zajetylogin);
	}
	elseif ($krotkilogin==True) {
		echo "<span style='font-size: 22pt; color: red; font-family: sans-serif;'>
			Twój login jest za krótki lub za długi. Login musi mieć od 3 do 16 znaków!</span><br>";
		unset($krotkilogin);
	}	
	?>
	<input type="password" name="haslorej" placeholder="hasło" required><br><br>
	<?php
	if ($krotkiehaslo==True) {
		echo "<span style='font-size: 22pt; color: red; font-family: sans-serif;'>
			Twoje hasło jest za krótkie lub za długie. Hasło musi mieć od 3 do 16 znaków!</span><br>";
		unset($krotkiehaslo);
	}	
	?>
	<input type="submit" name="submitrej" value="Załóż konto">
</form>
</div>
</body>
</html>