<? 
require_once('bd.php');
$login = filter_var(trim($_POST['login']));
$pass = filter_var(trim($_POST['pass']));
$pass = md5($pass."fdldsxz2456");
$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE login = '$login' AND password = '$pass'"));

if(count($info_user) == 0) {
    echo 'No users';
    exit();
}
setcookie('user', $info_user['login'].$info_user['admin'], time() + 3600, "/lillego.ml");

mysqli_close($link);
header('Location: /lillego.ml/code/index.php');