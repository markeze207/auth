<? 
require_once('bd.php');
$mail = $_POST['mail'];
$mail = htmlspecialchars($mail);
$mail = trim($mail);
$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE mail = '".$mail."'"));
function gen_password($length = 6)
{
	$password = '';
	$arr = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
		'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
		'1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
	);
 
	for ($i = 0; $i < $length; $i++) {
		$password .= $arr[random_int(0, count($arr) - 1)];
	}
	return $password;
}
$password = gen_password(8);
$token = sha1(uniqid($mail, true));
if (isset($_GET["token"])) {
    $token = $_GET["token"];
    $info_token = mysqli_fetch_assoc($link->query("SELECT * FROM `verify_pass` WHERE token = '".$token."'"));
    $link->query("UPDATE `user` SET `password`='".$info_token['password']."' WHERE token = '".$token."'");
    $link->query("DELETE FROM `verify_pass` WHERE token = '".$token."'");	
    
    die();
}
if($info_user)  {
    $link->query("INSERT INTO `verify_pass`(`mail`, `password`,`token`) VALUES ('".$mail."','".$password."','".$token."')");
    $url = "http://37.230.113.210/lillego.ml/code/forgot.php?token=$token";
    mail($mail, 'My Subject', 'Подтвердите смену пароля '."'.$url.'");
}
else {
    echo 'no accout';
}

