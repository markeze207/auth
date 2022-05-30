<? 
require_once('bd.php');
$mail = filter_var(trim($_POST['mail']));
$login = filter_var(trim($_POST['login']));
$pass = filter_var(trim($_POST['pass']));

if(mb_strlen($login) < 5 or mb_strlen($login) > 15) {
    echo 'Dlina logina';
    exit();
}
elseif(mb_strlen($pass) < 6 or mb_strlen($pass) > 12) {
    echo 'Dlina parolya';
    exit();
}

$pass = md5($pass."fdldsxz2456");
$link->query("INSERT INTO `user`(`mail`, `login`, `password`) VALUES ('$mail','$login','$pass')");
mysqli_close($link);
header('Location: /lillego.ml/code/index');
