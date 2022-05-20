<?php
error_reporting(0);
session_start();
if($_SESSION['zalogowany']==True){
	header("location:bank.php");
}
$login=$_POST['login'];
$haslo=$_POST['haslo'];
if(!isset($_SESSION['zalogowany'])){
	$_SESSION['zalogowany']=False;
}
$pol=new mysqli("localhost","root","","bank");
if (isset($_POST['submit'])) {
$res=mysqli_query($pol,"SELECT * FROM uzytkownik WHERE login='$login' and haslo='$haslo'");
if($res->num_rows>0){
	$_SESSION['zalogowany']=True;
	$_SESSION["login"]=$login;
	if($_SESSION['login']==123){
		$_SESSION['admin']=True;
	}
	header("location:bank.php");
}
else{
	$_SESSION['error']=True;
}
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Bank-logowanie</title>
</head>
<body>
<div class="nav">
<ul>
	<a href="index.php"><li>Strona główna</li></a>
	<a href="zaloguj.php" style="color: lightgrey;"><li>Zaloguj się</li></a>
	<a href="zalozkonto.php"><li>Załóż konto</li></a>
</ul>
</div>
<div class="logowanieform">
	<form method="POST">
		<br>
		<input type="text" name="login" placeholder="Login"><br><br>
		<input type="password" name="haslo" placeholder="Hasło"><br><br>
		<input type="submit" name="submit" value="Zaloguj się"><br>
		<?php
		if($_SESSION['error']==True){
			echo "<span style='font-size: 22pt; color: red; font-family: sans-serif;'>
			Zły login lub hasło</span>";
			unset($_SESSION["error"]);
		}
		?>
	</form>



</div>
</body>
</html>