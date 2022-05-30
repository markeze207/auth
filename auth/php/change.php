<?
require_once('bd.php');
$oldpass = $_POST['oldpass'];
$oldpass = htmlspecialchars($oldpass);
$oldpass = trim($oldpass);
$oldpass = md5($oldpass."fdldsxz2456");
$pass = $_POST['pass'];
$pass = htmlspecialchars($pass);
$pass = trim($pass);
$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE password = '$oldpass'"));
if($info_user) {
    if(mb_strlen($pass) < 6 or mb_strlen($pass) > 12) {
        echo 'Dlina parolya';
        ?><a href="../index">Back</a><?
        exit();
    }
    $pass = md5($pass."fdldsxz2456");
    $link->query("UPDATE `user` SET `password`='".$pass."' WHERE login = '".$_COOKIE['user']."'");
    setcookie('user', $info_user['login'], time() - 3600, "/lillego.ml");
    header('Location: /lillego.ml/code/index');
}
else {
    echo 'Nepravilniy stariy parol';
}
mysqli_close($link);